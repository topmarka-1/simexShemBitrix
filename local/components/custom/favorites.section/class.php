<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
require_once $_SERVER["DOCUMENT_ROOT"]."/local/php_interface/lib/FavoritesTable.php";

use Bitrix\Main\Loader;
use Bitrix\Main\Application;
use Local\Catalog\FavoritesTable;
// 
class FavoritesSectionComponent extends CBitrixComponent
{
    
    protected function getFavoritesSections()
    {
        global $USER;
        $isAuth = $USER && $USER->IsAuthorized();
        $userId = $isAuth ? (int)$USER->GetID() : 0;
        $list = [];
        $elements = [];
        $sectionIDs = [];
        $sections = [];
        if ($userId) {
            $list = FavoritesTable::getUserFavorites($userId);
        } else {
           if (empty($_COOKIE['favorites'])) return [];
            $list  = json_decode($_COOKIE['favorites'], true) ?? []; 
        }
        if (empty($list)) {
            return [
                "FAVOURITES" => null,
                "FAVOURITES_SECTIONS" => null,
                "USER_ID" => $userId
            ];
        }
        $aElems = CIBlockElement::GetList([], ['IBLOCK_ID' => 14, 'ID' => $list], false, false, ['IBLOCK_ID', 'IBLOCK_SECTION_ID', 'NAME', 'ID']);
        while ($res = $aElems->fetch()) {
            $elements[] = $res;
            if (!in_array($res['IBLOCK_SECTION_ID'], $sectionIDs)) {
                $sectionIDs[] = $res['IBLOCK_SECTION_ID'];
                $sections[] = CIBlockSection::GetList([], ['IBLOCK_ID' => 14, 'ID' => $res['IBLOCK_SECTION_ID']], false, ["ID","IBLOCK_ID","IBLOCK_TYPE_ID","IBLOCK_SECTION_ID","CODE", 'NAME','SECTION_PAGE_URL', 'UF_*'])->GetNext();
            }
        }

        return [
            "FAVOURITES" => $list ?? null,
            "FAVOURITES_SECTIONS" => $sections ?? null,
            "USER_ID" => $userId
        ];
    }

    public function executeComponent()
    {
        $this->arResult = $this->getFavoritesSections();

        $this->includeComponentTemplate();
    }
}