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
	<!-- <div class="login-form"> -->
		
		<div class="form__content">
			
			<div class="request__form_title"><?=$arResult["FORM_TITLE"]?></div>
			<div class="request__form_fields">
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
							<div class="form__field_title ">
								<?=$arQuestion["CAPTION"]?>
							</div>
							<label class="label-text">
								<?=$arQuestion["HTML_CODE"]?>
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
				<!-- <div class="form__field">
					<div class="form__field_title">Выберите мессенджер:</div>
					<div class="messangers">
						<label class="label-icon">
							<input type="radio" name="messanger" value="telegram">
							<span class="icon">
								<svg width="48" height="48" viewBox="0 0 48 48" fill="none"
									xmlns="http://www.w3.org/2000/svg">
									<rect width="48" height="48" rx="16" fill="#F5F6F7" />
									<path
										d="M15.1649 22.968C15.1649 22.968 23.5681 19.4557 26.4825 18.219C27.5997 17.7243 31.3884 16.1412 31.3884 16.1412C31.3884 16.1412 33.1371 15.4487 32.9914 17.1306C32.9428 17.8232 32.5542 20.2472 32.1656 22.8691C31.5827 26.5793 30.9513 30.6358 30.9513 30.6358C30.9513 30.6358 30.8541 31.7736 30.0284 31.9715C29.2026 32.1694 27.8425 31.279 27.5997 31.081C27.4054 30.9327 23.9567 28.7065 22.6938 27.6182C22.3537 27.3214 21.9652 26.7278 22.7423 26.0352C24.491 24.4027 26.5796 22.3744 27.8425 21.0882C28.4255 20.4946 29.0083 19.1094 26.5796 20.7914C23.1309 23.2154 19.7308 25.491 19.7308 25.491C19.7308 25.491 18.9536 25.9857 17.4964 25.5404C16.0391 25.0953 14.3391 24.5016 14.3391 24.5016C14.3391 24.5016 13.1734 23.7596 15.1649 22.968Z"
										fill="#9D9EA2" />
								</svg>
							</span>
						</label>
						<label class="label-icon">
							<input type="radio" name="messanger" value="watsapp">
							<span class="icon">
								<svg width="48" height="48" viewBox="0 0 48 48" fill="none"
									xmlns="http://www.w3.org/2000/svg">
									<rect width="48" height="48" rx="16" fill="#F5F6F7" />
									<path
										d="M31.1186 16.919C29.2641 15.0412 26.7199 13.9877 24.0707 14.0001H24.0538C18.598 14.0001 14.1084 18.4558 14.1084 23.8703C14.1084 23.8957 14.1089 23.9206 14.1089 23.946C14.1295 25.6675 14.5785 27.3573 15.4161 28.8649L14 34L19.2778 32.6487C20.7357 33.443 22.3749 33.8525 24.0381 33.8378C29.5141 33.8081 34.0032 29.3271 33.9999 23.892C34.0129 21.2806 32.9754 18.7693 31.1186 16.919ZM24.0707 32.1622C22.5964 32.1698 21.1481 31.7773 19.8823 31.0271L19.5555 30.8649L16.4128 31.6757L17.2298 28.5946L17.012 28.2703C16.2027 26.9735 15.774 25.4784 15.7739 23.953C15.7739 19.4547 19.5038 15.7531 24.0364 15.7531C28.5691 15.7531 32.2989 19.4547 32.2989 23.953C32.2989 26.7855 30.8202 29.4244 28.3953 30.9189C27.1129 31.7342 25.621 32.1658 24.098 32.1622M28.8855 26.1622L28.2864 25.892C28.2864 25.892 27.4149 25.5136 26.8703 25.2433C26.8158 25.2433 26.7614 25.1893 26.7069 25.1893C26.5726 25.1925 26.4414 25.2297 26.3256 25.2974C26.2096 25.3649 26.2712 25.3514 25.5086 26.2163C25.4569 26.3174 25.3507 26.3806 25.2363 26.3784H25.1818C25.1 26.3648 25.0241 26.3272 24.964 26.2703L24.6917 26.1622C24.1073 25.9167 23.5723 25.5688 23.1121 25.1352C23.0032 25.0271 22.8398 24.919 22.7309 24.8109C22.3277 24.4275 21.9795 23.991 21.696 23.5136L21.6416 23.4055C21.5942 23.3394 21.5575 23.2665 21.5326 23.1893C21.5184 23.0956 21.5377 23 21.5871 22.919C21.6367 22.8379 21.805 22.6487 21.9684 22.4866C22.1318 22.3244 22.1318 22.2163 22.2407 22.1082C22.2967 22.031 22.3354 21.9429 22.3541 21.8496C22.3729 21.7564 22.3714 21.6602 22.3496 21.5676C22.0958 20.8682 21.8049 20.1826 21.4782 19.5136C21.3906 19.3784 21.2541 19.2817 21.0969 19.2433H20.4978C20.3888 19.2433 20.2799 19.2974 20.171 19.2974L20.1165 19.3514C20.0076 19.4055 19.8987 19.5136 19.7897 19.5677C19.6808 19.6217 19.6263 19.7839 19.5174 19.892C19.1366 20.3695 18.926 20.9587 18.9183 21.5676C18.9243 21.996 19.0169 22.4187 19.1906 22.8109L19.2451 22.973C19.7341 24.0107 20.4181 24.9464 21.2603 25.7298L21.4782 25.946C21.6367 26.0763 21.7826 26.2211 21.9139 26.3784C23.0424 27.353 24.3828 28.0557 25.83 28.4325C25.9934 28.4865 26.2113 28.4865 26.3746 28.5406H26.9193C27.204 28.5266 27.4824 28.4529 27.7363 28.3244C27.8697 28.2644 27.9972 28.1919 28.1176 28.1082L28.2265 28C28.3354 27.8919 28.4444 27.8379 28.5533 27.7298C28.6597 27.6356 28.7515 27.5263 28.8256 27.4055C28.9302 27.1633 29.0037 26.9092 29.0435 26.6487V26.2703C28.9945 26.2267 28.9395 26.1903 28.8801 26.1622"
										fill="#9D9EA2" />
								</svg>
							</span>
						</label>
						<label class="label-icon">
							<input type="radio" name="messanger" value="vk">
							<span class="icon">
								<svg width="48" height="48" viewBox="0 0 48 48" fill="none"
									xmlns="http://www.w3.org/2000/svg">
									<rect width="48" height="48" rx="16" fill="#F5F6F7" />
									<path fill-rule="evenodd" clip-rule="evenodd"
										d="M35.4474 17.9395C35.6162 17.3868 35.4474 17 34.6596 17H32.0335C31.3582 17 31.0581 17.35 30.8892 17.7368C30.8892 17.7368 29.5574 20.9421 27.6629 23.0053C27.0439 23.6132 26.7813 23.7974 26.4436 23.7974C26.2748 23.7974 26.0309 23.6132 26.0309 23.0605V17.9395C26.0309 17.2763 25.8434 17 25.2806 17H21.1539C20.7412 17 20.4786 17.3132 20.4786 17.5895C20.4786 18.2158 21.4165 18.3632 21.529 20.0947V23.8895C21.529 24.7184 21.379 24.8658 21.0413 24.8658C20.1597 24.8658 17.9838 21.6605 16.7082 17.9763C16.4456 17.2947 16.2018 17 15.5265 17H12.9004C12.1501 17 12 17.35 12 17.7368C12 18.4184 12.8816 21.8079 16.1455 26.2842C18.3214 29.3421 21.379 31 24.1551 31C25.8246 31 26.0309 30.6316 26.0309 30.0053V27.6842C26.0309 26.9474 26.181 26.8 26.725 26.8C27.1189 26.8 27.7754 26.9842 29.3323 28.4579C31.1143 30.2079 31.4145 31 32.4086 31H35.0347C35.7851 31 36.1602 30.6316 35.9351 29.9132C35.6913 29.1947 34.8472 28.1447 33.7217 26.8921C33.1027 26.1737 32.1835 25.4184 31.9209 25.0316C31.527 24.5342 31.6396 24.3132 31.9209 23.8895C31.9209 23.8711 35.1285 19.45 35.4474 17.9395Z"
										fill="#9D9EA2" />
								</svg>
							</span>
						</label>
					</div>
				</div> -->
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
	<!-- </div> -->

	<?=$arResult["FORM_FOOTER"]?>
	<?
	} //endif (isFormNote)
	?>
	<!-- </div> -->
