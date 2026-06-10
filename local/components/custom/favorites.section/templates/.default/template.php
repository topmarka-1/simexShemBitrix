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
<div class="personal__item">
    <div class="personal__item_heading">
        <h5>Ваши избранные категории</h5>
    </div>
    <div class="personal__favorites_sections">
        <? if (!empty($arResult['FAVOURITES_SECTIONS'])) : ?> 
        <div class="catalog-section__list">
                <? foreach ($arResult['FAVOURITES_SECTIONS'] as $arItem) : ?>
                <a href="<?=$arItem['SECTION_PAGE_URL'] ?>" class="catalog-section__card">
                    <span class="title h5"><?=$arItem['NAME'] ?></span>
                    <span class="btn btn-round-lg white">
                        <svg width="10" height="15" viewBox="0 0 10 15" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.06055 1.06067L7.06055 7.06067L1.06055 13.0607" stroke="CurrentColor"
                                stroke-width="3" />
                        </svg>
                    </span>
                </a>
                <? endforeach; ?>
        </div>
        <? else : ?>
            <div class="personal__empty">
                <div class="personal__empty_img">
                    <img src="<?=SITE_TEMPLATE_PATH?>/assets/img/icons/empty.svg" alt="empty">
                </div>
                <div class="personal__empty_title">
                    Вы ничего не добавили
                    в избранные товары
                </div>
                <!-- <div class="personal__empty_link">
                    <a href="/catalog" class="btn btn-blue">В каталог</a>
                </div> -->
            </div>
        <? endif; ?>
    </div>
    
</div>