function debounce(func, wait) {
	let timeout;
	return function executedFunction(...args) {
		const later = () => {
			clearTimeout(timeout);
			func(...args);
		};
		clearTimeout(timeout);
		timeout = setTimeout(later, wait);
	};
}

function throttle(func, limit) {
	let inThrottle;
	return function () {
		const args = arguments;
		const context = this;
		if (!inThrottle) {
			func.apply(context, args);
			inThrottle = true;
			setTimeout(() => (inThrottle = false), limit);
		}
	};
}

function formatValueInput(elem, regexp) {
	return elem.value.replace(regexp, "");
}

function testValue(elem, reg, string) {
	const $elem = $(elem);
	const $errElem = $elem.closest("label").find("span.error");
	const str = $elem.val();

	if ($elem.attr("data-reg") !== "true") return;

	if (!str.length) {
		$errElem.text("Заполните это поле").addClass("show");
		$elem.addClass("error").attr("data-test", "false");
	} else if (!reg.test(str)) {
		$errElem.text(string);
		$elem.addClass("error").attr("data-test", "false");
	} else {
		$elem.removeClass("error").attr("data-test", "true");
		$errElem.text("");
	}
}

var ease = {
	exponentialIn: (t) => { return t == 0.0 ? t : Math.pow(2.0, 10.0 * (t - 1.0)); },
	exponentialOut: (t) => { return t == 1.0 ? t : 1.0 - Math.pow(2.0, -10.0 * t); },
	exponentialInOut: (t) => { return t == 0.0 || t == 1.0 ? t : t < 0.5 ? +0.5 * Math.pow(2.0, 20.0 * t - 10.0) : -0.5 * Math.pow(2.0, 10.0 - t * 20.0) + 1.0; },
	sineOut: (t) => { return Math.sin(t * 1.5707963267948966); },
	circularInOut: (t) => { return t < 0.5 ? 0.5 * (1.0 - Math.sqrt(1.0 - 4.0 * t * t)) : 0.5 * (Math.sqrt((3.0 - 2.0 * t) * (2.0 * t - 1.0)) + 1.0); },
	cubicIn: (t) => { return t * t * t; },
	cubicOut: (t) => { const f = t - 1.0; return f * f * f + 1.0; },
	cubicInOut: (t) => { return t < 0.5 ? 4.0 * t * t * t : 0.5 * Math.pow(2.0 * t - 2.0, 3.0) + 1.0; },
	quadraticOut: (t) => { return -t * (t - 2.0); },
	quarticOut: (t) => { return Math.pow(t - 1.0, 3.0) * (1.0 - t) + 1.0; },
};

function getUtils() {
	return { debounce, throttle, formatValueInput, testValue };
}
