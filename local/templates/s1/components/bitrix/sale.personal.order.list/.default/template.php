<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

/** @var CBitrixPersonalOrderListComponent $component */
/** @var array $arParams */
/** @var array $arResult */

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;
use Bitrix\Main\Loader;
use Bitrix\Sale;

\Bitrix\Main\UI\Extension::load([
	'ui.design-tokens',
	'ui.fonts.opensans',
	'clipboard',
	'fx',
]);

Asset::getInstance()->addJs("/bitrix/components/bitrix/sale.order.payment.change/templates/.default/script.js");
Asset::getInstance()->addCss("/bitrix/components/bitrix/sale.order.payment.change/templates/.default/style.css");


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
		$status = CSaleStatus::GetByID($orderData['STATUS_ID']);
		if ($status) {
			$statusName = $status['NAME'];
		}

		$basketItems = [];
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
			'DATE_INSERT' => $orderData['DATE_INSERT']->format('j.m.Y H:i'),
			'STATUS_NAME' => $statusName,
			'BASKET_ITEMS' => $basketItems,
		];
	}
}


Loc::loadMessages(__FILE__);

if (!empty($arResult['ERRORS']['FATAL'])) {
	foreach ($arResult['ERRORS']['FATAL'] as $error) {
		ShowError($error);
	}
	$component = $this->__component;
	if ($arParams['AUTH_FORM_IN_TEMPLATE'] && isset($arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED])) {
		$APPLICATION->AuthForm('', false, false, 'N', false);
	}
} else {
	$filterHistory = ($_REQUEST['filter_history'] ?? '');
	$filterShowCanceled = ($_REQUEST["show_canceled"] ?? '');

	if (!empty($arResult['ERRORS']['NONFATAL'])) {
		foreach ($arResult['ERRORS']['NONFATAL'] as $error) {
			ShowError($error);
		}
	}
	if (empty($orders)) {
		if ($filterHistory === 'Y') {
			if ($filterShowCanceled === 'Y') {
?>
				<h3><?= Loc::getMessage('SPOL_TPL_EMPTY_CANCELED_ORDER') ?></h3>
			<?
			} else {
			?>
				<h3><?= Loc::getMessage('SPOL_TPL_EMPTY_HISTORY_ORDER_LIST') ?></h3>
			<?
			}
		} else {
			?>
			<h3><?= Loc::getMessage('SPOL_TPL_EMPTY_ORDER_LIST') ?></h3>
	<?
		}
	}
	?>
	<div class="row col-md-12 col-sm-12">
		<?
		$nothing = !isset($_REQUEST["filter_history"]) && !isset($_REQUEST["show_all"]);
		$clearFromLink = array("filter_history", "filter_status", "show_all", "show_canceled");

		if ($nothing || $filterHistory === 'N') {
		?>

		<?
		}
		if ($filterHistory === 'Y') {
		?>

			<?
			if ($filterShowCanceled === 'Y') {
			?>

			<?
			} else {
			?>

		<?
			}
		}
		?>
	</div>
	<?
	if (empty($orders)) {
	?>
		<div class="" style="display: flex; margin-top: 12px;">
			<a href="<?= htmlspecialcharsbx($arParams['PATH_TO_CATALOG']) ?>" class="sale-order-history-link btn btn-primary">
				<?= Loc::getMessage('SPOL_TPL_LINK_TO_CATALOG') ?>
			</a>
		</div>
	<?
	}

	if (!empty($orders)) { ?>
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
									<!-- <div class="history__order_pay">
										<a href="#" class="btn btn-primary">Перейти к оплате</a>
									</div> -->
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
<? }
}
