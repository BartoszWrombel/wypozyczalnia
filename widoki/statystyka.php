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
		<h2>INFORMACJE STATYSTYCZNE</h2>

		<?php
		session_start();
		if (isset($_SESSION['sesja'])) {
			require('../skrypty/statystyka_s.php');
		?>
			<h3>Zliczanie ilości i wartości wypożyczonych samochodów po każdym dniu</h3>
			<table>
				<tr>
					<th>Data wypożyczenia</th>
					<th>Ilość wypożyczonych samochodów</th>
					<th>Wartość wypożyczonych samochodów</th>
				</tr>

				<?php
				foreach ($wyniki_dzien as $wynik_dzien => $link) {
				?>
					<tr>
						<td><?= $link['data_wypozyczenia'] ?></td>
						<td><?= $link['ilosc'] ?></td>
						<td><?= $link['wartosc'] ?></td>
					</tr>
				<?php
				}
				?>
			</table>
			<h3>Zliczanie ilości i wartości wypożyczonych samochodów po każdym miesiącu</h3>
			<table>
				<tr>
					<th>Miesiąc</th>
					<th>Ilość wypożyczonych samochodów</th>
					<th>Wartość wypożyczonych samochodów</th>
				</tr>

				<?php
				foreach ($wyniki_miesiac as $wynik_miesiac => $link) {
				?>
					<tr>
						<td><?= $link['miesiac'] ?></td>
						<td><?= $link['ilosc'] ?></td>
						<td><?= $link['wartosc'] ?></td>
					</tr>
				<?php
				}
				?>
			</table>
			<h3>Zliczanie ilości i wartości wypożyczonych samochodów według marki po każdym dniu </h3>
			<table>
				<tr>
					<th>Data wypożyczenia</th>
					<th>Marka</th>
					<th>Ilość wypożyczonych samochodów</th>
					<th>Wartość wypożyczonych samochodów</th>
				</tr>

				<?php
				foreach ($wyniki_marka_dzien as $wynik_marka_dzien => $link) {
				?>
					<tr>
						<td><?= $link['data_wypozyczenia'] ?></td>
						<td><?= $link['marka'] ?></td>
						<td><?= $link['ilosc'] ?></td>
						<td><?= $link['wartosc'] ?></td>
					</tr>
				<?php
				}
				?>
			</table>
			<h3>Zliczanie ilości i wartości wypożyczonych samochodów według koloru po każdym miesiącu </h3>
			<table>
				<tr>
					<th>Miesiąc</th>
					<th>Kolor</th>
					<th>Ilość wypożyczonych samochodów</th>
					<th>Wartość wypożyczonych samochodów</th>
				</tr>

				<?php
				foreach ($wyniki_kolor_miesiac as $wynik_kolor_miesiac => $link) {
				?>
					<tr>
						<td><?= $link['miesiac'] ?></td>
						<td><?= $link['kolor'] ?></td>
						<td><?= $link['ilosc'] ?></td>
						<td><?= $link['wartosc'] ?></td>
					</tr>
				<?php
				}
				?>
			</table>
			<h3>Marka samochodu najczęściej wypożyczanego w miesiącu</h3>
			<table>
				<tr>
					<th>Miesiąc</th>
					<th>Marka</th>
					<th>Ilość wypożyczonych samochodów</th>
				</tr>

				<?php
				foreach ($najczestsza_marka_miesiac as $najczestsza_marka_miesiac => $link) {
				?>
					<tr>
						<td><?= $link['miesiac'] ?></td>
						<td><?= $link['marka'] ?></td>
						<td><?= $link['ilosc'] ?></td>
					</tr>
			<?php
				}
			} else {
				echo '<h2 style="color: red; font-weight: bold;">Proszę się zalogować.</h2>';
			}
			?>
			</table>
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