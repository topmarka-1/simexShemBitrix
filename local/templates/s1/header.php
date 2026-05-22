<? $isMainPage = $APPLICATION->GetCurPage(false) == '/';?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="robots" content="noindex,nofollow">
    <link rel="shortcut icon" href="<?=SITE_TEMPLATE_PATH?>/assets/img/favicon/favicon.svg" type="image/x-icon">
    
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <?$APPLICATION->ShowHead();?>
<title><?$APPLICATION->ShowTitle()?></title>
</head>
<div id="panel" style="position:fixed;left:0;right:0;bottom:0;z-index:100;">
	<? $APPLICATION->ShowPanel(); ?>
</div>
<body>
    <div id="wrapper" class="wrapper <?= $isMainPage ? 'index' : '' ?>">
        <header class="header <? $isMainPage ? 'index' : '' ?>">
            <div class="container">
                <div class="header__row">
                    <div class="header__col"> 
                                <button class="btn btn-sm btn-quad primary burger_btn"> 
                                    <span class="lines"> 
                                        <span class="line"></span>
                                        <span class="line"></span> 
                                    </span> 
                                </button> 
                                <? $APPLICATION->IncludeFile(
                                    SITE_TEMPLATE_PATH . '/include/head_logo.php',
                                    [],
                                    [
                                        'MODE'      => 'html',
                                    ]
                                ); ?>
                            </div>
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:menu",
                                    "head_menu",
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
                        
                    <div class="header__col"> 
                        <?
                            $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include/head_phone.php');
                        ?>
                        <?
                            $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include/head_links.php',
                            [],
                            [
                            "MODE" => "php"
                            ]);
                        ?>
                        
                    </div>
                </div>
            </div>
        </header>
        <div class="header fixed">
            <div class="container">
                <div class="header__row">
                    <div class="header__col"> <button class="btn btn-sm btn-quad primary burger_btn"> <span
                                class="lines"> <span class="line"></span><span class="line"></span> </span> </button> <a
                                href="/" class="logo"> <img src="<?=SITE_TEMPLATE_PATH?>/assets/img/icons/simex-logo-dark.svg" width="148"
                                height="58" loading="lazy" alt="logo image"> </a> </div>
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:menu",
                                "head_menu",
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
                    <div class="header__col">
                        <?
                            $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include/head_phone.php');
                        ?>
                        <?
                            $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include/head_links.php',
                            [],
                            [
                            "MODE" => "php"
                            ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="scroll-trigger"></div>
        <? if (!$isMainPage) : ?>
            <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", Array(
                "PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                    "SITE_ID" => "s1",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                    "START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
                    "COMPONENT_TEMPLATE" => ".default"
                ),
                false
            );?>
        <? endif; ?>
        <main class="main">
            