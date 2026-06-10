<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

if ($arParams['SHOW_PRIVATE_PAGE'] !== 'Y') {
    LocalRedirect($arParams['SEF_FOLDER']);
}

$currentPage = 'private';
require __DIR__ . '/include/init.php';
require __DIR__ . '/include/shell_start.php';

$APPLICATION->IncludeComponent(
    "bitrix:main.profile",
    "my_profile",
    array(
        "SET_TITLE" => $arParams["SET_TITLE"],
        "AJAX_MODE" => $arParams['AJAX_MODE_PRIVATE'],
        "SEND_INFO" => $arParams["SEND_INFO_PRIVATE"],
        "CHECK_RIGHTS" => $arParams['CHECK_RIGHTS_PRIVATE'],
        "EDITABLE_EXTERNAL_AUTH_ID" => $arParams['EDITABLE_EXTERNAL_AUTH_ID'],
    ),
    $component
);

require __DIR__ . '/include/shell_end.php';
