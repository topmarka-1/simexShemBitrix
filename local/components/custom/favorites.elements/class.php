<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
require_once $_SERVER["DOCUMENT_ROOT"]."/local/php_interface/lib/FavoritesTable.php";

use Bitrix\Main\Loader;
use Bitrix\Main\Application;
use Local\Catalog\FavoritesTable;
// 
class FavoritesElementsComponent extends CBitrixComponent
{
    
    protected function getFavoritesElements()
    {
        global $USER;
        $isAuth = $USER && $USER->IsAuthorized();
        $userId = $isAuth ? (int)$USER->GetID() : 0;
        $list = [];
        $elements = [];
        $elementsIds = [];
        $sectionIDs = [];
        if ($userId) {
            $list = FavoritesTable::getUserFavorites($userId);
        } else {
           if (empty($_COOKIE['favorites'])) return [];
            $list  = json_decode($_COOKIE['favorites'], true) ?? []; 
        }
        if (empty($list)) {
            return [
                "FAVOURITES" => null,
                "FAVOURITES_ELEMENTS" => null,
                "FAVOURITES_SECTIONS" => null,
                "USER_ID" => $userId
            ];
        }
        $aElems = CIBlockElement::GetList([], ['IBLOCK_ID' => 14, 'ID' => $list], false, false, ['IBLOCK_ID', 'IBLOCK_SECTION_ID', 'NAME', 'ID', 'DETAIL_PAGE_URL']);
        while ($res = $aElems->GetNextElement()) {
            $fields = $res->GetFields();
            $props = $res->GetProperties();
            $fields['PROPERTIES'] = $props;
            $elements[] = $fields;
            if (!in_array($fields['IBLOCK_SECTION_ID'], $sectionIDs)) {
                $sectionIDs[] = $fields['IBLOCK_SECTION_ID'];
            }
            if (!in_array($fields['ID'], $elementsIds)) {
                $elementsIds[] = $fields['ID'];
            }
        }

        return [
            "FAVOURITES" => $elements ?? null,
            "FAVOURITES_ELEMENTS" => $elementsIds ?? null,
            "FAVOURITES_SECTIONS" => $sectionIDs ?? null,
            "USER_ID" => $userId
        ];
    }

    public function executeComponent()
    {
        $this->arResult = $this->getFavoritesElements();

        $this->includeComponentTemplate();
    }
}