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