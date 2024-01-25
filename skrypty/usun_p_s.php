<?php
	require '../baza.php';
	//sprawdzenie czy pacjent o podanym numerze pesel istnieje
		$sql1 = 'SELECT Count(numer_pesel)
				FROM pacjent
				WHERE numer_pesel = :numer_pesel';
		$stmt1 = $pdo->prepare($sql1);
		$stmt1->bindValue(':numer_pesel', $_POST['numer_pesel'], PDO::PARAM_STR);
		$stmt1->execute();
		$ilosc_pesel = $stmt1->fetchColumn();
		
		if ($ilosc_pesel !== 0) {	
			$sql2 = 'DELETE FROM pacjent
					WHERE numer_pesel = :numer_pesel';
			$stmt2 = $pdo -> prepare($sql2);
			$stmt2->bindValue(':numer_pesel', $_POST['numer_pesel'], PDO::PARAM_INT);
			$stmt2->execute();
			$pesel_del = $_POST['numer_pesel'];
	
			if ($_POST['numer_pesel'] != null) {
				
				echo 'Usunięto pacjenta: o NUMERZE PESEL: '.$pesel_del;
			}
			else {
				echo '<h4 style="color:red;">Nie wybrano pacjenta!</h4>';
			}
		}
		else {
			echo 'Podany pacjent w bazie nie istnieje.';
		}
?>