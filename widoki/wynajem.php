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
				require '../skrypty/wczytywanie_l_s.php';
		?>
				<h2>Dodaj nową rezerwację</h2>
				<form name="dane" action="wynajem.php" method="post">
					<div class="left">

						<select name="id_klient" placeholder="podaj klienta" style="float:left" required>
							<option value="" disabled selected hidden>wybierz klienta</option>
							<?php
							foreach ($k as $kl => $link) {
								$kl = $kl + 1;
							?>

								<option value=<?= $kl ?>><?= $kl ?> - <?= $link['imie'] ?> <?= $link['nazwisko'] ?> <?= $link['pesel'] ?></option>
							<?php
							}
							?>
						</select>

						<p>
							<select name="id_samochod" required>
								<option value="" disabled selected hidden>wybierz samochod</option>
								<?php
								foreach ($s as $sam => $link) {
									$sam = $sam + 1;
								?>
									<option value=<?= $sam ?>><?= $sam ?> - <?= $link['marka'] ?> <?= $link['model'] ?>
										<?= $link['kolor'] ?> <?= $link['numer_rejestracyjny'] ?> <?= $link['rok_produkcji'] ?>
										<?= $link['cena_za_dzien'] ?></option>
								<?php
								}
								?>
							</select>
						</p>
					</div>

					<div class="right">
						<p>
							<label for="data_wypozyczenia">Wybierz datę wypożyczenia:</label>
							<input type="date" id="data_wypozyczenia" name="data_wypozyczenia" required placeholder="wybierz datę wypożyczenia" min="<?php echo date('Y-m-d'); ?>" />
						</p>

						<p>
							<label for="data">Wybierz datę zwrotu:</label>
							<input type="date" id="data_zwrotu" name="data_zwrotu" required placeholder="wybierz datę zwrotu" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" />
						</p>

						<p><textarea name=" uwagi" placeholder="Uwagi"></textarea></p>

					</div>
					<input type="submit" name="submit" value="Dodaj" style="float:right;width:10%;margin:5% 2% 0% 0%;border:0px solid black;" />
				</form>
				<div style="clear:both;">
					<?php
					require '../skrypty/wynajem_s.php';
					?>
				</div>
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