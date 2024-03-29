# Projekt_kurnik
## Setup project.
### Wymagania.
**XAMPP v3.3.0 or higher.**

Należy uruchomić:
- Apache Server
- MySQL
### Klonowanie projektu.
Projekt powinien być sklonowany do folderu, gdzie jest zainstalowana aplikacja.
>`xampp/htdocs/.`
### Import baz danych.
Należy wykonać import bazy danych przez panel PhpMyAdmin.
1. Uruchamiamy [PhpMyAdmin](http://localhost/phpmyadmin/index.php?route=/server/import) | http://localhost/phpmyadmin/index.php?route=/server/import
1. Wybrać kafelek `IMPORT` na panelu u samej góry.
1. Wybrać pojedynczo i zaimportować dwa pliki:
> - blokada.sql
> - uzytkownicy.sql
## Export bazy danych.
Na wybranej bazie danych należy wykonać polecenie **Export**.
Następnie należy edytować plik oraz dodać jeżeli nie ma, polecenia:
```sql
CREATE DATABASE IF NOT EXISTS nazwa_bazy_danych;
USE nazwa_bazy_danych;

CREATE TABLE `nazwa_tabeli` (
  `nazwa_kol_1` text NOT NULL,
  `nazwa_kol_2` int(1) NOT NULL DEFAULT 1,
  `nazwa_kol_3` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `nazwa_tabeli` (`nazwa_kol_1`, `nazwa_kol_2`, `nazwa_kol_3`) VALUES
('127.0.0.1', 1, '2024-01-23 17:50:03');
COMMIT;
```
Przykład dla bazy blokada:
```sql
CREATE DATABASE IF NOT EXISTS blokada;
USE blokada;

CREATE TABLE `uzytkownicy` (
  `ip` text NOT NULL,
  `liczba_log` int(1) NOT NULL DEFAULT 1,
  `czas` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`ip`, `liczba_log`, `czas`) VALUES
('127.0.0.1', 1, '2024-01-23 17:50:03');
COMMIT;
```