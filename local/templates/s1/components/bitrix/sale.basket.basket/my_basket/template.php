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
$sefFolder = rtrim($arParams['SEF_FOLDER'] ?? '/personal/', '/');

$currentPage = 'cart';

$navLinks = [
    'index' => [
        'url' => $sefFolder . '/',
        'label' => 'Профиль',
        'ajax' => true,
        'icon' => '<svg width="24" height="24" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12.7362 4.70588C12.7362 2.1069 10.6157 0 8.00003 0C5.38426 0 3.26379 2.1069 3.26379 4.70588C3.26379 6.0835 3.85976 7.32252 4.80831 8.1827C2.24288 9.28448 0.368483 11.6735 0.0104673 14.532C-0.0942123 15.3677 0.602597 16 1.3693 16H14.6307C15.3974 16 16.0942 15.3677 15.9895 14.532C15.6315 11.6735 13.7571 9.28449 11.1917 8.18271C12.1402 7.32253 12.7362 6.0835 12.7362 4.70588ZM9.74343 8.38513C9.72003 8.20113 9.80756 8.02071 9.96698 7.92424C11.0605 7.26287 11.789 6.0687 11.789 4.70588C11.789 2.62669 10.0926 0.941176 8.00003 0.941176C5.9074 0.941176 4.21103 2.62669 4.21103 4.70588C4.21103 6.06871 4.93953 7.26287 6.03298 7.92424C6.19241 8.02071 6.27993 8.20113 6.25663 8.38513C6.23324 8.56904 6.10336 8.72226 5.92484 8.77638C3.28638 9.57572 1.29961 11.8605 0.950452 14.6482C0.925919 14.8441 1.08973 15.0588 1.3693 15.0588H14.6307C14.9102 15.0588 15.074 14.8441 15.0495 14.6482C14.7003 11.8605 12.7136 9.57572 10.0752 8.77638C9.8966 8.72226 9.76673 8.56904 9.74343 8.38513Z"
                                            fill="CurrentColor" />
                                    </svg>',
    ],
    'orders' => [
        'url' => $arResult['PATH_TO_ORDERS'] ?? ($sefFolder . '/orders/'),
        'label' => 'История',
        'ajax' => true,
        'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12.09 0.00576212C10.0636 -0.0172722 8.06447 0.50817 6.2767 1.53368C4.48892 2.55918 2.97004 4.05177 1.86 5.87391V1.60177H0V7.16361C0.00780682 7.6512 0.19252 8.11622 0.514761 8.45954C0.837002 8.80286 1.27128 8.99731 1.725 9.00144H6.885V7.0024H3.405C4.34117 5.44788 5.62897 4.174 7.14789 3.29997C8.66681 2.42594 10.3672 1.98031 12.09 2.0048C14.6533 1.90871 17.148 2.90539 19.0305 4.77763C20.9131 6.64988 22.0307 9.24592 22.14 12C22.0307 14.7541 20.9131 17.3501 19.0305 19.2224C17.148 21.0946 14.6533 22.0913 12.09 21.9952C9.5267 22.0913 7.03196 21.0946 5.14945 19.2224C3.26694 17.3501 2.14927 14.7541 2.04 12H0.18C0.285706 15.2857 1.59829 18.3925 3.83044 20.6404C6.06258 22.8883 9.03246 24.0943 12.09 23.9942C15.1475 24.0943 18.1174 22.8883 20.3496 20.6404C22.5817 18.3925 23.8943 15.2857 24 12C23.8943 8.71435 22.5817 5.60752 20.3496 3.35959C18.1174 1.11166 15.1475 -0.0942757 12.09 0.00576212Z"
                                            fill="CurrentColor" />
                                        <path d="M11.16 6.00288V12.9995H16.56V11.0005H13.02V6.00288H11.16Z"
                                            fill="CurrentColor" />
                                    </svg>',
    ],
    'favorites' => [
        'url' => $sefFolder . '/favorites/',
        'label' => 'Избранное',
        'ajax' => true,
        'icon' => '<svg width="26" height="24" viewBox="0 0 17 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8.49339 1.30609C7.59211 0.493411 6.40643 0 5.10752 0C2.28671 0 0 2.32698 0 5.19746C0 6.51927 0.478257 7.73256 1.27688 8.6497L8.5 16L15.5093 8.8673L15.7165 8.64301C16.5151 7.72577 17 6.51927 17 5.19746C17 2.32698 14.7133 0 11.8924 0C10.5935 0 9.40789 0.493411 8.50661 1.3061L8.5 1.29937L8.49339 1.30609ZM8.5 3.24788L8.55185 3.29459L9.35746 2.47474L9.44142 2.39902C10.0931 1.81145 10.9491 1.45455 11.8924 1.45455C13.9428 1.45455 15.5833 3.14253 15.5833 5.19746C15.5833 6.13944 15.2419 6.99869 14.6732 7.65876L14.4965 7.84999L8.5 13.9521L2.30703 7.65004C1.75093 6.99714 1.41667 6.13905 1.41667 5.19746C1.41667 3.14253 3.05716 1.45455 5.10752 1.45455C6.05082 1.45455 6.90691 1.81145 7.55858 2.39901L7.64254 2.4747L8.44824 3.29456L8.5 3.24788Z"
                                            fill="CurrentColor" />
                                    </svg>',
    ],
    'cart' => [
        'url' => $arParams['PATH_TO_BASKET'] ?? '/personal/cart/',
        'label' => 'Корзина',
        'ajax' => false,
        'icon' => '<svg width="25" height="24" viewBox="0 0 17 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M0.828399 0.0350039C0.504358 -0.0777245 0.14931 0.0908144 0.0353776 0.411433C-0.0785545 0.73206 0.0917839 1.08336 0.415834 1.19608L0.632445 1.27143C1.18606 1.46402 1.54991 1.59165 1.81762 1.72162C2.06908 1.8437 2.17993 1.94251 2.25295 2.04824C2.3278 2.15662 2.3856 2.30547 2.41822 2.6036C2.45234 2.91557 2.45319 3.32189 2.45319 3.92901V6.16212C2.45319 7.3539 2.46449 8.21329 2.57815 8.86986C2.69949 9.57081 2.94174 10.0726 3.39471 10.5454C3.88718 11.0593 4.51144 11.283 5.25466 11.3873C5.96636 11.4872 6.87013 11.4872 7.98611 11.4872H12.4688C13.0839 11.4872 13.6014 11.4872 14.0201 11.4365C14.4644 11.3827 14.8696 11.2651 15.2232 10.9799C15.5769 10.6947 15.7751 10.3258 15.9181 9.90623C16.0527 9.51059 16.1572 9.00918 16.2814 8.41317L16.7034 6.38703L16.7042 6.38325L16.7128 6.34039C16.8494 5.66357 16.9643 5.09423 16.9929 4.6363C17.0228 4.15532 16.9675 3.68107 16.6509 3.27378C16.456 3.02318 16.1821 2.88131 15.9329 2.79468C15.6787 2.70632 15.3913 2.6552 15.1013 2.62312C14.5315 2.56011 13.8394 2.56012 13.1606 2.56012H3.66375C3.66102 2.52997 3.65807 2.50031 3.65488 2.47116C3.61033 2.06388 3.51379 1.69242 3.27995 1.35385C3.04429 1.01264 2.73096 0.794106 2.36556 0.616714C2.02383 0.450809 1.5896 0.299771 1.07834 0.121944L0.828399 0.0350039ZM3.69708 3.79087H13.1347C13.8448 3.79087 14.4699 3.79169 14.9631 3.84625C15.2082 3.87336 15.3917 3.91102 15.5205 3.95584C15.6258 3.99246 15.6615 4.02237 15.6666 4.02669C15.6666 4.0266 15.6669 4.02687 15.6666 4.02669C15.7176 4.09349 15.7729 4.21468 15.7513 4.56048C15.7286 4.92443 15.632 5.41038 15.4847 6.14056L15.4844 6.14239L15.0707 8.12813C14.9369 8.77041 14.8468 9.1974 14.7393 9.51313C14.6372 9.81294 14.5413 9.94209 14.4374 10.0259C14.3336 10.1096 14.1864 10.1764 13.8691 10.2148C13.5347 10.2554 13.0939 10.2564 12.4311 10.2564H8.03363C6.85873 10.2564 6.04351 10.2549 5.4293 10.1688C4.83654 10.0856 4.52339 9.93446 4.29739 9.69856C4.03188 9.42156 3.88868 9.15022 3.80418 8.66211C3.712 8.12952 3.69708 7.38097 3.69708 6.3856V3.79087Z"
                                            fill="CurrentColor" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5.18305 15.9999C4.15257 15.9999 3.31721 15.1733 3.31721 14.1538C3.31721 13.1342 4.15257 12.3077 5.18305 12.3077C6.21353 12.3077 7.04888 13.1342 7.04888 14.1538C7.04888 15.1733 6.21353 15.9999 5.18305 15.9999ZM4.5611 14.1538C4.5611 14.4936 4.83956 14.7692 5.18305 14.7692C5.52654 14.7692 5.80499 14.4936 5.80499 14.1538C5.80499 13.8139 5.52654 13.5384 5.18305 13.5384C4.83956 13.5384 4.5611 13.8139 4.5611 14.1538Z"
                                            fill="CurrentColor" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12.6464 16C11.616 16 10.7806 15.1734 10.7806 14.1539C10.7806 13.1342 11.616 12.3078 12.6464 12.3078C13.6768 12.3078 14.5122 13.1342 14.5122 14.1539C14.5122 15.1734 13.6768 16 12.6464 16ZM12.0244 14.1539C12.0244 14.4937 12.3029 14.7692 12.6464 14.7692C12.9899 14.7692 13.2683 14.4937 13.2683 14.1539C13.2683 13.814 12.9899 13.5385 12.6464 13.5385C12.3029 13.5385 12.0244 13.814 12.0244 14.1539Z"
                                            fill="CurrentColor" />
                                    </svg>',
    ],
    'private' => [
        'url' => $arResult['PATH_TO_PRIVATE'] ?? ($sefFolder . '/private/'),
        'label' => 'Настройки',
        'ajax' => true,
        'icon' => '<svg width="27" height="26" viewBox="0 0 27 26" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M13.4938 16.8153C15.5638 16.8153 17.2419 15.1078 17.2419 13.0013C17.2419 10.8948 15.5638 9.18731 13.4938 9.18731C11.4237 9.18731 9.74563 10.8948 9.74563 13.0013C9.74563 15.1078 11.4237 16.8153 13.4938 16.8153Z"
                                            stroke="CurrentColor" stroke-width="2" stroke-miterlimit="10"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M1 14.12V11.8824C1 10.5602 2.06197 9.46693 3.37381 9.46693C5.63518 9.46693 6.55972 7.83962 5.42279 5.84362C4.77311 4.69941 5.16042 3.21195 6.29735 2.55085L8.45877 1.29223C9.44578 0.694703 10.7201 1.05068 11.3073 2.05503L11.4448 2.29659C12.5692 4.29259 14.4183 4.29259 15.5552 2.29659L15.6927 2.05503C16.2799 1.05068 17.5542 0.694703 18.5412 1.29223L20.7026 2.55085C21.8396 3.21195 22.2269 4.69941 21.5772 5.84362C20.4403 7.83962 21.3648 9.46693 23.6262 9.46693C24.9255 9.46693 26 10.5475 26 11.8824V14.12C26 15.4422 24.938 16.5355 23.6262 16.5355C21.3648 16.5355 20.4403 18.1628 21.5772 20.1588C22.2269 21.3157 21.8396 22.7905 20.7026 23.4516L18.5412 24.7102C17.5542 25.3077 16.2799 24.9518 15.6927 23.9474L15.5552 23.7059C14.4308 21.7099 12.5817 21.7099 11.4448 23.7059L11.3073 23.9474C10.7201 24.9518 9.44578 25.3077 8.45877 24.7102L6.29735 23.4516C5.16042 22.7905 4.77311 21.303 5.42279 20.1588C6.55972 18.1628 5.63518 16.5355 3.37381 16.5355C2.06197 16.5355 1 15.4422 1 14.12Z"
                                            stroke="CurrentColor" stroke-width="2" stroke-miterlimit="10"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>',
    ],
];

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
    <section class="section section-gray catalog-cart " id="catalog-cart">
        <div class="container">
            <div class="heading">
                <h1 class="h2"><? $APPLICATION->ShowTitle() ?></h1>
            </div>
            <div class="personal__content">
                <aside class="personal__aside">
                    <nav class="personal__aside_nav anim-stagger" data-ajax-nav>
                        <ul>
                            <?php foreach ($navLinks as $key => $link): ?>
                                <?php $isActive = ($currentPage === $key); ?>
                                <li>
                                    <a class="btn btn-quad-md grey<?= $isActive ? ' active' : '' ?>"
                                        href="<?= htmlspecialcharsbx($link['url']) ?>"
                                        data-nav-key="<?= $key ?>"
                                        data-ajax="<?= $link['ajax'] ? 'true' : 'false' ?>">
                                        <?= $link['icon'] ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                </aside>
                <div class="personal__sections" data-ajax-content>
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
            </div>
        </div>
        <!-- </div> -->
        <!-- </div> -->
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