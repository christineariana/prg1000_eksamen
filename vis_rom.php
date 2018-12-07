<!DOCTYPE html>


<?php


$filnavn="filer/rom.txt";

$filoperasjon="r"; 

print("<h1>Følgende rom er registrerte:</h1>");

$fil=fopen($filnavn, $filoperasjon);

while($linje=fgets($fil))							
{
	if($linje!="")
	{
	$del=explode(";",$linje);
    $hotellnavn=$del[0];
	$romtype=$del[1];
	$romnr=$del[2];
	print("$hotellnavn $romtype $romnr <br />");	
	}	    
}							

fclose($fil);


?>
    


