function setVhCssVar() {
	let vh = window.innerHeight * 0.01;
	document.documentElement.style.setProperty("--vh", `${vh}px`);
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
	if (document.querySelector(".catalog-sections__slider")) catalogSectionsSlider();
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

	/* ---------- Favorites ---------- */
	fetch('/local/ajax/favourite.php?action=list', { credentials: 'same-origin' })
		.then(function (r) { return r.json(); })
		.then(function (data) {
			if (!data.success) return;
			console.log(data);
			document.querySelectorAll('.favourite_btn[data-item]').forEach(function (btn) {
				var id = parseInt(btn.getAttribute('data-item'));
				if (data.favorites.indexOf(id) !== -1) btn.classList.add('active');
			});
			if (data.favorites.length) {
				document.querySelectorAll('.header .favourite_btn').forEach((btn => {
					const span = document.createElement('span')
					span.classList.add('total')
					span.textContent = data.favorites.length
					btn.appendChild(span)
					btn.classList.add('active')
				}))
			}
			
		});

	document.addEventListener('click', function (e) {
		var btn = e.target.closest('.favourite_btn[data-item]');
		if (!btn) return;
		e.preventDefault();
		var id = parseInt(btn.getAttribute('data-item'));
		fetch('/local/ajax/favourite.php?action=toggle&id=' + id, { credentials: 'same-origin' })
			.then(function (r) { return r.json(); })
			.then(function (data) {
				if (data.success) {
					btn.classList.toggle('active', data.added);
					document.dispatchEvent(new CustomEvent("addFavourite", {detail: {favorites: data.favorites}}))
				}
			});
	});
	document.addEventListener('addFavourite', function(e) {
		
		document.querySelectorAll('.header .favourite_btn').forEach((btn => {
			if(e.detail.favorites.length) {
				if (btn.querySelector('span.total')) {
					btn.querySelector('span.total').textContent = e.detail.favorites.length
				} else {
					const span = document.createElement('span')
					span.classList.add('total')
					span.textContent = e.detail.favorites.length
					btn.appendChild(span)
					btn.classList.add('active')
				}
			} else {
				btn.classList.remove('active')
				btn.querySelector('span.total').remove()
			}
			
		}))
	})

	const playBtn = document.querySelector(".play_btn");
	const stopBtn = document.querySelector(".stop_btn");

	if (playBtn) {
		const player = playBtn.closest(".player");
		const video = player.querySelector("video");
		playBtn.addEventListener("click", (e) => {
			// const player = e.target.closest(".player");
			// const video = player.querySelector("video");
			player.classList.add("play");
			video.controls = true;
			video.play();
		});
		stopBtn.addEventListener("click", (e) => {
			// const player = e.target.closest(".player");
			// const video = player.querySelector("video");
			player.classList.remove("play");
			video.controls = false;
			video.pause();
			video.load();
			// video.currentTime = 0;
		});

		video.addEventListener("ended", () => {
			video.controls = false;
			player.classList.remove("play");
			video.load();
		});
	}

});
