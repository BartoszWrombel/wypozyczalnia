<?php
require '../baza.php';
//pobranie listy klient
$sql1 = 'SELECT id_klient, imie, nazwisko, pesel
			FROM klient';
$zapytanie = $pdo->query($sql1);
$k = $zapytanie->fetchAll();

//pobranie listy samochod
$sql2 = 'SELECT id_samochod, marka, model, wariant, kolor, numer_rejestracyjny, rok_produkcji, cena_za_dzien, status_samochodu
			FROM samochod';
$zapytanie = $pdo->query($sql2);
$s = $zapytanie->fetchAll();
