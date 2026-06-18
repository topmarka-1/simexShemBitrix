<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
?>
<div class="personal__item">
	<h5><?=Loc::getMessage("EMPTY_BASKET_TITLE")?></h5>
	<? if (!empty($arParams['EMPTY_BASKET_HINT_PATH'])): ?>
		<p><?=Loc::getMessage('EMPTY_BASKET_HINT', [
			'#A1#' => '<a href="'.$arParams['EMPTY_BASKET_HINT_PATH'].'" class="btn btn-primary" style="margin-top:1rem">',
			'#A2#' => '</a>',
		])?></p>
	<? endif ?>
</div>
