/* ---------- POPUP ---------- */
function openPopup(selector) {
	var popup = $(selector);
	var popupContent = popup.find(".popup__content");
	$("body").addClass("hidden");
	popup.addClass("is-open");
	var tl = gsap.timeline();
	tl.to(selector, { opacity: 1, visibility: "visible", duration: 0.1, ease: "power1.out" })
		.to(popupContent, { translateX: 0, duration: 0.1, ease: "power1.out" })
		.then(function () {
			if (window.scroll) window.scroll.stop();
			var popupForm = popup.find("form");
			if (popupForm.length) {
				var firstInput = popupForm.find("input").not("[type=hidden]")[0];
				$(firstInput).focus();
			}
		});
}

function closePopup() {
	$("body").removeClass("hidden");
	$(".popup").removeClass("is-open");
	if (window.scroll) window.scroll.start();
	gsap.timeline()
		.to(".popup__content", { translateX: "100%", duration: 0.1, ease: "power1.out" })
		.to(".popup", { opacity: 0, duration: 0.1, ease: "power1.out" })
		.to(".popup", { visibility: "hidden", duration: 0, ease: "power1.out" });
}

/* ---------- MOBILE MENU ---------- */
function openMMenu() {
	var mm = document.querySelector(".mm");
	if (!mm) return;
	var mmBg = mm.querySelector(".mm__bg");
	var mmLayout = mm.querySelector(".mm__layout");
	document.body.classList.add("hidden");
	mm.classList.add("show");
	var tl = gsap.timeline();
	tl.to(mmBg, { opacity: 1, duration: 0.5 });
	tl.to(mmLayout, { translateX: "0%", duration: 0.5 }, "-=0.3");
}

function closeMMenu() {
	var mm = document.querySelector(".mm");
	if (!mm) return;
	var mmBg = mm.querySelector(".mm__bg");
	var mmLayout = mm.querySelector(".mm__layout");
	document.body.classList.remove("hidden");
	var tl = gsap.timeline();
	tl.to(mmLayout, { translateX: "-100%", duration: 0.5 });
	tl.to(mmBg, { opacity: 0, duration: 0.5 }, "-=0.3").then(function () {
		mm.classList.remove("show");
	});
}

/* ---------- DROPDOWN ---------- */
function toggleDropdown() {
	var dropdowns = document.querySelectorAll(".dropdown");
	if (!dropdowns.length) return;

	Array.from(dropdowns).forEach(function (dropdown) {
		var title = dropdown.querySelector(".dropdown__value");
		var list = dropdown.querySelector(".dropdown__list");
		var items = list.querySelectorAll(".dropdown__item");

		title.addEventListener("click", function (e) {
			if (window.getComputedStyle(list).position === "absolute") {
				dropdown.classList.toggle("active");
			}
		});

		Array.from(items).forEach(function (item) {
			item.addEventListener("click", function (e) {
				if (window.getComputedStyle(list).position !== "absolute") return;

				if (dropdown.classList.contains("multiple")) {
					var checkboxes = dropdown.querySelectorAll("input[type=checkbox]:checked");
					var values = Array.from(checkboxes).map(function (item) {
						return item.closest("label").querySelector("span.text").textContent;
					});
					var textEl = title.querySelector("span.text");
					var restEl = title.querySelector("span.rest");
					var defaultTitle = title.dataset.defaultTitle || "";
					textEl.textContent = values.length ? values.join(", ") : defaultTitle;
					if (restEl) {
						restEl.textContent = "";
						restEl.style.display = "none";
					}
				} else {
					var text = e.currentTarget.querySelector("span.text").textContent;
					title.querySelector("span.text").textContent = text;
					dropdown.classList.remove("active");
				}
			});
		});
	});

	document.addEventListener("click", function (e) {
		if (!e.target.closest(".dropdown")) {
			document.querySelectorAll(".dropdown").forEach(function (d) { d.classList.remove("active"); });
		}
	});
}

/* ---------- FILTER ---------- */
function showFilter() {
	var catalogFilter = document.querySelector(".catalog__filter");
	if (!catalogFilter) return;
	var btn = document.querySelector(".catalog__filter_toggle");
	if (btn) btn.addEventListener("click", function () {
		document.body.classList.add("hidden");
		catalogFilter.classList.add("active");
	});
}

function hideFilter() {
	var catalogFilter = document.querySelector(".catalog__filter");
	if (!catalogFilter) return;
	var btn = document.querySelector(".catalog__filter_close");
	if (btn) btn.addEventListener("click", function () {
		document.body.classList.remove("hidden");
		catalogFilter.classList.remove("active");
	});
}

/* ---------- ACCORDION ---------- */
function toggleAccordion() {
	var accordions = document.querySelectorAll(".accordion");
	if (!accordions.length) return;

	Array.from(accordions).forEach(function (acc) {
		var title = acc.querySelector(".accordion_title");
		var content = acc.querySelector(".accordion_content");
		var accBody = acc.querySelector(".accordion_body");
		if (!title || !content || !accBody) return;

		title.addEventListener("click", function () {
			var height = accBody.offsetHeight;
			if (acc.classList.contains("active")) {
				acc.classList.remove("active");
				gsap.to(content, { height: 0 });
			} else {
				acc.classList.add("active");
				gsap.to(content, { height: height + "px" });
			}
		});
	});
}

/* ---------- CLIPBOARD ---------- */
function clipboardCopy() {
	document.querySelectorAll(".copy-link").forEach(function (link) {
		link.addEventListener("click", function (e) {
			e.preventDefault();
			var text = e.currentTarget.dataset.copied;
			e.currentTarget.disabled = true;
			navigator.clipboard.writeText(text).then(function () {
				var tooltip = document.createElement("div");
				tooltip.className = "tooltip active";
				tooltip.textContent = "Скопировано!";
				tooltip.style.left = e.clientX + "px";
				tooltip.style.top = e.clientY - 5 + "px";
				document.body.appendChild(tooltip);
				setTimeout(function () {
					tooltip.classList.remove("active");
					document.body.removeChild(tooltip);
					e.currentTarget.disabled = false;
				}, 3000);
			});
		});
	});
}

/* ---------- SHARE ---------- */
function sharePage() {
	document.querySelectorAll(".share-btn").forEach(function (btn) {
		btn.addEventListener("click", function () {
			var url = location.href;
			var title = document.querySelector("title").textContent;
			if (navigator.share) {
				navigator.share({ title: title, url: url }).catch(function () { copyUrl(url); });
			} else {
				copyUrl(url);
			}
		});
	});
}

function copyUrl(text) {
	if (navigator.clipboard) {
		navigator.clipboard.writeText(text).then(function () { alert("Ссылка скопирована"); });
	} else {
		var ta = document.createElement("textarea");
		ta.value = text;
		ta.style.position = "fixed";
		ta.style.opacity = "0";
		document.body.appendChild(ta);
		ta.select();
		document.execCommand("copy");
		document.body.removeChild(ta);
		alert("Ссылка скопирована");
	}
}

/* ---------- TABS ---------- */
function toggleTabs() {
	var tabs = document.querySelectorAll(".tab");
	if (!tabs.length) return;
	tabs.forEach(function (btn) {
		btn.addEventListener("click", function () {
			var id = btn.dataset.tab;
			document.querySelectorAll(".tab").forEach(function (t) { t.classList.remove("active"); });
			document.querySelectorAll(".tab-content").forEach(function (c) { c.classList.remove("active"); });
			btn.classList.add("active");
			var content = document.querySelector('[data-content="' + id + '"]');
			if (content) content.classList.add("active");
		});
	});
}

/* ---------- COUNTER ---------- */
function setCounterValue() {
	document.querySelectorAll(".counter").forEach(function (counter) {
		counter.addEventListener("click", function (e) {
			if (e.target.closest(".inc") || e.target.closest(".dec")) {
				e.preventDefault();
				var input = counter.querySelector(".counter_value");
				if (!input) return;
				if (e.target.closest(".inc")) input.value++;
				if (e.target.closest(".dec")) input.value = input.value > 0 ? input.value - 1 : 0;
			}
		});
	});
}
