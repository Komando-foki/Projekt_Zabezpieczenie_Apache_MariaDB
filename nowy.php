<?php
echo "dzien dobry";
        $plik="licz.txt";
        
        //odczytujemy aktualną wartość z pliku
        $file=fopen($plik, "r");
        flock($file, 1);
        $liczba=fgets($file, 16);
        flock($file, 3);
        fclose($file);
        $liczba++; //zwiększamy o 1
        echo '$liczba';
        //zapisujemy nową wartość licznika
        $file=fopen($plik, "w");
        flock($file, 2);
        fwrite($file, $liczba++);
        flock($file, 3);
        fclose($file); 
        
        setcookie("naszastrona","1");
        //ob_end_flush();
    
?>