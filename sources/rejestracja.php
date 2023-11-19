<?php

	session_start();
	
	if(isset($_POST['email']))
	{
		//udana walidacja? zalozmy tak
		$wszystko_OK=true;
		//spr nicname
		$nick=$_POST['nick'];
		//spr dlogosci nicka
		if((strlen($nick)<3)||(strlen($nick)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_nick']="nick musi posiadac od 3 do 20 znakow";
		}
		
		if(ctype_alnum($nick)==false)//sprawdza czy znaki sa numeryczne
		{
			$wszystko_OK=false;
			$_SESSION['e_nick']="Nick moze skladac sie z liter i cyfr";
		}
		
//spr pop emaila
		$email=$_POST['email'];
		$emailB=filter_var($email, FILTER_SANITIZE_EMAIL);
		if((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false)||($emailB!=$email))
		{
			$wszystko_OK=false;
			$_SESSION['e_email']="Podaj poprawny email";
		}
		
//spr pop haslo
		$haslo1=$_POST['haslo1'];
		$haslo2=$_POST['haslo2'];
		if((strlen($haslo1)<8)||(strlen($haslo1)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="haslo musi posiadac od 3 do 20 znakow";
		}
		
		if($haslo1!=$haslo2)
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="podane hasla nie sa takie same";
		}
		
		
//haszowanie hasla
		$haslo_hash=password_hash($haslo1, PASSWORD_DEFAULT);
		
		
//czy zaakceptowano regulamin

		if(!isset($_POST['regulamin']))
		{
			$wszystko_OK=false;
			$_SESSION['e_regulamin']="nie zaakceptowano regulaminu";
		}
// capatcha spr chekbox
			$sekret="6LeIN8IlAAAAAFpQAr5qQyhappWoeDw0hTPMJtIN";
			$sprawdz=file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);
			$odpowiedz=json_decode($sprawdz);
			if($odpowiedz->success==false)
			{
			$wszystko_OK=false;
			$_SESSION['e_bot']="nie przeszedles testu bocie";
			}
			
			
require_once"connect.php";
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
// czy e mail istnieje
			$rezultat=$polaczenie->query("SELECT id FROM uzytkownicy WHERE email='$email'");
			
			if (!$rezultat) throw new Exception($polaczenie->error);
			
			$ile_takich_maili=$rezultat->num_rows;
			if($ile_takich_maili>0)
			{
				$wszystko_OK=false;
				$_SESSION['e_email']="konto z takim mailem juz istnieje";
			}
// czy nick istnieje
			$rezultat=$polaczenie->query("SELECT id FROM uzytkownicy WHERE user='$nick'");
			
			if (!$rezultat) throw new Exception($polaczenie->error);
			
			$ile_takich_nickow=$rezultat->num_rows;
			if($ile_takich_nickow>0)
			{
				$wszystko_OK=false;
				$_SESSION['e_nick']="taka nazwa uzytkownika istnieje";
			}
			if($wszystko_OK==true)
			{			//udan walidacja
				if($polaczenie->query("INSERT INTO uzytkownicy VALUES(NULL,'$nick','$haslo_hash','$email', 100,100,100,now()+INTERVAL 14 DAY)"))
				{
				$_SESSION['udanarejestracja']=true;
				header('Location: witamy.php');
				}
					else
					{
					throw new Exception($polaczenie->error);
					}
			}
			$polaczenie->close();
		}
	}
	catch(Exception $e)
	{
		echo "blad serwera sql";
		echo '<br/> Informacja dev'.$e;
	}
}
	
	
	
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Osadnicy - zaloz darmowe konto!</title>
	 <script src='https://www.google.com/recaptcha/api.js'></script>
	 
	 <style>
	 .error
	 {
		 color:red
		 margin-top: 10px;
		 margin-bottom: 10px;
	 }
	 </style>
</head>

<body>
	
	<form method="post">
	
	Nickname: <br/> <input type="text" name="nick"/><br/>
<?php
	if(isset($_SESSION['e_nick']))
	{
		echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
		unset($_SESSION['e_nick']);
	}
?>
	
	
	E-mail: <br/> <input type="text" name="email"/><br/>
<?php
	if(isset($_SESSION['e_email']))
	{
		echo '<div class="error">'.$_SESSION['e_email'].'</div>';
		unset($_SESSION['e_email']);
	}
?>


	Twoje haslo: <br/> <input type="password" name="haslo1"/><br/>
<?php
	if(isset($_SESSION['e_haslo']))
	{
		echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
		unset($_SESSION['e_haslo']);
	}
?>
	
	Powtorz haslo: <br/> <input type="password" name="haslo2"/><br/>
	
	<label>
	<input type="checkbox" name="regulamin"/> Akceptuje regulamin<br/>
	</label>
<?php
	if(isset($_SESSION['e_regulamin']))
	{
		echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
		unset($_SESSION['e_regulamin']);
	}
?>
	<div class="g-recaptcha" data-sitekey="6LeIN8IlAAAAAAf_FyXkZF_e3xa4AYgPKmB5aiJT"></div>
<?php
	if(isset($_SESSION['e_bot']))
	{
		echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
		unset($_SESSION['e_bot']);
	}
?>
	<br/>
	
	<input type="submit" value="Zarejestruj sie"/>
	</form>
	
</body>
</html>