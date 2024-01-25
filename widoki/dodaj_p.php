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
	<h2>Zarejestruj pacjenta</h2>
	<?php
		session_start();
		if(isset($_SESSION['sesja'])) {
			if ($_SESSION['uprawnienia'] == 'pielęgniarka') {
			require '../skrypty/wczytywanie_l_s.php';
		?>
		<form name="dane" action="dodaj_p.php" method="post">
			<div class="left">
			<p><input type="text" name="imie" required placeholder="podaj imię" /></p>
			<p><input type="text" name="nazwisko" required placeholder="podaj nazwisko" /></p>
			<p><input type="number" name="numer_pesel" required  placeholder="podaj numer pesel" /></p>
			<select name="id_miejscowosc" placeholder="podaj miejscowość" style="float:left">
				<option value="" disabled selected hidden>wybierz miejscowość</option>
			<?php
			foreach ($m as $mi => $link) {
				$mi = $mi+1;
				?>

			  <option value=<?=$mi ?> ><?=$mi ?>-<?=$link['miejscowosc'] ?></option>
			<?php
			}
			?>
			</select>

			<p>
			<select name="id_wiek">
			<option value="" disabled selected hidden>wybierz wiek</option>
			<?php
			foreach ($w as $wi => $link) {
				$wi = $wi+1;
				?>
			  <option value=<?=$wi ?> ><?=$link['wiek'] ?></option>
			<?php
			}
			?>
			</select>
			</div>

			<div class="right">
			<p>
			<select name="id_oddzial">
			<option value="" disabled selected hidden>wybierz oddział</option>
			<?php
			foreach ($o as $od => $link) {
				$od = $od+1;
				?>
			  <option value=<?=$od ?> ><?=$od ?>-<?=$link['oddzial'] ?></option>
			<?php
			}
			?>
			</select>

			<p>
			<select name="id_lekarz">
			<option value="" disabled selected hidden>wybierz lekarza</option>
			<?php
			foreach ($l as $lek => $link) {
				$lek = $lek+1;
				?>
			  <option value=<?=$lek ?> ><?=$lek ?>-<?=$link['imie_l'] ?> <?=$link['nazwisko_l'] ?> </option>
			<?php
			}
			?>
			</select>

			<p><textarea name="historia_choroby" required placeholder="historia choroby" ></textarea></p>

			</div>
			<input type="submit" name="submit" value="Dodaj" style="float:right;width:10%;margin:5% 2% 0% 0%;border:0px solid black;" />
		</form>
		<div style="clear:both;">
		<?php
			require '../skrypty/dodaj_p_s.php';
		?>
		</div>
		<?php
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