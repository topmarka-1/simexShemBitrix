document.addEventListener('DOMContentLoaded', ()=>{
    const brands = document.querySelectorAll('.brands__item')

    if (brands.length) {
        brands.forEach(brand => {
            brand.addEventListener('mouseover', (e) => {
                e.stopPropagation()
                // console.log('over');
                if (e.target.classList.contains('brands__item')){
                const image = brand.querySelector('img')
                image.style.opacity = '0'
                    const colorSrc = brand.dataset.srcColor
                setTimeout(() => {
                    image.src = colorSrc
                    image.style.opacity = '1';
                }, 300);
                }
            })
            brand.addEventListener('mouseout', (e) => {
                e.stopPropagation()
                if (e.target.classList.contains('brands__item')){
                const image = brand.querySelector('img')
                const src = brand.dataset.src
                image.style.opacity = '0';
                setTimeout(() => {
                  image.src = src  
                  image.style.opacity = '1';
                }, 300);
                }
            })
        })
    }
})