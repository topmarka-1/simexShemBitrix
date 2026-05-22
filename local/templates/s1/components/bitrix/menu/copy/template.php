<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

                                  
<?if (!empty($arResult)):?>
	<div class="footer__copy_nav_list"> 
	<?
	foreach($arResult as $arItem):
		if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
			continue;
	?>
		<?if($arItem["SELECTED"]):?>
			<a href="<?=$arItem["LINK"]?>" class="link selected"><?=$arItem["TEXT"]?></a>
		<?else:?>
			<a href="<?=$arItem["LINK"]?>" class="link"><?=$arItem["TEXT"]?></a>
		<?endif?>
		
	<?endforeach?>
</div>
<?endif?>