<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Sale\Order;
use Bitrix\Sale\Basket;

// Проверяем авторизацию и модули
global $USER;
if (!$USER->IsAuthorized() || !Loader::includeModule('sale') || !Loader::includeModule('catalog')) {
    return;
}

$userId = (int)$USER->GetID();
$purchasedProductIds = [];

// 1. Получаем ID заказов пользователя со статусом "Оплачен" или "Выполнен"
// Вы можете адаптировать фильтр по STATUS_ID под свои бизнес-процессы (например, STATUS_ID => 'F')
$ordersParams = [
    'select' => ['ID'],
    'filter' => [
        '=USER_ID' => $userId,
        '=PAYED' => 'Y', // Берем только оплаченные заказы
    ],
    'order' => ['DATE_INSERT' => 'DESC']
];

$dbOrders = Order::getList($ordersParams);
$orderIds = [];
while ($order = $dbOrders->fetch()) {
    $orderIds[] = $order['ID'];
}

// 2. Если заказы найдены, вытаскиваем из них ID товаров
if (!empty($orderIds)) {
    $basketParams = [
        'select' => ['PRODUCT_ID'],
        'filter' => [
            '=ORDER_ID' => $orderIds
        ]
    ];

    $dbBasket = Basket::getList($basketParams);
    while ($basketItem = $dbBasket->fetch()) {
        $purchasedProductIds[] = (int)$basketItem['PRODUCT_ID'];
    }

    // Убираем дубликаты ID
    $purchasedProductIds = array_unique($purchasedProductIds);
}

// 3. (Опционально) Исключаем товары, которые уже добавлены в текущую корзину
if (!empty($purchasedProductIds)) {
    $currentBasket = Basket::loadItemsForFUser(\Bitrix\Sale\Fuser::getId(), \Bitrix\Main\Context::getCurrent()->getSite());
    foreach ($currentBasket as $basketItem) {
        $currentBasketProductId = (int)$basketItem->getProductId();
        if (($key = array_search($currentBasketProductId, $purchasedProductIds)) !== false) {
            unset($purchasedProductIds[$key]);
        }
    }
}

// Если массив пустой, прерываем выполнение (пользователь ничего не покупал ранее)
if (empty($purchasedProductIds)) {
    $GLOBALS['arrPurchasedFilter'] = [
        'ID' => false
    ];
    return;
}

// Передаем массив в глобальный фильтр для компонента
$GLOBALS['arrPurchasedFilter'] = [
    '=ID' => $purchasedProductIds
];
