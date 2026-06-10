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
<section class="section contacts anim-fade-in-up">
    <div class="container">

        <div class="heading anim-fade-in-left">
            <h2 class="h2">Контакты</h2>
        </div>
        <div class="contacts__tabs dropdown">
            <button class="contacts__tab contacts__tabs_title current dropdown__value" data-default-title="Все:"  data-city="all">
                <span class="text">Все</span>
                <span class="arrow">
                    <svg width="14" height="9" viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.707031 0.707031L6.70703 6.70703L12.707 0.707032" stroke="#D7D8D9"
                            stroke-width="2" />
                    </svg>
                </span>
            </button>
            <div class="contacts__tabs_list dropdown__list">
                <button class="contacts__tab contacts__tabs_item current dropdown__item" data-city="all"><span class="text">Все</span></button>
                <?foreach($sections as $section):?>
					<button class="contacts__tab contacts__tabs_item dropdown__item" data-city="<?=$section['CODE'] ?>"><span class="text"><?=$section['NAME'] ?></span></button>
				<? endforeach; ?>
            </div>
        </div>

        <div class="contacts__layout">

            <div class="contacts__map-wrap catalog__aside">
                <div class="contacts__map" id="contacts-map"></div>
            </div>

            <div class="contacts__content anim-stagger">

				<?foreach($arResult["ITEMS"] as $arItem):?>
					<?
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>
					<article 
						class="contact-card anim-fade-in-up" 
						data-city="<?=$sections[$arItem['IBLOCK_SECTION_ID']]['CODE'] ?>" 
						id="<?=$this->GetEditAreaId($arItem['ID']);?>"
						data-title="<?=$arItem['PROPERTIES']['TITLE']['VALUE'] ?: $arItem['NAME'] ?>"
						data-coord="<?=$arItem['PROPERTIES']['COORD']['VALUE'] ?>"
						>
						<h5 class="contact-card__title">
							<?=$arItem['PROPERTIES']['TITLE']['VALUE'] ?: $arItem['NAME'] ?>
						</h5>

						<div class="contact-card__row">
							<div class="contact-card__label">Адрес:</div>

							<div class="contact-card__value">
								<?=$arItem['PROPERTIES']['ADDRESS']['VALUE'] ?>
							</div>
						</div>

						<div class="contact-card__row">
							<div class="contact-card__label">Телефон:</div>

							<div class="contact-card__value">
								<? foreach ($arItem['PROPERTIES']['PHONES']['VALUE'] as $phone) : ?>
								<a href="tel:<?=preg_replace('![^0-9]+!', '', $phone) ?>">
									<?=$phone ?>
								</a>
								<? endforeach; ?>
							</div>
						</div>

						<div class="contact-card__row">
							<div class="contact-card__label">Эл. почта:</div>

							<div class="contact-card__value">
								<? foreach ($arItem['PROPERTIES']['EMAIL']['VALUE'] as $email) : ?>
								<a href="mailto:<?=$email ?>">
									<?=$email ?>
								</a>
								<? endforeach; ?>
							</div>
						</div>
						<? if ($arItem['PROPERTIES']['GALLERY']['VALUE']) : ?>
						<div class="contact-card__gallery">
							<div class="contact-card__slider swiper">
								<div class="swiper-wrapper">
									<? foreach ($arItem['PROPERTIES']['GALLERY']['VALUE'] as $img) : ?>
										<? $imgPath = \CFile::GetPath($img); ?>
									<div class="swiper-slide contact-card__slide">
										<a href="<?=$imgPath ?>" data-fancybox>
											<img src="<?=$imgPath ?>" alt="contact-slide">
										</a>
									</div>
									<? endforeach; ?>
								</div>
								<div class="swiper-scrollbar"></div>
							</div>
						</div>
						<? endif; ?>
						<button class="btn btn-black btn-md route-btn">
							Схема проезда
						</button>
					</article>
				<?endforeach;?>

            </div>

        </div>

    </div>
</section>
