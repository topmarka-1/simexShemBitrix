<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 */
?>
<script id="basket-total-template" type="text/html">
	<div data-entity="basket-checkout-aligner">
		<?
		if ($arParams['HIDE_COUPON'] !== 'Y') {
		?>
			<div class="search_label" style="margin-top:16px;">
				<input type="text" class="" placeholder="<?= Loc::getMessage('SBB_COUPON_ENTER_MSGVER_1') ?>" data-entity="basket-coupon-input">
				<span class="icon btn btn-primary btn-sm" data-entity="basket-coupon-input"><?= Loc::getMessage('SBB_COUPON') ?></span>
			</div>
		<?
		}
		?>
		<div class="catalog-cart__bottom">
			<?
			if ($arParams['HIDE_COUPON'] !== 'Y') {
			?>
				<div class="catalog-cart__bottom_links">
					{{#COUPON_LIST}}
						<div class="basket-coupon-alert text-{{CLASS}}">
							<span class="basket-coupon-text">
								<strong>{{COUPON}}</strong> - <?= Loc::getMessage('SBB_COUPON') ?> {{JS_CHECK_CODE}}
								{{#DISCOUNT_NAME}}({{DISCOUNT_NAME}}){{/DISCOUNT_NAME}}
							</span>
							<span class="close-link" data-entity="basket-coupon-delete" data-coupon="{{COUPON}}">
								<?= Loc::getMessage('SBB_DELETE') ?>
							</span>
						</div>
					{{/COUPON_LIST}}
				</div>
			<?
			}
			?>
			{{#SHOW_PRICE}}
				<div class="catalog-cart__total">
					<span class="text"><?= Loc::getMessage('SBB_TOTAL_MSGVER_1') ?></span>
					<span class="value" data-entity="basket-total-price">{{{PRICE_FORMATED}}}</span>
				</div>
			{{/SHOW_PRICE}}
			<div class="catalog-cart__bottom_links">
				<button class="btn btn-blue js-clear-cart">Очистить корзину</button>
				<button class="btn btn-primary" data-entity="basket-checkout-button" {{#DISABLE_CHECKOUT}} disabled{{/DISABLE_CHECKOUT}}>
					<?= Loc::getMessage('SBB_ORDER') ?>
				</button>
			</div>
		</div>
	</div>
</script>