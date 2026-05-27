<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Catalog\ProductTable;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 *
 *  _________________________________________________________________________
 * | Attention!
 * | The following comments are for system use
 * | and are required for the component to work correctly in ajax mode:
 * | <!-- items-container -->
 * | <!-- pagination-container -->
 * | <!-- component-end -->
 */

$this->setFrameMode(true);

if (!empty($arResult['NAV_RESULT']))
{
	$navParams = array(
		'NavPageCount' => $arResult['NAV_RESULT']->NavPageCount,
		'NavPageNomer' => $arResult['NAV_RESULT']->NavPageNomer,
		'NavNum' => $arResult['NAV_RESULT']->NavNum
	);
}
else
{
	$navParams = array(
		'NavPageCount' => 1,
		'NavPageNomer' => 1,
		'NavNum' => $this->randString()
	);
}

$showTopPager = false;
$showBottomPager = false;
$showLazyLoad = false;

if ($arParams['PAGE_ELEMENT_COUNT'] > 0 && $navParams['NavPageCount'] > 1)
{
	$showTopPager = $arParams['DISPLAY_TOP_PAGER'];
	$showBottomPager = $arParams['DISPLAY_BOTTOM_PAGER'];
	$showLazyLoad = $arParams['LAZY_LOAD'] === 'Y' && $navParams['NavPageNomer'] != $navParams['NavPageCount'];
}

$templateLibrary = array('popup', 'ajax', 'fx');
$currencyList = '';

if (!empty($arResult['CURRENCIES']))
{
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$templateData = array(
	'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList,
	'USE_PAGINATION_CONTAINER' => $showTopPager || $showBottomPager,
);
unset($currencyList, $templateLibrary);

$elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
$elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
$elementDeleteParams = array('CONFIRM' => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));

$obName = 'ob'.preg_replace('/[^a-zA-Z0-9_]/', 'x', $this->GetEditAreaId($navParams['NavNum']));
$containerName = 'container-'.$navParams['NavNum'];

if ($showTopPager)
{
	?>
	<div data-pagination-num="<?=$navParams['NavNum']?>">
		<!-- pagination-container -->
		<?=$arResult['NAV_STRING']?>
		<!-- pagination-container -->
	</div>
	<?
}
// printR($arResult['ITEMS']);
?>
<div class="catalog-section bx-<?=$arParams['TEMPLATE_THEME']?>" data-entity="<?=$containerName?>">
	<?
	if (!empty($arResult['ITEMS']))
	{
		$areaIds = array();

		foreach ($arResult['ITEMS'] as $item)
		{
			$uniqueId = $item['ID'].'_'.md5($this->randString().$component->getAction());
			$areaIds[$item['ID']] = $this->GetEditAreaId($uniqueId);
			$this->AddEditAction($uniqueId, $item['EDIT_LINK'], $elementEdit);
			$this->AddDeleteAction($uniqueId, $item['DELETE_LINK'], $elementDelete, $elementDeleteParams);
			
				
		}
		$productTitle = function($item) {
			return (isset($item['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) && $item['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] != ''
				? $item['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
				: $item['NAME']);
		};
		$imgTitle = function($item) {
			return (isset($item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']) && $item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE'] != ''
				? $item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']
				: $item['NAME']);
		};
		$printPrice = function($item) {
			global $USER;
			$minPrice = false;
			if (isset($item['MIN_PRICE']) || isset($item['RATIO_PRICE']))
				$minPrice = (isset($item['RATIO_PRICE']) ? $item['RATIO_PRICE'] : $item['MIN_PRICE']);
			$hasPrice = !empty($minPrice) || !empty($item['ITEM_PRICES'][0]['PRINT_PRICE']);
			if ($hasPrice):
				if ($USER->IsAuthorized()):
					if (!empty($minPrice)):
						echo $minPrice['PRINT_DISCOUNT_VALUE'];
						if ('Y' == $arParams['SHOW_OLD_PRICE'] && $minPrice['DISCOUNT_VALUE'] < $minPrice['VALUE']):
							?> <span style="text-decoration:line-through;color:#999;font-size:.8em"><?=$minPrice['PRINT_VALUE']?></span><?
						endif;
					elseif (!empty($item['ITEM_PRICES'][0]['PRINT_PRICE'])):
						echo $item['ITEM_PRICES'][0]['PRINT_PRICE'];
					endif;
				else:
					?>Цена по запросу<?
				endif;
			else:
				?>Цена по запросу<?
			endif;
		};
		$unitName = function($item) {
			$unit = $item['PROPERTIES']['EDINITSA_IZMERENIYA_OBEMA_VESA_NETTO']['VALUE'] ?? '';
			return $unit == 'кг' ? 'Вес' : ($unit ? 'Объем' : '');
		};
		?>
		<!-- items-container -->
		<div class="catalog__list grid active" data-entity="items-row">
			<!-- <div> -->
			<?
			foreach ($arResult['ITEMS'] as $item)
			{
				$pictureSrc = '';
				if (!empty($item['PREVIEW_PICTURE']['SRC']))
				{
					$pictureSrc = $item['PREVIEW_PICTURE']['SRC'];
				}
				elseif (!empty($item['DETAIL_PICTURE']['SRC']))
				{
					$pictureSrc = $item['DETAIL_PICTURE']['SRC'];
				}

				$detailUrl = $item['DETAIL_PAGE_URL'];
				$minPrice = false;
				if (isset($item['MIN_PRICE']) || isset($item['RATIO_PRICE']))
					$minPrice = (isset($item['RATIO_PRICE']) ? $item['RATIO_PRICE'] : $item['MIN_PRICE']);
				?>
				<article class="catalog__item card" data-basket-id="<?=$item['ID']?>" data-product-id="<?=$item['PRODUCT_ID']?>" id="<?=$this->GetEditAreaId($uniqueId);?>" data-entity="item">
					<button class="btn btn-quad light favourite_btn" data-item="<?=$item['ID']?>">
						<svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg">
							<mask id="path-1-inside-1_350_1421" fill="white">
								<path d="M3.07848 0L2.73925 0.0398261L2.40637 0.116732L2.08112 0.229343L1.77111 0.379034L1.47635 0.564431L1.20192 0.780041L0.949081 1.02586L0.719116 1.29915L0.519644 1.59716L0.350665 1.91577L0.212177 2.25223L0.105453 2.60243L0.0355747 2.96223L0 3.32753V3.69696L0.0355747 4.06363L0.105453 4.42206L0.212177 4.77226L0.350665 5.10872L0.519644 5.42596L0.719116 5.72534L0.949081 5.99863L6.05015 11.5149C6.29203 11.7765 6.70547 11.7765 6.94741 11.515L12.0509 5.99863L12.2783 5.72534L12.4804 5.42596L12.6493 5.10872L12.7878 4.77226L12.8945 4.42206L12.9644 4.06363L13 3.69696V3.32753L12.9644 2.96223L12.8945 2.60243L12.7878 2.25223L12.6493 1.91577L12.4804 1.59716L12.2783 1.29915L12.0509 1.02586L11.7981 0.780041L11.5237 0.564431L11.2276 0.379034L10.9163 0.229343L10.5936 0.116732L10.2608 0.0398261L9.92152 0H9.58229L9.24433 0.0398261L8.91018 0.116732L8.5862 0.229343L8.27492 0.379034L7.98143 0.564431L7.70573 0.780041L7.45289 1.02586L6.49873 2.05722L5.54711 1.02586L5.29427 0.780041L5.01857 0.564431L4.72381 0.379034L4.41253 0.229343L4.08982 0.116732L3.75567 0.0398261L3.41771 0H3.07848ZM3.08991 0.704509H3.40373L3.71755 0.745708L4.02121 0.826734L4.3147 0.948959L4.59421 1.10552L4.85213 1.29778L5.08718 1.523L6.49873 3.05013L7.91282 1.523L8.14787 1.29778L8.40579 1.10552L8.6853 0.948959L8.97879 0.826734L9.28245 0.745708L9.59627 0.704509H9.90882L10.2214 0.745708L10.525 0.826734L10.8198 0.948959L11.098 1.10552L11.3559 1.29778L11.5923 1.523L11.8006 1.77844L11.9785 2.05722L12.1246 2.35798L12.2364 2.67521L12.3114 3.00481L12.3482 3.34264V3.68185L12.3114 4.01831L12.2364 4.34928L12.1246 4.66789L11.9785 4.96864L11.8006 5.24743L11.5923 5.50011L6.94742 10.5207C6.70548 10.7822 6.29203 10.7822 6.05016 10.5206L1.40774 5.50011L1.19937 5.24743L1.02023 4.96864L0.875391 4.66789L0.763585 4.34928L0.688624 4.01831L0.651779 3.68185V3.34264L0.688624 3.00481L0.763585 2.67521L0.875391 2.35798L1.02023 2.05722L1.19937 1.77844L1.40774 1.523L1.64279 1.29778L1.90197 1.10552L2.17895 0.948959L2.47244 0.826734L2.77483 0.745708L3.08991 0.704509Z" fill="white"/>
							</mask>
							<path d="M3.07848 0L2.73925 0.0398261L2.40637 0.116732L2.08112 0.229343L1.77111 0.379034L1.47635 0.564431L1.20192 0.780041L0.949081 1.02586L0.719116 1.29915L0.519644 1.59716L0.350665 1.91577L0.212177 2.25223L0.105453 2.60243L0.0355747 2.96223L0 3.32753V3.69696L0.0355747 4.06363L0.105453 4.42206L0.212177 4.77226L0.350665 5.10872L0.519644 5.42596L0.719116 5.72534L0.949081 5.99863L6.05015 11.5149C6.29203 11.7765 6.70547 11.7765 6.94741 11.515L12.0509 5.99863L12.2783 5.72534L12.4804 5.42596L12.6493 5.10872L12.7878 4.77226L12.8945 4.42206L12.9644 4.06363L13 3.69696V3.32753L12.9644 2.96223L12.8945 2.60243L12.7878 2.25223L12.6493 1.91577L12.4804 1.59716L12.2783 1.29915L12.0509 1.02586L11.7981 0.780041L11.5237 0.564431L11.2276 0.379034L10.9163 0.229343L10.5936 0.116732L10.2608 0.0398261L9.92152 0H9.58229L9.24433 0.0398261L8.91018 0.116732L8.5862 0.229343L8.27492 0.379034L7.98143 0.564431L7.70573 0.780041L7.45289 1.02586L6.49873 2.05722L5.54711 1.02586L5.29427 0.780041L5.01857 0.564431L4.72381 0.379034L4.41253 0.229343L4.08982 0.116732L3.75567 0.0398261L3.41771 0H3.07848ZM3.08991 0.704509H3.40373L3.71755 0.745708L4.02121 0.826734L4.3147 0.948959L4.59421 1.10552L4.85213 1.29778L5.08718 1.523L6.49873 3.05013L7.91282 1.523L8.14787 1.29778L8.40579 1.10552L8.6853 0.948959L8.97879 0.826734L9.28245 0.745708L9.59627 0.704509H9.90882L10.2214 0.745708L10.525 0.826734L10.8198 0.948959L11.098 1.10552L11.3559 1.29778L11.5923 1.523L11.8006 1.77844L11.9785 2.05722L12.1246 2.35798L12.2364 2.67521L12.3114 3.00481L12.3482 3.34264V3.68185L12.3114 4.01831L12.2364 4.34928L12.1246 4.66789L11.9785 4.96864L11.8006 5.24743L11.5923 5.50011L6.94742 10.5207C6.70548 10.7822 6.29203 10.7822 6.05016 10.5206L1.40774 5.50011L1.19937 5.24743L1.02023 4.96864L0.875391 4.66789L0.763585 4.34928L0.688624 4.01831L0.651779 3.68185V3.34264L0.688624 3.00481L0.763585 2.67521L0.875391 2.35798L1.02023 2.05722L1.19937 1.77844L1.40774 1.523L1.64279 1.29778L1.90197 1.10552L2.17895 0.948959L2.47244 0.826734L2.77483 0.745708L3.08991 0.704509Z" stroke="#191B22" stroke-width="16" mask="url(#path-1-inside-1_350_1421)"/>
						</svg>
					</button>
					<a href="<?=$detailUrl?>" class="catalog__item_image">
						<?if ($pictureSrc):?>
							<img src="<?=$pictureSrc?>" alt="<?=htmlspecialcharsbx($imgTitle($item))?>" width="166" height="252">
						<?else:?>
							<img src="<?=$this->GetFolder()?>/images/no_photo.png" alt="<?=htmlspecialcharsbx($imgTitle($item))?>" width="166" height="252">
						<?endif;?>
					</a>
					<div class="catalog__item_content">
						<div class="catalog__item_tags">
							<?if ($item['PROPERTIES']['NOVINKA']['VALUE']):?><span class="tag filter-tag">Новинка</span><?endif;?>
						</div>
						<a href="<?=$detailUrl?>" class="catalog__item_title">
							<h4><?=$productTitle($item)?></h4>
						</a>
						<div class="catalog__item_char">
							<div class="article">Арт. <?=$item['PROPERTIES']['CML2_ARTICLE']['VALUE']?></div>
							<div class="char__list">
								<? $un = $unitName($item); if ($un): ?>
								<div class="char__item">
									<span class="char__item_name"><?=$un?></span>
									<div class="char__item_value"><?=$item['PROPERTIES']['OBEM_VES_NETTO']['VALUE']?> <?=$item['PROPERTIES']['EDINITSA_IZMERENIYA_OBEMA_VESA_NETTO']['VALUE']?>.</div>
								</div>
								<? endif; ?>
								<div class="char__item">
									<span class="char__item_name">Стоимость</span>
									<div class="char__item_value"><? $printPrice($item); ?></div>
								</div>
							</div>
						</div>
						<div class="catalog__item_bottom" id="catalog-item-bottom-<?=$item['ID']?>">
							<? if ($item['BASKET_QUANTITY']) : ?>
								<div class="counter">
									<button class="btn btn-quad grey dec">
										<svg width="12" height="3" viewBox="0 0 12 3" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M0 3V0H12V3H0Z" fill="black" />
										</svg>
									</button>
									<input type="text" name="<?=$arParams['PRODUCT_QUANTITY_VARIABLE']?>" class="btn btn-quad counter_value" value="<?=$item['BASKET_QUANTITY']?>" data-value="<?=$item['BASKET_QUANTITY']?>">
									<button class="btn btn-quad grey inc">
										<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M5.03736 12V6.96264H0V5.02418H5.03736V0H6.97582V5.02418H12V6.96264H6.97582V12H5.03736Z" fill="black" />
										</svg>
									</button>
								</div>
								<button class="btn btn-grey js-remove-to-cart" data-id="<?=$item['ID']?>" rel="nofollow">Убрать из корзины</button>
							<? else : ?>
								<button class="btn btn-primary js-add-to-cart" data-id="<?=$item['ID']?>" rel="nofollow">Добавить в корзину</button>
							<? endif; ?>
						</div>
					</div>
				</article>
				<?
			}
			?>
			<!-- </div> -->
		</div>

		<div class="catalog__list column hide" data-entity="items-row">
			<!-- <div> -->
			<?
			foreach ($arResult['ITEMS'] as $item)
			{
				$pictureSrc = '';
				if (!empty($item['PREVIEW_PICTURE']['SRC']))
				{
					$pictureSrc = $item['PREVIEW_PICTURE']['SRC'];
				}
				elseif (!empty($item['DETAIL_PICTURE']['SRC']))
				{
					$pictureSrc = $item['DETAIL_PICTURE']['SRC'];
				}

				$detailUrl = $item['DETAIL_PAGE_URL'];
				?>
				<article class="catalog__item card" data-basket-id="<?=$item['ID']?>" data-product-id="<?=$item['PRODUCT_ID']?>" id="<?=$this->GetEditAreaId($uniqueId);?>" data-entity="item">
					<a href="<?=$detailUrl?>" class="catalog__item_image">
						<?if ($pictureSrc):?>
							<img src="<?=$pictureSrc?>" alt="<?=htmlspecialcharsbx($imgTitle($item))?>" width="71" height="108">
						<?else:?>
							<img src="<?=$this->GetFolder()?>/images/no_photo.png" alt="<?=htmlspecialcharsbx($imgTitle($item))?>" width="71" height="108">
						<?endif;?>
					</a>
					<div class="catalog__item_content">
						<div class="catalog__item_col">
							<a href="<?=$detailUrl?>" class="catalog__item_title">
								<h5><?=$productTitle($item)?></h5>
							</a>
							<div class="article">Арт. <?=$item['PROPERTIES']['CML2_ARTICLE']['VALUE']?></div>
						</div>
						<div class="catalog__item_col">
							<div class="catalog__item_char">
								<div class="char__list">
									<? $un = $unitName($item); if ($un): ?>
									<div class="char__item">
										<span class="char__item_name"><?=$un?></span>
										<div class="char__item_value"><?=$item['PROPERTIES']['OBEM_VES_NETTO']['VALUE']?> <?=$item['PROPERTIES']['EDINITSA_IZMERENIYA_OBEMA_VESA_NETTO']['VALUE']?>.</div>
									</div>
									<? endif; ?>
								</div>
							</div>
						</div>
						<div class="catalog__item_col">
							<div class="char__item">
								<span class="char__item_name">Стоимость</span>
								<div class="char__item_value"><? $printPrice($item); ?></div>
							</div>
							<div class="catalog__item_bottom" id="catalog-item-bottom-<?=$item['ID']?>">
								<? if ($item['BASKET_QUANTITY']) : ?>
									<div class="counter">
										<button class="btn btn-quad grey dec">
											<svg width="12" height="3" viewBox="0 0 12 3" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M0 3V0H12V3H0Z" fill="black" />
											</svg>
										</button>
										<input type="text" name="<?=$arParams['PRODUCT_QUANTITY_VARIABLE']?>" class="btn btn-quad counter_value" value="<?=$item['BASKET_QUANTITY']?>" data-value="<?=$item['BASKET_QUANTITY']?>">
										<button class="btn btn-quad grey inc">
											<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M5.03736 12V6.96264H0V5.02418H5.03736V0H6.97582V5.02418H12V6.96264H6.97582V12H5.03736Z" fill="black" />
											</svg>
										</button>
									</div>
									<button class="btn btn-grey js-remove-to-cart" data-id="<?=$item['ID']?>" rel="nofollow">Убрать из корзины</button>
								<? else : ?>
									<button class="btn btn-primary js-add-to-cart" data-id="<?=$item['ID']?>" rel="nofollow">Добавить в корзину</button>
								<? endif; ?>
								<button class="btn btn-quad light favourite_btn" data-item="<?=$item['ID']?>">
									<svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M3.07848 0L2.73925 0.0398261L2.40637 0.116732L2.08112 0.229343L1.77111 0.379034L1.47635 0.564431L1.20192 0.780041L0.949081 1.02586L0.719116 1.29915L0.519644 1.59716L0.350665 1.91577L0.212177 2.25223L0.105453 2.60243L0.0355747 2.96223L0 3.32753V3.69696L0.0355747 4.06363L0.105453 4.42206L0.212177 4.77226L0.350665 5.10872L0.519644 5.42596L0.719116 5.72534L0.949081 5.99863L6.05015 11.5149C6.29203 11.7765 6.70547 11.7765 6.94741 11.515L12.0509 5.99863L12.2783 5.72534L12.4804 5.42596L12.6493 5.10872L12.7878 4.77226L12.8945 4.42206L12.9644 4.06363L13 3.69696V3.32753L12.9644 2.96223L12.8945 2.60243L12.7878 2.25223L12.6493 1.91577L12.4804 1.59716L12.2783 1.29915L12.0509 1.02586L11.7981 0.780041L11.5237 0.564431L11.2276 0.379034L10.9163 0.229343L10.5936 0.116732L10.2608 0.0398261L9.92152 0H9.58229L9.24433 0.0398261L8.91018 0.116732L8.5862 0.229343L8.27492 0.379034L7.98143 0.564431L7.70573 0.780041L7.45289 1.02586L6.49873 2.05722L5.54711 1.02586L5.29427 0.780041L5.01857 0.564431L4.72381 0.379034L4.41253 0.229343L4.08982 0.116732L3.75567 0.0398261L3.41771 0H3.07848ZM3.08991 0.704509H3.40373L3.71755 0.745708L4.02121 0.826734L4.3147 0.948959L4.59421 1.10552L4.85213 1.29778L5.08718 1.523L6.49873 3.05013L7.91282 1.523L8.14787 1.29778L8.40579 1.10552L8.6853 0.948959L8.97879 0.826734L9.28245 0.745708L9.59627 0.704509H9.90882L10.2214 0.745708L10.525 0.826734L10.8198 0.948959L11.098 1.10552L11.3559 1.29778L11.5923 1.523L11.8006 1.77844L11.9785 2.05722L12.1246 2.35798L12.2364 2.67521L12.3114 3.00481L12.3482 3.34264V3.68185L12.3114 4.01831L12.2364 4.34928L12.1246 4.66789L11.9785 4.96864L11.8006 5.24743L11.5923 5.50011L6.94742 10.5207C6.70548 10.7822 6.29203 10.7822 6.05016 10.5206L1.40774 5.50011L1.19937 5.24743L1.02023 4.96864L0.875391 4.66789L0.763585 4.34928L0.688624 4.01831L0.651779 3.68185V3.34264L0.688624 3.00481L0.763585 2.67521L0.875391 2.35798L1.02023 2.05722L1.19937 1.77844L1.40774 1.523L1.64279 1.29778L1.90197 1.10552L2.17895 0.948959L2.47244 0.826734L2.77483 0.745708L3.08991 0.704509Z" fill="#191B22"/>
									</svg>
								</button>
							</div>
						</div>
					</div>
				</article>
				<?
			}
			?>
			<!-- </div> -->
		</div>

		<div class="catalog__list table hide" data-entity="items-row">
			<div class="catalog__list_head">
				<div>Наименование</div>
				<div class="catalog__item_col">
					<div class="type">Артикул</div>
					<div class="type"><? $un = $unitName(reset($arResult['ITEMS'])); echo $un ?: 'Объем'; ?></div>
					<div class="type">Цена</div>
				</div>
				<div></div>
			</div>
			<!-- <div> -->
			<?
			foreach ($arResult['ITEMS'] as $item)
			{
				$detailUrl = $item['DETAIL_PAGE_URL'];
				?>
				<article class="catalog__item card" data-basket-id="<?=$item['ID']?>" data-product-id="<?=$item['PRODUCT_ID']?>" id="<?=$this->GetEditAreaId($uniqueId);?>" data-entity="item">
					<a href="<?=$detailUrl?>" class="catalog__item_title">
						<h6><?=$productTitle($item)?></h6>
					</a>
					<div class="catalog__item_col">
						<div class="char__item">
							<span class="char__item_name">Артикул</span>
							<div class="char__item_value"><?=$item['PROPERTIES']['CML2_ARTICLE']['VALUE'] ? 'Арт. '.$item['PROPERTIES']['CML2_ARTICLE']['VALUE'] : '—'?></div>
						</div>
						<div class="char__item">
							<span class="char__item_name"><? $un = $unitName($item); echo $un ?: 'Объем'; ?></span>
							<div class="char__item_value"><?=$item['PROPERTIES']['OBEM_VES_NETTO']['VALUE']?> <?=$item['PROPERTIES']['EDINITSA_IZMERENIYA_OBEMA_VESA_NETTO']['VALUE']?>.</div>
						</div>
						<div class="char__item">
							<span class="char__item_name">Цена</span>
							<div class="char__item_value price"><? $printPrice($item); ?></div>
						</div>
					</div>
					<div class="catalog__item_bottom" id="catalog-item-bottom-<?=$item['ID']?>">
						<? if ($item['BASKET_QUANTITY']) : ?>
							<div class="counter">
								<button class="btn btn-quad grey dec">
									<svg width="12" height="3" viewBox="0 0 12 3" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M0 3V0H12V3H0Z" fill="black" />
									</svg>
								</button>
								<input type="text" name="<?=$arParams['PRODUCT_QUANTITY_VARIABLE']?>" class="btn btn-quad counter_value" value="<?=$item['BASKET_QUANTITY']?>" data-value="<?=$item['BASKET_QUANTITY']?>">
								<button class="btn btn-quad grey inc">
									<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M5.03736 12V6.96264H0V5.02418H5.03736V0H6.97582V5.02418H12V6.96264H6.97582V12H5.03736Z" fill="black" />
									</svg>
								</button>
							</div>
							<button class="btn btn-grey js-remove-to-cart" data-id="<?=$item['ID']?>" rel="nofollow">Убрать из корзины</button>
						<? else : ?>
							<button class="btn btn-primary js-add-to-cart" data-id="<?=$item['ID']?>" rel="nofollow">Добавить в корзину</button>
						<? endif; ?>
						<button class="btn btn-quad light favourite_btn" data-item="<?=$item['ID']?>">
							<svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M3.07848 0L2.73925 0.0398261L2.40637 0.116732L2.08112 0.229343L1.77111 0.379034L1.47635 0.564431L1.20192 0.780041L0.949081 1.02586L0.719116 1.29915L0.519644 1.59716L0.350665 1.91577L0.212177 2.25223L0.105453 2.60243L0.0355747 2.96223L0 3.32753V3.69696L0.0355747 4.06363L0.105453 4.42206L0.212177 4.77226L0.350665 5.10872L0.519644 5.42596L0.719116 5.72534L0.949081 5.99863L6.05015 11.5149C6.29203 11.7765 6.70547 11.7765 6.94741 11.515L12.0509 5.99863L12.2783 5.72534L12.4804 5.42596L12.6493 5.10872L12.7878 4.77226L12.8945 4.42206L12.9644 4.06363L13 3.69696V3.32753L12.9644 2.96223L12.8945 2.60243L12.7878 2.25223L12.6493 1.91577L12.4804 1.59716L12.2783 1.29915L12.0509 1.02586L11.7981 0.780041L11.5237 0.564431L11.2276 0.379034L10.9163 0.229343L10.5936 0.116732L10.2608 0.0398261L9.92152 0H9.58229L9.24433 0.0398261L8.91018 0.116732L8.5862 0.229343L8.27492 0.379034L7.98143 0.564431L7.70573 0.780041L7.45289 1.02586L6.49873 2.05722L5.54711 1.02586L5.29427 0.780041L5.01857 0.564431L4.72381 0.379034L4.41253 0.229343L4.08982 0.116732L3.75567 0.0398261L3.41771 0H3.07848ZM3.08991 0.704509H3.40373L3.71755 0.745708L4.02121 0.826734L4.3147 0.948959L4.59421 1.10552L4.85213 1.29778L5.08718 1.523L6.49873 3.05013L7.91282 1.523L8.14787 1.29778L8.40579 1.10552L8.6853 0.948959L8.97879 0.826734L9.28245 0.745708L9.59627 0.704509H9.90882L10.2214 0.745708L10.525 0.826734L10.8198 0.948959L11.098 1.10552L11.3559 1.29778L11.5923 1.523L11.8006 1.77844L11.9785 2.05722L12.1246 2.35798L12.2364 2.67521L12.3114 3.00481L12.3482 3.34264V3.68185L12.3114 4.01831L12.2364 4.34928L12.1246 4.66789L11.9785 4.96864L11.8006 5.24743L11.5923 5.50011L6.94742 10.5207C6.70548 10.7822 6.29203 10.7822 6.05016 10.5206L1.40774 5.50011L1.19937 5.24743L1.02023 4.96864L0.875391 4.66789L0.763585 4.34928L0.688624 4.01831L0.651779 3.68185V3.34264L0.688624 3.00481L0.763585 2.67521L0.875391 2.35798L1.02023 2.05722L1.19937 1.77844L1.40774 1.523L1.64279 1.29778L1.90197 1.10552L2.17895 0.948959L2.47244 0.826734L2.77483 0.745708L3.08991 0.704509Z" fill="#191B22"/>
							</svg>
						</button>
					</div>
				</article>
				<?
			}
			?>
			<!-- </div> -->
		</div>
		<!-- items-container -->
		<?
	}
	else
	{
		?>
		<div class="catalog__list grid active">
			<div data-entity="items-row">
				<p>Товары не найдены</p>
			</div>
		</div>
		<?
	}
	?>
</div>
<?
if ($showLazyLoad)
{
	?>
	<div class="catalog__bottom">
		<button class="btn btn-light btn-full" data-use="show-more-<?=$navParams['NavNum']?>">
			<?=$arParams['MESS_BTN_LAZY_LOAD'] ?? 'Показать еще'?>
		</button>
	</div>
	<?
}

if ($showBottomPager)
{
	?>
	<div data-pagination-num="<?=$navParams['NavNum']?>">
		<!-- pagination-container -->
		<?=$arResult['NAV_STRING']?>
		<!-- pagination-container -->
	</div>
	<?
}

$signer = new \Bitrix\Main\Security\Sign\Signer;
$signedTemplate = $signer->sign($templateName, 'catalog.section');
$signedParams = $signer->sign(base64_encode(serialize($arResult['ORIGINAL_PARAMETERS'])), 'catalog.section');
?>
<script>
	BX.message({
		BTN_MESSAGE_BASKET_REDIRECT: '<?=GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_BASKET_REDIRECT')?>',
		BASKET_URL: '<?=$arParams['BASKET_URL']?>',
		ADD_TO_BASKET_OK: '<?=GetMessageJS('ADD_TO_BASKET_OK')?>',
		TITLE_ERROR: '<?=GetMessageJS('CT_BCS_CATALOG_TITLE_ERROR')?>',
		TITLE_BASKET_PROPS: '<?=GetMessageJS('CT_BCS_CATALOG_TITLE_BASKET_PROPS')?>',
		TITLE_SUCCESSFUL: '<?=GetMessageJS('ADD_TO_BASKET_OK')?>',
		BASKET_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCS_CATALOG_BASKET_UNKNOWN_ERROR')?>',
		BTN_MESSAGE_SEND_PROPS: '<?=GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_SEND_PROPS')?>',
		BTN_MESSAGE_CLOSE: '<?=GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE')?>',
		BTN_MESSAGE_CLOSE_POPUP: '<?=GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE_POPUP')?>',
		COMPARE_MESSAGE_OK: '<?=GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_OK')?>',
		COMPARE_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_UNKNOWN_ERROR')?>',
		COMPARE_TITLE: '<?=GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_TITLE')?>',
		PRICE_TOTAL_PREFIX: '<?=GetMessageJS('CT_BCS_CATALOG_PRICE_TOTAL_PREFIX')?>',
		RELATIVE_QUANTITY_MANY: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY'])?>',
		RELATIVE_QUANTITY_FEW: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW'])?>',
		BTN_MESSAGE_COMPARE_REDIRECT: '<?=GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT')?>',
		BTN_MESSAGE_LAZY_LOAD: '<?=CUtil::JSEscape($arParams['MESS_BTN_LAZY_LOAD'])?>',
		BTN_MESSAGE_LAZY_LOAD_WAITER: '<?=GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_LAZY_LOAD_WAITER')?>',
		SITE_ID: '<?=CUtil::JSEscape($component->getSiteId())?>'
	});
	var <?=$obName?> = new JCCatalogSectionComponent({
		siteId: '<?=CUtil::JSEscape($component->getSiteId())?>',
		componentPath: '<?=CUtil::JSEscape($componentPath)?>',
		navParams: <?=CUtil::PhpToJSObject($navParams)?>,
		deferredLoad: false,
		initiallyShowHeader: '<?=!empty($arResult['ITEM_ROWS'])?>',
		bigData: <?=CUtil::PhpToJSObject($arResult['BIG_DATA'])?>,
		lazyLoad: !!'<?=$showLazyLoad?>',
		loadOnScroll: !!'<?=($arParams['LOAD_ON_SCROLL'] === 'Y')?>',
		template: '<?=CUtil::JSEscape($signedTemplate)?>',
		ajaxId: '<?=CUtil::JSEscape($arParams['AJAX_ID'] ?? '')?>',
		parameters: '<?=CUtil::JSEscape($signedParams)?>',
		container: '<?=$containerName?>'
	});
</script>

<script>
	document.addEventListener('click', function(e) {
		if (e.target.closest('.js-add-to-cart')) {
			const btn = e.target.closest('.js-add-to-cart');
			const card = e.target.closest('.card')
			const cardBottom = card.querySelector('.catalog__item_bottom')
			// const counter = card.querySelector('[name=quantity]')
			// const qty = counter.value
			
			if (!btn) {
				return;
			}

			btn.disabled = true

			e.preventDefault();

			BX.ajax({
			url: '/local/ajax/cart.php',
				method: 'POST',
				dataType: 'json',
				data: {
					action: 'add',
					id: btn.dataset.id,
					quantity: 1
				},
				onsuccess: function(response) {
					BX.onCustomEvent('OnBasketChange');
					BX.ajax({
						url: location.href,
						method: 'GET',
						dataType: 'html',
						processData: false,
						onsuccess: (res) => {

							// const newCardBottom = $(res).find(`#${cardBottom.id}`);

							// if (newCardBottom) {
							// 	$(cardBottom).replaceWith($(newCardBottom));
							// }
							const parser = new DOMParser();
							const doc = parser.parseFromString(res, 'text/html');

							const newCardBottom = doc.querySelector(`#${cardBottom.id}`);

							if (newCardBottom) {
								cardBottom.replaceWith(newCardBottom);
							}
						}
					})
					
				}
			});
		}

		if (e.target.closest('.js-remove-to-cart')) {
			const btn = e.target.closest('.js-remove-to-cart');
			const card = e.target.closest('.card')
			const counter = card.querySelector('[name=quantity]')
			const qty = counter.value
			const basketId = card.dataset.basketId;
			const cardBottom = card.querySelector('.catalog__item_bottom')
			
			
			if (!btn) {
				return;
			}
			btn.disabled = true

			e.preventDefault();

			BX.ajax({
				url: '/local/ajax/cart.php',
				method: 'POST',
				dataType: 'json',
				data: {
					action: 'delete',
					id: btn.dataset.id
				},
				onsuccess: function(response) {
					BX.onCustomEvent('OnBasketChange');
					BX.ajax({
						url: location.href,
						method: 'GET',
						dataType: 'html',
						processData: false,
						onsuccess: (res) => {

							// const newCardBottom = $(res).find(`#${cardBottom.id}`);

							// if (newCardBottom) {
							// 	$(cardBottom).replaceWith($(newCardBottom));
							// }
							const parser = new DOMParser();
							const doc = parser.parseFromString(res, 'text/html');

							const newCardBottom = doc.querySelector(`#${cardBottom.id}`);

							if (newCardBottom) {
								cardBottom.replaceWith(newCardBottom);
							}
						}
					})
				}
			});
		}

		if (e.target.closest('.dec')) {
			const btn = e.target.closest('.dec');
			const card = e.target.closest('.card')
			const cardBottom = card.querySelector('.catalog__item_bottom')
			const counter = card.querySelector('[name=quantity]')
			const qty = counter.value
			
			if (!btn) {
				return;
			}
				btn.disabled = true

			if (qty <= 0) {
				BX.ajax({
				url: '/local/ajax/cart.php',
				method: 'POST',
				dataType: 'json',
				data: {
					action: 'delete',
					id: card.dataset.basketId
				},
				onsuccess: function(response) {
					BX.onCustomEvent('OnBasketChange');
					BX.ajax({
						url: location.href,
						method: 'GET',
						dataType: 'html',
						processData: false,
						onsuccess: (res) => {
							btn.disabled = false
							// const newCardBottom = $(res).find(`#${cardBottom.id}`);

							// if (newCardBottom) {
							// 	$(cardBottom).replaceWith($(newCardBottom));
							// }
							const parser = new DOMParser();
							const doc = parser.parseFromString(res, 'text/html');

							const newCardBottom = doc.querySelector(`#${cardBottom.id}`);

							if (newCardBottom) {
								cardBottom.replaceWith(newCardBottom);
							}
						}
					})
				}
			});
			} else {

				BX.ajax({
					url: '/local/ajax/cart.php',
					method: 'POST',
					dataType: 'json',
					
					data: {
						action: 'update',
						id: card.dataset.basketId,
						quantity: qty
					},
					onsuccess: function(response) {
						BX.onCustomEvent('OnBasketChange');
						btn.disabled = false
						
					}
				});
			}
			
		}

		if (e.target.closest('.inc')) {
			const btn = e.target.closest('.inc');
			const card = e.target.closest('.card')
			const cardBottom = card.querySelector('.catalog__item_bottom')
			const counter = card.querySelector('[name=quantity]')
			const qty = counter.value
			
			if (!btn) {
				return;
			}

			
			btn.disabled = true

			BX.ajax({
				url: '/local/ajax/cart.php',
				method: 'POST',
				dataType: 'json',
				data: {
					action: 'update',
					id: card.dataset.basketId,
					quantity: qty
				},
				onsuccess: function(response) {
					BX.onCustomEvent('OnBasketChange');
					btn.disabled = false
					// BX.ajax({
					// 	url: location.href,
					// 	method: 'GET',
					// 	dataType: 'html',
					// 	onsuccess: (res) => {

					// 		const newCardBottom = $(res).find(`#${cardBottom.id}`);

					// 		if (newCardBottom) {
					// 			$(cardBottom).replaceWith($(newCardBottom));
					// 		}
					// 	}
					// })
					
				},
			});
			
			
		}
		
	});
</script>
<!-- component-end -->
