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
<section class="section history anim-fade-in-up">
    <div class="container">
        <div class="history__list anim-stagger">
			<?foreach($arResult["ITEMS"] as $arItem):?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
            <div class="history__item anim-fade-in-up">
                <div class="history__item_image">
                    <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
									width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
									height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
									alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
									title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>">
                </div>
                <div class="history__item_content">
                    <div class="date"><?=date('Y', strtotime($arItem['PROPERTIES']['DATE']['VALUE'])) ?></div>
                    <div class="history__item_text text-content">
                        <h2><?=$arItem['NAME'] ?></h2>
						<?=$arItem['PREVIEW_TEXT'] ?>
                       
                    </div>
                </div>
            </div>
			<?endforeach;?>
            
        </div>
    </div>
</section>

