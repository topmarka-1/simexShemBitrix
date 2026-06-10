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
?>

<section class="section section-gray news-detail anim-fade-in-up">
    <div class="container">
        <div class="news-detail__container">
            <div class="news-detail__head">
                <div class="news-detail__head_text text-content">
                    <h1 class="h2">
                        <?
                        $titleProp = $arResult['PROPERTIES']['TITLE'] ?? null;
                        if ($titleProp && !empty($titleProp['VALUE'])) {
                            if (is_array($titleProp['~VALUE'])) {
                                echo $titleProp['~VALUE']['TEXT'];
                            } else {
                                echo $titleProp['~VALUE'];
                            }
                        } else {
                            echo $arResult['NAME'];
                        }
                        ?>
                    </h1>
                    <?= $arResult['PREVIEW_TEXT'] ?>
                </div>
                <? if (is_array($arResult['DETAIL_PICTURE'])): ?>
                <div class="detail_picture">
                    <img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>"
                        height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>"
                        alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
                        title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>">
                </div>
                <? endif; ?>
            </div>
            <? if ($arResult['DETAIL_TEXT']) : ?>
            <div class="news-detail__content text-content">
                <?= $arResult['DETAIL_TEXT'] ?>
            </div>
            <? endif; ?>
        </div>
    </div>
</section>
