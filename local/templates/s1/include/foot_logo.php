<div class="footer__left"> 
    <? if ($APPLICATION->GetCurPage(false) == SITE_DIR) { ?>
    <span class="logo"> 
        <img src="<?=SITE_TEMPLATE_PATH?>/assets/img/icons/simex-logo.svg"
                                    width="112" height="44" loading="lazy" alt="logo image"> 
    </span> 
    <? } else { ?> 
        <a href="/" class="logo"> 
        <img src="<?=SITE_TEMPLATE_PATH?>/assets/img/icons/simex-logo.svg"
                                    width="112" height="44" loading="lazy" alt="logo image"> 
        </a>
    <? } ?>
</div>