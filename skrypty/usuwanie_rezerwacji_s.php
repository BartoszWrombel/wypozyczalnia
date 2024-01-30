<?php
require '../baza.php';


if (isset($_POST['usun_rezerwacje'])) {
	$id_wypozyczenia = $_POST['id_wypozyczenia'];

	// Sprawdzenie, czy rezerwacja o podanym identyfikatorze istnieje
	$sql_rezerwacje = 'SELECT COUNT(*) 
					   FROM wypozyczenia 
					   WHERE id_wypozyczenia = :id_wypozyczenia';
	$stmt_rezerwacje = $pdo->prepare($sql_rezerwacje);
	$stmt_rezerwacje->bindValue(':id_wypozyczenia', $id_wypozyczenia, PDO::PARAM_INT);
	$stmt_rezerwacje->execute();
	$ilosc_rezerwacji = $stmt_rezerwacje->fetchColumn();

	if ($ilosc_rezerwacji > 0) {
		// Usunięcie rezerwacji
		$sql_usun_rezerwacje = 'DELETE FROM wypozyczenia 
								WHERE id_wypozyczenia = :id_wypozyczenia';
		$stmt_usun_rezerwacje = $pdo->prepare($sql_usun_rezerwacje);
		$stmt_usun_rezerwacje->bindValue(':id_wypozyczenia', $id_wypozyczenia, PDO::PARAM_INT);

		if ($stmt_usun_rezerwacje->execute()) {
			echo 'Rezerwacja o identyfikatorze ' . $id_wypozyczenia . ' została usunięta.';
			// header("Location: {$_SERVER['PHP_SELF']}");
		} else {
			echo '<h4 style="color:red;">Błąd podczas usuwania rezerwacji!</h4>';
		}
	} else {
		echo 'Rezerwacja o podanym identyfikatorze nie istnieje.';
	}
}
