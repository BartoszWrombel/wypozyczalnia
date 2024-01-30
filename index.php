<!DOCTYPE html>
<html lang="pl">

<head>
	<meta charset="utf-8">
	<title>Wypożyczalnia samochodów</title>
	<link rel="stylesheet" type="text/css" href="style/style.css" />
</head>

<body style="background: url('grafika/tlo.jpg') no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
	<div class="wrapper">
		<a href="widoki/rejestruj.php" class="right">Rejestracja</a>
		<a href="widoki/wyloguj.php" class="right">Wyloguj</a>
		<a href="widoki/login.php" class="right">Zaloguj</a>

		<h1>Wypożyczalnia samochodów</h1>
		<nav>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="widoki/lista_p.php">Lista samochodów</a></li>
				<li><a href="widoki/samochody.php">Samochody</a></li>
				<li><a href="widoki/klient.php">Klient</a></li>
				<li><a href="widoki/wynajem.php">Wynajem</a></li>
				<li><a href="widoki/usuwanie_rezerwacji.php">Usuwanie rezerwacji</a></li>
				<li><a href="widoki/statystyka.php">Statystyka</a></li>
			</ul>
		</nav>
		<h2>WITAJ W APLIKACJI Wypożyczalnia samochodów</h2>
		<?php

		session_start();
		if (isset($_SESSION['sesja'])) {
			echo '<h2 style="color: red; font-weight: bold;">Jesteś zalogowany</h2>';
		} else {
			echo '<h2 style="color: red; font-weight: bold;">Proszę się zalogować</h2>';
			header("Location:widoki/login.php");
		}
		?>

	</div>
	<footer>
		<p>&copy; 2024 Wypożyczalnia samochodów. Wszelkie prawa zastrzeżone.</p>
		<p>Adres: ul. Przykładowa 123, 00-000 Warszawa</p>
		<p>Telefon: +48 123 456 789</p>
		<p>Email: info@wypozyczalnia-samochodow.pl</p>
	</footer>
</body>

</html>