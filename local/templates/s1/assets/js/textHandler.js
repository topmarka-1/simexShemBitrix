var tp = new Typograf({ locale: ["ru", "en-US"] });
tp.setSetting("common/punctuation/quote", "ru", { left: "«", right: "»", removeDuplicateQuotes: true });
tp.disableRule("common/punctuation/quote");
tp.disableRule("common/space/afterSemicolon");
tp.disableRule("common/space/trimLeft");
tp.disableRule("common/space/trimRight");
tp.disableRule("common/space/delBeforePunctuation");

Typograf.addRule({
	name: "common/other/typographicSmallerNames",
	handler: function (text) {
		return text.replace(/([А-ЯЁ]\.)\s+([А-ЯЁ]\.)/g, "$1\u00A0$2");
	},
});

Typograf.addRule({
	name: "common/other/typographicSmallNames",
	handler: function (text) {
		return text.replace(/([А-ЯЁ][а-яё]{0,2}\.)\s+([А-ЯЁ]\.)\s+([А-Я][а-я]+)/g, "$1\u00A0$2\u00A0$3");
	},
});

Typograf.addRule({
	name: "ru/dash/withNbsp",
	index: "-1",
	handler: function (text) {
		return text.replace(/(\s)-(\s)/g, "$1\u00A0\u2014 $2");
	},
});

Typograf.addRule({
	name: "common/other/skipUnbalancedQuotesOnly",
	handler: function (text) {
		var openCount = (text.match(/«/g) || []).length;
		var closeCount = (text.match(/»/g) || []).length;
		if (openCount === closeCount) return text;
		var quoteRegex = /"([^"„]+)"/g;
		if (quoteRegex.test(text)) return text.replace(quoteRegex, "«$1»");
		return text;
	},
});

function textHandler() {
	var root = document.getElementById("content") || document.body;
	var allNodes = [];

	function hasClass(element, cls) {
		var className = element.className;
		if (typeof className !== "string") className = element.getAttribute ? element.getAttribute("class") || "" : "";
		return className.indexOf(cls) !== -1;
	}

	function collectTextNodes(element) {
		if (element.nodeType !== 1) return;
		if (hasClass(element, "is-splitted") || hasClass(element, "title-anim-container") || hasClass(element, "no-typo")) return;
		var child = element.firstChild;
		while (child) {
			if (child.nodeType === 3) {
				if (child.nodeValue.replace(/^\s+|\s+$/g, "")) allNodes.push(child);
			} else if (child.nodeType === 1) {
				var tag = child.tagName.toUpperCase();
				if (tag !== "SCRIPT" && tag !== "STYLE" && tag !== "TEXTAREA" && tag !== "CODE") collectTextNodes(child);
			}
			child = child.nextSibling;
		}
	}

	collectTextNodes(root);

	function processQueue() {
		var startTime = Date.now();
		while (allNodes.length > 0) {
			var node = allNodes.shift();
			var originalValue = node.nodeValue;
			var result = tp.execute(originalValue);
			if (originalValue !== result) node.nodeValue = result;
			if (Date.now() - startTime > 50) {
				setTimeout(processQueue, 10);
				return;
			}
		}
	}

	processQueue();
}

function splitTitles() {
	var titles = document.querySelectorAll(".h1, .h2, .h3");
	Array.from(titles).forEach(function (h) {
		if (h.classList.contains("is-splitted")) return;
		var rows = h.innerHTML.trim().split("<br>");
		h.textContent = "";
		rows.forEach(function (row) {
			var words = row.split(" ");
			words.forEach(function (word, i) {
				var container = document.createElement("span");
				container.className = "title-anim-container";
				var content = document.createElement("span");
				content.className = "title-anim-content";
				content.innerHTML = i === words.length - 1 ? word : word + "&nbsp;";
				container.appendChild(content);
				h.appendChild(container);
			});
			h.appendChild(document.createElement("br"));
		});
	});
}
