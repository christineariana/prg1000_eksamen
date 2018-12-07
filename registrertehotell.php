<?php

$qhotellnavn=$_GET["hotellnavn"];


$filnavn="filer/romtyper.txt";

$filoperasjon="r"; 

$fil=fopen($filnavn, $filoperasjon);

while($linje=fgets($fil))							
{
	if($linje!="")
	{
        
        
	$del=explode(";",$linje);
    $hotellnavn=$del[0];
	$romtype=$del[1];
	$antallrom=$del[2];
        
        
	
    if($qhotellnavn == $hotellnavn)  {
        
        print("<p> $qhotellnavn har: <br>$antallrom $romtype <br /></p>");	
	}	
        
        }
}	

?>