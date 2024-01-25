<?php
	require '../baza.php';
	$sql = 'SELECT oddzialy.oddzial,Count(pacjent.numer_pesel) As ilosc
	FROM pacjent
	   INNER JOIN oddzialy ON pacjent.id_oddzial = oddzialy.id_oddzial
	GROUP BY oddzialy.oddzial
	ORDER BY oddzialy.oddzial DESC';
	
	$zapytanie = $pdo->query($sql); //wywołanie zapytanie sql zbudowanego wyżej
	$pacjenci = $zapytanie->fetchAll(); //przypisanie pobranych danych do zmiennej pacjenci w formie tablicy.
?>

