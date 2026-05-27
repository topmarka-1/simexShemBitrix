<? if ($APPLICATION->GetCurPage(false) == SITE_DIR) { ?>
<span class="logo"> 
    <img src="<?=SITE_TEMPLATE_PATH?>/assets/img/icons/simex-logo-dark.svg" width="148"
            height="58" loading="lazy" alt="logo image"> 
</span>
<? } else { ?>
<a href="/" class="logo"> 
    <img src="<?=SITE_TEMPLATE_PATH?>/assets/img/icons/simex-logo-dark.svg" width="148"
            height="58" loading="lazy" alt="logo image"> 
</a>
<? } ?>