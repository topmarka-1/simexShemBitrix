<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Sale;

Loader::includeModule('sale');

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

$basket = Sale\Basket::loadItemsForFUser(
    Sale\Fuser::getId(),
    defined('SITE_ID') ? SITE_ID : 's1'
);

$basketItems = [];
foreach ($basket as $basketItem)
{
    $basketItems[$basketItem->getProductId()] = $basketItem->getQuantity();
}

$arResult['BASKET_QUANTITY'] = $basketItems[$arResult['ID']] ?? 0;
