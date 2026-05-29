<?
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/includeStyles/getCatalog.css");
?>
<section class="section section-white section-round-bottom get-catalog anim-fade-in-up">
    <div class="container">
        <div class="get-catalog__content">
            <div class="heading anim-fade-in-left">
                <h2>Получите полный каталог
                и получите скидку<br>
                на первый заказ</h2>
            </div>
            <div class="get-catalog__image">
                <img src="<?=SITE_TEMPLATE_PATH?>/assets/img/presentation-image1.png" alt="">
            </div>
            <div class="get-catalog__form_container">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:form",
                    "getCatalog",
                    Array(
                        "AJAX_MODE" => "Y",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "CACHE_TIME" => "3600",
                        "CACHE_TYPE" => "A",
                        "CHAIN_ITEM_LINK" => "",
                        "CHAIN_ITEM_TEXT" => "",
                        "EDIT_ADDITIONAL" => "N",
                        "EDIT_STATUS" => "Y",
                        "IGNORE_CUSTOM_TEMPLATE" => "N",
                        "NAME_TEMPLATE" => "",
                        "NOT_SHOW_FILTER" => array("",""),
                        "NOT_SHOW_TABLE" => array("",""),
                        "RESULT_ID" => $_REQUEST["RESULT_ID"],
                        "SEF_MODE" => "N",
                        "SHOW_ADDITIONAL" => "N",
                        "SHOW_ANSWER_VALUE" => "N",
                        "SHOW_EDIT_PAGE" => "Y",
                        "SHOW_LIST_PAGE" => "Y",
                        "SHOW_STATUS" => "Y",
                        "SHOW_VIEW_PAGE" => "Y",
                        "START_PAGE" => "new",
                        "SUCCESS_URL" => "",
                        "USE_EXTENDED_ERRORS" => "N",
                        "VARIABLE_ALIASES" => Array("action"=>"action"),
                        "WEB_FORM_ID" => "3"
                    )
                );?>
            </div>
        </div>
    </div>
</section>