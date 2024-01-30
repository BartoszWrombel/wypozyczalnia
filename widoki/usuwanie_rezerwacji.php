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
		<?php
		session_start();
		if (isset($_SESSION['sesja'])) {
			require('../skrypty/usuwanie_rezerwacji_s.php');
			if ($_SESSION['nazwa_uprawnienia'] == 'Pracownik' || $_SESSION['nazwa_uprawnienia'] == 'Kierownik' || $_SESSION['nazwa_uprawnienia'] == 'Administrator') {
		?>
				<h2>Usuwanie rezerwacji</h2>
				<form name="dane" action="usuwanie_rezerwacji.php" method="post">
					<input type="number" name="id_wypozyczenia" placeholder="podaj id wypozyczenia" style="width:20%;display:inline;text-align:center;" />
					<input type="submit" name="usun_rezerwacje" value="usun rezerwacje" style="width:20%;display:inline;" />
				</form>
				<table>
					<tr>
						<th>ID wypożyczenia</th>
						<th>Imię klienta</th>
						<th>Nazwisko klienta</th>
						<th>Numer PESEL klienta</th>
						<th>Marka samochodu</th>
						<th>Model samochodu</th>
						<th>Kolor samochodu</th>
						<th>Numer rejestracyjny samochodu</th>
						<th>Rok produkcji samochodu</th>
						<th>Cena za dzień</th>
						<th>Data wypożyczenia</th>
						<th>Data zwrotu</th>
						<th>Koszt całkowity</th>
						<th>Uwagi</th>
					</tr>
					<?php
					require('../skrypty/lista_p_s.php');
					foreach ($wypozyczenia as $wypozyczenia1 => $link) {
					?>
						<tr>
							<td><?= $link['id_wypozyczenia'] ?></td>
							<td><?= $link['imie'] ?></td>
							<td><?= $link['nazwisko'] ?></td>
							<td><?= $link['pesel'] ?></td>
							<td><?= $link['marka'] ?></td>
							<td><?= $link['model'] ?></td>
							<td><?= $link['kolor'] ?></td>
							<td><?= $link['numer_rejestracyjny'] ?></td>
							<td><?= $link['rok_produkcji'] ?></td>
							<td><?= $link['cena_za_dzien'] ?></td>
							<td><?= $link['data_wypozyczenia'] ?></td>
							<td><?= $link['data_zwrotu'] ?></td>
							<td><?= $link['koszt_calkowity'] ?></td>
							<td><?= $link['uwagi'] ?></td>
						</tr>
					<?php
					}
					?>
				</table>
		<?php
			} else {
				echo '<h2 style="color: red; font-weight: bold;">Nie masz uprawnień do wyświetlenia tej strony.</h2>';
			}
		} else {
			echo '<h2 style="color: red; font-weight: bold;">Proszę się zalogować.</h2>';
		}
		?>
	</div>
	<footer>
		<p>&copy; 2024 Wypożyczalnia samochodów. Wszelkie prawa zastrzeżone.</p>
		<p>Adres: ul. Przykładowa 123, 00-000 Warszawa</p>
		<p>Telefon: +48 123 456 789</p>
		<p>Email: info@wypozyczalnia-samochodow.pl</p>
		<p>Autor: Bartosz Wrombel</p>
	</footer>
</body>

</html>