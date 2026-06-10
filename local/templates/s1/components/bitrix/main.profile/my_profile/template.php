<?php

use Bitrix\Main\Web\Json;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

if (isset($arResult["SHOW_SMS_FIELD"]) && $arResult["SHOW_SMS_FIELD"] == true) {
	CJSCore::Init('phone_auth');
}
?>

<div class="bx-auth-profile">

	<? ShowError($arResult["strProfileError"]); ?>
	<?
	if (isset($arResult['DATA_SAVED']) && $arResult['DATA_SAVED'] == 'Y')
		ShowNote(GetMessage('PROFILE_DATA_SAVED'));
	?>

	<? if (isset($arResult["SHOW_SMS_FIELD"]) && $arResult["SHOW_SMS_FIELD"] == true): ?>

		<form method="post" action="<?= $arResult["FORM_TARGET"] ?>">
			<?= $arResult["BX_SESSION_CHECK"] ?>
			<input type="hidden" name="lang" value="<?= LANG ?>" />
			<input type="hidden" name="ID" value=<?= $arResult["ID"] ?> />
			<input type="hidden" name="SIGNED_DATA" value="<?= htmlspecialcharsbx($arResult["SIGNED_DATA"]) ?>" />
			<table class="profile-table data-table">
				<tbody>
					<tr>
						<td><? echo GetMessage("main_profile_code") ?><span class="starrequired">*</span></td>
						<td><input size="30" type="text" name="SMS_CODE" value="<?= htmlspecialcharsbx($arResult["SMS_CODE"]) ?>" autocomplete="off" /></td>
					</tr>
				</tbody>
			</table>

			<p><input type="submit" name="code_submit_button" value="<? echo GetMessage("main_profile_send") ?>" /></p>

		</form>

		<script>
			new BX.PhoneAuth({
				containerId: 'bx_profile_resend',
				errorContainerId: 'bx_profile_error',
				interval: <?= $arResult["PHONE_CODE_RESEND_INTERVAL"] ?>,
				data: <?= Json::encode([
							'signedData' => $arResult["SIGNED_DATA"],
						]) ?>,
				onError: function(response) {
					var errorDiv = BX('bx_profile_error');
					var errorNode = BX.findChildByClassName(errorDiv, 'errortext');
					errorNode.innerHTML = '';
					for (var i = 0; i < response.errors.length; i++) {
						errorNode.innerHTML = errorNode.innerHTML + BX.util.htmlspecialchars(response.errors[i].message) + '<br>';
					}
					errorDiv.style.display = '';
				}
			});
		</script>

		<div id="bx_profile_error" style="display:none"><? ShowError("error") ?></div>

		<div id="bx_profile_resend"></div>

	<? else: ?>

		<script>
			<!--
			var opened_sections = [<?
									$arResult["opened"] = $_COOKIE[$arResult["COOKIE_PREFIX"] . "_user_profile_open"] ?? '';
									$arResult["opened"] = preg_replace("/[^a-z0-9_,]/i", "", $arResult["opened"]);
									if ($arResult["opened"] <> '') {
										echo "'" . implode("', '", explode(",", $arResult["opened"])) . "'";
									} else {
										$arResult["opened"] = "reg";
										echo "'reg'";
									}
									?>];
			//
			-->
			var
			cookie_prefix
			=
			'<?= $arResult["COOKIE_PREFIX"] ?>';
		</script>

		<form method="post" name="form1" action="<?= $arResult["FORM_TARGET"] ?>" enctype="multipart/form-data">
			<?= $arResult["BX_SESSION_CHECK"] ?>
			<input type="hidden" name="lang" value="<?= LANG ?>" />
			<input type="hidden" name="ID" value=<?= $arResult["ID"] ?> />

			<div class="personal__item white">
				<div class="personal__item_heading">
					<h5><?= GetMessage("REG_SHOW_HIDE") ?></h5>
				</div>
				<div class="personal__profile profile">
					<div class="profile__form">
						<div class="profile__form_list">
							<div class="profile__form_item">
								<div class="form_title">
									<div class="h6"><?= GetMessage('NAME') ?></div>
								</div>
								<div class="profile__form_fields">
									<div class="profile__form_field">
										<label class="label-text">
											<input type="text" name="TITLE" placeholder="<?= GetMessage("main_profile_title") ?>" value="<?= $arResult["arUser"]["TITLE"] ?>">
										</label>
									</div>
									<div class="profile__form_field">
										<label class="label-text">
											<input type="text" name="NAME" placeholder="<?= GetMessage('NAME') ?>" maxlength="50" value="<?= $arResult["arUser"]["NAME"] ?>">
										</label>
									</div>
									<div class="profile__form_field">
										<label class="label-text">
											<input type="text" name="LAST_NAME" placeholder="<?= GetMessage('LAST_NAME') ?>" maxlength="50" value="<?= $arResult["arUser"]["LAST_NAME"] ?>">
										</label>
									</div>
									<div class="profile__form_field">
										<label class="label-text">
											<input type="text" name="SECOND_NAME" placeholder="<?= GetMessage('SECOND_NAME') ?>" maxlength="50" value="<?= $arResult["arUser"]["SECOND_NAME"] ?>">
										</label>
									</div>
									<div class="profile__form_field">
										<label class="label-text">
											<input type="text" name="LOGIN" placeholder="<?= GetMessage('LOGIN') ?>" maxlength="50" value="<? echo $arResult["arUser"]["LOGIN"] ?>">
										</label>
									</div>
									<div class="profile__form_field">
										<label class="label-text">
											<input type="text" name="EMAIL" placeholder="<?= GetMessage('EMAIL') ?>" maxlength="50" value="<? echo $arResult["arUser"]["EMAIL"] ?>">
										</label>
									</div>
									<? if ($arResult["PHONE_REGISTRATION"]): ?>
										<div class="profile__form_field">
											<label class="label-text">
												<input type="text" name="PHONE_NUMBER" placeholder="<? echo GetMessage("main_profile_phone_number") ?>" maxlength="50" value="<? echo $arResult["arUser"]["PHONE_NUMBER"] ?>">
											</label>
										</div>
									<? endif ?>
									<div class="profile__form_field">
										<label class="label-text">
											<input type="text" name="PERSONAL_BIRTHDAY" placeholder="<?= GetMessage("USER_BIRTHDAY_DT") ?> (<?= $arResult["DATE_FORMAT"] ?>)" value="<?= $arResult["arUser"]["PERSONAL_BIRTHDAY"] ?>">
										</label>
									</div>
								</div>
							</div>

							<!-- <div class="profile__form_item">
								<div class="form_title">
									<div class="h6"><?= GetMessage('USER_PERSONAL_INFO') ?></div>
								</div>
								<div class="profile__form_fields">
									<div class="profile__form_field">
										<label class="label-text">
											<input type="text" name="PERSONAL_PROFESSION" placeholder="<?= GetMessage('USER_PROFESSION') ?>" maxlength="255" value="<?= $arResult["arUser"]["PERSONAL_PROFESSION"] ?>">
										</label>
									</div>
									<div class="profile__form_field">
										<label class="label-text">
											<input type="text" name="PERSONAL_WWW" placeholder="<?= GetMessage('USER_WWW') ?>" maxlength="255" value="<?= $arResult["arUser"]["PERSONAL_WWW"] ?>">
										</label>
									</div>
									<div class="profile__form_field">
										<label class="label-text">
											<input type="text" name="PERSONAL_ICQ" placeholder="<?= GetMessage('USER_ICQ') ?>" maxlength="255" value="<?= $arResult["arUser"]["PERSONAL_ICQ"] ?>">
										</label>
									</div>
									<div class="profile__form_field">
										<label class="label-text">
											<select name="PERSONAL_GENDER">
												<option value=""><?= GetMessage("USER_DONT_KNOW") ?></option>
												<option value="M" <?= $arResult["arUser"]["PERSONAL_GENDER"] == "M" ? "selected" : "" ?>><?= GetMessage("USER_MALE") ?></option>
												<option value="F" <?= $arResult["arUser"]["PERSONAL_GENDER"] == "F" ? "selected" : "" ?>><?= GetMessage("USER_FEMALE") ?></option>
											</select>
										</label>
									</div>
									<div class="profile__form_field">
										<label class="label-text">
											<input type="text" name="PERSONAL_BIRTHDAY" placeholder="<?= GetMessage("USER_BIRTHDAY_DT") ?> (<?= $arResult["DATE_FORMAT"] ?>)" value="<?= $arResult["arUser"]["PERSONAL_BIRTHDAY"] ?>">
										</label>
									</div>
									<div class="profile__form_field">
										<?= $arResult["arUser"]["PERSONAL_PHOTO_INPUT"] ?>
										<? if ($arResult["arUser"]["PERSONAL_PHOTO"] <> '') { ?>
											<br /><?= $arResult["arUser"]["PERSONAL_PHOTO_HTML"] ?>
										<? } ?>
									</div>
								</div>
							</div> -->

							<div class="profile__form_item">
								<div class="form_title">
									<div class="h6"><?= GetMessage('USER_PERSONAL_INFO') ?></div>
								</div>
								<div class="profile__form_fields">
									<div class="profile__form_field">
										<label class="label-text">
											<input type="text" name="PERSONAL_PHONE" placeholder="<?= GetMessage('USER_PHONE') ?>" maxlength="255" value="<?= $arResult["arUser"]["PERSONAL_PHONE"] ?>">
										</label>
									</div>
									<div class="profile__form_field">
										<label class="label-text">
											<input type="text" name="PERSONAL_FAX" placeholder="<?= GetMessage('USER_FAX') ?>" maxlength="255" value="<?= $arResult["arUser"]["PERSONAL_FAX"] ?>">
										</label>
									</div>
									<div class="profile__form_field">
										<label class="label-text">
											<input type="text" name="PERSONAL_MOBILE" placeholder="<?= GetMessage('USER_MOBILE') ?>" maxlength="255" value="<?= $arResult["arUser"]["PERSONAL_MOBILE"] ?>">
										</label>
									</div>
									<div class="profile__form_field">
										<label class="label-text">
											<input type="text" name="LOGIN" placeholder="<?= GetMessage('LOGIN') ?>" maxlength="50" value="<? echo $arResult["arUser"]["LOGIN"] ?>">
										</label>
									</div>
									<div class="profile__form_field">
										<label class="label-text">
											<input type="text" name="EMAIL" placeholder="<?= GetMessage('EMAIL') ?>" maxlength="50" value="<? echo $arResult["arUser"]["EMAIL"] ?>">
										</label>
									</div>
									<? if ($arResult["PHONE_REGISTRATION"]): ?>
										<div class="profile__form_field">
											<label class="label-text">
												<input type="text" name="PHONE_NUMBER" placeholder="<? echo GetMessage("main_profile_phone_number") ?>" maxlength="50" value="<? echo $arResult["arUser"]["PHONE_NUMBER"] ?>">
											</label>
										</div>
									<? endif ?>
									<!-- <div class="profile__form_field">
										<label class="label-text">
											<input type="text" name="PERSONAL_PAGER" placeholder="<?= GetMessage('USER_PAGER') ?>" maxlength="255" value="<?= $arResult["arUser"]["PERSONAL_PAGER"] ?>">
										</label>
									</div> -->
								</div>
							</div>

							<!-- <div class="profile__form_item">
								<div class="form_title">
									<div class="h6"><?= GetMessage("USER_POST_ADDRESS") ?></div>
								</div>
								<div class="profile__form_fields">
									<div class="profile__form_field">
										<label class="label-text">
											<?= $arResult["COUNTRY_SELECT"] ?>
										</label>
									</div>
									<div class="profile__form_field">
										<label class="label-text">
											<input type="text" name="PERSONAL_STATE" placeholder="<?= GetMessage('USER_STATE') ?>" maxlength="255" value="<?= $arResult["arUser"]["PERSONAL_STATE"] ?>">
										</label>
									</div>
									<div class="profile__form_field">
										<label class="label-text">
											<input type="text" name="PERSONAL_CITY" placeholder="<?= GetMessage('USER_CITY') ?>" maxlength="255" value="<?= $arResult["arUser"]["PERSONAL_CITY"] ?>">
										</label>
									</div>
									<div class="profile__form_field">
										<label class="label-text">
											<input type="text" name="PERSONAL_ZIP" placeholder="<?= GetMessage('USER_ZIP') ?>" maxlength="255" value="<?= $arResult["arUser"]["PERSONAL_ZIP"] ?>">
										</label>
									</div>
									<div class="profile__form_field" style="grid-column: span 2;">
										<label class="label-text">
											<textarea cols="30" rows="3" name="PERSONAL_STREET" placeholder="<?= GetMessage("USER_STREET") ?>"><?= $arResult["arUser"]["PERSONAL_STREET"] ?></textarea>
										</label>
									</div>
									<div class="profile__form_field">
										<label class="label-text">
											<input type="text" name="PERSONAL_MAILBOX" placeholder="<?= GetMessage('USER_MAILBOX') ?>" maxlength="255" value="<?= $arResult["arUser"]["PERSONAL_MAILBOX"] ?>">
										</label>
									</div>
									<div class="profile__form_field" style="grid-column: span 2;">
										<label class="label-text">
											<textarea cols="30" rows="3" name="PERSONAL_NOTES" placeholder="<?= GetMessage("USER_NOTES") ?>"><?= $arResult["arUser"]["PERSONAL_NOTES"] ?></textarea>
										</label>
									</div>
								</div>
							</div> -->

							<!-- <div class="profile__form_item">
								<div class="form_title">
									<div class="h6"><?= GetMessage("USER_WORK_INFO") ?></div>
								</div>
								<div class="profile__form_fields">
									<div class="profile__form_field">
										<label class="label-text">
											<input type="text" name="WORK_COMPANY" placeholder="<?= GetMessage('USER_COMPANY') ?>" maxlength="255" value="<?= $arResult["arUser"]["WORK_COMPANY"] ?>">
										</label>
									</div>
									<div class="profile__form_field">
										<label class="label-text">
											<input type="text" name="WORK_WWW" placeholder="<?= GetMessage('USER_WWW') ?>" maxlength="255" value="<?= $arResult["arUser"]["WORK_WWW"] ?>">
										</label>
									</div>
									<div class="profile__form_field">
										<label class="label-text">
											<input type="text" name="WORK_DEPARTMENT" placeholder="<?= GetMessage('USER_DEPARTMENT') ?>" maxlength="255" value="<?= $arResult["arUser"]["WORK_DEPARTMENT"] ?>">
										</label>
									</div>
									<div class="profile__form_field">
										<label class="label-text">
											<input type="text" name="WORK_POSITION" placeholder="<?= GetMessage('USER_POSITION') ?>" maxlength="255" value="<?= $arResult["arUser"]["WORK_POSITION"] ?>">
										</label>
									</div>
									<div class="profile__form_field" style="grid-column: span 2;">
										<label class="label-text">
											<textarea cols="30" rows="3" name="WORK_PROFILE" placeholder="<?= GetMessage("USER_WORK_PROFILE") ?>"><?= $arResult["arUser"]["WORK_PROFILE"] ?></textarea>
										</label>
									</div>
									<div class="profile__form_field">
										<?= $arResult["arUser"]["WORK_LOGO_INPUT"] ?>
										<? if ($arResult["arUser"]["WORK_LOGO"] <> '') { ?>
											<br /><?= $arResult["arUser"]["WORK_LOGO_HTML"] ?>
										<? } ?>
									</div>
								</div>
							</div> -->

							<!-- <div class="profile__form_item">
								<div class="form_title">
									<div class="h6"><?= GetMessage("USER_PHONES") ?> (<?= GetMessage("USER_WORK_INFO") ?>)</div>
								</div>
								<div class="profile__form_fields">
									<div class="profile__form_field">
										<label class="label-text">
											<input type="text" name="WORK_PHONE" placeholder="<?= GetMessage('USER_PHONE') ?>" maxlength="255" value="<?= $arResult["arUser"]["WORK_PHONE"] ?>">
										</label>
									</div>
									<div class="profile__form_field">
										<label class="label-text">
											<input type="text" name="WORK_FAX" placeholder="<?= GetMessage('USER_FAX') ?>" maxlength="255" value="<?= $arResult["arUser"]["WORK_FAX"] ?>">
										</label>
									</div>
									<div class="profile__form_field">
										<label class="label-text">
											<input type="text" name="WORK_PAGER" placeholder="<?= GetMessage('USER_PAGER') ?>" maxlength="255" value="<?= $arResult["arUser"]["WORK_PAGER"] ?>">
										</label>
									</div>
								</div>
							</div> -->

							<!-- <div class="profile__form_item">
								<div class="form_title">
									<div class="h6"><?= GetMessage("USER_POST_ADDRESS") ?> (<?= GetMessage("USER_WORK_INFO") ?>)</div>
								</div>
								<div class="profile__form_fields">
									<div class="profile__form_field">
										<label class="label-text">
											<?= $arResult["COUNTRY_SELECT_WORK"] ?>
										</label>
									</div>
									<div class="profile__form_field">
										<label class="label-text">
											<input type="text" name="WORK_STATE" placeholder="<?= GetMessage('USER_STATE') ?>" maxlength="255" value="<?= $arResult["arUser"]["WORK_STATE"] ?>">
										</label>
									</div>
									<div class="profile__form_field">
										<label class="label-text">
											<input type="text" name="WORK_CITY" placeholder="<?= GetMessage('USER_CITY') ?>" maxlength="255" value="<?= $arResult["arUser"]["WORK_CITY"] ?>">
										</label>
									</div>
									<div class="profile__form_field">
										<label class="label-text">
											<input type="text" name="WORK_ZIP" placeholder="<?= GetMessage('USER_ZIP') ?>" maxlength="255" value="<?= $arResult["arUser"]["WORK_ZIP"] ?>">
										</label>
									</div>
									<div class="profile__form_field" style="grid-column: span 2;">
										<label class="label-text">
											<textarea cols="30" rows="3" name="WORK_STREET" placeholder="<?= GetMessage("USER_STREET") ?>"><?= $arResult["arUser"]["WORK_STREET"] ?></textarea>
										</label>
									</div>
									<div class="profile__form_field">
										<label class="label-text">
											<input type="text" name="WORK_MAILBOX" placeholder="<?= GetMessage('USER_MAILBOX') ?>" maxlength="255" value="<?= $arResult["arUser"]["WORK_MAILBOX"] ?>">
										</label>
									</div>
									<div class="profile__form_field" style="grid-column: span 2;">
										<label class="label-text">
											<textarea cols="30" rows="3" name="WORK_NOTES" placeholder="<?= GetMessage("USER_NOTES") ?>"><?= $arResult["arUser"]["WORK_NOTES"] ?></textarea>
										</label>
									</div>
								</div>
							</div> -->

							<? if ($arResult['CAN_EDIT_PASSWORD']): ?>
								<div class="profile__form_item">
									<div class="form_title">
										<div class="h6"><?= GetMessage('NEW_PASSWORD_REQ') ?></div>
									</div>
									<div class="profile__form_fields">
										<div class="profile__form_field">
											<label class="label-text">
												<input type="password" name="NEW_PASSWORD" maxlength="50" value="" autocomplete="off" class="bx-auth-input" placeholder="<?= GetMessage('NEW_PASSWORD_REQ') ?>">
												<? if ($arResult["SECURE_AUTH"]): ?>
													<span class="bx-auth-secure" id="bx_auth_secure" title="<? echo GetMessage("AUTH_SECURE_NOTE") ?>" style="display:none">
														<div class="bx-auth-secure-icon"></div>
													</span>
													<noscript>
														<span class="bx-auth-secure" title="<? echo GetMessage("AUTH_NONSECURE_NOTE") ?>">
															<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
														</span>
													</noscript>
													<script>
														document.getElementById('bx_auth_secure').style.display = 'inline-block';
													</script>
												<? endif ?>
											</label>
										</div>
										<div class="profile__form_field">
											<label class="label-text">
												<input type="password" name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" autocomplete="off" placeholder="<?= GetMessage('NEW_PASSWORD_CONFIRM') ?>">
											</label>
										</div>
									</div>
								</div>
							<? endif ?>

							<? if ($arResult["TIME_ZONE_ENABLED"] == true): ?>
								<!-- <div class="profile__form_item">
									<div class="form_title">
										<div class="h6"><? echo GetMessage("main_profile_time_zones") ?></div>
									</div>
									<div class="profile__form_fields">
										<div class="profile__form_field">
											<label class="label-text">
												<select name="AUTO_TIME_ZONE" onchange="this.form.TIME_ZONE.disabled=(this.value != 'N')">
													<option value=""><? echo GetMessage("main_profile_time_zones_auto_def") ?></option>
													<option value="Y" <?= ($arResult["arUser"]["AUTO_TIME_ZONE"] == "Y" ? ' selected' : '') ?>><? echo GetMessage("main_profile_time_zones_auto_yes") ?></option>
													<option value="N" <?= ($arResult["arUser"]["AUTO_TIME_ZONE"] == "N" ? ' selected' : '') ?>><? echo GetMessage("main_profile_time_zones_auto_no") ?></option>
												</select>
											</label>
										</div>
										<div class="profile__form_field">
											<label class="label-text">
												<select name="TIME_ZONE" <? if ($arResult["arUser"]["AUTO_TIME_ZONE"] <> "N") echo ' disabled="disabled"' ?>>
													<? foreach ($arResult["TIME_ZONE_LIST"] as $tz => $tz_name): ?>
														<option value="<?= htmlspecialcharsbx($tz) ?>" <?= ($arResult["arUser"]["TIME_ZONE"] == $tz ? ' selected' : '') ?>><?= htmlspecialcharsbx($tz_name) ?></option>
													<? endforeach ?>
												</select>
											</label>
										</div>
									</div>
								</div> -->
							<? endif ?>

							<? if ($arResult["USER_PROPERTIES"]["SHOW"] == "Y"): ?>
								<!-- <div class="profile__form_item">
									<div class="form_title">
										<div class="h6"><?= trim($arParams["USER_PROPERTY_NAME"]) <> '' ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB") ?></div>
									</div>
									<div class="profile__form_fields">
										<? foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField): ?>
											<div class="profile__form_field">
												<label class="label-text">
													<? if ($arUserField["MANDATORY"] == "Y"): ?>
														<span class="starrequired">*</span>
													<? endif; ?>
													<?= $arUserField["EDIT_FORM_LABEL"] ?>:
													<? $APPLICATION->IncludeComponent(
														"bitrix:system.field.edit",
														$arUserField["USER_TYPE"]["USER_TYPE_ID"],
														array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField),
														null,
														array("HIDE_ICONS" => "Y")
													); ?>
												</label>
											</div>
										<? endforeach; ?>
									</div>
								</div> -->
							<? endif ?>

							<? if ($arResult["INCLUDE_FORUM"] == "Y"): ?>
								<!-- <div class="profile__form_item">
									<div class="form_title">
										<div class="h6"><?= GetMessage("forum_INFO") ?></div>
									</div>
									<div class="profile__form_fields">
										<div class="profile__form_field">
											<label class="label-text">
												<input type="hidden" name="forum_SHOW_NAME" value="N" />
												<input type="checkbox" name="forum_SHOW_NAME" value="Y" <? if ($arResult["arForumUser"]["SHOW_NAME"] == "Y") echo "checked"; ?> /> <?= GetMessage("forum_SHOW_NAME") ?>
											</label>
										</div>
										<div class="profile__form_field">
											<label class="label-text">
												<input type="text" name="forum_DESCRIPTION" maxlength="255" value="<?= $arResult["arForumUser"]["DESCRIPTION"] ?>" placeholder="<?= GetMessage('forum_DESCRIPTION') ?>">
											</label>
										</div>
										<div class="profile__form_field" style="grid-column: span 2;">
											<label class="label-text">
												<textarea cols="30" rows="3" name="forum_INTERESTS" placeholder="<?= GetMessage('forum_INTERESTS') ?>"><?= $arResult["arForumUser"]["INTERESTS"]; ?></textarea>
											</label>
										</div>
										<div class="profile__form_field" style="grid-column: span 2;">
											<label class="label-text">
												<textarea cols="30" rows="3" name="forum_SIGNATURE" placeholder="<?= GetMessage("forum_SIGNATURE") ?>"><?= $arResult["arForumUser"]["SIGNATURE"]; ?></textarea>
											</label>
										</div>
										<div class="profile__form_field">
											<?= $arResult["arForumUser"]["AVATAR_INPUT"] ?>
											<? if ($arResult["arForumUser"]["AVATAR"] <> '') { ?>
												<br /><?= $arResult["arForumUser"]["AVATAR_HTML"] ?>
											<? } ?>
										</div>
									</div>
								</div> -->
							<? endif ?>

							<? if ($arResult["INCLUDE_BLOG"] == "Y"): ?>
								<!-- <div class="profile__form_item">
									<div class="form_title">
										<div class="h6"><?= GetMessage("blog_INFO") ?></div>
									</div>
									<div class="profile__form_fields">
										<div class="profile__form_field">
											<label class="label-text">
												<input type="text" name="blog_ALIAS" maxlength="255" value="<?= $arResult["arBlogUser"]["ALIAS"] ?>" placeholder="<?= GetMessage('blog_ALIAS') ?>">
											</label>
										</div>
										<div class="profile__form_field">
											<label class="label-text">
												<input type="text" name="blog_DESCRIPTION" maxlength="255" value="<?= $arResult["arBlogUser"]["DESCRIPTION"] ?>" placeholder="<?= GetMessage('blog_DESCRIPTION') ?>">
											</label>
										</div>
										<div class="profile__form_field" style="grid-column: span 2;">
											<label class="label-text">
												<textarea cols="30" rows="3" name="blog_INTERESTS" placeholder="<?= GetMessage('blog_INTERESTS') ?>"><? echo $arResult["arBlogUser"]["INTERESTS"]; ?></textarea>
											</label>
										</div>
										<div class="profile__form_field">
											<?= $arResult["arBlogUser"]["AVATAR_INPUT"] ?>
											<? if ($arResult["arBlogUser"]["AVATAR"] <> '') { ?>
												<br /><?= $arResult["arBlogUser"]["AVATAR_HTML"] ?>
											<? } ?>
										</div>
									</div>
								</div> -->
							<? endif ?>

							<? if ($arResult["INCLUDE_LEARNING"] == "Y"): ?>
								<!-- <div class="profile__form_item">
									<div class="form_title">
										<div class="h6"><?= GetMessage("learning_INFO") ?></div>
									</div>
									<div class="profile__form_fields">
										<div class="profile__form_field">
											<label class="label-text">
												<input type="hidden" name="student_PUBLIC_PROFILE" value="N" />
												<input type="checkbox" name="student_PUBLIC_PROFILE" value="Y" <? if ($arResult["arStudent"]["PUBLIC_PROFILE"] == "Y") echo "checked"; ?> /> <?= GetMessage("learning_PUBLIC_PROFILE") ?>
											</label>
										</div>
										<div class="profile__form_field" style="grid-column: span 2;">
											<label class="label-text">
												<textarea cols="30" rows="3" name="student_RESUME" placeholder="<?= GetMessage("learning_RESUME") ?>"><?= $arResult["arStudent"]["RESUME"]; ?></textarea>
											</label>
										</div>
									</div>
								</div> -->
							<? endif; ?>

							<? if ($arResult["IS_ADMIN"]): ?>
								<!-- <div class="profile__form_item">
									<div class="form_title">
										<div class="h6"><?= GetMessage("USER_ADMIN_NOTES") ?></div>
									</div>
									<div class="profile__form_fields">
										<div class="profile__form_field" style="grid-column: span 2;">
											<label class="label-text">
												<textarea cols="30" rows="3" name="ADMIN_NOTES" placeholder="<?= GetMessage("USER_ADMIN_NOTES") ?>"><?= $arResult["arUser"]["ADMIN_NOTES"] ?></textarea>
											</label>
										</div>
									</div>
								</div> -->
							<? endif; ?>

							<div class="profile__form_submit">
								<!-- <p><? echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"]; ?></p> -->
								<input type="submit" name="save" value="<?= (($arResult["ID"] > 0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD")) ?>" class="btn btn-grey">
							</div>
						</div>
					</div>
				</div>
			</div>

		</form>
		<?
		if ($arResult["SOCSERV_ENABLED"]) {
			// $APPLICATION->IncludeComponent(
			// 	"bitrix:socserv.auth.split",
			// 	".default",
			// 	array(
			// 		"SHOW_PROFILES" => "Y",
			// 		"ALLOW_DELETE" => "Y"
			// 	),
			// 	false
			// );
		}
		?>

	<? endif ?>

</div>