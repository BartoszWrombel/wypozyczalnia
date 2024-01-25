<!DOCTYPE html>
<html lang="pl">
<head>	
<meta charset="utf-8">
<title>Szpital powiatowy w Zakolu Dolnym</title>
<link rel="stylesheet" type="text/css" href="../style/style.css" />
</head>
<body>
	<div class="wrapper">
	<a href="rejestruj.php" class="right">Rejestracja</a>
	<a href="wyloguj.php" class="right">Wyloguj</a>
	<a href="login.php" class="right">Zaloguj</a>

	<h1>SZPITAL POWIATOWY W ZAKOLU DOLNYM</h1>
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
	<h2>Wyrejestruj pacjenta</h2>
	<?php
		session_start();
		if(isset($_SESSION['sesja'])) {
			if ($_SESSION['uprawnienia'] == 'pielęgniarka') {
			?>
			<form name="dane" action="usun_p.php" method="post">
			
			
			<input type="number" name="numer_pesel" placeholder="podaj numer pesel" style="width:20%;display:inline;text-align:center;" />
			<input type="submit" name="submit" value="Wyrejestruj" style="width:20%;display:inline;" />
			</form>
			<table>
			<tr>
				<th>Imię pacjenta</th><th>Nazwisko pacjenta</th><th>Numer PESEL</th>
				<th>Imię lekarza</th><th>Nazwisko lekarza</th><th>Oddział</th><th>Historia choroby</th>
			</tr>
			<?php
				require ('../skrypty/lista_p_s.php');
				foreach ($pacjenci as $pacjent => $link) {
			?>
			<tr>
				<td><?= $link['imie'] ?></td><td><?= $link['nazwisko'] ?></td><td><?= $link['numer_pesel'] ?></td>
				<td><?= $link['imie_l'] ?></td><td><?= $link['nazwisko_l'] ?></td>
				<td><?= $link['oddzial'] ?></td><td><?= $link['historia_choroby'] ?></td>
			</tr>
			<?php
			}
			?>
			</table>
			<?php
				require ('../skrypty/usun_p_s.php');
			}
			else {
				echo "Nie masz wystarczających uprawnień. Proszę się zalogować z uprawieniami pielęgniarki";
			}
		}
		else {
			echo 'Proszę się zalogować z uprawieniami pielęgniarki.';
		}
			?>
   	</div>
	</body>
</html>
	