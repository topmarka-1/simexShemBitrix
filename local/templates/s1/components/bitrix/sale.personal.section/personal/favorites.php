<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

$currentPage = 'favorites';
require __DIR__ . '/include/init.php';
require __DIR__ . '/include/shell_start.php';
?>
<? $APPLICATION->IncludeComponent(
    "custom:favorites.section",
    "",
    array()
); ?>
<? $APPLICATION->IncludeComponent(
    "custom:favorites.elements",
    "",
    array()
); ?>
<?php
require __DIR__ . '/include/shell_end.php';
