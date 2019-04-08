//Generate and Autofill Status Code
function generateNumber() {
	var num = localStorage.getItem("idCounter");
	if (num === null) {
		num = 1;
	}
	num++;
	localStorage.setItem("idCounter", num);

	var r = "" + num;
	var length = 4;

	while (r.length < length) {
		r = "0" + r;
	}
	var s = "S";
	s = s + r;
	document.getElementsByName("sCode")[0].value = s;
}

window.onload = function() {
	if (window.location.href.indexOf("poststatusform.php")) {
		generateNumber();
	}
};
