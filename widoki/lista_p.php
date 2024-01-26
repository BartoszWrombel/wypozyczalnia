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
			</ul>
		</nav>
		<h2>Lista samochodów do wypożyczenia</h2>
		<table>
			<tr>
				<th>Marka samochodu</th>
				<th>Model samochodu</th>
				<th>Kolor samochodu</th>
				<th>Numer rejestracyjny samochodu</th>
				<th>Rok produkcji samochodu</th>
				<th>Cena za dzień</th>
				<th>Status samochodu</th>
			</tr>
			<?php
			session_start();
			if (isset($_SESSION['sesja'])) {
				require('../skrypty/lista_p_s.php');
				foreach ($samochody as $samochod => $link) {
			?>
					<tr>
						<td><?= $link['marka'] ?></td>
						<td><?= $link['model'] ?></td>
						<td><?= $link['kolor'] ?></td>
						<td><?= $link['numer_rejestracyjny'] ?></td>
						<td><?= $link['rok_produkcji'] ?></td>
						<td><?= $link['cena_za_dzien'] ?></td>
						<td><?= $link['status_samochodu'] ?></td>
					</tr>
			<?php
				}
			} else {
				echo 'Proszę się zalogować.';
			}
			?>
		</table>
	</div>
</body>

</html>