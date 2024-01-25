<?php
	require '../baza.php';
	require 'loguj_u_s.php';
		session_start();
		//sprawdzenie czy wpisany login istnieje w bazie danych
		if (isset($_SESSION['sesja'])) {
			unset($_SESSION['sesja']);
			echo "Jesteś wylogowany: </b>";
		}
		else {
			echo "Nie jesteś zalogowany";
		}
?>