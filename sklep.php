<?php

require_once("php/init.php");

$kategoria = isset($_GET['kategoria']) ? $_GET['kategoria'] : '';

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
	<div id="koszyk"><i class="fa-solid fa-cart-shopping"></i></div>
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
<?php if (empty($kategoria)): ?>
<div id="choosearea">
    <div id="chooseheader">WYBIERZ KATEGORIĘ PRODUKTU</div>
    <div id="categories">
    <?php
    $wynik = mysqli_query($conn, "SELECT skrot, nazwa FROM kategorie");
    if(mysqli_num_rows($wynik) > 0) {
        while($r = mysqli_fetch_assoc($wynik)) {
            echo("<a href='sklep.php?kategoria=$r[skrot]' class='categories_item'>$r[nazwa]</a>");
        }
    }
    ?>
    </div>
</div>
<?php else: ?>
<div id="shoparea">
<?php
$wynik = mysqli_query($conn, "
    SELECT
        pr.id,
        pr.nazwa,
        pr.cena,
        pr.img_path
    FROM produkty pr
    JOIN kategorie ka ON pr.kategoria_id=ka.id
    WHERE
        ka.skrot='$kategoria'

");
if(mysqli_num_rows($wynik) > 0) {
    while($r = mysqli_fetch_assoc($wynik)) {
        echo("
            <div class='produkt'>
                <div class='produktgrafika'><img src='grafika/produkty/$r[img_path]'></div>
				<div class='produktcena'>$r[cena]zł</div>
                <div class='produktnazwa'>$r[nazwa]</div>
                <div class='produktspecs'></div>
				<div class='produktdodaj'><i class='fa-solid fa-plus'></i></div>
            </div><br><br><br>
        ");
    }
}
?>
<!-- <i class="fa-solid fa-check"></i> -->
</div>
<a href="sklep.php"><div id="return">
	<i class="fa-solid fa-arrow-left"></i>
	<div id="returntext">POWRÓT</div>
</div></a>
<?php endif ?>
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
