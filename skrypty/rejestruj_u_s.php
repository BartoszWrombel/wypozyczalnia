<?php
require '../baza.php';
if (isset($_POST['submit'])) {
	//sprawdzenie czy hasło spełnia wymagania
	$haslo = $_POST['password1'];
	if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}$/", $haslo)) {
		echo 'Hasło nie spełnia wymagań. Wymagane: co najmniej 8 znaków, jedna cyfra, jedna mała litera, jedna duża litera, jeden znak specjalny.';
		exit();
	}

	//sprawdzenie unikalności podanego loginu
	$sql = 'SELECT Count(login)
				FROM users
				WHERE login = :login';
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(':login', $_POST['login'], PDO::PARAM_STR);
	$stmt->execute();
	$ilosc = $stmt->fetchColumn();

	if ($ilosc == 0) {
		//dodanie nowego uzytkownika
		$sql1 = 'INSERT INTO users(login,haslo,email,id_uprawnienia) VALUES (:login,:haslo,:email,:id_uprawnienia)';

		//szyfrowanie hasła podanego w formularzu
		$hash = password_hash($_POST['password1'], PASSWORD_DEFAULT);

		$stmt1 = $pdo->prepare($sql1);
		$stmt1->bindValue(':login', $_POST['login'], PDO::PARAM_STR);
		$stmt1->bindValue(':haslo', $hash, PDO::PARAM_STR);
		$stmt1->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
		$stmt1->bindValue(':id_uprawnienia', $_POST['id_uprawnienia'], PDO::PARAM_INT);
		$stmt1->execute();
		echo 'Konto zostało utworzone.Dodano użytkownika: ' . $_POST['login'];
	} else {
		echo 'Podany login ' . '<b>' . $_POST['login'] . '</b>' . ' jest już zajęty. Podaj inną nazwę';
	}
}
