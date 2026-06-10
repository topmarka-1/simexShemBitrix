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
<div class="hero section anim-fade-in-up">
    <div class="container">
        <div class="hero__banner" style="background: url(<?=\CFile::GetPath($arResult['PROPERTIES']['HERO_IMAGE']['VALUE']); ?>);">
            <div class="hero__banner_content">
                <div class="hero__banner_heading anim-fade-in-left">
                    <h1 class="h2"><?=$arResult['PROPERTIES']['HERO_TITLE']['~VALUE'] ? $arResult['PROPERTIES']['HERO_TITLE']['~VALUE']['TEXT'] : '' ?></h1>
                    <div class="subtitle">
                        <p><?=$arResult['PROPERTIES']['HERO_SUBTITLE']['~VALUE'] ? $arResult['PROPERTIES']['HERO_SUBTITLE']['~VALUE']['TEXT'] : '' ?></p>
                    </div>
                </div>
                <div class="hero__banner_links">
                    <a href="<?=$arResult['PROPERTIES']['LINK']['VALUE'] ?: '#catalog' ?>" class="btn btn-primary"><?=$arResult['PROPERTIES']['BTN_TEXT']['VALUE'] ?: 'Перейти в каталог' ?></a>
                </div>
            </div>
            <div class="hero__banner_img">
                <img src="<?=$arResult['DETAIL_PICTURE']['SRC'] ?>" alt="<?=$arResult['DETAIL_PICTURE']['ALT'] ?>">
            </div>
        </div>
		<? if ($arResult['PROPERTIES']['ABOUT_NUMS']['VALUE']) : ?>
        <div class="hero__content_nums anim-stagger">
			<? foreach ($arResult['PROPERTIES']['ABOUT_NUMS']['VALUE'] as $i => $num) : ?>
            <div class="hero__content_num anim-scale-in">
                <div class="num anim-counter" data-counter-target="<?=$num ?>"><?=$num ?></div>
                <div class="text"><?=$arResult['PROPERTIES']['ABOUT_NUMS_TEXT']['VALUE'][$i] ?></div>
            </div>
			<? endforeach; ?>
        </div>
		<? endif; ?>
		<? if ($arResult['PROPERTIES']['ABOUT_TITLE']['VALUE']) : ?>
        <div class="hero__about">
            <div class="hero__about_title">
                <h2 class="h2"><?=$arResult['PROPERTIES']['ABOUT_TITLE']['~VALUE']['TEXT']  ?>
                </h2>
            </div>
            <div class="hero__about_text text-content">
                <?=$arResult['PREVIEW_TEXT'] ?>
            </div>
        </div>
		<? endif; ?>
    </div>
</div>
