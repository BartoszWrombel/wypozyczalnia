<?php
	require '../baza.php';
	$sql = 'SELECT pacjent.imie,pacjent.nazwisko,pacjent.numer_pesel,lekarz.imie_l,lekarz.nazwisko_l,oddzialy.oddzial,pacjent.historia_choroby 
	FROM pacjent
	   INNER JOIN lekarz ON pacjent.id_lekarz = lekarz.id_lekarz
	   INNER JOIN oddzialy ON pacjent.id_oddzial = oddzialy.id_oddzial
	ORDER BY pacjent.nazwisko';
	
	$zapytanie = $pdo->query($sql); //wywołanie zapytanie sql zbudowanego wyżej
	$pacjenci = $zapytanie->fetchAll(); //przypisanie pobranych danych do zmiennej pacjenci w formie tablicy.
?>