document.addEventListener('addFavourite', function(e) {
    // fetch('/favorites').then(res => res.text()).then(data=>{
        
    // })
    // https://dev.1c-bitrix.ru/api_help/js_lib/ajax/bx_ajax.php
    BX.ajax({
            url: '/favorites/',
            method: 'GET',
            dataType: 'html', // html|json|script – данные какого типа предполагаются в ответе
            timeout: 30,
            async: true,
            processData: true, // нужно ли сразу обрабатывать данные?
            scriptsRunFirst: true, // нужно ли выполнять все найденные скрипты перед тем, как отдавать сожеримое обработчику или только те, в тэге которых присутствует атрибут bxrunfirst
            emulateOnload: true, // нужно ли эмулировать событие window.onload для загруженных скриптов
            start: true, // отправить ли запрос сразу или он будет запущен вручную
            cache: false, // в случае значения false к параметру URL будет добавляться случайный кусок, чтобы избежать браузерного кэширования
            onsuccess: (data) => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(data, 'text/html');
                // console.log(doc);
                const favoritesElems = doc.querySelector('.personal__favorites')
                const oldFavorites = document.querySelector('.personal__favorites')
                // console.log(data);
                oldFavorites.replaceWith(favoritesElems);
                document.querySelectorAll('.favourite_btn[data-item]').forEach(function (btn) {
                    var id = parseInt(btn.getAttribute('data-item'));
                    if (e.detail.favorites.indexOf(id) !== -1) btn.classList.add('active');
                });
            },
        });
})