<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

use Bitrix\Main\Loader;

if (!Loader::includeModule('iblock'))
{
    echo json_encode([]);
    die();
}

$q = trim($_GET['q'] ?? '');
if (strlen($q) < 2)
{
    echo json_encode([]);
    die();
}

$sectionId = (int)($_GET['section_id'] ?? 0);
$sectionCode = trim($_GET['section_code'] ?? '');

$arFilter = array(
    'IBLOCK_ID' => 14,
    'ACTIVE' => 'Y',
    '?NAME' => '%'.$q.'%',
);

if ($sectionId > 0)
{
    $arFilter['SECTION_ID'] = $sectionId;
    $arFilter['INCLUDE_SUBSECTIONS'] = 'Y';
}
elseif ($sectionCode)
{
    $arFilter['SECTION_CODE'] = $sectionCode;
    $arFilter['INCLUDE_SUBSECTIONS'] = 'Y';
}

$dbRes = CIBlockElement::GetList(
    array('NAME' => 'ASC'),
    $arFilter,
    false,
    array('nTopCount' => 10),
    array('ID', 'NAME')
);

$result = array();
while ($arItem = $dbRes->GetNext())
{
    $result[] = array(
        'ID' => $arItem['ID'],
        'NAME' => $arItem['NAME'],
    );
}

echo json_encode($result);
