<?php
require '../baza.php';
//pobranie listy klient
$sql1 = 'SELECT id_klient, imie, nazwisko, pesel
			FROM klient';
$zapytanie = $pdo->query($sql1);
$k = $zapytanie->fetchAll();

//pobranie listy samochod
$sql2 = 'SELECT id_samochod, marka, model, kolor, numer_rejestracyjny, rok_produkcji, cena_za_dzien
			FROM samochod';
$zapytanie = $pdo->query($sql2);
$s = $zapytanie->fetchAll();

//pobranie listy uprawnienia
$sql3 = 'SELECT id_uprawnienia, nazwa_uprawnienia
			FROM uprawnienia';
$zapytanie = $pdo->query($sql3);
$u = $zapytanie->fetchAll();
