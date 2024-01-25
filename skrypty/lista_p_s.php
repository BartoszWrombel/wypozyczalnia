<?php
require '../baza.php';
$sql = 'SELECT imie, nazwisko, pesel
	FROM klient
	ORDER BY nazwisko';

$zapytanie = $pdo->query($sql); //wywołanie zapytanie sql zbudowanego wyżej
$klienci = $zapytanie->fetchAll(); //przypisanie pobranych danych do zmiennej w formie tablicy.


$sql1 = 'SELECT marka, model, wariant, kolor, numer_rejestracyjny, rok_produkcji, cena_za_dzien, status_samochodu
	FROM samochod
	ORDER BY cena_za_dzien';

$zapytanie = $pdo->query($sql1); //wywołanie zapytanie sql zbudowanego wyżej
$samochody = $zapytanie->fetchAll(); //przypisanie pobranych danych do zmiennej w formie tablicy.


$sql2 = 'SELECT wypozyczenia.id_wypozyczenia, klient.imie, klient.nazwisko, klient.pesel, 
	samochod.marka, samochod.model, samochod.wariant, samochod.kolor, samochod.numer_rejestracyjny, 
	samochod.rok_produkcji, samochod.cena_za_dzien, samochod.status_samochodu, 
	wypozyczenia.data_wypozyczenia, wypozyczenia.data_zwrotu, wypozyczenia.koszt_calkowity, wypozyczenia.uwagi 
	FROM wypozyczenia
	INNER JOIN klient ON wypozyczenia.id_klient = klient.id_klient
	INNER JOIN samochod ON wypozyczenia.id_samochod = samochod.id_samochod
	ORDER BY wypozyczenia.data_wypozyczenia';

$zapytanie = $pdo->query($sql2); //wywołanie zapytanie sql zbudowanego wyżej
$wypozyczenia = $zapytanie->fetchAll(); //przypisanie pobranych danych do zmiennej w formie tablicy.
