<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Loader;
use Bitrix\Sale;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */

if ($arParams["MAIN_CHAIN_NAME"] !== '') {
    $APPLICATION->AddChainItem(htmlspecialcharsbx($arParams["MAIN_CHAIN_NAME"]), $arResult['SEF_FOLDER']);
}

global $USER;

$theme = Bitrix\Main\Config\Option::get("main", "wizard_eshop_bootstrap_theme_id", "blue", SITE_ID);
$noPhoto = $this->GetFolder() . '/images/no_photo.png';

// --- Greeting ---
$hour = (int)date('G');
if ($hour >= 6 && $hour < 12) {
    $greeting = 'Доброе утро';
} elseif ($hour >= 12 && $hour < 18) {
    $greeting = 'Добрый день';
} elseif ($hour >= 18 && $hour < 23) {
    $greeting = 'Добрый вечер';
} else {
    $greeting = 'Доброй ночи';
}
$userName = $USER->IsAuthorized() ? $USER->GetFullName() : '';
if (!$userName) {
    $userName = $USER->IsAuthorized() ? $USER->GetLogin() : 'Гость';
}

// --- User statuses ---
$isVerified = false;
$isDealer = false;
if ($USER->IsAuthorized()) {
    $userGroups = CUser::GetUserGroup($USER->GetID());
    $dealerGroups = [7, 8];
    $isVerified = true;
    if (array_intersect($userGroups, $dealerGroups)) {
        $isDealer = true;
    }
}

// --- New products ---
$newProducts = [];
$catalogIblockId = 14;
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

// --- Catalog sections (favorite categories) ---
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

// --- Orders ---
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
        $status = Sale\OrderStatus::getList([
            'filter' => ['ID' => $orderData['STATUS_ID']],
            'select' => ['ID', 'NAME'],
        ])->fetch();
        if ($status) {
            $statusName = $status['NAME'];
        }

        $basketItems = [];
        $basket = Sale\Basket::loadItemsForOrder($orderData['ID']);
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
            $basketItems[] = [
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
            'BASKET_ITEMS' => $basketItems,
        ];
    }
}

// --- Basket items ---
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

// --- Viewed products ---
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

$availablePages = array();

if ($arParams['SHOW_ORDER_PAGE'] === 'Y') {
    $availablePages[] = array(
        "path" => $arResult['PATH_TO_ORDERS'],
        "name" => Loc::getMessage("SPS_ORDER_PAGE_NAME"),
        "icon" => '<i class="fa fa-calculator"></i>'
    );
}

if ($arParams['SHOW_ACCOUNT_PAGE'] === 'Y') {
    $availablePages[] = array(
        "path" => $arResult['PATH_TO_ACCOUNT'],
        "name" => Loc::getMessage("SPS_ACCOUNT_PAGE_NAME"),
        "icon" => '<i class="fa fa-credit-card"></i>'
    );
}

if ($arParams['SHOW_PRIVATE_PAGE'] === 'Y') {
    $availablePages[] = array(
        "path" => $arResult['PATH_TO_PRIVATE'],
        "name" => Loc::getMessage("SPS_PERSONAL_PAGE_NAME"),
        "icon" => '<i class="fa fa-user-secret"></i>'
    );
}

if ($arParams['SHOW_ORDER_PAGE'] === 'Y') {
    $delimeter = ($arParams['SEF_MODE'] === 'Y') ? "?" : "&";
    $availablePages[] = array(
        "path" => $arResult['PATH_TO_ORDERS'] . $delimeter . "filter_history=Y",
        "name" => Loc::getMessage("SPS_ORDER_PAGE_HISTORY"),
        "icon" => '<i class="fa fa-list-alt"></i>'
    );
}

if ($arParams['SHOW_PROFILE_PAGE'] === 'Y') {
    $availablePages[] = array(
        "path" => $arResult['PATH_TO_PROFILE'],
        "name" => Loc::getMessage("SPS_PROFILE_PAGE_NAME"),
        "icon" => '<i class="fa fa-list-ol"></i>'
    );
}

if ($arParams['SHOW_BASKET_PAGE'] === 'Y') {
    $availablePages[] = array(
        "path" => $arParams['PATH_TO_BASKET'],
        "name" => Loc::getMessage("SPS_BASKET_PAGE_NAME"),
        "icon" => '<i class="fa fa-shopping-cart"></i>'
    );
}

if ($arParams['SHOW_SUBSCRIBE_PAGE'] === 'Y') {
    $availablePages[] = array(
        "path" => $arResult['PATH_TO_SUBSCRIBE'],
        "name" => Loc::getMessage("SPS_SUBSCRIBE_PAGE_NAME"),
        "icon" => '<i class="fa fa-envelope"></i>'
    );
}

if ($arParams['SHOW_CONTACT_PAGE'] === 'Y') {
    $availablePages[] = array(
        "path" => $arParams['PATH_TO_CONTACT'],
        "name" => Loc::getMessage("SPS_CONTACT_PAGE_NAME"),
        "icon" => '<i class="fa fa-info-circle"></i>'
    );
}

if (!empty($arParams['~CUSTOM_PAGES'])) {
    $customPagesList = CUtil::JsObjectToPhp($arParams['~CUSTOM_PAGES']);
    if (!empty($customPagesList) && is_array($customPagesList)) {
        foreach ($customPagesList as $page) {
            $icon = (string)($page[2] ?? '');
            $availablePages[] = [
                'path' => $page[0],
                'name' => $page[1],
                'icon' => $icon !== '' ? '<i class="fa ' . htmlspecialcharsbx($icon) . '"></i>' : ''
            ];
            unset($icon);
        }
    }
    unset($customPagesList);
}

$action = CIBlockElement::GetList(["ACTIVE_TO" => 'DESC'], ['IBLOCK_ID' => 21, "ACTIVE" => 'Y'])->Fetch();
$months = ['января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'];
$actionDateTo = date('j', strtotime($action['ACTIVE_TO'])) . " " . $months[date('I', strtotime($action['ACTIVE_TO']))] . " " . date('Y', strtotime($action['ACTIVE_TO'])) . " года";

if (empty($availablePages)) {
    ShowError(Loc::getMessage("SPS_ERROR_NOT_CHOSEN_ELEMENT"));
} else {
?>
    <!-- <div class="row">
        <div class="col-md-12 sale-personal-section-index">
            <div class="row sale-personal-section-row-flex">
                <?php
                foreach ($availablePages as $blockElement) {
                ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                        <div class="sale-personal-section-index-block bx-theme-<?= $theme ?>">
                            <a class="sale-personal-section-index-block-link" href="<?= htmlspecialcharsbx($blockElement['path']) ?>">
                                <span class="sale-personal-section-index-block-ico">
                                    <?= $blockElement['icon'] ?>
                                </span>
                                <h2 class="sale-personal-section-index-block-name">
                                    <?= htmlspecialcharsbx($blockElement['name']) ?>
                                </h2>
                            </a>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div> -->

    <div class="personal section anim-fade-in-up">
        <div class="container">
            <div class="heading anim-fade-in-left">
                <h1 class="h2"><?= $greeting ?>, <?= htmlspecialcharsbx($userName) ?>!</h1>
                <div class="personal__statuses">
                    <?php if ($isVerified) { ?>
                        <div class="personal__status verify">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M8 16C6.41775 16 4.87101 15.5308 3.55542 14.6518C2.23982 13.7727 1.21447 12.5233 0.608964 11.0615C0.00346253 9.59966 -0.154959 7.99113 0.153723 6.43928C0.462405 4.88743 1.22432 3.46197 2.34314 2.34315C3.46196 1.22433 4.88744 0.462403 6.43929 0.153721C7.99114 -0.15496 9.59967 0.0034663 11.0615 0.608967C12.5233 1.21447 13.7727 2.23985 14.6518 3.55544C15.5308 4.87104 16 6.41775 16 8C16 10.1217 15.1572 12.1566 13.6569 13.6569C12.1566 15.1571 10.1217 16 8 16ZM8 1.33334C6.68146 1.33334 5.39251 1.72433 4.29618 2.45687C3.19985 3.18941 2.3454 4.23061 1.84082 5.44878C1.33623 6.66695 1.20419 8.0074 1.46142 9.30061C1.71866 10.5938 2.35362 11.7817 3.28597 12.714C4.21832 13.6464 5.40617 14.2813 6.69938 14.5386C7.99259 14.7958 9.33305 14.6638 10.5512 14.1592C11.7694 13.6546 12.8106 12.8001 13.5431 11.7038C14.2757 10.6075 14.6667 9.31854 14.6667 8C14.6667 6.23189 13.9643 4.5362 12.714 3.28596C11.4638 2.03572 9.76811 1.33334 8 1.33334ZM7.94665 10.8887C7.92298 10.9875 7.8722 11.0778 7.80001 11.1493C7.73782 11.2119 7.66249 11.2599 7.57947 11.2898C7.49644 11.3196 7.40779 11.3306 7.31998 11.322C7.18138 11.3317 7.04364 11.2936 6.92964 11.2142C6.81565 11.1348 6.73224 11.0187 6.69332 10.8853L4.81331 9.00667C4.71183 8.8923 4.65786 8.74351 4.66239 8.59068C4.66692 8.43784 4.72961 8.2925 4.83768 8.18434C4.94576 8.07619 5.09106 8.01337 5.24389 8.00872C5.39672 8.00407 5.54554 8.05794 5.65999 8.15934L7.11332 9.61533L10.0867 4.344C10.1294 4.26588 10.1873 4.19711 10.257 4.14173C10.3267 4.08636 10.4068 4.0455 10.4925 4.02157C10.5783 3.99765 10.6679 3.99115 10.7562 4.00244C10.8445 4.01373 10.9297 4.0426 11.0067 4.08733C11.1615 4.18285 11.273 4.33481 11.3178 4.5111C11.3626 4.68739 11.3371 4.87419 11.2467 5.032L7.94665 10.8887Z"
                                    fill="#95DB99" />
                            </svg>
                            Верифицированный аккаунт
                        </div>
                    <?php } ?>
                    <?php if (!$USER->IsAuthorized()) { ?>
                        <div class="personal__status guest">
                            Гостевой аккаунт
                        </div>
                    <?php } ?>
                    <?php if ($isDealer) { ?>
                        <div class="personal__status diller">
                            Дилер
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="personal__content">
                <aside class="personal__aside">
                    <nav class="personal__aside_nav anim-stagger">
                        <ul>
                            <li>
                                <a class="btn btn-quad-md btn-white" href="/lk">
                                    <svg width="24" height="24" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12.7362 4.70588C12.7362 2.1069 10.6157 0 8.00003 0C5.38426 0 3.26379 2.1069 3.26379 4.70588C3.26379 6.0835 3.85976 7.32252 4.80831 8.1827C2.24288 9.28448 0.368483 11.6735 0.0104673 14.532C-0.0942123 15.3677 0.602597 16 1.3693 16H14.6307C15.3974 16 16.0942 15.3677 15.9895 14.532C15.6315 11.6735 13.7571 9.28449 11.1917 8.18271C12.1402 7.32253 12.7362 6.0835 12.7362 4.70588ZM9.74343 8.38513C9.72003 8.20113 9.80756 8.02071 9.96698 7.92424C11.0605 7.26287 11.789 6.0687 11.789 4.70588C11.789 2.62669 10.0926 0.941176 8.00003 0.941176C5.9074 0.941176 4.21103 2.62669 4.21103 4.70588C4.21103 6.06871 4.93953 7.26287 6.03298 7.92424C6.19241 8.02071 6.27993 8.20113 6.25663 8.38513C6.23324 8.56904 6.10336 8.72226 5.92484 8.77638C3.28638 9.57572 1.29961 11.8605 0.950452 14.6482C0.925919 14.8441 1.08973 15.0588 1.3693 15.0588H14.6307C14.9102 15.0588 15.074 14.8441 15.0495 14.6482C14.7003 11.8605 12.7136 9.57572 10.0752 8.77638C9.8966 8.72226 9.76673 8.56904 9.74343 8.38513Z"
                                            fill="CurrentColor" />
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a class="btn btn-quad-md btn-white" href="/history">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12.09 0.00576212C10.0636 -0.0172722 8.06447 0.50817 6.2767 1.53368C4.48892 2.55918 2.97004 4.05177 1.86 5.87391V1.60177H0V7.16361C0.00780682 7.6512 0.19252 8.11622 0.514761 8.45954C0.837002 8.80286 1.27128 8.99731 1.725 9.00144H6.885V7.0024H3.405C4.34117 5.44788 5.62897 4.174 7.14789 3.29997C8.66681 2.42594 10.3672 1.98031 12.09 2.0048C14.6533 1.90871 17.148 2.90539 19.0305 4.77763C20.9131 6.64988 22.0307 9.24592 22.14 12C22.0307 14.7541 20.9131 17.3501 19.0305 19.2224C17.148 21.0946 14.6533 22.0913 12.09 21.9952C9.5267 22.0913 7.03196 21.0946 5.14945 19.2224C3.26694 17.3501 2.14927 14.7541 2.04 12H0.18C0.285706 15.2857 1.59829 18.3925 3.83044 20.6404C6.06258 22.8883 9.03246 24.0943 12.09 23.9942C15.1475 24.0943 18.1174 22.8883 20.3496 20.6404C22.5817 18.3925 23.8943 15.2857 24 12C23.8943 8.71435 22.5817 5.60752 20.3496 3.35959C18.1174 1.11166 15.1475 -0.0942757 12.09 0.00576212Z"
                                            fill="CurrentColor" />
                                        <path d="M11.16 6.00288V12.9995H16.56V11.0005H13.02V6.00288H11.16Z"
                                            fill="CurrentColor" />
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a class="btn btn-quad-md btn-white" href="/favorites">
                                    <svg width="26" height="24" viewBox="0 0 17 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8.49339 1.30609C7.59211 0.493411 6.40643 0 5.10752 0C2.28671 0 0 2.32698 0 5.19746C0 6.51927 0.478257 7.73256 1.27688 8.6497L8.5 16L15.5093 8.8673L15.7165 8.64301C16.5151 7.72577 17 6.51927 17 5.19746C17 2.32698 14.7133 0 11.8924 0C10.5935 0 9.40789 0.493411 8.50661 1.3061L8.5 1.29937L8.49339 1.30609ZM8.5 3.24788L8.55185 3.29459L9.35746 2.47474L9.44142 2.39902C10.0931 1.81145 10.9491 1.45455 11.8924 1.45455C13.9428 1.45455 15.5833 3.14253 15.5833 5.19746C15.5833 6.13944 15.2419 6.99869 14.6732 7.65876L14.4965 7.84999L8.5 13.9521L2.30703 7.65004C1.75093 6.99714 1.41667 6.13905 1.41667 5.19746C1.41667 3.14253 3.05716 1.45455 5.10752 1.45455C6.05082 1.45455 6.90691 1.81145 7.55858 2.39901L7.64254 2.4747L8.44824 3.29456L8.5 3.24788Z"
                                            fill="CurrentColor" />
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a class="btn btn-quad-md btn-white" href="/cart">
                                    <svg width="25" height="24" viewBox="0 0 17 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M0.828399 0.0350039C0.504358 -0.0777245 0.14931 0.0908144 0.0353776 0.411433C-0.0785545 0.73206 0.0917839 1.08336 0.415834 1.19608L0.632445 1.27143C1.18606 1.46402 1.54991 1.59165 1.81762 1.72162C2.06908 1.8437 2.17993 1.94251 2.25295 2.04824C2.3278 2.15662 2.3856 2.30547 2.41822 2.6036C2.45234 2.91557 2.45319 3.32189 2.45319 3.92901V6.16212C2.45319 7.3539 2.46449 8.21329 2.57815 8.86986C2.69949 9.57081 2.94174 10.0726 3.39471 10.5454C3.88718 11.0593 4.51144 11.283 5.25466 11.3873C5.96636 11.4872 6.87013 11.4872 7.98611 11.4872H12.4688C13.0839 11.4872 13.6014 11.4872 14.0201 11.4365C14.4644 11.3827 14.8696 11.2651 15.2232 10.9799C15.5769 10.6947 15.7751 10.3258 15.9181 9.90623C16.0527 9.51059 16.1572 9.00918 16.2814 8.41317L16.7034 6.38703L16.7042 6.38325L16.7128 6.34039C16.8494 5.66357 16.9643 5.09423 16.9929 4.6363C17.0228 4.15532 16.9675 3.68107 16.6509 3.27378C16.456 3.02318 16.1821 2.88131 15.9329 2.79468C15.6787 2.70632 15.3913 2.6552 15.1013 2.62312C14.5315 2.56011 13.8394 2.56012 13.1606 2.56012H3.66375C3.66102 2.52997 3.65807 2.50031 3.65488 2.47116C3.61033 2.06388 3.51379 1.69242 3.27995 1.35385C3.04429 1.01264 2.73096 0.794106 2.36556 0.616714C2.02383 0.450809 1.5896 0.299771 1.07834 0.121944L0.828399 0.0350039ZM3.69708 3.79087H13.1347C13.8448 3.79087 14.4699 3.79169 14.9631 3.84625C15.2082 3.87336 15.3917 3.91102 15.5205 3.95584C15.6258 3.99246 15.6615 4.02237 15.6666 4.02669C15.6666 4.0266 15.6669 4.02687 15.6666 4.02669C15.7176 4.09349 15.7729 4.21468 15.7513 4.56048C15.7286 4.92443 15.632 5.41038 15.4847 6.14056L15.4844 6.14239L15.0707 8.12813C14.9369 8.77041 14.8468 9.1974 14.7393 9.51313C14.6372 9.81294 14.5413 9.94209 14.4374 10.0259C14.3336 10.1096 14.1864 10.1764 13.8691 10.2148C13.5347 10.2554 13.0939 10.2564 12.4311 10.2564H8.03363C6.85873 10.2564 6.04351 10.2549 5.4293 10.1688C4.83654 10.0856 4.52339 9.93446 4.29739 9.69856C4.03188 9.42156 3.88868 9.15022 3.80418 8.66211C3.712 8.12952 3.69708 7.38097 3.69708 6.3856V3.79087Z"
                                            fill="CurrentColor" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5.18305 15.9999C4.15257 15.9999 3.31721 15.1733 3.31721 14.1538C3.31721 13.1342 4.15257 12.3077 5.18305 12.3077C6.21353 12.3077 7.04888 13.1342 7.04888 14.1538C7.04888 15.1733 6.21353 15.9999 5.18305 15.9999ZM4.5611 14.1538C4.5611 14.4936 4.83956 14.7692 5.18305 14.7692C5.52654 14.7692 5.80499 14.4936 5.80499 14.1538C5.80499 13.8139 5.52654 13.5384 5.18305 13.5384C4.83956 13.5384 4.5611 13.8139 4.5611 14.1538Z"
                                            fill="CurrentColor" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12.6464 16C11.616 16 10.7806 15.1734 10.7806 14.1539C10.7806 13.1342 11.616 12.3078 12.6464 12.3078C13.6768 12.3078 14.5122 13.1342 14.5122 14.1539C14.5122 15.1734 13.6768 16 12.6464 16ZM12.0244 14.1539C12.0244 14.4937 12.3029 14.7692 12.6464 14.7692C12.9899 14.7692 13.2683 14.4937 13.2683 14.1539C13.2683 13.814 12.9899 13.5385 12.6464 13.5385C12.3029 13.5385 12.0244 13.814 12.0244 14.1539Z"
                                            fill="CurrentColor" />
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a class="btn btn-quad-md btn-white" href="/settings">
                                    <svg width="27" height="26" viewBox="0 0 27 26" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M13.4938 16.8153C15.5638 16.8153 17.2419 15.1078 17.2419 13.0013C17.2419 10.8948 15.5638 9.18731 13.4938 9.18731C11.4237 9.18731 9.74563 10.8948 9.74563 13.0013C9.74563 15.1078 11.4237 16.8153 13.4938 16.8153Z"
                                            stroke="CurrentColor" stroke-width="2" stroke-miterlimit="10"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M1 14.12V11.8824C1 10.5602 2.06197 9.46693 3.37381 9.46693C5.63518 9.46693 6.55972 7.83962 5.42279 5.84362C4.77311 4.69941 5.16042 3.21195 6.29735 2.55085L8.45877 1.29223C9.44578 0.694703 10.7201 1.05068 11.3073 2.05503L11.4448 2.29659C12.5692 4.29259 14.4183 4.29259 15.5552 2.29659L15.6927 2.05503C16.2799 1.05068 17.5542 0.694703 18.5412 1.29223L20.7026 2.55085C21.8396 3.21195 22.2269 4.69941 21.5772 5.84362C20.4403 7.83962 21.3648 9.46693 23.6262 9.46693C24.9255 9.46693 26 10.5475 26 11.8824V14.12C26 15.4422 24.938 16.5355 23.6262 16.5355C21.3648 16.5355 20.4403 18.1628 21.5772 20.1588C22.2269 21.3157 21.8396 22.7905 20.7026 23.4516L18.5412 24.7102C17.5542 25.3077 16.2799 24.9518 15.6927 23.9474L15.5552 23.7059C14.4308 21.7099 12.5817 21.7099 11.4448 23.7059L11.3073 23.9474C10.7201 24.9518 9.44578 25.3077 8.45877 24.7102L6.29735 23.4516C5.16042 22.7905 4.77311 21.303 5.42279 20.1588C6.55972 18.1628 5.63518 16.5355 3.37381 16.5355C2.06197 16.5355 1 15.4422 1 14.12Z"
                                            stroke="CurrentColor" stroke-width="2" stroke-miterlimit="10"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </aside>
                <div class="personal__sections">
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

                    <? $APPLICATION->IncludeComponent(
                        "custom:favorites.section",
                        "",
                        array()
                    ); ?>

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
                        <div class="personal__item white">
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
                        </div>
                    <?php } ?>
                    <? $APPLICATION->IncludeComponent(
                        "custom:favorites.elements",
                        "",
                        array()
                    ); ?>
                    <?php if (!empty($basketItems)) { ?>
                        <div class="personal__item white" id="basket-root">
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
                        </div>
                    <?php } ?>
                    <?
                    $APPLICATION->IncludeComponent(
                        "bitrix:main.profile",
                        "my_profile",
                        array(
                            "CHECK_RIGHTS" => "N",    // Проверять права доступа
                            "SEND_INFO" => "N",    // Генерировать почтовое событие
                            "SET_TITLE" => "N",    // Устанавливать заголовок страницы
                            "USER_PROPERTY" => "",    // Показывать доп. свойства
                            "USER_PROPERTY_NAME" => "",    // Название закладки с доп. свойствами
                            "COMPONENT_TEMPLATE" => ".default"
                        ),
                        false
                    );
                    ?>
                    <!-- <div class="personal__item white">
                        <div class="personal__item_heading">
                            <h5>Редактировать профиль</h5>
                        </div>
                        <div class="personal__profile profile">
                            <form action="#" enctype="multipart/form-data" class="profile__form">
                                <div class="profile__form_list">
                                    <div class="profile__form_item">
                                        <div class="form_title">
                                            <div class="h6">Личные данные</div>
                                        </div>
                                        <div class="profile__form_fields">
                                            <div class="profile__form_field">
                                                <label class="label-text">
                                                    <input type="text" name="name" placeholder="Имя" value="<?= htmlspecialcharsbx($USER->GetFirstName()) ?>">
                                                    <span class="error"></span>
                                                </label>
                                            </div>
                                            <div class="profile__form_field">
                                                <label class="label-text">
                                                    <input type="text" name="family" placeholder="Фамилия" value="<?= htmlspecialcharsbx($USER->GetLastName()) ?>">
                                                    <span class="error"></span>
                                                </label>
                                            </div>
                                            <div class="profile__form_field">
                                                <label class="label-text">
                                                    <input type="text" name="lastnane" placeholder="Отчество" value="<?= htmlspecialcharsbx($USER->GetSecondName()) ?>">
                                                    <span class="error"></span>
                                                </label>
                                            </div>
                                            <div class="profile__form_field">
                                                <label class="label-text">
                                                    <input type="text" name="birthsdate" placeholder="Дата рождения">
                                                    <span class="error"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile__form_item">
                                        <div class="form_title">
                                            <div class="h6">Контактные данные</div>
                                        </div>
                                        <div class="profile__form_fields">
                                            <div class="profile__form_field">
                                                <label class="label-text">
                                                    <input type="text" name="name" placeholder="Имя" value="<?= htmlspecialcharsbx($USER->GetFirstName()) ?>">
                                                    <span class="error"></span>
                                                </label>
                                            </div>
                                            <div class="profile__form_field">
                                                <label class="label-text">
                                                    <input type="text" name="family" placeholder="Фамилия" value="<?= htmlspecialcharsbx($USER->GetLastName()) ?>">
                                                    <span class="error"></span>
                                                </label>
                                            </div>
                                            <div class="profile__form_field">
                                                <label class="label-text">
                                                    <input type="text" name="lastnane" placeholder="Отчество" value="<?= htmlspecialcharsbx($USER->GetSecondName()) ?>">
                                                    <span class="error"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile__form_item">
                                        <div class="form_title">
                                            <div class="h6">Данные организации</div>
                                        </div>
                                        <div class="profile__form_fields">
                                            <div class="profile__form_field" style="grid-column: span 2;">
                                                <label class="label-text">
                                                    <input type="text" name="name" placeholder="Имя" value="<?= htmlspecialcharsbx($USER->GetFirstName()) ?>">
                                                    <span class="error"></span>
                                                </label>
                                            </div>
                                            <div class="profile__form_field">
                                                <label class="label-text">
                                                    <input type="text" name="family" placeholder="Фамилия" value="<?= htmlspecialcharsbx($USER->GetLastName()) ?>">
                                                    <span class="error"></span>
                                                </label>
                                            </div>
                                            <div class="profile__form_field">
                                                <label class="label-text">
                                                    <input type="text" name="lastnane" placeholder="Отчество" value="<?= htmlspecialcharsbx($USER->GetSecondName()) ?>">
                                                    <span class="error"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile__form_submit">
                                        <input type="submit" value="Изменить" class="btn btn-grey">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
<?php
}

if (defined('B_PROLOG_INCLUDED') && B_PROLOG_INCLUDED === true):
?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var animEls = document.querySelectorAll('.personal .anim-fade-in, .personal .anim-fade-in-up, .personal .anim-fade-in-left, .personal .anim-fade-in-right, .personal .anim-scale-in, .personal .anim-stagger');
            if (animEls.length) {
                var observer = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('anim-visible');
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.15
                });
                animEls.forEach(function(el) {
                    observer.observe(el);
                });
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
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

            document.addEventListener('click', function(e) {
                var btn = e.target.closest('.js-add-to-cart');
                if (!btn) return;
                e.preventDefault();
                var pid = parseInt(btn.dataset.basketId);
                if (!pid) return;
                ajax('add', {
                    id: pid,
                    quantity: 1
                }, function(res) {
                    if (res && res.success) {
                        btn.classList.add('added');
                        btn.textContent = 'В корзине';
                        var blank = document.createElement('div');
                        blank.className = 'personal__new_item';
                        blank.setAttribute('data-basket-id', pid);
                        blank.style.opacity = '0';
                        blank.style.transition = 'opacity .3s';
                        blank.innerHTML = '<div class="personal__new_item_img"></div><a class="personal__new_item_title h6">' + btn.dataset.name + '</a><div class="personal__new_item_bottom"><div class="counter"><span class="btn btn-quad light dec"><svg width="12" height="3" viewBox="0 0 12 3" fill="none"><path d="M0 3V0H12V3H0Z" fill="CurrentColor"/></svg></span><input type="text" class="btn btn-round counter_value js-cart-qty" value="1" data-basket-id="' + pid + '" inputmode="numeric"><span class="btn btn-quad light inc"><svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M5.03736 12V6.96264H0V5.02418H5.03736V0H6.97582V5.02418H12V6.96264H6.97582V12H5.03736Z" fill="CurrentColor"/></svg></span></div><button class="btn btn-quad light remove js-cart-remove" data-basket-id="' + pid + '"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 477.867 477.867" fill="CurrentColor"><path d="M443.733,68.267H324.267V51.2c0-28.277-22.923-51.2-51.2-51.2H204.8c-28.277,0-51.2,22.923-51.2,51.2v17.067H34.133c-9.426,0-17.067,7.641-17.067,17.067S24.708,102.4,34.133,102.4h18.551l32.649,359.953c0.805,8.814,8.216,15.55,17.067,15.514h273.067c8.851,0.037,16.261-6.699,17.067-15.514L425.182,102.4h18.552c9.426,0,17.067-7.641,17.067-17.067S453.159,68.267,443.733,68.267z M187.733,51.2c0-9.426,7.641-17.067,17.067-17.067h68.267c9.426,0,17.067,7.641,17.067,17.067v17.067h-102.4V51.2z M359.885,443.733H117.982L87.04,102.4h83.627h220.245L359.885,443.733z"/><path d="M187.738,391.392c-0.002-0.023-0.003-0.047-0.005-0.07l-17.067-238.933c-0.669-9.426-8.853-16.524-18.278-15.855c-9.426,0.669-16.524,8.853-15.855,18.278L153.6,393.745c0.637,8.949,8.095,15.878,17.067,15.855h1.229C181.299,408.947,188.392,400.795,187.738,391.392z"/><path d="M238.933,136.533c-9.426,0-17.067,7.641-17.067,17.067v238.933c0,9.426,7.641,17.067,17.067,17.067S256,401.959,256,392.533V153.6C256,144.174,248.359,136.533,238.933,136.533z"/><path d="M325.478,136.533c-9.426-0.669-17.609,6.429-18.278,15.855l-17.067,238.933c-0.691,9.4,6.369,17.581,15.769,18.272c0.029,0.002,0.057,0.004,0.086,0.006h1.212c8.972,0.023,16.43-6.906,17.067-15.855l17.067-238.933C342.003,145.386,334.904,137.203,325.478,136.533z"/></svg></button></div>';
                        var list = document.querySelector('#basket-root .personal__cart_list');
                        if (list) {
                            list.appendChild(blank);
                            setTimeout(function() {
                                blank.style.opacity = '1';
                            }, 50);
                        }
                        var root = document.getElementById('basket-root');
                        if (root) root.style.display = '';
                    }
                });
            });
        });
    </script>
<?php endif; ?>