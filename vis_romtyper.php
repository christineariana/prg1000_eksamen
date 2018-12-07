<!DOCTYPE html>


<?php

$filnavn="filer/romtyper.txt";

$filoperasjon="r"; 

print("<h1>Følgende romtyper er registrerte:</h1>");

$fil=fopen($filnavn, $filoperasjon);

while($linje=fgets($fil))							
{
	if($linje!="")
	{
	$del=explode(";",$linje);
    $hotellnavn=$del[0];
	$romtype=$del[1];
	$antallrom=$del[2];
	print("$hotellnavn $romtype $antallrom <br />");	
	}	    
}							

fclose($fil);


?>
    


