<?php if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$ElementID=$APPLICATION->IncludeComponent("bitrix:news.detail","",[
"DISPLAY_DATE"=>$arParams["DISPLAY_DATE"],"DISPLAY_NAME"=>$arParams["DISPLAY_NAME"],
"DISPLAY_PICTURE"=>$arParams["DISPLAY_PICTURE"],"DISPLAY_PREVIEW_TEXT"=>$arParams["DISPLAY_PREVIEW_TEXT"],
"IBLOCK_TYPE"=>$arParams["IBLOCK_TYPE"],"IBLOCK_ID"=>$arParams["IBLOCK_ID"],
"FIELD_CODE"=>$arParams["DETAIL_FIELD_CODE"],"PROPERTY_CODE"=>$arParams["DETAIL_PROPERTY_CODE"],
"DETAIL_URL"=>$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
"SECTION_URL"=>$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
"META_KEYWORDS"=>$arParams["META_KEYWORDS"],"META_DESCRIPTION"=>$arParams["META_DESCRIPTION"],
"BROWSER_TITLE"=>$arParams["BROWSER_TITLE"],"SET_CANONICAL_URL"=>$arParams["DETAIL_SET_CANONICAL_URL"],
"SET_LAST_MODIFIED"=>$arParams["SET_LAST_MODIFIED"],"SET_TITLE"=>$arParams["SET_TITLE"],
"MESSAGE_404"=>$arParams["MESSAGE_404"],"SET_STATUS_404"=>$arParams["SET_STATUS_404"],
"SHOW_404"=>$arParams["SHOW_404"],"FILE_404"=>$arParams["FILE_404"],
"INCLUDE_IBLOCK_INTO_CHAIN"=>$arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
"ADD_SECTIONS_CHAIN"=>$arParams["ADD_SECTIONS_CHAIN"],
"ACTIVE_DATE_FORMAT"=>$arParams["DETAIL_ACTIVE_DATE_FORMAT"],
"CACHE_TYPE"=>$arParams["CACHE_TYPE"],"CACHE_TIME"=>$arParams["CACHE_TIME"],
"CACHE_GROUPS"=>$arParams["CACHE_GROUPS"],"USE_PERMISSIONS"=>$arParams["USE_PERMISSIONS"],
"GROUP_PERMISSIONS"=>$arParams["GROUP_PERMISSIONS"],
"DISPLAY_TOP_PAGER"=>$arParams["DETAIL_DISPLAY_TOP_PAGER"],
"DISPLAY_BOTTOM_PAGER"=>$arParams["DETAIL_DISPLAY_BOTTOM_PAGER"],
"PAGER_TITLE"=>$arParams["DETAIL_PAGER_TITLE"],"PAGER_SHOW_ALWAYS"=>"N",
"PAGER_TEMPLATE"=>$arParams["DETAIL_PAGER_TEMPLATE"],
"PAGER_SHOW_ALL"=>$arParams["DETAIL_PAGER_SHOW_ALL"],"CHECK_DATES"=>$arParams["CHECK_DATES"],
"ELEMENT_ID"=>$arResult["VARIABLES"]["ELEMENT_ID"],
"ELEMENT_CODE"=>$arResult["VARIABLES"]["ELEMENT_CODE"],
"SECTION_ID"=>$arResult["VARIABLES"]["SECTION_ID"],
"SECTION_CODE"=>$arResult["VARIABLES"]["SECTION_CODE"],
"IBLOCK_URL"=>$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
"USE_SHARE"=>$arParams["USE_SHARE"],"SHARE_HIDE"=>$arParams["SHARE_HIDE"],
"SHARE_TEMPLATE"=>$arParams["SHARE_TEMPLATE"],"SHARE_HANDLERS"=>$arParams["SHARE_HANDLERS"],
"SHARE_SHORTEN_URL_LOGIN"=>$arParams["SHARE_SHORTEN_URL_LOGIN"],
"SHARE_SHORTEN_URL_KEY"=>$arParams["SHARE_SHORTEN_URL_KEY"],
"ADD_ELEMENT_CHAIN"=>$arParams["ADD_ELEMENT_CHAIN"],
"STRICT_SECTION_CHECK"=>$arParams["STRICT_SECTION_CHECK"],
],$component);?>
<?php
$brandName="";
if($ElementID>0){$r=CIBlockElement::GetByID($ElementID);if($b=$r->GetNext())$brandName=$b["NAME"];}
$GLOBALS["arrFilter"]=array();
if($brandName)$GLOBALS["arrFilter"]["=PROPERTY_SUBBREND"]=$brandName;
$q=trim($_GET["q"]??"");if($q)$GLOBALS["arrFilter"]["?NAME"]="%".$q."%";
$sortMap=["popular"=>["FIELD"=>"show_counter","ORDER"=>"DESC","TITLE"=>"Сначала популярные"],"price_asc"=>["FIELD"=>"CATALOG_PRICE_1","ORDER"=>"ASC","TITLE"=>"Сначала недорогие"],"price_desc"=>["FIELD"=>"CATALOG_PRICE_1","ORDER"=>"DESC","TITLE"=>"Сначала дорогие"],"novelty"=>["FIELD"=>"DATE_CREATE","ORDER"=>"DESC","TITLE"=>"По новинкам"],"name"=>["FIELD"=>"name","ORDER"=>"ASC","TITLE"=>"По названию"]];
$s=$_GET["sort"]??"popular";$sd=$sortMap[$s]??$sortMap["popular"];
?>
<section class="section section-round-top catalog section-gray anim-fade-in-up anim-visible" id="catalog">
	<div class="container">
		<div class="heading anim-fade-in-left anim-visible">
			<h1 class="h2"><?=$brandName?"Продукция ".htmlspecialcharsbx($brandName):"Продукция"?></h1>
		</div>
		<div class="catalog__container">
			<aside class="catalog__aside">
				<div class="catalog__aside_search">
					<form method="get" action="">
						<label class="catalog_search_label search_label">
							<input type="text" name="q" placeholder="Поиск по каталогу" value="<?=htmlspecialcharsbx($q)?>" autocomplete="off" id="catalog-search-input">
							<span class="icon">
								<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M8.3283 0C3.73857 0 0 3.73857 0 8.3283C0 12.918 3.73857 16.6566 8.3283 16.6566C10.3242 16.6566 12.1571 15.9479 13.5937 14.7714L18.5663 19.7439C18.643 19.8239 18.7349 19.8877 18.8366 19.9316C18.9383 19.9756 19.0478 19.9988 19.1586 20C19.2694 20.0011 19.3793 19.9801 19.4819 19.9382C19.5845 19.8963 19.6777 19.8344 19.756 19.756C19.8344 19.6777 19.8963 19.5845 19.9382 19.4819C19.9801 19.3793 20.0011 19.2694 20 19.1586C19.9988 19.0478 19.9756 18.9383 19.9316 18.8366C19.8877 18.7349 19.8239 18.643 19.7439 18.5663L14.7714 13.5937C15.9479 12.1571 16.6566 10.3242 16.6566 8.3283C16.6566 3.73857 12.918 0 8.3283 0ZM8.3283 1.66566C12.0178 1.66566 14.9909 4.63876 14.9909 8.3283C14.9909 12.0178 12.0178 14.9909 8.3283 14.9909C4.63876 14.9909 1.66566 12.0178 1.66566 8.3283C1.66566 4.63876 4.63876 1.66566 8.3283 1.66566Z" fill="#D7D8D9"/>
								</svg>
							</span>
						</label>
						<?if($q):?><a href="<?=$APPLICATION->GetCurPageParam("",["q","sort"])?>" class="btn btn-light" style="margin-top:8px">Сбросить</a><?endif;?>
					</form>
				</div>
				<?$APPLICATION->IncludeComponent(
					"bitrix:catalog.smart.filter",
					"",
					[
						"IBLOCK_TYPE"=>"catalog",
						"IBLOCK_ID"=>"14",
						"SECTION_ID"=>0,
						"FILTER_NAME"=>"arrFilter",
						"PRICE_CODE"=>["PRICE"],
						"CACHE_TYPE"=>"A",
						"CACHE_TIME"=>"36000000",
						"CACHE_GROUPS"=>"Y",
						"SAVE_IN_SESSION"=>"N",
						"FILTER_VIEW_MODE"=>"VERTICAL",
						"XML_EXPORT"=>"N",
						"SECTION_TITLE"=>"NAME",
						"SECTION_DESCRIPTION"=>"DESCRIPTION",
						"HIDE_NOT_AVAILABLE"=>"N",
						"TEMPLATE_THEME"=>"blue",
						"CONVERT_CURRENCY"=>"N",
						"SEF_MODE"=>"N",
						"INSTANT_RELOAD"=>"Y",
					],
					null,
					["HIDE_ICONS"=>"Y"]
				);?>
			</aside>
			<div class="catalog__content">
				<div class="catalog__content_top">
					<div class="catalog__sort dropdown">
						<div class="catalog__sort_title dropdown__value" data-default-title="Сортировка:">
							<span class="text">Сортировка: <span class="catalog__sort_value"><?=$sd["TITLE"]?></span></span>
							<span class="arrow">
								<svg width="14" height="9" viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M0.707031 0.707031L6.70703 6.70703L12.707 0.707032" stroke="#D7D8D9" stroke-width="2"/>
								</svg>
							</span>
						</div>
						<div class="catalog__sort_list dropdown__list">
							<?foreach($sortMap as $k=>$d):?>
								<a href="javascript:void(0)" class="catalog__sort_item dropdown__item<?=$s===$k?" current":""?>" data-sort="<?=$k?>"><span class="text"><?=$d["TITLE"]?></span>
								</a>
							<?endforeach;?>
						</div>
					</div>
					<div class="catalog__content_builds">
                        <button class="build-btn btn btn-quad-lg light active" data-build="grid">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <mask id="path-1-inside-1_1_1651" fill="white">
                                    <rect width="10.6666" height="10.6666" rx="1" />
                                </mask>
                                <rect width="10.6666" height="10.6666" rx="1" stroke="CurrentColor" stroke-width="4"
                                    mask="url(#path-1-inside-1_1_1651)" />
                                <mask id="path-2-inside-2_1_1651" fill="white">
                                    <rect x="13.333" width="10.6666" height="10.6666" rx="1" />
                                </mask>
                                <rect x="13.333" width="10.6666" height="10.6666" rx="1" stroke="CurrentColor"
                                    stroke-width="4" mask="url(#path-2-inside-2_1_1651)" />
                                <mask id="path-3-inside-3_1_1651" fill="white">
                                    <rect y="13.3333" width="10.6666" height="10.6666" rx="1" />
                                </mask>
                                <rect y="13.3333" width="10.6666" height="10.6666" rx="1" stroke="CurrentColor"
                                    stroke-width="4" mask="url(#path-3-inside-3_1_1651)" />
                                <mask id="path-4-inside-4_1_1651" fill="white">
                                    <rect x="13.333" y="13.3333" width="10.6666" height="10.6666" rx="1" />
                                </mask>
                                <rect x="13.333" y="13.3333" width="10.6666" height="10.6666" rx="1"
                                    stroke="CurrentColor" stroke-width="4" mask="url(#path-4-inside-4_1_1651)" />
                            </svg>
                        </button>
                        <button class="build-btn btn btn-quad-lg light" data-build="table">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <mask id="path-1-inside-1_1_1670" fill="white">
                                    <rect width="24" height="10.6667" rx="1" />
                                </mask>
                                <rect width="24" height="10.6667" rx="1" stroke="CurrentColor" stroke-width="4"
                                    mask="url(#path-1-inside-1_1_1670)" />
                                <mask id="path-2-inside-2_1_1670" fill="white">
                                    <rect y="13.3335" width="24" height="10.6667" rx="1" />
                                </mask>
                                <rect y="13.3335" width="24" height="10.6667" rx="1" stroke="CurrentColor"
                                    stroke-width="4" mask="url(#path-2-inside-2_1_1670)" />
                            </svg>
                        </button>
                        <button class="build-btn btn btn-quad-lg light" data-build="column">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <mask id="path-1-inside-1_1_1646" fill="white">
                                    <rect width="10.6667" height="10.6667" rx="1" />
                                </mask>
                                <rect width="10.6667" height="10.6667" rx="1" stroke="CurrentColor" stroke-width="4"
                                    mask="url(#path-1-inside-1_1_1646)" />
                                <mask id="path-2-inside-2_1_1646" fill="white">
                                    <rect x="13.333" width="10.6667" height="24" rx="1" />
                                </mask>
                                <rect x="13.333" width="10.6667" height="24" rx="1" stroke="CurrentColor"
                                    stroke-width="4" mask="url(#path-2-inside-2_1_1646)" />
                                <mask id="path-3-inside-3_1_1646" fill="white">
                                    <rect y="13.3335" width="10.6667" height="10.6667" rx="1" />
                                </mask>
                                <rect y="13.3335" width="10.6667" height="10.6667" rx="1" stroke="CurrentColor"
                                    stroke-width="4" mask="url(#path-3-inside-3_1_1646)" />
                            </svg>
                        </button>
                    </div>
				</div>
				<?$APPLICATION->IncludeComponent(
					"bitrix:catalog.section",
					".default",
					[
						"IBLOCK_TYPE"=>"catalog",
						"IBLOCK_ID"=>"14",
						"ELEMENT_SORT_FIELD"=>$sd["FIELD"],
						"ELEMENT_SORT_ORDER"=>$sd["ORDER"],
						"ELEMENT_SORT_FIELD2"=>"id",
						"ELEMENT_SORT_ORDER2"=>"desc",
						"FILTER_NAME"=>"arrFilter",
						"INCLUDE_SUBSECTIONS"=>"Y",
						"PAGE_ELEMENT_COUNT"=>"6",
						"LAZY_LOAD"=>"Y",
						"LOAD_ON_SCROLL"=>"N",
						"MESS_BTN_LAZY_LOAD"=>"Показать еще",
						"DISPLAY_TOP_PAGER"=>"N",
						"DISPLAY_BOTTOM_PAGER"=>"N",
						"PRODUCT_ROW_VARIANTS"=>'[{"VARIANT":"3","BIG_DATA":false}]',
						"PRICE_CODE"=>["PRICE"],
						"PRICE_VAT_INCLUDE"=>"Y",
						"CONVERT_CURRENCY"=>"N",
						"USE_PRODUCT_QUANTITY"=>"N",
						"PRODUCT_QUANTITY_VARIABLE"=>"quantity",
						"ADD_PROPERTIES_TO_BASKET"=>"Y",
						"PRODUCT_PROPS_VARIABLE"=>"prop",
						"PARTIAL_PRODUCT_PROPERTIES"=>"N",
						"BASKET_URL"=>"/personal/basket.php",
						"ACTION_VARIABLE"=>"action",
						"PRODUCT_ID_VARIABLE"=>"id",
						"ADD_TO_BASKET_ACTION"=>"ADD",
						"HIDE_NOT_AVAILABLE"=>"N",
						"HIDE_NOT_AVAILABLE_OFFERS"=>"N",
						"DETAIL_URL"=>"",
						"SECTION_URL"=>"",
						"PRODUCT_SUBSCRIPTION"=>"Y",
						"SHOW_DISCOUNT_PERCENT"=>"N",
						"SHOW_OLD_PRICE"=>"N",
						"SHOW_MAX_QUANTITY"=>"N",
						"MESS_BTN_ADD_TO_BASKET"=>"В корзину",
						"MESS_BTN_BUY"=>"Купить",
						"MESS_BTN_DETAIL"=>"Подробнее",
						"MESS_BTN_SUBSCRIBE"=>"Подписаться",
						"MESS_NOT_AVAILABLE"=>"Нет в наличии",
						"COMPATIBLE_MODE"=>"N",
						"DISABLE_INIT_JS_IN_COMPONENT"=>"N",
						"CACHE_TYPE"=>"A",
						"CACHE_TIME"=>"36000000",
						"CACHE_FILTER"=>"N",
						"CACHE_GROUPS"=>"Y",
						"SET_TITLE"=>"N",
						"SET_BROWSER_TITLE"=>"N",
						"SET_META_KEYWORDS"=>"N",
						"SET_META_DESCRIPTION"=>"N",
						"SET_LAST_MODIFIED"=>"N",
						"ADD_SECTIONS_CHAIN"=>"N",
						"PRODUCT_BLOCKS_ORDER"=>"price,props,sku,quantityLimit,quantity,buttons",
						"SHOW_SLIDER"=>"Y",
						"SLIDER_INTERVAL"=>"3000",
						"SLIDER_PROGRESS"=>"N",
						"ENLARGE_PRODUCT"=>"STRICT",
						"LABEL_PROP"=>[],
						"PROPERTY_CODE_MOBILE"=>[
							"OBEM_VES_NETTO","CML2_ARTICLE","EDINITSA_IZMERENIYA_OBEMA_VESA_NETTO","NOVINKA"
						],
						"OFFERS_LIMIT"=>"5",
						"SECTION_ID"=>0,
						"SECTION_CODE"=>"",
						"SET_STATUS_404"=>"N",
						"SHOW_ALL_WO_SECTION"=>"Y",
						"SHOW_404"=>"N",
						"MESSAGE_404"=>"",
						"USE_MAIN_ELEMENT_SECTION"=>"N",
						"SEF_MODE"=>"N",
						"SEF_RULE"=>"",
						"SECTION_CODE_PATH"=>"",
						"COMPONENT_TEMPLATE"=>".default",
					],
					false,
					["HIDE_ICONS"=>"Y"]
				);?>
			</div>
		</div>
	</div>
</section>
<?
$GLOBALS['brandsOurFilter'] = ['!=CODE' => $arResult["VARIABLES"]["ELEMENT_CODE"]];
$APPLICATION->IncludeComponent("bitrix:news.list", "brands_our", Array(
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
		"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
		"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
		"DISPLAY_DATE" => "Y",	// Выводить дату элемента
		"DISPLAY_NAME" => "Y",	// Выводить название элемента
		"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
		"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"FIELD_CODE" => array(	// Поля
			0 => "",
			1 => "",
		),
		"FILE_404" => "",	// Страница для показа (по умолчанию /404.php)
		"FILTER_NAME" => "brandsOurFilter",	// Фильтр
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
		"IBLOCK_ID" => "16",	// Код информационного блока
		"IBLOCK_TYPE" => "content",	// Тип информационного блока (используется только для проверки)
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
		"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",	// Количество новостей на странице
		"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
		"PAGER_TITLE" => "Новости",	// Название категорий
		"PARENT_SECTION" => "",	// ID раздела
		"PARENT_SECTION_CODE" => "",	// Код раздела
		"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
		"PROPERTY_CODE" => array(	// Свойства
			0 => "HERO_TITLE",
			1 => "ABOUT_TITLE",
			2 => "HERO_SUBTITLE",
			3 => "ABOUT_NUMS",
			4 => "ABOUT_NUMS_TEXT",
			5 => "SEO_TEXT",
			6 => "LINK",
			7 => "BTN_TEXT",
			8 => "",
		),
		"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
		"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
		"SET_STATUS_404" => "Y",	// Устанавливать статус 404
		"SET_TITLE" => "N",	// Устанавливать заголовок страницы
		"SHOW_404" => "Y",	// Показ специальной страницы
		"SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
		"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
		"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
		"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
		"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
	),
	false
);?>

<?$APPLICATION->IncludeComponent("bitrix:news.detail","brand_seo",[
"DISPLAY_DATE"=>$arParams["DISPLAY_DATE"],"DISPLAY_NAME"=>$arParams["DISPLAY_NAME"],
"DISPLAY_PICTURE"=>$arParams["DISPLAY_PICTURE"],"DISPLAY_PREVIEW_TEXT"=>$arParams["DISPLAY_PREVIEW_TEXT"],
"IBLOCK_TYPE"=>$arParams["IBLOCK_TYPE"],"IBLOCK_ID"=>$arParams["IBLOCK_ID"],
"FIELD_CODE"=>$arParams["DETAIL_FIELD_CODE"],"PROPERTY_CODE"=>$arParams["DETAIL_PROPERTY_CODE"],
"DETAIL_URL"=>$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
"SECTION_URL"=>$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
"META_KEYWORDS"=>$arParams["META_KEYWORDS"],"META_DESCRIPTION"=>$arParams["META_DESCRIPTION"],
"BROWSER_TITLE"=>$arParams["BROWSER_TITLE"],"SET_CANONICAL_URL"=>$arParams["DETAIL_SET_CANONICAL_URL"],
"SET_LAST_MODIFIED"=>$arParams["SET_LAST_MODIFIED"],"SET_TITLE"=>$arParams["SET_TITLE"],
"MESSAGE_404"=>$arParams["MESSAGE_404"],"SET_STATUS_404"=>$arParams["SET_STATUS_404"],
"SHOW_404"=>$arParams["SHOW_404"],"FILE_404"=>$arParams["FILE_404"],
"INCLUDE_IBLOCK_INTO_CHAIN"=>$arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
"ADD_SECTIONS_CHAIN"=>$arParams["ADD_SECTIONS_CHAIN"],
"ACTIVE_DATE_FORMAT"=>$arParams["DETAIL_ACTIVE_DATE_FORMAT"],
"CACHE_TYPE"=>$arParams["CACHE_TYPE"],"CACHE_TIME"=>$arParams["CACHE_TIME"],
"CACHE_GROUPS"=>$arParams["CACHE_GROUPS"],"USE_PERMISSIONS"=>$arParams["USE_PERMISSIONS"],
"GROUP_PERMISSIONS"=>$arParams["GROUP_PERMISSIONS"],
"DISPLAY_TOP_PAGER"=>$arParams["DETAIL_DISPLAY_TOP_PAGER"],
"DISPLAY_BOTTOM_PAGER"=>$arParams["DETAIL_DISPLAY_BOTTOM_PAGER"],
"PAGER_TITLE"=>$arParams["DETAIL_PAGER_TITLE"],"PAGER_SHOW_ALWAYS"=>"N",
"PAGER_TEMPLATE"=>$arParams["DETAIL_PAGER_TEMPLATE"],
"PAGER_SHOW_ALL"=>$arParams["DETAIL_PAGER_SHOW_ALL"],"CHECK_DATES"=>$arParams["CHECK_DATES"],
"ELEMENT_ID"=>$arResult["VARIABLES"]["ELEMENT_ID"],
"ELEMENT_CODE"=>$arResult["VARIABLES"]["ELEMENT_CODE"],
"SECTION_ID"=>$arResult["VARIABLES"]["SECTION_ID"],
"SECTION_CODE"=>$arResult["VARIABLES"]["SECTION_CODE"],
"IBLOCK_URL"=>$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
"USE_SHARE"=>$arParams["USE_SHARE"],"SHARE_HIDE"=>$arParams["SHARE_HIDE"],
"SHARE_TEMPLATE"=>$arParams["SHARE_TEMPLATE"],"SHARE_HANDLERS"=>$arParams["SHARE_HANDLERS"],
"SHARE_SHORTEN_URL_LOGIN"=>$arParams["SHARE_SHORTEN_URL_LOGIN"],
"SHARE_SHORTEN_URL_KEY"=>$arParams["SHARE_SHORTEN_URL_KEY"],
"ADD_ELEMENT_CHAIN"=>$arParams["ADD_ELEMENT_CHAIN"],
"STRICT_SECTION_CHECK"=>$arParams["STRICT_SECTION_CHECK"],
],$component);?>
<?$APPLICATION->IncludeFile(
	SITE_TEMPLATE_PATH . '/include/getCatalog.php',
	[],
	[
		'MODE'      => 'php',
	]
);?>
<script>
function i(){
	var e=document.getElementById("catalog-search-input");
	if(!e||e.getAttribute("data-search-init"))return;
	e.setAttribute("data-search-init","1");
	e.addEventListener("input",function(){
		var t=e.value.trim();
		if(t.length<2)return;
		setTimeout(function(){
			fetch("/local/ajax/search_suggest.php?q="+encodeURIComponent(t))
			.then(function(r){return r.json()})
			.then(function(r){
				var a=document.getElementById("catalog-search-suggest");
				a||(a=document.createElement("div"),a.id="catalog-search-suggest",a.style.cssText="display:none;position:absolute;background:#fff;border:1px solid #ddd;z-index:100;width:100%;max-height:300px;overflow-y:auto;border-radius:8px;margin-top:4px",e.parentNode.appendChild(a));
				a.innerHTML="";
				if(r.length){
					r.forEach(function(i){
						var o=document.createElement("a");
						o.href="?q="+encodeURIComponent(i.NAME),o.className="search-suggest-item",o.style.cssText="display:block;padding:8px 12px;color:#333;font-size:14px;border-bottom:1px solid #eee",o.textContent=i.NAME,a.appendChild(o)
					});
					a.style.display="block"
				} else a.style.display="none"
			})
			},300
		)
	});
						document.addEventListener("click",function(r){
							var a=document.getElementById("catalog-search-suggest");
							a&&!r.target.closest(".catalog__aside_search")&&(a.style.display="none")
						})
			}
	document.addEventListener("click",function(e){
		var t=e.target.closest(".catalog__sort_item[data-sort]");
		if(t){
			var n=t.getAttribute("data-sort"),r=new URL(window.location.href);
			r.searchParams.set("sort",n);
			window.location.href=r.toString()
		}
	})
	;i();
</script>
