<?

use Bitrix\Main\Loader;
// use Bitrix\Main\EventManager;
use Bitrix\Main\Loader as BitrixLoader;

$isMainPage = $APPLICATION->GetCurPage(false) == '/';

Loader::registerAutoLoadClasses(null, [
    'Local\\Catalog\\FavoritesTable' => '/local/php_interface/lib/FavoritesTable.php',
]);

\Bitrix\Main\Config\Option::set('sale', 'allow_order_without_registration', 'Y');

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
                $_SERVER['DOCUMENT_ROOT'] . '/upload/subscribe_log.txt',
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

use Bitrix\Sale\Delivery\CalculationResult;
use Bitrix\Main\EventManager;

// Принудительно обнуляем стоимость доставки
\Bitrix\Main\EventManager::getInstance()->addEventHandler(
    'sale',
    'OnSaleDeliveryServiceCalculate',
    function (\Bitrix\Main\Event $event) {
        $result = $event->getParameter('RESULT');
        if ($result instanceof CalculationResult)
        {
            $result->setDeliveryPrice(0);
            $result->setPeriodDescription('');
            $result->setDescription('');
        }
    }
);

// Инициализация БД sale — создание таблиц и платёжной системы "Без оплаты" (однократно)
function initSaleDatabase()
{
    if (\Bitrix\Main\Config\Option::get('sale', '~db_init_done', 'N') === 'Y')
        return;
    if (!\Bitrix\Main\Loader::includeModule('sale'))
        return;
    try {
        $conn = \Bitrix\Main\Application::getConnection();
        if (!$conn)
            return;

        // Таблица платежных систем
        if (!$conn->isTableExists('b_sale_pay_system'))
        {
            $conn->query("CREATE TABLE IF NOT EXISTS b_sale_pay_system (
                ID INT NOT NULL AUTO_INCREMENT,
                NAME VARCHAR(255) NOT NULL DEFAULT '',
                SORT INT DEFAULT 100,
                ACTIVE CHAR(1) DEFAULT 'Y',
                DESCRIPTION TEXT,
                ACTION_FILE VARCHAR(255) DEFAULT NULL,
                NEW_WINDOW CHAR(1) DEFAULT 'N',
                HAVE_PAYMENT CHAR(1) DEFAULT 'Y',
                HAVE_ACTION CHAR(1) DEFAULT 'N',
                HAVE_RESULT CHAR(1) DEFAULT 'N',
                HAVE_PREPAY CHAR(1) DEFAULT 'N',
                HAVE_HIDDEN CHAR(1) DEFAULT 'N',
                ENCODING VARCHAR(255) DEFAULT NULL,
                LOGOTIP INT DEFAULT 0,
                IS_CASH VARCHAR(1) DEFAULT NULL,
                CAN_HAS_AUTH VARCHAR(1) DEFAULT NULL,
                ALLOW_EDIT_PAYMENT CHAR(1) DEFAULT 'N',
                ENTITY_REGISTRY_TYPE VARCHAR(255) DEFAULT NULL,
                XML_ID VARCHAR(255) DEFAULT NULL,
                PS_MODE VARCHAR(255) DEFAULT NULL,
                PRIMARY KEY (ID),
                INDEX IX_PS_ACTIVE (ACTIVE),
                INDEX IX_PS_ENTITY_REGISTRY_TYPE (ENTITY_REGISTRY_TYPE)
            )");
        }

        // Таблица действий pay_system_action
        if (!$conn->isTableExists('b_sale_pay_system_action'))
        {
            $conn->query("CREATE TABLE IF NOT EXISTS b_sale_pay_system_action (
                ID INT NOT NULL AUTO_INCREMENT,
                PAY_SYSTEM_ID INT DEFAULT NULL,
                PERSON_TYPE_ID INT DEFAULT NULL,
                PSA_NAME VARCHAR(255) DEFAULT NULL,
                NAME VARCHAR(255) DEFAULT NULL,
                CODE VARCHAR(50) DEFAULT NULL,
                SORT INT DEFAULT 100,
                ACTION_FILE VARCHAR(255) DEFAULT NULL,
                RESULT_FILE VARCHAR(255) DEFAULT NULL,
                DESCRIPTION VARCHAR(255) DEFAULT NULL,
                NEW_WINDOW CHAR(1) DEFAULT 'N',
                WINDOW_WIDTH INT DEFAULT NULL,
                WINDOW_HEIGHT INT DEFAULT NULL,
                PARAMS TEXT DEFAULT NULL,
                TARIF TEXT DEFAULT NULL,
                HAVE_PREPAY CHAR(1) DEFAULT 'N',
                HAVE_ACTION CHAR(1) DEFAULT 'N',
                HAVE_RESULT CHAR(1) DEFAULT 'N',
                HAVE_PAYMENT CHAR(1) DEFAULT 'Y',
                HAVE_HIDDEN CHAR(1) DEFAULT 'N',
                HAVE_PRICE CHAR(1) DEFAULT 'N',
                HAVE_RESULT_RECEIVE CHAR(1) DEFAULT 'N',
                ENCODING VARCHAR(255) DEFAULT NULL,
                LOGOTIP INT DEFAULT 0,
                ACTIVE CHAR(1) DEFAULT 'Y',
                ALLOW_EDIT_PAYMENT CHAR(1) DEFAULT 'N',
                IS_CASH VARCHAR(1) DEFAULT NULL,
                AUTO_CHANGE_1C CHAR(1) DEFAULT 'N',
                CAN_PRINT_CHECK CHAR(1) DEFAULT 'N',
                ENTITY_REGISTRY_TYPE VARCHAR(255) DEFAULT NULL,
                XML_ID VARCHAR(255) DEFAULT NULL,
                PS_MODE VARCHAR(255) DEFAULT NULL,
                PS_CLIENT_TYPE VARCHAR(255) DEFAULT NULL,
                CAN_HAS_AUTH VARCHAR(1) DEFAULT NULL,
                PT_SRC VARCHAR(255) DEFAULT NULL,
                PRIMARY KEY (ID),
                INDEX IX_PSA_ACTIVE (ACTIVE),
                INDEX IX_PSA_ENTITY_REGISTRY (ENTITY_REGISTRY_TYPE)
            )");
        }

        // Таблица ограничений
        if (!$conn->isTableExists('b_sale_pay_system_restrictions'))
        {
            $conn->query("CREATE TABLE IF NOT EXISTS b_sale_pay_system_restrictions (
                ID INT NOT NULL AUTO_INCREMENT,
                PAY_SYSTEM_ID INT NOT NULL,
                SORT INT DEFAULT 100,
                CLASS_NAME VARCHAR(255),
                PARAMS TEXT,
                PRIMARY KEY (ID)
            )");
        }

        // Вставляем платёжную систему, если ни одной нет
        if ($conn->isTableExists('b_sale_pay_system'))
        {
            $existing = $conn->query("SELECT ID FROM b_sale_pay_system LIMIT 1")->fetch();
            if (!$existing)
            {
                $conn->query("
                    INSERT INTO b_sale_pay_system
                    (NAME, SORT, ACTIVE, DESCRIPTION, ACTION_FILE, NEW_WINDOW, HAVE_PAYMENT, HAVE_ACTION, HAVE_RESULT, HAVE_PREPAY, HAVE_HIDDEN, ENCODING, LOGOTIP, IS_CASH, CAN_HAS_AUTH, ALLOW_EDIT_PAYMENT, ENTITY_REGISTRY_TYPE, PS_MODE)
                    VALUES
                    ('Без оплаты', 100, 'Y', 'Оплата без платёжной системы', 'cash', 'N', 'Y', 'N', 'N', 'N', 'Y', '', 0, NULL, NULL, 'N', 'ORDER', NULL)
                ");

                // Добавляем запись в b_sale_pay_system_action
                if ($conn->isTableExists('b_sale_pay_system_action'))
                {
                    $paySystemId = $conn->query("SELECT LAST_INSERT_ID() AS ID")->fetch();
                    $paySystemId = $paySystemId ? (int)$paySystemId['ID'] : 0;
                    if ($paySystemId > 0)
                    {
                        $conn->query("
                            INSERT INTO b_sale_pay_system_action
                            (PAY_SYSTEM_ID, PSA_NAME, NAME, SORT, ACTION_FILE, NEW_WINDOW, HAVE_PAYMENT, HAVE_ACTION, HAVE_RESULT, HAVE_PREPAY, HAVE_HIDDEN, HAVE_PRICE, HAVE_RESULT_RECEIVE, ENCODING, LOGOTIP, ACTIVE, ALLOW_EDIT_PAYMENT, ENTITY_REGISTRY_TYPE)
                            VALUES
                            ($paySystemId, 'Без оплаты', 'Без оплаты', 100, 'cash', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', '', 0, 'Y', 'N', 'ORDER')
                        ");
                    }
                }
            }
        }

        \Bitrix\Main\Config\Option::set('sale', '~db_init_done', 'Y');
    } catch (\Exception $e) {
        // ошибка инициализации — попробуем в следующий раз
    }
}
initSaleDatabase();

AddEventHandler(
    'main',
    'OnEndEpilogContent',
    'removeBootstrap'
);

function removeBootstrap(&$content)
{
    $content = preg_replace(
        '/<link[^>]*href="[^"]*bootstrap\.css[^"]*"[^>]*>/i',
        '',
        $content
    );
}

//выводим пользовательское HTML поле в свойствах разделов
AddEventHandler('main', 'OnUserTypeBuildList', array('CUserTypeSectionsHtmlField', 'GetUserTypeDescription'), 5000);
class CUserTypeSectionsHtmlField
{

    public static function GetUserTypeDescription()
    {
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

    public static function GetDBColumnType($arUserField)
    {
        switch (strtolower($GLOBALS['DB']->type)) {
            case 'mysql':
                return 'text';
                break;
        }
    }

    public static function GetSettingsHTML($arUserField = false, $arHtmlControl, $bVarsFromForm)
    {
        $result = '';

        return $result;
    }

    public static function CheckFields($arUserField, $value)
    {
        $aMsg = array();
        return $aMsg;
    }

    public static function GetEditFormHTML($arUserField, $arHtmlControl)
    {
        if ($arUserField["ENTITY_VALUE_ID"] < 1 && strlen($arUserField["SETTINGS"]["DEFAULT_VALUE"]) > 0)
            $arHtmlControl["VALUE"] = htmlspecialchars($arUserField["SETTINGS"]["DEFAULT_VALUE"]);
        ob_start();
        CFileMan::AddHTMLEditorFrame($arHtmlControl["NAME"], $arHtmlControl["VALUE"], "html", "html", 200, "N", 0, "", "", "s1");
        $b = ob_get_clean();
        return $b;
    }

    public static function GetEditFormHTMLMulty($arUserField, $arHtmlControl)
    {
        $html = 'Поле не может быть множественным!';
        return $html;
    }

    public static function GetFilterHTML($arUserField, $arHtmlControl)
    {
        $sVal = intval($arHtmlControl['VALUE']);
        $sVal = $sVal > 0 ? $sVal : '';

        return CUserTypeSectionsHtmlField::GetEditFormHTML($arUserField, $arHtmlControl);
    }

    public static function GetAdminListViewHTML($arUserField, $arHtmlControl)
    {
        return '';
    }

    public static function GetAdminListViewHTMLMulty($arUserField, $arHtmlControl)
    {
        return '';
    }

    public static function GetAdminListEditHTML($arUserField, $arHtmlControl)
    {
        return '';
    }

    public static function GetAdminListEditHTMLMulty($arUserField, $arHtmlControl)
    {
        return '';
    }

    public static function onsearchIndex($arUserField)
    {
        return '';
    }

    public static function OnBeforeSave($arUserField, $value)
    {
        return $value;
    }
}
