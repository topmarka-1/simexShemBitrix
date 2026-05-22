<?php

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;
use Bitrix\Sale;
use Bitrix\Currency\CurrencyManager;

Loader::includeModule('sale');
Loader::includeModule('catalog');

$productId = (int)$_POST['id'];
$quantity = (float)($_POST['quantity'] ?? 1);

// Проверяем, есть ли цена у товара
$hasPrice = false;
$priceData = CPrice::GetBasePrice($productId);
if ($priceData && $priceData['PRICE'] !== null) {
    $hasPrice = true;
}

if (!$hasPrice) {
    try {
        $baseCurrency = CurrencyManager::getBaseCurrency();
        $fUserId = Sale\Fuser::getId();
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
        echo json_encode([
            'result' => true,
            'error' => null,
            'price_by_request' => true,
        ]);
        die;
    } catch (\Exception $e) {
        echo json_encode([
            'result' => false,
            'error' => 'Ошибка: ' . $e->getMessage(),
        ]);
        die;
    }
}

$result = Add2BasketByProductID($productId, $quantity);

if (!$result) {
    echo json_encode([
        'result' => false,
        'error' => $APPLICATION->GetException()
            ? $APPLICATION->GetException()->GetString()
            : 'Ошибка добавления товара',
    ]);
    die;
}

echo json_encode([
    'result' => $result,
    'error' => null,
]);