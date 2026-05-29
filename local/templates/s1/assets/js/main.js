function setVhCssVar() {
	var vh = window.innerHeight * 0.01;
	document.documentElement.style.setProperty("--vh", vh + "px");
}

setVhCssVar();
window.visualViewport.addEventListener("resize", setVhCssVar);

document.addEventListener("DOMContentLoaded", function () {
	if (document.querySelector(".hero__images_slider")) initHeroSlider();
	if (document.querySelector(".brands__list.swiper")) initBrandsSlider();
	if (document.querySelector(".catalog-top")) initTopCatalogSlider();
	if (document.querySelector(".partners__slider")) initPartnersSlider();
	if (document.querySelector(".sertificates__slider")) initSertificatesSlider();
	if (document.querySelector(".about__advs_slider")) initAboutAdvsSlider();
	if (document.querySelector(".catalog-section__slider")) catalogSectionsSlider();
	if (document.querySelector(".catalog-element__picture_slider")) catalogElementSlider();
	if (document.querySelector(".gallery__slider")) initGallerySlider();
	if (document.querySelector(".catalog-element__volume_list")) initVolumeSlider();
	if (document.querySelector(".new_catalog")) initNewCatalogSlider();
	if (document.querySelectorAll(".history__order_list.swiper").length) inithistoryOrderSliders();
	if (document.querySelectorAll(".contact-card__slider.swiper").length) contactsSliders();

	toggleDropdown();
	showFilter();
	hideFilter();
	toggleAccordion();
	setCounterValue();
	clipboardCopy();
	sharePage();
	toggleTabs();
	setMap();
	loadScript(window.location.protocol + "//api-maps.yandex.ru/2.1.79/?lang=ru_RU", contactsMap);
	textHandler();
	initScrollAnimations();
	initCounters();

	/* ---------- Mobile menu ---------- */
	document.querySelectorAll(".burger_btn").forEach(function (btn) {
		btn.addEventListener("click", openMMenu);
	});
	document.querySelectorAll(".close_btn").forEach(function (btn) {
		btn.addEventListener("click", closeMMenu);
	});
	var mmBg = document.querySelector(".mm__bg");
	if (mmBg) mmBg.addEventListener("click", closeMMenu);

	/* ---------- Fixed header scroll observer ---------- */
	var scrollTrigger = document.querySelector(".scroll-trigger");
	if (!scrollTrigger) return;

	var headerTimeline = null;
	var isHeaderHidden = false;

	var scrollCallback = function (entries) {
		entries.forEach(function (entry) {
			var shouldHide = entry.boundingClientRect.y < 0;
			if (shouldHide === isHeaderHidden) return;
			isHeaderHidden = shouldHide;

			if (headerTimeline) { headerTimeline.kill(); headerTimeline = null; }

			var tl = gsap.timeline();
			headerTimeline = tl;

			if (shouldHide) {
				var asidePos = window.innerWidth > 991 ? 16 : 8;
				if (window.innerWidth >= 650) {
					tl.to(".header.fixed", { translateY: "0", duration: 0.5 });
					var personalAside = document.querySelector(".personal__aside");
					if (personalAside) {
						var h = document.querySelector(".header.fixed").getBoundingClientRect().height;
						tl.to(".personal__aside", { top: h + asidePos + "px", duration: 0.5 }, "-=0.5");
					}
				}
				if (window.innerWidth >= 991) {
					var catalogAside = document.querySelector(".catalog__aside");
					if (catalogAside) {
						var h2 = document.querySelector(".header.fixed").getBoundingClientRect().height;
						tl.to(".catalog__aside", { top: h2 + asidePos + "px", duration: 0.5 }, "-=0.5");
					}
				}
			} else {
				tl.to(".header.fixed", { translateY: "-100%", duration: 0.5 });
				if (document.querySelector(".personal__aside")) {
					tl.to(".personal__aside", { top: "16px", duration: 0.5 }, "-=0.5");
				}
				if (window.innerWidth >= 991) {
					if (document.querySelector(".catalog__aside")) {
						tl.to(".catalog__aside", { top: "16px", duration: 0.5 }, "-=0.5");
					}
				}
			}
		});
	};

	var scrollObserver = new IntersectionObserver(scrollCallback, { rootMargin: "0px", threshold: 1 });
	scrollObserver.observe(scrollTrigger);
});
