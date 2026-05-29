<?
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

if(!check_bitrix_sessid()){
    return;
}

echo(CAdminMessage::ShowNote(Loc::getMessage("CATART_WEBP_UNSTEP_RESULT")));
?>

<form action="<?=$APPLICATION->GetCurPage();?>">
    <input type="hidden" name="lang" value="<?=LANG;?>">
    <input type="submit" value="<?=Loc::getMessage("CATART_WEBP_UNSTEP_SUBMIT_BACK");?>">
</form>