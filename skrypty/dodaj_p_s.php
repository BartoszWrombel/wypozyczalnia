<?php
	if (isset($_POST['submit'])) {	
		//sprawdzenie czy pacjent o podanym numerze pesel istnieje
		$sql = 'SELECT Count(numer_pesel)
				FROM pacjent
				WHERE numer_pesel = :numer_pesel';
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':numer_pesel', $_POST['numer_pesel'], PDO::PARAM_STR);
		$stmt->execute();
		$ilosc_pesel = $stmt->fetchColumn();
		if ($ilosc_pesel == 0) {	
			$sql1 = 'INSERT INTO pacjent(imie,nazwisko,numer_pesel,id_miejscowosc,id_wiek,id_oddzial,id_lekarz,historia_choroby)
					VALUES (:imie,:nazwisko,:numer_pesel,:id_miejscowosc,:id_wiek,:id_oddzial,:id_lekarz,:historia_choroby)';
			$stmt1 = $pdo->prepare($sql1);
			$stmt1->bindValue(':imie', $_POST['imie'], PDO::PARAM_STR);
			$stmt1->bindValue(':nazwisko', $_POST['nazwisko'], PDO::PARAM_STR);
			$stmt1->bindValue(':numer_pesel', $_POST['numer_pesel'], PDO::PARAM_INT);
			$stmt1->bindValue(':id_miejscowosc', $_POST['id_miejscowosc'], PDO::PARAM_INT);
			$stmt1->bindValue(':id_wiek', $_POST['id_wiek'], PDO::PARAM_INT);
			$stmt1->bindValue(':id_oddzial', $_POST['id_oddzial'], PDO::PARAM_INT);
			$stmt1->bindValue(':id_lekarz', $_POST['id_lekarz'], PDO::PARAM_INT);
			$stmt1->bindValue(':historia_choroby', $_POST['historia_choroby'], PDO::PARAM_STR);
			$stmt1->execute();
			$dodany = $stmt1->fetch();
			//pobranie numeru ostatniego pacjenta w bazie (czyli tego, który został dodany)
			$nowy = $pdo->lastInsertId();
			// budowa zapytania w celu pobrania danych nowo dodanego pacjenta
			$sql2 = 'SELECT id_pacjent, imie, nazwisko, numer_pesel
					FROM pacjent
					WHERE id_pacjent = :id_pacjent';
			$stmt2 = $pdo->prepare($sql2);
			$stmt2->bindValue(':id_pacjent', $nowy, PDO::PARAM_INT);
			$stmt2->execute();
			$ostatni = $stmt2->fetch();
			if ($nowy>1) {
				echo '<h3>Dodano pacjenta: '.$ostatni['imie'].' '.$ostatni['nazwisko'].'</h3>';
			}
		}
		else {
			echo 'Pacjent o podanym numerze pesel: '.$_POST['numer_pesel'].' już istnieje';
		}
	}
?>