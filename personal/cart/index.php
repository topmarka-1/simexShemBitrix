<?php
$isAjax = ($_SERVER["HTTP_X_BX_AJAX"] ?? "") === "Y";

if ($isAjax) {
    define("PUBLIC_AJAX_MODE", true);
    require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
} else {
    require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
}
$APPLICATION->SetTitle("Корзина");
?>
<?php $APPLICATION->IncludeComponent(
    "bitrix:sale.basket.basket",
    "my_basket",
    array(
        "COMPONENT_TEMPLATE" => "my_basket",
        "DEFERRED_REFRESH" => "N",
        "USE_DYNAMIC_SCROLL" => "Y",
        "SHOW_FILTER" => "N",
        "SHOW_RESTORE" => "Y",
        "COLUMNS_LIST_EXT" => array(
            0 => "PREVIEW_PICTURE",
            1 => "DISCOUNT",
            2 => "PROPS",
            3 => "DELETE",
            4 => "DELAY",
            5 => "SUM",
            6 => "PROPERTY_OBEM_VES_NETTO",
            7 => "PROPERTY_STANDART_ACEA",
            8 => "PROPERTY_CML2_ARTICLE",
            9 => "PROPERTY_CML2_MANUFACTURER",
            10 => "PROPERTY_KLASS_VYAZKOSTI_SAE",
            11 => "PROPERTY_EDINITSA_IZMERENIYA_OBEMA_VESA_NETTO",
            12 => "PROPERTY_SUBBREND",
        ),
        "COLUMNS_LIST_MOBILE" => array(
            0 => "PREVIEW_PICTURE",
            1 => "DISCOUNT",
            2 => "PROPS",
            3 => "DELETE",
            4 => "DELAY",
            5 => "SUM",
            6 => "PROPERTY_OBEM_VES_NETTO",
            7 => "PROPERTY_STANDART_ACEA",
            8 => "PROPERTY_CML2_ARTICLE",
            9 => "PROPERTY_CML2_MANUFACTURER",
            10 => "PROPERTY_KLASS_VYAZKOSTI_SAE",
            11 => "PROPERTY_EDINITSA_IZMERENIYA_OBEMA_VESA_NETTO",
            12 => "PROPERTY_SUBBREND",
        ),
        "TEMPLATE_THEME" => "blue",
        "TOTAL_BLOCK_DISPLAY" => array(0 => "bottom"),
        "DISPLAY_MODE" => "extended",
        "PRICE_DISPLAY_MODE" => "Y",
        "SHOW_DISCOUNT_PERCENT" => "Y",
        "DISCOUNT_PERCENT_POSITION" => "bottom-right",
        "PRODUCT_BLOCKS_ORDER" => "props,sku,columns",
        "USE_PRICE_ANIMATION" => "Y",
        "HIDE_COUPON" => "N",
        "PRICE_VAT_SHOW_VALUE" => "N",
        "USE_PREPAYMENT" => "N",
        "QUANTITY_FLOAT" => "Y",
        "CORRECT_RATIO" => "Y",
        "AUTO_CALCULATION" => "Y",
        "SET_TITLE" => "Y",
        "ACTION_VARIABLE" => "basketAction",
        "COMPATIBLE_MODE" => "Y",
        "EMPTY_BASKET_HINT_PATH" => "/",
        "BASKET_IMAGES_SCALING" => "adaptive",
        "USE_GIFTS" => "N",
        "USE_ENHANCED_ECOMMERCE" => "N",
        "PATH_TO_ORDER" => "/personal/order/make/",
    ),
    false
); ?>
<?php
if (!$isAjax) {
    require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
}
?>