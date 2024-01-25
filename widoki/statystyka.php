<!DOCTYPE html>
<html lang="pl">
<head>	
<meta charset="utf-8">
<title>Szpital powiatowy w Zakolu Dolnym</title>
<link rel="stylesheet" type="text/css" href="../style/style.css" />
</head>
<body>
	<div class="wrapper">
	<a href="widoki/rejestruj.php" class="right">Rejestracja</a>
	<a href="widoki/wyloguj.php" class="right">Wyloguj</a>
	<a href="widoki/login.php" class="right">Zaloguj</a>

	<h1>SZPITAL POWIATOWY W ZAKOLU DOLNYM</h1>
	<nav>
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="lista_p.php">Lista pacjentów</a></li>
			<li><a href="wyszukaj_p.php">Wyszukaj pacjenta</a></li>
			<li><a href="dodaj_p.php">Dodaj pacjenta</a></li>
			<li><a href="edytuj_p.php">Edytuj dane</a></li>
			<li><a href="usun_p.php">Wyrejestruj pacjenta</a></li>
		</ul>
	</nav>	
		<h2>INFORMACJE STATYSTYCZNE</h2>
		
		<?php
		session_start();
		if(isset($_SESSION['sesja'])) {
			require ('../skrypty/statystyka_s.php');
			echo '<h3>Ilość pacjentów na każdym oddziale</h3>';
			foreach ($pacjenci as $pacjent => $link) {
			?>
			
			<p>
			<?= $link['oddzial'] ?> - <?= $link['ilosc'] ?> - 
			<?php 
			if ($link['ilosc']>10) {
					echo 'brak wolnych miejsc';
				}
				else {
					echo 'są wolne miejsca';
				}
			?>
			</p>
			
			<?php
			}
		}
		else {
			echo 'Proszę się zalogować.';
		}		
		?>
	</div>			
	</div>
</body>
</html>