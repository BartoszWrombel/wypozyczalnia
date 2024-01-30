<?php
require '../baza.php';
if (isset($_POST['wyszukaj_samochod'])) {
	if (empty($_POST['marka']) && empty($_POST['model']) && empty($_POST['kolor']) && empty($_POST['numer_rejestracyjny']) && empty($_POST['rok_produkcji']) && empty($_POST['cena_za_dzien']) && empty($_POST['data_wypozyczenia'])) {
		echo 'Proszę podać przynajmniej jedno kryterium wyszukiwania.';
	} else {
		$sql1 = 'SELECT Count(marka)
				FROM samochod
				WHERE marka = :marka';
		$stmt1 = $pdo->prepare($sql1);
		$stmt1->bindValue(':marka', $_POST['marka'], PDO::PARAM_STR);
		$stmt1->execute();
		$ilosc_marka = $stmt1->fetchColumn();

		$sql2 = 'SELECT Count(model)
				FROM samochod
				WHERE model = :model';
		$stmt2 = $pdo->prepare($sql2);
		$stmt2->bindValue(':model', $_POST['model'], PDO::PARAM_STR);
		$stmt2->execute();
		$ilosc_model = $stmt2->fetchColumn();

		$sql3 = 'SELECT Count(kolor)
				FROM samochod
				WHERE kolor = :kolor';
		$stmt3 = $pdo->prepare($sql3);
		$stmt3->bindValue(':kolor', $_POST['kolor'], PDO::PARAM_STR);
		$stmt3->execute();
		$ilosc_kolor = $stmt3->fetchColumn();

		$sql4 = 'SELECT Count(numer_rejestracyjny)
				FROM samochod
				WHERE numer_rejestracyjny = :numer_rejestracyjny';
		$stmt4 = $pdo->prepare($sql4);
		$stmt4->bindValue(':numer_rejestracyjny', $_POST['numer_rejestracyjny'], PDO::PARAM_STR);
		$stmt4->execute();
		$ilosc_numer_rejestracyjny = $stmt4->fetchColumn();

		$sql5 = 'SELECT Count(rok_produkcji)
				FROM samochod
				WHERE rok_produkcji = :rok_produkcji';
		$stmt5 = $pdo->prepare($sql5);
		$stmt5->bindValue(':rok_produkcji', $_POST['rok_produkcji'], PDO::PARAM_INT);
		$stmt5->execute();
		$ilosc_rok_produkcji = $stmt5->fetchColumn();

		$sql6 = 'SELECT Count(cena_za_dzien)
				FROM samochod
				WHERE cena_za_dzien = :cena_za_dzien';
		$stmt6 = $pdo->prepare($sql6);
		$stmt6->bindValue(':cena_za_dzien', $_POST['cena_za_dzien'], PDO::PARAM_INT);
		$stmt6->execute();
		$ilosc_cena_za_dzien = $stmt6->fetchColumn();

		$sql7 = 'SELECT Count(data_wypozyczenia)
				FROM wypozyczenia
				WHERE data_wypozyczenia = :data_wypozyczenia';
		$stmt7 = $pdo->prepare($sql7);
		$stmt7->bindValue(':data_wypozyczenia', $_POST['data_wypozyczenia'], PDO::PARAM_STR);
		$stmt7->execute();
		$ilosc_data_wypozyczenia = $stmt7->fetchColumn();

		if ($ilosc_marka !== 0 || $ilosc_model !== 0 || $ilosc_kolor !== 0 || $ilosc_numer_rejestracyjny !== 0 || $ilosc_rok_produkcji !== 0 || $ilosc_cena_za_dzien !== 0 || $ilosc_data_wypozyczenia !== 0) {
			$sql8 = 'SELECT samochod.marka,samochod.model,samochod.kolor,samochod.numer_rejestracyjny,samochod.rok_produkcji,samochod.cena_za_dzien,wypozyczenia.data_wypozyczenia
					FROM samochod
					INNER JOIN wypozyczenia ON samochod.id_samochod = wypozyczenia.id_samochod
					WHERE marka like :marka or model like :model or kolor like :kolor or numer_rejestracyjny like :numer_rejestracyjny or rok_produkcji = :rok_produkcji or cena_za_dzien = :cena_za_dzien or data_wypozyczenia = :data_wypozyczenia
					ORDER BY samochod.cena_za_dzien';
			$stmt8 = $pdo->prepare($sql8);
			$stmt8->bindValue(':marka', $_POST['marka'], PDO::PARAM_STR);
			$stmt8->bindValue(':model', $_POST['model'], PDO::PARAM_STR);
			$stmt8->bindValue(':kolor', $_POST['kolor'], PDO::PARAM_STR);
			$stmt8->bindValue(':numer_rejestracyjny', $_POST['numer_rejestracyjny'], PDO::PARAM_STR);
			$stmt8->bindValue(':rok_produkcji', $_POST['rok_produkcji'], PDO::PARAM_INT);
			$stmt8->bindValue(':cena_za_dzien', $_POST['cena_za_dzien'], PDO::PARAM_INT);
			$stmt8->bindValue(':data_wypozyczenia', $_POST['data_wypozyczenia'], PDO::PARAM_STR);
			$stmt8->execute();
			$samochod_wyszukany = $stmt8->fetchAll();
		} else {
			echo 'Podany samochód w bazie nie istnieje.';
		}
	}
}
?>

<?php
require '../baza.php';
if (isset($_POST['dodaj_samochod'])) {
	// Sprawdzenie, czy żadne pole nie jest puste
	if (empty($_POST['marka']) || empty($_POST['model']) || empty($_POST['kolor']) || empty($_POST['numer_rejestracyjny']) || empty($_POST['rok_produkcji']) || empty($_POST['cena_za_dzien'])) {
		echo 'Wszystkie pola muszą być wypełnione.';
	} else {

		// Sprawdzenie dostępności samochodu w danym terminie
		$sql_sprawdzenie1 = 'SELECT COUNT(numer_rejestracyjny)
							FROM samochod
							WHERE numer_rejestracyjny = :numer_rejestracyjny';
		$stmt_sprawdzenie1 = $pdo->prepare($sql_sprawdzenie1);
		$stmt_sprawdzenie1->bindValue(':numer_rejestracyjny', $_POST['numer_rejestracyjny'], PDO::PARAM_STR);
		$stmt_sprawdzenie1->execute();
		$ilosc_numer_rejestracyjny = $stmt_sprawdzenie1->fetchColumn();

		if ($ilosc_numer_rejestracyjny == 0) {
			$sql20 = 'INSERT INTO samochod(marka, model, kolor, numer_rejestracyjny, rok_produkcji, cena_za_dzien)
					VALUES (:marka, :model, :kolor, :numer_rejestracyjny, :rok_produkcji, :cena_za_dzien)';
			$stmt20 = $pdo->prepare($sql20);
			$stmt20->bindValue(':marka', $_POST['marka'], PDO::PARAM_STR);
			$stmt20->bindValue(':model', $_POST['model'], PDO::PARAM_STR);
			$stmt20->bindValue(':kolor', $_POST['kolor'], PDO::PARAM_STR);
			$stmt20->bindValue(':numer_rejestracyjny', $_POST['numer_rejestracyjny'], PDO::PARAM_STR);
			$stmt20->bindValue(':rok_produkcji', $_POST['rok_produkcji'], PDO::PARAM_INT);
			$stmt20->bindValue(':cena_za_dzien', $_POST['cena_za_dzien'], PDO::PARAM_INT);
			$executeResult = $stmt20->execute();
			if ($executeResult) {
				//pobranie numeru ostatniego samochodu w bazie (czyli tego, który został dodany)
				$nowy_samochod = $pdo->lastInsertId();
				// budowa zapytania w celu pobrania danych nowo dodanego samochodu
				$sql21 = 'SELECT samochod.marka,samochod.model,samochod.kolor,samochod.numer_rejestracyjny,samochod.rok_produkcji,samochod.cena_za_dzien
					FROM samochod
					WHERE numer_rejestracyjny = :numer_rejestracyjny';
				$stmt21 = $pdo->prepare($sql21);
				$stmt21->bindValue(':numer_rejestracyjny', $_POST['numer_rejestracyjny'], PDO::PARAM_STR);
				$stmt21->execute();
				$ostatni_samochod = $stmt21->fetch();
				if ($nowy_samochod > 0) {
					echo '<h3>Dodano samochód ' . $ostatni_samochod['marka'] . ' ' . $ostatni_samochod['model'] . ' ' . $ostatni_samochod['kolor'] . ' ' . $ostatni_samochod['numer_rejestracyjny'] . ' ' . $ostatni_samochod['rok_produkcji'] . ' ' . $ostatni_samochod['cena_za_dzien'] . ' zł ' . '</h3>';
				}
			} else {
				echo 'Wystąpił błąd podczas dodawania samochodu.';
			}
		} else {
			echo 'Podany samochód w bazie już istnieje.';
		}
	}
}
?>

<?php
require '../baza.php';

if (isset($_POST['usun_samochod'])) {
	$numer_rejestracyjny = $_POST['numer_rejestracyjny'];
	if (empty($numer_rejestracyjny)) {
		echo 'Podaj numer rejestracyjny samochodu.';
	} else {
		// Sprawdzenie, czy samochód o podanym numerze rejestracyjnym istnieje
		$sql_samochod = 'SELECT COUNT(*) 
					   FROM samochod 
					   WHERE numer_rejestracyjny = :numer_rejestracyjny';
		$stmt_samochod = $pdo->prepare($sql_samochod);
		$stmt_samochod->bindValue(':numer_rejestracyjny', $numer_rejestracyjny, PDO::PARAM_STR);
		$stmt_samochod->execute();
		$ilosc_samochod = $stmt_samochod->fetchColumn();

		if ($ilosc_samochod > 0) {
			// Usunięcie samochodu
			$sql_usun_samochod = 'DELETE FROM samochod 
								WHERE numer_rejestracyjny = :numer_rejestracyjny';
			$stmt_usun_samochod = $pdo->prepare($sql_usun_samochod);
			$stmt_usun_samochod->bindValue(':numer_rejestracyjny', $numer_rejestracyjny, PDO::PARAM_STR);

			if ($stmt_usun_samochod->execute()) {
				echo 'Samochód o numerze rejestracyjnym ' . $numer_rejestracyjny . ' został usunięty.';
				// header("Location: {$_SERVER['PHP_SELF']}");
			} else {
				echo '<h4 style="color:red;">Błąd podczas usuwania samochodu!</h4>';
			}
		} else {
			echo 'Samochód o podanym numerze rejestracyjnym nie istnieje.';
		}
	}
}
?>
