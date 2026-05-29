<?
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\HttpApplication;
use Bitrix\Main\Loader;
use Bitrix\Main\Config\Option;

Loc::loadMessages(__FILE__);

$gd_version = gd_info()["GD Version"];
if (empty($gd_version)) {
    echo CAdminMessage::ShowMessage(["TYPE" => "ERROR", "MESSAGE" => Loc::getMessage('CATART_WEBP_GD_ERROR')]);
    return false;
}

if (!function_exists('exif_imagetype')) {
    echo CAdminMessage::ShowMessage(["TYPE" => "ERROR", "MESSAGE" => Loc::getMessage('CATART_WEBP_EXIF_ERROR')]);
    return false;
}

$request = HttpApplication::getInstance()->getContext()->getRequest();

$module_id = htmlspecialcharsbx($request['mid'] != '' ? $request['mid'] : $request['id']);

Loader::includeModule($module_id);

$aTabs = [
    [
        'DIV'     => 'catartwebp',
        'TAB'     => Loc::getMessage('CATART_WEBP_OPTIONS_TAB_NAME'),
        'TITLE'   => Loc::getMessage('CATART_WEBP_OPTIONS_TAB_COMMON'),

        'OPTIONS' => [
            [
                'switch_on',
                Loc::getMessage('CATART_WEBP_OPTIONS_TAB_SWITCH_ON'),
                'N',
                ['checkbox']
            ],
            [
                'data_src',
                Loc::getMessage('CATART_WEBP_OPTIONS_TAB_DATA_SRC'),
                'N',
                ['checkbox']
            ],
            [
                'srcset',
                Loc::getMessage('CATART_WEBP_OPTIONS_TAB_SRCSET'),
                'N',
                ['checkbox']
            ],
            [
                'data_srcset',
                Loc::getMessage('CATART_WEBP_OPTIONS_TAB_DATA_SRCSET'),
                'N',
                ['checkbox']
            ],
            [
                'style',
                Loc::getMessage('CATART_WEBP_OPTIONS_TAB_STYLE'),
                'N',
                ['checkbox']
            ],
            [
                'folder',
                Loc::getMessage('CATART_WEBP_OPTIONS_TAB_FOLDER'),
                '/upload/webp/',
                ['text', 50]
            ],
            [
                'quality',
                Loc::getMessage('CATART_WEBP_OPTIONS_TAB_QUALITY'),
                '100',
                ['text', 50]
            ],
            [
                'ext_exclude',
                Loc::getMessage('CATART_WEBP_OPTIONS_TAB_EXCLUDE'),
                '.svg,.webp,.php,http://,https://',
                ['text', 50]
            ],
        ]
    ],
    [
        'DIV'     => 'catartwebp_support',
        'TAB'     => Loc::getMessage('CATART_WEBP_OPTIONS_TAB_SUPPORT_NAME'),
        'TITLE'   => Loc::getMessage('CATART_WEBP_OPTIONS_TAB_SUPPORT_NAME'),

        'OPTIONS' => [
            [
                'note' => Loc::getMessage('CATART_WEBP_OPTIONS_TAB_SUPPORT_INFO'),
            ],
            [
                'link',
                Loc::getMessage('CATART_WEBP_OPTIONS_TAB_SUPPORT_LINK'),
            ],
        ],
    ],
];

if ($request->isPost() && check_bitrix_sessid()) {
    foreach ($aTabs as $aTab) {
        foreach ($aTab['OPTIONS'] as $arOption) {
            if (!is_array($arOption)) {
                continue;
            }

            if ($arOption['note']) {
                continue;
            }

            if ($request['apply']) {
                $optionValue = $request->getPost($arOption[0]);

                if ($arOption[0] == 'switch_on') {
                    if ($optionValue == '') {
                        $optionValue = 'N';
                    }
                }

                if ($arOption[0] == 'data_src') {
                    if ($optionValue == '') {
                        $optionValue = 'N';
                    }
                }

                if ($arOption[0] == 'srcset') {
                    if ($optionValue == '') {
                        $optionValue = 'N';
                    }
                }

                if ($arOption[0] == 'style') {
                    if ($optionValue == '') {
                        $optionValue = 'N';
                    }
                }

                Option::set($module_id, $arOption[0], is_array($optionValue) ? implode(',', $optionValue) : $optionValue);
            } elseif ($request['default']) {
                Option::set($module_id, $arOption[0], $arOption[2]);
            }
        }
    }

    LocalRedirect($APPLICATION->GetCurPage() . '?mid=' . $module_id . '&lang=' . LANG);
}

$tabControl = new CAdminTabControl(
    'tabControl',
    $aTabs
);
$tabControl->Begin();
?>

<form action='<?=$APPLICATION->GetCurPage();?>?mid=<?=$module_id;?>&lang=<?=LANG;?>' method='post'>
    <?
    foreach ($aTabs as $aTab) {
        if ($aTab['OPTIONS'][0]) {
            $tabControl->BeginNextTab();
            __AdmSettingsDrawList($module_id, $aTab['OPTIONS']);
        }
    }

    $tabControl->Buttons();
    ?>

    <input type='submit' name='apply' value='<?=Loc::GetMessage('CATART_WEBP_OPTIONS_INPUT_APPLY');?>' class='adm-btn-save'>
    <input type='submit' name='default' value='<?=Loc::GetMessage('CATART_WEBP_OPTIONS_INPUT_DEFAULT');?>'>

    <?=bitrix_sessid_post();?>
</form>

<style>
    #catartwebp_support table tr:nth-of-type(2) td {
        width: 100% !important;
        text-align: center !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        let moduleOptionOn = document.querySelector('#catartwebp input[name="switch_on"]');
        let moduleOptions = document.querySelectorAll('#catartwebp *');

        for (let option of moduleOptions) {
            if (option.name != 'switch_on' && !moduleOptionOn.checked) {
                option.disabled = true;
            }
        }
    });
</script>

<?
$tabControl->End();
?>