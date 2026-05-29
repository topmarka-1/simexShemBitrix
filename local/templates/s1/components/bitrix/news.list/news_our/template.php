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
<section class="section news more anim-fade-in-up">
    <div class="container">
        <div class="heading anim-fade-in-left">
            <h2>Смотрите другие новости
				из жизни нашей компании</h2>
        </div>
        <div class="news__content">
            <div class="news__list anim-stagger">
				<?foreach($arResult["ITEMS"] as $arItem):?>
					<?
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>
					<article class="news__item anim-fade-in-up" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
						<div class="news__item_date"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></div>
						<div class="news__item_image">
							<img 
							width="816" 
							height="348" 
							src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
							alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
							title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
							>
						</div>
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="news__item_title">
							<h5><?echo $arItem['PROPERTIES']['TITLE']['VALUE'] ? $arItem['PROPERTIES']['TITLE']['~VALUE']['TEXT'] : $arItem["NAME"];?></h5>
						</a>
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="btn btn-primary">Подробнее</a>
					</article>
				<?endforeach;?>
            </div>
            <div class="news__more_link">
                <a href="<?=$arResult['LIST_PAGE_URL'] ?>" class="btn btn-light btn-full">Смотреть все</a>
            </div>
        </div>
    </div>
</section>
