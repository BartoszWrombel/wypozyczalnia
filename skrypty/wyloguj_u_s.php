<?php
require '../baza.php';
require 'loguj_u_s.php';
session_start();
//sprawdzenie czy sesja istnieje
if (isset($_SESSION['sesja'])) {
	unset($_SESSION['sesja']);
	echo "Jesteś wylogowany: </b>";
} else {
	echo "Nie jesteś zalogowany";
}
