<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("404 Not Found");
?>
<section class="section error-page anim-fade-in-up">
    <div class="container">
        <div class="error-page__content">
            <div class="error-page__image">
                <img src="<?=SITE_TEMPLATE_PATH?>/assets/img/404.png" alt="error page" width="1114" height="603">
            </div>
            <div class="error-page__title anim-fade-in-left">
                <h4>Похоже, топливо на этой странице закончилось</h4>
            </div>
            <div class="error-page__text">
                <p>Возможно, страница была перемещена, удалена или просто «сгорела в работе»<br>Но не переживайте — у нас ещё полно энергии, чтобы вернуть вас на нужный маршрут.</p>
            </div>
            <div class="error-page__links">
                <a href="/" class="btn btn-primary">На главную</a>
                <a href="javascript:void(0)" onclick="history.back()" class="btn btn-trans btn_with-icon">
                    <svg width="5" height="9" viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M4 8.35358L2.30482e-07 4.35358L4 0.353576" stroke="CurrentColor"/>
					</svg>
                    Вернуться назад
                </a>
            </div>
        </div>
        
    </div>
</section>
<?
// $APPLICATION->IncludeComponent("bitrix:main.map", ".default", Array(
// 	"LEVEL"	=>	"3",
// 	"COL_NUM"	=>	"2",
// 	"SHOW_DESCRIPTION"	=>	"Y",
// 	"SET_TITLE"	=>	"Y",
// 	"CACHE_TIME"	=>	"36000000"
// 	)
// );

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>