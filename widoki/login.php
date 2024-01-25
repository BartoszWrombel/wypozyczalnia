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
				<li><a href="lista_p.php">Lista pacjentów</a></li>
				<li><a href="wyszukaj_p.php">Wyszukaj pacjenta</a></li>
				<li><a href="dodaj_p.php">Dodaj pacjenta</a></li>
				<li><a href="edytuj_p.php">Edytuj dane</a></li>
				<li><a href="usun_p.php">Wyrejestruj pacjenta</a></li>
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

</body>

</html>