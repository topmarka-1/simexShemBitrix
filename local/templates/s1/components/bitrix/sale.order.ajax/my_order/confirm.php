<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

if ($arParams["SET_TITLE"] == "Y")
{
	$APPLICATION->SetTitle(Loc::getMessage("SOA_ORDER_COMPLETE"));
}
?>
<? if (!empty($arResult["ORDER"])): ?>

	<div class="personal__item white">
		<h5 class="h5" style="margin-bottom:1.5rem"><?=Loc::getMessage("SOA_ORDER_SUC", array(
			"#ORDER_DATE#" => $arResult["ORDER"]["DATE_INSERT"]->toUserTime()->format('d.m.Y H:i'),
			"#ORDER_ID#" => htmlspecialcharsbx($arResult["ORDER"]["ACCOUNT_NUMBER"])
		))?></h5>

		<? if (!empty($arResult['ORDER']["PAYMENT_ID"])): ?>
			<p><?=Loc::getMessage("SOA_PAYMENT_SUC", array(
				"#PAYMENT_ID#" => htmlspecialcharsbx($arResult['PAYMENT'][$arResult['ORDER']["PAYMENT_ID"]]['ACCOUNT_NUMBER'])
			))?></p>
		<? endif ?>

		<? if ($arParams['NO_PERSONAL'] !== 'Y'): ?>
			<p><a href="<?=$arParams['PATH_TO_PERSONAL']?>" class="btn btn-primary"><?=Loc::getMessage('SOA_ORDER_SUC1', ['#LINK#' => ''])?></a></p>
		<? endif; ?>
	</div>

	<?
	if ($arResult["ORDER"]["IS_ALLOW_PAY"] === 'Y')
	{
		if (!empty($arResult["PAYMENT"]))
		{
			foreach ($arResult["PAYMENT"] as $payment)
			{
				if ($payment["PAID"] != 'Y')
				{
					if (!empty($arResult['PAY_SYSTEM_LIST'])
						&& array_key_exists($payment["PAY_SYSTEM_ID"], $arResult['PAY_SYSTEM_LIST'])
					)
					{
						$arPaySystem = $arResult['PAY_SYSTEM_LIST_BY_PAYMENT_ID'][$payment["ID"]];

						if (empty($arPaySystem["ERROR"]))
						{
							?>
							<div class="personal__item">
								<h5><?=Loc::getMessage("SOA_PAY")?></h5>
								<?=CFile::ShowImage($arPaySystem["LOGOTIP"], 80, 80, 'style="max-height:60px;margin-bottom:1rem"', "", false)?>
								<p class="h6"><?=$arPaySystem["NAME"]?></p>

								<? if ($arPaySystem["ACTION_FILE"] <> '' && $arPaySystem["NEW_WINDOW"] == "Y" && $arPaySystem["IS_CASH"] != "Y"): ?>
									<?
									$orderAccountNumber = urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]));
									$paymentAccountNumber = $payment["ACCOUNT_NUMBER"];
									?>
									<script>
										window.open('<?=$arParams["PATH_TO_PAYMENT"]?>?ORDER_ID=<?=$orderAccountNumber?>&PAYMENT_ID=<?=$paymentAccountNumber?>');
									</script>
									<p><a href="<?=$arParams["PATH_TO_PAYMENT"]?>?ORDER_ID=<?=$orderAccountNumber?>&PAYMENT_ID=<?=$paymentAccountNumber?>" class="btn btn-primary"><?=Loc::getMessage("SOA_PAY_LINK", array("#LINK#" => ""))?></a></p>
									<? if (CSalePdf::isPdfAvailable() && $arPaySystem['IS_AFFORD_PDF']): ?>
										<p><a href="<?=$arParams["PATH_TO_PAYMENT"]?>?ORDER_ID=<?=$orderAccountNumber?>&pdf=1&DOWNLOAD=Y" class="btn btn-grey"><?=Loc::getMessage("SOA_PAY_PDF", array("#LINK#" => ""))?></a></p>
									<? endif ?>
								<? else: ?>
									<?=$arPaySystem["BUFFERED_OUTPUT"]?>
								<? endif ?>
							</div>
							<?
						}
						else
						{
							?>
							<div class="alert alert-danger"><?=Loc::getMessage("SOA_ORDER_PS_ERROR")?></div>
							<?
						}
					}
					else
					{
						?>
						<div class="alert alert-danger"><?=Loc::getMessage("SOA_ORDER_PS_ERROR")?></div>
						<?
					}
				}
			}
		}
	}
	else
	{
		?>
		<div class="alert alert-warning"><?=$arParams['MESS_PAY_SYSTEM_PAYABLE_ERROR']?></div>
		<?
	}
	?>

<? else: ?>
	<div class="personal__item">
		<h5><?=Loc::getMessage("SOA_ERROR_ORDER")?></h5>
		<p><?=Loc::getMessage("SOA_ERROR_ORDER_LOST", ["#ORDER_ID#" => htmlspecialcharsbx($arResult["ACCOUNT_NUMBER"])])?></p>
		<p><?=Loc::getMessage("SOA_ERROR_ORDER_LOST1")?></p>
	</div>
<? endif ?>
