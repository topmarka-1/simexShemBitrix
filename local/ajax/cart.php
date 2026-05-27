<?php

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;
use Bitrix\Main\Context;
use Bitrix\Sale;
use Bitrix\Currency\CurrencyManager;

global $APPLICATION;

Loader::includeModule('sale');
Loader::includeModule('catalog');

$request = Context::getCurrent()->getRequest();

$action = $request->getPost('action');

$response = [
    'success' => false,
    'error' => null,
];

try {

    $fUserId = Sale\Fuser::getId();

    $basket = Sale\Basket::loadItemsForFUser(
        $fUserId,
        SITE_ID
    );

    switch ($action) {

        /*
         * Добавление товара
         */
        case 'add':

            $productId = (int)$request->getPost('id');
            $quantity = (float)$request->getPost('quantity');

            if ($quantity <= 0) {
                $quantity = 1;
            }

            // Проверяем, есть ли цена у товара
            $hasPrice = false;
            $priceData = CPrice::GetBasePrice($productId);
            if ($priceData && $priceData['PRICE'] !== null) {
                $hasPrice = true;
            }

            if (!$hasPrice) {
                try {
                    $baseCurrency = CurrencyManager::getBaseCurrency();
                    $basket = Sale\Basket::loadItemsForFUser($fUserId, SITE_ID);
                    $item = $basket->createItem('catalog', $productId);
                    $item->setFields([
                        'QUANTITY' => $quantity,
                        'CURRENCY' => $baseCurrency,
                        'LID' => SITE_ID,
                        'PRICE' => 0,
                        'CUSTOM_PRICE' => 'Y',
                    ]);
                    $r = $item->save();
                    if (!$r->isSuccess()) {
                        throw new Exception(implode('; ', $r->getErrorMessages()));
                    }
                    $basket = Sale\Basket::loadItemsForFUser($fUserId, SITE_ID);
                    $response['success'] = true;
                    break;
                } catch (\Exception $e) {
                    throw new Exception('Ошибка: ' . $e->getMessage());
                }
            }

            $result = Add2BasketByProductID($productId, $quantity);

            if (!$result) {
                throw new Exception(
                    $APPLICATION->GetException()
                        ? $APPLICATION->GetException()->GetString()
                        : 'Ошибка добавления товара'
                );
            }

            // Перезагружаем корзину
            $basket = Sale\Basket::loadItemsForFUser(
                $fUserId,
                SITE_ID
            );

            $response['success'] = true;

            break;

        /*
         * Изменение количества
         */
        case 'update':

            $basketItemId = (int)$request->getPost('id');
            $quantity = (float)$request->getPost('quantity');

            if ($quantity <= 0) {
                $quantity = 1;
            }

            $updated = false;
            foreach ($basket as $basketItem)
            {
                if ($basketItem->getProductId() == $basketItemId) {
                    $basketItem->setField('QUANTITY', $quantity);
                    $updated = true;
                }
            }

            if (!$updated) {
                throw new Exception('Товар корзины не найден');
            }

            $basket->save();

            $response['success'] = true;

            break;

        /*
         * Удаление товара
         */
        case 'delete':

            $productId = (int)$request->getPost('id');

            $deleted = false;

            foreach ($basket as $basketItem)
            {
                if ($basketItem->getProductId() == $productId)
                {
                    $basketItem->delete();
                    $deleted = true;
                }
            }

            if (!$deleted) {
                throw new Exception('Товар корзины не найден');
            }

            $basket->save();

            $response['success'] = true;

            break;
        /*
         * Очистка корзины
         */
        case 'clear':

            foreach ($basket as $item) {
                $item->delete();
            }

            $basket->save();

            $response['success'] = true;

            break;

        default:
            throw new Exception('Неизвестное действие');
    }

    /*
     * Количество товаров
     */
    $totalQuantity = 0;

    foreach ($basket as $basketItem) {
        $totalQuantity += $basketItem->getQuantity();
    }

    /*
     * Данные корзины
     */
    $basketData = [];

    foreach ($basket as $basketItem) {

        $basketData[] = [
            'basket_id' => $basketItem->getId(),
            'product_id' => $basketItem->getProductId(),
            'name' => $basketItem->getField('NAME'),
            'quantity' => $basketItem->getQuantity(),
            'price' => $basketItem->getPrice(),
            'sum' => $basketItem->getFinalPrice(),
        ];
    }

    $response['count'] = $totalQuantity;

    $response['sum'] = Sale\PriceMaths::roundPrecision(
        $basket->getPrice()
    );

    $response['basket'] = $basketData;

} catch (Exception $e) {

    $response['error'] = $e->getMessage();
}

header('Content-Type: application/json');

echo json_encode($response);