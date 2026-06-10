<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Персональный раздел");
?>
<?
// $APPLICATION->IncludeComponent(
// 	"bitrix:main.profile",
// 	"",
// 	Array(
// 		"CHECK_RIGHTS" => "Y",
// 		"SEND_INFO" => "N",
// 		"SET_TITLE" => "Y",
// 		"USER_PROPERTY" => array(),
// 		"USER_PROPERTY_NAME" => ""
// 	)
// );
?><?$APPLICATION->IncludeComponent("bitrix:sale.personal.section", "personal", Array(
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CHECK_RIGHTS_PRIVATE" => "N",	// Проверять права доступа
		"CUSTOM_PAGES" => "",	// Настройки дополнительных страниц раздела
		"CUSTOM_SELECT_PROPS" => "",	// Дополнительные свойства инфоблока
		"MAIN_CHAIN_NAME" => "Мой кабинет",	// Название раздела в цепочке навигации
		"NAV_TEMPLATE" => "",	// Имя шаблона для постраничной навигации
		"ORDERS_PER_PAGE" => "20",	// Количество заказов на одной странице
		"ORDER_DEFAULT_SORT" => "STATUS",	// Сортировка заказов
		"ORDER_DISALLOW_CANCEL" => "N",	// Запретить отмену заказа
		"ORDER_HIDE_USER_INFO" => array(	// Не показывать в информации о пользователе
			0 => "0",
		),
		"ORDER_HISTORIC_STATUSES" => array(	// Перенести в историю заказы в статусах
			0 => "F",
		),
		"ORDER_REFRESH_PRICES" => "N",	// Пересчитывать заказ после смены платежной системы
		"ORDER_RESTRICT_CHANGE_PAYSYSTEM" => array(	// Запретить смену платежной системы у заказов в статусах
			0 => "0",
		),
		"PATH_TO_BASKET" => "/personal/cart/",	// Путь к корзине
		"PATH_TO_CATALOG" => "/catalog/",	// Путь к каталогу
		"PATH_TO_CONTACT" => "/about/contacts/",	// Путь к странице контактных данных
		"PATH_TO_PAYMENT" => "/personal/order/payment/",	// Путь к странице оплат
		"SAVE_IN_SESSION" => "Y",	// Сохранять установки фильтра в сессии пользователя
		"SEF_FOLDER" => "/personal/",	// Каталог ЧПУ (относительно корня сайта)
		"SEF_MODE" => "Y",	// Включить поддержку ЧПУ
		"SEND_INFO_PRIVATE" => "N",	// Генерировать почтовое событие
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"SHOW_ACCOUNT_PAGE" => "Y",	// Показать страницу персонального счета пользователя
		"SHOW_BASKET_PAGE" => "Y",	// Вывести ссылку на корзину
		"SHOW_CONTACT_PAGE" => "N",	// Вывести ссылку на страницу контактов
		"SHOW_ORDER_PAGE" => "Y",	// Показать страницу заказов пользователя
		"SHOW_PRIVATE_PAGE" => "Y",	// Показать страницу персональных данных пользователя
		"SHOW_PROFILE_PAGE" => "Y",	// Показать страницу профилей пользователя
		"SHOW_SUBSCRIBE_PAGE" => "Y",	// Показать страницу подписок
		"COMPONENT_TEMPLATE" => ".default",
		"SEF_URL_TEMPLATES" => array(
			"index" => "index.php",
			"orders" => "orders/",
			"account" => "account/",
			"subscribe" => "subscribe/",
			"profile" => "profiles/",
			"profile_detail" => "profiles/#ID#",
			"private" => "private/",
			"order_detail" => "orders/#ID#",
			"order_cancel" => "cancel/#ID#",
		)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>