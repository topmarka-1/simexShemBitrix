
        </main>
        <footer class="footer">
            <div class="subscribe">
                <div class="container">
                    <div class="subscribe__row">
                        <?
                            $APPLICATION->IncludeFile(
                                SITE_TEMPLATE_PATH . '/include/subscribe.php',
                                [],
                                [
                                    'MODE'      => 'php',
                                ]
                            );
                        ?>
                        <?
                            $APPLICATION->IncludeFile(
                                SITE_TEMPLATE_PATH . '/include/subscribe_contacts.php',
                                [],
                                [
                                    'MODE'      => 'php',
                                ]
                            );
                        ?>
                    </div>
                </div>
            </div>
            <div class="footer__top">
                <div class="container">
                    <div class="footer__cols">
                        <div class="footer__nav">
                            <div class="footer__nav_col">
                                <div class="footer__nav_title footer__nav_item"> <a href="/catalog">Каталог
                                        продукции</a> </div>
                                <ul class="footer__nav_catalog">
                                    <li class="footer__nav_item"> <a href="/catalogList">Для авиации</a> </li>
                                    <li class="footer__nav_item"> <a href="/catalogList">Холодильные масла и
                                            компрессорные масла</a> </li>
                                    <li class="footer__nav_item"> <a href="/catalogList">Для Оборонно-Промышленного
                                            Комплекса</a> </li>
                                    <li class="footer__nav_item"> <a href="/catalogList">Для автомобильной и специальной
                                            техники</a> </li>
                                    <li class="footer__nav_item"> <a href="/catalogList">Для производителей моторных
                                            масел</a> </li>
                                </ul>
                            </div>
                            <div class="footer__nav_col">
                                <ul class="footer__nav_about">
                                    <li class="footer__nav_item"> <a href="/about">О компании</a> </li>
                                    <li class="footer__nav_item"> <a href="#">Подбор масла</a> </li>
                                    <li class="footer__nav_item"> <a href="/laboratory">Лаборатория</a> </li>
                                    <li class="footer__nav_item"> <a href="/news">Новости</a> </li>
                                    <li class="footer__nav_item"> <a href="/buy">Бренды</a> </li>
                                    <li class="footer__nav_item"> <a href="/dealers">Дилеры</a> </li>
                                    <li class="footer__nav_item"> <a href="/actions">Акции</a> </li>
                                    <li class="footer__nav_item"> <a href="/vacancies">Вакансии</a> </li>
                                    <li class="footer__nav_item"> <a href="/contacts">Контакты</a> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__bottom">
                <div class="container">
                    <div class="footer__cols">
                        <? $APPLICATION->IncludeFile(
                            SITE_TEMPLATE_PATH . '/include/foot_logo.php',
                            [],
                            [
                                'MODE'      => 'php',
                            ]
                        ); ?>
                        <div class="footer__copy">
                            <? $APPLICATION->IncludeFile(
                                SITE_TEMPLATE_PATH . '/include/copyrait.php',
                                [],
                                [
                                    'MODE'      => 'html',
                                ]
                            ); ?>
                            <div class="footer__copy_nav">
                                <!-- <div class="footer__copy_nav_list"> 
                                    <a href="#" class="link">Политика конфиденциальности
                                        данных</a> 
                                    <a href="#" class="link">Пользовательское соглашение</a> 
                                    <a href="#"
                                        class="link">Реквизиты организации</a> 
                                    </div> -->
                                    <?$APPLICATION->IncludeComponent(
                                    "bitrix:menu", 
                                    "copy", 
                                    array(
                                        "ALLOW_MULTI_SELECT" => "N",
                                        "CHILD_MENU_TYPE" => "left",
                                        "DELAY" => "N",
                                        "MAX_LEVEL" => "1",
                                        "MENU_CACHE_GET_VARS" => array(
                                        ),
                                        "MENU_CACHE_TIME" => "3600",
                                        "MENU_CACHE_TYPE" => "N",
                                        "MENU_CACHE_USE_GROUPS" => "Y",
                                        "ROOT_MENU_TYPE" => "copy",
                                        "USE_EXT" => "N",
                                        "COMPONENT_TEMPLATE" => "copy"
                                    ),
                                    false
                                );?>
                                <? $APPLICATION->IncludeFile(
                                SITE_TEMPLATE_PATH . '/include/developer.php',
                                [],
                                [
                                    'MODE'      => 'html',
                                ]
                            ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <div class="mobile__nav">
        <div class="mobile__nav_list"> <a href="/" class="btn btn-quad btn-quad-lg"> <svg height="22"
                    viewBox="0 0 24 24" width="22" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="m18 22.75h-12a4.756 4.756 0 0 1 -4.75-4.75v-7.078a4.728 4.728 0 0 1 1.782-3.709l6-4.8a4.726 4.726 0 0 1 5.935 0l6 4.8a4.728 4.728 0 0 1 1.782 3.709v7.078a4.756 4.756 0 0 1 -4.749 4.75zm-14.03-14.366a3.234 3.234 0 0 0 -1.22 2.538v7.078a3.254 3.254 0 0 0 3.25 3.25h12a3.254 3.254 0 0 0 3.25-3.25v-7.078a3.234 3.234 0 0 0 -1.22-2.538l-6-4.8a3.232 3.232 0 0 0 -4.061 0z"
                        fill="CurrentColor"></path>
                    <path d="m15 18.75h-6a.75.75 0 0 1 0-1.5h6a.75.75 0 0 1 0 1.5z" fill="CurrentColor"></path>
                </svg> </a> <a href="tel:+79200466424" class="btn btn-quad btn-quad-lg phone-btn"> <svg width="18"
                    height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M3.3147 0.686401C3.88927 0.322712 4.59805 0.525066 4.96606 1.01843L7.15845 3.95593C7.54326 4.47182 7.49049 5.19225 7.0354 5.64734L5.71216 6.9696C5.78354 7.12431 5.89188 7.34104 6.05005 7.6073C6.40377 8.20274 7.00391 9.05041 7.97778 10.0243C8.95169 10.9982 9.79934 11.5983 10.3948 11.952C10.6604 12.1098 10.8769 12.2175 11.0315 12.2889L12.3547 10.9667C12.8098 10.5115 13.5303 10.4589 14.0461 10.8436L16.9836 13.036C17.4771 13.404 17.6793 14.1128 17.3157 14.6874C16.6581 15.7261 15.4857 16.9361 13.2405 17.4052C11.8084 17.7042 10.2929 17.2817 8.85474 16.5067C7.41051 15.7284 5.98794 14.5657 4.71216 13.2899C3.43639 12.0142 2.27366 10.5916 1.49536 9.14734C0.720355 7.70915 0.29788 6.19366 0.596924 4.7616C1.06592 2.51639 2.27585 1.344 3.3147 0.686401Z"
                        stroke="CurrentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg> </a> <a href="/lk" class="btn btn-quad btn-quad-lg favourite_btn"> <svg width="17" height="16"
                    viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M8.49339 1.30609C7.59211 0.493411 6.40643 0 5.10752 0C2.28671 0 0 2.32698 0 5.19746C0 6.51927 0.478257 7.73256 1.27688 8.6497L8.5 16L15.5093 8.8673L15.7165 8.64301C16.5151 7.72577 17 6.51927 17 5.19746C17 2.32698 14.7133 0 11.8924 0C10.5935 0 9.40789 0.493411 8.50661 1.3061L8.5 1.29937L8.49339 1.30609ZM8.5 3.24788L8.55185 3.29459L9.35746 2.47474L9.44142 2.39902C10.0931 1.81145 10.9491 1.45455 11.8924 1.45455C13.9428 1.45455 15.5833 3.14253 15.5833 5.19746C15.5833 6.13944 15.2419 6.99869 14.6732 7.65876L14.4965 7.84999L8.5 13.9521L2.30703 7.65004C1.75093 6.99714 1.41667 6.13905 1.41667 5.19746C1.41667 3.14253 3.05716 1.45455 5.10752 1.45455C6.05082 1.45455 6.90691 1.81145 7.55858 2.39901L7.64254 2.4747L8.44824 3.29456L8.5 3.24788Z"
                        fill="CurrentColor"></path>
                </svg> </a> <a href="/lk" class="btn btn-quad btn-quad-lg cart_btn"> <svg width="17" height="16"
                    viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M0.828399 0.0350039C0.504358 -0.0777245 0.14931 0.0908144 0.0353776 0.411433C-0.0785545 0.73206 0.0917839 1.08336 0.415834 1.19608L0.632445 1.27143C1.18606 1.46402 1.54991 1.59165 1.81762 1.72162C2.06908 1.8437 2.17993 1.94251 2.25295 2.04824C2.3278 2.15662 2.3856 2.30547 2.41822 2.6036C2.45234 2.91557 2.45319 3.32189 2.45319 3.92901V6.16212C2.45319 7.3539 2.46449 8.21329 2.57815 8.86986C2.69949 9.57081 2.94174 10.0726 3.39471 10.5454C3.88718 11.0593 4.51144 11.283 5.25466 11.3873C5.96636 11.4872 6.87013 11.4872 7.98611 11.4872H12.4688C13.0839 11.4872 13.6014 11.4872 14.0201 11.4365C14.4644 11.3827 14.8696 11.2651 15.2232 10.9799C15.5769 10.6947 15.7751 10.3258 15.9181 9.90623C16.0527 9.51059 16.1572 9.00918 16.2814 8.41317L16.7034 6.38703L16.7042 6.38325L16.7128 6.34039C16.8494 5.66357 16.9643 5.09423 16.9929 4.6363C17.0228 4.15532 16.9675 3.68107 16.6509 3.27378C16.456 3.02318 16.1821 2.88131 15.9329 2.79468C15.6787 2.70632 15.3913 2.6552 15.1013 2.62312C14.5315 2.56011 13.8394 2.56012 13.1606 2.56012H3.66375C3.66102 2.52997 3.65807 2.50031 3.65488 2.47116C3.61033 2.06388 3.51379 1.69242 3.27995 1.35385C3.04429 1.01264 2.73096 0.794106 2.36556 0.616714C2.02383 0.450809 1.5896 0.299771 1.07834 0.121944L0.828399 0.0350039ZM3.69708 3.79087H13.1347C13.8448 3.79087 14.4699 3.79169 14.9631 3.84625C15.2082 3.87336 15.3917 3.91102 15.5205 3.95584C15.6258 3.99246 15.6615 4.02237 15.6666 4.02669C15.6666 4.0266 15.6669 4.02687 15.6666 4.02669C15.7176 4.09349 15.7729 4.21468 15.7513 4.56048C15.7286 4.92443 15.632 5.41038 15.4847 6.14056L15.4844 6.14239L15.0707 8.12813C14.9369 8.77041 14.8468 9.1974 14.7393 9.51313C14.6372 9.81294 14.5413 9.94209 14.4374 10.0259C14.3336 10.1096 14.1864 10.1764 13.8691 10.2148C13.5347 10.2554 13.0939 10.2564 12.4311 10.2564H8.03363C6.85873 10.2564 6.04351 10.2549 5.4293 10.1688C4.83654 10.0856 4.52339 9.93446 4.29739 9.69856C4.03188 9.42156 3.88868 9.15022 3.80418 8.66211C3.712 8.12952 3.69708 7.38385 3.69708 6.16212V3.79087Z"
                        fill="CurrentColor"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M5.18305 15.9999C4.15257 15.9999 3.31721 15.1733 3.31721 14.1538C3.31721 13.1342 4.15257 12.3077 5.18305 12.3077C6.21353 12.3077 7.04888 13.1342 7.04888 14.1538C7.04888 15.1733 6.21353 15.9999 5.18305 15.9999ZM4.5611 14.1538C4.5611 14.4936 4.83956 14.7692 5.18305 14.7692C5.52654 14.7692 5.80499 14.4936 5.80499 14.1538C5.80499 13.8139 5.52654 13.5384 5.18305 13.5384C4.83956 13.5384 4.5611 13.8139 4.5611 14.1538Z"
                        fill="CurrentColor"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M12.6464 16C11.616 16 10.7806 15.1734 10.7806 14.1539C10.7806 13.1342 11.616 12.3078 12.6464 12.3078C13.6768 12.3078 14.5122 13.1342 14.5122 14.1539C14.5122 15.1734 13.6768 16 12.6464 16ZM12.0244 14.1539C12.0244 14.4937 12.3029 14.7692 12.6464 14.7692C12.9899 14.7692 13.2683 14.4937 13.2683 14.1539C13.2683 13.814 12.9899 13.5385 12.6464 13.5385C12.3029 13.5385 12.0244 13.814 12.0244 14.1539Z"
                        fill="CurrentColor"></path>
                </svg> </a> <a href="/lk" class="btn btn-quad btn-quad-lg profile_btn"> <svg width="16" height="16"
                    viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M12.7362 4.70588C12.7362 2.1069 10.6157 0 8.00003 0C5.38426 0 3.26379 2.1069 3.26379 4.70588C3.26379 6.0835 3.85976 7.32252 4.80831 8.1827C2.24288 9.28448 0.368483 11.6735 0.0104673 14.532C-0.0942123 15.3677 0.602597 16 1.3693 16H14.6307C15.3974 16 16.0942 15.3677 15.9895 14.532C15.6315 11.6735 13.7571 9.28449 11.1917 8.18271C12.1402 7.32253 12.7362 6.0835 12.7362 4.70588ZM9.74343 8.38513C9.72003 8.20113 9.80756 8.02071 9.96698 7.92424C11.0605 7.26287 11.789 6.0687 11.789 4.70588C11.789 2.62669 10.0926 0.941176 8.00003 0.941176C5.9074 0.941176 4.21103 2.62669 4.21103 4.70588C4.21103 6.06871 4.93953 7.26287 6.03298 7.92424C6.19241 8.02071 6.27993 8.20113 6.25663 8.38513C6.23324 8.56904 6.10336 8.72226 5.92484 8.77638C3.28638 9.57572 1.29961 11.8605 0.950452 14.6482C0.925919 14.8441 1.08973 15.0588 1.3693 15.0588H14.6307C14.9102 15.0588 15.074 14.8441 15.0495 14.6482C14.7003 11.8605 12.7136 9.57572 10.0752 8.77638C9.8966 8.72226 9.76673 8.56904 9.74343 8.38513Z"
                        fill="CurrentColor"></path>
                </svg> </a> <button class="btn btn-sm btn-quad btn-quad-lg burger_btn"> <span class="lines"> <span
                        class="line"></span><span class="line"></span><span class="line"></span> </span> </button>
        </div>
    </div>

    <div class="popup" id="subscribe">
    <div class="popup__content">
        <div class="popup__container">
            <!-- <div class="heading">
                <div class="h2">Войти в личный
                    кабинет клиента</div>
            </div> -->
            <?$APPLICATION->IncludeComponent("bitrix:form", "subscribe", Array(
                "AJAX_MODE" => "Y",	// Включить режим AJAX
                    "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
                    "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
                    "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
                    "AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
                    "CACHE_TIME" => "3600",	// Время кеширования (сек.)
                    "CACHE_TYPE" => "A",	// Тип кеширования
                    "CHAIN_ITEM_LINK" => "",	// Ссылка на дополнительном пункте в навигационной цепочке
                    "CHAIN_ITEM_TEXT" => "",	// Название дополнительного пункта в навигационной цепочке
                    "EDIT_ADDITIONAL" => "N",	// Выводить на редактирование дополнительные поля
                    "EDIT_STATUS" => "Y",	// Выводить форму смены статуса
                    "IGNORE_CUSTOM_TEMPLATE" => "N",	// Игнорировать свой шаблон
                    "NAME_TEMPLATE" => "",	// Формат имени
                    "NOT_SHOW_FILTER" => array(	// Коды полей, которые нельзя показывать в фильтре
                        0 => "",
                        1 => "",
                    ),
                    "NOT_SHOW_TABLE" => array(	// Коды полей, которые нельзя показывать в таблице
                        0 => "",
                        1 => "",
                    ),
                    "RESULT_ID" => $_REQUEST["RESULT_ID"],	// ID результата
                    "SEF_MODE" => "N",	// Включить поддержку ЧПУ
                    "SHOW_ADDITIONAL" => "N",	// Показать дополнительные поля веб-формы
                    "SHOW_ANSWER_VALUE" => "N",	// Показать значение параметра ANSWER_VALUE
                    "SHOW_EDIT_PAGE" => "N",	// Показывать страницу редактирования результата
                    "SHOW_LIST_PAGE" => "N",	// Показывать страницу со списком результатов
                    "SHOW_STATUS" => "Y",	// Показать текущий статус результата
                    "SHOW_VIEW_PAGE" => "N",	// Показывать страницу просмотра результата
                    "START_PAGE" => "new",	// Начальная страница
                    "SUCCESS_URL" => "",	// Страница с сообщением об успешной отправке
                    "USE_EXTENDED_ERRORS" => "N",	// Использовать расширенный вывод сообщений об ошибках
                    "VARIABLE_ALIASES" => array(
                        "action" => "action",
                    ),
                    "WEB_FORM_ID" => "1",	// ID веб-формы
                ),
                false
            );?>
            <!-- <div class="popup__content_form">

                <form action="#" class="login-form">
                    <div class="form__content">
                        <div class="login-form__fields form__fields">
                            <div class="form__field">
                                <div class="form__field_title h6">
                                    Ваш логин:
                                </div>
                                <label class="label-text">
                                    <input type="text" name="login" placeholder="login">
                                </label>
                            </div>
                            <div class="form__field">
                                <div class="form__field_title h6">
                                    Ваш пароль:
                                </div>
                                <label class="label-text">
                                    <input type="password" name="password" placeholder="password">
                                </label>
                            </div>
                            <div class="form__field">
                                <input type="submit" value="Войти" class="btn btn-primary btn-full">
                                <div class="form__field_link">
                                    Нет аккаунта? <a href="/register">Зарегистрироваться</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div> -->
        </div>
    </div>
</div>

    <!-- <div class="popup">
        <div class="popup__content">
            <div class="popup__container">
                <div class="heading">
                    <h1 class="h2">Регистрация<br>
                        нового профиля</h1>
                </div>
                <div class="popup__content_form">
                    <form action="#" class="login-form">
                        <div class="form__content">
                            <div class="login-form__fields form__fields">
                                <div class="form__field">
                                    <div class="form__field_title h6">
                                        Как вас зовут?
                                    </div>
                                    <label class="label-text">
                                        <input type="text" name="company" placeholder="Иван">
                                    </label>
                                </div>
                                <div class="form__field">
                                    <div class="form__field_title h6">
                                        ИНН организации
                                    </div>
                                    <label class="label-text">
                                        <input type="text" name="company" value="123456789012345"
                                            placeholder="ИНН организации">
                                    </label>
                                </div>
                                <div class="form__field">
                                    <div class="form__field_title h6">
                                        Название вашей компании
                                    </div>
                                    <label class="label-text">
                                        <input type="text" name="company" value="ИП Марянов Кирилл Александрович"
                                            placeholder="Название вашей компании">
                                    </label>
                                </div>
                                <div class="form__field">
                                    <div class="form__field_title h6">
                                        Придумайте логин
                                    </div>
                                    <label class="label-text">
                                        <input type="text" name="login" placeholder="login">
                                    </label>
                                </div>
                                <div class="form__field">
                                    <div class="form__field_title h6">
                                        Придумайте пароль
                                    </div>
                                    <label class="label-text">
                                        <input type="password" name="password" placeholder="password">
                                    </label>
                                </div>
                                <div class="form__field">
                                    <input type="submit" value="Зарегистрироваться" class="btn btn-primary btn-full">
                                    <div class="form__field_link">
                                        Есть аккаунт? <a href="/login">Авторизироваться</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
    <script src="<?=SITE_TEMPLATE_PATH?>/assets/js/index.js"></script>
</body>

</html>