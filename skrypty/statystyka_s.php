<?php
require '../baza.php';
//Zliczanie ilości i wartości wypożyczonych samochodów po każdym dniu
$sql1 = 'SELECT data_wypozyczenia, COUNT(*) as ilosc, SUM(koszt_calkowity) as wartosc
	FROM wypozyczenia
	GROUP BY data_wypozyczenia';

$zapytanie1 = $pdo->query($sql1); //wywołanie zapytanie sql zbudowanego wyżej
$wyniki_dzien = $zapytanie1->fetchAll(); //przypisanie pobranych danych do zmiennej w formie tablicy.

//Zliczanie ilości i wartości wypożyczonych samochodów po każdym miesiącu 
$sql2 = 'SELECT DATE_FORMAT(data_wypozyczenia, "%Y-%m") as miesiac, COUNT(*) as ilosc, SUM(koszt_calkowity) as wartosc
        FROM wypozyczenia
        GROUP BY miesiac';
$zapytanie2 = $pdo->query($sql2);
$wyniki_miesiac = $zapytanie2->fetchAll();
//Zliczanie ilości i wartości wypożyczonych samochodów według marki po każdym dniu 
$sql3 = 'SELECT data_wypozyczenia, marka, COUNT(*) as ilosc, SUM(koszt_calkowity) as wartosc
        FROM wypozyczenia
        INNER JOIN samochod ON wypozyczenia.id_samochod = samochod.id_samochod
        GROUP BY data_wypozyczenia, marka';
$zapytanie3 = $pdo->query($sql3);
$wyniki_marka_dzien = $zapytanie3->fetchAll();
//Zliczanie ilości i wartości wypożyczonych samochodów według koloru po każdym miesiącu 
$sql4 = 'SELECT DATE_FORMAT(data_wypozyczenia, "%Y-%m") as miesiac, kolor, COUNT(*) as ilosc, SUM(koszt_calkowity) as wartosc
        FROM wypozyczenia
        INNER JOIN samochod ON wypozyczenia.id_samochod = samochod.id_samochod
        GROUP BY miesiac, kolor';
$zapytanie4 = $pdo->query($sql4);
$wyniki_kolor_miesiac = $zapytanie4->fetchAll();
//Marka samochodu najczęściej wypożyczanego w miesiącu. 
$sql5 = 'SELECT DATE_FORMAT(data_wypozyczenia, "%Y-%m") as miesiac, marka, COUNT(*) as ilosc
        FROM wypozyczenia
        INNER JOIN samochod ON wypozyczenia.id_samochod = samochod.id_samochod
        GROUP BY miesiac, marka
        ORDER BY ilosc DESC
        LIMIT 1';
$zapytanie5 = $pdo->query($sql5);
$najczestsza_marka_miesiac = $zapytanie5->fetchAll();
