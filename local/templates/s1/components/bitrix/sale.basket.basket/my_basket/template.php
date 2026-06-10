<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

\Bitrix\Main\UI\Extension::load(["ui.fonts.ruble", "ui.fonts.opensans"]);
/** * @var array $arParams 
 *  @var array $arResult
 *  @var string $templateFolder *
 *  @var string $templateName *
 *  @var CMain $APPLICATION *
 *  @var CBitrixBasketComponent $component * 
 * @var CBitrixComponentTemplate $this * 
 * @var array $giftParameters */

$documentRoot = Main\Application::getDocumentRoot();
if (empty($arParams['TEMPLATE_THEME'])) {
    $arParams['TEMPLATE_THEME'] = Main\ModuleManager::isModuleInstalled('bitrix.eshop') ? 'site' : 'blue';
}
if ($arParams['TEMPLATE_THEME'] === 'site') {
    $templateId = Main\Config\Option::get('main', 'wizard_template_id', 'eshop_bootstrap', $component->getSiteId());
    $templateId = preg_match('/^eshop_adapt/', $templateId) ? 'eshop_adapt' : $templateId;
    $arParams['TEMPLATE_THEME'] = Main\Config\Option::get('main', 'wizard_' . $templateId . '_theme_id', 'blue', $component->getSiteId());
}
if (!empty($arParams['TEMPLATE_THEME'])) {
    if (!is_file($documentRoot . '/bitrix/css/main/themes/' . $arParams['TEMPLATE_THEME'] . '/style.css')) {
        $arParams['TEMPLATE_THEME'] = 'blue';
    }
}
if (!isset($arParams['DISPLAY_MODE']) || !in_array($arParams['DISPLAY_MODE'], array('extended', 'compact'))) {
    $arParams['DISPLAY_MODE'] = 'extended';
}
$arParams['USE_DYNAMIC_SCROLL'] = isset($arParams['USE_DYNAMIC_SCROLL']) && $arParams['USE_DYNAMIC_SCROLL'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_FILTER'] = isset($arParams['SHOW_FILTER']) && $arParams['SHOW_FILTER'] === 'N' ? 'N' : 'Y';
$arParams['PRICE_DISPLAY_MODE'] = isset($arParams['PRICE_DISPLAY_MODE']) && $arParams['PRICE_DISPLAY_MODE'] === 'N' ? 'N' : 'Y';
if (!isset($arParams['TOTAL_BLOCK_DISPLAY']) || !is_array($arParams['TOTAL_BLOCK_DISPLAY'])) {
    $arParams['TOTAL_BLOCK_DISPLAY'] = array('top');
}
if (empty($arParams['PRODUCT_BLOCKS_ORDER'])) {
    $arParams['PRODUCT_BLOCKS_ORDER'] = 'props,sku,columns';
}
if (is_string($arParams['PRODUCT_BLOCKS_ORDER'])) {
    $arParams['PRODUCT_BLOCKS_ORDER'] = explode(',', $arParams['PRODUCT_BLOCKS_ORDER']);
}
$arParams['USE_PRICE_ANIMATION'] = isset($arParams['USE_PRICE_ANIMATION']) && $arParams['USE_PRICE_ANIMATION'] === 'N' ? 'N' : 'Y';
$arParams['EMPTY_BASKET_HINT_PATH'] = isset($arParams['EMPTY_BASKET_HINT_PATH']) ? (string)$arParams['EMPTY_BASKET_HINT_PATH'] : '/';
$arParams['USE_ENHANCED_ECOMMERCE'] = isset($arParams['USE_ENHANCED_ECOMMERCE']) && $arParams['USE_ENHANCED_ECOMMERCE'] === 'Y' ? 'Y' : 'N';
$arParams['DATA_LAYER_NAME'] = isset($arParams['DATA_LAYER_NAME']) ? trim($arParams['DATA_LAYER_NAME']) : 'dataLayer';
$arParams['BRAND_PROPERTY'] = isset($arParams['BRAND_PROPERTY']) ? trim($arParams['BRAND_PROPERTY']) : '';
if ($arParams['USE_GIFTS'] === 'Y') {
    $arParams['GIFTS_BLOCK_TITLE'] = isset($arParams['GIFTS_BLOCK_TITLE']) ? trim((string)$arParams['GIFTS_BLOCK_TITLE']) : Loc::getMessage('SBB_GIFTS_BLOCK_TITLE');
    CBitrixComponent::includeComponentClass('bitrix:sale.products.gift.basket');
    $giftParameters = array('SHOW_PRICE_COUNT' => 1,        'PRODUCT_SUBSCRIPTION' => 'N',        'PRODUCT_ID_VARIABLE' => 'id',        'USE_PRODUCT_QUANTITY' => 'N',        'ACTION_VARIABLE' => 'actionGift',        'ADD_PROPERTIES_TO_BASKET' => 'Y',        'PARTIAL_PRODUCT_PROPERTIES' => 'Y',        'BASKET_URL' => $APPLICATION->GetCurPage(),        'APPLIED_DISCOUNT_LIST' => $arResult['APPLIED_DISCOUNT_LIST'],        'FULL_DISCOUNT_LIST' => $arResult['FULL_DISCOUNT_LIST'],        'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],        'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_SHOW_VALUE'],        'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],        'BLOCK_TITLE' => $arParams['GIFTS_BLOCK_TITLE'] ?? '',        'HIDE_BLOCK_TITLE' => $arParams['GIFTS_HIDE_BLOCK_TITLE'] ?? '',        'TEXT_LABEL_GIFT' => $arParams['GIFTS_TEXT_LABEL_GIFT'] ?? '',        'DETAIL_URL' => $arParams['GIFTS_DETAIL_URL'] ?? null,        'PRODUCT_QUANTITY_VARIABLE' => $arParams['GIFTS_PRODUCT_QUANTITY_VARIABLE'] ?? '',        'PRODUCT_PROPS_VARIABLE' => $arParams['GIFTS_PRODUCT_PROPS_VARIABLE'] ?? '',        'SHOW_OLD_PRICE' => $arParams['GIFTS_SHOW_OLD_PRICE'] ?? '',        'SHOW_DISCOUNT_PERCENT' => $arParams['GIFTS_SHOW_DISCOUNT_PERCENT'] ?? '',        'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'] ?? '',        'MESS_BTN_BUY' => $arParams['GIFTS_MESS_BTN_BUY'] ?? '',        'MESS_BTN_DETAIL' => $arParams['GIFTS_MESS_BTN_DETAIL'] ?? '',        'CONVERT_CURRENCY' => $arParams['GIFTS_CONVERT_CURRENCY'] ?? '',        'HIDE_NOT_AVAILABLE' => $arParams['GIFTS_HIDE_NOT_AVAILABLE'] ?? '',        'PRODUCT_ROW_VARIANTS' => '',        'PAGE_ELEMENT_COUNT' => 0,        'DEFERRED_PRODUCT_ROW_VARIANTS' => \Bitrix\Main\Web\Json::encode(SaleProductsGiftBasketComponent::predictRowVariants($arParams['GIFTS_PAGE_ELEMENT_COUNT'],                $arParams['GIFTS_PAGE_ELEMENT_COUNT'])),        'DEFERRED_PAGE_ELEMENT_COUNT' => $arParams['GIFTS_PAGE_ELEMENT_COUNT'],        'ADD_TO_BASKET_ACTION' => 'BUY',        'PRODUCT_DISPLAY_MODE' => 'Y',        'PRODUCT_BLOCKS_ORDER' => isset($arParams['GIFTS_PRODUCT_BLOCKS_ORDER']) ? $arParams['GIFTS_PRODUCT_BLOCKS_ORDER'] : '',        'SHOW_SLIDER' => isset($arParams['GIFTS_SHOW_SLIDER']) ? $arParams['GIFTS_SHOW_SLIDER'] : '',        'SLIDER_INTERVAL' => isset($arParams['GIFTS_SLIDER_INTERVAL']) ? $arParams['GIFTS_SLIDER_INTERVAL'] : '',        'SLIDER_PROGRESS' => isset($arParams['GIFTS_SLIDER_PROGRESS']) ? $arParams['GIFTS_SLIDER_PROGRESS'] : '',        'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],        'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],        'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],        'BRAND_PROPERTY' => $arParams['BRAND_PROPERTY']);
}
\CJSCore::Init(array('fx', 'popup', 'ajax'));
Main\UI\Extension::load(['ui.mustache']);
$this->addExternalCss('/bitrix/css/main/bootstrap.css');
$this->addExternalCss($templateFolder . '/themes/' . $arParams['TEMPLATE_THEME'] . '/style.css');
$this->addExternalJs($templateFolder . '/js/action-pool.js');
$this->addExternalJs($templateFolder . '/js/filter.js');
$this->addExternalJs($templateFolder . '/js/component.js');
$mobileColumns = isset($arParams['COLUMNS_LIST_MOBILE'])    ? $arParams['COLUMNS_LIST_MOBILE']    : $arParams['COLUMNS_LIST'];
$mobileColumns = array_fill_keys($mobileColumns, true);
$jsTemplates = new Main\IO\Directory($documentRoot . $templateFolder . '/js-templates');
/** @var Main\IO\File $jsTemplate */ foreach ($jsTemplates->getChildren() as $jsTemplate) {
    include($jsTemplate->getPath());
}
$displayModeClass = $arParams['DISPLAY_MODE'] === 'compact' ? ' basket-items-list-wrapper-compact' : '';
if (empty($arResult['ERROR_MESSAGE'])) {
    if ($arParams['USE_GIFTS'] === 'Y' && $arParams['GIFTS_PLACE'] === 'TOP') {        ?> <div data-entity="parent-container">
            <div class="catalog-block-header" data-entity="header" data-showed="false" style="display: none; opacity: 0;"> <?= $arParams['GIFTS_BLOCK_TITLE'] ?> </div>
            <? $APPLICATION->IncludeComponent('bitrix:sale.products.gift.basket',                '.default',                $giftParameters,                $component);            ?>
        </div>
    <?    }
    if ($arResult['BASKET_ITEM_MAX_COUNT_EXCEEDED']) {        ?>
        <div id="basket-item-message"> <?= Loc::getMessage('SBB_BASKET_ITEM_MAX_COUNT_EXCEEDED', array('#PATH#' => $arParams['PATH_TO_BASKET'])) ?> </div>
    <?    }    ?>
    <section class="section catalog-cart section-gray" id="catalog-cart">
        <div class="container">
            <div class="heading">
                <h1 class="h2"><? $APPLICATION->ShowTitle() ?></h1>
            </div>
            <div class="catalog-cart__container">
                <div class="catalog-cart__content">
                    <div id="basket-root" class="bx-basket bx-<?= $arParams['TEMPLATE_THEME'] ?> bx-step-opacity" style="opacity: 0;">
                        <? if ($arParams['BASKET_WITH_ORDER_INTEGRATION'] !== 'Y'                            && in_array('top', $arParams['TOTAL_BLOCK_DISPLAY'])) {                            ?>
                            <div data-entity="basket-total-block"></div>
                        <?                        }                        ?>
                        <div class="alert alert-warning alert-dismissable" id="basket-warning" style="display: none;"> <span class="close" data-entity="basket-items-warning-notification-close">&times;</span>
                            <div data-entity="basket-general-warnings"></div>
                            <div data-entity="basket-item-warnings"> <?= Loc::getMessage('SBB_BASKET_ITEM_WARNING') ?> </div>
                        </div>
                        <!-- <div class="catalog-cart__content_top">
                            <div class="search_label" data-entity="basket-filter"> <input type="text" placeholder="<?= Loc::getMessage('SBB_BASKET_FILTER') ?>" data-entity="basket-filter-input"> <span class="icon" data-entity="basket-filter-clear-btn"> <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.25 15.25L10.75 10.75M12.25 7C12.25 9.89949 9.89949 12.25 7 12.25C4.10051 12.25 1.75 9.89949 1.75 7C1.75 4.10051 4.10051 1.75 7 1.75C9.89949 1.75 12.25 4.10051 12.25 7Z" stroke="#7A7C81" stroke-width="2" stroke-linecap="round" />
                                    </svg> </span> </div>
                            <div class="basket-items-list-header-filter catalog-cart__content_builds" data-entity="basket-items-list-header"> <a href="javascript:void(0)" class="basket-items-list-header-filter-item active" data-entity="basket-items-count" data-filter="all" style="display: none;"></a> <a href="javascript:void(0)" class="basket-items-list-header-filter-item" data-entity="basket-items-count" data-filter="similar" style="display: none;"></a> <a href="javascript:void(0)" class="basket-items-list-header-filter-item" data-entity="basket-items-count" data-filter="warning" style="display: none;"></a> <a href="javascript:void(0)" class="basket-items-list-header-filter-item" data-entity="basket-items-count" data-filter="delayed" style="display: none;"></a> <a href="javascript:void(0)" class="basket-items-list-header-filter-item" data-entity="basket-items-count" data-filter="not-available" style="display: none;"></a> </div>
                        </div> -->
                        <div class="basket-items-list-container" id="basket-items-list-container">
                            <div class="basket-items-list-overlay" id="basket-items-list-overlay" style="display: none;"></div>
                            <div class="basket-items-list" id="basket-item-list">
                                <div class="basket-search-not-found" id="basket-item-list-empty-result" style="display: none;">
                                    <div class="basket-search-not-found-icon"></div>
                                    <div class="basket-search-not-found-text"> <?= Loc::getMessage('SBB_FILTER_EMPTY_RESULT') ?> </div>
                                </div>
                                <div class="catalog-cart__list" id="basket-item-table"></div>
                            </div>
                        </div>
                        <? if ($arParams['BASKET_WITH_ORDER_INTEGRATION'] !== 'Y'                            && in_array('bottom', $arParams['TOTAL_BLOCK_DISPLAY'])) {                            ?>
                            <div data-entity="basket-total-block"></div>
                        <?                        }                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <? if (!empty($arResult['CURRENCIES']) && Main\Loader::includeModule('currency')) {
        CJSCore::Init('currency');        ?>
        <script>
            BX.Currency.setCurrencies(<?= CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true) ?>);
        </script>
    <?    }
    $signer = new \Bitrix\Main\Security\Sign\Signer;
    $signedTemplate = $signer->sign($templateName, 'sale.basket.basket');
    $signedParams = $signer->sign(base64_encode(serialize($arParams)), 'sale.basket.basket');
    $messages = Loc::loadLanguageFile(__FILE__);    ?>
    <script>
        BX.message(<?= CUtil::PhpToJSObject($messages) ?>);
        BX.Sale.BasketComponent.init({
            result: <?= CUtil::PhpToJSObject($arResult, false, false, true) ?>,
            params: <?= CUtil::PhpToJSObject($arParams) ?>,
            template: '<?= CUtil::JSEscape($signedTemplate) ?>',
            signedParamsString: '<?= CUtil::JSEscape($signedParams) ?>',
            siteId: '<?= CUtil::JSEscape($component->getSiteId()) ?>',
            siteTemplateId: '<?= CUtil::JSEscape($component->getSiteTemplateId()) ?>',
            templateFolder: '<?= CUtil::JSEscape($templateFolder) ?>'
        });
    </script>
    <? if ($arParams['USE_GIFTS'] === 'Y' && $arParams['GIFTS_PLACE'] === 'BOTTOM') {        ?>
        <div data-entity="parent-container">
            <div class="catalog-block-header" data-entity="header" data-showed="false" style="display: none; opacity: 0;"> <?= $arParams['GIFTS_BLOCK_TITLE'] ?> </div>
            <? $APPLICATION->IncludeComponent('bitrix:sale.products.gift.basket',                '.default',                $giftParameters,                $component);            ?>
        </div>
<?    }
} elseif ($arResult['EMPTY_BASKET']) {
    include(Main\Application::getDocumentRoot() . $templateFolder . '/empty.php');
} else {
    ShowError($arResult['ERROR_MESSAGE']);
} ?>

<? $APPLICATION->IncludeFile(
    SITE_TEMPLATE_PATH . '/include/getCatalog.php',
    [],
    [
        'MODE'      => 'php',
    ]
); ?>
<?php
$APPLICATION->IncludeComponent(
    "bitrix:catalog.section",
    "orders_histiry",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "IBLOCK_TYPE" => "catalog",    // Тип инфоблока
        "IBLOCK_ID" => "14",    // Инфоблок
        "ELEMENT_SORT_FIELD" => "sort",    // По какому полю сортируем элементы
        "ELEMENT_SORT_ORDER" => "asc",    // Порядок сортировки элементов
        "FILTER_NAME" => "arrPurchasedFilter",    // Имя массива со значениями фильтра для фильтрации элементов
        "PRICE_CODE" => "",    // Тип цены
        "PAGE_ELEMENT_COUNT" => "4",    // Количество элементов на странице
        "LINE_ELEMENT_COUNT" => "4",    // Количество элементов выводимых в одной строке таблицы
        "CACHE_TYPE" => "A",    // Тип кеширования
        "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
        "CACHE_FILTER" => "Y",    // Кешировать при установленном фильтре
        "CACHE_GROUPS" => "Y",    // Учитывать права доступа
        "SHOW_OLD_PRICE" => "Y",    // Показывать старую цену
        "CONVERT_CURRENCY" => "Y",    // Показывать цены в одной валюте
        "CURRENCY_ID" => "RUB",    // Валюта, в которую будут сконвертированы цены
        "SECTION_ID" => $_REQUEST["SECTION_ID"],    // ID раздела
        "SECTION_CODE" => "",    // Код раздела
        "SECTION_USER_FIELDS" => array(    // Свойства раздела
            0 => "",
            1 => "",
        ),
        "INCLUDE_SUBSECTIONS" => "Y",    // Показывать элементы подразделов раздела
        "SHOW_ALL_WO_SECTION" => "N",    // Показывать все элементы, если не указан раздел
        "CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",    // Фильтр товаров
        "HIDE_NOT_AVAILABLE" => "N",    // Недоступные товары
        "HIDE_NOT_AVAILABLE_OFFERS" => "N",    // Недоступные торговые предложения
        "ELEMENT_SORT_FIELD2" => "id",    // Поле для второй сортировки элементов
        "ELEMENT_SORT_ORDER2" => "desc",    // Порядок второй сортировки элементов
        "PROPERTY_CODE_MOBILE" => "",    // Свойства товаров, отображаемые на мобильных устройствах
        "BACKGROUND_IMAGE" => "-",    // Установить фоновую картинку для шаблона из свойства
        "TEMPLATE_THEME" => "blue",    // Цветовая тема
        "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'3','BIG_DATA':false}]",    // Вариант отображения товаров
        "ENLARGE_PRODUCT" => "STRICT",    // Выделять товары в списке
        "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",    // Порядок отображения блоков товара
        "SHOW_SLIDER" => "Y",    // Показывать слайдер для товаров
        "SLIDER_INTERVAL" => "3000",    // Интервал смены слайдов, мс
        "SLIDER_PROGRESS" => "N",    // Показывать полосу прогресса
        "ADD_PICT_PROP" => "-",    // Дополнительная картинка основного товара
        "LABEL_PROP" => "",    // Свойства меток товара
        "PRODUCT_SUBSCRIPTION" => "Y",    // Разрешить оповещения для отсутствующих товаров
        "SHOW_DISCOUNT_PERCENT" => "N",    // Показывать процент скидки
        "SHOW_MAX_QUANTITY" => "N",    // Показывать остаток товара
        "SHOW_CLOSE_POPUP" => "N",    // Показывать кнопку продолжения покупок во всплывающих окнах
        "MESS_BTN_BUY" => "Купить",    // Текст кнопки "Купить"
        "MESS_BTN_ADD_TO_BASKET" => "В корзину",    // Текст кнопки "Добавить в корзину"
        "MESS_BTN_SUBSCRIBE" => "Подписаться",    // Текст кнопки "Уведомить о поступлении"
        "MESS_BTN_DETAIL" => "Подробнее",    // Текст кнопки "Подробнее"
        "MESS_NOT_AVAILABLE" => "Нет в наличии",    // Сообщение об отсутствии товара
        "MESS_NOT_AVAILABLE_SERVICE" => "Недоступно",    // Сообщение о недоступности услуги
        "SECTION_URL" => "",    // URL, ведущий на страницу с содержимым раздела
        "DETAIL_URL" => "",    // URL, ведущий на страницу с содержимым элемента раздела
        "SECTION_ID_VARIABLE" => "SECTION_ID",    // Название переменной, в которой передается код группы
        "SEF_MODE" => "N",    // Включить поддержку ЧПУ
        "AJAX_MODE" => "N",    // Включить режим AJAX
        "AJAX_OPTION_JUMP" => "N",    // Включить прокрутку к началу компонента
        "AJAX_OPTION_STYLE" => "Y",    // Включить подгрузку стилей
        "AJAX_OPTION_HISTORY" => "N",    // Включить эмуляцию навигации браузера
        "AJAX_OPTION_ADDITIONAL" => "",    // Дополнительный идентификатор
        "SET_TITLE" => "Y",    // Устанавливать заголовок страницы
        "SET_BROWSER_TITLE" => "Y",    // Устанавливать заголовок окна браузера
        "BROWSER_TITLE" => "-",    // Установить заголовок окна браузера из свойства
        "SET_META_KEYWORDS" => "Y",    // Устанавливать ключевые слова страницы
        "META_KEYWORDS" => "-",    // Установить ключевые слова страницы из свойства
        "SET_META_DESCRIPTION" => "Y",    // Устанавливать описание страницы
        "META_DESCRIPTION" => "-",    // Установить описание страницы из свойства
        "SET_LAST_MODIFIED" => "N",    // Устанавливать в заголовках ответа время модификации страницы
        "USE_MAIN_ELEMENT_SECTION" => "N",    // Использовать основной раздел для показа элемента
        "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
        "ACTION_VARIABLE" => "action",    // Название переменной, в которой передается действие
        "PRODUCT_ID_VARIABLE" => "id",    // Название переменной, в которой передается код товара для покупки
        "USE_PRICE_COUNT" => "N",    // Использовать вывод цен с диапазонами
        "SHOW_PRICE_COUNT" => "1",    // Выводить цены для количества
        "PRICE_VAT_INCLUDE" => "Y",    // Включать НДС в цену
        "BASKET_URL" => "/personal/basket.php",    // URL, ведущий на страницу с корзиной покупателя
        "USE_PRODUCT_QUANTITY" => "N",    // Разрешить указание количества товара
        "PRODUCT_QUANTITY_VARIABLE" => "quantity",    // Название переменной, в которой передается количество товара
        "ADD_PROPERTIES_TO_BASKET" => "Y",    // Добавлять в корзину свойства товаров и предложений
        "PRODUCT_PROPS_VARIABLE" => "prop",    // Название переменной, в которой передаются характеристики товара
        "PARTIAL_PRODUCT_PROPERTIES" => "N",    // Разрешить добавлять в корзину товары, у которых заполнены не все характеристики
        "ADD_TO_BASKET_ACTION" => "ADD",    // Показывать кнопку добавления в корзину или покупки
        "DISPLAY_COMPARE" => "N",    // Разрешить сравнение товаров
        "USE_ENHANCED_ECOMMERCE" => "N",    // Отправлять данные электронной торговли в Google и Яндекс
        "PAGER_TEMPLATE" => ".default",    // Шаблон постраничной навигации
        "DISPLAY_TOP_PAGER" => "N",    // Выводить над списком
        "DISPLAY_BOTTOM_PAGER" => "Y",    // Выводить под списком
        "PAGER_TITLE" => "Товары",    // Название категорий
        "PAGER_SHOW_ALWAYS" => "N",    // Выводить всегда
        "PAGER_DESC_NUMBERING" => "N",    // Использовать обратную навигацию
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",    // Время кеширования страниц для обратной навигации
        "PAGER_SHOW_ALL" => "N",    // Показывать ссылку "Все"
        "PAGER_BASE_LINK_ENABLE" => "N",    // Включить обработку ссылок
        "LAZY_LOAD" => "N",    // Показать кнопку ленивой загрузки Lazy Load
        "MESS_BTN_LAZY_LOAD" => "Показать ещё",    // Текст кнопки "Показать ещё"
        "LOAD_ON_SCROLL" => "N",    // Подгружать товары при прокрутке до конца
        "SET_STATUS_404" => "N",    // Устанавливать статус 404
        "SHOW_404" => "N",    // Показ специальной страницы
        "MESSAGE_404" => "",    // Сообщение для показа (по умолчанию из компонента)
        "COMPATIBLE_MODE" => "N",    // Включить режим совместимости
        "DISABLE_INIT_JS_IN_COMPONENT" => "N",    // Не подключать js-библиотеки в компоненте
    ),
    false
);
?>