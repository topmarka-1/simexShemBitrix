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
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<? if ($arItem['PROPERTIES']['SERTS']['VALUE']) : ?>
	<section class="section sertificates anim-fade-in-up" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div class="container">
			<div class="heading anim-fade-in-left">
				<h2><?=$arItem['PROPERTIES']['SETRS_TITLE']['VALUE'] ?></h2>
			</div>
			<div class="sertificates__list">
				<div class="sertificates__slider swiper">
					<div class="swiper-wrapper">
						<? foreach ($arItem['PROPERTIES']['SERTS']['VALUE'] as $sert) : ?>
						<div class=" swiper-slide">
							<a href="<?=\CFile::GetPath($sert); ?>" data-fancybox class="sertificates__slide hover-img"><img
									src="<?=\CFile::GetPath($sert); ?>" alt="sertificate" width="446" height="630"></a>

						</div>
						<? endforeach; ?>
					</div>
				</div>
				<div class="sertificates__slider_control">
					<div class="sertificates__slider_pagination"></div>
					<div class="sertificates__slider_navigation">
						<button class="swiper_prev sertificates__slider_control-btn btn-round-lg light">
							<svg width="10" height="15" viewBox="0 0 10 15" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M8.12134 1.06055L2.12134 7.06055L8.12134 13.0605" stroke="#575A63"
									stroke-width="3" />
							</svg>
						</button>
						<button class="swiper_next sertificates__slider_control-btn btn-round-lg light">
							<svg width="10" height="15" viewBox="0 0 10 15" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M1.06067 1.06055L7.06067 7.06055L1.06067 13.0605" stroke="#575A63"
									stroke-width="3" />
							</svg>
						</button>
					</div>
				</div>
			</div>
		</div>
	</section>
	<? endif; ?>
<?endforeach;?>
