<?php
    if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
    }
use Bitrix\Catalog\ProductTable;
    /** @var array $arParams */
    /** @var array $arResult */
    /** @global CMain $APPLICATION */
    /** @global CUser $USER */
    /** @global CDatabase $DB */
    /** @var CBitrixComponentTemplate $this */
    /** @var string $templateName */
    /** @var string $templateFile */
    /** @var string $templateFolder */
    /** @var string $componentPath */
    /** @var CBitrixComponent $component */
    /** @var array $skuTemplate */
    /** @var array $templateData */
    $this->setFrameMode(true);

    if (! empty($arResult['ITEMS'])) {
    $arResult['SKU_PROPS'] = reset($arResult['SKU_PROPS']);
    $skuTemplate           = [];
    if (! empty($arResult['SKU_PROPS'])) {
        foreach ($arResult['SKU_PROPS'] as $arProp) {
            $propId               = $arProp['ID'];
            $skuTemplate[$propId] = [
                'SCROLL' => [
                    'START'  => '',
                    'FINISH' => '',
                ],
                'FULL'   => [
                    'START'  => '',
                    'FINISH' => '',
                ],
                'ITEMS'  => [],
            ];
            $templateRow = '';
            if ('TEXT' == $arProp['SHOW_MODE']) {
                $skuTemplate[$propId]['SCROLL']['START'] = '<div class="bx_item_detail_size full" id="#ITEM#_prop_' . $propId . '_cont">' .
                '<span class="bx_item_section_name_gray">' . htmlspecialcharsbx($arProp['NAME']) . '</span>' .
                    '<div class="bx_size_scroller_container"><div class="bx_size"><ul id="#ITEM#_prop_' . $propId . '_list" style="width: #WIDTH#;">';
                $skuTemplate[$propId]['SCROLL']['FINISH'] = '</ul></div>' .
                    '<div class="bx_slide_left" id="#ITEM#_prop_' . $propId . '_left" data-treevalue="' . $propId . '" style=""></div>' .
                    '<div class="bx_slide_right" id="#ITEM#_prop_' . $propId . '_right" data-treevalue="' . $propId . '" style=""></div>' .
                    '</div></div>';

                $skuTemplate[$propId]['FULL']['START'] = '<div class="bx_item_detail_size" id="#ITEM#_prop_' . $propId . '_cont">' .
                '<span class="bx_item_section_name_gray">' . htmlspecialcharsbx($arProp['NAME']) . '</span>' .
                    '<div class="bx_size_scroller_container"><div class="bx_size"><ul id="#ITEM#_prop_' . $propId . '_list" style="width: #WIDTH#;">';
                $skuTemplate[$propId]['FULL']['FINISH'] = '</ul></div>' .
                    '<div class="bx_slide_left" id="#ITEM#_prop_' . $propId . '_left" data-treevalue="' . $propId . '" style="display: none;"></div>' .
                    '<div class="bx_slide_right" id="#ITEM#_prop_' . $propId . '_right" data-treevalue="' . $propId . '" style="display: none;"></div>' .
                    '</div></div>';
                foreach ($arProp['VALUES'] as $value) {
                    $value['NAME']                               = htmlspecialcharsbx($value['NAME']);
                    $skuTemplate[$propId]['ITEMS'][$value['ID']] = '<li data-treevalue="' . $propId . '_' . $value['ID'] .
                        '" data-onevalue="' . $value['ID'] . '" style="width: #WIDTH#;" title="' . $value['NAME'] . '"><i></i><span class="cnt">' . $value['NAME'] . '</span></li>';
                }
                unset($value);
            } elseif ('PICT' == $arProp['SHOW_MODE']) {
                $skuTemplate[$propId]['SCROLL']['START'] = '<div class="bx_item_detail_scu full" id="#ITEM#_prop_' . $propId . '_cont">' .
                '<span class="bx_item_section_name_gray">' . htmlspecialcharsbx($arProp['NAME']) . '</span>' .
                    '<div class="bx_scu_scroller_container"><div class="bx_scu"><ul id="#ITEM#_prop_' . $propId . '_list" style="width: #WIDTH#;">';
                $skuTemplate[$propId]['SCROLL']['FINISH'] = '</ul></div>' .
                    '<div class="bx_slide_left" id="#ITEM#_prop_' . $propId . '_left" data-treevalue="' . $propId . '" style=""></div>' .
                    '<div class="bx_slide_right" id="#ITEM#_prop_' . $propId . '_right" data-treevalue="' . $propId . '" style=""></div>' .
                    '</div></div>';

                $skuTemplate[$propId]['FULL']['START'] = '<div class="bx_item_detail_scu" id="#ITEM#_prop_' . $propId . '_cont">' .
                '<span class="bx_item_section_name_gray">' . htmlspecialcharsbx($arProp['NAME']) . '</span>' .
                    '<div class="bx_scu_scroller_container"><div class="bx_scu"><ul id="#ITEM#_prop_' . $propId . '_list" style="width: #WIDTH#;">';
                $skuTemplate[$propId]['FULL']['FINISH'] = '</ul></div>' .
                    '<div class="bx_slide_left" id="#ITEM#_prop_' . $propId . '_left" data-treevalue="' . $propId . '" style="display: none;"></div>' .
                    '<div class="bx_slide_right" id="#ITEM#_prop_' . $propId . '_right" data-treevalue="' . $propId . '" style="display: none;"></div>' .
                    '</div></div>';
                foreach ($arProp['VALUES'] as $value) {
                    $value['NAME']                               = htmlspecialcharsbx($value['NAME']);
                    $skuTemplate[$propId]['ITEMS'][$value['ID']] = '<li data-treevalue="' . $propId . '_' . $value['ID'] .
                        '" data-onevalue="' . $value['ID'] . '" style="width: #WIDTH#; padding-top: #WIDTH#;"><i title="' . $value['NAME'] . '"></i>' .
                        '<span class="cnt"><span class="cnt_item" style="background-image:url(\'' . $value['PICT']['SRC'] . '\');" title="' . $value['NAME'] . '"></span></span></li>';
                }
                unset($value);
            }
        }
        unset($templateRow, $arProp);
    }
    }

    $intRowsCount = count($arResult['ITEMS']);
    $strRand      = $this->randString();
    $strContID    = 'cat_top_cont_' . $strRand;
	
?>

<section class="section catalog section-round-top" id="<? echo $strContID; ?>" >
	<div class="container">
		<div class="heading">
			<h2>Популярные товары</h2>
			<div class="hand_icon"> <svg width="18" height="26" viewBox="0 0 18 26" fill="none"
					xmlns="http://www.w3.org/2000/svg">
					<path
						d="M15.7173 13.028C15.3283 10.6535 13.672 10.3306 12.9585 10.3041C12.7566 10.2966 12.5726 10.1869 12.4643 10.0107C11.9242 9.13234 11.1919 8.90121 10.5711 8.90121C10.2869 8.90121 10.0263 8.94962 9.81802 9.00644C9.75674 9.02316 9.69445 9.03127 9.63286 9.03127C9.4137 9.03127 9.20248 8.92801 9.07055 8.73927C8.53924 7.97942 7.84581 7.77395 7.25141 7.77395C7.09241 7.77395 6.94047 7.7887 6.80069 7.81135C6.76336 7.81748 6.72633 7.82038 6.6899 7.82038C6.30953 7.82038 5.98863 7.50149 5.98812 7.0946L5.98309 2.70201C5.98168 1.56706 5.15704 1 4.33229 1C3.50604 1 2.67978 1.56893 2.68119 2.70627C2.68351 4.61322 2.69005 10.3404 2.69216 12.0663C2.69246 12.3579 2.52351 12.6214 2.26288 12.7339C-1.01155 14.147 3.03188 20.485 3.7562 21.5713C3.82684 21.6773 3.8687 21.8001 3.87806 21.9284L4.05506 24.3378C4.08264 24.7169 4.38885 24.9878 4.75714 24.9878L12.6697 25C13.0228 24.9996 13.3209 24.7403 13.3669 24.3789L13.6891 21.851C13.7028 21.7439 13.7404 21.6438 13.7972 21.5531C15.9118 18.1792 16.0779 15.229 15.7173 13.028Z"
						stroke="#42454F" stroke-width="2"></path>
					<path
						d="M9.60367 4.57621H15.4998L14.2228 5.8945C13.987 6.13788 13.987 6.53251 14.2229 6.77589C14.3407 6.89753 14.4953 6.9584 14.6497 6.9584C14.8042 6.9584 14.9588 6.89753 15.0767 6.77578L17.3294 4.45031C17.5651 4.20693 17.5651 3.81231 17.3293 3.56893L15.0172 1.18248C14.7816 0.939207 14.3992 0.939103 14.1634 1.18259C13.9276 1.42597 13.9276 1.82059 14.1635 2.06397L15.3898 3.3297H9.60377C9.27029 3.3297 9 3.60882 9 3.95296C9 4.2971 9.27029 4.57621 9.60367 4.57621Z"
						fill="#42454F"></path>
				</svg> </div>
		</div>
		<div class="catalog__list catalog-top grid swiper">





		<?
		$boolFirst = true;
		$arRowIDs = array();
		foreach ($arResult['ITEMS'] as $keyRow => $arOneRow)
		{
			$strRowID = 'cat-top-'.$keyRow.'_'.$strRand;
			$arRowIDs[] = $strRowID;
			?>
			<!-- <div id="<? echo $strRowID; ?>" class="bx_catalog_tile_slide <? echo ($boolFirst ? 'active' : 'notactive'); ?>"> -->
				<?
				foreach ($arOneRow as $keyItem => $arItem)
				{
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
					$strMainID = $this->GetEditAreaId($arItem['ID']);
					$arItem['CAN_BUY'] = true;
					$arItemIDs = array(
						'ID' => $strMainID,
						'PICT' => $strMainID.'_pict',
						'SECOND_PICT' => $strMainID.'_secondpict',
						'MAIN_PROPS' => $strMainID.'_main_props',

						'QUANTITY' => $strMainID.'_quantity',
						'QUANTITY_DOWN' => $strMainID.'_quant_down',
						'QUANTITY_UP' => $strMainID.'_quant_up',
						'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
						'BUY_LINK' => $strMainID.'_buy_link',
						'BASKET_ACTIONS' => $strMainID.'_basket_actions',
						'NOT_AVAILABLE_MESS' => $strMainID.'_not_avail',
						'SUBSCRIBE_LINK' => $strMainID.'_subscribe',
						'COMPARE_LINK' => $strMainID.'_compare_link',

						'PRICE' => $strMainID.'_price',
						'DSC_PERC' => $strMainID.'_dsc_perc',
						'SECOND_DSC_PERC' => $strMainID.'_second_dsc_perc',

						'PROP_DIV' => $strMainID.'_sku_tree',
						'PROP' => $strMainID.'_prop_',
						'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
						'BASKET_PROP_DIV' => $strMainID.'_basket_prop'
					);

					$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);

					if ($arResult['MODULES']['catalog'] && $arItem['PRODUCT']['TYPE'] === ProductTable::TYPE_SERVICE)
					{
						$messageNotAvailable = ($arParams['MESS_NOT_AVAILABLE_SERVICE'] ?: GetMessage('CT_BCT_TPL_MESS_PRODUCT_NOT_AVAILABLE_SERVICE'));
					}
					else
					{
						$messageNotAvailable = ($arParams['MESS_NOT_AVAILABLE'] ?: GetMessage('CT_BCT_TPL_MESS_PRODUCT_NOT_AVAILABLE'));
					}

					$productTitle = (
						isset($arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])&& $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] != ''
						? $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
						: $arItem['NAME']
					);
					$imgTitle = (
						isset($arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']) && $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE'] != ''
						? $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']
						: $arItem['NAME']
					);

					$minPrice = false;
					if (isset($arItem['MIN_PRICE']) || isset($arItem['RATIO_PRICE']))
						$minPrice = (isset($arItem['RATIO_PRICE']) ? $arItem['RATIO_PRICE'] : $arItem['MIN_PRICE']);
					?>
					<div class="swiper-slide" id="<? echo $strMainID; ?>">
						<article class="catalog__item card" data-basket-id="<?=$arItem['ID']?>"
    							data-product-id="<?=$arItem['PRODUCT_ID']?>"> 
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
							<a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>" class="catalog__item_image"> 
								<img
									src="<? echo $arItem['PREVIEW_PICTURE']['SRC']; ?>" alt="<? echo $imgTitle; ?>"  width="166" height="252"> 
							</a>
							<div class="catalog__item_content">
								<div class="catalog__item_tags"> 
									<? if ($arItem['DISPLAY_PROPERTIES']['NOVINKA']['VALUE']) : ?><span class="tag filter-tag">Новинка</span><? endif; ?>
									<!-- <span class="tag filter-tag">Акция</span>  -->
								</div> <a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>"
									class="catalog__item_title">
									<h4><? echo $productTitle; ?></h4>
								</a>
								<div class="catalog__item_char">
									<div class="article">Арт. <?=$arItem['DISPLAY_PROPERTIES']['CML2_ARTICLE']['VALUE'] ?></div>
									<div class="char__list">
										<div class="char__item"> <span class="char__item_name"><?=$arItem['DISPLAY_PROPERTIES']['EDINITSA_IZMERENIYA_OBEMA_VESA_NETTO']['VALUE'] == 'кг' ? 'Вес' : 'Объем' ?></span>
											<div class="char__item_value"><?=$arItem['DISPLAY_PROPERTIES']['OBEM_VES_NETTO']['VALUE']?> <?=$arItem['DISPLAY_PROPERTIES']['EDINITSA_IZMERENIYA_OBEMA_VESA_NETTO']['VALUE']?>.</div>
										</div>
										<!-- <div class="char__item"> <span class="char__item_name">Вес брутто</span>
											<div class="char__item_value">219,5 кг.</div>
										</div> -->
										<div id="<? echo $arItemIDs['PRICE']; ?>" class="char__item">
											<span class="char__item_name">Стоимость</span>
											<div class="char__item_value">
												<?
												$hasPrice = !empty($minPrice) || !empty($arItem['ITEM_PRICES'][0]['PRINT_PRICE']);
												if ($hasPrice):
													if ($USER->IsAuthorized()):
														if (!empty($minPrice)):
															if ('N' == $arParams['PRODUCT_DISPLAY_MODE'] && isset($arItem['OFFERS']) && !empty($arItem['OFFERS'])):
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
														echo $arItem['ITEM_PRICES'][0]['PRINT_PRICE'];
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
								<div class="catalog__item_bottom" id="catalog-item-bottom-<?=$arItem['ID']?>">
									<? if ($arItem['BASKET_QUANTITY']) : ?>
										<div class="counter"> 
											<button class="btn btn-quad grey dec"> 
												<svg width="12"
													height="3" viewBox="0 0 12 3" fill="none"
													xmlns="http://www.w3.org/2000/svg">
													<path d="M0 3V0H12V3H0Z" fill="black"></path>
												</svg> 
											</button> 
											<input type="text" name="<? echo $arParams["PRODUCT_QUANTITY_VARIABLE"]; ?>"
												class="btn btn-quad counter_value" value="<? echo $arItem['BASKET_QUANTITY']; ?>" data-value="<? echo $arItem['BASKET_QUANTITY']; ?>"> 
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
									<? if ($arItem['BASKET_QUANTITY']) : ?>
										<button id="<? echo $arItemIDs['BUY_LINK']; ?>" class="btn btn-grey js-remove-to-cart" data-id="<?=$arItem['ID']?>" rel="nofollow">
										Убрать из корзины
									</button>
									<? else : ?>
									<button id="<? echo $arItemIDs['BUY_LINK']; ?>" class="btn btn-primary js-add-to-cart" data-id="<?=$arItem['ID']?>" rel="nofollow">
										Добавить в корзину
									</button>
									<? endif; ?>
								</div>
							</div>
							<div id="<? echo $arItemIDs['BASKET_ACTIONS']; ?>">
   
						</div>

							<div
								id="<? echo $arItemIDs['NOT_AVAILABLE_MESS']; ?>"
								style="display:none;"
							></div>

							<div
								id="<? echo $arItemIDs['PICT']; ?>"
								style="display:none;"
							></div>
						</article>
					</div>
					<?php
						$arJSParams = array(
							'PRODUCT_TYPE' => $arItem['PRODUCT']['TYPE'],
							'SHOW_QUANTITY' => true,
							'SHOW_ADD_BASKET_BTN' => false,
							'SHOW_BUY_BTN' => true,
							'SHOW_ABSENT' => true,

							'VISUAL' => array(
								'ID' => $arItemIDs['ID'],
								'PICT_ID' => $arItemIDs['PICT'],
								'QUANTITY_ID' => $arItemIDs['QUANTITY'],
								'QUANTITY_UP_ID' => $arItemIDs['QUANTITY_UP'],
								'QUANTITY_DOWN_ID' => $arItemIDs['QUANTITY_DOWN'],
								'BUY_ID' => $arItemIDs['BUY_LINK'],
								'BASKET_ACTIONS_ID' => $arItemIDs['BASKET_ACTIONS'],
								'NOT_AVAILABLE_MESS' => $arItemIDs['NOT_AVAILABLE_MESS'],
							),

							'PRODUCT' => array(
								'ID' => $arItem['ID'],
								'NAME' => $productTitle,
								'PICT' => $arItem['PREVIEW_PICTURE'],
								'CAN_BUY' => $arItem['CAN_BUY'],
								'CHECK_QUANTITY' => $arItem['CHECK_QUANTITY'],
								'MAX_QUANTITY' => $arItem['CATALOG_QUANTITY'],
								'STEP_QUANTITY' => $arItem['CATALOG_MEASURE_RATIO'],
								'QUANTITY_FLOAT' => is_double($arItem['CATALOG_MEASURE_RATIO']),
							),

							'BASKET' => array(
								'ADD_PROPS' => false,
								'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
								'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
								'EMPTY_PROPS' => true,
								'BASKET_URL' => $arParams['~BASKET_URL'],
								'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
								'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
							)
						);
					?>

					<!-- <script>
						//var <?// echo $strObName; ?> = new JCCatalogTopSlider(
						//	<?// echo CUtil::PhpToJSObject($arJSParams, false, true); ?>
						//);
					</script> -->
					<?
				}
				?>
			
			<!-- </div> -->
			
			<?
			$boolFirst = false;
		}
		?>
		</div>
		<div class="catalog__bottom"> 
			<a href="/catalog/" class="btn btn-light btn-full">Перейти в каталог</a> 
		</div>
	</div>
	<?
	if (1 < $intRowsCount)
	{
		$arJSParams = array(
			'cont' => $strContID,
			'left' => array(
				'id' => $strContID.'_left_arr',
				'className' => 'bx_catalog_tile_slider_arrow_left'
			),
			'right' => array(
				'id' => $strContID.'_right_arr',
				'className' => 'bx_catalog_tile_slider_arrow_right'
			),
			'rows' => $arRowIDs,
			'rotate' => (0 < $arParams['ROTATE_TIMER']),
			'rotateTimer' => $arParams['ROTATE_TIMER']
		);
		if ('Y' == $arParams['SHOW_PAGINATION'])
		{
			$arJSParams['pagination'] = array(
				'id' => $strContID.'_pagination',
				'className' => 'bx_catalog_tile_slider_pagination'
			);
		}
		?>
		<!-- <script>
			//var ob<?// echo $strContID; ?> = new JCCatalogTopSliderList(<?// echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
		</script> -->
		<?
	}
	?>
	
</section>
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
