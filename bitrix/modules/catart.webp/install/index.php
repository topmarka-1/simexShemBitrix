<?
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Config\Option;
use Bitrix\Main\EventManager;
use Bitrix\Main\Application;

Loc::loadMessages(__FILE__);

class catart_webp extends CModule{

    var $MODULE_ID = "catart.webp";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $PARTNER_NAME;
    var $PARTNER_URI;

    public function __construct(){
        if(file_exists(__DIR__."/version.php")){
            $arModuleVersion = array();

            include(__DIR__."/version.php");

            $this->MODULE_ID            = str_replace("_", ".", get_class($this));
            $this->MODULE_VERSION       = $arModuleVersion["VERSION"];
            $this->MODULE_VERSION_DATE  = $arModuleVersion["VERSION_DATE"];
            $this->MODULE_NAME          = Loc::getMessage("CATART_WEBP_NAME");
            $this->MODULE_DESCRIPTION   = Loc::getMessage("CATART_WEBP_DESCRIPTION");
            $this->PARTNER_NAME         = Loc::getMessage("CATART_WEBP_PARTNER_NAME");
            $this->PARTNER_URI          = Loc::getMessage("CATART_WEBP_PARTNER_URI");
        }

        return false;
    }

    public function DoInstall(){
        global $APPLICATION;

        if(CheckVersion(ModuleManager::getVersion("main"), "14.00.00")){
            $this->InstallFiles();
            $this->InstallDB();

            ModuleManager::registerModule($this->MODULE_ID);

            $this->InstallEvents();
        } else {
            $APPLICATION->ThrowException(
                Loc::getMessage("CATART_WEBP_INSTALL_ERROR_VERSION")
            );
        }

        $APPLICATION->IncludeAdminFile(
            Loc::getMessage("CATART_WEBP_INSTALL_TITLE")." \"".Loc::getMessage("CATART_WEBP_NAME")."\"",
            __DIR__."/step.php"
        );

        return false;
    }

    public function InstallFiles(){
        return false;
    }

    public function InstallDB(){
        return false;
    }

    public function InstallEvents(){
        EventManager::getInstance()->registerEventHandler(
            "main",
            "OnEndBufferContent",
            $this->MODULE_ID,
            "CatArt\Webp\Main",
            "webpGenerate"
        );

        return false;
    }

    public function DoUninstall(){
        global $APPLICATION;

        $this->UnInstallFiles();
        $this->UnInstallDB();
        $this->UnInstallEvents();

        ModuleManager::unRegisterModule($this->MODULE_ID);

        $APPLICATION->IncludeAdminFile(
            Loc::getMessage("CATART_WEBP_UNINSTALL_TITLE")." \"".Loc::getMessage("CATART_WEBP_NAME")."\"",
            __DIR__."/unstep.php"
        );

        return false;
    }

    public function UnInstallFiles(){
        return false;
    }

    public function UnInstallDB(){
        Option::delete($this->MODULE_ID);

        return false;
    }

    public function UnInstallEvents(){
        EventManager::getInstance()->unRegisterEventHandler(
            "main",
            "OnEndBufferContent",
            $this->MODULE_ID,
            "CatArt\Webp\Main",
            "webpGenerate"
        );

        return false;
    }
}
?>