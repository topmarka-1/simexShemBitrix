<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Localization\Loc;

if ($arParams['SHOW_PROFILE_PAGE'] !== 'Y')
{
    LocalRedirect($arParams['SEF_FOLDER']);
}

$currentPage = 'private';
require __DIR__ . '/include/init.php';
require __DIR__ . '/include/shell_start.php';

$APPLICATION->IncludeComponent(
    "bitrix:sale.personal.profile.list",
    "",
    [
        "PATH_TO_DETAIL" => $arResult['PATH_TO_PROFILE_DETAIL'],
        "PATH_TO_DELETE" => $arResult['PATH_TO_PROFILE_DELETE'],
        "PER_PAGE" => $arParams["PROFILES_PER_PAGE"],
        "SET_TITLE" =>$arParams["SET_TITLE"],
    ],
    $component
);

require __DIR__ . '/include/shell_end.php';
