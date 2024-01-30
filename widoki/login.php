<!DOCTYPE html>
<html lang="pl">

<head>
	<meta charset="utf-8">
	<title>Wypożyczalnia samochodów</title>
	<link rel="stylesheet" type="text/css" href="../style/style.css" />
</head>

<body>
	<div class="wrapper">
		<a href="rejestruj.php" class="right">Rejestracja</a>
		<a href="wyloguj.php" class="right">Wyloguj</a>
		<a href="login.php" class="right">Zaloguj</a>

		<h1>Wypożyczalnia samochodów</h1>
		<nav>
			<ul>
				<li><a href="../index.php">Home</a></li>
				<li><a href="lista_p.php">Lista samochodów</a></li>
				<li><a href="samochody.php">Samochody</a></li>
				<li><a href="klient.php">Klient</a></li>
				<li><a href="wynajem.php">Wynajem</a></li>
				<li><a href="usuwanie_rezerwacji.php">Usuwanie rezerwacji</a></li>
				<li><a href="statystyka.php">Statystyka</a></li>
			</ul>
		</nav>

		<h2>Logowanie do serwisu</h2>
		<h3>Proszę się zalogować</h3>
		<div class="left" style="margin-left:150px;padding:30px 10px 0px 10px;">
			<form action="login.php" method="post">
				<input type="text" name="login" placeholder="podaj login" />
				<br />
				<input type="password" name="haslo" placeholder="podaj hasło" />
				<br />
				<input type="submit" name="submit" value="Zaloguj" />
				<?php
				require '../baza.php';
				require '../skrypty/loguj_u_s.php';
				?>
			</form>
		</div>
	</div>
	</br> </br> </br> </br> </br> </br> </br> </br> </br> </br> </br> </br> </br>
	<footer>
		<p>&copy; 2024 Wypożyczalnia samochodów. Wszelkie prawa zastrzeżone.</p>
		<p>Adres: ul. Przykładowa 123, 00-000 Warszawa</p>
		<p>Telefon: +48 123 456 789</p>
		<p>Email: info@wypozyczalnia-samochodow.pl</p>
		<p>Autor: Bartosz Wrombel</p>
	</footer>
</body>

</html>