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
	<section class="section about <?=$arItem['PROPERTIES']['SECTION_COLOR']['VALUE_XML_ID'] == 'dark' ? ' section-dark section-round-top section-round-bottom' : ''  ?>" id="<?php echo $this->GetEditAreaId($arItem['ID']);?>">
		<div class="container">
			<div class="heading">
				<h2><?=$arItem['PROPERTIES']['TITLE']['VALUE']['TEXT'] ?></h2>
				<? if ($arItem['PROPERTIES']['SUBTITLE']['VALUE']) : ?>
					<p class="subtitle"><?=$arItem['PROPERTIES']['SUBTITLE']['VALUE']['TEXT'] ?></p>
				<? endif; ?>
			</div>
			<div class="about__content">
				<? if ($arItem['PROPERTIES']['NUMS']['VALUE']) : ?>
				<div class="about__content_nums">
					<? 
						$minNumsCount = 3;
						$numsCount = count($arItem['PROPERTIES']['NUMS']['VALUE']);
						$numsTexts = $arItem['PROPERTIES']['NUMS_TEXT']['VALUE'];
					?>
					<? for ($i = 0; $i < $minNumsCount - $numsCount; $i++) : ?>
						<div class="about__content_num"></div>
					<? endfor; ?>
					<? foreach ($arItem['PROPERTIES']['NUMS']['VALUE'] as $key => $num) : ?>
						<div class="about__content_num">
							<div class="num"><?=$num ?></div>
							<div class="text"><?=$numsTexts[$key] ?></div>
						</div>
					<? endforeach; ?>
				</div>
				<? endif; ?>
				<? if ($arItem['PROPERTIES']['ADVS_TITLE']['VALUE']) : ?>
					<? 
						$advsTexts = $arItem['PROPERTIES']['ADVS_TEXT']['VALUE'];
						$advsImages = $arItem['PROPERTIES']['ADVS_IMG']['VALUE'];
					?>
					<div class="about__advs">
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
			</div>
		</div>
	</section>
<?endforeach;?>

