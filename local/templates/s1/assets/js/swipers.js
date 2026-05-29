function initHeroSlider() {
	var heroSlider = document.querySelector(".hero__images_slider");
	var heroContent = document.querySelector(".hero__content");
	var heroContentSlider = document.querySelector(".hero__content_slider");
	if (!heroSlider || !heroContentSlider || !heroContent) return;

	new Swiper(heroContentSlider, {
		loop: true, allowTouchMove: false, effect: "fade", speed: 1500,
		fadeEffect: { crossFade: true }, autoHeight: false, spaceBetween: 10,
		autoplay: { delay: 7000, disableOnInteraction: false },
		navigation: { prevEl: heroContent.querySelector(".swiper_prev"), nextEl: heroContent.querySelector(".swiper_next") },
	});

	new Swiper(heroSlider, {
		loop: true, allowTouchMove: false, effect: "fade", speed: 1500,
		fadeEffect: { crossFade: true }, autoHeight: false, spaceBetween: 10,
		autoplay: { delay: 7000, disableOnInteraction: false },
		navigation: { prevEl: heroContent.querySelector(".swiper_prev"), nextEl: heroContent.querySelector(".swiper_next") },
	});
}

function initBrandsSlider() {
	var el = document.querySelector(".brands__list.swiper");
	if (!el) return;
	new Swiper(el, {
		slidesPerView: 2, spaceBetween: 16,
		breakpoints: {
			360: { slidesPerView: 2, spaceBetween: 16 },
			576: { slidesPerView: 2.5 },
			768: { slidesPerView: 3 },
			1200: { slidesPerView: 4, spaceBetween: 24 },
			1440: { slidesPerView: 5 },
		},
	});
}

function initTopCatalogSlider() {
	var el = document.querySelector(".catalog-top");
	if (!el) return;
	new Swiper(el, {
		slidesPerView: 4, spaceBetween: 16, modules: [Swiper.Grid], grid: { fill: "row", rows: 2 },
		breakpoints: {
			320: { slidesPerView: 1.2, spaceBetween: 14, grid: { rows: 1 } },
			576: { slidesPerView: 1.5, spaceBetween: 14, grid: { rows: 1 } },
			768: { slidesPerView: 2, spaceBetween: 16, grid: { rows: 4 } },
			1240: { slidesPerView: 3, spaceBetween: 20, grid: { rows: 3 } },
			1650: { slidesPerView: 4, spaceBetween: 24, grid: { rows: 2 } },
		},
	});
}

function initPartnersSlider() {
	var el = document.querySelector(".partners__slider");
	if (!el) return;
	var container = el.closest(".partners");
	var control = container.querySelector(".partners__slider_control");
	new Swiper(el, {
		slidesPerView: 1.2, slidesPerGroup: 1, loop: true, speed: 1000,
		autoplay: { delay: 5000, disableOnInteraction: false },
		pagination: { el: ".partners__slider_pagination", type: "fraction", formatFractionCurrent: function(n) { return n.toString().padStart(2,"0"); }, formatFractionTotal: function(n) { return n.toString().padStart(2,"0"); } },
		navigation: { prevEl: control.querySelector(".swiper_prev"), nextEl: control.querySelector(".swiper_next") },
		breakpoints: { 350: { slidesPerView: 1.5 }, 576: { slidesPerView: 2 }, 991: { slidesPerView: 3 }, 1200: { slidesPerView: 4 } },
	});
}

function initSertificatesSlider() {
	var el = document.querySelector(".sertificates__slider");
	if (!el) return;
	var container = el.closest(".sertificates");
	var control = container.querySelector(".sertificates__slider_control");
	new Swiper(el, {
		slidesPerView: 1.2, slidesPerGroup: 1, spaceBetween: 12, loop: true, speed: 1000,
		autoplay: { delay: 5000, disableOnInteraction: false },
		pagination: { el: ".sertificates__slider_pagination", type: "fraction", formatFractionCurrent: function(n) { return n.toString().padStart(2,"0"); }, formatFractionTotal: function(n) { return n.toString().padStart(2,"0"); } },
		navigation: { prevEl: control.querySelector(".swiper_prev"), nextEl: control.querySelector(".swiper_next") },
		breakpoints: { 350: { slidesPerView: 1.5, spaceBetween: 12 }, 576: { slidesPerView: 2, spaceBetween: 24 }, 991: { slidesPerView: 3, spaceBetween: 32 }, 1200: { slidesPerView: 4, spaceBetween: 40 }, 1440: { slidesPerView: 4, spaceBetween: 50 } },
	});
}

function initAboutAdvsSlider() {
	var el = document.querySelector(".about__advs_slider");
	if (!el) return;
	var container = el.closest(".about__advs");
	var control = container.querySelector(".about__advs_slider_control");
	new Swiper(el, {
		slidesPerView: 1.1, slidesPerGroup: 1, spaceBetween: 12, loop: true, speed: 1000,
		autoplay: { delay: 5000, disableOnInteraction: false },
		pagination: { el: ".about__advs_slider_pagination", type: "fraction", formatFractionCurrent: function(n) { return n.toString().padStart(2,"0"); }, formatFractionTotal: function(n) { return n.toString().padStart(2,"0"); } },
		navigation: { prevEl: control.querySelector(".swiper_prev"), nextEl: control.querySelector(".swiper_next") },
		breakpoints: { 350: { slidesPerView: 1.2, spaceBetween: 8 }, 576: { slidesPerView: 1.8, spaceBetween: 12 }, 991: { slidesPerView: 2, spaceBetween: 16 }, 1200: { slidesPerView: 2, spaceBetween: 20 }, 1440: { slidesPerView: 2, spaceBetween: 25 } },
	});
}

function initVolumeSlider() {
	var el = document.querySelector(".catalog-element__volume_list");
	if (!el) return;
	new Swiper(el, {
		slidesPerView: "auto", spaceBetween: 8, freeMode: true,
		scrollbar: { el: ".swiper-scrollbar", hide: false },
		breakpoints: { 360: { spaceBetween: 8 }, 576: { spaceBetween: 10 }, 768: { spaceBetween: 12 }, 991: { spaceBetween: 12 }, 1200: { spaceBetween: 12 } },
	});
}

function initNewCatalogSlider() {
	var el = document.querySelector(".new_catalog");
	if (!el) return;
	new Swiper(el, {
		slidesPerView: 2.4, spaceBetween: 24,
		breakpoints: { 320: { slidesPerView: 1.2, spaceBetween: 8 }, 400: { slidesPerView: 1.8, spaceBetween: 8 }, 576: { slidesPerView: 2.2, spaceBetween: 8 }, 768: { slidesPerView: 2.5, spaceBetween: 12 }, 991: { slidesPerView: 3.5, spaceBetween: 16 }, 1200: { slidesPerView: 2.1, spaceBetween: 20 }, 1400: { slidesPerView: 2.4, spaceBetween: 24 } },
	});
}

function inithistoryOrderSliders() {
	document.querySelectorAll(".history__order_list.swiper").forEach(function (item) {
		new Swiper(item, {
			slidesPerView: 1.2, observer: true, observeParents: true, slidesPerGroup: 1, spaceBetween: 8, autoHeight: true,
			breakpoints: { 320: { slidesPerView: 1.2, spaceBetween: 8 }, 375: { slidesPerView: 1.5, spaceBetween: 8 }, 450: { slidesPerView: 1.8, spaceBetween: 8 }, 576: { slidesPerView: 2.1, spaceBetween: 8 }, 768: { slidesPerView: 2.5, spaceBetween: 12 }, 991: { slidesPerView: 3.5, spaceBetween: 16 }, 1200: { slidesPerView: 4.1, spaceBetween: 16 }, 1400: { slidesPerView: 4.8, spaceBetween: 20 } },
		});
	});
}

function initGallerySlider() {
	var el = document.querySelector(".gallery__slider");
	if (!el) return;
	var container = el.closest(".gallery");
	var control = container.querySelector(".gallery__slider_control");
	new Swiper(el, {
		slidesPerView: 1.2, slidesPerGroup: 1, spaceBetween: 8, loop: true, speed: 1000,
		autoplay: { delay: 7000, disableOnInteraction: false },
		pagination: { el: ".gallery__slider_pagination", type: "fraction", formatFractionCurrent: function(n) { return n.toString().padStart(2,"0"); }, formatFractionTotal: function(n) { return n.toString().padStart(2,"0"); } },
		navigation: { prevEl: control.querySelector(".swiper_prev"), nextEl: control.querySelector(".swiper_next") },
		breakpoints: { 350: { slidesPerView: 1.5, spaceBetween: 8 }, 576: { slidesPerView: 1.8, spaceBetween: 12 }, 991: { slidesPerView: 2, spaceBetween: 16 }, 1200: { slidesPerView: 2, spaceBetween: 24 } },
	});
}

function catalogSectionsSlider() {
	var el = document.querySelector(".catalog-sections__slider");
	if (!el) return;
	new Swiper(el, {
		slidesPerView: "auto", spaceBetween: 12, freeMode: true,
		breakpoints: { 350: { spaceBetween: 12 }, 576: { spaceBetween: 16 }, 768: { spaceBetween: 20 }, 991: { spaceBetween: 24 }, 1200: { spaceBetween: 30 } },
	});
}

function catalogElementSlider() {
	var picture = document.querySelector(".catalog-element__picture_slider");
	var thumbs = document.querySelector(".catalog-element__picture_thumbs");
	if (!picture || !thumbs) return;

	var thumbsSlider = new Swiper(thumbs, {
		slidesPerView: "auto", spaceBetween: 12, watchSlidesProgress: true,
	});

	new Swiper(picture, {
		slidesPerView: 1, effect: "fade", fadeEffect: { crossFade: true }, speed: 1000,
		autoplay: { delay: 5000 }, thumbs: { swiper: thumbsSlider },
	});
}

function contactsSliders() {
	document.querySelectorAll(".contact-card__slider.swiper").forEach(function (item) {
		new Swiper(item, {
			slidesPerView: "auto", spaceBetween: 12, freeMode: true,
			scrollbar: { el: item.querySelector(".swiper-scrollbar"), hide: false },
		});
	});
}
