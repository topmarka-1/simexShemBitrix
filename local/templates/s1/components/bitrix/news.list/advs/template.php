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



<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
				<? if ($arItem['PROPERTIES']['ADVS_TITLE']['VALUE']) : ?>
					<? 
						$advsTexts = $arItem['PROPERTIES']['ADVS_TEXT']['VALUE'];
						$advsImages = $arItem['PROPERTIES']['ADVS_IMG']['VALUE'];
					?>
					<div class="about__advs">
						<div class="heading">
							<h2>Компания «Симэкс-Хим» специализируется
								на контрактном производстве высококачественных масел</h2>
						</div>
						<div class="about__advs_list">
							<? foreach ($arItem['PROPERTIES']['ADVS_TITLE']['VALUE'] as $k => $advs) : ?>
								<div class="about__advs_item">
									<div class="about__advs_item_img">
										<img src="<?=\CFile::ResizeImageGet($advsImages[$k], array('width'=>568, 'height'=>380))['src']; ?>" width="568" height="380" alt="advs <?=$k + 1?>">
									</div>
									<div class="about__advs_item_title">
										<h3><?=$advs ?></h3>
									</div>
									<div class="about__advs_item_text">
										<p><?=$advsTexts[$k] ?></p>
									</div>
								</div>
							<? endforeach; ?>
						</div>
					</div>
				<? endif; ?>
<?endforeach;?>

