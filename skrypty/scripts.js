// funkcje podświetlania menu

function menuGlowOn() {
	document.getElementById("menubar1").style.boxShadow = "0px 0px 5px 1px #ffffff";
	document.getElementById("menubar2").style.boxShadow = "0px 0px 5px 1px #ffffff";
	document.getElementById("menubar3").style.boxShadow = "0px 0px 5px 1px #ffffff";

}
function menuGlowOff() {
	document.getElementById("menubar1").style.boxShadow = "none";
	document.getElementById("menubar2").style.boxShadow = "none";
	document.getElementById("menubar3").style.boxShadow = "none";
}

// włącz/wyłącz sidebar menu

var licznik = 0;
var menubutton = document.getElementById("menu");
menubutton.onclick = function() {
	licznik++;
	if (licznik == 1) {
		menubutton = document.getElementById("sidemenu").style.visibility = "visible";
	} else if (licznik == 2) {
		menubutton = document.getElementById("sidemenu").style.visibility = "hidden";
		licznik = 0;
	}
}