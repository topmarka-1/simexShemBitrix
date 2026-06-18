<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
?>
<section class="section section-gray catalog-cart " id="catalog-cart">
	<div class="container">
		<div class="heading">
			<h1 class="h2"><? $APPLICATION->ShowTitle() ?></h1>
		</div>
		<div class="personal__content">
			<aside class="personal__aside">
				<nav class="personal__aside_nav anim-stagger" data-ajax-nav>
					<ul>
						<?php foreach ($navLinks as $key => $link): ?>
							<?php $isActive = ($currentPage === $key); ?>
							<li>
								<a class="btn btn-quad-md grey<?= $isActive ? ' active' : '' ?>"
									href="<?= htmlspecialcharsbx($link['url']) ?>"
									data-nav-key="<?= $key ?>"
									data-ajax="<?= $link['ajax'] ? 'true' : 'false' ?>">
									<?= $link['icon'] ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</nav>
			</aside>
			<div class="personal__sections" data-ajax-content>
				<div class="catalog-cart__empty">
					<div class="catalog-cart__empty_icon">
						<svg xmlns="http://www.w3.org/2000/svg" width="129.188" height="114.562" viewBox="0 0 129.188 114.562">
							<path fill-rule="evenodd" opacity="0.3" d="M710.628,516.914a12.689,12.689,0,0,0,0,25.378A12.689,12.689,0,1,0,710.628,516.914Zm67.374,0a12.689,12.689,0,1,0,0,25.378A12.689,12.689,0,0,0,778,516.914Zm19.942-70.42a5.206,5.206,0,0,0-4.068-1.949H698.271L693.3,431.107a5.206,5.206,0,0,0-4.88-3.4H675.11a5.206,5.206,0,0,0,0,10.411h9.683L709.557,505a5.2,5.2,0,0,0,4.88,3.389c0.207,0,.417-0.013.624-0.027l69.421-8.331a5.218,5.218,0,0,0,4.473-4.046l10.019-45.108A5.215,5.215,0,0,0,797.944,446.494Zm-14.018,24.079h-20.8V454.956H787.4Zm-46.826,0V454.956h20.825v15.617H737.1Zm20.825,5.205v16.953L737.1,495.225V475.771h20.825v0.007Zm-26.031-20.822v15.617H707.906l-5.781-15.617h29.769Zm-22.059,20.822h22.059v20.084l-14,1.681Zm53.3,16.329V475.778h19.643l-3.186,14.35Z" transform="translate(-669.906 -427.719)" />
						</svg>
					</div>
					<div class="catalog-cart__empty_text"><?= Loc::getMessage("SBB_EMPTY_BASKET_TITLE") ?></div>
					<?
					if (!empty($arParams['EMPTY_BASKET_HINT_PATH'])) {
					?>
						<a href="<?= $arParams['EMPTY_BASKET_HINT_PATH'] ?>" class="btn btn-primary">
							<?= Loc::getMessage('SBB_EMPTY_BASKET_HINT_BTN') ?: 'Продолжить покупки' ?>
						</a>
					<?
					}
					?>
				</div>
			</div>
		</div>
</section>