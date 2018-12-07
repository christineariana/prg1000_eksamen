<?php

$qhotellnavn=$_GET["hotellnavn"];


$filnavn="filer/hotell.txt";

$filoperasjon="r"; 

$fil=fopen($filnavn, $filoperasjon);

while($linje=fgets($fil))							
{
	if($linje!="")
	{
        
        
	$del=explode(";",$linje);
    $hotellnavn=$del[0];        
	
    if($qhotellnavn == $hotellnavn)  {
        
        print("<p>Hotellet er allerede registrert!<br /></p>");	
	}	
        
        }
}	

?>