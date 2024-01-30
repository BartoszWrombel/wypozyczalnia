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
			if ($_SESSION['nazwa_uprawnienia'] == 'Pracownik' || $_SESSION['nazwa_uprawnienia'] == 'Kierownik' || $_SESSION['nazwa_uprawnienia'] == 'Administrator') {

				require('../skrypty/samochody_s.php');
				require('../skrypty/lista_p_s.php');
		?>
				<h2>Wyszukaj samochód</h2>

				<form name="dane_samochod" action="samochody.php" method="post">
					<input type="text" name="marka" placeholder="podaj markę samochodu" style="width:50%;display:inline;text-align:center;" />
					<br />
					<input type="text" name="model" placeholder="podaj model samochodu" style="width:50%;display:inline;text-align:center;" />
					<br />
					<input type="text" name="kolor" placeholder="podaj kolor samochodu" style="width:50%;display:inline;text-align:center;" />
					<br />
					<input type="text" name="numer_rejestracyjny" placeholder="podaj numer rejestracyjny samochodu" style="width:50%;display:inline;text-align:center;" />
					<br />
					<input type="number" name="rok_produkcji" placeholder="podaj rok produkcji samochodu" style="width:50%;display:inline;text-align:center;" />
					<br />
					<input type="number" name="cena_za_dzien" placeholder="podaj cenę za dzień" style="width:50%;display:inline;text-align:center;" />
					<br />
					<label for="data_wypozyczenia">Data wypożyczenia:</label>
					<input type="date" name="data_wypozyczenia" placeholder="podaj datę wypożyczenia samochodu" style="width:50%;display:inline;text-align:center;" />
					<br />
					<input type="submit" name="wyszukaj_samochod" value="Wyszukaj" style="width:50%;display:inline;" />
				</form>

				<table>
					<tr>
						<th>Marka samochodu</th>
						<th>Model samochodu</th>
						<th>Kolor samochodu</th>
						<th>Numer rejestracyjny samochodu</th>
						<th>Rok produkcji samochodu</th>
						<th>Cena za dzień</th>
						<th>Data wypożyczenia</th>
					</tr>
					<?php
					foreach ($samochod_wyszukany as $samochod_wy => $link) { //odczytuję to co zostało zapisane w tablicy za pomocą fetchAll
					?>
						<tr>
							<td><?= $link['marka'] ?></td>
							<td><?= $link['model'] ?></td>
							<td><?= $link['kolor'] ?></td>
							<td><?= $link['numer_rejestracyjny'] ?></td>
							<td><?= $link['rok_produkcji'] ?></td>
							<td><?= $link['cena_za_dzien'] ?></td>
							<td><?= $link['data_wypozyczenia'] ?></td>
						</tr>
						</ <?php
						}
							?> </table>

						<?php
						if ($_SESSION['nazwa_uprawnienia'] == 'Kierownik' || $_SESSION['nazwa_uprawnienia'] == 'Administrator') {
						?>

							<h2>Dodaj samochód</h2>

							<form name="dane_samochod" action="samochody.php" method="post">
								<input type="text" name="marka" required placeholder="podaj markę samochodu" style="width:50%;display:inline;text-align:center;" />
								<br />
								<input type="text" name="model" required placeholder="podaj model samochodu" style="width:50%;display:inline;text-align:center;" />
								<br />
								<input type="text" name="kolor" required placeholder="podaj kolor samochodu" style="width:50%;display:inline;text-align:center;" />
								<br />
								<input type="text" name="numer_rejestracyjny" required placeholder="podaj numer rejestracyjny samochodu" style="width:50%;display:inline;text-align:center;" />
								<br />
								<input type="number" name="rok_produkcji" required placeholder="podaj rok produkcji samochodu" style="width:50%;display:inline;text-align:center;" />
								<br />
								<input type="number" name="cena_za_dzien" required placeholder="podaj cenę za dzień" style="width:50%;display:inline;text-align:center;" />
								<br />
								<input type="submit" name="dodaj_samochod" value="Dodaj" style="width:50%;display:inline;" />
							</form>
							<table>
								<tr>
									<th>Marka samochodu</th>
									<th>Model samochodu</th>
									<th>Kolor samochodu</th>
									<th>Numer rejestracyjny samochodu</th>
									<th>Rok produkcji samochodu</th>
									<th>Cena za dzień</th>
								</tr>
								<?php
								foreach ($samochody as $samochod => $link) {
								?>
									<tr>
										<td><?= $link['marka'] ?></td>
										<td><?= $link['model'] ?></td>
										<td><?= $link['kolor'] ?></td>
										<td><?= $link['numer_rejestracyjny'] ?></td>
										<td><?= $link['rok_produkcji'] ?></td>
										<td><?= $link['cena_za_dzien'] ?></td>
									</tr>

								<?php
								}
								?>
							</table>
							<h2>Usuń samochód</h2>

							<form name="dane_samochod" action="samochody.php" method="post">
								<input type="text" name="numer_rejestracyjny" placeholder="podaj numer rejestracyjny samochodu" style="width:50%;display:inline;text-align:center;" />
								<input type="submit" name="usun_samochod" value="Usuń" style="width:50%;display:inline;" />
							</form>

							<table>
								<tr>
									<th>Marka samochodu</th>
									<th>Model samochodu</th>
									<th>Kolor samochodu</th>
									<th>Numer rejestracyjny samochodu</th>
									<th>Rok produkcji samochodu</th>
									<th>Cena za dzień</th>
								</tr>
								<?php
								foreach ($samochody as $samochod => $link) {
								?>
									<tr>
										<td><?= $link['marka'] ?></td>
										<td><?= $link['model'] ?></td>
										<td><?= $link['kolor'] ?></td>
										<td><?= $link['numer_rejestracyjny'] ?></td>
										<td><?= $link['rok_produkcji'] ?></td>
										<td><?= $link['cena_za_dzien'] ?></td>
									</tr>

					<?php
								}
							} else {
								echo '<h2 style="color: red; font-weight: bold;">Potrzebujesz uprawnień kierownika lub administratora.</h2>';
							}
						} else {
							echo '<h2 style="color: red; font-weight: bold;">Nie masz uprawnień do przeglądania tej strony.</h2>';
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