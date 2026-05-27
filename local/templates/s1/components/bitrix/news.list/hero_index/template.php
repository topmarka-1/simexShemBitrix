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

<section class="section hero">
	<div class="hero__images">
		<div class="hero__images_slider swiper">
			<div class="swiper-wrapper">
				<?foreach($arResult["ITEMS"] as $arItem):?>
					<div class="swiper-slide hero__images_slide"> 
						<img src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" 
							width="1920"
							height="710" 
							alt="<?=$arItem["DETAIL_PICTURE"]["ALT"]?>"
							title="<?=$arItem["DETAIL_PICTURE"]["TITLE"]?>"
						>
					</div>
				<?endforeach;?>
			</div>
		</div>
	</div>
	<div class="hero__content">
		<div class="container">
			<div class="hero__content_slider swiper">
				<div class="swiper-wrapper">
					<?foreach($arResult["ITEMS"] as $key => $arItem):?>
						<?
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						?>
						<div class="swiper-slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
							<div class="hero__content_col">
								<div class="hero__content_title">
									<? if ($key == 0) : ?>
										<h1><?=$arItem['PROPERTIES']['TITLE']['~VALUE'] ?></h1>
									<? else : ?>
										<h2 class="h1"><?=$arItem['PROPERTIES']['TITLE']['~VALUE'] ?></h2>
									<? endif; ?>
								</div>
								<? if ($arItem['PROPERTIES']['SUBTITLE']['~VALUE']) : ?>
								<div class="hero__content_desc">
									<p><?=$arItem['PROPERTIES']['SUBTITLE']['~VALUE'] ?></p>
								</div>
								<? endif; ?>
								<div class="hero__content_more"> <a href="<?=$arItem['PROPERTIES']['LINK']['VALUE'] ?: '/catalog' ?>"
										class="btn btn-primary"><?=$arItem['PROPERTIES']['BUTTON_TEXT']['VALUE'] ?: 'Перейти в каталог' ?></a> </div>
							</div>
						</div>
					<?endforeach;?>
				</div>
			</div>
			<div class="hero__slider_navigation swiper-navigation"> <button
					class="swiper_prev hero__slider_control-btn"> <svg width="10" height="15"
						viewBox="0 0 10 15" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M8.12134 1.06055L2.12134 7.06055L8.12134 13.0605" stroke="CurrentColor"
							stroke-width="3"></path>
					</svg> </button> <button class="swiper_next hero__slider_control-btn"> <svg width="10"
						height="15" viewBox="0 0 10 15" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1.06067 1.06055L7.06067 7.06055L1.06067 13.0605" stroke="CurrentColor"
							stroke-width="3"></path>
					</svg> </button> </div>
		</div>
	</div>
</section>
