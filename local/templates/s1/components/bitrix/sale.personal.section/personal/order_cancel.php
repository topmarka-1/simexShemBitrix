<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Localization\Loc;

if ($arParams['SHOW_ORDER_PAGE'] !== 'Y')
{
    LocalRedirect($arParams['SEF_FOLDER']);
}
elseif ($arParams['ORDER_DISALLOW_CANCEL'] === 'Y')
{
    LocalRedirect($arResult['PATH_TO_ORDERS']);
}

$currentPage = 'orders';
require __DIR__ . '/include/init.php';
require __DIR__ . '/include/shell_start.php';

$APPLICATION->IncludeComponent(
    "bitrix:sale.personal.order.cancel",
    "",
    array(
        "PATH_TO_LIST" => $arResult["PATH_TO_ORDERS"],
        "PATH_TO_DETAIL" => $arResult["PATH_TO_ORDER_DETAIL"],
        "SET_TITLE" =>$arParams["SET_TITLE"],
        "ID" => $arResult["VARIABLES"]["ID"],
    ),
    $component
);

require __DIR__ . '/include/shell_end.php';
