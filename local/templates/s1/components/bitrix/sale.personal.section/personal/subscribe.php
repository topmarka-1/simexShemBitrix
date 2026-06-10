<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Localization\Loc;

if ($arParams['SHOW_SUBSCRIBE_PAGE'] !== 'Y')
{
    LocalRedirect($arParams['SEF_FOLDER']);
}

$currentPage = 'private';
require __DIR__ . '/include/init.php';
require __DIR__ . '/include/shell_start.php';

$APPLICATION->IncludeComponent(
    'bitrix:catalog.product.subscribe.list',
    '',
    array(
        'SET_TITLE' => $arParams['SET_TITLE'],
        'DETAIL_URL' => $arParams['SUBSCRIBE_DETAIL_URL']
    ),
    $component
);

require __DIR__ . '/include/shell_end.php';
