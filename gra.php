<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
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
	
<?php

	echo "<p>Witaj ".$_SESSION['user'].'! [ <a href="logout.php">Wyloguj się!</a> ]</p>';
	echo "<p><b>Drewno</b>: ".$_SESSION['drewno'];
	echo " | <b>Kamień</b>: ".$_SESSION['kamien'];
	echo " | <b>Zboże</b>: ".$_SESSION['zboze']."</p>";
	
	echo "<p><b>E-mail</b>: ".$_SESSION['email'];
	echo "<br /><b>data wygasniecia</b>: ".$_SESSION['dnipremium']."</p>";
	
	$dataczas=new DateTime('2023-05-12 08:00:00');
	echo "Data i czas serwera:".$dataczas->format('Y-m-d H:i:s')."<br/>";
	$czas_do_konca=DateTime::createFromFormat('Y-m-d H:i:s',$_SESSION['dnipremium']);
	$roznica=$dataczas->diff($czas_do_konca);
	
	/*
	echo time()."<br/>";
echo date('Y-m-d H:i:s')."<br/>";
	$dataczas=new DateTime();
	echo $dataczas->format('Y-m-d H:i:s')."<br/>".print_r($dataczas);
	$dzien=26;
	$miesiac=7;
	$rok=1875;
	if(checkdate($dzien,$miesiac,$rok))
	{
		echo "<br>Poprawna data";
	}
	else echo "<br>nie Poprawna data";
	*/
?>

</body>
</html>