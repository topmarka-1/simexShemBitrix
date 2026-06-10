<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Избранное");
?><div class="personal section anim-fade-in-up">
	<div class="container">
		<div class="heading anim-fade-in-left">
			<h1 class="h2">Избранное</h1>
		</div>
		<div class="personal__content">
			<div class="personal__sections">
				<? $APPLICATION->IncludeComponent(
					"custom:favorites.section",
					"",
					array()
				); ?>
				<? $APPLICATION->IncludeComponent(
					"custom:favorites.elements",
					"",
					array()
				); ?>
			</div>
		</div>
	</div>
</div>
<br><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>