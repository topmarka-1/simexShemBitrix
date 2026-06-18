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
?>
<section class="section fs-about">
	<div class="container">
		<div class="fs-about__row">
			<div class="fs-about__content">
				<div class="fs-about__text text-content">
					<h1 class="h2"><?= $arResult['PROPERTIES']['TITLE']['VALUE'] ?: $arResult['NAME'] ?></h1>
					<?= $arResult['PREVIEW_TEXT'] ?>
				</div>
			</div>
			<div class="fs-about__image">
				<img src="<?= $arResult["PREVIEW_PICTURE"]["SRC"] ?>"
					width="<?= $arResult["PREVIEW_PICTURE"]["WIDTH"] ?>"
					height="<?= $arResult["PREVIEW_PICTURE"]["HEIGHT"] ?>"
					alt="<?= $arResult["PREVIEW_PICTURE"]["ALT"] ?>"
					title="<?= $arResult["PREVIEW_PICTURE"]["TITLE"] ?>">
			</div>
		</div>
		<div class="news-detail__content text-content">
			<?= $arResult['PROPERTIES']['SEO_DETAIL_TEXT']['~VALUE']['TEXT'] ?>
		</div>
	</div>
</section>
<div class="section section-gray tasks anim-fade-in-up">
	<div class="container">
		<div class="tasks__row">
			<div class="tasks__list ">
				<div class="text-content anim-fade-in-left">
					<?= $arResult['PROPERTIES']['DELIVERY_RULES']['~VALUE']['TEXT'] ?>

				</div>

			</div>
		</div>
		<div class="sheme-table anim-fade-in-up">


			<div class="sheme-table__container">
				<div class="heading anim-fade-in-left">
					<h2 class="h2"><?= $arResult['PROPERTIES']['DELIVERY_TABLE_TITLE']['VALUE'] ?></h2>
				</div>
				<div class="sheme-table__scroll">
					<?= $arResult['PROPERTIES']['DELIVERY_RULES_TABLE']['~VALUE']['TEXT'] ?>
					<!-- <table class="sheme-table__table">
						<thead>
							<tr>
								<th class="sheme-table__th sheme-table__th--corner">Условия поставки</th>
								<th class="sheme-table__th">Затарка груза</th>
								<th class="sheme-table__th">Таможенное оформление</th>
								<th class="sheme-table__th">Доставка до пункта погрузки</th>
								<th class="sheme-table__th">Погрузка на судно</th>
								<th class="sheme-table__th">Морская перевозка</th>
								<th class="sheme-table__th">Выгрузка с судна</th>
								<th class="sheme-table__th">Доставка до места назначения</th>
								<th class="sheme-table__th">Страхование</th>
								<th class="sheme-table__th">Растаможка</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="sheme-table__td sheme-table__td--label"><strong>EXW</strong></td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
							</tr>
							<tr>
								<td class="sheme-table__td sheme-table__td--label"><strong>FCA</strong></td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
							</tr>
							<tr>
								<td class="sheme-table__td sheme-table__td--label"><strong>FAS</strong></td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
							</tr>
							<tr>
								<td class="sheme-table__td sheme-table__td--label"><strong>FOB</strong></td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
							</tr>
							<tr>
								<td class="sheme-table__td sheme-table__td--label"><strong>CFR</strong></td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
							</tr>
							<tr>
								<td class="sheme-table__td sheme-table__td--label"><strong>CIF</strong></td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
							</tr>
							<tr>
								<td class="sheme-table__td sheme-table__td--label"><strong>CPT</strong></td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
							</tr>
							<tr>
								<td class="sheme-table__td sheme-table__td--label"><strong>CIP</strong></td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
							</tr>
							<tr>
								<td class="sheme-table__td sheme-table__td--label"><strong>DPU</strong></td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
							</tr>
							<tr>
								<td class="sheme-table__td sheme-table__td--label"><strong>DAP</strong></td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
							</tr>
							<tr>
								<td class="sheme-table__td sheme-table__td--label"><strong>DDP</strong></td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
								<td class="sheme-table__td sheme-table__td--buyer">Покупатель</td>
								<td class="sheme-table__td sheme-table__td--seller">Продавец</td>
							</tr>
						</tbody>
					</table>
				</div> -->

				</div>
			</div>
			<div class="tasks__row">
				<div class="tasks__list ">
					<div class="text-content anim-fade-in-left">
						<?= $arResult['PROPERTIES']['DELIVERY_RULES_TEXT']['~VALUE']['TEXT'] ?>

					</div>

				</div>
			</div>
		</div>
	</div>