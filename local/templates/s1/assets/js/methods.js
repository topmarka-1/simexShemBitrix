function phoneMask(e) {
	var valRegRu = /\D/gi;
	var str = (this && this.value) ? this.value.replace(valRegRu, "") : "";
	var rusTel = ["7", "8", "9"];
	var formatStr = "";
	if (rusTel.indexOf(str[0]) !== -1) {
		if (str[0] === "7") {
			formatStr = "+" + str[0];
		} else if (str[0] === "8") {
			formatStr = str[0];
		} else {
			formatStr = "+7" + str[0];
		}
		if (str.length > 1) {
			formatStr += " (" + str.slice(1, 4);
		}
		if (str.length >= 5) {
			formatStr += ") " + str.slice(4, 7);
		}
		if (str.length >= 8) {
			formatStr += " " + str.slice(7, 9);
		}
		if (str.length >= 10) {
			formatStr += " " + str.slice(9, 11);
		}
	} else {
		if (str.length >= 1) formatStr = "+" + str;
	}
	this.value = formatStr;
}

function maskedEmail(elem) {
	var str = elem.value.replace(/[^\w-@\.]/gi, "");
	if (!/[\w-]/g.test(str)) {
		str = str.replace(/@/, "");
	}
	if ((str.match(/@/g) || []).length > 1) {
		str = str.slice(0, -1);
	}
	return str;
}
