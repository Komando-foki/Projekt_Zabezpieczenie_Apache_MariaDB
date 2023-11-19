<?php
    //ob_start();
    
    if(!$_COOKIE['naszastrona']=="1")
    {
        $plik="licz.txt";
        
        //odczytujemy aktualną wartość z pliku
        $file=fopen($plik, "r");
        flock($file, 1);
        $liczba=fgets($file, 16);
        flock($file, 3);
        fclose($file);
        $liczba++; //zwiększamy o 1
        
        //zapisujemy nową wartość licznika
        $file=fopen($plik, "w");
        flock($file, 2);
        fwrite($file, $liczba++);
        flock($file, 3);
        fclose($file); 
        
        setcookie("naszastrona","1");
        //ob_end_flush();
    }


	session_start();
	
	if (!isset($_SESSION['udanarejestracja']))
	{
		header('Location: index.php');
		exit();
	}
	else
	{
		unset($_SESSION['udanarejestracja']);
	}

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Osadnicy - gra przeglądarkowa</title>
</head>

<body>
<?php include ('licz.txt'); ?>
	Tylko martwi ujrzeli koniec wojny - Platon<br /><br />
	Dziekujemy za rejestracje<br /><br />
	<a href="index.php">zaloguj sie na konto!</a>
	<br /><br />
	
	<form action="zaloguj.php" method="post">
	
		Login: <br /> <input type="text" name="login" /> <br />
		Hasło: <br /> <input type="password" name="haslo" /> <br /><br />
		<input type="submit" value="Zaloguj się" />
	
	</form>
	
<?php
	if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
?>

</body>
</html>