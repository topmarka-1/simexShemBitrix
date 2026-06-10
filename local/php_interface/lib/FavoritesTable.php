<?php

namespace Local\Catalog;

use Bitrix\Main\Entity;
use Bitrix\Main\Type\DateTime;

class FavoritesTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'favorites';
    }

    public static function getMap()
    {
        return [
            new Entity\IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
            ]),
            new Entity\IntegerField('USER_ID', [
                'required' => true,
            ]),
            new Entity\IntegerField('PRODUCT_ID', [
                'required' => true,
            ]),
            new Entity\DateTimeField('DATE_ADD', [
                'default_value' => new DateTime(),
            ]),
        ];
    }

    public static function getUserFavorites(int $userId): array
    {
        $result = [];
        $rows = self::getList([
            'filter' => ['USER_ID' => $userId],
            'select' => ['PRODUCT_ID'],
        ]);
        while ($row = $rows->fetch()) {
            $result[] = (int)$row['PRODUCT_ID'];
        }
        return $result;
    }

    public static function addFavorite(int $userId, int $productId): void
    {
        $exists = self::getRow([
            'filter' => ['USER_ID' => $userId, 'PRODUCT_ID' => $productId],
        ]);
        if ($exists) {
            return;
        }
        self::add([
            'USER_ID' => $userId,
            'PRODUCT_ID' => $productId,
            'DATE_ADD' => new DateTime(),
        ]);
    }

    public static function removeFavorite(int $userId, int $productId): void
    {
        $row = self::getRow([
            'filter' => ['USER_ID' => $userId, 'PRODUCT_ID' => $productId],
        ]);
        if ($row) {
            self::delete($row['ID']);
        }
    }

    public static function isFavorite(int $userId, int $productId): bool
    {
        return (bool)self::getRow([
            'filter' => ['USER_ID' => $userId, 'PRODUCT_ID' => $productId],
            'select' => ['ID'],
        ]);
    }

    public static function syncFromCookie(int $userId, array $cookieIds): void
    {
        if (empty($cookieIds)) {
            return;
        }
        $existing = self::getUserFavorites($userId);
        foreach ($cookieIds as $id) {
            $id = (int)$id;
            if ($id <= 0) continue;
            if (!in_array($id, $existing)) {
                self::addFavorite($userId, $id);
            }
        }
    }
}
