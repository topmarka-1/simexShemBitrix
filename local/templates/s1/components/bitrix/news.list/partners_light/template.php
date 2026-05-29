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
$this->setFrameMode(true);
?>
<section class="section <?=$APPLICATION->GetCurPage(false) == "/" ? "section-dark section-round-top section-round-bottom" : "" ?>  partners">
    <div class="container">
        <div class="heading">
            <h2><?= $arResult['~DESCRIPTION'] ?: "Мы ценим ваше доверие и сохраняем качество
                на протяжении 10 лет плотной работы"?></h2>
        </div>
        <div class="partners__content">
            <div class="partners__slider swiper">
                <div class="swiper-wrapper">
					<?foreach($arResult["ITEMS"] as $arItem):?>
						<?
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						?>
						<div class="swiper-slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
							<div class="partners__slide">
								<img src="<?= $APPLICATION->GetCurPage(false) == "/" ? $arItem["PREVIEW_PICTURE"]["SRC"] : \CFile::GetPath($arItem['PROPERTIES']['IMG_GRAY']['VALUE']);?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"] ?: $arItem["NAME"]?>"
											title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"] ?: $arItem["NAME"]?>">
							</div>
						</div>
					<?endforeach;?>
                </div>
            </div>
            <div class="partners__slider_control">
                <div class="partners__slider_pagination"></div>
                <div class="partners__slider_navigation">
                    <button class="swiper_prev partners__slider_control-btn btn-round-lg grey">
                        <svg width="10" height="15" viewBox="0 0 10 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.12134 1.06055L2.12134 7.06055L8.12134 13.0605" stroke="CurrentColor"
                                stroke-width="3" />
                        </svg>
                    </button>
                    <button class="swiper_next partners__slider_control-btn btn-round-lg grey">
                        <svg width="10" height="15" viewBox="0 0 10 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.06067 1.06055L7.06067 7.06055L1.06067 13.0605" stroke="CurrentColor"
                                stroke-width="3" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

