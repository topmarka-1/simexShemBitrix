<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
$sectionId = $arResult['ITEMS'][0]['IBLOCK_SECTION_ID'];
$iblockId = $arResult['ID'];
$section = //https://dev.1c-bitrix.ru/api_help/iblock/classes/ciblocksection/getlist.php
	$rdbSection = \CIBlockSection::GetList(
		$dctOrder  = ['SORT' => 'ASC'],
		$dctFilter = [
			'ACTIVE'    => 'Y',
			'IBLOCK_ID' => $iblockId,
			'ID' => $sectionId
		],
		false,
		$lstSelect = ['ID', 'NAME', 'IBLOCK_ID', 'CODE', 'UF_*', 'DESCRIPTION', 'PICTURE'],
		false
	)->fetch();
?>
<section class="section section-gray news-detail">
	<div class="container">
		<div class="news-detail__container">
			<div class="news-detail__head">
				<div class="news-detail__head_text text-content">
					<h1 class="h2"><?= $section['NAME'] ?></h1>
					<?= $section['DESCRIPTION'] ?>
				</div>
				<div class="detail_picture">
					<img src="<?= \CFile::GetPath($section['PICTURE']); ?>" width="888" height="400" alt="<?= $section['NAME'] ?>">
				</div>
			</div>
		</div>
	</div>
</section>
<? if ($section['UF_GALLERY']) : ?>
	<section class="section gallery anim-fade-in-up">
		<div class="container">
			<? if ($section['UF_GALLERY_TITLE']) : ?>
				<div class="heading anim-fade-in-left">
					<h2><?= $section['UF_GALLERY_TITLE']  ?></h2>
				</div>
			<? endif; ?>
			<div class="gallery__content">
				<div class="gallery__slider swiper">
					<div class="swiper-wrapper">
						<? foreach ($section['UF_GALLERY'] as $img) : ?>
							<div class="swiper-slide">
								<div class="gallery__slide_img hover-img" data-fancybox data-src="<?= \CFile::GetPath($img); ?>">
									<img src="<?= \CFile::GetPath($img); ?>" width="888" height="480" alt="photo 1">
								</div>
							</div>
						<? endforeach; ?>
					</div>
				</div>

				<div class="gallery__slider_control">
					<div class="gallery__slider_pagination"></div>
					<div class="gallery__slider_navigation">
						<button class="swiper_prev gallery__slider_control-btn">
							<svg width="10" height="15" viewBox="0 0 10 15" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M8.12134 1.06055L2.12134 7.06055L8.12134 13.0605" stroke="#575A63"
									stroke-width="3" />
							</svg>
						</button>
						<button class="swiper_next gallery__slider_control-btn">
							<svg width="10" height="15" viewBox="0 0 10 15" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M1.06067 1.06055L7.06067 7.06055L1.06067 13.0605" stroke="#575A63"
									stroke-width="3" />
							</svg>
						</button>
					</div>
				</div>
			</div>
		</div>
	</section>
<? endif; ?>
<section class="catalog-element section section-white  section-round-top anim-fade-in-up">
	<div class="container">
		<div class="heading anim-fade-in-left">
			<h2 class="h2"><?= $section['UF_VACANCIES_TITLE'] ?></h2>
		</div>
		<div class="catalog-element__tabs">
			<? foreach ($arResult["ITEMS"] as $arItem): ?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<div class="catalog-element__col_item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
					<div class="catalog-element__analogs accordion">
						<div class="catalog-element__analogs_heading accordion_title">
							<div class="h5"><?= $arItem['NAME'] ?></div>
							<span class="icon btn btn-quad">
								<svg width="14" height="9" viewBox="0 0 14 9" fill="none"
									xmlns="http://www.w3.org/2000/svg">
									<path d="M0.707031 0.707031L6.70703 6.70703L12.707 0.707032"
										stroke="CurrentColor" stroke-width="2" />
								</svg>
							</span>
						</div>
						<div class="accordion_content">
							<div class="accordion_body catalog-element__analogs_list text-content">
								<?= $arItem['PREVIEW_TEXT'] ?>
							</div>
						</div>
					</div>
				</div>


			<? endforeach; ?>
		</div>
	</div>
	</setion>