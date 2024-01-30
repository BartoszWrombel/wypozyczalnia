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
			if ($_SESSION['nazwa_uprawnienia'] == 'Administrator') {
				require '../skrypty/wczytywanie_l_s.php';
		?>
				<h2>Rejestracja nowego użytkownika</h2>

				<div class="left" style="margin-left:150px;padding:30px 10px 0px 10px;">
					<form action="rejestruj.php" method="post">
						<p><input type="text" name="login" placeholder="podaj login" required /></p>
						<p><input type="password" name="password1" placeholder="podaj hasło" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}" title="Hasło musi zawierać co najmniej jedną cyfrę, jedną małą literę, jedną dużą literę, jeden znak specjalny i mieć co najmniej 8 znaków" /></p>
						<p><input type="email" name="email" placeholder="podaj email" required /></p>
						<p>
							<select name="id_uprawnienia" required>
								<option value="" disabled selected hidden>wybierz poziom uprawnień</option>
								<?php
								foreach ($u as $upra => $link) {
									$upra = $upra + 1;
								?>
									<option value=<?= $upra ?>><?= $upra ?> - <?= $link['nazwa_uprawnienia'] ?> </option>
								<?php
								}
								?>
							</select>
						</p>
						<input type="submit" name="submit" value="rejestruj" />
					</form>
			<?php
				require '../skrypty/rejestruj_u_s.php';
			} else {
				echo '<h2 style="color: red; font-weight: bold;">Nie masz uprawnień do wyświetlenia tej strony.</h2>';
			}
		} else {
			echo '<h2 style="color: red; font-weight: bold;">Proszę się zalogować.</h2>';
		}
			?>
				</div>

	</div>
	</br> </br> </br> </br> </br> </br> </br> </br> </br> </br> </br> </br> </br> </br> </br> </br>

	<footer>
		<p>&copy; 2024 Wypożyczalnia samochodów. Wszelkie prawa zastrzeżone.</p>
		<p>Adres: ul. Przykładowa 123, 00-000 Warszawa</p>
		<p>Telefon: +48 123 456 789</p>
		<p>Email: info@wypozyczalnia-samochodow.pl</p>
		<p>Autor: Bartosz Wrombel</p>
	</footer>
</body>

</html>