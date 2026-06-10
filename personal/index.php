<?php
$isAjax = ($_SERVER["HTTP_X_BX_AJAX"] ?? "") === "Y";

if ($isAjax) {
    define("PUBLIC_AJAX_MODE", true);
    require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
} else {
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
}
$APPLICATION->SetTitle("Персональный раздел");
?>
<?php $APPLICATION->IncludeComponent(
    "bitrix:sale.personal.section", 
    "personal", 
    Array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "3600",
        "CACHE_TYPE" => "N",
        "CHECK_RIGHTS_PRIVATE" => "N",
        "CUSTOM_PAGES" => "",
        "CUSTOM_SELECT_PROPS" => "",
        "MAIN_CHAIN_NAME" => "Мой кабинет",
        "NAV_TEMPLATE" => "",
        "ORDERS_PER_PAGE" => "20",
        "ORDER_DEFAULT_SORT" => "STATUS",
        "ORDER_DISALLOW_CANCEL" => "N",
        "ORDER_HIDE_USER_INFO" => array(0 => "0"),
        "ORDER_HISTORIC_STATUSES" => array(0 => "F"),
        "ORDER_REFRESH_PRICES" => "N",
        "ORDER_RESTRICT_CHANGE_PAYSYSTEM" => array(0 => "0"),
        "PATH_TO_BASKET" => "/personal/cart/",
        "PATH_TO_CATALOG" => "/catalog/",
        "PATH_TO_CONTACT" => "/about/contacts/",
        "PATH_TO_PAYMENT" => "/personal/order/payment/",
        "SAVE_IN_SESSION" => "Y",
        "SEF_FOLDER" => "/personal/",
        "SEF_MODE" => "Y",
        "SEND_INFO_PRIVATE" => "N",
        "SET_TITLE" => "Y",
        "SHOW_ACCOUNT_PAGE" => "Y",
        "SHOW_BASKET_PAGE" => "Y",
        "SHOW_CONTACT_PAGE" => "N",
        "SHOW_ORDER_PAGE" => "Y",
        "SHOW_PRIVATE_PAGE" => "Y",
        "SHOW_PROFILE_PAGE" => "Y",
        "SHOW_SUBSCRIBE_PAGE" => "Y",
        "COMPONENT_TEMPLATE" => "personal",
        "SEF_URL_TEMPLATES" => array(
            "index" => "index.php",
            "orders" => "orders/",
            "account" => "account/",
            "subscribe" => "subscribe/",
            "profile" => "profiles/",
            "profile_detail" => "profiles/#ID#",
            "private" => "private/",
            "order_detail" => "orders/#ID#",
            "order_cancel" => "cancel/#ID#",
        )
    ),
    false
);?>
<?php
if (!$isAjax) {
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
}
?>