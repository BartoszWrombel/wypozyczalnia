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
		<h2>Dodaj nowe zamówienie</h2>
		<?php
		// session_start();
		// if(isset($_SESSION['sesja'])) {
		// 	if ($_SESSION['uprawnienia'] == 'pielęgniarka') {
		require '../skrypty/wczytywanie_l_s.php';
		?>
		<form name="dane" action="dodaj_p.php" method="post">
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
							<option value=<?= $sam ?>><?= $sam ?> - <?= $link['marka'] ?> <?= $link['model'] ?> <?= $link['wariant'] ?>
								<?= $link['kolor'] ?> <?= $link['numer_rejestracyjny'] ?> <?= $link['rok_produkcji'] ?>
								<?= $link['cena_za_dzien'] ?> <?= $link['status_samochodu'] ?></option>
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
					<label for="data">Wybierz datę wypożyczenia:</label>
					<input type="date" id="data_zwrotu" name="data_zwrotu" required placeholder="wybierz datę zwrotu" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" />
				</p>

				<p><textarea name=" uwagi" placeholder="Uwagi"></textarea></p>

			</div>
			<input type="submit" name="submit" value="Dodaj" style="float:right;width:10%;margin:5% 2% 0% 0%;border:0px solid black;" />
		</form>
		<div style="clear:both;">
			<?php
			require '../skrypty/dodaj_p_s.php';
			?>
		</div>
		<?php
		// }
		// else {
		// 	echo "Nie masz wystarczających uprawnień. Proszę się zalogować z uprawieniami pielęgniarki";
		// }
		// }
		// else {
		// 	echo 'Proszę się zalogować z uprawieniami pielęgniarki.';
		// }
		?>
	</div>
</body>

</html>