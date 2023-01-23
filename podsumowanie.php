<?php

require_once("php/init.php");

$koszyk = $_SESSION['koszyk'];
$cena = 0;

$stmt = mysqli_prepare($conn, "
	SELECT
		SUM(pr.cena) cena
	FROM produkty pr
	WHERE
		pr.id IN (".substr(str_repeat('?,', count($koszyk)), 0, -1).")
");
mysqli_stmt_bind_param($stmt, str_repeat('s', count($koszyk)), ...$koszyk);
mysqli_stmt_execute($stmt);
$wynik = mysqli_stmt_get_result($stmt);
if (mysqli_num_rows($wynik) > 0) {
	while($r = mysqli_fetch_assoc($wynik)) {
		$cena = $r['cena'];
	}
}


if (!empty($_POST['imie_nazwisko']) AND !empty($_POST['ulica']) AND !empty($_POST['miejscowosc']) AND !empty($_POST['kod_pocztowy']) AND !empty($_POST['telefon']) AND !empty($_POST['email'])) {
	$imie_nazwisko	= htmlspecialchars($_POST['imie_nazwisko'], ENT_QUOTES, 'UTF-8');
	$ulica			= htmlspecialchars($_POST['ulica'], ENT_QUOTES, 'UTF-8');
	$miejscowosc	= htmlspecialchars($_POST['miejscowosc'], ENT_QUOTES, 'UTF-8');
	$kod_pocztowy	= htmlspecialchars($_POST['kod_pocztowy'], ENT_QUOTES, 'UTF-8');
	$telefon		= htmlspecialchars($_POST['telefon'], ENT_QUOTES, 'UTF-8');
	$email			= htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');

	$stmt = mysqli_prepare($conn, "
		INSERT INTO zamowienia SET
			imie_nazwisko = ?,
			ulica = ?,
			miejscowosc = ?,
			kod_pocztowy = ?,
			telefon = ?,
			email = ?
	");
	mysqli_stmt_bind_param($stmt, 'ssssss', $imie_nazwisko, $ulica, $miejscowosc, $kod_pocztowy, $telefon, $email);
	mysqli_stmt_execute($stmt);

	$zamowienie_id = mysqli_stmt_insert_id($stmt);

	foreach ($_SESSION['koszyk'] as $koszyk_key => $produkt_id) {
		$stmt = mysqli_prepare($conn, "
			INSERT INTO zamowienia_produkty SET
				zamowienie_id = ?,
				produkt_id = ?
		");
		mysqli_stmt_bind_param($stmt, 'ss', $zamowienie_id, $produkt_id);
		mysqli_stmt_execute($stmt);
	}

	header("Location: zakup.php");
	exit;
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Dream Machine - Sklep</title>
<link rel="stylesheet" type="text/css" href="css/style-shop.css">
<link rel="icon" href="grafika/icondm.png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Paytone+One&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
<script src="https://kit.fontawesome.com/c43f04151a.js" crossorigin="anonymous"></script>
</head>
<body>
<div id="header">
	<div id="blog"><a class="podstrona" href="blog.html">BLOG</a></div>
	<div id="kontakt"><a class="podstrona" href="kontakt.html">KONTAKT</a></div>
	<div id="logo"><a href="index.html"><img src="grafika/logodm.png"></a></div>
	<div id="sklep"><a href="sklep.php">SKLEP</a></div>
	<div id="menu" onmouseover="menuGlowOn()" onmouseout="menuGlowOff()">
		<div id="menubar1" class="menubar"></div>
		<div id="menubar2" class="menubar"></div>
		<div id="menubar3" class="menubar"></div>
	</div>
	<a href="koszyk.php" id="koszyk"><i class="fa-solid fa-cart-shopping"></i></a>
</div>
<div id="sidemenu">
	<div id="menumode">
		<div id="menumodeicon"><i class="fa-solid fa-lightbulb"></i></div>
		<div id="menumodetext">Tryb jasny</div>
	</div>
	<div id="menulang">
		<div id="menulangicon"><i class="fa-solid fa-language"></i></div>
		<div id="menulangtext">Zmień język</div>
	</div>
</div>
<div id="shoparea">
    <div id="pageheader">FINALIZACJA ZAMÓWIENIA</div>
        <div id="formheader">DANE OSOBOWE</div>
        <form method="post">
            <div class="inputheader">Imię i nazwisko</div>
            <input type="text" name="imie_nazwisko" maxlength="255" required>
            <div class="inputheader">Ulica i numer</div>
            <input type="text" name="ulica"  maxlength="255" required>
            <div class="inputheader">Miejscowość</div>
            <input type="text" name="miejscowosc" maxlength="255" required>
            <div class="inputheader">Kod pocztowy</div>
            <input type="text" name="kod_pocztowy" maxlength="255" required>
            <div class="inputheader">Telefon</div>
            <input type="text" name="telefon" maxlength="255" required>
            <div class="inputheader">E-mail</div>
            <input type="text" name="email" maxlength="255" required>
            <input type="submit" value="POTWIERDŹ ZAKUP">
        <div id="summary">
            <div id="summaryheader">KWOTA DO ZAPŁATY</div>
            <div id="summarycontent"></div>
            <div id="summarycena"><?=$cena?>zł</div>
        </div>
</form>
</div>
<div id="footer">
	<div id="footermisc">
		<div id="footerlogo"><img src="grafika/logodm.png"></div>
		<div id="footersocial">
			<div id="footerfacebook"><i class="fa-brands fa-facebook"></i></div>
			<div id="footertwitter"><i class="fa-brands fa-twitter"></i></div>
			<div id="footerinstagram"><i class="fa-brands fa-instagram"></i></div>
		</div>
		<div id="footercopyright">DreamMachine by Mikołaj Adamski @ 2022-2023</div>
	</div>
</div>
<script src="skrypty/scripts.js"></script>
</body>
</html>