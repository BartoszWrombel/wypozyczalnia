<!DOCTYPE html>
<html lang="pl">

<head>
	<meta charset="utf-8">
	<title>Wypożyczalnia samochodów</title>
	<link rel="stylesheet" type="text/css" href="style/style.css" />
</head>

<body>
	<div class="wrapper">
		<a href="widoki/rejestruj.php" class="right">Rejestracja</a>
		<a href="widoki/wyloguj.php" class="right">Wyloguj</a>
		<a href="widoki/login.php" class="right">Zaloguj</a>

		<h1>Wypożyczalnia samochodów</h1>
		<nav>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="widoki/lista_p.php">Lista pacjentów</a></li>
				<li><a href="widoki/wyszukaj_p.php">Wyszukaj pacjenta</a></li>
				<li><a href="widoki/dodaj_p.php">Dodaj pacjenta</a></li>
				<li><a href="widoki/edytuj_p.php">Edytuj dane</a></li>
				<li><a href="widoki/usun_p.php">Wyrejestruj pacjenta</a></li>
			</ul>
		</nav>
		<h2>WITAJ W APLIKACJI Wypożyczalnia samochodów</h2>
		<?php

		session_start();
		if (isset($_SESSION['sesja'])) {
			echo '<h2>Jesteś zalogowany</h2>';
		} else {
			echo '<h3>Proszę się zalogować</h3>';
			header("Location:widoki/login.php");
		}
		?>

	</div>
	</div>
</body>

</html>