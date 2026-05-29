<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 */

$this->setFrameMode(true);

$templateLibrary = array('popup');
$currencyList = '';

if (!empty($arResult['CURRENCIES']))
{
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$templateData = array(
	'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList
);
unset($currencyList, $templateLibrary);

$elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
$elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
$elementDeleteParams = array('CONFIRM' => GetMessage('CT_CPV_TPL_ELEMENT_DELETE_CONFIRM'));

$positionClassMap = array(
	'left' => 'product-item-label-left',
	'center' => 'product-item-label-center',
	'right' => 'product-item-label-right',
	'bottom' => 'product-item-label-bottom',
	'middle' => 'product-item-label-middle',
	'top' => 'product-item-label-top'
);

$discountPositionClass = '';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION']))
{
	foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos)
	{
		$discountPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}

$labelPositionClass = '';
if (!empty($arParams['LABEL_PROP_POSITION']))
{
	foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos)
	{
		$labelPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}

$arParams['~MESS_BTN_BUY'] = $arParams['~MESS_BTN_BUY'] ?: Loc::getMessage('CT_CPV_TPL_MESS_BTN_BUY');
$arParams['~MESS_BTN_DETAIL'] = $arParams['~MESS_BTN_DETAIL'] ?: Loc::getMessage('CT_CPV_TPL_MESS_BTN_DETAIL');
$arParams['~MESS_BTN_COMPARE'] = $arParams['~MESS_BTN_COMPARE'] ?: Loc::getMessage('CT_CPV_TPL_MESS_BTN_COMPARE');
$arParams['~MESS_BTN_SUBSCRIBE'] = $arParams['~MESS_BTN_SUBSCRIBE'] ?: Loc::getMessage('CT_CPV_TPL_MESS_BTN_SUBSCRIBE');
$arParams['~MESS_BTN_ADD_TO_BASKET'] = $arParams['~MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_CPV_TPL_MESS_BTN_ADD_TO_BASKET');
$arParams['~MESS_NOT_AVAILABLE'] = $arParams['~MESS_NOT_AVAILABLE'] ?: Loc::getMessage('CT_CPV_TPL_MESS_PRODUCT_NOT_AVAILABLE');
$arParams['~MESS_SHOW_MAX_QUANTITY'] = $arParams['~MESS_SHOW_MAX_QUANTITY'] ?: Loc::getMessage('CT_CPV_CATALOG_SHOW_MAX_QUANTITY');
$arParams['~MESS_RELATIVE_QUANTITY_MANY'] = $arParams['~MESS_RELATIVE_QUANTITY_MANY'] ?: Loc::getMessage('CT_CPV_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['~MESS_RELATIVE_QUANTITY_FEW'] = $arParams['~MESS_RELATIVE_QUANTITY_FEW'] ?: Loc::getMessage('CT_CPV_CATALOG_RELATIVE_QUANTITY_FEW');

$generalParams = array(
	'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
	'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
	'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
	'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
	'MESS_SHOW_MAX_QUANTITY' => $arParams['~MESS_SHOW_MAX_QUANTITY'],
	'MESS_RELATIVE_QUANTITY_MANY' => $arParams['~MESS_RELATIVE_QUANTITY_MANY'],
	'MESS_RELATIVE_QUANTITY_FEW' => $arParams['~MESS_RELATIVE_QUANTITY_FEW'],
	'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
	'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
	'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
	'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
	'ADD_PROPERTIES_TO_BASKET' => $arParams['ADD_PROPERTIES_TO_BASKET'],
	'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
	'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'],
	'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
	'COMPARE_PATH' => $arParams['COMPARE_PATH'],
	'COMPARE_NAME' => $arParams['COMPARE_NAME'],
	'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
	'PRODUCT_BLOCKS_ORDER' => $arParams['PRODUCT_BLOCKS_ORDER'],
	'LABEL_POSITION_CLASS' => $labelPositionClass,
	'DISCOUNT_POSITION_CLASS' => $discountPositionClass,
	'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
	'SLIDER_PROGRESS' => $arParams['SLIDER_PROGRESS'],
	'~BASKET_URL' => $arParams['~BASKET_URL'],
	'~ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
	'~BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE'],
	'~COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
	'~COMPARE_DELETE_URL_TEMPLATE' => $arResult['~COMPARE_DELETE_URL_TEMPLATE'],
	'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
	'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
	'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
	'MESS_BTN_BUY' => $arParams['~MESS_BTN_BUY'],
	'MESS_BTN_DETAIL' => $arParams['~MESS_BTN_DETAIL'],
	'MESS_BTN_COMPARE' => $arParams['~MESS_BTN_COMPARE'],
	'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
	'MESS_BTN_ADD_TO_BASKET' => $arParams['~MESS_BTN_ADD_TO_BASKET'],
	'MESS_NOT_AVAILABLE' => $arParams['~MESS_NOT_AVAILABLE']
);

$obName = 'ob'.preg_replace('/[^a-zA-Z0-9_]/', 'x', $this->GetEditAreaId($this->randString()));
$containerName = 'catalog-products-viewed-container';
?>

<div class="catalog__list catalog-top grid swiper" data-entity="<?=$containerName?>">
		<?
		if (!empty($arResult['ITEMS']) && !empty($arResult['ITEM_ROWS']))
		{
			$areaIds = array();

			foreach ($arResult['ITEMS'] as $item)
			{
				$uniqueId = $item['ID'].'_'.md5($this->randString().$component->getAction());
				$areaIds[$item['ID']] = $this->GetEditAreaId($uniqueId);
				$this->AddEditAction($uniqueId, $item['EDIT_LINK'], $elementEdit);
				$this->AddDeleteAction($uniqueId, $item['DELETE_LINK'], $elementDelete, $elementDeleteParams);
			}
			?>
			<!-- items-container -->
			<?
			// printR($arResult);
			foreach ($arResult['ITEM_ROWS'] as $rowData)
			{
				$rowItems = array_splice($arResult['ITEMS'], 0, $rowData['COUNT']);
				?>
					<?
						foreach ($rowItems as $item)
						{
							$productTitle = (
								isset($item['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])&& $item['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] != ''
								? $item['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
								: $item['NAME']
							);
							$imgTitle = (
								isset($item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']) && $item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE'] != ''
								? $item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']
								: $item['NAME']
							);
							?>
							<div class="swiper-slide" id="<? echo $strMainID; ?>">
								<article class="catalog__item card" data-basket-id="<?=$item['ID']?>"
										data-product-id="<?=$item['PRODUCT_ID']?>"> 
									<button class="btn btn-quad light favourite_btn"> 
										<svg
											width="13" height="12" viewBox="0 0 13 12" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<mask id="path-1-inside-1_350_1421" fill="white">
												<path
													d="M3.07848 0L2.73925 0.0398261L2.40637 0.116732L2.08112 0.229343L1.77111 0.379034L1.47635 0.564431L1.20192 0.780041L0.949081 1.02586L0.719116 1.29915L0.519644 1.59716L0.350665 1.91577L0.212177 2.25223L0.105453 2.60243L0.0355747 2.96223L0 3.32753V3.69696L0.0355747 4.06363L0.105453 4.42206L0.212177 4.77226L0.350665 5.10872L0.519644 5.42596L0.719116 5.72534L0.949081 5.99863L6.05015 11.5149C6.29203 11.7765 6.70547 11.7765 6.94741 11.515L12.0509 5.99863L12.2783 5.72534L12.4804 5.42596L12.6493 5.10872L12.7878 4.77226L12.8945 4.42206L12.9644 4.06363L13 3.69696V3.32753L12.9644 2.96223L12.8945 2.60243L12.7878 2.25223L12.6493 1.91577L12.4804 1.59716L12.2783 1.29915L12.0509 1.02586L11.7981 0.780041L11.5237 0.564431L11.2276 0.379034L10.9163 0.229343L10.5936 0.116732L10.2608 0.0398261L9.92152 0H9.58229L9.24433 0.0398261L8.91018 0.116732L8.5862 0.229343L8.27492 0.379034L7.98143 0.564431L7.70573 0.780041L7.45289 1.02586L6.49873 2.05722L5.54711 1.02586L5.29427 0.780041L5.01857 0.564431L4.72381 0.379034L4.41253 0.229343L4.08982 0.116732L3.75567 0.0398261L3.41771 0H3.07848ZM3.08991 0.704509H3.40373L3.71755 0.745708L4.02121 0.826734L4.3147 0.948959L4.59421 1.10552L4.85213 1.29778L5.08718 1.523L6.49873 3.05013L7.91282 1.523L8.14787 1.29778L8.40579 1.10552L8.6853 0.948959L8.97879 0.826734L9.28245 0.745708L9.59627 0.704509H9.90882L10.2214 0.745708L10.525 0.826734L10.8198 0.948959L11.098 1.10552L11.3559 1.29778L11.5923 1.523L11.8006 1.77844L11.9785 2.05722L12.1246 2.35798L12.2364 2.67521L12.3114 3.00481L12.3482 3.34264V3.68185L12.3114 4.01831L12.2364 4.34928L12.1246 4.66789L11.9785 4.96864L11.8006 5.24743L11.5923 5.50011L6.94742 10.5207C6.70548 10.7822 6.29203 10.7822 6.05016 10.5206L1.40774 5.50011L1.19937 5.24743L1.02023 4.96864L0.875391 4.66789L0.763585 4.34928L0.688624 4.01831L0.651779 3.68185V3.34264L0.688624 3.00481L0.763585 2.67521L0.875391 2.35798L1.02023 2.05722L1.19937 1.77844L1.40774 1.523L1.64279 1.29778L1.90197 1.10552L2.17895 0.948959L2.47244 0.826734L2.77864 0.745708L3.08991 0.704509Z">
												</path>
											</mask>
											<path
												d="M3.07848 0L2.73925 0.0398261L2.40637 0.116732L2.08112 0.229343L1.77111 0.379034L1.47635 0.564431L1.20192 0.780041L0.949081 1.02586L0.719116 1.29915L0.519644 1.59716L0.350665 1.91577L0.212177 2.25223L0.105453 2.60243L0.0355747 2.96223L0 3.32753V3.69696L0.0355747 4.06363L0.105453 4.42206L0.212177 4.77226L0.350665 5.10872L0.519644 5.42596L0.719116 5.72534L0.949081 5.99863L6.05015 11.5149C6.29203 11.7765 6.70547 11.7765 6.94741 11.515L12.0509 5.99863L12.2783 5.72534L12.4804 5.42596L12.6493 5.10872L12.7878 4.77226L12.8945 4.42206L12.9644 4.06363L13 3.69696V3.32753L12.9644 2.96223L12.8945 2.60243L12.7878 2.25223L12.6493 1.91577L12.4804 1.59716L12.2783 1.29915L12.0509 1.02586L11.7981 0.780041L11.5237 0.564431L11.2276 0.379034L10.9163 0.229343L10.5936 0.116732L10.2608 0.0398261L9.92152 0H9.58229L9.24433 0.0398261L8.91018 0.116732L8.5862 0.229343L8.27492 0.379034L7.98143 0.564431L7.70573 0.780041L7.45289 1.02586L6.49873 2.05722L5.54711 1.02586L5.29427 0.780041L5.01857 0.564431L4.72381 0.379034L4.41253 0.229343L4.08982 0.116732L3.75567 0.0398261L3.41771 0H3.07848ZM3.08991 0.704509H3.40373L3.71755 0.745708L4.02121 0.826734L4.3147 0.948959L4.59421 1.10552L4.85213 1.29778L5.08718 1.523L6.49873 3.05013L7.91282 1.523L8.14787 1.29778L8.40579 1.10552L8.6853 0.948959L8.97879 0.826734L9.28245 0.745708L9.59627 0.704509H9.90882L10.2214 0.745708L10.525 0.826734L10.8198 0.948959L11.098 1.10552L11.3559 1.29778L11.5923 1.523L11.8006 1.77844L11.9785 2.05722L12.1246 2.35798L12.2364 2.67521L12.3114 3.00481L12.3482 3.34264V3.68185L12.3114 4.01831L12.2364 4.34928L12.1246 4.66789L11.9785 4.96864L11.8006 5.24743L11.5923 5.50011L6.94742 10.5207C6.70548 10.7822 6.29203 10.7822 6.05016 10.5206L1.40774 5.50011L1.19937 5.24743L1.02023 4.96864L0.875391 4.66789L0.763585 4.34928L0.688624 4.01831L0.651779 3.68185V3.34264L0.688624 3.00481L0.763585 2.67521L0.875391 2.35798L1.02023 2.05722L1.19937 1.77844L1.40774 1.523L1.64279 1.29778L1.90197 1.10552L2.17895 0.948959L2.47244 0.826734L2.77864 0.745708L3.08991 0.704509Z"
												stroke="#191B22" stroke-width="16" mask="url(#path-1-inside-1_350_1421)">
											</path>
										</svg> 
									</button> 
									<a href="<? echo $item['DETAIL_PAGE_URL']; ?>" class="catalog__item_image"> 
										<img
											src="<? echo $item['PREVIEW_PICTURE']['SRC']; ?>" alt="<? echo $imgTitle; ?>"  width="166" height="252"> 
									</a>
									<div class="catalog__item_content">
										<div class="catalog__item_tags"> 
											<? if ($item['DISPLAY_PROPERTIES']['NOVINKA']['VALUE']) : ?><span class="tag filter-tag">Новинка</span><? endif; ?>
											<!-- <span class="tag filter-tag">Акция</span>  -->
										</div> <a href="<? echo $item['DETAIL_PAGE_URL']; ?>"
											class="catalog__item_title">
											<h4><? echo $productTitle; ?></h4>
										</a>
										<div class="catalog__item_char">
											<div class="article">Арт. <?=$item['DISPLAY_PROPERTIES']['CML2_ARTICLE']['VALUE'] ?></div>
											<div class="char__list">
												<div class="char__item"> <span class="char__item_name"><?=$item['DISPLAY_PROPERTIES']['EDINITSA_IZMERENIYA_OBEMA_VESA_NETTO']['VALUE'] == 'кг' ? 'Вес' : 'Объем' ?></span>
													<div class="char__item_value"><?=$item['DISPLAY_PROPERTIES']['OBEM_VES_NETTO']['VALUE']?> <?=$item['DISPLAY_PROPERTIES']['EDINITSA_IZMERENIYA_OBEMA_VESA_NETTO']['VALUE']?>.</div>
												</div>
												<!-- <div class="char__item"> <span class="char__item_name">Вес брутто</span>
													<div class="char__item_value">219,5 кг.</div>
												</div> -->
												<div id="<? echo $itemIDs['PRICE']; ?>" class="char__item">
													<span class="char__item_name">Стоимость</span>
													<div class="char__item_value">
														<?
														$hasPrice = !empty($minPrice) || !empty($item['ITEM_PRICES'][0]['PRINT_PRICE']);
														if ($hasPrice):
															if ($USER->IsAuthorized()):
																if (!empty($minPrice)):
																	if ('N' == $arParams['PRODUCT_DISPLAY_MODE'] && isset($item['OFFERS']) && !empty($item['OFFERS'])):
																		echo GetMessage(
																			'CT_BCT_TPL_MESS_PRICE_SIMPLE_MODE',
																			array(
																				'#PRICE#' => $minPrice['PRINT_DISCOUNT_VALUE'],
																				'#MEASURE#' => GetMessage(
																					'CT_BCT_TPL_MESS_MEASURE_SIMPLE_MODE',
																					array(
																						'#VALUE#' => $minPrice['CATALOG_MEASURE_RATIO'],
																						'#UNIT#' => $minPrice['CATALOG_MEASURE_NAME']
																					)
																				)
																			)
																		);
																	else:
																		echo $minPrice['PRINT_DISCOUNT_VALUE'];
																	endif;
																	if ('Y' == $arParams['SHOW_OLD_PRICE'] && $minPrice['DISCOUNT_VALUE'] < $minPrice['VALUE']):
																		?> <span><? echo $minPrice['PRINT_VALUE']; ?></span><?
																	endif;
																endif;
																echo $item['ITEM_PRICES'][0]['PRINT_PRICE'];
															else:
																?>Цена по запросу<?
															endif;
														else:
															?>Цена по запросу<?
														endif;
														unset($minPrice);
														?>
													</div>
												</div>
												
											</div>
										</div>
										<div class="catalog__item_bottom" id="catalog-item-bottom-<?=$item['ID']?>">
											<? if ($item['BASKET_QUANTITY']) : ?>
												<div class="counter"> 
													<button class="btn btn-quad grey dec"> 
														<svg width="12"
															height="3" viewBox="0 0 12 3" fill="none"
															xmlns="http://www.w3.org/2000/svg">
															<path d="M0 3V0H12V3H0Z" fill="black"></path>
														</svg> 
													</button> 
													<input type="text" name="<? echo $arParams["PRODUCT_QUANTITY_VARIABLE"]; ?>"
														class="btn btn-quad counter_value" value="<? echo $item['BASKET_QUANTITY']; ?>" data-value="<? echo $item['BASKET_QUANTITY']; ?>"> 
													<button
														class="btn btn-quad grey inc"> 
														<svg width="12" height="12"
															viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path
																d="M5.03736 12V6.96264H0V5.02418H5.03736V0H6.97582V5.02418H12V6.96264H6.97582V12H5.03736Z"
																fill="black"></path>
														</svg> 
													</button> 
												</div> 
											<? endif; ?>
											<? if ($item['BASKET_QUANTITY']) : ?>
												<button id="<? echo $itemIDs['BUY_LINK']; ?>" class="btn btn-grey js-remove-to-cart" data-id="<?=$item['ID']?>" rel="nofollow">
												Убрать из корзины
											</button>
											<? else : ?>
											<button id="<? echo $itemIDs['BUY_LINK']; ?>" class="btn btn-primary js-add-to-cart" data-id="<?=$item['ID']?>" rel="nofollow">
												Добавить в корзину
											</button>
											<? endif; ?>
										</div>
									</div>
									<div id="<? echo $itemIDs['BASKET_ACTIONS']; ?>">
		
									</div>

									<div
										id="<? echo $itemIDs['NOT_AVAILABLE_MESS']; ?>"
										style="display:none;"
									></div>

									<div
										id="<? echo $itemIDs['PICT']; ?>"
										style="display:none;"
									></div>
								</article>
							</div>
							<?
						}
									
					?>
				<?
			}
			unset($generalParams, $rowItems);
			?>
			<!-- items-container -->
			<?
		}
		else
		{
			// load css for bigData/deferred load
			$APPLICATION->IncludeComponent(
				'bitrix:catalog.item',
				'',
				array(),
				$component,
				array('HIDE_ICONS' => 'Y')
			);
		}
		?>
</div>
<script>
	BX.message({
		BTN_MESSAGE_BASKET_REDIRECT: '<?=GetMessageJS('CT_CPV_CATALOG_BTN_MESSAGE_BASKET_REDIRECT')?>',
		BASKET_URL: '<?=$arParams['BASKET_URL']?>',
		ADD_TO_BASKET_OK: '<?=GetMessageJS('ADD_TO_BASKET_OK')?>',
		TITLE_ERROR: '<?=GetMessageJS('CT_CPV_CATALOG_TITLE_ERROR')?>',
		TITLE_BASKET_PROPS: '<?=GetMessageJS('CT_CPV_CATALOG_TITLE_BASKET_PROPS')?>',
		TITLE_SUCCESSFUL: '<?=GetMessageJS('ADD_TO_BASKET_OK')?>',
		BASKET_UNKNOWN_ERROR: '<?=GetMessageJS('CT_CPV_CATALOG_BASKET_UNKNOWN_ERROR')?>',
		BTN_MESSAGE_SEND_PROPS: '<?=GetMessageJS('CT_CPV_CATALOG_BTN_MESSAGE_SEND_PROPS')?>',
		BTN_MESSAGE_CLOSE: '<?=GetMessageJS('CT_CPV_CATALOG_BTN_MESSAGE_CLOSE')?>',
		BTN_MESSAGE_CLOSE_POPUP: '<?=GetMessageJS('CT_CPV_CATALOG_BTN_MESSAGE_CLOSE_POPUP')?>',
		COMPARE_MESSAGE_OK: '<?=GetMessageJS('CT_CPV_CATALOG_MESS_COMPARE_OK')?>',
		COMPARE_UNKNOWN_ERROR: '<?=GetMessageJS('CT_CPV_CATALOG_MESS_COMPARE_UNKNOWN_ERROR')?>',
		COMPARE_TITLE: '<?=GetMessageJS('CT_CPV_CATALOG_MESS_COMPARE_TITLE')?>',
		PRICE_TOTAL_PREFIX: '<?=GetMessageJS('CT_CPV_CATALOG_PRICE_TOTAL_PREFIX')?>',
		RELATIVE_QUANTITY_MANY: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY'])?>',
		RELATIVE_QUANTITY_FEW: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW'])?>',
		BTN_MESSAGE_COMPARE_REDIRECT: '<?=GetMessageJS('CT_CPV_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT')?>',
		SITE_ID: '<?=CUtil::JSEscape($component->getSiteId())?>'
	});
	var <?=$obName?> = new JCCatalogProductsViewedComponent({
		initiallyShowHeader: '<?=!empty($arResult['ITEM_ROWS'])?>',
		container: '<?=$containerName?>'
	});
</script>