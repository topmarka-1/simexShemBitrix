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

<section class="section brands">
    <div class="container">
        <div class="heading">
            <h2>Наши бренды</h2>
            <div class="hand_icon">
                <svg width="18" height="26" viewBox="0 0 18 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M15.7173 13.028C15.3283 10.6535 13.672 10.3306 12.9585 10.3041C12.7566 10.2966 12.5726 10.1869 12.4643 10.0107C11.9242 9.13234 11.1919 8.90121 10.5711 8.90121C10.2869 8.90121 10.0263 8.94962 9.81802 9.00644C9.75674 9.02316 9.69445 9.03127 9.63286 9.03127C9.4137 9.03127 9.20248 8.92801 9.07055 8.73927C8.53924 7.97942 7.84581 7.77395 7.25141 7.77395C7.09241 7.77395 6.94047 7.7887 6.80069 7.81135C6.76336 7.81748 6.72633 7.82038 6.6899 7.82038C6.30953 7.82038 5.98863 7.50149 5.98812 7.0946L5.98309 2.70201C5.98168 1.56706 5.15704 1 4.33229 1C3.50604 1 2.67978 1.56893 2.68119 2.70627C2.68351 4.61322 2.69005 10.3404 2.69216 12.0663C2.69246 12.3579 2.52351 12.6214 2.26288 12.7339C-1.01155 14.147 3.03188 20.485 3.7562 21.5713C3.82684 21.6773 3.8687 21.8001 3.87806 21.9284L4.05506 24.3378C4.08264 24.7169 4.38885 24.9878 4.75714 24.9878L12.6697 25C13.0228 24.9996 13.3209 24.7403 13.3669 24.3789L13.6891 21.851C13.7028 21.7439 13.7404 21.6438 13.7972 21.5531C15.9118 18.1792 16.0779 15.229 15.7173 13.028Z"
                        stroke="#42454F" stroke-width="2" />
                    <path
                        d="M9.60367 4.57621H15.4998L14.2228 5.8945C13.987 6.13788 13.987 6.53251 14.2229 6.77589C14.3407 6.89753 14.4953 6.9584 14.6497 6.9584C14.8042 6.9584 14.9588 6.89753 15.0767 6.77578L17.3294 4.45031C17.5651 4.20693 17.5651 3.81231 17.3293 3.56893L15.0172 1.18248C14.7816 0.939207 14.3992 0.939103 14.1634 1.18259C13.9276 1.42597 13.9276 1.82059 14.1635 2.06397L15.3898 3.3297H9.60377C9.27029 3.3297 9 3.60882 9 3.95296C9 4.2971 9.27029 4.57621 9.60367 4.57621Z"
                        fill="#42454F" />
                </svg>
            </div>
        </div>
        <div class="brands__list swiper">
            <div class="swiper-wrapper">
				<?foreach($arResult["ITEMS"] as $arItem):?>
					<?
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>
                <div class="swiper-slide">
					<?//printR($arItem);?>
                    <a href="<?=$arItem['DETAIL_PAGE_URL'] ?>" class="brands__item" data-src="<?=\CFile::GetPath($arItem['PROPERTIES']['LOGO_GRAY']['VALUE']); ?>" data-src-color="<?=\CFile::GetPath($arItem['PROPERTIES']['LOGO_COLOR']['VALUE']); ?>">
                        <img src="<?=\CFile::GetPath($arItem['PROPERTIES']['LOGO_GRAY']['VALUE']); ?>" alt="<?=$arItem['NAME']?> логотип">
                        <span class="brands__item_name"><?=$arItem['NAME']?></span>
                    </a>
                </div>
				<?endforeach;?>
            </div>
        </div>
    </div>
</section>
<!-- <div class="news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<p class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img
						class="preview_picture"
						border="0"
						src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
						width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
						height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
						alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
						title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
						style="float:left"
						/></a>
			<?else:?>
				<img
					class="preview_picture"
					border="0"
					src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
					width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
					height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
					alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
					title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
					style="float:left"
					/>
			<?endif;?>
		<?endif?>
		<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
			<span class="news-date-time"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
		<?endif?>
		<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><b><?echo $arItem["NAME"]?></b></a><br />
			<?else:?>
				<b><?echo $arItem["NAME"]?></b><br />
			<?endif;?>
		<?endif;?>
		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			<?echo $arItem["PREVIEW_TEXT"];?>
		<?endif;?>
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<div style="clear:both"></div>
		<?endif?>
		<?foreach($arItem["FIELDS"] as $code=>$value):?>
			<small>
			<?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
			</small><br />
		<?endforeach;?>
		<?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
			<small>
			<?=$arProperty["NAME"]?>:&nbsp;
			<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
				<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
			<?else:?>
				<?=$arProperty["DISPLAY_VALUE"];?>
			<?endif?>
			</small><br />
		<?endforeach;?>
	</p>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div> -->
