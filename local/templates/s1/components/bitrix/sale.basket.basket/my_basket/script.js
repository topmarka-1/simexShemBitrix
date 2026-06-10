document.addEventListener("DOMContentLoaded", function(){
    const buildButtons = document.querySelectorAll('.build-btn')

    if (buildButtons.length) {

        const catalogLists = document.querySelectorAll('.catalog__list')

        buildButtons.forEach(btn => {
            btn.addEventListener('click', e => {
                const buildType = btn.dataset.build

                buildButtons.forEach(item => item.classList.remove('active'))

                btn.classList.add('active')
                catalogLists.forEach(item => {
                    if (item.classList.contains(buildType)) {
                        item.classList.add('active')
                    } else {
                        item.classList.remove('active')
                    }
                })
            })
        })
    }

    const basketRoot = document.getElementById('basket-root')
    if (basketRoot) {
        basketRoot.addEventListener('click', function(e) {
            const clearBtn = e.target.closest('.js-clear-cart')
            if (!clearBtn) return

            if (!confirm('Вы уверены, что хотите очистить корзину?')) return

            BX.ajax({
                url: '/local/ajax/cart.php',
                method: 'POST',
                data: { action: 'clear' },
                onsuccess: function() {
                    location.reload()
                },
                onfailure: function() {
                    alert('Ошибка при очистке корзины')
                }
            })
        })
    }
})