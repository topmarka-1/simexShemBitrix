<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$isAjax = ($_SERVER['HTTP_X_BX_AJAX'] ?? '') === 'Y';
if ($isAjax) return;

?>
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    var nav = document.querySelector('[data-ajax-nav]');
    var content = document.querySelector('[data-ajax-content]:not([data-ajax-content-initialized])');
    if (!nav || !content) return;

    content.setAttribute('data-ajax-content-initialized', '1');

    function reinitScripts(container) {
        container.querySelectorAll('script').forEach(function(oldScript) {
            var text = oldScript.textContent || '';
            if (text.indexOf('setCurrencies') !== -1) return;
            if (text.indexOf('document.addEventListener') !== -1 && text.indexOf('js-add-to-cart') !== -1) return;
            if (text.indexOf('JCCatalogSectionComponent') !== -1) return;
            var newScript = document.createElement('script');
            Array.from(oldScript.attributes).forEach(function(attr) {
                newScript.setAttribute(attr.name, attr.value);
            });
            newScript.textContent = text;
            oldScript.parentNode.replaceChild(newScript, oldScript);
        });
    }

    function createCounterHTML(id, qty) {
        return '<div class="counter">'
            + '<button class="btn btn-quad grey dec"><svg width="12" height="3" viewBox="0 0 12 3" fill="none"><path d="M0 3V0H12V3H0Z" fill="black"></path></svg></button>'
            + '<input type="text" name="quantity" class="btn btn-quad counter_value" value="' + qty + '">'
            + '<button class="btn btn-quad grey inc"><svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M5.03736 12V6.96264H0V5.02418H5.03736V0H6.97582V5.02418H12V6.96264H6.97582V12H5.03736Z" fill="black"></path></svg></button></div>'
            + '<button class="btn btn-grey js-remove-to-cart" data-id="' + id + '">Убрать из корзины</button>';
    }

    function createAddButtonHTML(id) {
        return '<button class="btn btn-primary js-add-to-cart" data-id="' + id + '">Добавить в корзину</button>';
    }

    function initCartHandlers() {
        document.removeEventListener('click', cartClickHandler, true);
        document.addEventListener('click', cartClickHandler, true);
    }

    function cartClickHandler(e) {
        var btn = e.target.closest('.js-add-to-cart, .js-remove-to-cart, .dec, .inc');
        if (!btn || !btn.closest('[data-ajax-content]')) return;
        e.stopImmediatePropagation();
        e.preventDefault();

        var card = e.target.closest('.card');
        var cardBottom = card ? card.querySelector('.catalog__item_bottom') : null;
        var counter = card ? card.querySelector('[name=quantity]') : null;
        var qty;

        btn = e.target.closest('.js-add-to-cart');
        if (btn) {
            btn.disabled = true;
            BX.ajax({
                url: '/local/ajax/cart.php',
                method: 'POST',
                dataType: 'json',
                data: { action: 'add', id: btn.dataset.id, quantity: 1 },
                onsuccess: function(res) {
                    if (res && res.success && cardBottom) {
                        cardBottom.innerHTML = createCounterHTML(btn.dataset.id, 1);
                    }
                    BX.onCustomEvent('OnBasketChange');
                }
            });
            return;
        }

        btn = e.target.closest('.js-remove-to-cart');
        if (btn) {
            btn.disabled = true;
            BX.ajax({
                url: '/local/ajax/cart.php',
                method: 'POST',
                dataType: 'json',
                data: { action: 'delete', id: btn.dataset.id },
                onsuccess: function(res) {
                    if (res && res.success && cardBottom) {
                        cardBottom.innerHTML = createAddButtonHTML(btn.dataset.id);
                    }
                    BX.onCustomEvent('OnBasketChange');
                }
            });
            return;
        }

        btn = e.target.closest('.dec');
        if (btn) {
            if (!counter) return;
            qty = parseInt(counter.value);
            if (qty <= 1) {
                BX.ajax({
                    url: '/local/ajax/cart.php',
                    method: 'POST',
                    dataType: 'json',
                    data: { action: 'delete', id: card.dataset.basketId },
                    onsuccess: function(res) {
                        if (res && res.success && cardBottom) {
                            cardBottom.innerHTML = createAddButtonHTML(card.dataset.basketId);
                        }
                        BX.onCustomEvent('OnBasketChange');
                    }
                });
            } else {
                counter.value = qty - 1;
                BX.ajax({
                    url: '/local/ajax/cart.php',
                    method: 'POST',
                    dataType: 'json',
                    data: { action: 'update', id: card.dataset.basketId, quantity: counter.value },
                    onsuccess: function() { BX.onCustomEvent('OnBasketChange'); }
                });
            }
            return;
        }

        btn = e.target.closest('.inc');
        if (btn) {
            if (!counter) return;
            counter.value = parseInt(counter.value) + 1;
            BX.ajax({
                url: '/local/ajax/cart.php',
                method: 'POST',
                dataType: 'json',
                data: { action: 'update', id: card.dataset.basketId, quantity: counter.value },
                onsuccess: function() { BX.onCustomEvent('OnBasketChange'); }
            });
            return;
        }
    }

    function loadCSS(href) {
        if (!document.querySelector('link[href="' + href + '"]')) {
            var link = document.createElement('link');
            link.rel = 'stylesheet';
            link.href = href;
            document.head.appendChild(link);
        }
    }

    function reinitFavorites() {
        loadCSS('/local/components/custom/favorites.elements/templates/.default/style.css');
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/local/ajax/favourite.php?action=list', true);
        xhr.withCredentials = true;
        xhr.onload = function() {
            if (xhr.status !== 200) return;
            try {
                var data = JSON.parse(xhr.responseText);
                if (!data.success) return;
                document.querySelectorAll('.favourite_btn[data-item]').forEach(function(btn) {
                    var id = parseInt(btn.getAttribute('data-item'));
                    if (data.favorites.indexOf(id) !== -1) btn.classList.add('active');
                });
            } catch(e) {}
        };
        xhr.send();
    }

    initCartHandlers();

    function reinitPersonalUI() {
        if (typeof initNewCatalogSlider === 'function') initNewCatalogSlider();
        if (typeof inithistoryOrderSliders === 'function') inithistoryOrderSliders();
        if (typeof toggleAccordion === 'function') toggleAccordion();
        if (typeof initScrollAnimations === 'function') initScrollAnimations();
        if (typeof textHandler === 'function') textHandler();
        reinitFavorites();
        initCartHandlers();
    }

    function loadContent(url) {
        var req = new XMLHttpRequest();
        req.open('GET', url, true);
        req.setRequestHeader('X-BX-Ajax', 'Y');
        req.onload = function() {
            if (req.status !== 200) return;

            var parser = new DOMParser();
            var doc = parser.parseFromString(req.responseText, 'text/html');
            var newContent = doc.querySelector('[data-ajax-content]');

            if (newContent) {
                content.innerHTML = newContent.innerHTML;
            } else {
                content.innerHTML = req.responseText;
            }
            reinitScripts(content);
            reinitPersonalUI();

            nav.querySelectorAll('a').forEach(function(a) { a.classList.remove('active'); });
            var activeLink = nav.querySelector('a[href="' + url.replace(window.location.origin, '') + '"]');
            if (activeLink) activeLink.classList.add('active');

            window.scrollTo({ top: 0, behavior: 'smooth' });
        };
        req.send();
    }

    nav.addEventListener('click', function(e) {
        var link = e.target.closest('a');
        if (!link) return;
        if (link.getAttribute('data-ajax') !== 'true') return;
        var url = link.getAttribute('href');
        if (!url || url === '#' || (url.startsWith('http') && !url.startsWith(window.location.origin))) return;
        e.preventDefault();
        if (url === window.location.pathname + window.location.search + window.location.hash) return;

        history.pushState({ url: url }, '', url);
        loadContent(url);
    });

    window.addEventListener('popstate', function(e) {
        var url = e.state && e.state.url ? e.state.url : window.location.pathname;
        loadContent(url);
    });
})();
</script>
