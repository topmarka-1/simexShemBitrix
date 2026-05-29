function initScrollAnimations() {
	var els = document.querySelectorAll(
		".anim-fade-in, .anim-fade-in-up, .anim-fade-in-left, .anim-fade-in-right, .anim-scale-in, .anim-stagger, .anim-counter"
	);
	if (!els.length) return;

	var observer = new IntersectionObserver(function (entries) {
		entries.forEach(function (entry) {
			if (entry.isIntersecting) {
				entry.target.classList.add("anim-visible");
				observer.unobserve(entry.target);
			}
		});
	}, { threshold: 0.15 });

	els.forEach(function (el) { observer.observe(el); });
}

function initCounters() {
	var counters = document.querySelectorAll("[data-counter-target]");
	if (!counters.length) return;

	counters.forEach(function (counter) {
		var target = parseInt(counter.dataset.counterTarget, 10);
		if (isNaN(target)) return;

		var observer = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting && !counter.dataset.counted) {
					counter.dataset.counted = "true";
					counter.classList.add("anim-visible");
					animateNumber(counter, target);
					observer.unobserve(counter);
				}
			});
		}, { threshold: 0.5 });

		observer.observe(counter);
	});
}

function animateNumber(el, target) {
	var isFloat = target % 1 !== 0;
	var duration = Math.min(Math.max(target * 0.02, 0.8), 3);
	var start = { val: 0 };
	gsap.to(start, {
		val: target, duration: duration, ease: "power2.out",
		onUpdate: function () {
			el.textContent = isFloat ? start.val.toFixed(1) : Math.round(start.val).toString();
		},
	});
}
