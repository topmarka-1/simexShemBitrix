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
<?
$sections = [];
$rdbSection = \CIBlockSection::GetList(
	$dctOrder  = ['SORT' => 'ASC'],
	$dctFilter = [
		'ACTIVE'    => 'Y',
		'IBLOCK_ID' => $arParams['IBLOCK_ID']
	],
	false,
	$lstSelect = ['ID', 'NAME', 'IBLOCK_ID', 'CODE', 'UF_*'],
	false
);
while($dctSection = $rdbSection->fetch()) {
	$sections[$dctSection['ID']] = $dctSection;
}

?>
<div itemscope itemtype="https://schema.org/Organization" style="display: none;">
	<?$rsSite = CSite::GetByID(SITE_ID);
	$arSite = $rsSite->Fetch(); // Название текущего сайта
	?>
    <meta itemprop="name" content="<?= $arSite['NAME'] ?: 'Симэкс-Хим' ?>">
			<?foreach($arResult["ITEMS"] as $arItem):?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<div itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
					<meta itemprop="streetAddress" content="<?=$arItem['PROPERTIES']['ADDRESS']['VALUE'] ?>">
        			<meta itemprop="addressLocality" content="<?=$sections[$arItem['IBLOCK_SECTION_ID']]['NAME'] ?>">
				</div>
				<div itemprop="contactPoint" itemscope itemtype="https://schema.org/ContactPoint">
					<? foreach ($arItem['PROPERTIES']['PHONES']['VALUE'] as $phone) : ?>
						<meta itemprop="telephone" content="<?=$phone ?>">
					<? endforeach; ?>
					<? foreach ($arItem['PROPERTIES']['EMAIL']['VALUE'] as $email) : ?>
						<meta itemprop="email" content="<?=$email ?>">
					<? endforeach; ?>
				</div>
			<?endforeach;?>
</div>
