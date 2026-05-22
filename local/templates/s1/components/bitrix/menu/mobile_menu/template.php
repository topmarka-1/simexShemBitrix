<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?CModule::IncludeModule("iblock")?>
<?if (!empty($arResult)):?>
		
	<div class="mm__menu">
		<nav class="mm__nav">
			<ul class="mm__nav_list">

				<?
				foreach($arResult as $arItem):
					if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
						continue;
					if ($arItem['PARAMS']['IBLOCK_ID']) {
						$sections = [];
						$arSections = CIBlockSection::GetList([], ['IBLOCK_ID' => $arItem['PARAMS']['IBLOCK_ID'], 'DEPTH_LEVEL' => 1]);
						while ($res = $arSections->Fetch()) {
							$sections[] = $res;
						}
					
					}
				?>
					<?if($arItem["SELECTED"]):?>
						<li class="mm__nav_item current<? if (!empty($sections)) : ?> accordion<? endif; ?>">
							<? if (!empty($sections)) : ?><span class="accordion_title"><? endif; ?>
							<a href="<?=$arItem["LINK"]?>"class="link mm__nav_link">
								<?=$arItem["TEXT"]?>
							</a>
								<? if (!empty($sections)) : ?>
									<span class="icon"> 
										<svg width="9" height="6" viewBox="0 0 9 6" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<path d="M8.35352 0.353554L4.35352 4.35355L0.353515 0.353553"
												stroke="CurrentColor"></path>
										</svg> 
									</span>
								<? endif; ?>
							<? if (!empty($sections)) : ?></span><? endif; ?>
							<? if (!empty($sections)) : ?>
								<div class="sublist accordion_content">
                            		<ul class="accordion_body">
										<? foreach ($sections as $section) : ?>
											<li class="subitem"> <a href="<?=$arItem["LINK"] . $section['CODE'] . '/' ?>" class="link"><?=$section['NAME'] ?></a> </li>
										<? endforeach; ?>
									</ul>
								</div>
							<? endif; ?>
						</li>
					<?else:?>
						<li class="mm__nav_item">
							<a href="<?=$arItem["LINK"]?>"class="link btn btn-sm mm__nav_link">
								<?=$arItem["TEXT"]?>
								<? if (!empty($sections)) : ?>
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
											<li class="subitem"> <a href="<?=$arItem["LINK"] . $section['CODE'] . '/' ?>" class="link"><?=$section['NAME'] ?></a> </li>
										<? endforeach; ?>
									</ul>
								</div>
							<? endif; ?>
						</li>
					<?endif?>
					<? unset($sections);?>
				<?endforeach?>

			</ul>
		</nav>
	</div>

<?endif?>