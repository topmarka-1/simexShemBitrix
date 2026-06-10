<?
// $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/includeStyles/favoritesElements.css");
?>

<div class="personal__item blue pattern">
    <div class="personal__item_heading">
        <h5>Избранные товары</h5>
    </div>
    <div class="personal__favorites">
        <div class="personal__favorites_list ">
            <div class="personal__empty">
                <div class="personal__empty_img">
                    <img src="<?=SITE_TEMPLATE_PATH?>/assets/img/icons/empty.svg" alt="empty">
                </div>
                <div class="personal__empty_title">
                    Вы ничего не добавили
                    в избранные товары
                </div>
                <div class="personal__empty_link">
                    <a href="/catalog" class="btn btn-blue">В каталог</a>
                </div>
            </div>
        </div>
    </div>
</div>