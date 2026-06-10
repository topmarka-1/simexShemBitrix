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
<? if ($arResult['PROPERTIES']['SEO_TEXT']['~VALUE']) : ?>
<section class="section section-white history anim-fade-in-up">
    <div class="container">
        <div class="history__list">
            <div class="history__item">
                <div class="history__item_image">
                    <img src="<?=\CFile::GetPath($arResult['PROPERTIES']['SEO_IMAGE']['VALUE']); ?>" alt="<?=$arResult['PROPERTIES']['SEO_IMAGE']['DESCRIPTION'] ?>" width="1040" height="586">
                </div>
                <div class="history__item_content">
                    <div class="history__item_text text-content">
                        <?=$arResult['PROPERTIES']['SEO_TEXT']['~VALUE']['TEXT'] ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<? endif; ?>