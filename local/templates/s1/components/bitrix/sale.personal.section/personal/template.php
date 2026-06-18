<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Loader;
use Bitrix\Sale;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var Sale\Basket $basket
 */

$currentPage = 'index';

require __DIR__ . '/include/init.php';
require __DIR__ . '/include/shell_start.php';

$noPhoto = $this->GetFolder() . '/images/no_photo.png';
$catalogIblockId = 14;

$newProducts = [];
if (Loader::includeModule('iblock') && Loader::includeModule('catalog')) {
    $elRes = CIBlockElement::GetList(
        ['DATE_ACTIVE_FROM' => 'DESC', 'ID' => 'DESC'],
        [
            'IBLOCK_ID' => $catalogIblockId,
            'ACTIVE' => 'Y',
        ],
        false,
        ['nTopCount' => 8],
        ['ID', 'NAME', 'CODE', 'DETAIL_PAGE_URL', 'PREVIEW_PICTURE', 'CATALOG_GROUP_1']
    );
    while ($el = $elRes->GetNext()) {
        $imgSrc = '';
        if ($el['PREVIEW_PICTURE']) {
            $img = CFile::GetFileArray($el['PREVIEW_PICTURE']);
            $imgSrc = $img['SRC'] ?? '';
        }
        if (!$imgSrc) {
            $imgSrc = $noPhoto;
        }
        $newProducts[] = [
            'NAME' => $el['NAME'],
            'URL' => $el['DETAIL_PAGE_URL'],
            'IMG' => $imgSrc,
        ];
    }
}

$sections = [];
$secRes = CIBlockSection::GetList(
    ['SORT' => 'ASC', 'NAME' => 'ASC'],
    [
        'IBLOCK_ID' => $catalogIblockId,
        'ACTIVE' => 'Y',
        'DEPTH_LEVEL' => 1,
        'CNT_ACTIVE' => 'Y',
    ],
    true,
    ['ID', 'NAME', 'CODE', 'SECTION_PAGE_URL']
);
while ($sec = $secRes->GetNext()) {
    $sections[] = [
        'NAME' => $sec['NAME'],
        'URL' => $sec['SECTION_PAGE_URL'],
    ];
}

$orders = [];
if ($USER->IsAuthorized() && Loader::includeModule('sale')) {
    $orderRes = Sale\Order::getList([
        'filter' => ['USER_ID' => $USER->GetID()],
        'order' => ['DATE_INSERT' => 'DESC'],
        'limit' => 5,
        'select' => ['ID', 'ACCOUNT_NUMBER', 'PRICE', 'CURRENCY', 'DATE_INSERT', 'STATUS_ID'],
    ]);
    while ($orderData = $orderRes->fetch()) {
        $statusName = 'Неизвестно';
        $status = CSaleStatus::GetByID($orderData['STATUS_ID']);
        if ($status) {
            $statusName = $status['NAME'];
        }

        $basketItemsOrder = [];
        $orderObj = Sale\Order::load($orderData['ID']);
        $basket = $orderObj ? $orderObj->getBasket() : [];
        foreach ($basket as $basketItem) {
            $itemImg = '';
            $productId = $basketItem->getProductId();
            $prodRes = CIBlockElement::GetByID($productId)->GetNext();
            if ($prodRes && $prodRes['PREVIEW_PICTURE']) {
                $img = CFile::GetFileArray($prodRes['PREVIEW_PICTURE']);
                $itemImg = $img['SRC'] ?? '';
            }
            if (!$itemImg) {
                $itemImg = $noPhoto;
            }
            $basketItemsOrder[] = [
                'NAME' => $basketItem->getField('NAME'),
                'URL' => $prodRes ? $prodRes['DETAIL_PAGE_URL'] : '#',
                'IMG' => $itemImg,
            ];
        }

        $orders[] = [
            'ACCOUNT_NUMBER' => $orderData['ACCOUNT_NUMBER'],
            'PRICE' => Sale\PriceMaths::roundPrecision($orderData['PRICE']),
            'CURRENCY' => $orderData['CURRENCY'],
            'DATE_INSERT' => $orderData['DATE_INSERT']->format('j F в H:i'),
            'STATUS_NAME' => $statusName,
            'BASKET_ITEMS' => $basketItemsOrder,
        ];
    }
}

$basketItems = [];
if (Loader::includeModule('sale') && Loader::includeModule('catalog')) {
    $fUserId = Sale\Fuser::getId();
    $basket = Sale\Basket::loadItemsForFUser($fUserId, SITE_ID);
    foreach ($basket as $item) {
        if ($item->getField('DELAY') === 'Y') continue;
        $productId = $item->getProductId();
        $prodRes = CIBlockElement::GetByID($productId)->GetNext();
        $itemImg = '';
        if ($prodRes && $prodRes['PREVIEW_PICTURE']) {
            $img = CFile::GetFileArray($prodRes['PREVIEW_PICTURE']);
            $itemImg = $img['SRC'] ?? '';
        }
        if (!$itemImg) {
            $itemImg = $noPhoto;
        }
        $basketItems[] = [
            'NAME' => $item->getField('NAME'),
            'URL' => $prodRes ? $prodRes['DETAIL_PAGE_URL'] : '#',
            'IMG' => $itemImg,
            'QUANTITY' => $item->getQuantity(),
            'PRODUCT_ID' => $productId,
        ];
    }
}

$viewedProducts = [];
$viewedRes = CIBlockElement::GetList(
    ['DATE_ACTIVE_FROM' => 'DESC', 'ID' => 'DESC'],
    [
        'IBLOCK_ID' => $catalogIblockId,
        'ACTIVE' => 'Y',
    ],
    false,
    ['nTopCount' => 5],
    ['ID', 'NAME', 'CODE', 'DETAIL_PAGE_URL', 'PREVIEW_PICTURE']
);
while ($el = $viewedRes->GetNext()) {
    $imgSrc = '';
    if ($el['PREVIEW_PICTURE']) {
        $img = CFile::GetFileArray($el['PREVIEW_PICTURE']);
        $imgSrc = $img['SRC'] ?? '';
    }
    if (!$imgSrc) {
        $imgSrc = $noPhoto;
    }
    $viewedProducts[] = [
        'NAME' => $el['NAME'],
        'URL' => $el['DETAIL_PAGE_URL'],
        'IMG' => $imgSrc,
    ];
}

$action = CIBlockElement::GetList(["ACTIVE_TO" => 'DESC'], ['IBLOCK_ID' => 21, "ACTIVE" => 'Y'])->Fetch();
$months = ['января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'];
$actionDateTo = '';
if ($action && $action['ACTIVE_TO']) {
    $ts = strtotime($action['ACTIVE_TO']);
    $actionDateTo = date('j', $ts) . " " . $months[(int)date('n', $ts) - 1] . " " . date('Y', $ts) . " года";
}

?>
<div class="personal__section">
    <? if ($action) : ?>
        <div class="personal__action personal__item" style="background-image: url(<?= CFile::GetPath($action['PREVIEW_PICTURE']) ?>);">
            <div class="personal__action_content">
                <div class="personal__action_title"><?= $action['NAME'] ?></div>
                <div class="personal__action_desc">
                    <p class="personal__action_desc_text">Акция действует до <?= $actionDateTo ?></p>
                    <a href="/catalog" class="btn btn-primary btn-lg">Смотреть каталог</a>
                </div>
            </div>
        </div>
    <? endif; ?>
    <div class="personal__new personal__item">
        <div class="personal__item_heading">
            <h5>Новинки</h5>
        </div>
        <?php if (!empty($newProducts)) { ?>
            <div class="personal__new_list new_catalog swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($newProducts as $item) { ?>
                        <div class="swiper-slide">
                            <a href="<?= $item['URL'] ?>" class="personal__new_item ">
                                <div class="personal__new_item_img">
                                    <img src="<?= $item['IMG'] ?>" width="145" height="220" alt="<?= htmlspecialcharsbx($item['NAME']) ?>">
                                </div>
                                <div class="personal__new_item_title h6"><?= htmlspecialcharsbx($item['NAME']) ?></div>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } else { ?>
            <p style="padding: 1rem 0; color: var(--clr-grey);">Новинок пока нет</p>
        <?php } ?>
    </div>
</div>

<?
//  $APPLICATION->IncludeComponent(
//     "custom:favorites.section",
//     "",
//     array()
// ); 
?>

<?php if (!empty($viewedProducts)) { ?>
    <div class="personal__item">
        <div class="personal__item_heading">
            <h5>Вы смотрели</h5>
        </div>
        <div class="personal__new_list">
            <?php foreach ($viewedProducts as $item) { ?>
                <a href="<?= $item['URL'] ?>" class="personal__new_item ">
                    <div class="personal__new_item_img">
                        <img src="<?= $item['IMG'] ?>" width="145" height="220" alt="<?= htmlspecialcharsbx($item['NAME']) ?>">
                    </div>
                    <div class="personal__new_item_title h6"><?= htmlspecialcharsbx($item['NAME']) ?></div>
                </a>
            <?php } ?>
        </div>
    </div>
<?php } ?>
<?php if (!empty($orders)) { ?>
    <!-- <div class="personal__item white">
        <div class="personal__item_heading">
            <h5>История покупок</h5>
        </div>
        <div class="personal__history ">
            <div class="personal__history_heading">
                <div class="personal__history_left">
                    <span>Номер заказа</span>
                </div>
                <div class="personal__history_center">
                    <span>Статус заказа</span>
                    <span>Оформлен</span>
                    <span>Сумма заказа</span>
                </div>
                <div class="personal__history_right"></div>
            </div>
            <div class="personal__history_list">
                <?php foreach ($orders as $order) { ?>
                    <div class="personal__history_item accordion">
                        <div class="personal__history_item_title accordion_title">
                            <div class="personal__history_left">
                                <span class="order h6">Заказ №<?= htmlspecialcharsbx($order['ACCOUNT_NUMBER']) ?></span>
                            </div>
                            <div class="personal__history_center">
                                <span><?= htmlspecialcharsbx($order['STATUS_NAME']) ?></span>
                                <span><?= $order['DATE_INSERT'] ?></span>
                                <span><?= number_format($order['PRICE'], 0, '.', ' ') ?> <?= $order['CURRENCY'] ?></span>
                            </div>
                            <div class="personal__history_right">
                                <span class="icon btn btn-quad-sm">
                                    <svg width="8" height="6" viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.707031 0.707031L6.70703 6.70703L12.707 0.707032" stroke="#D7D8D9" stroke-width="2" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="accordion_content">
                            <div class="accordion_body personal__history_item_body">
                                <div class="history__data">
                                    <div class="history__data_item">
                                        <div class="title">Статус заказа</div>
                                        <div class="value"><?= htmlspecialcharsbx($order['STATUS_NAME']) ?></div>
                                    </div>
                                    <div class="history__data_item">
                                        <div class="title">Оформлен</div>
                                        <div class="value"><?= $order['DATE_INSERT'] ?></div>
                                    </div>
                                    <div class="history__data_item">
                                        <div class="title">Сумма заказа</div>
                                        <div class="value"><?= number_format($order['PRICE'], 0, '.', ' ') ?> <?= $order['CURRENCY'] ?></div>
                                    </div>
                                </div>
                                <?php if (!empty($order['BASKET_ITEMS'])) { ?>
                                    <div class="history__order">
                                        <div class="history__order_title">
                                            <div class="h6">Состав заказа</div>
                                        </div>
                                        <div class="history__order_list swiper">
                                            <div class="swiper-wrapper">
                                                <?php foreach ($order['BASKET_ITEMS'] as $bItem) { ?>
                                                    <div class="swiper-slide">
                                                        <a href="<?= $bItem['URL'] ?>" class="personal__new_item ">
                                                            <div class="personal__new_item_img">
                                                                <img src="<?= $bItem['IMG'] ?>" width="145" height="220" alt="<?= htmlspecialcharsbx($bItem['NAME']) ?>">
                                                            </div>
                                                            <div class="personal__new_item_title h6"><?= htmlspecialcharsbx($bItem['NAME']) ?></div>
                                                        </a>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="history__order_pay">
                                    <a href="#" class="btn btn-primary">Перейти к оплате</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div> -->
<?php } ?>
<?
//  $APPLICATION->IncludeComponent(
//     "custom:favorites.elements",
//     "",
//     array()
// ); 
?>
<?php if (!empty($basketItems)) { ?>
    <!-- <div class="personal__item white" id="basket-root">
        <div class="personal__item_heading">
            <h5>Ваша корзина</h5>
        </div>
        <div class="personal__cart_list">
            <?php foreach ($basketItems as $item) { ?>
                <div class="personal__new_item" data-basket-id="<?= (int)$item['PRODUCT_ID'] ?>">
                    <div class="personal__new_item_img">
                        <img src="<?= $item['IMG'] ?>" width="145" height="220" alt="<?= htmlspecialcharsbx($item['NAME']) ?>">
                    </div>
                    <a href="<?= $item['URL'] ?>" class="personal__new_item_title h6"><?= htmlspecialcharsbx($item['NAME']) ?></a>
                    <div class="personal__new_item_bottom">
                        <div class="counter">
                            <span class="btn btn-quad light dec js-cart-dec">
                                <svg width="12" height="3" viewBox="0 0 12 3" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 3V0H12V3H0Z" fill="CurrentColor" />
                                </svg>
                            </span>
                            <input type="text" name="count" class="btn btn-round counter_value js-cart-qty" value="<?= (int)$item['QUANTITY'] ?>" data-basket-id="<?= (int)$item['PRODUCT_ID'] ?>" inputmode="numeric">
                            <span class="btn btn-quad light inc js-cart-inc">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.03736 12V6.96264H0V5.02418H5.03736V0H6.97582V5.02418H12V6.96264H6.97582V12H5.03736Z" fill="CurrentColor" />
                                </svg>
                            </span>
                        </div>
                        <button class="btn btn-quad light remove js-cart-remove" data-basket-id="<?= (int)$item['PRODUCT_ID'] ?>">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="16" viewBox="0 0 477.867 477.867" fill="CurrentColor">
                                <path d="M443.733,68.267H324.267V51.2c0-28.277-22.923-51.2-51.2-51.2H204.8c-28.277,0-51.2,22.923-51.2,51.2v17.067H34.133c-9.426,0-17.067,7.641-17.067,17.067S24.708,102.4,34.133,102.4h18.551l32.649,359.953c0.805,8.814,8.216,15.55,17.067,15.514h273.067c8.851,0.037,16.261-6.699,17.067-15.514L425.182,102.4h18.552c9.426,0,17.067-7.641,17.067-17.067S453.159,68.267,443.733,68.267z M187.733,51.2c0-9.426,7.641-17.067,17.067-17.067h68.267c9.426,0,17.067,7.641,17.067,17.067v17.067h-102.4V51.2z M359.885,443.733H117.982L87.04,102.4h83.627h220.245L359.885,443.733z" />
                                <path d="M187.738,391.392c-0.002-0.023-0.003-0.047-0.005-0.07l-17.067-238.933c-0.669-9.426-8.853-16.524-18.278-15.855c-9.426,0.669-16.524,8.853-15.855,18.278L153.6,393.745c0.637,8.949,8.095,15.878,17.067,15.855h1.229C181.299,408.947,188.392,400.795,187.738,391.392z" />
                                <path d="M238.933,136.533c-9.426,0-17.067,7.641-17.067,17.067v238.933c0,9.426,7.641,17.067,17.067,17.067S256,401.959,256,392.533V153.6C256,144.174,248.359,136.533,238.933,136.533z" />
                                <path d="M325.478,136.533c-9.426-0.669-17.609,6.429-18.278,15.855l-17.067,238.933c-0.691,9.4,6.369,17.581,15.769,18.272c0.029,0.002,0.057,0.004,0.086,0.006h1.212c8.972,0.023,16.43-6.906,17.067-15.855l17.067-238.933C342.003,145.386,334.904,137.203,325.478,136.533z" />
                            </svg>
                        </button>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="personal__cart_control">
            <a href="/personal/order/make/" class="btn btn-primary">Перейти к оформлению заказа</a>
            <button class="btn btn-grey js-clear-cart">Очистить корзину</button>
        </div>
    </div> -->
<?php } ?>

<script>
    (function() {
        var basketRoot = document.getElementById('basket-root');
        if (!basketRoot) return;

        function ajax(action, data, cb) {
            data = data || {};
            data.action = action;
            var params = new URLSearchParams();
            for (var key in data) {
                if (data.hasOwnProperty(key)) params.set(key, data[key]);
            }
            fetch('/local/ajax/cart.php', {
                    method: 'POST',
                    body: params,
                    credentials: 'same-origin'
                })
                .then(function(r) {
                    return r.json();
                })
                .then(function(res) {
                    if (cb) cb(res);
                    if (res && res.success && typeof BX !== 'undefined') {
                        BX.onCustomEvent('OnBasketChange');
                    }
                })
                .catch(function() {});
        }

        function removeCartItem(productId) {
            var el = basketRoot.querySelector('[data-basket-id="' + productId + '"]');
            if (el) {
                el.style.transition = 'opacity .3s';
                el.style.opacity = '0';
                setTimeout(function() {
                    el.remove();
                }, 300);
            }
        }

        function clearCartItems() {
            var items = basketRoot.querySelectorAll('.personal__new_item');
            items.forEach(function(el) {
                el.remove();
            });
        }

        basketRoot.addEventListener('click', function(e) {
            var btn;

            btn = e.target.closest('.js-cart-inc');
            if (btn) {
                e.preventDefault();
                var input = btn.closest('.counter').querySelector('.js-cart-qty');
                if (input) {
                    var val = parseInt(input.value) || 0;
                    input.value = val + 1;
                }
                return;
            }

            btn = e.target.closest('.js-cart-dec');
            if (btn) {
                e.preventDefault();
                var input = btn.closest('.counter').querySelector('.js-cart-qty');
                if (input) {
                    var val = parseInt(input.value) || 0;
                    if (val > 1) input.value = val - 1;
                }
                return;
            }

            btn = e.target.closest('.js-cart-remove');
            if (btn) {
                e.preventDefault();
                var pid = parseInt(btn.dataset.basketId);
                if (confirm('Удалить товар из корзины?')) {
                    ajax('delete', {
                        id: pid
                    }, function(res) {
                        if (res && res.success) removeCartItem(pid);
                    });
                }
                return;
            }

            btn = e.target.closest('.js-clear-cart');
            if (btn) {
                e.preventDefault();
                if (confirm('Вы уверены, что хотите очистить корзину?')) {
                    ajax('clear', {}, function(res) {
                        if (res && res.success) clearCartItems();
                    });
                }
                return;
            }
        });

        var qtyInputs = basketRoot.querySelectorAll('.js-cart-qty');
        qtyInputs.forEach(function(input) {
            var timer;
            input.addEventListener('input', function() {
                clearTimeout(timer);
                timer = setTimeout(function() {
                    var val = parseInt(input.value) || 1;
                    if (val < 1) val = 1;
                    input.value = val;
                    ajax('update', {
                        id: parseInt(input.dataset.basketId),
                        quantity: val
                    });
                }, 500);
            });
        });
    })();
</script>

<?php
require __DIR__ . '/include/shell_end.php';
