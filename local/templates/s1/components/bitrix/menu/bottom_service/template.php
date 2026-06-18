<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)): ?>


	<?
	foreach ($arResult as $arItem):
		if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
			continue;
		if ($arItem['PARAMS']['IBLOCK_ID']) {
			$sections = [];
			$arSections = CIBlockSection::GetList([], ['IBLOCK_ID' => $arItem['PARAMS']['IBLOCK_ID'], 'DEPTH_LEVEL' => 1]);
			while ($res = $arSections->Fetch()) {
				$sections[] = $res;
			}
		}
	?>

		<div class="footer__nav_title footer__nav_item">
			<? if ($arItem['LINK']) : ?>
				<a href="/catalog"><?= $arItem["TEXT"] ?></a>
			<? else : ?>
				<span><?= $arItem["TEXT"] ?></span>
			<? endif; ?>
		</div>
		<? if (!empty($sections)) : ?>
			<ul class="footer__nav_catalog">
				<? foreach ($sections as $section) : ?>
					<li class="footer__nav_item"> <a href="<?= $arItem["LINK"] . $section['CODE'] . '/' ?>"><?= $section['NAME'] ?></a> </li>
				<? endforeach; ?>
			</ul>
		<? endif; ?>


	<? endforeach ?>


<? endif ?>