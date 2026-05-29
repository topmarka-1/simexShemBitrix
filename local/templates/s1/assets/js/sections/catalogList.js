document.addEventListener("DOMContentLoaded", function () {
	/* ---------- build buttons ---------- */
	var buildButtons = document.querySelectorAll('.build-btn');
	if (buildButtons.length) {
		var catalogLists = document.querySelectorAll('.catalog__list');
		buildButtons.forEach(function (btn) {
			btn.addEventListener('click', function (e) {
				var buildType = btn.dataset.build;
				buildButtons.forEach(function (item) { item.classList.remove('active'); });
				btn.classList.add('active');
				catalogLists.forEach(function (item) {
					item.classList.toggle('active', item.classList.contains(buildType));
				});
			});
		});
	}

	/* ---------- range slider ---------- */
	document.querySelectorAll('.filter-range').forEach(function (range) {
		var minInput = range.querySelector('.filter-range__values_input--min');
		var maxInput = range.querySelector('.filter-range__values_input--max');
		var rangeMin = range.querySelector('.filter-range__input--min');
		var rangeMax = range.querySelector('.filter-range__input--max');
		var fill = range.querySelector('.filter-range__slider_fill');
		if (!rangeMin || !rangeMax) return;

		function updateSlider() {
			var minVal = parseFloat(rangeMin.value);
			var maxVal = parseFloat(rangeMax.value);
			var min = parseFloat(rangeMin.min);
			var max = parseFloat(rangeMax.max);
			var pMin = ((minVal - min) / (max - min)) * 100;
			var pMax = ((maxVal - min) / (max - min)) * 100;
			fill.style.left = pMin + '%';
			fill.style.width = (pMax - pMin) + '%';
			if (minInput) minInput.value = minVal;
			if (maxInput) maxInput.value = maxVal;
		}

		rangeMin.addEventListener('input', function () {
			if (parseFloat(this.value) > parseFloat(rangeMax.value)) this.value = rangeMax.value;
			updateSlider();
		});
		rangeMax.addEventListener('input', function () {
			if (parseFloat(this.value) < parseFloat(rangeMin.value)) this.value = rangeMin.value;
			updateSlider();
		});
		if (minInput) {
			minInput.addEventListener('change', function () {
				var v = parseFloat(this.value) || parseFloat(rangeMin.min);
				v = Math.max(v, parseFloat(rangeMin.min));
				v = Math.min(v, parseFloat(rangeMax.value));
				rangeMin.value = v;
				updateSlider();
			});
		}
		if (maxInput) {
			maxInput.addEventListener('change', function () {
				var v = parseFloat(this.value) || parseFloat(rangeMax.max);
				v = Math.min(v, parseFloat(rangeMax.max));
				v = Math.max(v, parseFloat(rangeMin.value));
				rangeMax.value = v;
				updateSlider();
			});
		}
		updateSlider();
	});
});
