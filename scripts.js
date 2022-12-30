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

// skrypt content4

var odmierzCzas = setInterval(timer, 1750);

function timer() {
	zmienObraz();
}

var czas = 0;
var producencilista = ["razer.svg","steelseries.svg","logitech.svg","amd.svg","intel.svg","nvidia.svg","kingston.svg","coolermaster.svg","microsoft.svg","adata.svg"];
var numerChoice;
var numerUsun;

function zmienObraz() {
	if (czas < 10) {
		document.getElementById("logoarea").style.visibility = "visible";
		document.getElementById("choice9").style.backgroundColor = "#1e1e1e";
		document.getElementById("choice9").style.boxShadow = "none";
		var numerId = document.getElementById("choice"+czas).id;
		numerChoice = numerId.charAt(6);
		numerUsun = numerChoice - 1;
		document.getElementById("choice"+czas).style.backgroundColor = "#353535";
		document.getElementById("choice"+czas).style.boxShadow = "0px 0px 10px #000000";
		if (numerUsun > -1) {
			document.getElementById("choice"+numerUsun).style.backgroundColor = "#1e1e1e";
			document.getElementById("choice"+numerUsun).style.boxShadow = "none";
		}
		document.getElementById("logoareaimage").setAttribute("src", "grafika/producenci/"+producencilista[czas]);
		document.getElementById("choice"+czas);
		czas++;
	} else {
		czas = 0;
	}
}
