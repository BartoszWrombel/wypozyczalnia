<?php
if (isset($_POST['submit'])) {
	// Sprawdzenie, czy data zwrotu jest późniejsza niż data wypożyczenia
	if ($_POST['data_wypozyczenia'] > $_POST['data_zwrotu']) {
		echo '<h3>Data zwrotu nie może być wcześniejsza niż data wypożyczenia.</h3>';
	} else {
		// Pobranie ceny za dzień danego samochod
		$sql = 'SELECT cena_za_dzien FROM samochod WHERE id_samochod = :id_samochod';
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id_samochod', $_POST['id_samochod'], PDO::PARAM_INT);
		$stmt->execute();
		$cena_za_dzien = $stmt->fetchColumn();

		// Obliczenie czasu upływającego od data_wypozyczenia do data_zwrotu
		$data_wypozyczenia = new DateTime($_POST['data_wypozyczenia']);
		$data_zwrotu = new DateTime($_POST['data_zwrotu']);
		$roznica_czasu = $data_wypozyczenia->diff($data_zwrotu);
		$ilosc_dni = $roznica_czasu->days;

		// W przypadku, kiedy jest wybrany ten sam dzień w dacie wypożyczenia i zwrotu jest liczone jako jeden dzień
		$ilosc_dni = ($_POST['data_wypozyczenia'] == $_POST['data_zwrotu']) ? 1 : $roznica_czasu->days;
		// Obliczenie kosztu całkowitego
		$koszt_calkowity = $ilosc_dni * $cena_za_dzien;
		// Sprawdzenie dostępności samochodu w danym terminie
		$sql_sprawdzenie = 'SELECT COUNT(*) 
						FROM wypozyczenia 
						WHERE id_samochod = :id_samochod
						AND ((data_wypozyczenia BETWEEN :data_wypozyczenia AND :data_zwrotu)
						OR (data_zwrotu BETWEEN :data_wypozyczenia AND :data_zwrotu))';

		$stmt_sprawdzenie = $pdo->prepare($sql_sprawdzenie);
		$stmt_sprawdzenie->bindValue(':id_samochod', $_POST['id_samochod'], PDO::PARAM_INT);
		$stmt_sprawdzenie->bindValue(':data_wypozyczenia', $_POST['data_wypozyczenia'], PDO::PARAM_STR);
		$stmt_sprawdzenie->bindValue(':data_zwrotu', $_POST['data_zwrotu'], PDO::PARAM_STR);
		$stmt_sprawdzenie->execute();
		$ilosc_wypozyczen = $stmt_sprawdzenie->fetchColumn();
		if ($ilosc_wypozyczen == 0) {

			$sql1 = 'INSERT INTO wypozyczenia(id_klient, id_samochod, data_wypozyczenia, data_zwrotu, koszt_calkowity, uwagi)
					VALUES (:id_klient, :id_samochod, :data_wypozyczenia, :data_zwrotu, :koszt_calkowity, :uwagi)';
			$stmt1 = $pdo->prepare($sql1);
			$stmt1->bindValue(':id_klient', $_POST['id_klient'], PDO::PARAM_INT);
			$stmt1->bindValue(':id_samochod', $_POST['id_samochod'], PDO::PARAM_INT);
			$stmt1->bindValue(':data_wypozyczenia', $_POST['data_wypozyczenia'], PDO::PARAM_STR);
			$stmt1->bindValue(':data_zwrotu', $_POST['data_zwrotu'], PDO::PARAM_STR);
			$stmt1->bindValue(':koszt_calkowity', $koszt_calkowity, PDO::PARAM_INT);
			$stmt1->bindValue(':uwagi', $_POST['uwagi'], PDO::PARAM_STR);

			$stmt1->execute();
			$dodany = $stmt1->fetch();
			//pobranie numeru ostatniego wynajmu w bazie (czyli tego, który został dodany)
			$nowy = $pdo->lastInsertId();
			// budowa zapytania w celu pobrania danych nowo dodanego wynajmu
			$sql2 = 'SELECT wypozyczenia.id_wypozyczenia, wypozyczenia.id_klient, klient.imie, 
			klient.nazwisko, samochod.id_samochod, samochod.marka, samochod.model, 
			wypozyczenia.data_wypozyczenia, wypozyczenia.data_zwrotu, 
			wypozyczenia.koszt_calkowity
			 FROM wypozyczenia
			 INNER JOIN klient ON wypozyczenia.id_klient = klient.id_klient
			 INNER JOIN samochod ON wypozyczenia.id_samochod = samochod.id_samochod
			 WHERE id_wypozyczenia = :id_wypozyczenia';
			$stmt2 = $pdo->prepare($sql2);
			$stmt2->bindValue(':id_wypozyczenia', $nowy, PDO::PARAM_INT);
			$stmt2->execute();
			$ostatni = $stmt2->fetch();
			if ($nowy > 0) {
				echo '<h3>Wypozyczono ' . $ostatni['marka'] . ' ' . $ostatni['model'] . ' dla ' . $ostatni['imie'] . ' ' . $ostatni['nazwisko'] . ' od ' . $ostatni['data_wypozyczenia'] . ' do ' . $ostatni['data_zwrotu'] . ' na ' . $ilosc_dni . ' dni za ' . $ostatni['koszt_calkowity'] . ' zł ' . '</h3>';
			}
		} else {
			// Samochód jest zajęty w danym terminie
			echo '<h3>Wybrany samochód jest już zajęty w podanym terminie. Wybierz inny termin lub inny samochód.</h3>';
		}
	}
}
