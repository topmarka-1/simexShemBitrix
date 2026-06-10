<?
use Bitrix\Main\Loader;
// use Bitrix\Main\EventManager;
use Bitrix\Main\Loader as BitrixLoader;

$isMainPage = $APPLICATION->GetCurPage(false) == '/';

Loader::registerAutoLoadClasses(null, [
    'Local\\Catalog\\FavoritesTable' => '/local/php_interface/lib/FavoritesTable.php',
]);

AddEventHandler('main', 'OnPageStart', function () {
    if (!BitrixLoader::includeModule('catalog')) return;
    $connection = \Bitrix\Main\Application::getConnection();
    if ($connection->isTableExists('favorites')) return;
    $connection->query("CREATE TABLE IF NOT EXISTS `favorites` (
        `ID` INT(11) NOT NULL AUTO_INCREMENT,
        `USER_ID` INT(11) NOT NULL,
        `PRODUCT_ID` INT(11) NOT NULL,
        `DATE_ADD` DATETIME DEFAULT NOW(),
        PRIMARY KEY (`ID`),
        UNIQUE KEY `UX_USER_PRODUCT` (`USER_ID`, `PRODUCT_ID`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
});

AddEventHandler('main', 'OnAfterUserLogin', function (&$arFields) {
    if ($arFields['USER_ID'] <= 0) return;
    $favorites = [];
    if (!empty($_COOKIE['favorites'])) {
        $favorites = json_decode($_COOKIE['favorites'], true) ?? [];
    }
    \Local\Catalog\FavoritesTable::syncFromCookie((int)$arFields['USER_ID'], $favorites);
});
function printR($array)
{
	echo '<pre style="width:100%;height:400px;overflow:auto;">' . print_r($array, true) . '</pre>';
}

AddEventHandler(
    'form',
    'onAfterResultAdd',
    'addEmailToSubscription'
);

function addEmailToSubscription($WEB_FORM_ID, $RESULT_ID)
{
    // ID формы подписки
    if ($WEB_FORM_ID == 1) {
		if (!Loader::includeModule('subscribe')) {
			file_put_contents(
				$_SERVER['DOCUMENT_ROOT'].'/upload/subscribe_log.txt',
				"subscribe module not loaded\n",
				FILE_APPEND
			);

			return;
		}
		CFormResult::GetDataByID(
			$RESULT_ID,
			[],
			$result,
			$answers
		);

		$email = '';
		// printR($answers); 
		// $answ = json_encode($answers);

		// file_put_contents(
		// 	$_SERVER['DOCUMENT_ROOT'].'/upload/subscribe_log.txt',
		// 	"Answers: ".$answ."\n",
		// 	FILE_APPEND
		// );
		if (!empty($answers['email'][1]['USER_TEXT'])) {
			$email = trim($answers['email'][1]['USER_TEXT']);
		}

		if (!$email) {
			return;
		}

		// Проверяем существование подписчика
		$subscription = CSubscription::GetList(
			[],
			['EMAIL' => $email]
		);

		if ($subscription->Fetch()) {
			return;
		}

		$subscr = new CSubscription;

		$subscr->Add([
			'USER_ID' => null,
			'FORMAT' => 'html',
			'EMAIL' => $email,
			'ACTIVE' => 'Y',
			'SEND_CONFIRM' => 'N',
			'CONFIRMED' => 'Y'
		]);  
    }
}

use Bitrix\Main\EventManager;

AddEventHandler(
    'main',
    'OnEndEpilogContent',
    'removeBootstrap'
);

function removeBootstrap(&$content) {
    $content = preg_replace(
        '/<link[^>]*href="[^"]*bootstrap\.css[^"]*"[^>]*>/i',
        '',
        $content
    );
}

//выводим пользовательское HTML поле в свойствах разделов
AddEventHandler('main', 'OnUserTypeBuildList', array('CUserTypeSectionsHtmlField', 'GetUserTypeDescription'), 5000);
class CUserTypeSectionsHtmlField {

    public static function GetUserTypeDescription() {
        return array(
            // уникальный идентификатор
            'USER_TYPE_ID' => 'sections_html_field',
            // имя класса, методы которого формируют поведение типа
            'CLASS_NAME' => 'CUserTypeSectionsHtmlField',
            // название для показа в списке типов пользовательских свойств
            'DESCRIPTION' => 'HTML/text',
            // базовый тип на котором будут основаны операции фильтра
            'BASE_TYPE' => 'string',
        );
    }

    public static function GetDBColumnType($arUserField) {
        switch (strtolower($GLOBALS['DB']->type)) {
            case 'mysql':
                return 'text';
                break;
        }
    }

    public static function GetSettingsHTML($arUserField = false, $arHtmlControl, $bVarsFromForm) {
        $result = '';

        return $result;
    }

    public static function CheckFields($arUserField, $value) {
        $aMsg = array();
        return $aMsg;
    }

    public static function GetEditFormHTML($arUserField, $arHtmlControl) {
        if ($arUserField["ENTITY_VALUE_ID"] < 1 && strlen($arUserField["SETTINGS"]["DEFAULT_VALUE"]) > 0)
            $arHtmlControl["VALUE"] = htmlspecialchars($arUserField["SETTINGS"]["DEFAULT_VALUE"]);
        ob_start();
        CFileMan::AddHTMLEditorFrame($arHtmlControl["NAME"], $arHtmlControl["VALUE"], "html", "html", 200, "N", 0, "", "", "s1");
        $b = ob_get_clean();
        return $b;
    }

    public static function GetEditFormHTMLMulty($arUserField, $arHtmlControl) {
        $html = 'Поле не может быть множественным!';
        return $html;
    }

    public static function GetFilterHTML($arUserField, $arHtmlControl) {
        $sVal = intval($arHtmlControl['VALUE']);
        $sVal = $sVal > 0 ? $sVal : '';

        return CUserTypeSectionsHtmlField::GetEditFormHTML($arUserField, $arHtmlControl);
    }

    public static function GetAdminListViewHTML($arUserField, $arHtmlControl) {
        return '';
    }

    public static function GetAdminListViewHTMLMulty($arUserField, $arHtmlControl) {
        return '';
    }

    public static function GetAdminListEditHTML($arUserField, $arHtmlControl) {
        return '';
    }

    public static function GetAdminListEditHTMLMulty($arUserField, $arHtmlControl) {
        return '';
    }

    public static function onsearchIndex($arUserField) {
        return '';
    }

    public static function OnBeforeSave($arUserField, $value) {
        return $value;
    }
}