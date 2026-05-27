<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>
<? if ($arResult["FORM_NOTE"]) : ?>
	<div class="form__success">
		<div class="form__success_icon">
			<svg width="72" height="72" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
				<rect width="72" height="72" rx="36" fill="#58875A"/>
				<path d="M29 36.2353L33.8462 41L43 32" stroke="white" stroke-width="3"/>
			</svg>
		</div>
		<div class="form__success_content text-content">
			<div class="form__success_title">
				<div class="h3">Спасибо!<br>Ваша заявка принята!<?//=$arResult["FORM_NOTE"]?></div>
			</div>

		</div>
		
	</div>

<? endif; ?>
<?if ($arResult["isFormNote"] != "Y")
{
?>
<?=$arResult["FORM_HEADER"]?>

<?
if ($arResult["isFormDescription"] == "Y" || $arResult["isFormTitle"] == "Y" || $arResult["isFormImage"] == "Y")
{
?>
	<?
/***********************************************************************************
					form header
***********************************************************************************/
if ($arResult["isFormTitle"])
{
?>
	<div class="heading">
		<div class="h2"><?=$arResult["FORM_TITLE"]?></div>
	</div>
<?
} //endif ;

	
} // endif
	?>
<?
// printR($arResult);
/***********************************************************************************
						form questions
***********************************************************************************/
?>
<div class="login-form">
	
	<div class="form__content">
		<div class="login-form__fields form__fields">
	<?
	foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
	{
	?>
		<? if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden') : ?>
			<? switch ($arQuestion['CAPTION']) {
				case 'ip':
					?>
					<input type="hidden" name="form_hidden_<?=$arQuestion['STRUCTURE'][0]['ID'] ?>" value="<?=$_SERVER['REMOTE_ADDR'] ?>">
					<?
					break;
				case 'user_agent':
					?>
					<input type="hidden" name="form_hidden_<?=$arQuestion['STRUCTURE'][0]['ID'] ?>" value="<?=$_SERVER['HTTP_USER_AGENT'] ?>">
					<?
					break;
				case 'page':
					?>
					<input type="hidden" name="form_hidden_<?=$arQuestion['STRUCTURE'][0]['ID'] ?>" value="<?=$APPLICATION->GetCurPage() ?>">
					<?
					break;
				default:
					echo $arQuestion['HTML_CODE'];
					break;
			} ?>
		<? elseif ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'checkbox') : ?>

		<? else : ?>
			<div class="form__field">
				<div class="form__field_title h6">
					<?=$arQuestion["CAPTION"]?>
				</div>
				<label class="label-text">
					<?=$arQuestion["HTML_CODE"]?>
					<!-- <input type="text" name="login" placeholder="login"> -->
				</label>
			</div>

		<? endif; ?>
	<?
	} //endwhile
	?>
<?
if($arResult["isUseCaptcha"] == "Y")
{
?>
		<tr>
			<th colspan="2"><b><?=GetMessage("FORM_CAPTCHA_TABLE_TITLE")?></b></th>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" /></td>
		</tr>
		<tr>
			<td><?=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?><?=$arResult["REQUIRED_SIGN"];?></td>
			<td><input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" /></td>
		</tr>
<?
} // isUseCaptcha
?>
			<div class="form__field">
				<input type="hidden" name="web_form_apply" value="Y" /><input type="submit" class="btn btn-primary" name="web_form_submit" value="<?=htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" />
				<!-- <input type="submit" value="Отправить"> -->
				 <?
				foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
				{
				?>
					<? if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'checkbox') : ?>

						<div class="agree">
							<label class="label-checkbox">

								<input type="checkbox" <?if ($arQuestion['REQUIRED']) : ?>required<?endif;?> name="form_checkbox_<?=$FIELD_SID ?>[]" value="<?=$arQuestion['STRUCTURE'][0]['ID'] ?>">
								<span class="checkbox"></span>
								<span class="text"><?=$arQuestion["CAPTION"] ?></span>
							</label>
						</div>

					<? endif; ?>
				<?
				} //endwhile
				?>
				
			</div>
		
		</div>
	</div>
</div>
<p>
<?=$arResult["FORM_FOOTER"]?>
<?
} //endif (isFormNote)
?>