<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Catalog\ProductTable;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogElementComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);

$haveOffers = !empty($arResult['OFFERS']);

$templateData = [
	'TEMPLATE_LIBRARY' => ['popup', 'fx'],
	'ITEM' => [
		'ID' => $arResult['ID'],
		'IBLOCK_ID' => $arResult['IBLOCK_ID'],
	],
];

if ($haveOffers)
{
	$templateData['ITEM']['OFFERS_SELECTED'] = $arResult['OFFERS_SELECTED'];
	$templateData['ITEM']['JS_OFFERS'] = $arResult['JS_OFFERS'];
}

$name = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
	: $arResult['NAME'];
$title = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE']
	: $arResult['NAME'];
$alt = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']
	: $arResult['NAME'];

$actualItem = $arResult;
$minPrice = false;
if (isset($actualItem['MIN_PRICE']) || isset($actualItem['RATIO_PRICE']))
	$minPrice = (isset($actualItem['RATIO_PRICE']) ? $actualItem['RATIO_PRICE'] : $actualItem['MIN_PRICE']);
$showPrice = !empty($minPrice) || !empty($actualItem['ITEM_PRICES'][0]['PRINT_PRICE']);

$article = $arResult['DISPLAY_PROPERTIES']['CML2_ARTICLE']['VALUE'] ?? '';

$morePhotos = [];
if (!empty($arResult['PREVIEW_PICTURE']['SRC']))
{
	$morePhotos[] = $arResult['PREVIEW_PICTURE'];
}
if (!empty($arResult['DETAIL_PICTURE']['SRC']))
{
	$morePhotos[] = $arResult['DETAIL_PICTURE'];
}
if (!empty($arResult['PROPERTIES']['MORE_PHOTO']['VALUE']))
{
	foreach ((array)$arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $photoId)
	{
		$photo = CFile::GetFileArray($photoId);
		if ($photo)
			$morePhotos[] = $photo;
	}
}

$displayProps = $arResult['DISPLAY_PROPERTIES'] ?? [];
$docFiles = [];
$filePropCodes = ['FAYL', 'FILES', 'TDS', 'TDS_1'];
foreach ($filePropCodes as $code)
{
	$val = $arResult['PROPERTIES'][$code]['VALUE'] ?? null;
	// printR($val);
	if (empty($val)) continue;
	foreach ((array)$val as $fileVal)
	{
		$file = null;
		if (is_numeric($fileVal) && (int)$fileVal > 0)
		{
			$file = CFile::GetFileArray((int)$fileVal);
		}
		elseif (is_string($fileVal) && $fileVal !== '')
		{
			$fileName = basename($fileVal);
			$dbFile = CFile::GetList([], ['ORIGINAL_NAME' => $fileName]);
			if ($arFile = $dbFile->Fetch())
			{
				$file = CFile::GetFileArray($arFile['ID']);
			}
			if (!$file)
			{
				$relPath = trim($fileVal, '/');
				$uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/upload/';
				$dirs = array_diff(scandir($uploadDir), ['.', '..', 'resize_cache', 'tmp']);
				foreach ($dirs as $dir)
				{
					$fullPath = $uploadDir . $dir . '/' . $relPath;
					if (file_exists($fullPath))
					{
						$arFile = CFile::MakeFileArray($fullPath);
						if ($arFile)
						{
							$fileId = CFile::SaveFile($arFile, 'iblock');
							if ($fileId)
							{
								$file = CFile::GetFileArray($fileId);
							}
						}
						break;
					}
				}
			}
		}
		if ($file)
		{
			if (!isset($file['FILE_SIZE_FORMATTED']))
				$file['FILE_SIZE_FORMATTED'] = CFile::FormatSize($file['FILE_SIZE']);
			if (!isset($file['ORIGINAL_NAME']))
				$file['ORIGINAL_NAME'] = basename($file['SRC']);
			$docFiles[] = $file;
		}
	}
}

// }
if (!empty($arResult['PROPERTIES']['TDS']['VALUE']))
{
		$file = CFile::GetFileArray($arResult['PROPERTIES']['TDS']['VALUE']);
		if ($file)
		{
			$file['FILE_SIZE_FORMATTED'] = CFile::FormatSize($file['FILE_SIZE']);
			$docFiles[] = $file;
		}
}
if (!empty($arResult['PROPERTIES']['TDS_1']['VALUE']))
{
		$file = CFile::GetFileArray($arResult['PROPERTIES']['TDS_1']['VALUE']);
		if ($file)
		{
			$file['FILE_SIZE_FORMATTED'] = CFile::FormatSize($file['FILE_SIZE']);
			$docFiles[] = $file;
		}
}
if (!empty($arResult['PROPERTIES']['FILES']['VALUE']))
{
	foreach ($arResult['PROPERTIES']['FILES']['VALUE'] as $fileId){
		$file = CFile::GetFileArray($fileId);
		if ($file)
		{
			$file['FILE_SIZE_FORMATTED'] = CFile::FormatSize($file['FILE_SIZE']);
			$docFiles[] = $file;
		}
	}
}
if ($article) {
    $articleElements = [];
    //http://dev.1c-bitrix.ru/api_help/iblock/classes/ciblockelement/getlist.php
    /*
    Обязательно должно быть использовано поле IBLOCK_ID.
    В качестве одного из полей необходимо указать PROPERTY_<PROPERTY_CODE>,
    где PROPERTY_CODE - ID или мнемонический код.
    Будут выведены значения свойств элемента
    в виде полей PROPERTY_<PROPERTY_CODE>_VALUE - значение;
    PROPERTY_<PROPERTY_CODE>_ID - код значения у элемента;
    PROPERTY_<PROPERTY_CODE>_ENUM_ID - код значения (для свойств типа список).
    При установленном модуле торгового каталога можно выводить цены элемента.
    Для этого в качестве одного из полей необходимо указать CATALOG_GROUP_<PRICE_CODE>,
    где PRICE_CODE - ID типа цены.
    Есть возможность выбрать поля элементов по значениям свойства типа "Привязка к элементам".
    Для этого необходимо указать  PROPERTY_<PROPERTY_CODE>.<FIELD>,
    где PROPERTY_CODE - ID или мнемонический код свойства привязки,
    а FIELD - поле указанного в привязке элемента.
    */
    $lstSelect = [
            "ID",
    "IBLOCK_ID",
    "IBLOCK_SECTION_ID",
    "NAME",
    "DETAIL_PAGE_URL",
    "LIST_PAGE_URL",
    "CODE",
    "SECTION_CODE"
        ];
    /*
    PROPERTY_<PROPERTY_CODE> - фильтр по значениям свойств.
    PROPERTY_<PROPERTY_CODE>_VALUE - фильтр по значениям списка для свойств типа "список".
    CATALOG_<CATALOG_FIELD>_<PRICE_TYPE> - по полю CATALOG_FIELD из цены типа PRICE_TYPE (ID типа цены),
    где CATALOG_FIELD может быть: PRICE - цена, CURRENCY - валюта.
    PROPERTY_<PROPERTY_CODE>.<FIELD> - фильтр по значениям полей связанных элементов,
    где PROPERTY_CODE - ID или мнемонический код свойства привязки,
    а FIELD - поле указанного в привязке элемента.
    */
    $dctFilter = [
            'IBLOCK_ID'=> $arResult['ORIGINAL_PARAMETERS']['IBLOCK_ID'],
            'SECTION_CODE'=> $arResult['ORIGINAL_PARAMETERS']['SECTION_CODE'],
            'PROPERTY_CML2_ARTICLE' => $article
         ];
    /*
    CIBlockElement::GetList(
         array arOrder = ['SORT'=>'ASC'], - сортировка
         array arFilter = [], - фильтр.
         mixed arGroupBy = false, - группировка.
         mixed arNavStartParams = false, - параметры для постраничной навигации.
         array arSelectFields = [] - выбираемые поля и свойства.
         );
    */
    $rdb = \CIBlockElement::GetList([], $dctFilter, false, false, $lstSelect);
    //while($element = $rdb->GetNextElement()) {
    //	$dctElement = $element->GetFields();
    //	$lstElements[] = $dctElement;
    //}
    //$CNT = $rdb->SelectedRowsCount(); // количестов елементов
    while($dctElement = $rdb->GetNextElement()) {
        $fields = $dctElement->GetFields();
        $props = $dctElement->GetProperties();
        $fields['PROPERTIES'] = $props;
        $articleElements[] = $fields;
    }
}

?>
<section class="catalog-element section section-white section-round-top anim-fade-in-up anim-visible card" data-basket-id="<?=$arResult['ID']?>" data-product-id="<?=$arResult['PRODUCT_ID']?>" id="<?=$this->GetEditAreaId($arResult['ID'])?>">
    <div class="container">
        <?// printR($articleElements); ?>
        <div class="heading anim-fade-in-left anim-visible">
            <h1 class="h2"><?=$name?></h1>
            <?if ($article):?>
            <button class="article copy-link" data-copied="<?=$article?>">
                Арт. <?=$article?>
                <span class="icon">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0 8.62704C0 7.72946 0.358213 6.86864 0.995837 6.23395C1.63346 5.59927 2.49826 5.24271 3.4 5.24271H5.605V7.23349H3.4C3.0287 7.23349 2.6726 7.38031 2.41005 7.64165C2.1475 7.90299 2 8.25745 2 8.62704V15.7939C2 16.1635 2.1475 16.5179 2.41005 16.7792C2.6726 17.0406 3.0287 17.1874 3.4 17.1874H10.6C10.9713 17.1874 11.3274 17.0406 11.5899 16.7792C11.8525 16.5179 12 16.1635 12 15.7939V14.0022H14V15.7939C14 16.6914 13.6418 17.5523 13.0042 18.1869C12.3665 18.8216 11.5017 19.1782 10.6 19.1782H3.4C2.49826 19.1782 1.63346 18.8216 0.995837 18.1869C0.358213 17.5523 0 16.6914 0 15.7939V8.62704Z" fill="CurrentColor" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8 0H16C17.0609 0 18.0783 0.419485 18.8284 1.16617C19.5786 1.91286 20 2.92559 20 3.98157V11.9447C20 13.0007 19.5786 14.0134 18.8284 14.7601C18.0783 15.5068 17.0609 15.9263 16 15.9263H8C6.93913 15.9263 5.92172 15.5068 5.17157 14.7601C4.42143 14.0134 4 13.0007 4 11.9447V3.98157C4 2.92559 4.42143 1.91286 5.17157 1.16617C5.92172 0.419485 6.93913 0 8 0ZM8 1.99078C7.46957 1.99078 6.96086 2.20053 6.58579 2.57387C6.21071 2.94721 6 3.45358 6 3.98157V11.9447C6 12.4727 6.21071 12.9791 6.58579 13.3524C6.96086 13.7257 7.46957 13.9355 8 13.9355H16C16.5304 13.9355 17.0391 13.7257 17.4142 13.3524C17.7893 12.9791 18 12.4727 18 11.9447V3.98157C18 3.45358 17.7893 2.94721 17.4142 2.57387C17.0391 2.20053 16.5304 1.99078 16 1.99078H8Z" fill="CurrentColor" />
                    </svg>
                </span>
            </button>
            <?endif;?>
        </div>
        <div class="catalog-element__row">
            <div class="catalog-element__card">
                <div class="catalog-element__col">
                    <div class="catalog-element__picture catalog-element__col_item">
                        <?if (!empty($arResult['PROPERTIES']['NOVINKA']['VALUE']) || !empty($arResult['PROPERTIES']['AKTSIYA']['VALUE'])):?>
                        <div class="catalog-element__picture_sticks">
                            <?if (!empty($arResult['PROPERTIES']['NOVINKA']['VALUE'])):?><div class="stick new">Новинка!</div><?endif;?>
                            <?if (!empty($arResult['PROPERTIES']['AKTSIYA']['VALUE'])):?><div class="stick action">Акция!</div><?endif;?>
                        </div>
                        <?endif;?>
					<?if (!empty($morePhotos)):?>
                        <div class="catalog-element__picture_slider swiper">
                            <div class="swiper-wrapper">
                                <?foreach ($morePhotos as $photo):?>
                                <div class="swiper-slide">
                                    <img src="<?=$photo['SRC']?>" width="266" height="407" alt="<?=$alt?>">
                                </div>
                                <?endforeach;?>
                            </div>
                            <!-- <div class="swiper-pagination"></div> -->
                        </div>
                        <div class="catalog-element__picture_thumbs swiper">
                            <div class="swiper-wrapper">
                                <?foreach ($morePhotos as $photo):?>
                                <div class="swiper-slide">
                                    <img src="<?=$photo['SRC']?>" width="58" height="68" alt="<?=$alt?>">
                                </div>
                                <?endforeach;?>
                            </div>
                        </div>

                    <? else : ?>
                        <div class="catalog-element__picture_slider swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="<?=$arResult['DETAIL_PICTURE']['SRC'] ?: $arResult['PREVIEW_PICTURE']['SRC']?: $templateFolder . '/images/no_photo.png'?>" width="266" height="407" alt="<?=$alt?>">
                                </div>
                            </div>
                            <!-- <div class="swiper-pagination"></div> -->
                        </div>
                        <div class="catalog-element__picture_thumbs swiper" style="display: none;">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="<?=$arResult['DETAIL_PICTURE']['SRC'] ?: $arResult['PREVIEW_PICTURE']['SRC']?: $templateFolder . '/images/no_photo.png'?>" width="58" height="68" alt="<?=$alt?>">
                                </div>
                            </div>
                        </div>
					<?endif;?>
                    </div>
				</div>
                    
				<div class="catalog-element__col">
                    <div class="catalog-element__desc">
                        <div class="catalog-element__volume">
                            <div class="catalog-element__volume_title">Выберите объем</div>
                            <div class="catalog-element__volume_list swiper">
                                <div class="swiper-wrapper">
                                    <? foreach ($articleElements as $key => $art) : ?>
                                        <? if ($arResult['ID'] == $art['ID']) : ?>
                                        <div class="catalog-element__volume_item swiper-slide <?=$arResult['ID'] == $art['ID'] ? 'active' : '' ?>">
                                            <div class="catalog-element__volume_item_name">
                                                <?=$art['PROPERTIES']['OBEM_VES_NETTO']['VALUE'] . ' ' . $art['PROPERTIES']['CML2_BASE_UNIT']['VALUE'] ?>
                                            </div>
                                        </div>
                                        <? else : ?>
                                            <a href="<?=$art['DETAIL_PAGE_URL']?>" class="catalog-element__volume_item swiper-slide <?=$arResult['ID'] == $art['ID'] ? 'active' : '' ?>">
                                                <div class="catalog-element__volume_item_name">
                                                    <?=$art['PROPERTIES']['OBEM_VES_NETTO']['VALUE'] . ' ' . $art['PROPERTIES']['CML2_BASE_UNIT']['VALUE'] ?>
                                                </div>
                                            </a>
                                        <? endif; ?>
                                    <? endforeach; ?>
                                    <!-- <a href="/catalogElement" class="catalog-element__volume_item swiper-slide">
                                        <div class="catalog-element__volume_item_name">
                                            10 л
                                        </div>
                                    </a>
                                    <a href="/catalogElement" class="catalog-element__volume_item swiper-slide">
                                        <div class="catalog-element__volume_item_name">
                                            120 л
                                        </div>
                                    </a>
                                    <a href="/catalogElement" class="catalog-element__volume_item swiper-slide">
                                        <div class="catalog-element__volume_item_name">
                                            205 л
                                        </div>
                                    </a> -->
                                </div>
                                <div class="swiper-scrollbar"></div>
                            </div>
                        </div>
						<?if (!empty($displayProps)):?>
							<div class="catalog-element__desc_characters">
								<div class="catalog-element__desc_heading">
									<div class="h5">Основные характеристики</div>
								</div>
								<?foreach ($displayProps as $propCode => $prop):?>
									<?if ($prop['PROPERTY_TYPE'] === 'F' || $prop['CODE'] === 'CML2_ARTICLE' || $prop['CODE'] === 'NOVINKA' || $prop['CODE'] === 'AKTSIYA') continue;?>
									<div class="catalog-element__desc_characters_item">
										<p class="title"><?=$prop['NAME']?></p>
										<p class="value"><?=is_array($prop['DISPLAY_VALUE']) ? implode(', ', $prop['DISPLAY_VALUE']) : $prop['DISPLAY_VALUE']?></p>
									</div>
								<?endforeach;?>
								<!-- <div class="catalog-element__desc_characters_item">
									<p class="title">Назначение</p>
									<p class="value"><a href="#">Авиационные масла</a></p>
								</div>
								<div class="catalog-element__desc_characters_item">
									<p class="title">Тип</p>
									<p class="value"><a href="#">Полусинтетическое</a></p>
								</div>
								<div class="catalog-element__desc_characters_item">
									<p class="title">Вязкость</p>
									<p class="value"><a href="#">10W-30US</a></p>
								</div>
								<div class="catalog-element__desc_characters_item">
									<p class="title">Объем</p>
									<p class="value">205 л. (бочка)</p>
								</div>
								<div class="catalog-element__desc_characters_item">
									<p class="title">Вес</p>
									<p class="value">200кг. (бочка)</p>
								</div> -->
							</div>
						<?endif;?>
                        <!-- <div class="catalog-element__desc_docs">
                            <div class="catalog-element__desc_heading">
                                <div class="h5">Допуски и спецификации</div>
                            </div>
                            <div class="catalog-element__desc_docs_list">
                                <a href="#" class="catalog-element__desc_docs_item">DIN ISO 15380:2020-12</a><a href="#"
                                    class="catalog-element__desc_docs_item">DIN 51524-2 (TOST gemäß DIN EN ISO
                                    4263-3)</a>
                                <a href="#" class="catalog-element__desc_docs_item">DIN 51524-3 (HVLP)</a>
                            </div>
                        </div> -->
                    </div>
                </div>
                    
                    <!-- <?if (!empty($docFiles)):?>
                    <div class="catalog-element__files catalog-element__col_item">
                        <div class="catalog-element__files_header">
                            <div class="h5">Документация</div>
                        </div>
                        <div class="catalog-element__files_list">
                            <?foreach ($docFiles as $file):?>
                            <div class="catalog-element__files_item">
                                <div class="h6"><?=$file['ORIGINAL_NAME']?></div>
                                <a href="<?=$file['SRC']?>" download="<?=$file['ORIGINAL_NAME']?>" class="btn btn_with-icon btn-light">
                                    <span class="text">Скачать</span>
                                    <span class="icon">
                                        <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M1.16647 15.0254H1.3889C1.91997 15.0254 2.3131 14.9409 2.56916 14.7735C2.79331 14.6287 2.95539 14.4062 3.05454 14.1033C3.12782 13.879 3.16489 13.6406 3.16489 13.387C3.16489 13.1151 3.12265 12.8632 3.0373 12.6314C2.95108 12.3997 2.83469 12.2189 2.68641 12.0884C2.54502 11.9662 2.3838 11.8826 2.20361 11.8391C2.02343 11.7955 1.75186 11.773 1.3889 11.773H1.16647V15.0254ZM0 15.9123V10.8868H1.43287C2.04239 10.8868 2.52864 10.9437 2.89418 11.0575C3.3718 11.2065 3.73649 11.4826 3.98995 11.8851C4.24342 12.2884 4.37102 12.7938 4.37102 13.4012C4.37102 14.0255 4.24342 14.535 3.98995 14.93C3.67355 15.4278 3.18472 15.7316 2.52174 15.8378C2.21741 15.8872 1.82772 15.9123 1.35269 15.9123H0ZM7.53246 11.6849C7.11088 11.6849 6.78585 11.8548 6.55652 12.1953C6.34961 12.5033 6.24616 12.8974 6.24616 13.3793C6.24616 13.9374 6.36858 14.3709 6.61515 14.6779C6.8462 14.9691 7.15398 15.1139 7.53591 15.1139C7.9549 15.1139 8.28165 14.9432 8.51529 14.5993C8.7222 14.2972 8.82566 13.8981 8.82566 13.4011C8.82566 12.8547 8.70237 12.4288 8.45667 12.1209C8.22561 11.8305 7.91697 11.6849 7.53246 11.6849ZM7.53591 10.798C8.34976 10.798 8.97308 11.0482 9.40674 11.5502C9.82315 12.0297 10.0309 12.6463 10.0309 13.4011C10.0309 14.2261 9.78521 14.8821 9.2938 15.3691C8.86963 15.79 8.28338 16 7.53591 16C6.72292 16 6.09873 15.7498 5.66508 15.2486C5.24867 14.7692 5.04003 14.1424 5.04003 13.3693C5.04003 12.561 5.2866 11.9125 5.77888 11.4255C6.20477 11.0072 6.79102 10.798 7.53591 10.798ZM14.6595 14.7271L15 15.6316C14.6922 15.7763 14.425 15.8734 14.1956 15.9244C13.9663 15.9746 13.6835 15.9997 13.3482 15.9997C12.8412 15.9997 12.4222 15.9295 12.0912 15.7881C11.6273 15.5889 11.2782 15.276 11.0428 14.8484C10.8307 14.4652 10.7247 13.9966 10.7247 13.4435C10.7247 12.5105 11.0178 11.8027 11.6049 11.3232C12.0308 10.9734 12.5929 10.7986 13.2895 10.7986C13.587 10.7986 13.8568 10.8245 14.1008 10.8772C14.3439 10.9308 14.6207 11.0245 14.9293 11.1592L14.5388 12.011C14.1275 11.7909 13.7289 11.6476 13.3413 11.5812C13.0486 11.5303 12.718 11.5047 12.3498 11.5047C11.928 11.5047 11.6 11.5577 11.3654 11.6635C11.1778 11.748 11.0322 11.8723 10.9287 12.0361C10.8252 12.2002 10.7775 12.4435 10.7858 12.766C10.7922 12.9984 10.8511 13.2146 10.9625 13.4153C11.0757 13.618 11.2378 13.7791 11.4487 13.8978C11.6596 14.0165 11.9172 14.0757 12.2216 14.0757C12.5645 14.0757 12.8574 14.0091 13.1005 13.8758C13.319 13.7562 13.4737 13.5815 13.5647 13.3519L14.6595 14.7271Z" fill="CurrentColor" />
                                        </svg>
                                    </span>
                                    <span class="filesize"><?=$file['FILE_SIZE_FORMATTED']?></span>
                                </a>
                            </div>
                            <?endforeach;?>
                        </div>
                    </div>
                    <?endif;?> -->
                <!-- </div> -->
                <div class="catalog-element__tabs">
                    <div class="catalog-element__tabs_head">
						<div class="catalog-element__tabs_control">
                            <button class="tab active" data-tab="desc">Описание</button>
                            <button class="tab" data-tab="chars">Характеристики</button>
                             <?if (!empty($docFiles)):?><button class="tab" data-tab="docs">Документация</button><?endif;?>
                            <button class="tab" data-tab="delivery">Доставка и оплата</button>
                            <button class="tab" data-tab="analogs">Аналоги</button>
                        </div>
                        
                    </div>
                    <div class="catalog-element__tabs_list">
                        <div class="catalog-element__tabs_item tab-content active" data-content="desc">
                            <div class="catalog-element__tabs_item_content text-content">
                                <?=$arResult['DETAIL_TEXT'] ?: $arResult['PREVIEW_TEXT']?>
                            </div>
                        </div>
                        <div class="catalog-element__tabs_item tab-content" data-content="chars">
                            <div class="catalog-element__tabs_item_content text-content">
                                <?foreach ($displayProps as $propCode => $prop):?>
                                    <?if ($prop['PROPERTY_TYPE'] === 'F' || $prop['CODE'] === 'CML2_ARTICLE' || $prop['CODE'] === 'NOVINKA' || $prop['CODE'] === 'AKTSIYA') continue;?>
                                    <div class="catalog-element__desc_characters_item">
                                        <span class="title"><?=$prop['NAME']?></span>
                                        <span class="value"><?=is_array($prop['DISPLAY_VALUE']) ? implode(', ', $prop['DISPLAY_VALUE']) : $prop['DISPLAY_VALUE']?></span>
                                    </div>
                                <?endforeach;?>
                            </div>
                        </div>
                        <?if (!empty($docFiles)):?>
                        <div class="catalog-element__tabs_item tab-content" data-content="docs">
                            <div class="catalog-element__tabs_item_content docs-content">
								<div class="catalog-element__files_list">
									<?foreach ($docFiles as $file):?>
										<div class="catalog-element__files_item">
											<div class="h6"><?=$file['ORIGINAL_NAME']?></div>
											<a href="<?=$file['SRC']?>" download="<?=$file['ORIGINAL_NAME']?>" class="btn btn_with-icon btn-light">
												<span class="text">Скачать</span>
												<span class="icon">
													<svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path fill-rule="evenodd" clip-rule="evenodd" d="M1.16647 15.0254H1.3889C1.91997 15.0254 2.3131 14.9409 2.56916 14.7735C2.79331 14.6287 2.95539 14.4062 3.05454 14.1033C3.12782 13.879 3.16489 13.6406 3.16489 13.387C3.16489 13.1151 3.12265 12.8632 3.0373 12.6314C2.95108 12.3997 2.83469 12.2189 2.68641 12.0884C2.54502 11.9662 2.3838 11.8826 2.20361 11.8391C2.02343 11.7955 1.75186 11.773 1.3889 11.773H1.16647V15.0254ZM0 15.9123V10.8868H1.43287C2.04239 10.8868 2.52864 10.9437 2.89418 11.0575C3.3718 11.2065 3.73649 11.4826 3.98995 11.8851C4.24342 12.2884 4.37102 12.7938 4.37102 13.4012C4.37102 14.0255 4.24342 14.535 3.98995 14.93C3.67355 15.4278 3.18472 15.7316 2.52174 15.8378C2.21741 15.8872 1.82772 15.9123 1.35269 15.9123H0ZM7.53246 11.6849C7.11088 11.6849 6.78585 11.8548 6.55652 12.1953C6.34961 12.5033 6.24616 12.8974 6.24616 13.3793C6.24616 13.9374 6.36858 14.3709 6.61515 14.6779C6.8462 14.9691 7.15398 15.1139 7.53591 15.1139C7.9549 15.1139 8.28165 14.9432 8.51529 14.5993C8.7222 14.2972 8.82566 13.8981 8.82566 13.4011C8.82566 12.8547 8.70237 12.4288 8.45667 12.1209C8.22561 11.8305 7.91697 11.6849 7.53246 11.6849ZM7.53591 10.798C8.34976 10.798 8.97308 11.0482 9.40674 11.5502C9.82315 12.0297 10.0309 12.6463 10.0309 13.4011C10.0309 14.2261 9.78521 14.8821 9.2938 15.3691C8.86963 15.79 8.28338 16 7.53591 16C6.72292 16 6.09873 15.7498 5.66508 15.2486C5.24867 14.7692 5.04003 14.1424 5.04003 13.3693C5.04003 12.561 5.2866 11.9125 5.77888 11.4255C6.20477 11.0072 6.79102 10.798 7.53591 10.798ZM14.6595 14.7271L15 15.6316C14.6922 15.7763 14.425 15.8734 14.1956 15.9244C13.9663 15.9746 13.6835 15.9997 13.3482 15.9997C12.8412 15.9997 12.4222 15.9295 12.0912 15.7881C11.6273 15.5889 11.2782 15.276 11.0428 14.8484C10.8307 14.4652 10.7247 13.9966 10.7247 13.4435C10.7247 12.5105 11.0178 11.8027 11.6049 11.3232C12.0308 10.9734 12.5929 10.7986 13.2895 10.7986C13.587 10.7986 13.8568 10.8245 14.1008 10.8772C14.3439 10.9308 14.6207 11.0245 14.9293 11.1592L14.5388 12.011C14.1275 11.7909 13.7289 11.6476 13.3413 11.5812C13.0486 11.5303 12.718 11.5047 12.3498 11.5047C11.928 11.5047 11.6 11.5577 11.3654 11.6635C11.1778 11.748 11.0322 11.8723 10.9287 12.0361C10.8252 12.2002 10.7775 12.4435 10.7858 12.766C10.7922 12.9984 10.8511 13.2146 10.9625 13.4153C11.0757 13.618 11.2378 13.7791 11.4487 13.8978C11.6596 14.0165 11.9172 14.0757 12.2216 14.0757C12.5645 14.0757 12.8574 14.0091 13.1005 13.8758C13.319 13.7562 13.4737 13.5815 13.5647 13.3519L14.6595 14.7271Z" fill="CurrentColor" />
													</svg>
												</span>
												<span class="filesize"><?=$file['FILE_SIZE_FORMATTED']?></span>
											</a>
										</div>
									<?endforeach;?>
								</div>
                            </div>
                        </div>
                        <?endif;?>
                        <div class="catalog-element__tabs_item tab-content" data-content="delivery">
                            <div class="catalog-element__tabs_item_content text-content">
                                <?=$arResult['PROPERTIES']['DELIVERY_TEXT']['VALUE']['TEXT'] ?? '<p>Производственная компания Симэкс-Хим работает по всей России. Доставка осуществляется транспортными компаниями.</p>'?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="catalog-element__col sticky">
                <div class="catalog-element__col_item">
                    <div class="catalog-element__price">
                        <div class="price"><?if ($showPrice):?><?=$minPrice['PRINT_DISCOUNT_VALUE'] ?: $actualItem['ITEM_PRICES'][0]['PRINT_PRICE']?><?else:?>Цена по запросу<?endif;?></div>
                        <button class="share-btn">
                            Поделиться
                            <span class="icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15 7.5L9 10.5M15 16.5L9 13.5" stroke="CurrentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M9 12C9 13.6569 7.65685 15 6 15C4.34315 15 3 13.6569 3 12C3 10.3431 4.34315 9 6 9C7.65685 9 9 10.3431 9 12Z" stroke="CurrentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <circle cx="18" cy="6" r="3" stroke="CurrentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <circle cx="18" cy="18" r="3" stroke="CurrentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </button>
                    </div>
                    <div class="catalog-element__control catalog__item_bottom" id="catalog-item-bottom-<?=$arResult['ID']?>">
                        <? if ($arResult['BASKET_QUANTITY']) : ?>
                        <div class="counter">
                            <button class="btn btn-quad grey dec">
                                <svg width="12" height="3" viewBox="0 0 12 3" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 3V0H12V3H0Z" fill="black" />
                                </svg>
                            </button>
                            <input type="text" name="<?=$arParams['PRODUCT_QUANTITY_VARIABLE']?>" class="btn btn-quad counter_value" value="<?=$arResult['BASKET_QUANTITY']?>">
                            <button class="btn btn-quad grey inc">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.03736 12V6.96264H0V5.02418H5.03736V0H6.97582V5.02418H12V6.96264H6.97582V12H5.03736Z" fill="black" />
                                </svg>
                            </button>
                        </div>
                        <div class="catalog-element__control_buttons">
                            <button class="btn btn-grey js-remove-to-cart" data-id="<?=$arResult['ID']?>" rel="nofollow">Убрать из корзины</button>
                            <button class="btn btn-md btn-blue add-to-favorite">Добавить в избранное</button>
                        </div>
                        <? else : ?>
                        <div class="catalog-element__control_buttons">
                            <button class="btn btn-primary js-add-to-cart" data-id="<?=$arResult['ID']?>" rel="nofollow">Добавить в корзину</button>
                            <button class="btn btn-md btn-blue add-to-favorite">Добавить в избранное</button>
                        </div>
                        <? endif; ?>
                    </div>
					<?if (!empty($arResult['PROPERTIES']['MARKETPLACE_LINK']['VALUE']) || !empty($arResult['PROPERTIES']['MARKETPLACE_LINK_2']['VALUE'])):?>
						<div class="catalog-element__control_bottom">
							<div class="catalog-element__volume_control_text">Или купить на маркетплейсах</div>
							<div class="markets">
								<?if (!empty($arResult['PROPERTIES']['MARKETPLACE_LINK']['VALUE'])):?>
								<div class="makets__item">
									<a href="<?=$arResult['PROPERTIES']['MARKETPLACE_LINK']['VALUE']?>" target="_blank">
										<img src="/assets/img/icons/vi.svg" width="56" height="56" alt="Wildberries">
									</a>
								</div>
								<?endif;?>
								<?if (!empty($arResult['PROPERTIES']['MARKETPLACE_LINK_2']['VALUE'])):?>
								<div class="makets__item">
									<a href="<?=$arResult['PROPERTIES']['MARKETPLACE_LINK_2']['VALUE']?>" target="_blank">
										<img src="/assets/img/icons/ozon.svg" width="56" height="56" alt="Ozon">
									</a>
								</div>
								<?endif;?>
							</div>
						</div>
					<?endif;?>
                </div>
                <div class="catalog-element__notice">
                    <span class="notice_checkbox"></span>
                    Только оптовые заказы,
                    для розничных покупок посмотрите нас на маркетплейсах
                </div>
            </div>
        </div>
    </div>
</section>
<script>
(function() {
    var container = document.getElementById('<?=CUtil::JSEscape($this->GetEditAreaId($arResult['ID']))?>');
    if (!container) return;
    var nav = container.querySelector('.catalog-element__tabs_nav');
    var panes = container.querySelectorAll('.catalog-element__tabs_pane');
    if (!nav || !panes.length) return;
    nav.addEventListener('click', function(e) {
        var btn = e.target.closest('.catalog-element__tabs_btn');
        if (!btn) return;
        var tab = btn.getAttribute('data-tab');
        nav.querySelectorAll('.catalog-element__tabs_btn').forEach(function(b) { b.classList.remove('active'); });
        btn.classList.add('active');
        panes.forEach(function(p) { p.classList.toggle('active', p.getAttribute('data-tab') === tab); });
    });
})();
</script>

<script>
	function bindCounter(el) {
		var c = el.querySelector('.counter');
		if (!c || c.dataset.counterBound) return;
		c.dataset.counterBound = '1';
		c.addEventListener('click', function(ev) {
			var inp = c.querySelector('.counter_value');
			if (!inp) return;
			if (ev.target.closest('.inc')) {
				inp.value = parseInt(inp.value, 10) + 1;
			} else if (ev.target.closest('.dec')) {
				var v = parseInt(inp.value, 10);
				if (v > 0) inp.value = v - 1;
			}
		});
	}

	document.addEventListener('click', function(e) {
		if (e.target.closest('.js-add-to-cart')) {
			const btn = e.target.closest('.js-add-to-cart');
			const card = e.target.closest('.card')
			const cardBottom = card.querySelector('.catalog__item_bottom')

			if (!btn) return;
			btn.disabled = true
			e.preventDefault();

			BX.ajax({
				url: '/local/ajax/cart.php',
				method: 'POST',
				dataType: 'json',
				data: {
					action: 'add',
					id: btn.dataset.id,
					quantity: 1
				},
				onsuccess: function(response) {
					BX.onCustomEvent('OnBasketChange');
					BX.ajax({
						url: location.href,
						method: 'GET',
						dataType: 'html',
						processData: false,
						onsuccess: (res) => {
							const parser = new DOMParser();
							const doc = parser.parseFromString(res, 'text/html');
							const newCardBottom = doc.querySelector(`#${cardBottom.id}`);
							if (newCardBottom) {
								cardBottom.replaceWith(newCardBottom);
								bindCounter(newCardBottom);
							}
						}
					})
				}
			});
		}

		if (e.target.closest('.js-remove-to-cart')) {
			const btn = e.target.closest('.js-remove-to-cart');
			const card = e.target.closest('.card')
			const cardBottom = card.querySelector('.catalog__item_bottom')

			if (!btn) return;
			btn.disabled = true
			e.preventDefault();

			BX.ajax({
				url: '/local/ajax/cart.php',
				method: 'POST',
				dataType: 'json',
				data: {
					action: 'delete',
					id: btn.dataset.id
				},
				onsuccess: function(response) {
					BX.onCustomEvent('OnBasketChange');
					BX.ajax({
						url: location.href,
						method: 'GET',
						dataType: 'html',
						processData: false,
						onsuccess: (res) => {
							const parser = new DOMParser();
							const doc = parser.parseFromString(res, 'text/html');
							const newCardBottom = doc.querySelector(`#${cardBottom.id}`);
							if (newCardBottom) {
								cardBottom.replaceWith(newCardBottom);
							}
						}
					})
				}
			});
		}

		if (e.target.closest('.dec')) {
			const btn = e.target.closest('.dec');
			const card = e.target.closest('.card')
			const cardBottom = card.querySelector('.catalog__item_bottom')
			const qty = card.querySelector('[name=quantity]').value

			if (!btn) return;
			btn.disabled = true

			if (parseInt(qty, 10) <= 0) {
				BX.ajax({
					url: '/local/ajax/cart.php',
					method: 'POST',
					dataType: 'json',
					data: {
						action: 'delete',
						id: card.dataset.basketId
					},
					onsuccess: function(response) {
						BX.onCustomEvent('OnBasketChange');
						BX.ajax({
							url: location.href,
							method: 'GET',
							dataType: 'html',
							processData: false,
							onsuccess: (res) => {
								btn.disabled = false
								const parser = new DOMParser();
								const doc = parser.parseFromString(res, 'text/html');
								const newCardBottom = doc.querySelector(`#${cardBottom.id}`);
								if (newCardBottom) cardBottom.replaceWith(newCardBottom);
							}
						})
					}
				});
			} else {
				BX.ajax({
					url: '/local/ajax/cart.php',
					method: 'POST',
					dataType: 'json',
					data: {
						action: 'update',
						id: card.dataset.basketId,
						quantity: qty
					},
					onsuccess: function(response) {
						BX.onCustomEvent('OnBasketChange');
						btn.disabled = false
					}
				});
			}
		}

		if (e.target.closest('.inc')) {
			const btn = e.target.closest('.inc');
			const card = e.target.closest('.card')
			const counter = card.querySelector('[name=quantity]')
			const qty = counter.value

			if (!btn) return;
			btn.disabled = true

			BX.ajax({
				url: '/local/ajax/cart.php',
				method: 'POST',
				dataType: 'json',
				data: {
					action: 'update',
					id: card.dataset.basketId,
					quantity: qty
				},
				onsuccess: function(response) {
					BX.onCustomEvent('OnBasketChange');
					btn.disabled = false
				},
			});
		}
	});
</script>
<!-- component-end -->
