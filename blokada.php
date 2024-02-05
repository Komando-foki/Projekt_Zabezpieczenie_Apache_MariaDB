<?php
// Ustawienia bazy danych

// Połączenie z bazą danych (używając MySQLi)
function czyZablokowac()
{
    $sql_serwer = "localhost";
    $sql_login = "root";
    $sql_haslo = "";
    $sql_baza = "blokada";
    $mysqli = new mysqli($sql_serwer, $sql_login, $sql_haslo, $sql_baza);

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $ip = getIp();
    // Usuwanie starych blokad, gdy minęło 20 minut:
    $mysqli->query("DELETE FROM uzytkownicy WHERE czas < DATE_SUB(NOW(), INTERVAL 20 MINUTE)");

    // Pobieranie rekordu dla danego numeru IP:
    $result = $mysqli->query("SELECT * FROM uzytkownicy WHERE ip='$ip'");

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();


        // Jeżeli istnieje rekord, pobieram i sprawdzam licznik:
        if ($row['liczba_log'] >= 3) {
            $blokada = true; // Gdy 3 logowania, to blokuję
        } else {
            $mysqli->query("UPDATE uzytkownicy SET liczba_log = liczba_log + 1, czas = NOW() WHERE ip='$ip'");
        }
    } else {
        // Jeżeli nie ma rekordu dla tego IP, zakładam go:
        $mysqli->query("INSERT INTO uzytkownicy SET czas=NOW(), ip='$ip'");
    }

    $mysqli->close();

    return $blokada;
    // return TRUE;
}

function getIp(): string
{
    if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) { // Wsparcie Cloudflare
        $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
    } elseif (isset($_SERVER['REMOTE_ADDR']) === true) {
        $ip = $_SERVER['REMOTE_ADDR'];
        if (preg_match('/^(?:127|10)\.0\.0\.[12]?\d{1,2}$/', $ip)) {
            if (isset($_SERVER['HTTP_X_REAL_IP'])) {
                $ip = $_SERVER['HTTP_X_REAL_IP'];
            } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
        }
    } else {
        $ip = '127.0.0.1';
    }
    if (in_array($ip, ['::1', '0.0.0.0', 'localhost'], true)) {
        $ip = '127.0.0.1';
    }
    $filter = filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
    if ($filter === false) {
        $ip = '127.0.0.1';
    }

    return $ip;
}
