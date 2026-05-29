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

$arViewModeList = $arResult['VIEW_MODE_LIST'];

$arViewStyles = array(
	'LIST' => array(
		'CONT' => 'bx_sitemap',
		'TITLE' => 'bx_sitemap_title',
		'LIST' => 'bx_sitemap_ul',
	),
	'LINE' => array(
		'CONT' => 'bx_catalog_line',
		'TITLE' => 'bx_catalog_line_category_title',
		'LIST' => 'bx_catalog_line_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/line-empty.png'
	),
	'TEXT' => array(
		'CONT' => 'bx_catalog_text',
		'TITLE' => 'bx_catalog_text_category_title',
		'LIST' => 'bx_catalog_text_ul'
	),
	'TILE' => array(
		'CONT' => 'bx_catalog_tile',
		'TITLE' => 'bx_catalog_tile_category_title',
		'LIST' => 'bx_catalog_tile_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/tile-empty.png'
	)
);
$arCurView = $arViewStyles[$arParams['VIEW_MODE']];

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

?><div class="<? echo $arCurView['CONT']; ?>"><?
if ('Y' == $arParams['SHOW_PARENT_NAME'] && 0 < $arResult['SECTION']['ID'])
{
	$this->AddEditAction($arResult['SECTION']['ID'], $arResult['SECTION']['EDIT_LINK'], $strSectionEdit);
	$this->AddDeleteAction($arResult['SECTION']['ID'], $arResult['SECTION']['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

	?><?
}
if (0 < $arResult["SECTIONS_COUNT"])
{
    
?>
<? if ($arResult['SECTIONS'][0]['DEPTH_LEVEL'] == 1) : ?>
<section class="section catalog-section anim-fade-in-up">
    <div class="container">
        <div class="heading anim-fade-in-left">
            <h2>Выберите направление</h2>
        </div>
        <div class="catalog-section__list anim-stagger <? echo $arCurView['LIST']; ?>">
            <?
        
                foreach ($arResult['SECTIONS'] as &$arSection)
                {
                    $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
                    $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
                    ?>
                    <?// printR($arSection); ?>
                    <a href="<? echo $arSection["SECTION_PAGE_URL"]; ?>" class="catalog-section__item anim-scale-in <?=$arSection['UF_DARK_PICTURE'] ? 'dark' : '' ?>" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
                    <div class="catalog-section__item_title">
                        <h4><? echo $arSection["NAME"];?></h4>
                    </div>
                    <div class="catalog-section__item_btn">
                        <span class="btn btn-quad-md white">
                            <svg width="10" height="15" viewBox="0 0 10 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.06055 1.06067L7.06055 7.06067L1.06055 13.0607" stroke="CurrentColor"
                                    stroke-width="3" />
                            </svg>
                        </span>
                    </div>
                    <div class="catalog-section__item_image">
                        <img class="img-desktop" src="<?=\CFile::ResizeImageGet($arSection['PICTURE'], array('width'=>584, 'height'=>232), BX_RESIZE_IMAGE_EXACT, true)['src']; ?>" alt="<? echo $arSection["NAME"];?>">
                    </div>
                </a>
                    
                    <?
                }
                ?>
                    <a href="/catalog/opk/" class="catalog-section__item anim-scale-in">
                        <div class="catalog-section__item_title">
                            <h4>Оборонно-промышленный комплекс</h4>
                        </div>
                        <div class="catalog-section__item_btn">
                            <span class="btn btn-quad-md white">
                                <svg width="10" height="15" viewBox="0 0 10 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.06055 1.06067L7.06055 7.06067L1.06055 13.0607" stroke="CurrentColor"
                                        stroke-width="3" />
                                </svg>
                            </span>
                        </div>
                        <div class="catalog-section__item_image">
                            <img class="img-desktop" src="<?=SITE_TEMPLATE_PATH ?>/assets/img/tank.png" alt="Оборонно-промышленный комплекс">
                        </div>
                    </a>
                <?
            ?>
        </div>
    </div>
</section>

<? else : ?>
<section class="section catalog-sections anim-fade-in-up">
    <div class="container">
        <div class="heading anim-fade-in-left">
            <h1 class="h2" id="<? echo $this->GetEditAreaId($arResult['SECTION']['ID']); ?>">
                <?echo (
                    isset($arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]) && $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"] != ""
                    ? $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]
                    : $arResult['SECTION']['NAME']
                ); ?>
            </h1>
        </div>
        <div class="catalog-sections__list ">
            <div class="catalog-sections__slider swiper">
                <div class="swiper-wrapper">
                    <?
        
                    foreach ($arResult['SECTIONS'] as &$arSection)
                    {
                        
                        $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
                        $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
                        ?>
                        <a href="<? echo $arSection["SECTION_PAGE_URL"]; ?>" class="catalog-sections__card swiper-slide" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
                            <span class="title h5"><? echo $arSection["NAME"];?></span>
                            <span class="btn btn-round light">
                                <svg width="4.5" height="9" viewBox="0 0 10 15" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.06055 1.06067L7.06055 7.06067L1.06055 13.0607" stroke="CurrentColor"
                                        stroke-width="2" />
                                </svg>
                            </span>
                            
                        </a>
                        <?
                    }
                    ?>
                    <!-- <a href="/catalogListElements" class="catalog-sections__card swiper-slide">
                        <span class="title h5">Масло для двигателя</span>
                        <span class="btn btn-round light">
                            <svg width="10" height="15" viewBox="0 0 10 15" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.06055 1.06067L7.06055 7.06067L1.06055 13.0607" stroke="CurrentColor"
                                    stroke-width="3" />
                            </svg>
                        </span>
                    </a>
                    <a href="/catalogListElements" class="catalog-sections__card swiper-slide">
                        <span class="title h5">Индустриальные масла</span>
                        <span class="btn btn-round light">
                            <svg width="4.5" height="9" viewBox="0 0 10 15" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.06055 1.06067L7.06055 7.06067L1.06055 13.0607" stroke="CurrentColor"
                                    stroke-width="2" />
                            </svg>
                        </span>
                    </a>
                    <a href="/catalogListElements" class="catalog-sections__card swiper-slide">
                        <span class="title h5">Редукторные масла</span>
                        <span class="btn btn-round light">
                            <svg width="4.5" height="9" viewBox="0 0 10 15" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.06055 1.06067L7.06055 7.06067L1.06055 13.0607" stroke="CurrentColor"
                                    stroke-width="2" />
                            </svg>
                        </span>
                    </a>
                    <a href="/catalogListElements" class="catalog-sections__card swiper-slide">
                        <span class="title h5">Моторные масла</span>
                        <span class="btn btn-round light">
                            <svg width="4.5" height="9" viewBox="0 0 10 15" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.06055 1.06067L7.06055 7.06067L1.06055 13.0607" stroke="CurrentColor"
                                    stroke-width="2" />
                            </svg>
                        </span>
                    </a>
                    <a href="/catalogListElements" class="catalog-sections__card swiper-slide">
                        <span class="title h5">Трансмиссионные масла</span>
                        <span class="btn btn-round light">
                            <svg width="4.5" height="9" viewBox="0 0 10 15" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.06055 1.06067L7.06055 7.06067L1.06055 13.0607" stroke="CurrentColor"
                                    stroke-width="2" />
                            </svg>
                        </span>
                    </a>
                    <a href="/catalogListElements" class="catalog-sections__card swiper-slide">
                        <span class="title h5">Редукторные масла</span>
                        <span class="btn btn-round light">
                            <svg width="4.5" height="9" viewBox="0 0 10 15" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.06055 1.06067L7.06055 7.06067L1.06055 13.0607" stroke="CurrentColor"
                                    stroke-width="2" />
                            </svg>
                        </span>
                    </a>
                    <a href="/catalogListElements" class="catalog-sections__card swiper-slide">
                        <span class="title h5">Моторные масла</span>
                        <span class="btn btn-round light">
                            <svg width="4.5" height="9" viewBox="0 0 10 15" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.06055 1.06067L7.06055 7.06067L1.06055 13.0607" stroke="CurrentColor"
                                    stroke-width="2" />
                            </svg>
                        </span>
                    </a>
                    <a href="/catalogListElements" class="catalog-sections__card swiper-slide">
                        <span class="title h5">Трансмиссионные масла</span>
                        <span class="btn btn-round light">
                            <svg width="4.5" height="9" viewBox="0 0 10 15" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.06055 1.06067L7.06055 7.06067L1.06055 13.0607" stroke="CurrentColor"
                                    stroke-width="2" />
                            </svg>
                        </span>
                    </a> -->
                </div>
            </div>

        </div>
    </div>
</section>
<? endif; ?>
<?
	
} else { ?>
  <section class="section catalog-sections anim-fade-in-up">
    <div class="container">
        <div class="heading anim-fade-in-left">
            <h1 class="h2" id="<? echo $this->GetEditAreaId($arResult['SECTION']['ID'] ?? 0); ?>">
                <?if (isset($GLOBALS['arrFilter']['PROPERTY_OPK_VALUE']) && $GLOBALS['arrFilter']['PROPERTY_OPK_VALUE'] === 'Да'):?>
                    Оборонно-промышленный комплекс
                <?else:?>
                <?echo (
                    isset($arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]) && $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"] != ""
                    ? $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]
                    : $arResult['SECTION']['NAME']
                ); ?>
                <?endif;?>
            </h1>
        </div>
    </div>
</section>  <?
}
?></div>