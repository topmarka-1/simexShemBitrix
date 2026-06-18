<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

/**
 * @var array $arParams
 * @var array $arResult
 * @var SaleOrderAjax $component
 */

$arParams['SERVICES_IMAGES_SCALING'] = (string)($arParams['SERVICES_IMAGES_SCALING'] ?? 'adaptive');

$component = $this->__component;
$component::scaleImages($arResult['JS_DATA'], $arParams['SERVICES_IMAGES_SCALING']);

// Принудительно убираем стоимость доставки и ошибки расчёта
if (!empty($arResult['JS_DATA']['DELIVERY']))
{
	foreach ($arResult['JS_DATA']['DELIVERY'] as &$delivery)
	{
		$delivery['PRICE'] = 0;
		$delivery['PRICE_FORMATED'] = 'бесплатно';
		$delivery['DELIVERY_DISCOUNT_PRICE'] = 0;
		$delivery['DELIVERY_DISCOUNT_PRICE_FORMATED'] = 'бесплатно';
		$delivery['CALCULATE_ERRORS'] = false;
		$delivery['CALCULATE_DESCRIPTION'] = '';
	}
	unset($delivery);
}

if (!empty($arResult['JS_DATA']['TOTAL']))
{
	$arResult['JS_DATA']['TOTAL']['DELIVERY_PRICE'] = 0;
	$arResult['JS_DATA']['TOTAL']['DELIVERY_PRICE_FORMATED'] = 'бесплатно';
	$arResult['JS_DATA']['TOTAL']['PAY_SYSTEM_PRICE'] = 0;
	$arResult['JS_DATA']['TOTAL']['PAY_SYSTEM_PRICE_FORMATTED'] = 'бесплатно';
}

// Убираем блок оплаты из JS-данных (скрываем визуально, сервер найдёт платёжку в БД)
$arResult['JS_DATA']['PAY_SYSTEM'] = [];
unset($arResult['JS_DATA']['PAY_FROM_ACCOUNT']);

// Очищаем ошибки, связанные с доставкой
if (!empty($arResult['ERROR']) && is_array($arResult['ERROR']))
{
	unset($arResult['ERROR']['MAIN']);
	unset($arResult['ERROR']['DELIVERY']);
	unset($arResult['ERROR']['PAY_SYSTEM']);
}

if (!empty($arResult['JS_DATA']['ERROR']) && is_array($arResult['JS_DATA']['ERROR']))
{
	unset($arResult['JS_DATA']['ERROR']['MAIN']);
	unset($arResult['JS_DATA']['ERROR']['DELIVERY']);
	unset($arResult['JS_DATA']['ERROR']['PAY_SYSTEM']);
}
