<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogTopComponent $component
 */
use Bitrix\Main\Loader;
use Bitrix\Sale;

Loader::includeModule('sale');

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

$basket = Sale\Basket::loadItemsForFUser(
    Sale\Fuser::getId(),
    SITE_ID
);

$basketItems = [];

foreach ($basket as $basketItem)
{
    $basketItems[$basketItem->getProductId()] =
        $basketItem->getQuantity();
}

foreach ($arResult['ITEMS'] as &$row)
{
    foreach ($row as &$item)
    {
        $item['BASKET_QUANTITY'] =
            $basketItems[$item['ID']] ?? 0;
    }
}