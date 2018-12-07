<!DOCTYPE html>


<?php

$filnavn="filer/hotell.txt";

$filoperasjon="r"; 

print("<h1>Følgende hoteller er registrerte:</h1>");

$fil=fopen($filnavn, $filoperasjon);

while($linje=fgets($fil))							
{
	if($linje!="")
	{
	$del=explode(";",$linje);
    $hotell=$del[0];
	print("$hotell <br />");	
	}	    
}							

fclose($fil);

?>
    


