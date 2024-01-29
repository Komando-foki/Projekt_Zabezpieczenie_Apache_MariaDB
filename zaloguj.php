<?php

	session_start();
	
	if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
	{
		header('Location: index.php');
		exit();
	}

require_once "connect.php";
require_once "blokada.php";
mysqli_report(MYSQLI_REPORT_STRICT);

try
{
	$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($polaczenie->connect_errno!=0)
	{
		throw new Exception(mysqli_connect_errno());
	}
	else
	{
		
		$login = $_POST['login'];
		$haslo = $_POST['haslo'];
		$SQLsaftyoff = isset($_POST['SQLSafe']);

		if($SQLsaftyoff){
			$query_input = sprintf("SELECT * FROM uzytkownicy WHERE user='%s' AND pass='%s'", $login, $haslo);
			$rezultat = @$polaczenie->query($query_input);
		}
		else{
			$login = htmlentities($login, ENT_QUOTES, "UTF-8");
			$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");
			$rezultat = @$polaczenie->query(sprintf("SELECT * FROM uzytkownicy WHERE user='%s' AND pass='%s'",
			mysqli_real_escape_string($polaczenie,$login),
			mysqli_real_escape_string($polaczenie,$haslo)));
		}


		if ($rezultat){
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow == 1)
			{	

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
				}
				elseif($SQLsaftyoff){
					echo "</br>";
					while ($row = $rezultat->fetch_assoc()) {
						printf("%s (%s)\n", $row["user"], $row["pass"]);
						echo "</br>";
					}
				} 
				else 
				{
				$_SESSION['blad'] = '<span style="color:red">Nieprawidlowy login !</span>';
				header('Location: index.php');
				}
			}
			else 
			{
				$_SESSION['blad'] = '<span style="color:red">Nieprawidlowe hasło!</span>';
				header('Location: index.php');	
			}

		}
				$polaczenie->close();
	}

catch(Exception $q)
{
	echo 'inf developerska'.$q;
}
	
	
?>