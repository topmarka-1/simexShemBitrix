<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

use Bitrix\Iblock\SectionPropertyTable;

$this->setFrameMode(true);

$templateData = array(
	'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/colors.css',
	'TEMPLATE_CLASS' => 'bx-'.$arParams['TEMPLATE_THEME']
);


?>
<!-- <div class="catalog__filter">
                    <div class="catalog__filter_heading">
                        <div class="h3">Фильтр по параметрам</div>
                        <div class="btn btn-quad accent catalog__filter_close">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.6767 14L0 2.33046L2.32326 0.00863042L14 11.6782L11.6767 14ZM2.32326 13.9914L5.79853e-07 11.6695L11.6767 0L14 2.32182L2.32326 13.9914Z"
                                    fill="CurrentColor" />
                            </svg>
                        </div>
                    </div>
                    <form action="#" method="get" class="catalog__filter_form">
                        <div class="catalog__filter_fields swiper">
                            <div class="swiper-slide catalog__filter_field accordion active">
                                <div class="accordion_title">
                                    <span class="title">Назначение</span>
                                    <span class="arrow">
                                        <svg width="14" height="9" viewBox="0 0 14 9" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.707031 0.707031L6.70703 6.70703L12.707 0.707032"
                                                stroke="#D7D8D9" stroke-width="2" />
                                        </svg>

                                    </span>
                                </div>
                                <div class="accordion_content">
                                    <div class="accordion_body catalog__filter_fied_body">
                                        <label class="label-checkbox">
                                            <input type="checkbox" name="purpose" value="">
                                            <span class="checkbox"></span>
                                            Авиационные масла
                                        </label>
                                        <label class="label-checkbox">
                                            <input type="checkbox" name="purpose" value="">
                                            <span class="checkbox"></span>
                                            Моторные масла
                                        </label>
                                        <label class="label-checkbox">
                                            <input type="checkbox" name="purpose" value="">
                                            <span class="checkbox"></span>
                                            Трансмисионные масла
                                        </label>
                                        <label class="label-checkbox">
                                            <input type="checkbox" name="purpose" value="">
                                            <span class="checkbox"></span>
                                            Трансмисионные масла
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide catalog__filter_field accordion">
                                <div class="accordion_title">
                                    <span class="title">Вязкость</span>
                                    <span class="arrow">
                                        <svg width="14" height="9" viewBox="0 0 14 9" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.707031 0.707031L6.70703 6.70703L12.707 0.707032"
                                                stroke="#D7D8D9" stroke-width="2" />
                                        </svg>

                                    </span>
                                </div>
                                <div class="accordion_content">
                                    <div class="accordion_body catalog__filter_fied_body">
                                        <label class="label-checkbox">
                                            <input type="checkbox" name="viscosity" value="">
                                            <span class="checkbox"></span>
                                            10W-30
                                        </label>
                                        <label class="label-checkbox">
                                            <input type="checkbox" name="viscosity" value="">
                                            <span class="checkbox"></span>
                                            10W-40
                                        </label>
                                        <label class="label-checkbox">
                                            <input type="checkbox" name="viscosity" value="">
                                            <span class="checkbox"></span>
                                            15W-40
                                        </label>
                                        <label class="label-checkbox">
                                            <input type="checkbox" name="viscosity" value="">
                                            <span class="checkbox"></span>
                                            20W-40
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide catalog__filter_field accordion">
                                <div class="accordion_title">
                                    <span class="title">Тип</span>
                                    <span class="arrow">
                                        <svg width="14" height="9" viewBox="0 0 14 9" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.707031 0.707031L6.70703 6.70703L12.707 0.707032"
                                                stroke="#D7D8D9" stroke-width="2" />
                                        </svg>

                                    </span>
                                </div>
                                <div class="accordion_content">
                                    <div class="accordion_body catalog__filter_fied_body">
                                        <label class="label-checkbox">
                                            <input type="checkbox" name="type" value="">
                                            <span class="checkbox"></span>
                                            Полусинтетическое
                                        </label>
                                        <label class="label-checkbox">
                                            <input type="checkbox" name="type" value="">
                                            <span class="checkbox"></span>
                                            Минеральные
                                        </label>
                                        <label class="label-checkbox">
                                            <input type="checkbox" name="type" value="">
                                            <span class="checkbox"></span>
                                            Синтетические технологии
                                        </label>
                                        <label class="label-checkbox">
                                            <input type="checkbox" name="type" value="">
                                            <span class="checkbox"></span>
                                            Синтетическое
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide catalog__filter_field accordion">
                                <div class="accordion_title">
                                    <span class="title">Допуски и спецификации</span>
                                    <span class="arrow">
                                        <svg width="14" height="9" viewBox="0 0 14 9" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.707031 0.707031L6.70703 6.70703L12.707 0.707032"
                                                stroke="#D7D8D9" stroke-width="2" />
                                        </svg>

                                    </span>
                                </div>
                                <div class="accordion_content">
                                    <div class="accordion_body catalog__filter_fied_body">
                                        <label class="label-checkbox">
                                            <input type="checkbox" name="specific" value="">
                                            <span class="checkbox"></span>
                                            Авиационные масла
                                        </label>
                                        <label class="label-checkbox">
                                            <input type="checkbox" name="specific" value="">
                                            <span class="checkbox"></span>
                                            Моторные масла
                                        </label>
                                        <label class="label-checkbox">
                                            <input type="checkbox" name="specific" value="">
                                            <span class="checkbox"></span>
                                            Трансмисионные масла
                                        </label>
                                        <label class="label-checkbox">
                                            <input type="checkbox" name="specific" value="">
                                            <span class="checkbox"></span>
                                            Трансмисионные масла
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide catalog__filter_field accordion">
                                <div class="accordion_title">
                                    <span class="title">Объем</span>
                                    <span class="arrow">
                                        <svg width="14" height="9" viewBox="0 0 14 9" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.707031 0.707031L6.70703 6.70703L12.707 0.707032"
                                                stroke="#D7D8D9" stroke-width="2" />
                                        </svg>

                                    </span>
                                </div>
                                <div class="accordion_content">
                                    <div class="accordion_body catalog__filter_fied_body">
                                        <label class="label-checkbox">
                                            <input type="checkbox" name="volume" value="">
                                            <span class="checkbox"></span>
                                            Авиационные масла
                                        </label>
                                        <label class="label-checkbox">
                                            <input type="checkbox" name="volume" value="">
                                            <span class="checkbox"></span>
                                            Моторные масла
                                        </label>
                                        <label class="label-checkbox">
                                            <input type="checkbox" name="volume" value="">
                                            <span class="checkbox"></span>
                                            Трансмисионные масла
                                        </label>
                                        <label class="label-checkbox">
                                            <input type="checkbox" name="volume" value="">
                                            <span class="checkbox"></span>
                                            Трансмисионные масла
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="catalog__filter_buttons">
                                <input type="submit" value="Применить" class="btn btn-primary btn-full">
                                <input type="reset" value="Очистить фильтры" disabled class="btn btn-light btn-full">
                            </div>
                        </div>
                    </form>
                </div> -->
<div class="catalog__filter">
	<div class="catalog__filter_heading">
		<div class="h3">Фильтр по параметрам</div>
		<div class="btn btn-quad accent catalog__filter_close">
			<svg width="14" height="14" viewBox="0 0 14 14" fill="none"
				xmlns="http://www.w3.org/2000/svg">
				<path
					d="M11.6767 14L0 2.33046L2.32326 0.00863042L14 11.6782L11.6767 14ZM2.32326 13.9914L5.79853e-07 11.6695L11.6767 0L14 2.32182L2.32326 13.9914Z"
					fill="CurrentColor" />
			</svg>
		</div>
	</div>
	<form class="catalog__filter_form bx-filter" name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get">
		<?foreach($arResult["HIDDEN"] as $arItem):?>
		<input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
		<?endforeach;?>
		<div class="catalog__filter_fields swiper">
			<?

			//not prices
			foreach($arResult["ITEMS"] as $key=>$arItem)
			{
				if(
					empty($arItem["VALUES"])
					|| isset($arItem["PRICE"])
				)
					continue;

				if (
					$arItem["DISPLAY_TYPE"] === SectionPropertyTable::NUMBERS_WITH_SLIDER
					&& ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
				)
					continue;
				?>
				<div class="swiper-slide catalog__filter_field accordion">
                                <div class="accordion_title">
                                    <span class="title"><?=$arItem["NAME"]?></span>
                                    <span class="arrow">
                                        <svg width="14" height="9" viewBox="0 0 14 9" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.707031 0.707031L6.70703 6.70703L12.707 0.707032"
                                                stroke="#D7D8D9" stroke-width="2" />
                                        </svg>

                                    </span>
                                </div>
                                <div class="accordion_content">
									<div class="accordion_body catalog__filter_fied_body <?=$arItem["DISPLAY_TYPE"] == SectionPropertyTable::NUMBERS_WITH_SLIDER ? ' filter-range' :''?>">
									<?
										$arCur = current($arItem["VALUES"]);
										
										switch ($arItem["DISPLAY_TYPE"])
										{
											case SectionPropertyTable::NUMBERS_WITH_SLIDER:
												$precision = $arItem["DECIMALS"] ?: 0;
												$step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / 4;
												$value1 = number_format($arItem["VALUES"]["MIN"]["VALUE"], $precision, ".", "");
												$value2 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step, $precision, ".", "");
												$value3 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 2, $precision, ".", "");
												$value4 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 3, $precision, ".", "");
												$value5 = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");
												?>
												<div>
												<div class="filter-range__values">
													<input type="number" class="filter-range__values_input filter-range__values_input--min"
														value="<?=htmlspecialcharsbx($arItem["VALUES"]["MIN"]["HTML_VALUE"] ?: $arItem["VALUES"]["MIN"]["VALUE"])?>"
														onchange="smartFilter.keyup(this)">
													<span class="filter-range__values_sep">—</span>
													<input type="number" class="filter-range__values_input filter-range__values_input--max"
														value="<?=htmlspecialcharsbx($arItem["VALUES"]["MAX"]["HTML_VALUE"] ?: $arItem["VALUES"]["MAX"]["VALUE"])?>"
														onchange="smartFilter.keyup(this)">
												</div>

												<div class="col-xs-12 bx-ui-slider-track-container">
													<div class="bx-ui-slider-track" id="drag_track_<?=$key?>">
														<div class="bx-ui-slider-part p1"><span><?=$value1?></span></div>
														<div class="bx-ui-slider-part p2"><span><?=$value2?></span></div>
														<div class="bx-ui-slider-part p3"><span><?=$value3?></span></div>
														<div class="bx-ui-slider-part p4"><span><?=$value4?></span></div>
														<div class="bx-ui-slider-part p5"><span><?=$value5?></span></div>

														<div class="bx-ui-slider-pricebar-vd" id="colorUnavailableActive_<?=$key?>"></div>
														<div class="bx-ui-slider-pricebar-vn" id="colorAvailableInactive_<?=$key?>"></div>
														<div class="bx-ui-slider-pricebar-v"  id="colorAvailableActive_<?=$key?>"></div>
														<div class="bx-ui-slider-range" id="drag_tracker_<?=$key?>">
															<a class="bx-ui-slider-handle left" href="javascript:void(0)" id="left_slider_<?=$key?>"></a>
															<a class="bx-ui-slider-handle right" href="javascript:void(0)" id="right_slider_<?=$key?>"></a>
														</div>
													</div>
												</div>

												<input type="hidden" name="<?=$arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
													id="<?=$arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
													value="<?=htmlspecialcharsbx($arItem["VALUES"]["MIN"]["HTML_VALUE"] ?: $arItem["VALUES"]["MIN"]["VALUE"])?>" />
												<input type="hidden" name="<?=$arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
													id="<?=$arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
													value="<?=htmlspecialcharsbx($arItem["VALUES"]["MAX"]["HTML_VALUE"] ?: $arItem["VALUES"]["MAX"]["VALUE"])?>" />

												<script>
												BX.ready(function(){
													window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject(array(
														"leftSlider" => 'left_slider_'.$key,
														"rightSlider" => 'right_slider_'.$key,
														"tracker" => "drag_tracker_".$key,
														"trackerWrap" => "drag_track_".$key,
														"minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
														"maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
														"minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
														"maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
														"curMinPrice" => ($arItem["VALUES"]["MIN"]["HTML_VALUE"] ?: $arItem["VALUES"]["MIN"]["VALUE"]),
														"curMaxPrice" => ($arItem["VALUES"]["MAX"]["HTML_VALUE"] ?: $arItem["VALUES"]["MAX"]["VALUE"]),
														"fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ?: $arItem["VALUES"]["MIN"]["VALUE"],
														"fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ?: $arItem["VALUES"]["MAX"]["VALUE"],
														"precision" => $precision,
														"colorUnavailableActive" => 'colorUnavailableActive_'.$key,
														"colorAvailableActive" => 'colorAvailableActive_'.$key,
														"colorAvailableInactive" => 'colorAvailableInactive_'.$key,
													))?>);
												});
												</script></div>
												<?
												break;
											case SectionPropertyTable::NUMBERS://NUMBERS
												?>
												<div class="col-xs-6 bx-filter-parameters-box-container-block bx-left">
													<i class="bx-ft-sub"><?=GetMessage("CT_BCSF_FILTER_FROM")?></i>
													<div class="bx-filter-input-container">
														<input
															class="min-price"
															type="text"
															name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
															id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
															value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
															size="5"
															onkeyup="smartFilter.keyup(this)"
															/>
													</div>
												</div>
												<div class="col-xs-6 bx-filter-parameters-box-container-block bx-right">
													<i class="bx-ft-sub"><?=GetMessage("CT_BCSF_FILTER_TO")?></i>
													<div class="bx-filter-input-container">
														<input
															class="max-price"
															type="text"
															name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
															id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
															value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
															size="5"
															onkeyup="smartFilter.keyup(this)"
															/>
													</div>
												</div>
												<?
												break;
											case SectionPropertyTable::CHECKBOXES_WITH_PICTURES://CHECKBOXES_WITH_PICTURES
												?>
												<div class="col-xs-12">
													<div class="bx-filter-param-btn-inline">
													<?foreach ($arItem["VALUES"] as $val => $ar):?>
														<input
															style="display: none"
															type="checkbox"
															name="<?=$ar["CONTROL_NAME"]?>"
															id="<?=$ar["CONTROL_ID"]?>"
															value="<?=$ar["HTML_VALUE"]?>"
															<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
														/>
														<?
														$class = "";
														if ($ar["CHECKED"])
															$class.= " bx-active";
														if ($ar["DISABLED"])
															$class.= " disabled";
														?>
														<label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label <?=$class?>" onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')); BX.toggleClass(this, 'bx-active');">
															<span class="bx-filter-param-btn bx-color-sl">
																<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
																<span class="bx-filter-btn-color-icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
																<?endif?>
															</span>
														</label>
													<?endforeach?>
													</div>
												</div>
												<?
												break;
											case SectionPropertyTable::CHECKBOXES_WITH_PICTURES_AND_LABELS://CHECKBOXES_WITH_PICTURES_AND_LABELS
												?>
												<div class="col-xs-12">
													<div class="bx-filter-param-btn-block">
													<?foreach ($arItem["VALUES"] as $val => $ar):?>
														<input
															style="display: none"
															type="checkbox"
															name="<?=$ar["CONTROL_NAME"]?>"
															id="<?=$ar["CONTROL_ID"]?>"
															value="<?=$ar["HTML_VALUE"]?>"
															<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
														/>
														<?
														$class = "";
														if ($ar["CHECKED"])
															$class.= " bx-active";
														if ($ar["DISABLED"])
															$class.= " disabled";
														?>
														<label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label<?=$class?>" onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')); BX.toggleClass(this, 'bx-active');">
															<span class="bx-filter-param-btn bx-color-sl">
																<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
																	<span class="bx-filter-btn-color-icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
																<?endif?>
															</span>
															<span class="bx-filter-param-text" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?><?
															if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
																?> (<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
															endif;?></span>
														</label>
													<?endforeach?>
													</div>
												</div>
												<?
												break;
											case SectionPropertyTable::DROPDOWN://DROPDOWN
												$checkedItemExist = false;
												?>
												<div class="col-xs-12">
													<div class="bx-filter-select-container">
														<div class="bx-filter-select-block" onclick="smartFilter.showDropDownPopup(this, '<?=CUtil::JSEscape($key)?>')">
															<div class="bx-filter-select-text" data-role="currentOption">
																<?
																foreach ($arItem["VALUES"] as $val => $ar)
																{
																	if ($ar["CHECKED"])
																	{
																		echo $ar["VALUE"];
																		$checkedItemExist = true;
																	}
																}
																if (!$checkedItemExist)
																{
																	echo GetMessage("CT_BCSF_FILTER_ALL");
																}
																?>
															</div>
															<div class="bx-filter-select-arrow"></div>
															<input
																style="display: none"
																type="radio"
																name="<?=$arCur["CONTROL_NAME_ALT"]?>"
																id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
																value=""
															/>
															<?foreach ($arItem["VALUES"] as $val => $ar):?>
																<input
																	style="display: none"
																	type="radio"
																	name="<?=$ar["CONTROL_NAME_ALT"]?>"
																	id="<?=$ar["CONTROL_ID"]?>"
																	value="<? echo $ar["HTML_VALUE_ALT"] ?>"
																	<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
																/>
															<?endforeach?>
															<div class="bx-filter-select-popup" data-role="dropdownContent" style="display: none;">
																<ul>
																	<li>
																		<label for="<?="all_".$arCur["CONTROL_ID"]?>" class="bx-filter-param-label" data-role="label_<?="all_".$arCur["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape("all_".$arCur["CONTROL_ID"])?>')">
																			<? echo GetMessage("CT_BCSF_FILTER_ALL"); ?>
																		</label>
																	</li>
																<?
																foreach ($arItem["VALUES"] as $val => $ar):
																	$class = "";
																	if ($ar["CHECKED"])
																		$class.= " selected";
																	if ($ar["DISABLED"])
																		$class.= " disabled";
																?>
																	<li>
																		<label for="<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label<?=$class?>" data-role="label_<?=$ar["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')"><?=$ar["VALUE"]?></label>
																	</li>
																<?endforeach?>
																</ul>
															</div>
														</div>
													</div>
												</div>
												<?
												break;
											case SectionPropertyTable::DROPDOWN_WITH_PICTURES_AND_LABELS://DROPDOWN_WITH_PICTURES_AND_LABELS
												?>
												<div class="col-xs-12">
													<div class="bx-filter-select-container">
														<div class="bx-filter-select-block" onclick="smartFilter.showDropDownPopup(this, '<?=CUtil::JSEscape($key)?>')">
															<div class="bx-filter-select-text fix" data-role="currentOption">
																<?
																$checkedItemExist = false;
																foreach ($arItem["VALUES"] as $val => $ar):
																	if ($ar["CHECKED"])
																	{
																	?>
																		<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
																			<span class="bx-filter-btn-color-icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
																		<?endif?>
																		<span class="bx-filter-param-text">
																			<?=$ar["VALUE"]?>
																		</span>
																	<?
																		$checkedItemExist = true;
																	}
																endforeach;
																if (!$checkedItemExist)
																{
																	?><span class="bx-filter-btn-color-icon all"></span> <?
																	echo GetMessage("CT_BCSF_FILTER_ALL");
																}
																?>
															</div>
															<div class="bx-filter-select-arrow"></div>
															<input
																style="display: none"
																type="radio"
																name="<?=$arCur["CONTROL_NAME_ALT"]?>"
																id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
																value=""
															/>
															<?foreach ($arItem["VALUES"] as $val => $ar):?>
																<input
																	style="display: none"
																	type="radio"
																	name="<?=$ar["CONTROL_NAME_ALT"]?>"
																	id="<?=$ar["CONTROL_ID"]?>"
																	value="<?=$ar["HTML_VALUE_ALT"]?>"
																	<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
																/>
															<?endforeach?>
															<div class="bx-filter-select-popup" data-role="dropdownContent" style="display: none">
																<ul>
																	<li style="border-bottom: 1px solid #e5e5e5;padding-bottom: 5px;margin-bottom: 5px;">
																		<label for="<?="all_".$arCur["CONTROL_ID"]?>" class="bx-filter-param-label" data-role="label_<?="all_".$arCur["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape("all_".$arCur["CONTROL_ID"])?>')">
																			<span class="bx-filter-btn-color-icon all"></span>
																			<? echo GetMessage("CT_BCSF_FILTER_ALL"); ?>
																		</label>
																	</li>
																<?
																foreach ($arItem["VALUES"] as $val => $ar):
																	$class = "";
																	if ($ar["CHECKED"])
																		$class.= " selected";
																	if ($ar["DISABLED"])
																		$class.= " disabled";
																?>
																	<li>
																		<label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label<?=$class?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')">
																			<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
																				<span class="bx-filter-btn-color-icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
																			<?endif?>
																			<span class="bx-filter-param-text">
																				<?=$ar["VALUE"]?>
																			</span>
																		</label>
																	</li>
																<?endforeach?>
																</ul>
															</div>
														</div>
													</div>
												</div>
												<?
												break;
											case SectionPropertyTable::RADIO_BUTTONS://RADIO_BUTTONS
												?>
												<div class="col-xs-12">
													<div class="radio">
														<label class="bx-filter-param-label" for="<? echo "all_".$arCur["CONTROL_ID"] ?>">
															<span class="bx-filter-input-checkbox">
																<input
																	type="radio"
																	value=""
																	name="<? echo $arCur["CONTROL_NAME_ALT"] ?>"
																	id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
																	onclick="smartFilter.click(this)"
																/>
																<span class="bx-filter-param-text"><? echo GetMessage("CT_BCSF_FILTER_ALL"); ?></span>
															</span>
														</label>
													</div>
													<?foreach($arItem["VALUES"] as $val => $ar):?>
														<div class="radio">
															<label data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label" for="<? echo $ar["CONTROL_ID"] ?>">
																<span class="bx-filter-input-checkbox <? echo $ar["DISABLED"] ? 'disabled': '' ?>">
																	<input
																		type="radio"
																		value="<? echo $ar["HTML_VALUE_ALT"] ?>"
																		name="<? echo $ar["CONTROL_NAME_ALT"] ?>"
																		id="<? echo $ar["CONTROL_ID"] ?>"
																		<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
																		onclick="smartFilter.click(this)"
																	/>
																	<span class="bx-filter-param-text" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?><?
																	if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
																		?>&nbsp;(<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
																	endif;?></span>
																</span>
															</label>
														</div>
													<?endforeach;?>
												</div>
												<?
												break;
											case SectionPropertyTable::CALENDAR://CALENDAR
												?>
												<div class="col-xs-12">
													<div class="bx-filter-parameters-box-container-block"><div class="bx-filter-input-container bx-filter-calendar-container">
														<?$APPLICATION->IncludeComponent(
															'bitrix:main.calendar',
															'',
															array(
																'FORM_NAME' => $arResult["FILTER_NAME"]."_form",
																'SHOW_INPUT' => 'Y',
																'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="'.FormatDate("SHORT", $arItem["VALUES"]["MIN"]["VALUE"]).'" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
																'INPUT_NAME' => $arItem["VALUES"]["MIN"]["CONTROL_NAME"],
																'INPUT_VALUE' => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
																'SHOW_TIME' => 'N',
																'HIDE_TIMEBAR' => 'Y',
															),
															null,
															array('HIDE_ICONS' => 'Y')
														);?>
													</div></div>
													<div class="bx-filter-parameters-box-container-block"><div class="bx-filter-input-container bx-filter-calendar-container">
														<?$APPLICATION->IncludeComponent(
															'bitrix:main.calendar',
															'',
															array(
																'FORM_NAME' => $arResult["FILTER_NAME"]."_form",
																'SHOW_INPUT' => 'Y',
																'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="'.FormatDate("SHORT", $arItem["VALUES"]["MAX"]["VALUE"]).'" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
																'INPUT_NAME' => $arItem["VALUES"]["MAX"]["CONTROL_NAME"],
																'INPUT_VALUE' => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
																'SHOW_TIME' => 'N',
																'HIDE_TIMEBAR' => 'Y',
															),
															null,
															array('HIDE_ICONS' => 'Y')
														);?>
													</div></div>
												</div>
												<?
												break;
											default://CHECKBOXES
												?>
													<?foreach($arItem["VALUES"] as $val => $ar):?>
														<label class="label-checkbox" data-role="label_<?=$ar["CONTROL_ID"]?>"
															onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar["CONTROL_ID"])?>'))">
															<input type="checkbox"
																name="<?=$ar["CONTROL_NAME"]?>"
																id="<?=$ar["CONTROL_ID"]?>"
																value="<?=$ar["HTML_VALUE"]?>"
																<?=$ar["CHECKED"] ? 'checked="checked"' : ''?>
																<?=$ar["DISABLED"] ? 'disabled' : ''?>
																onchange="smartFilter.click(this)" />
															<span class="checkbox"></span>
															<?=$ar["VALUE"];?>
															<?if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):?>
																<span data-role="count_<?=$ar["CONTROL_ID"]?>"> (<?=$ar["ELEMENT_COUNT"]?>)</span>
															<?endif;?>
														</label>
													<?endforeach;?>
												<?
												}
												?>
													
														
														
										</div>
									</div>
								</div>
								
									<?
			}
			?>
		<!--//row-->
		<div class="catalog__filter_buttons">
			<input
				class="btn btn-primary btn-full"
				type="submit"
				id="set_filter"
				name="set_filter"
				value="<?=GetMessage("CT_BCSF_SET_FILTER")?>"
			/>
			<input
				class="btn btn-light btn-full"
				type="submit"
				id="del_filter"
				name="del_filter"
				value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>"
			/>
		</div></div>
		
	</form>
</div>
<script>
	var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>