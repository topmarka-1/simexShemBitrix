document.addEventListener("DOMContentLoaded", function(){
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
