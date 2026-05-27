<div class="mm">
    <div class="mm__bg"></div>
    <div class="mm__layout">
        <div class="mm__head">

            <a href="/" class="logo">
                <img src="<?=SITE_TEMPLATE_PATH ?>/assets/img/icons/simex-logo.svg" width="112" height="44" loading="lazy" alt="logo image">
            </a>
            <button class="btn close_btn btn-sm btn-quad accent">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M11.6767 14L0 2.33046L2.32326 0.00863042L14 11.6782L11.6767 14ZM2.32326 13.9914L5.79853e-07 11.6695L11.6767 0L14 2.32182L2.32326 13.9914Z"
                        fill="CurrentColor" />
                </svg>
            </button>
        </div>
        <?$APPLICATION->IncludeComponent(
            "bitrix:menu",
            "mobile_menu",
            Array(
            "ALLOW_MULTI_SELECT" => "N",
            "CHILD_MENU_TYPE" => "left",
            "DELAY" => "N",
            "MAX_LEVEL" => "1",
            "MENU_CACHE_GET_VARS" => array(""),
            "MENU_CACHE_TIME" => "3600",
            "MENU_CACHE_TYPE" => "N",
            "MENU_CACHE_USE_GROUPS" => "Y",
            "ROOT_MENU_TYPE" => "top",
            "USE_EXT" => "N"
            )
        );?>
        
        <div class="mm__foot">

            <?
                            $APPLICATION->IncludeFile(
                                SITE_TEMPLATE_PATH . '/include/subscribe_contacts.php',
                                [],
                                [
                                    'MODE'      => 'php',
                                ]
                            );
                        ?>
            <?
                            $APPLICATION->IncludeFile(
                                SITE_TEMPLATE_PATH . '/include/subscribeMobile.php',
                                [],
                                [
                                    'MODE'      => 'php',
                                ]
                            );
                        ?>
        </div>
    </div>
</div>