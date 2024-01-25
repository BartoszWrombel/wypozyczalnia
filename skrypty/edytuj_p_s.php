<?php
	require '../baza.php';
	if (isset($_POST['submit']))
	{
		//sprawdzenie czy pacjent o podanym numerze pesel istnieje
		$sql = 'SELECT Count(numer_pesel)
				FROM pacjent
				WHERE numer_pesel = :numer_pesel';
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':numer_pesel', $_POST['numer_pesel'], PDO::PARAM_STR);
		$stmt->execute();
		$ilosc_pesel = $stmt->fetchColumn();
		
		if ($ilosc_pesel !== 0) 
		{	
			$sql1 = 'UPDATE pacjent SET historia_choroby = :historia_choroby WHERE  numer_pesel = :numer_pesel';
			$stmt1 = $pdo -> prepare($sql1);
			$stmt1->bindValue(':numer_pesel', $_POST['numer_pesel'], PDO::PARAM_INT);
			$stmt1->bindValue(':historia_choroby', $_POST['historia_choroby'], PDO::PARAM_STR);
			$stmt1->execute();
			$pacjent_up = $stmt1->fetch();
			$numer_pesel = $_POST['numer_pesel'];
			if($pacjent_up !== null)
			{
				echo '<h3>Zaktualizowano dane pacjenta o numerze PESEL = ' . $numer_pesel.'</h3>';
			} 
			else 
			{
				echo '<h3>Wystąpił błąd</h3>';
			}
		}
		else
		{
			echo 'Podany pacjent w bazie nie istnieje.';
		}
	}
?>