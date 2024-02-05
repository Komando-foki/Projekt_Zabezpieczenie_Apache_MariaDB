<?php
require_once "connect.php";
require_once "blokada.php";
session_start();

if ((!isset($_POST['login'])) || (!isset($_POST['haslo']))) {
	header('Location: index.php');
	exit();
}

if (czyZablokowac()) {
	$_SESSION['blad'] = '<span style="color:red">Zbyt duża liczba logowań!</span>';
	header('Location: index.php');
	exit();
}

mysqli_report(MYSQLI_REPORT_STRICT);

try {
	$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);

	if ($polaczenie->connect_errno != 0) {
		throw new Exception(mysqli_connect_errno());
	} else {

		$login = $_POST['login'];
		$haslo = $_POST['haslo'];

		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		$haslo = password_hash(htmlentities($haslo, ENT_QUOTES, "UTF-8"), PASSWORD_DEFAULT);

		if ($rezultat = @$polaczenie->query(
			sprintf(
				"SELECT * FROM uzytkownicy WHERE user='%s' AND pass='%s'",
				mysqli_real_escape_string($polaczenie, $login),
				mysqli_real_escape_string($polaczenie, $haslo)
			)
		)) {
			$ilu_userow = $rezultat->num_rows;
			if ($ilu_userow > 0) {
				$_SESSION['zalogowany'] = true;

				$wiersz = $rezultat->fetch_assoc();


				$_SESSION['id'] = $wiersz['id'];
				$_SESSION['user'] = $wiersz['user'];
				$_SESSION['drewno'] = $wiersz['drewno'];
				$_SESSION['kamien'] = $wiersz['kamien'];
				$_SESSION['zboze'] = $wiersz['zboze'];
				$_SESSION['email'] = $wiersz['email'];
				$_SESSION['dnipremium'] = $wiersz['dnipremium'];

				unset($_SESSION['blad']);
				$rezultat->free_result();
				header('Location: gra.php');
			} else {
				$_SESSION['blad'] = '<span style="color:red">Nieprawidlowy login !</span>';
				header('Location: index.php');
			}
		} else {
			$_SESSION['blad'] = '<span style="color:red">Nieprawidlowe hasło!</span>';
			header('Location: index.php');
		}
	}
	$polaczenie->close();
} catch (Exception $q) {
	echo 'inf developerska' . $q;
}
