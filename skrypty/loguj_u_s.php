<?php
require '../baza.php';
if (isset($_POST['submit'])) {
	//zapytanie SQL o dane użytkownika
	$sql = 'SELECT login, haslo, uprawnienia.nazwa_uprawnienia
				FROM users
				INNER JOIN uprawnienia ON users.id_uprawnienia = uprawnienia.id_uprawnienia
				WHERE login = :login';
	$haslo = $_POST['haslo'];
	$login = $_POST['login'];
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(':login', $login, PDO::PARAM_STR);
	//$stmt->bindValue(':haslo', $haslo, PDO::PARAM_STR);
	//wykonanie zapytania SQL
	$stmt->execute();
	$user = $stmt->fetch();
	//sprawdzenie czy wpisany login istnieje w bazie danych
	if ($user) {
		//jeżeli istnieje to sprawdzamy zgodność haseł.
		$autoryzacja = password_verify($haslo, $user['haslo']);
		if ($autoryzacja) {
			session_start();
			$_SESSION['sesja'] = true;
			$_SESSION['nazwa_uprawnienia'] = $user['nazwa_uprawnienia'];
			echo "Jesteś zalogowany jako: " . "<b>" . $user['login'] . "</b>";
		} else {
			echo "Błędne hasło";
		}
	} else {
		echo "Błędny login. Nie ma takiego użytkownika.";
	}
}
