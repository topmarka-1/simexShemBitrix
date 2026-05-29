document.addEventListener('DOMContentLoaded', function () {
	document.querySelectorAll('.brands__item').forEach(function (brand) {
		brand.addEventListener('mouseover', function (e) {
			e.stopPropagation();
			if (e.target.classList.contains('brands__item')) {
				var img = brand.querySelector('img');
				img.style.opacity = '0';
				setTimeout(function () {
					img.src = brand.dataset.srcColor;
					img.style.opacity = '1';
				}, 300);
			}
		});
		brand.addEventListener('mouseout', function (e) {
			e.stopPropagation();
			if (e.target.classList.contains('brands__item')) {
				var img = brand.querySelector('img');
				img.style.opacity = '0';
				setTimeout(function () {
					img.src = brand.dataset.src;
					img.style.opacity = '1';
				}, 300);
			}
		});
	});
});
