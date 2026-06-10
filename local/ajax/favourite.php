<?php

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;
use Local\Catalog\FavoritesTable;

Loader::includeModule('catalog');

$action = $_REQUEST['action'] ?? '';
$id = (int)($_REQUEST['id'] ?? 0);
global $USER;

function getCookieFavorites(): array
{
    if (empty($_COOKIE['favorites'])) return [];
    return json_decode($_COOKIE['favorites'], true) ?? [];
}

function setCookieFavorites(array $ids): void
{
    setcookie('favorites', json_encode($ids), time() + 86400 * 365, '/');
    $_COOKIE['favorites'] = json_encode($ids);
}

$isAuth = $USER && $USER->IsAuthorized();
$userId = $isAuth ? (int)$USER->GetID() : 0;

switch ($action) {
    case 'toggle':
        if ($id <= 0) {
            echo json_encode(['success' => false, 'error' => 'invalid id']);
            die;
        }

        if ($userId > 0) {
            $added = !FavoritesTable::isFavorite($userId, $id);
            if ($added) {
                FavoritesTable::addFavorite($userId, $id);
            } else {
                FavoritesTable::removeFavorite($userId, $id);
            }
            $list = FavoritesTable::getUserFavorites($userId);
        } else {
            $favorites = getCookieFavorites();
            $key = array_search($id, $favorites);
            if ($key !== false) {
                array_splice($favorites, $key, 1);
                $added = false;
            } else {
                $favorites[] = $id;
                $added = true;
            }
            setCookieFavorites($favorites);
            $list = $favorites;
        }

        echo json_encode(['success' => true, 'added' => $added, 'favorites' => $list]);
        break;

    case 'list':
        if ($userId > 0) {
            $list = FavoritesTable::getUserFavorites($userId);
        } else {
            $list = getCookieFavorites();
        }
        echo json_encode(['success' => true, 'favorites' => $list]);
        break;

    case 'check':
        if ($id <= 0) {
            echo json_encode(['success' => false, 'error' => 'invalid id']);
            die;
        }
        if ($userId > 0) {
            $added = FavoritesTable::isFavorite($userId, $id);
        } else {
            $added = in_array($id, getCookieFavorites());
        }
        echo json_encode(['success' => true, 'added' => $added]);
        break;

    default:
        echo json_encode(['success' => false, 'error' => 'unknown action']);
}
