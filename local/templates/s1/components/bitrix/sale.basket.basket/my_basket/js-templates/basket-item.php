<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $mobileColumns
 * @var array $arParams
 * @var string $templateFolder
 */

$usePriceInAdditionalColumn = in_array('PRICE', $arParams['COLUMNS_LIST']) && $arParams['PRICE_DISPLAY_MODE'] === 'Y';
$useSumColumn = in_array('SUM', $arParams['COLUMNS_LIST']);
$useActionColumn = in_array('DELETE', $arParams['COLUMNS_LIST']);

$restoreColSpan = 2 + $usePriceInAdditionalColumn + $useSumColumn + $useActionColumn;
?>
<script id="basket-item-template" type="text/html">
	<article class="catalog-cart__item card"
		id="basket-item-{{ID}}" data-entity="basket-item" data-id="{{ID}}">
		{{#SHOW_RESTORE}}
			<div class="basket-items-list-item-notification" style="width:100%;padding:16px;">
				<div class="basket-items-list-item-notification-inner basket-items-list-item-notification-removed">
					{{#SHOW_LOADING}}
						<div class="basket-items-list-item-overlay"></div>
					{{/SHOW_LOADING}}
					<div class="basket-items-list-item-removed-container">
						<div>
							<?= Loc::getMessage('SBB_BASKET_ITEM_DELETED_MSGVER_1', ['#NAME#' => '<strong>{{NAME}}</strong>']) ?>
						</div>
						<div class="basket-items-list-item-removed-block">
							<a href="javascript:void(0)" data-entity="basket-item-restore-button">
								<?= Loc::getMessage('SBB_BASKET_ITEM_RESTORE') ?>
							</a>
							<span class="basket-items-list-item-clear-btn" data-entity="basket-item-close-restore-button"></span>
						</div>
					</div>
				</div>
			</div>
		{{/SHOW_RESTORE}}
		{{^SHOW_RESTORE}}
			{{#DETAIL_PAGE_URL}}
				<a href="{{DETAIL_PAGE_URL}}" class="catalog-cart__item_image">
			{{/DETAIL_PAGE_URL}}
			{{^DETAIL_PAGE_URL}}
				<span class="catalog-cart__item_image">
			{{/DETAIL_PAGE_URL}}
			<img src="{{{IMAGE_URL}}}{{^IMAGE_URL}}<?= $templateFolder ?>/images/no_photo.png{{/IMAGE_URL}}"
				alt="{{NAME}}" width="71" height="108">
			{{#DETAIL_PAGE_URL}}
				</a>
			{{/DETAIL_PAGE_URL}}
			{{^DETAIL_PAGE_URL}}
				</span>
			{{/DETAIL_PAGE_URL}}
			<div class="catalog-cart__item_content">
				<div class="catalog-cart__item_col">
					<a href="{{DETAIL_PAGE_URL}}" class="catalog-cart__item_title">
						<h5 data-entity="basket-item-name">{{NAME}}</h5>
					</a>
					{{#PROPS}}
						<div class="article" data-entity="basket-item-property-value" data-property-code="{{CODE}}">
							{{{VALUE}}}
						</div>
					{{/PROPS}}
				</div>
				<div class="catalog-cart__item_col">
					<div class="catalog-cart__item_char">
						<div class="char__list">
							{{#SKU_BLOCK_LIST}}
								{{^IS_IMAGE}}
									{{#SKU_VALUES_LIST}}
										{{#SELECTED}}
											<div class="char__item">
												<span class="char__item_name">{{NAME}}</span>
												<div class="char__item_value">{{SKU_VALUE_NAME}}</div>
											</div>
										{{/SELECTED}}
									{{/SKU_VALUES_LIST}}
								{{/IS_IMAGE}}
							{{/SKU_BLOCK_LIST}}
							{{#COLUMN_LIST}}
								{{#IS_TEXT}}
									<div class="char__item">
										<span class="char__item_name">{{NAME}}</span>
										<div class="char__item_value">{{VALUE}}</div>
									</div>
								{{/IS_TEXT}}
							{{/COLUMN_LIST}}
						</div>
					</div>
				</div>
				<div class="catalog-cart__item_col">
					{{#SHOW_PRICE}}
						<div class="char__item">
							<span class="char__item_name"><?= Loc::getMessage('SBB_BASKET_ITEM_PRICE_FOR_MSGVER_1', ['#MEASURE_RATIO#' => '{{MEASURE_RATIO}}', '#MEASURE_TEXT#' => '{{MEASURE_TEXT}}']) ?></span>
							<div class="char__item_value">
								{{#SHOW_DISCOUNT_PRICE}}
									<s>{{{FULL_PRICE_FORMATED}}}</s>
								{{/SHOW_DISCOUNT_PRICE}}
								<span id="basket-item-price-{{ID}}">{{{PRICE_FORMATED}}}</span>
							</div>
						</div>
					{{/SHOW_PRICE}}
					{{^SHOW_PRICE}}
						<div class="char__item">
							<span class="char__item_name"><?= Loc::getMessage('SBB_BASKET_ITEM_PRICE_FOR_MSGVER_1', ['#MEASURE_RATIO#' => '{{MEASURE_RATIO}}', '#MEASURE_TEXT#' => '{{MEASURE_TEXT}}']) ?></span>
							<div class="char__item_value"><?= Loc::getMessage('SBB_PRICE_ON_REQUEST') ?></div>
						</div>
					{{/SHOW_PRICE}}
					<div class="catalog-cart__item_bottom">
						<div class="counter" data-entity="basket-item-quantity-block">
							<a href="javascript:void(0)" class="btn btn-quad grey dec" data-entity="basket-item-quantity-minus">
								<svg width="12" height="3" viewBox="0 0 12 3" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M0 3V0H12V3H0Z" fill="black" />
								</svg>
							</a>
							<input type="text" name="count"
								class="btn btn-quad counter_value"
								value="{{QUANTITY}}"
								data-entity="basket-item-quantity-field"
								data-value="{{QUANTITY}}"
								id="basket-item-quantity-{{ID}}"
								{{#NOT_AVAILABLE}}disabled="disabled" {{/NOT_AVAILABLE}}>
							<a href="javascript:void(0)" class="btn btn-quad grey inc" data-entity="basket-item-quantity-plus">
								<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M5.03736 12V6.96264H0V5.02418H5.03736V0H6.97582V5.02418H12V6.96264H6.97582V12H5.03736Z" fill="black" />
								</svg>
							</a>
						</div>
						<button class="btn btn-quad light delete_btn" data-entity="basket-item-delete">
							<svg width="14" height="14" viewBox="0 0 14 14" fill="none"
								xmlns="http://www.w3.org/2000/svg"
								xmlns:xlink="http://www.w3.org/1999/xlink">
								<mask id="mask0_260_165" style="mask-type:alpha" maskUnits="userSpaceOnUse"
									x="0" y="0" width="14" height="14">
									<path d="M0 0H14V14H0V0Z" fill="url(#pattern0_260_165)" />
								</mask>
								<g mask="url(#mask0_260_165)">
									<path d="M0 0H14V14H0V0Z" fill="#232C42" />
								</g>
								<defs>
									<pattern id="pattern0_260_165" patternContentUnits="objectBoundingBox"
										width="1" height="1">
										<use xlink:href="#image0_260_165" transform="scale(0.0208333)" />
									</pattern>
									<image id="image0_260_165" width="48" height="48"
										preserveAspectRatio="none"
										xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAFB0lEQVR4AbyaT6hPQRTHb/4sFMWColgQdoRiYUspLMhGsiGEElHIAlkSUcTCAkvCSolC2CFZEhtFsaAoCxa+n9975/fOm3vvzNx73+/pfH8zc2bmnPOdOTP3da8JRbd/kzV9jrBGOCu8zcALjbkpnBJmC52kK4GZ8r5LuCocEZZmYLXGbBd2C3uETiS6EJgi5ysFglmg8q/wXfiUwFf1IwS+Q5VNQmvpQoAANsszwf9R+Ua4IpxO4LL6PwjIdP2wayraSRcCk+RyqoCwqgRPXpPfMVzShHMCMk0/iwVKFc0lJGCHcoVMpbBKY5YICOm0SJXUHPoZN1FjTThH69SgLwZ8sesaOiKeAMFj/JC6r2fgpMaQPioKDB9QJWceYw5rrMlcVU4I6GNgh/dr3EKhL54A6cBK5N4mFrwZIw3I5xz4ubnzuL24ubaZQ0pP4J8U3wS7RchrNXuSe8PY3K7lZ3n9JSDm+70aL4ehYkg8ASY8ltpukVuqm3A9cjCtb9Al6cIi4P+nfu4JxwWy45HKvngCKFl1AgUPpICUigI9hNCPB3yQxMDK31UgH4VREhLwnb/VsFXggJOrUo2L+Cua1CaWSscxAn4CB3y+Vwy4zmLZQWcHSitv/nMJ2HhfsiszpMCZipLQP0tarlgVlcKYuvmVE0JlWwI8uJbLGH/LbFBZFQR/pe5VX+nulg4xG1vVwJaK5hIjwPVlucdKkUbmgYfPUTX4k+CYSu5+FX1h/DK1+NNin0r+6lQxSkjJM9JcE84LVYsgddH6DBC8HWKCxyEGAc6sHfbRj85ymHYVSK21wx2MN3uQpz3cVQzsDJiDsS4JPkW+7zOWQmwd7PuDXSWWXm5YdhVf7Hj2BBsYI0DwlkI23kqcWR8rZttv/amyUZrEjMUI+Hk8WMh7r+tSh3Rdmnhyfqcr/eUSmFYUhV9ltpwdqjTaUenJsdO1DzH85BJgrAfBWwp5fZt6cpVjRmMEcle5TXr5NImtMjHQX8shRiBcZZxWnQN0Pr1qnbkOnyZOXaqGMZQGxAiEg3HaNNDQRk6bHcVXztiiCQFvkK1ldbyubR1bPk0a7WiKAAesKlB0/hDXpVcOqdBWzpz+mBQBVsYCjQXJljdJr9w0CXenH7hVUgRsHGXTIJlTh1iaeHLszkCeAwRWl170dQHk6p7SJbtNdiCcnJte4bywnUyTcIJvpwiwygTKHM4AaUQ9BPq2ZyCWJklyKQIEb4e4aZAhSd+uS5NwkWLkevZSBHqDxvGHRcrOf+LqQiA3vfATQzJNYpNTBDDONlbZaJtejdOkyrnpUgQI3s4A9zO5a3PblrE08eT8Dtf6ShHwEwne3zR+d6izIzaeNuRpUw/7fqiDfj5N8d5VzZ54csyJPsSY0YQA4z0I4okUzwRevgJVe0Jwr1Sr63uuvtvCQ4GXxiraSYoAq0cwVdbR31HHRqH02ls6PvrV9fGR76DGVM2Tuif4Zhd6jbqfFAGCtDOADXKUVKJuYEzdVrftwzZzvW90JaQIhBPIUX8Owv6hdvtfLgp8ZFvIIcBtwGpglBeyvBKkPtZgd+fJKF8jVeRJDgEO67thc7zU3ak6/zdirLFedrcI9iQObyh1lSWHAN/Hnmoqu0D+44RPQGMNvoPZW2yC5xLAh1zXSw4B7ukbMnFfoK5iYEK6fpH17Os1h4DsFVx7fA+4qAZ3+2uVgwC2L8h27HpV94j8BwAA//9U3Cn/AAAABklEQVQDABAvdpq81ZkGAAAAAElFTkSuQmCC" />
								</defs>
							</svg>
						</button>
					</div>
				</div>
			</div>
			{{#SHOW_LOADING}}
				<div class="basket-items-list-item-overlay"></div>
			{{/SHOW_LOADING}}
		{{/SHOW_RESTORE}}
	</article>
</script>