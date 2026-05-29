var resizeHandler = null;

function setMap() {
	let mapContainers = document.querySelectorAll(".map");
	if (mapContainers.length === 0) return;

	if (resizeHandler) {
		window.removeEventListener("resize", resizeHandler);
	}

	resizeHandler = function () {
		document.querySelectorAll(".map").forEach(function (mc) {
			var pin = mc._ymPin;
			if (pin) {
				var w = mc.getBoundingClientRect().width;
				pin.options.set("iconImageSize", [w * 0.14, w * 0.186]);
				pin.options.set("iconImageOffset", [(-w * 0.14) / 2, (-w * 0.186) / 2]);
			}
		});
	};

	try {
		ymaps.ready(function () {
			document.querySelectorAll(".map").forEach(function (mc) {
				var id = mc.getAttribute("id");
				var data = mc.dataset;
				var mapCoord = JSON.parse(data.coord);
				var mapZoom = data.zoom;
				var mapTitle = data.title;
				var mapCenter = JSON.parse(data.center);

				var map = new ymaps.Map(id, {
					center: mapCenter,
					zoom: mapZoom,
					controls: ["smallMapDefaultSet"],
				});

				var pin = new ymaps.Placemark(mapCoord, { hintContent: mapTitle });
				map.behaviors.disable(["scrollZoom"]);
				map.geoObjects.add(pin);
				mc._ymPin = pin;

				var w = mc.getBoundingClientRect().width;
				pin.options.set("iconImageSize", [w * 0.14, w * 0.186]);
				pin.options.set("iconImageOffset", [(-w * 0.14) / 2, (-w * 0.186) / 2]);

				if (!mc.closest(".contacts")) {
					map.setCenter(mapCenter);
				}
			});

			window.addEventListener("resize", resizeHandler);
		});
	} catch (e) {
		console.warn("Yandex Map is not initiated");
	}
}

function contactsMap() {
	var mapContainer = document.querySelector("#contacts-map");
	if (!mapContainer) return;

	var offices = [
		{ city: "nn", title: "Производство и склад готовой продукции", coords: [56.263252, 43.614438] },
		{ city: "msk", title: "Представительство в Москве", coords: [55.772021, 37.876593] },
		{ city: "spb", title: "Представительство в Санкт-Петербурге", coords: [59.932928, 30.446869] },
	];

	ymaps.ready(function () {
		var map = new ymaps.Map("contacts-map", {
			center: [57.5, 45],
			zoom: 5,
			controls: ["smallMapDefaultSet"],
		});

		map.behaviors.disable("scrollZoom");

		var objectManager = new ymaps.ObjectManager({ clusterize: true, gridSize: 64 });
		map.geoObjects.add(objectManager);

		var tabs = document.querySelectorAll(".contacts__tab");
		var cards = document.querySelectorAll(".contact-card");

		function render(city) {
			city = city || "all";
			objectManager.removeAll();

			var filtered = city === "all" ? offices : offices.filter(function (o) { return o.city === city; });

			objectManager.add({
				type: "FeatureCollection",
				features: filtered.map(function (office, index) {
					return {
						type: "Feature",
						id: index,
						geometry: { type: "Point", coordinates: office.coords },
						properties: { balloonContent: office.title, hintContent: office.title },
					};
				}),
			});

			cards.forEach(function (card) {
				card.style.display = city === "all" || card.dataset.city === city ? "" : "none";
			});

			if (filtered.length === 1) {
				map.setCenter(filtered[0].coords, 13, { duration: 400 });
			} else {
				var bounds = objectManager.getBounds();
				if (bounds) {
					map.setBounds(bounds, { checkZoomRange: true, zoomMargin: 80, duration: 400 });
					setTimeout(function () { if (map.getZoom() > 10) map.setZoom(10, { duration: 200 }); }, 300);
				}
			}
		}

		tabs.forEach(function (tab) {
			tab.addEventListener("click", function () {
				tabs.forEach(function (t) { t.classList.remove("current"); });
				tab.classList.add("current");
				render(tab.dataset.city);
			});
		});

		render();
	});
}

function loadScript(src, func) {
	var script = document.createElement("script");
	script.src = src;
	document.body.append(script);
	if (func) script.onload = func;
}
