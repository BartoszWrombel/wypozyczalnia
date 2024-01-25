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
	<h2>Edycja danych pacjenta</h2>
	
	<?php
		session_start();
		if(isset($_SESSION['sesja'])) {
			if ($_SESSION['uprawnienia'] == 'lekarz') {
		?>
				<form name="dane" action="edytuj_p.php" method="post">
				<input type="number" name="numer_pesel" placeholder="podaj numer pesel" style="width:20%;display:inline;text-align:center;margin-bottom:0px;" />
				<p><textarea name="historia_choroby" required placeholder="historia choroby" style="resize:vertical;width:80%;resize:horizontal;max-height:250px;min-height:100px;"></textarea></p>
				<input type="submit" name="submit" value="Zmień" style="width:20%;display:inline;margin:0px;" />
				</form>
				<?php
				require ('../skrypty/edytuj_p_s.php');
			}
			else {
				echo 'Nie masz wystarczających uprawnień. Proszę się zalogować z uprawieniami lekarza.';
			} 
		}
		else {
			echo 'Proszę się zalogować z uprawieniami lekarza.';
		}

		?>
	</div>
	</body>
</html>