<?php
	require '../baza.php';
	//pobranie listy miejscowości
	$sql1 = 'SELECT id_miejscowosc, miejscowosc
			FROM miejscowosc';
	$zapytanie = $pdo->query($sql1);
	$m = $zapytanie->fetchAll();

//pobranie listy wieku
	$sql2 = 'SELECT id_wiek, wiek
			FROM wiek';
	$zapytanie = $pdo->query($sql2);
	$w = $zapytanie->fetchAll();

//pobranie listy oddziałów	
	$sql3 = 'SELECT id_oddzial, oddzial
			FROM oddzialy';
	$zapytanie = $pdo->query($sql3);
	$o = $zapytanie->fetchAll();

//pobranie listy lekarzy
	$sql4 = 'SELECT id_lekarz, imie_l, nazwisko_l
			FROM lekarz';
	$zapytanie = $pdo->query($sql4);
	$l = $zapytanie->fetchAll();
?>