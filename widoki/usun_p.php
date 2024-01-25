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
		<h2>Usuwanie rezerwacji</h2>
		<?php
		session_start();
		if (isset($_SESSION['sesja'])) {
			// if ($_SESSION['uprawnienia'] == 'pielęgniarka') {
		?>
			<form name="dane" action="usun_p.php" method="post">
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
					<th>Wariant samochodu</th>
					<th>Kolor samochodu</th>
					<th>Numer rejestracyjny samochodu</th>
					<th>Rok produkcji samochodu</th>
					<th>Cena za dzień</th>
					<th>Status samochodu</th>
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
						<td><?= $link['wariant'] ?></td>
						<td><?= $link['kolor'] ?></td>
						<td><?= $link['numer_rejestracyjny'] ?></td>
						<td><?= $link['rok_produkcji'] ?></td>
						<td><?= $link['cena_za_dzien'] ?></td>
						<td><?= $link['status_samochodu'] ?></td>
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
			require('../skrypty/usun_p_s.php');
		} else {
			echo "Nie masz wystarczających uprawnień. Proszę się zalogować z uprawieniami pielęgniarki";
		}
		// } else {
		// 	echo 'Proszę się zalogować z uprawieniami pielęgniarki.';
		// }
		?>
	</div>
</body>

</html>