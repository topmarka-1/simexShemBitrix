<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

/**
 * @global CMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 * @var array $arCurSection
 */

if (isset($arParams['USE_COMMON_SETTINGS_BASKET_POPUP']) && $arParams['USE_COMMON_SETTINGS_BASKET_POPUP'] == 'Y')
{
	$basketAction = $arParams['COMMON_ADD_TO_BASKET_ACTION'] ?? '';
}
else
{
	$basketAction = $arParams['SECTION_ADD_TO_BASKET_ACTION'] ?? '';
}

$searchQuery = trim($_GET['q'] ?? '');
if ($searchQuery)
{
	$GLOBALS['arrFilter']['?NAME'] = '%'.$searchQuery.'%';
}

$isOpk = ($arResult["VARIABLES"]["SECTION_CODE"] ?? '') === 'opk';

if ($isOpk)
{
	$GLOBALS['arrFilter']['PROPERTY_OPK_VALUE'] = 'Да';
}

$sortMap = array(
	'popular' => array('FIELD' => 'show_counter', 'ORDER' => 'DESC', 'TITLE' => 'Сначала популярные'),
	'price_asc' => array('FIELD' => 'CATALOG_PRICE_1', 'ORDER' => 'ASC', 'TITLE' => 'Сначала недорогие'),
	'price_desc' => array('FIELD' => 'CATALOG_PRICE_1', 'ORDER' => 'DESC', 'TITLE' => 'Сначала дорогие'),
	'novelty' => array('FIELD' => 'DATE_CREATE', 'ORDER' => 'DESC', 'TITLE' => 'По новинкам'),
	'name' => array('FIELD' => 'name', 'ORDER' => 'ASC', 'TITLE' => 'По новизне'),
);
$currentSort = $_GET['sort'] ?? 'popular';
$currentSortData = $sortMap[$currentSort] ?? $sortMap['popular'];

$sectionName = 'Вся продукция';
$sectionId = $arResult["VARIABLES"]["SECTION_ID"] ?? 0;
$sectionCode = $arResult["VARIABLES"]["SECTION_CODE"] ?? '';

if ($isOpk)
{
    $sectionId = 0;
    $sectionCode = '';
}
elseif ($sectionId > 0)
{
    $res = CIBlockSection::GetByID($sectionId);
    if ($arSection = $res->GetNext())
    {
        $sectionName = $arSection['NAME'];
    }
}
elseif ($sectionCode)
{
    $res = CIBlockSection::GetList(array(), array('IBLOCK_ID' => $arParams['IBLOCK_ID'], '=CODE' => $sectionCode), false, array('ID', 'NAME'));
    if ($arSection = $res->GetNext())
    {
        $sectionName = $arSection['NAME'];
    }
}


$sectionName = 'Вся продукция';
?>

<div class="<?=(($isFilter || $isSidebar) ? "col-md-9 col-sm-8 col-sm-pull-4 col-md-pull-3" : "col-xs-12")?>">
	<div class="row">
		
		<div class="col-xs-12">
			<?
			$sectionListParams = array(
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
				"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
				"CACHE_TYPE" => $arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
				"TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
				"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
				"VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
				"SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
				"HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
				"ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : '')
			);
			if ($sectionListParams["COUNT_ELEMENTS"] === "Y")
			{
				$sectionListParams["COUNT_ELEMENTS_FILTER"] = "CNT_ACTIVE";
				if ($arParams["HIDE_NOT_AVAILABLE"] == "Y")
				{
					$sectionListParams["COUNT_ELEMENTS_FILTER"] = "CNT_AVAILABLE";
				}
			}
			$APPLICATION->IncludeComponent(
				"bitrix:catalog.section.list",
				"",
				$sectionListParams,
				$component,
				array("HIDE_ICONS" => "Y")
			);
			unset($sectionListParams);

			
			?>
		</div>
		<?
		$GLOBALS['CATALOG_CURRENT_SECTION_ID'] = $intSectionID = $isOpk ? 0 : ($arResult["VARIABLES"]["SECTION_ID"] ?: $arCurSection['ID']);

		if (ModuleManager::isModuleInstalled("sale"))
		{
			if (!empty($arRecomData))
			{
				if (!isset($arParams['USE_BIG_DATA']) || $arParams['USE_BIG_DATA'] != 'N')
				{
					?>
					<div class="col-xs-12" data-entity="parent-container">
						<div class="catalog-block-header" data-entity="header" data-showed="false" style="display: none; opacity: 0;">
							<?=GetMessage('CATALOG_PERSONAL_RECOM')?>
						</div>
						
					</div>
					<?
				}
			}
		}
		?>
                    <!-- </div>
                </div>
             </aside>
         </div> -->
     </div>
 </div>
<section class="section section-round-top catalog section-gray anim-fade-in-up anim-visible" id="catalog">
    <div class="container">
        <div class="heading anim-fade-in-left anim-visible">
            <h1 class="h2"><?=$sectionName?></h1>
        </div>
        <div class="catalog__container">
            <aside class="catalog__aside">
                <div class="catalog__aside_search">
                    <form method="get" action="">
                        <label class="catalog_search_label search_label">
                            <input type="text" name="q" placeholder="Поиск по каталогу" value="<?=htmlspecialcharsbx($searchQuery)?>" autocomplete="off" id="catalog-search-input">
                            <span class="icon">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.3283 0C3.73857 0 0 3.73857 0 8.3283C0 12.918 3.73857 16.6566 8.3283 16.6566C10.3242 16.6566 12.1571 15.9479 13.5937 14.7714L18.5663 19.7439C18.643 19.8239 18.7349 19.8877 18.8366 19.9316C18.9383 19.9756 19.0478 19.9988 19.1586 20C19.2694 20.0011 19.3793 19.9801 19.4819 19.9382C19.5845 19.8963 19.6777 19.8344 19.756 19.756C19.8344 19.6777 19.8963 19.5845 19.9382 19.4819C19.9801 19.3793 20.0011 19.2694 20 19.1586C19.9988 19.0478 19.9756 18.9383 19.9316 18.8366C19.8877 18.7349 19.8239 18.643 19.7439 18.5663L14.7714 13.5937C15.9479 12.1571 16.6566 10.3242 16.6566 8.3283C16.6566 3.73857 12.918 0 8.3283 0ZM8.3283 1.66566C12.0178 1.66566 14.9909 4.63876 14.9909 8.3283C14.9909 12.0178 12.0178 14.9909 8.3283 14.9909C4.63876 14.9909 1.66566 12.0178 1.66566 8.3283C1.66566 4.63876 4.63876 1.66566 8.3283 1.66566Z" fill="#D7D8D9" />
                                </svg>
                            </span>
                        </label>
                        <?if ($searchQuery):?>
                            <a href="<?=$APPLICATION->GetCurPageParam('', array('q'))?>" class="btn btn-light" style="margin-top:8px">Сбросить</a>
                        <?endif;?>
                    </form>
                    <div id="catalog-search-suggest" class="search-suggest-dropdown" style="display:none;position:absolute;background:#fff;border:1px solid #ddd;z-index:100;width:100%;max-height:300px;overflow-y:auto;border-radius:8px;margin-top:4px;box-shadow:0 4px 12px rgba(0,0,0,0.1)"></div>
                </div>
                <script>
                function initCatalogSearch() {
                    var input = document.getElementById('catalog-search-input');
                    var suggest = document.getElementById('catalog-search-suggest');
                    if (!input || !suggest || input.getAttribute('data-search-init')) return;
                    input.setAttribute('data-search-init', '1');
                    var timer = null;
                    input.addEventListener('input', function() {
                        clearTimeout(timer);
                        var q = input.value.trim();
                        if (q.length < 2) {
                            suggest.style.display = 'none';
                            return;
                        }
                        timer = setTimeout(function() {
                            var params = 'q=' + encodeURIComponent(q);
                            var sectionId = <?= (int)($sectionId ?: 0) ?>;
                            if (sectionId) { params += '&section_id=' + sectionId; }
                            else { var sc = '<?=CUtil::JSEscape($sectionCode)?>'; if (sc) params += '&section_code=' + encodeURIComponent(sc); }
                            fetch('/local/ajax/search_suggest.php?' + params)
                                .then(function(r) { return r.json(); })
                                .then(function(data) {
                                    suggest.innerHTML = '';
                                    if (data.length) {
                                        data.forEach(function(item) {
                                            var a = document.createElement('a');
                                            a.href = '?q=' + encodeURIComponent(item.NAME);
                                            a.className = 'search-suggest-item';
                                            a.style.cssText = 'display:block;padding:8px 12px;text-decoration:none;color:#333;font-size:14px;border-bottom:1px solid #eee';
                                            a.textContent = item.NAME;
                                            a.addEventListener('click', function(e) {
                                                input.value = item.NAME;
                                                suggest.style.display = 'none';
                                            });
                                            suggest.appendChild(a);
                                        });
                                        suggest.style.display = 'block';
                                    } else {
                                        suggest.style.display = 'none';
                                    }
                                });
                        }, 300);
                    });
                    document.addEventListener('click', function(e) {
                        if (!e.target.closest('.catalog__aside_search')) {
                            suggest.style.display = 'none';
                        }
                    });
                }

                function reinitPageUI() {
                    if (typeof BX === 'undefined') return;
                    var els;
                    els = document.querySelectorAll('.dropdown');
                    if (els.length) {
                        Array.from(els).forEach(function(dd) {
                            var title = dd.querySelector('.dropdown__value'),
                                list = dd.querySelector('.dropdown__list');
                            if (!title || !list) return;
                            var newTitle = title.cloneNode(true);
                            title.parentNode.replaceChild(newTitle, title);
                            newTitle.addEventListener('click', function(e) {
                                if (window.getComputedStyle(list).position === 'absolute') {
                                    dd.classList.toggle('active');
                                }
                            });
                        });
                    }
                    els = document.querySelectorAll('.accordion');
                    if (els.length) {
                        Array.from(els).forEach(function(acc) {
                            var t = acc.querySelector('.accordion_title');
                            var content = acc.querySelector('.accordion_content');
                            var body = acc.querySelector('.accordion_body');
                            if (t) {
                                var nt = t.cloneNode(true);
                                t.parentNode.replaceChild(nt, t);
                                nt.addEventListener('click', function() {
                                    if (!content || !body) return;
                                    content.style.transition = 'height 0.35s ease';
                                    if (acc.classList.contains('active')) {
                                        content.style.height = '0px';
                                        acc.classList.remove('active');
                                    } else {
                                        content.style.height = 'auto';
                                        var h = content.scrollHeight;
                                        content.style.height = '0px';
                                        content.getBoundingClientRect();
                                        content.style.height = h + 'px';
                                        acc.classList.add('active');
                                    }
                                });
                            }
                        });
                    }
                    els = document.querySelectorAll('.tab');
                    if (els.length) {
                        Array.from(els).forEach(function(btn) {
                            btn.addEventListener('click', function() {
                                var id = btn.dataset.tab;
                                document.querySelectorAll('.tab').forEach(function(t) { t.classList.remove('active'); });
                                document.querySelectorAll('.tab-content').forEach(function(c) { c.classList.remove('active'); });
                                btn.classList.add('active');
                                var content = document.querySelector('[data-content="' + id + '"]');
                                if (content) content.classList.add('active');
                            });
                        });
                    }
                    els = document.querySelectorAll('.anim-fade-in, .anim-fade-in-up, .anim-fade-in-left, .anim-fade-in-right, .anim-scale-in, .anim-stagger');
                    if (els.length) {
                        if (window.IntersectionObserver) {
                            var observer = new IntersectionObserver(function(entries) {
                                entries.forEach(function(entry) {
                                    if (entry.isIntersecting) {
                                        entry.target.classList.add('anim-visible');
                                        observer.unobserve(entry.target);
                                    }
                                });
                            }, { threshold: 0.15 });
                            els.forEach(function(el) { observer.observe(el); });
                        } else {
                            els.forEach(function(el) { el.classList.add('anim-visible'); });
                        }
                    }
                }

                initCatalogSearch();
                if (typeof BX !== 'undefined') {
                    BX.addCustomEvent('onAjaxSuccess', reinitPageUI);
                    BX.addCustomEvent('onAjaxSuccessFinish', reinitPageUI);
                }
                document.addEventListener('DOMContentLoaded', reinitPageUI);
                window.addEventListener('pageshow', reinitPageUI);
                </script>
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:catalog.smart.filter",
                    "",
                    array(
                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "SECTION_ID" => $isOpk ? 0 : ($arCurSection['ID'] ?: 0),
                        "FILTER_NAME" => $arParams["FILTER_NAME"],
                        "PRICE_CODE" => $arParams["~PRICE_CODE"],
                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                        "SAVE_IN_SESSION" => "N",
                        "FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
                        "XML_EXPORT" => "N",
                        "SECTION_TITLE" => "NAME",
                        "SECTION_DESCRIPTION" => "DESCRIPTION",
                        'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                        "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
                        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                        'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                        "SEF_MODE" => $arParams["SEF_MODE"],
                        "SEF_RULE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["smart_filter"],
                        "SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
                        "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                        "INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
                    ),
                    $component,
                    array('HIDE_ICONS' => 'Y')
                );
                ?>
                <div class="btn btn-quad-lg light catalog__filter_toggle">
                    <svg viewBox="0 0 28 28" width="24" height="24" xmlns="http://www.w3.org/2000/svg">
                        <path d="m19 25c-.6 0-1-.4-1-1v-4c0-.6.4-1 1-1s1 .4 1 1v1h5c.6 0 1 .4 1 1s-.4 1-1 1h-5v1c0 .6-.4 1-1 1zm-4-2h-12c-.6 0-1-.4-1-1s.4-1 1-1h12c.6 0 1 .4 1 1s-.4 1-1 1zm-6-6c-.6 0-1-.4-1-1v-1h-5c-.6 0-1-.4-1-1s.4-1 1-1h5v-1c0-.6.4-1 1-1s1 .4 1 1v4c0 .6-.4 1-1 1zm16-2h-12c-.6 0-1-.4-1-1s.4-1 1-1h12c.6 0 1 .4 1 1s-.4 1-1 1zm-6-6c-.6 0-1-.4-1-1v-4c0-.6.4-1 1-1s1 .4 1 1v1h5c.6 0 1 .4 1 1s-.4 1-1 1h-5v1c0 .6-.4 1-1 1zm-4-2h-12c-.6 0-1-.4-1-1s.4-1 1-1h12c.6 0 1 .4 1 1s-.4 1-1 1z" fill="CurrentColor" />
                    </svg>
                </div>
            </aside>
            <script>
            document.addEventListener('click', function(e) {
                var item = e.target.closest('.catalog__sort_item[data-sort]');
                if (item) {
                    var sort = item.getAttribute('data-sort');
                    var url = new URL(window.location.href);
                    url.searchParams.set('sort', sort);
                    window.location.href = url.toString();
                }
            });
            </script>
            <div class="catalog__content">
                <div class="catalog__content_top">
                    <div class="catalog__sort dropdown">
                        <div class="catalog__sort_title dropdown__value" data-default-title="Сортировка:">
                            <span class="text">Сортировка: <?=$currentSortData['TITLE']?></span>
                            <span class="arrow">
                                <svg width="14" height="9" viewBox="0 0 14 9" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.707031 0.707031L6.70703 6.70703L12.707 0.707032" stroke="#D7D8D9"
                                        stroke-width="2" />
                                </svg>
                            </span>
                        </div>
                        <div class="catalog__sort_list dropdown__list">
                            <?foreach ($sortMap as $key => $sortData):?>
                                <a href="javascript:void(0)" class="catalog__sort_item dropdown__item<?=$currentSort === $key ? ' current' : ''?>" data-sort="<?=$key?>"><span class="text"><?=$sortData['TITLE']?></span></a>
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
				<?
				$GLOBALS['arrFilter']['PROPERTY_OPK_VALUE'] = $isOpk ? 'Да' : null;
				if ($searchQuery)
				{
					$GLOBALS['arrFilter']['?NAME'] = '%'.$searchQuery.'%';
				}
					$APPLICATION->IncludeComponent(
						"bitrix:catalog.section",
						"",
						array(
							"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
							"IBLOCK_ID" => $arParams["IBLOCK_ID"],
							"ELEMENT_SORT_FIELD" => $currentSortData['FIELD'],
							"ELEMENT_SORT_ORDER" => $currentSortData['ORDER'],
							"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
							"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
							"PROPERTY_CODE" => (isset($arParams["LIST_PROPERTY_CODE"]) ? $arParams["LIST_PROPERTY_CODE"] : []),
							"PROPERTY_CODE_MOBILE" => $arParams["LIST_PROPERTY_CODE_MOBILE"],
							"INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
							"BASKET_URL" => $arParams["BASKET_URL"],
							"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
							"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
							"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
							"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
							"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
							"CACHE_TYPE" => $arParams["CACHE_TYPE"],
							"CACHE_TIME" => $arParams["CACHE_TIME"],
							"CACHE_FILTER" => $arParams["CACHE_FILTER"],
							"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
							"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
							"PAGE_ELEMENT_COUNT" => 6,
							"LAZY_LOAD" => "Y",
							"LOAD_ON_SCROLL" => "N",
							"MESS_BTN_LAZY_LOAD" => "Показать еще",
							"FILTER_NAME" => $arParams["FILTER_NAME"] ?? "arrFilter",
							"PRICE_CODE" => $arParams["~PRICE_CODE"],
							"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
							"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

							"SET_BROWSER_TITLE" => "N",
							"SET_META_KEYWORDS" => "N",
							"SET_META_DESCRIPTION" => "N",
							"SET_LAST_MODIFIED" => "N",
							"ADD_SECTIONS_CHAIN" => "N",

							"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
							"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
							"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
							"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
							"PRODUCT_PROPERTIES" => (isset($arParams["PRODUCT_PROPERTIES"]) ? $arParams["PRODUCT_PROPERTIES"] : []),

							"OFFERS_CART_PROPERTIES" => (isset($arParams["OFFERS_CART_PROPERTIES"]) ? $arParams["OFFERS_CART_PROPERTIES"] : []),
							"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
							"OFFERS_PROPERTY_CODE" => (isset($arParams["LIST_OFFERS_PROPERTY_CODE"]) ? $arParams["LIST_OFFERS_PROPERTY_CODE"] : []),
							"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
							"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
							"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
							"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
							"OFFERS_LIMIT" => (isset($arParams["LIST_OFFERS_LIMIT"]) ? $arParams["LIST_OFFERS_LIMIT"] : 0),

							"SECTION_ID" => $isOpk ? 0 : $arResult["VARIABLES"]["SECTION_ID"],
							"SECTION_CODE" => $isOpk ? '' : $arResult["VARIABLES"]["SECTION_CODE"],
							"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
							"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
							"USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
							'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
							'CURRENCY_ID' => $arParams['CURRENCY_ID'],
							'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
							'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],

							'LABEL_PROP' => $arParams['LABEL_PROP'],
							'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
							'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'] ?? '',
							'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
							'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
							'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
							'PRODUCT_ROW_VARIANTS' => "[{'VARIANT':'3','BIG_DATA':true}]",
							'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
							'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
							'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
							'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
							'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

							"DISPLAY_TOP_PAGER" => 'N',
							"DISPLAY_BOTTOM_PAGER" => 'N',
							"HIDE_SECTION_DESCRIPTION" => "Y",

							"RCM_TYPE" => isset($arParams['BIG_DATA_RCM_TYPE']) ? $arParams['BIG_DATA_RCM_TYPE'] : '',
							"SHOW_FROM_SECTION" => 'Y',

							'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
							'OFFER_TREE_PROPS' => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
							'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
							'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
							'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
							'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
							'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
							'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
							'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
							'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
							'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
							'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
							'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
							'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
							'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
							'MESS_NOT_AVAILABLE' => $arParams['~MESS_NOT_AVAILABLE'] ?? '',
							'MESS_NOT_AVAILABLE_SERVICE' => $arParams['~MESS_NOT_AVAILABLE_SERVICE'] ?? '',
							'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

							'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
							'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
							'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

							'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
							'ADD_TO_BASKET_ACTION' => $basketAction,
							'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
							'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
							'COMPARE_NAME' => $arParams['COMPARE_NAME'],
							'USE_COMPARE_LIST' => 'Y',
							'BACKGROUND_IMAGE' => '',
							'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : '')
						),
						$component
					);
				?>
                <!-- <div class="catalog__list grid active">
                    <article class="catalog__item card">
                        <button class="btn btn-quad light favourite_btn">
                            <svg width="13" height="12" viewBox="0 0 13 12" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <mask id="path-1-inside-1_350_1421" fill="white">
                                    <path
                                        d="M3.07848 0L2.73925 0.0398261L2.40637 0.116732L2.08112 0.229343L1.77111 0.379034L1.47635 0.564431L1.20192 0.780041L0.949081 1.02586L0.719116 1.29915L0.519644 1.59716L0.350665 1.91577L0.212177 2.25223L0.105453 2.60243L0.0355747 2.96223L0 3.32753V3.69696L0.0355747 4.06363L0.105453 4.42206L0.212177 4.77226L0.350665 5.10872L0.519644 5.42596L0.719116 5.72534L0.949081 5.99863L6.05015 11.5149C6.29203 11.7765 6.70547 11.7765 6.94741 11.515L12.0509 5.99863L12.2783 5.72534L12.4804 5.42596L12.6493 5.10872L12.7878 4.77226L12.8945 4.42206L12.9644 4.06363L13 3.69696V3.32753L12.9644 2.96223L12.8945 2.60243L12.7878 2.25223L12.6493 1.91577L12.4804 1.59716L12.2783 1.29915L12.0509 1.02586L11.7981 0.780041L11.5237 0.564431L11.2276 0.379034L10.9163 0.229343L10.5936 0.116732L10.2608 0.0398261L9.92152 0H9.58229L9.24433 0.0398261L8.91018 0.116732L8.5862 0.229343L8.27492 0.379034L7.98143 0.564431L7.70573 0.780041L7.45289 1.02586L6.49873 2.05722L5.54711 1.02586L5.29427 0.780041L5.01857 0.564431L4.72381 0.379034L4.41253 0.229343L4.08982 0.116732L3.75567 0.0398261L3.41771 0H3.07848ZM3.08991 0.704509H3.40373L3.71755 0.745708L4.02121 0.826734L4.3147 0.948959L4.59421 1.10552L4.85213 1.29778L5.08718 1.523L6.49873 3.05013L7.91282 1.523L8.14787 1.29778L8.40579 1.10552L8.6853 0.948959L8.97879 0.826734L9.28245 0.745708L9.59627 0.704509H9.90882L10.2214 0.745708L10.525 0.826734L10.8198 0.948959L11.098 1.10552L11.3559 1.29778L11.5923 1.523L11.8006 1.77844L11.9785 2.05722L12.1246 2.35798L12.2364 2.67521L12.3114 3.00481L12.3482 3.34264V3.68185L12.3114 4.01831L12.2364 4.34928L12.1246 4.66789L11.9785 4.96864L11.8006 5.24743L11.5923 5.50011L6.94742 10.5207C6.70548 10.7822 6.29203 10.7822 6.05016 10.5206L1.40774 5.50011L1.19937 5.24743L1.02023 4.96864L0.875391 4.66789L0.763585 4.34928L0.688624 4.01831L0.651779 3.68185V3.34264L0.688624 3.00481L0.763585 2.67521L0.875391 2.35798L1.02023 2.05722L1.19937 1.77844L1.40774 1.523L1.64279 1.29778L1.90197 1.10552L2.17895 0.948959L2.47244 0.826734L2.77864 0.745708L3.08991 0.704509Z" />
                                </mask>
                                <path
                                    d="M3.07848 0L2.73925 0.0398261L2.40637 0.116732L2.08112 0.229343L1.77111 0.379034L1.47635 0.564431L1.20192 0.780041L0.949081 1.02586L0.719116 1.29915L0.519644 1.59716L0.350665 1.91577L0.212177 2.25223L0.105453 2.60243L0.0355747 2.96223L0 3.32753V3.69696L0.0355747 4.06363L0.105453 4.42206L0.212177 4.77226L0.350665 5.10872L0.519644 5.42596L0.719116 5.72534L0.949081 5.99863L6.05015 11.5149C6.29203 11.7765 6.70547 11.7765 6.94741 11.515L12.0509 5.99863L12.2783 5.72534L12.4804 5.42596L12.6493 5.10872L12.7878 4.77226L12.8945 4.42206L12.9644 4.06363L13 3.69696V3.32753L12.9644 2.96223L12.8945 2.60243L12.7878 2.25223L12.6493 1.91577L12.4804 1.59716L12.2783 1.29915L12.0509 1.02586L11.7981 0.780041L11.5237 0.564431L11.2276 0.379034L10.9163 0.229343L10.5936 0.116732L10.2608 0.0398261L9.92152 0H9.58229L9.24433 0.0398261L8.91018 0.116732L8.5862 0.229343L8.27492 0.379034L7.98143 0.564431L7.70573 0.780041L7.45289 1.02586L6.49873 2.05722L5.54711 1.02586L5.29427 0.780041L5.01857 0.564431L4.72381 0.379034L4.41253 0.229343L4.08982 0.116732L3.75567 0.0398261L3.41771 0H3.07848ZM3.08991 0.704509H3.40373L3.71755 0.745708L4.02121 0.826734L4.3147 0.948959L4.59421 1.10552L4.85213 1.29778L5.08718 1.523L6.49873 3.05013L7.91282 1.523L8.14787 1.29778L8.40579 1.10552L8.6853 0.948959L8.97879 0.826734L9.28245 0.745708L9.59627 0.704509H9.90882L10.2214 0.745708L10.525 0.826734L10.8198 0.948959L11.098 1.10552L11.3559 1.29778L11.5923 1.523L11.8006 1.77844L11.9785 2.05722L12.1246 2.35798L12.2364 2.67521L12.3114 3.00481L12.3482 3.34264V3.68185L12.3114 4.01831L12.2364 4.34928L12.1246 4.66789L11.9785 4.96864L11.8006 5.24743L11.5923 5.50011L6.94742 10.5207C6.70548 10.7822 6.29203 10.7822 6.05016 10.5206L1.40774 5.50011L1.19937 5.24743L1.02023 4.96864L0.875391 4.66789L0.763585 4.34928L0.688624 4.01831L0.651779 3.68185V3.34264L0.688624 3.00481L0.763585 2.67521L0.875391 2.35798L1.02023 2.05722L1.19937 1.77844L1.40774 1.523L1.64279 1.29778L1.90197 1.10552L2.17895 0.948959L2.47244 0.826734L2.77864 0.745708L3.08991 0.704509Z"
                                    stroke="#191B22" stroke-width="1" mask="url(#path-1-inside-1_350_1421)" />
                            </svg>
                        </button>
                        <a href="/catalogElement" class="catalog__item_image">
                            <img src="./assets/img/barrel.png" alt="Товар" width="166" height="252">
                        </a>
                        <div class="catalog__item_content">
                            <div class="catalog__item_tags">
                                <span class="tag filter-tag">Новинка</span><span class="tag filter-tag">Акция</span>
                            </div>
                            <a href="/catalogElement" class="catalog__item_title">
                                <h4>Масло авиационное ВНИИНП 50-1-4Ф</h4>
                            </a>
                            <div class="catalog__item_char">
                                <div class="article">Арт. 150925-1632В</div>
                                <div class="char__list">
                                    <div class="char__item">
                                        <span class="char__item_name">Объем</span>
                                        <div class="char__item_value">10 л.</div>
                                    </div>
                                    <div class="char__item">
                                        <span class="char__item_name">Вес брутто</span>
                                        <div class="char__item_value">219,5 кг.</div>
                                    </div>
                                    <div class="char__item">
                                        <span class="char__item_name">Стоимость</span>
                                        <div class="char__item_value">13 000 000 ₽</div>
                                    </div>
                                </div>

                            </div>
                            <div class="catalog__item_bottom">
                                <div class="counter">
                                    <a href="#" class="btn btn-quad grey dec">
                                        <svg width="12" height="3" viewBox="0 0 12 3" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 3V0H12V3H0Z" fill="black" />
                                        </svg>

                                    </a>
                                    <input type="text" name="count" class="btn btn-quad counter_value" value="1" />
                                    <a href="#" class="btn btn-quad grey inc">
                                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M5.03736 12V6.96264H0V5.02418H5.03736V0H6.97582V5.02418H12V6.96264H6.97582V12H5.03736Z"
                                                fill="black" />
                                        </svg>
                                    </a>
                                </div>
                                <button class="btn btn-primary">Добавить в корзину</button>
                            </div>
                        </div>

                    </article>
                </div>
                <div class="catalog__list column hide">
                    <article class="catalog__item card">

                        <a href="/catalogElement" class="catalog__item_image">
                            <img src="./assets/img/barrel.png" alt="Товар" width="71" height="108">
                        </a>
                        <div class="catalog__item_content">
                            <div class="catalog__item_col">
                                <a href="/catalogElement" class="catalog__item_title">
                                    <h5>Масло авиационное ВНИИНП 50-1-4Ф</h5>
                                </a>
                                <div class="article">Арт. 150925-1632В</div>
                            </div>
                            <div class="catalog__item_col">
                                <div class="catalog__item_char">
                                    <div class="char__list">
                                        <div class="char__item">
                                            <span class="char__item_name">Объем</span>
                                            <div class="char__item_value">10 л.</div>
                                        </div>
                                        <div class="char__item">
                                            <span class="char__item_name">Вязкость</span>
                                            <div class="char__item_value">10W-30</div>
                                        </div>
                                        <div class="char__item">
                                            <span class="char__item_name">Тип</span>
                                            <div class="char__item_value">Полусинтетическое</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="catalog__item_col">
                                <div class="char__item">
                                    <span class="char__item_name">Стоимость</span>
                                    <div class="char__item_value">13 000 000 ₽</div>
                                </div>
                                <div class="catalog__item_bottom">
                                    <div class="counter">
                                        <a href="#" class="btn btn-quad grey dec">
                                            <svg width="12" height="3" viewBox="0 0 12 3" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M0 3V0H12V3H0Z" fill="black" />
                                            </svg>

                                        </a>
                                        <input type="text" name="count" class="btn btn-quad counter_value" value="1" />
                                        <a href="#" class="btn btn-quad grey inc">
                                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.03736 12V6.96264H0V5.02418H5.03736V0H6.97582V5.02418H12V6.96264H6.97582V12H5.03736Z"
                                                    fill="black" />
                                            </svg>
                                        </a>
                                    </div>
                                    <button class="btn btn-primary">Добавить в корзину</button>
                                    <button class="btn btn-quad light favourite_btn">
                                        <svg width="13" height="12" viewBox="0 0 13 12" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <mask id="path-1-inside-1_350_1421" fill="white">
                                                <path
                                                    d="M3.07848 0L2.73925 0.0398261L2.40637 0.116732L2.08112 0.229343L1.77111 0.379034L1.47635 0.564431L1.20192 0.780041L0.949081 1.02586L0.719116 1.29915L0.519644 1.59716L0.350665 1.91577L0.212177 2.25223L0.105453 2.60243L0.0355747 2.96223L0 3.32753V3.69696L0.0355747 4.06363L0.105453 4.42206L0.212177 4.77226L0.350665 5.10872L0.519644 5.42596L0.719116 5.72534L0.949081 5.99863L6.05015 11.5149C6.29203 11.7765 6.70547 11.7765 6.94741 11.515L12.0509 5.99863L12.2783 5.72534L12.4804 5.42596L12.6493 5.10872L12.7878 4.77226L12.8945 4.42206L12.9644 4.06363L13 3.69696V3.32753L12.9644 2.96223L12.8945 2.60243L12.7878 2.25223L12.6493 1.91577L12.4804 1.59716L12.2783 1.29915L12.0509 1.02586L11.7981 0.780041L11.5237 0.564431L11.2276 0.379034L10.9163 0.229343L10.5936 0.116732L10.2608 0.0398261L9.92152 0H9.58229L9.24433 0.0398261L8.91018 0.116732L8.5862 0.229343L8.27492 0.379034L7.98143 0.564431L7.70573 0.780041L7.45289 1.02586L6.49873 2.05722L5.54711 1.02586L5.29427 0.780041L5.01857 0.564431L4.72381 0.379034L4.41253 0.229343L4.08982 0.116732L3.75567 0.0398261L3.41771 0H3.07848ZM3.08991 0.704509H3.40373L3.71755 0.745708L4.02121 0.826734L4.3147 0.948959L4.59421 1.10552L4.85213 1.29778L5.08718 1.523L6.49873 3.05013L7.91282 1.523L8.14787 1.29778L8.40579 1.10552L8.6853 0.948959L8.97879 0.826734L9.28245 0.745708L9.59627 0.704509H9.90882L10.2214 0.745708L10.525 0.826734L10.8198 0.948959L11.098 1.10552L11.3559 1.29778L11.5923 1.523L11.8006 1.77844L11.9785 2.05722L12.1246 2.35798L12.2364 2.67521L12.3114 3.00481L12.3482 3.34264V3.68185L12.3114 4.01831L12.2364 4.34928L12.1246 4.66789L11.9785 4.96864L11.8006 5.24743L11.5923 5.50011L6.94742 10.5207C6.70548 10.7822 6.29203 10.7822 6.05016 10.5206L1.40774 5.50011L1.19937 5.24743L1.02023 4.96864L0.875391 4.66789L0.763585 4.34928L0.688624 4.01831L0.651779 3.68185V3.34264L0.688624 3.00481L0.763585 2.67521L0.875391 2.35798L1.02023 2.05722L1.19937 1.77844L1.40774 1.523L1.64279 1.29778L1.90197 1.10552L2.17895 0.948959L2.47244 0.826734L2.77864 0.745708L3.08991 0.704509Z" />
                                            </mask>
                                            <path
                                                d="M3.07848 0L2.73925 0.0398261L2.40637 0.116732L2.08112 0.229343L1.77111 0.379034L1.47635 0.564431L1.20192 0.780041L0.949081 1.02586L0.719116 1.29915L0.519644 1.59716L0.350665 1.91577L0.212177 2.25223L0.105453 2.60243L0.0355747 2.96223L0 3.32753V3.69696L0.0355747 4.06363L0.105453 4.42206L0.212177 4.77226L0.350665 5.10872L0.519644 5.42596L0.719116 5.72534L0.949081 5.99863L6.05015 11.5149C6.29203 11.7765 6.70547 11.7765 6.94741 11.515L12.0509 5.99863L12.2783 5.72534L12.4804 5.42596L12.6493 5.10872L12.7878 4.77226L12.8945 4.42206L12.9644 4.06363L13 3.69696V3.32753L12.9644 2.96223L12.8945 2.60243L12.7878 2.25223L12.6493 1.91577L12.4804 1.59716L12.2783 1.29915L12.0509 1.02586L11.7981 0.780041L11.5237 0.564431L11.2276 0.379034L10.9163 0.229343L10.5936 0.116732L10.2608 0.0398261L9.92152 0H9.58229L9.24433 0.0398261L8.91018 0.116732L8.5862 0.229343L8.27492 0.379034L7.98143 0.564431L7.70573 0.780041L7.45289 1.02586L6.49873 2.05722L5.54711 1.02586L5.29427 0.780041L5.01857 0.564431L4.72381 0.379034L4.41253 0.229343L4.08982 0.116732L3.75567 0.0398261L3.41771 0H3.07848ZM3.08991 0.704509H3.40373L3.71755 0.745708L4.02121 0.826734L4.3147 0.948959L4.59421 1.10552L4.85213 1.29778L5.08718 1.523L6.49873 3.05013L7.91282 1.523L8.14787 1.29778L8.40579 1.10552L8.6853 0.948959L8.97879 0.826734L9.28245 0.745708L9.59627 0.704509H9.90882L10.2214 0.745708L10.525 0.826734L10.8198 0.948959L11.098 1.10552L11.3559 1.29778L11.5923 1.523L11.8006 1.77844L11.9785 2.05722L12.1246 2.35798L12.2364 2.67521L12.3114 3.00481L12.3482 3.34264V3.68185L12.3114 4.01831L12.2364 4.34928L12.1246 4.66789L11.9785 4.96864L11.8006 5.24743L11.5923 5.50011L6.94742 10.5207C6.70548 10.7822 6.29203 10.7822 6.05016 10.5206L1.40774 5.50011L1.19937 5.24743L1.02023 4.96864L0.875391 4.66789L0.763585 4.34928L0.688624 4.01831L0.651779 3.68185V3.34264L0.688624 3.00481L0.763585 2.67521L0.875391 2.35798L1.02023 2.05722L1.19937 1.77844L1.40774 1.523L1.64279 1.29778L1.90197 1.10552L2.17895 0.948959L2.47244 0.826734L2.77864 0.745708L3.08991 0.704509Z"
                                                stroke="#191B22" stroke-width="1"
                                                mask="url(#path-1-inside-1_350_1421)" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </article>
                    
                </div>

                <div class="catalog__list table hide">
                    <div class="catalog__list_head">
                        <div>Наименование</div>
                        <div class="catalog__item_col">
                            <div class="type">Артикул</div>
                            <div class="type">Вязкость</div>
                            <div class="type">Тип</div>
                            <div class="type">Цена</div>
                        </div>

                        <div></div>
                    </div>
                    <article class="catalog__item card">
                        <a href="/catalogElement" class="catalog__item_title">
                            <h6>Масло авиационное ВНИИНП 50-1-4Ф</h6>
                        </a>
                        <div class="catalog__item_col">
                            <div class="char__item">
                                <span class="char__item_name">Артикул</span>
                                <div class="char__item_value">Арт. 150925-1632В</div>
                            </div>
                            <div class="char__item">
                                <span class="char__item_name">Вязкость</span>
                                <div class="char__item_value">10W-30</div>
                            </div>
                            <div class="char__item">
                                <span class="char__item_name">Тип</span>
                                <div class="char__item_value">Полусинтетическое</div>
                            </div>
                            <div class="char__item">
                                <span class="char__item_name">Цена</span>
                                <div class="char__item_value price">79 900 ₽</div>
                            </div>
                        </div>
                        <div class="catalog__item_bottom">
                            <div class="counter">
                                <a href="#" class="btn btn-quad grey dec">
                                    <svg width="12" height="3" viewBox="0 0 12 3" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 3V0H12V3H0Z" fill="black" />
                                    </svg>

                                </a>
                                <input type="text" name="count" class="btn btn-quad counter_value" value="1" />
                                <a href="#" class="btn btn-quad grey inc">
                                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M5.03736 12V6.96264H0V5.02418H5.03736V0H6.97582V5.02418H12V6.96264H6.97582V12H5.03736Z"
                                            fill="black" />
                                    </svg>
                                </a>
                            </div>
                            <button class="btn btn-quad primary">
                                <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M0.828399 0.0350039C0.504358 -0.0777245 0.14931 0.0908144 0.0353776 0.411433C-0.0785545 0.73206 0.0917839 1.08336 0.415834 1.19608L0.632445 1.27143C1.18606 1.46402 1.54991 1.59165 1.81762 1.72162C2.06908 1.8437 2.17993 1.94251 2.25295 2.04824C2.3278 2.15662 2.3856 2.30547 2.41822 2.6036C2.45234 2.91557 2.45319 3.32189 2.45319 3.92901V6.16212C2.45319 7.3539 2.46449 8.21329 2.57815 8.86986C2.69949 9.57081 2.94174 10.0726 3.39471 10.5454C3.88718 11.0593 4.51144 11.283 5.25466 11.3873C5.96636 11.4872 6.87013 11.4872 7.98611 11.4872H12.4688C13.0839 11.4872 13.6014 11.4872 14.0201 11.4365C14.4644 11.3827 14.8696 11.2651 15.2232 10.9799C15.5769 10.6947 15.7751 10.3258 15.9181 9.90623C16.0527 9.51059 16.1572 9.00918 16.2814 8.41317L16.7034 6.38703L16.7042 6.38325L16.7128 6.34039C16.8494 5.66357 16.9643 5.09423 16.9929 4.6363C17.0228 4.15532 16.9675 3.68107 16.6509 3.27378C16.456 3.02318 16.1821 2.88131 15.9329 2.79468C15.6787 2.70632 15.3913 2.6552 15.1013 2.62312C14.5315 2.56011 13.8394 2.56012 13.1606 2.56012H3.66375C3.66102 2.52997 3.65807 2.50031 3.65488 2.47116C3.61033 2.06388 3.51379 1.69242 3.27995 1.35385C3.04429 1.01264 2.73096 0.794106 2.36556 0.616714C2.02383 0.450809 1.5896 0.299771 1.07834 0.121944L0.828399 0.0350039ZM3.69708 3.79087H13.1347C13.8448 3.79087 14.4699 3.79169 14.9631 3.84625C15.2082 3.87336 15.3917 3.91102 15.5205 3.95584C15.6258 3.99246 15.6615 4.02237 15.6666 4.02669C15.6666 4.0266 15.6669 4.02687 15.6666 4.02669C15.7176 4.09349 15.7729 4.21468 15.7513 4.56048C15.7286 4.92443 15.632 5.41038 15.4847 6.14056L15.4844 6.14239L15.0707 8.12813C14.9369 8.77041 14.8468 9.1974 14.7393 9.51313C14.6372 9.81294 14.5413 9.94209 14.4374 10.0259C14.3336 10.1096 14.1864 10.1764 13.8691 10.2148C13.5347 10.2554 13.0939 10.2564 12.4311 10.2564H8.03363C6.85873 10.2564 6.04351 10.2549 5.4293 10.1688C4.83654 10.0856 4.52339 9.93446 4.29739 9.69856C4.03188 9.42156 3.88868 9.15022 3.80418 8.66211C3.712 8.12952 3.69708 7.38385 3.69708 6.16212V3.79087Z"
                                        fill="CurrentColor" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5.18305 15.9999C4.15257 15.9999 3.31721 15.1733 3.31721 14.1538C3.31721 13.1342 4.15257 12.3077 5.18305 12.3077C6.21353 12.3077 7.04888 13.1342 7.04888 14.1538C7.04888 15.1733 6.21353 15.9999 5.18305 15.9999ZM4.5611 14.1538C4.5611 14.4936 4.83956 14.7692 5.18305 14.7692C5.52654 14.7692 5.80499 14.4936 5.80499 14.1538C5.80499 13.8139 5.52654 13.5384 5.18305 13.5384C4.83956 13.5384 4.5611 13.8139 4.5611 14.1538Z"
                                        fill="CurrentColor" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M12.6464 16C11.616 16 10.7806 15.1734 10.7806 14.1539C10.7806 13.1342 11.616 12.3078 12.6464 12.3078C13.6768 12.3078 14.5122 13.1342 14.5122 14.1539C14.5122 15.1734 13.6768 16 12.6464 16ZM12.0244 14.1539C12.0244 14.4937 12.3029 14.7692 12.6464 14.7692C12.9899 14.7692 13.2683 14.4937 13.2683 14.1539C13.2683 13.814 12.9899 13.5385 12.6464 13.5385C12.3029 13.5385 12.0244 13.814 12.0244 14.1539Z"
                                        fill="CurrentColor" />
                                </svg>
                            </button>
                            <button class="btn btn-quad light favourite_btn">
                                <svg width="13" height="12" viewBox="0 0 13 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <mask id="path-1-inside-1_350_1421" fill="white">
                                        <path
                                            d="M3.07848 0L2.73925 0.0398261L2.40637 0.116732L2.08112 0.229343L1.77111 0.379034L1.47635 0.564431L1.20192 0.780041L0.949081 1.02586L0.719116 1.29915L0.519644 1.59716L0.350665 1.91577L0.212177 2.25223L0.105453 2.60243L0.0355747 2.96223L0 3.32753V3.69696L0.0355747 4.06363L0.105453 4.42206L0.212177 4.77226L0.350665 5.10872L0.519644 5.42596L0.719116 5.72534L0.949081 5.99863L6.05015 11.5149C6.29203 11.7765 6.70547 11.7765 6.94741 11.515L12.0509 5.99863L12.2783 5.72534L12.4804 5.42596L12.6493 5.10872L12.7878 4.77226L12.8945 4.42206L12.9644 4.06363L13 3.69696V3.32753L12.9644 2.96223L12.8945 2.60243L12.7878 2.25223L12.6493 1.91577L12.4804 1.59716L12.2783 1.29915L12.0509 1.02586L11.7981 0.780041L11.5237 0.564431L11.2276 0.379034L10.9163 0.229343L10.5936 0.116732L10.2608 0.0398261L9.92152 0H9.58229L9.24433 0.0398261L8.91018 0.116732L8.5862 0.229343L8.27492 0.379034L7.98143 0.564431L7.70573 0.780041L7.45289 1.02586L6.49873 2.05722L5.54711 1.02586L5.29427 0.780041L5.01857 0.564431L4.72381 0.379034L4.41253 0.229343L4.08982 0.116732L3.75567 0.0398261L3.41771 0H3.07848ZM3.08991 0.704509H3.40373L3.71755 0.745708L4.02121 0.826734L4.3147 0.948959L4.59421 1.10552L4.85213 1.29778L5.08718 1.523L6.49873 3.05013L7.91282 1.523L8.14787 1.29778L8.40579 1.10552L8.6853 0.948959L8.97879 0.826734L9.28245 0.745708L9.59627 0.704509H9.90882L10.2214 0.745708L10.525 0.826734L10.8198 0.948959L11.098 1.10552L11.3559 1.29778L11.5923 1.523L11.8006 1.77844L11.9785 2.05722L12.1246 2.35798L12.2364 2.67521L12.3114 3.00481L12.3482 3.34264V3.68185L12.3114 4.01831L12.2364 4.34928L12.1246 4.66789L11.9785 4.96864L11.8006 5.24743L11.5923 5.50011L6.94742 10.5207C6.70548 10.7822 6.29203 10.7822 6.05016 10.5206L1.40774 5.50011L1.19937 5.24743L1.02023 4.96864L0.875391 4.66789L0.763585 4.34928L0.688624 4.01831L0.651779 3.68185V3.34264L0.688624 3.00481L0.763585 2.67521L0.875391 2.35798L1.02023 2.05722L1.19937 1.77844L1.40774 1.523L1.64279 1.29778L1.90197 1.10552L2.17895 0.948959L2.47244 0.826734L2.77864 0.745708L3.08991 0.704509Z" />
                                    </mask>
                                    <path
                                        d="M3.07848 0L2.73925 0.0398261L2.40637 0.116732L2.08112 0.229343L1.77111 0.379034L1.47635 0.564431L1.20192 0.780041L0.949081 1.02586L0.719116 1.29915L0.519644 1.59716L0.350665 1.91577L0.212177 2.25223L0.105453 2.60243L0.0355747 2.96223L0 3.32753V3.69696L0.0355747 4.06363L0.105453 4.42206L0.212177 4.77226L0.350665 5.10872L0.519644 5.42596L0.719116 5.72534L0.949081 5.99863L6.05015 11.5149C6.29203 11.7765 6.70547 11.7765 6.94741 11.515L12.0509 5.99863L12.2783 5.72534L12.4804 5.42596L12.6493 5.10872L12.7878 4.77226L12.8945 4.42206L12.9644 4.06363L13 3.69696V3.32753L12.9644 2.96223L12.8945 2.60243L12.7878 2.25223L12.6493 1.91577L12.4804 1.59716L12.2783 1.29915L12.0509 1.02586L11.7981 0.780041L11.5237 0.564431L11.2276 0.379034L10.9163 0.229343L10.5936 0.116732L10.2608 0.0398261L9.92152 0H9.58229L9.24433 0.0398261L8.91018 0.116732L8.5862 0.229343L8.27492 0.379034L7.98143 0.564431L7.70573 0.780041L7.45289 1.02586L6.49873 2.05722L5.54711 1.02586L5.29427 0.780041L5.01857 0.564431L4.72381 0.379034L4.41253 0.229343L4.08982 0.116732L3.75567 0.0398261L3.41771 0H3.07848ZM3.08991 0.704509H3.40373L3.71755 0.745708L4.02121 0.826734L4.3147 0.948959L4.59421 1.10552L4.85213 1.29778L5.08718 1.523L6.49873 3.05013L7.91282 1.523L8.14787 1.29778L8.40579 1.10552L8.6853 0.948959L8.97879 0.826734L9.28245 0.745708L9.59627 0.704509H9.90882L10.2214 0.745708L10.525 0.826734L10.8198 0.948959L11.098 1.10552L11.3559 1.29778L11.5923 1.523L11.8006 1.77844L11.9785 2.05722L12.1246 2.35798L12.2364 2.67521L12.3114 3.00481L12.3482 3.34264V3.68185L12.3114 4.01831L12.2364 4.34928L12.1246 4.66789L11.9785 4.96864L11.8006 5.24743L11.5923 5.50011L6.94742 10.5207C6.70548 10.7822 6.29203 10.7822 6.05016 10.5206L1.40774 5.50011L1.19937 5.24743L1.02023 4.96864L0.875391 4.66789L0.763585 4.34928L0.688624 4.01831L0.651779 3.68185V3.34264L0.688624 3.00481L0.763585 2.67521L0.875391 2.35798L1.02023 2.05722L1.19937 1.77844L1.40774 1.523L1.64279 1.29778L1.90197 1.10552L2.17895 0.948959L2.47244 0.826734L2.77864 0.745708L3.08991 0.704509Z"
                                        stroke="#191B22" stroke-width="1" mask="url(#path-1-inside-1_350_1421)" />
                                </svg>
                            </button>
                        </div>

                    </article>
                    
                </div> -->
            </div>

        </div>
    </div>
</section>
<?if ($isFilter || $isSidebar): ?>
	<div class="col-md-3 col-sm-4 col-sm-push-8 col-md-push-9<?=(isset($arParams['FILTER_HIDE_ON_MOBILE']) && $arParams['FILTER_HIDE_ON_MOBILE'] === 'Y' ? ' hidden-xs' : '')?>">
		<? if ($isFilter): ?>
			<div class="bx-sidebar-block">
				
			</div>
		<? endif ?>
		<? if ($isSidebar): ?>
			<div class="hidden-xs">
				<?
				$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => $arParams["SIDEBAR_PATH"],
						"AREA_FILE_RECURSIVE" => "N",
						"EDIT_MODE" => "html",
					),
					false,
					array('HIDE_ICONS' => 'Y')
				);
				?>
			</div>
		<?endif?>
	</div>
<?endif?>