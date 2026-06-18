<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? CModule::IncludeModule("iblock") ?>
<? if (!empty($arResult)): ?>
	<?
	$menuTree = [];
	$currentParent = null;

	foreach ($arResult as $item) {

		if ($item['DEPTH_LEVEL'] == 1) {

			$currentParent = $item['LINK'];

			$menuTree[$currentParent] = [
				'ITEM' => $item,
				'CHILDREN' => []
			];
		} elseif ($item['DEPTH_LEVEL'] == 2 && $currentParent) {

			$menuTree[$currentParent]['CHILDREN'][] = $item;
		}
	}
	?>
	<div class="header__menu">
		<nav class="header__nav">
			<ul class="header__nav_list">

				<?
				foreach ($menuTree as $arItem):
					if ($arParams["MAX_LEVEL"] == 1 && $arItem['ITEM']["DEPTH_LEVEL"] > 1)
						continue;
					if ($arItem['ITEM']['PARAMS']['IBLOCK_ID']) {
						$sections = [];
						$arSections = CIBlockSection::GetList([], ['IBLOCK_ID' => $arItem['ITEM']['PARAMS']['IBLOCK_ID'], 'DEPTH_LEVEL' => 1]);
						while ($res = $arSections->Fetch()) {
							$sections[] = $res;
						}
					}
					if ($arItem['ITEM']['PARAMS']['IBLOCK_SECTION']) {
						$sections = [];
						$arSections = CIBlockElement::GetList([], ['IBLOCK_ID' => $arItem['ITEM']['PARAMS']['IBLOCK_SECTION'], 'ACTIVE' => 'Y']);
						while ($res = $arSections->Fetch()) {
							$sections[] = $res;
						}
					}
				?>


					<li class="header__nav_item <? if ($arItem['ITEM']["SELECTED"]): ?>current<? endif ?>">
						<a href="<?= $arItem['ITEM']["LINK"] ?>" class="link btn btn-sm header__nav_link">
							<?= $arItem['ITEM']["TEXT"] ?>
							<? if (!empty($sections) || !empty($arItem['CHILDREN'])) : ?>
								<span class="icon">
									<svg width="9" height="6" viewBox="0 0 9 6" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<path d="M8.35352 0.353554L4.35352 4.35355L0.353515 0.353553"
											stroke="CurrentColor"></path>
									</svg>
								</span>
							<? endif; ?>
						</a>
						<? if (!empty($sections)) : ?>
							<div class="sublist">
								<ul>
									<? foreach ($sections as $section) : ?>
										<li class="subitem"> <a href="<?= $arItem['ITEM']["LINK"] . $section['CODE'] . '/' ?>" class="link"><?= $section['NAME'] ?></a> </li>
									<? endforeach; ?>
								</ul>
							</div>
						<? endif; ?>
						<? if (!empty($arItem['CHILDREN'])) : ?>
							<div class="sublist">
								<ul>
									<? foreach ($arItem['CHILDREN'] as $section) : ?>
										<li class="subitem"> <a href="<?= $section['LINK'] ?>" class="link"><?= $section['TEXT'] ?></a> </li>
									<? endforeach; ?>
								</ul>
							</div>
						<? endif; ?>
					</li>
					<? unset($sections); ?>
				<? endforeach ?>

			</ul>
		</nav>
	</div>

<? endif ?>