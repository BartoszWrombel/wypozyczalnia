<?php
	require '../baza.php';
	if (isset($_POST['submit'])) {
		//zliczenie ilości pacjentów o podanym numerze pesel (sprawdzenie czy pacjent o podanym numerze pesel istnieje)
		$sql = 'SELECT Count(nazwisko)
				FROM pacjent
				WHERE nazwisko = :nazwisko';
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':nazwisko', $_POST['nazwisko'], PDO::PARAM_STR);
		$stmt->execute();
		$ilosc_nazwisko = $stmt->fetchColumn();
		
		//zliczenie ilości pacjentów o podanym nazwisku (sprawdzenie czy pacjent o podanym nazwisku istnieje)
		$sql1 = 'SELECT Count(numer_pesel)
				FROM pacjent
				WHERE numer_pesel = :numer_pesel';
		$stmt1 = $pdo->prepare($sql1);
		$stmt1->bindValue(':numer_pesel', $_POST['numer_pesel'], PDO::PARAM_STR);
		$stmt1->execute();
		$ilosc_pesel = $stmt1->fetchColumn();
		
		
		if ($ilosc_nazwisko !== 0 || $ilosc_pesel !== 0) {
			//jeżeli ilość danego nazwiska i numeru pesel jest różna od 0, wówczas następuje wyszukiwanie danego pacjenta
			$sql2 = 'SELECT pacjent.imie,pacjent.nazwisko,pacjent.numer_pesel,lekarz.imie_l,lekarz.nazwisko_l,oddzialy.oddzial,pacjent.historia_choroby 
					FROM pacjent
					INNER JOIN lekarz ON pacjent.id_lekarz = lekarz.id_lekarz
					INNER JOIN oddzialy ON pacjent.id_oddzial = oddzialy.id_oddzial
					WHERE nazwisko like :nazwisko or numer_pesel = :numer_pesel';
			$stmt2 = $pdo -> prepare($sql2);
			$stmt2->bindValue(':nazwisko', $_POST['nazwisko'], PDO::PARAM_STR);
			$stmt2->bindValue(':numer_pesel', $_POST['numer_pesel'], PDO::PARAM_INT);
			$stmt2->execute();
			$wyszukany = $stmt2->fetchAll();
		}
		else {
			echo 'Podany pacjent w bazie nie istnieje.';
		}
	}
?>