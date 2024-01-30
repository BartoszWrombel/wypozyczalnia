<?php
require '../baza.php';
if (isset($_POST['wyszukaj_klienta'])) {
    if (empty($_POST['imie']) && empty($_POST['nazwisko']) && empty($_POST['pesel'])) {
        echo 'Proszę podać przynajmniej jedno kryterium wyszukiwania.';
    } else {
        $sql1 = 'SELECT COUNT(imie)
                FROM klient
                WHERE imie = :imie';
        $stmt1 = $pdo->prepare($sql1);
        $stmt1->bindValue(':imie', $_POST['imie'], PDO::PARAM_STR);
        $stmt1->execute();
        $ilosc_imie = $stmt1->fetchColumn();

        $sql2 = 'SELECT COUNT(nazwisko)
                FROM klient
                WHERE nazwisko = :nazwisko';
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->bindValue(':nazwisko', $_POST['nazwisko'], PDO::PARAM_STR);
        $stmt2->execute();
        $ilosc_nazwisko = $stmt2->fetchColumn();

        $sql3 = 'SELECT COUNT(pesel)
                FROM klient
                WHERE pesel = :pesel';
        $stmt3 = $pdo->prepare($sql3);
        $stmt3->bindValue(':pesel', $_POST['pesel'], PDO::PARAM_STR);
        $stmt3->execute();
        $ilosc_pesel = $stmt3->fetchColumn();

        if ($ilosc_imie !== 0 || $ilosc_nazwisko !== 0 || $ilosc_pesel !== 0) {
            $sql6 = 'SELECT klient.imie,klient.nazwisko,klient.pesel
                    FROM klient
                    WHERE imie LIKE :imie OR nazwisko LIKE :nazwisko OR pesel = :pesel
                    ORDER BY klient.nazwisko';
            $stmt6 = $pdo->prepare($sql6);
            $stmt6->bindValue(':imie', $_POST['imie'], PDO::PARAM_STR);
            $stmt6->bindValue(':nazwisko', $_POST['nazwisko'], PDO::PARAM_STR);
            $stmt6->bindValue(':pesel', $_POST['pesel'], PDO::PARAM_STR);
            $stmt6->execute();
            $klient_wyszukany = $stmt6->fetchAll();
        } else {
            echo 'Podany klient w bazie nie istnieje.';
        }
    }
}
?>
    
<?php
require '../baza.php';
if (isset($_POST['dodaj_klienta'])) {
    // Sprawdzenie, czy żadne pole nie jest puste
    if (empty($_POST['imie']) || empty($_POST['nazwisko']) || empty($_POST['pesel'])) {
        echo 'Wszystkie pola muszą być wypełnione.';
    } else {
        // Sprawdzenie, czy klient o podanym peselu istnieje
        $sql_sprawdzenie = 'SELECT COUNT(*) 
                            FROM klient 
                            WHERE pesel = :pesel';
        $stmt_sprawdzenie = $pdo->prepare($sql_sprawdzenie);
        $stmt_sprawdzenie->bindValue(':pesel', $_POST['pesel'], PDO::PARAM_STR);
        $stmt_sprawdzenie->execute();
        $ilosc_klient = $stmt_sprawdzenie->fetchColumn();

        if ($ilosc_klient == 0) {
            $sql_dodaj_klienta = 'INSERT INTO klient(imie, nazwisko, pesel)
                                VALUES (:imie, :nazwisko, :pesel)';
            $stmt_dodaj_klienta = $pdo->prepare($sql_dodaj_klienta);
            $stmt_dodaj_klienta->bindValue(':imie', $_POST['imie'], PDO::PARAM_STR);
            $stmt_dodaj_klienta->bindValue(':nazwisko', $_POST['nazwisko'], PDO::PARAM_STR);
            $stmt_dodaj_klienta->bindValue(':pesel', $_POST['pesel'], PDO::PARAM_STR);
            $executeResult = $stmt_dodaj_klienta->execute();

            if ($executeResult) {
                echo 'Dodano klienta ' . $_POST['imie'] . ' ' . $_POST['nazwisko'] . ' o peselu ' . $_POST['pesel'] . '.';
            } else {
                echo 'Wystąpił błąd podczas dodawania klienta.';
            }
        } else {
            echo 'Klient o podanym peselu już istnieje.';
        }
    }
}
?>

<?php
require '../baza.php';
if (isset($_POST['usun_klienta'])) {
    $pesel = $_POST['pesel'];
    if (empty($pesel)) {
        echo 'Podaj numer PESEL klienta.';
    } else {
        // Sprawdzenie, czy klient o podanym numerze PESEL istnieje
        $sql_klient = 'SELECT COUNT(*) 
					   FROM klient 
					   WHERE pesel = :pesel';
        $stmt_klient = $pdo->prepare($sql_klient);
        $stmt_klient->bindValue(':pesel', $pesel, PDO::PARAM_STR);
        $stmt_klient->execute();
        $ilosc_klient = $stmt_klient->fetchColumn();

        if ($ilosc_klient > 0) {
            // Usunięcie klienta
            $sql_usun_klienta = 'DELETE FROM klient 
								WHERE pesel = :pesel';
            $stmt_usun_klienta = $pdo->prepare($sql_usun_klienta);
            $stmt_usun_klienta->bindValue(':pesel', $pesel, PDO::PARAM_STR);

            if ($stmt_usun_klienta->execute()) {
                echo 'Klient o numerze PESEL ' . $pesel . ' został usunięty.';
                // header("Location: {$_SERVER['PHP_SELF']}");
            } else {
                echo '<h4 style="color:red;">Błąd podczas usuwania klienta!</h4>';
            }
        } else {
            echo 'Klient o podanym numerze PESEL nie istnieje.';
        }
    }
}
?>