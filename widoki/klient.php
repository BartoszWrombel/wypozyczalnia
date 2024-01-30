<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <title>Wypożyczalnia samochodów</title>
    <link rel="stylesheet" type="text/css" href="../style/style.css" />
</head>

<body>
    <div class="wrapper">
        <a href="rejestruj.php" class="right">Rejestracja</a>
        <a href="wyloguj.php" class="right">Wyloguj</a>
        <a href="login.php" class="right">Zaloguj</a>

        <h1>Wypożyczalnia samochodów</h1>
        <nav>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="lista_p.php">Lista samochodów</a></li>
                <li><a href="samochody.php">Samochody</a></li>
                <li><a href="klient.php">Klient</a></li>
                <li><a href="wynajem.php">Wynajem</a></li>
                <li><a href="usuwanie_rezerwacji.php">Usuwanie rezerwacji</a></li>
                <li><a href="statystyka.php">Statystyka</a></li>
            </ul>
        </nav>
        <?php
        session_start();
        if (isset($_SESSION['sesja'])) {
            if ($_SESSION['nazwa_uprawnienia'] == 'Pracownik' || $_SESSION['nazwa_uprawnienia'] == 'Kierownik' || $_SESSION['nazwa_uprawnienia'] == 'Administrator') {

                require('../skrypty/klient_s.php');
                require('../skrypty/lista_p_s.php');
        ?>
                <h2>Wyszukaj klienta</h2>
                <form name="dane_klient" action="klient.php" method="post">
                    <input type="text" name="imie" placeholder="podaj imię klienta" style="width:50%;display:inline;text-align:center;" />
                    <br />
                    <input type="text" name="nazwisko" placeholder="podaj nazwisko klienta" style="width:50%;display:inline;text-align:center;" />
                    <br />
                    <input type="text" name="pesel" placeholder="podaj PESEL klienta" style="width:50%;display:inline;text-align:center;" />
                    <br />
                    <input type="submit" name="wyszukaj_klienta" value="Wyszukaj" style="width:50%;display:inline;" />
                </form>

                <table>
                    <tr>
                        <th>Imię klienta</th>
                        <th>Nazwisko klienta</th>
                        <th>PESEL klienta</th>
                    </tr>
                    <?php
                    foreach ($klient_wyszukany as $klient_wy => $link) { //odczytuję to co zostało zapisane w tablicy za pomocą fetchAll
                    ?>
                        <tr>
                            <td><?php echo $link['imie']; ?></td>
                            <td><?php echo $link['nazwisko']; ?></td>
                            <td><?php echo $link['pesel']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>

                <h2>Dodaj klienta</h2>

                <form name="dane_klient" action="klient.php" method="post">
                    <input type="text" name="imie" placeholder="podaj imię klienta" style="width:50%;display:inline;text-align:center;" />
                    <br />
                    <input type="text" name="nazwisko" placeholder="podaj nazwisko klienta" style="width:50%;display:inline;text-align:center;" />
                    <br />
                    <input type="text" name="pesel" placeholder="podaj PESEL klienta" style="width:50%;display:inline;text-align:center;" />
                    <br />
                    <input type="submit" name="dodaj_klienta" value="Dodaj" style="width:50%;display:inline;" />
                </form>

                <table>
                    <tr>
                        <th>Imię klienta</th>
                        <th>Nazwisko klienta</th>
                        <th>PESEL klienta</th>
                    </tr>
                    <?php
                    foreach ($klienci as $klient => $link) {
                    ?>
                        <tr>
                            <td><?= $link['imie'] ?></td>
                            <td><?= $link['nazwisko'] ?></td>
                            <td><?= $link['pesel'] ?></td>
                        </tr>

                    <?php
                    }
                    ?>
                </table>
                <h2>Usuń klienta</h2>

                <form name="dane_klient" action="klient.php" method="post">
                    <input type="text" name="pesel" placeholder="podaj PESEL klienta" style="width:50%;display:inline;text-align:center;" />
                    <br />
                    <input type="submit" name="usun_klienta" value="Usuń" style="width:50%;display:inline;" />
                </form>

                <table>
                    <tr>
                        <th>Imię klienta</th>
                        <th>Nazwisko klienta</th>
                        <th>PESEL klienta</th>
                    </tr>
                    <?php
                    foreach ($klienci as $klient => $link) {
                    ?>
                        <tr>
                            <td><?= $link['imie'] ?></td>
                            <td><?= $link['nazwisko'] ?></td>
                            <td><?= $link['pesel'] ?></td>
                        </tr>

            <?php
                    }
                } else {
                    echo '<h2 style="color: red; font-weight: bold;">Nie masz uprawnień do tej strony.</h2>';
                }
            } else {
                echo '<h2 style="color: red; font-weight: bold;">Proszę się zalogować.</h2>';
            }
            ?>
                </table>
    </div>
    <footer>
        <p>&copy; 2024 Wypożyczalnia samochodów. Wszelkie prawa zastrzeżone.</p>
        <p>Adres: ul. Przykładowa 123, 00-000 Warszawa</p>
        <p>Telefon: +48 123 456 789</p>
        <p>Email: info@wypozyczalnia-samochodow.pl</p>
        <p>Autor: Bartosz Wrombel</p>
    </footer>
</body>

</html>