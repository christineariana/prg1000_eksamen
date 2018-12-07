<!DOCTYPE html>


    <head>
    
        <meta charset="utf-8">
        <title>Registrering av romtype</title>
        <link rel="stylesheet" href="style.css">
        <script src="jquery-3.3.1.min.js"></script>
        
    </head>

    <nav>
        
        <a href="registrer_hotell.php">Registrer hotell</a>
        <a href="registrer_rom.php">Registrer rom</a>
        <a href="registrer_romtype.php">Registrer romtype</a>

    </nav>
    

<div id="registrer_romtype">
    
    <h1>Registrering av romtype</h1>

        <p>Vennligst fyll inn informasjonen under</p>

            <form action="#" method="post" class="registrer_romtype" onsubmit="return validateForm()">
    
                <table>
                    <tr class="input">
                        <td>Hotellnavn</td>
                        <td>Romtype</td>
                        <td>Antall rom</td>
                    </tr>
                    <tr>
                        <td><input class="input" id="hotellnavn" name="hotellnavn" type="text">
                            <span id="hotellnavn_error" style="display:none">Hotellnavn må fylles ut</span>
                            <span id="hover_hotellnavn" class="tooltip" style="display:none">Hotellnavn</span>
                        </td>
                        
                        <td><input class="input" id="romtype" name="romtype" type="text"  onkeyup="getRomListe()">
                            <span id="romtype_error" style="display:none">Romtype må fylles ut</span>
                            <span id="hover_romtype" class="tooltip" style="display:none">Romtype</span>
                            <div class="ajax" id="liste"></div> 
                        </td>
                        
                        <td><input class="input" id="antallrom" name="antallrom" type="text" onkeyup="romtypeFunction()">
                            <span id="antallrom_error" style="display:none">Antall rom må fylles ut</span>
                            <span id="error_antallrom" style="display:none">Antall rom er ugyldig!</span>
                            <span id="hover_antallrom" class="tooltip" style="display:none">Antall rom</span>
                        </td> 
                        
                        
                        <td><input class="input" type="submit" value="Registrer romtype" required></td>
                        <td><input class="input" type="reset" value="Nullstill skjema" name="nullstill"/></td> 
                    </tr> 
                </table>
                
                

            </form>
    
<script type=text/javascript>
    
         /* AJAX - ROMTYPER PÅ HOTELLET */
     
        function getRomListe () {
        
        var hotellnavn = document.getElementById("hotellnavn").value;
        
        var URL = "registrertehotell.php?hotellnavn="+ hotellnavn
        
        $.get(URL,function (HTML) {
            
            document.getElementById("liste").innerHTML = HTML;

        }
             )
        
    }
    
                                    /* TOOLTIP */
    
    
        var e = document.getElementById('hotellnavn');

            e.onmouseover = function() {
              document.getElementById('hover_hotellnavn').style.display = 'block';
            }

            e.onmouseout = function() {
              document.getElementById('hover_hotellnavn').style.display = 'none';
            }

        var e = document.getElementById('romtype');
    
            e.onmouseover = function() {
              document.getElementById('hover_romtype').style.display = 'block';
            }
            e.onmouseout = function() {
              document.getElementById('hover_romtype').style.display = 'none';
            }   

        var e = document.getElementById('antallrom');
        
            e.onmouseover = function() {
              document.getElementById('hover_antallrom').style.display = 'block';
            }
            e.onmouseout = function() {
              document.getElementById('hover_antallrom').style.display = 'none';
            }

            
    
                                    /* JS VALIDERING AV INPUT */
    
    
    function validateForm() {

    var code = document.getElementById("hotellnavn").value;
    var errormessage_code = document.getElementById("hotellnavn_error");
        
    var hasError = false;
        
    if (code == "") {
        errormessage_code.style.display = "block";
        errormessage_code.style.color = "red";
        
        hasError = true;
    }
    
    else {
            
        errormessage_code.style.display = "none";
        hasError = false; 
        
    }
        
    
    var name = document.getElementById("romtype").value;
    var errormessage_name = document.getElementById("romtype_error");

    if (name == "") {
        errormessage_name.style.display = "block";
        errormessage_name.style.color = "red";
        
        hasError = true;
    }
    
    else {
            
        errormessage_name.style.display = "none";
        hasError = hasError || false;; 
        
    }
        
    var name = document.getElementById("antallrom").value;
    var errormessage_name = document.getElementById("antallrom_error");

    if (name == "") {
        errormessage_name.style.display = "block";
        errormessage_name.style.color = "red";
        
        hasError = true;
    }
    
    else {
            
        errormessage_name.style.display = "none";
        hasError = hasError || false; 
        
    }
        
        return !hasError
    
}
    

/* JS VALIDERING AV ANTALL ROM */
    
    function romtypeFunction() {
        
        var x, text;
        
        x = document.getElementById("antallrom").value;
    
        if (isNaN(x) || x < 1) 
        {

            document.getElementById('error_antallrom').style.display = 'block';
            
   } 
        else {

            document.getElementById('error_antallrom').style.display = 'none';
   }
 }
    
    
    </script>
            
<?php

$filnavn="filer/romtyper.txt";
$hotellnavn=$_POST ["hotellnavn"];
$romtype=$_POST ["romtype"];
$antallrom=$_POST ["antallrom"];


$hotellnavn = strtolower($hotellnavn);
$romtype = strtolower($romtype);

$hotellerror=0;
$hotelltreff=0;
    
                                /* Sjekk ved tomme felt */

        if (!$hotellnavn || !$romtype || !$antallrom) {
                print ("");
                $hotellerror=1;
            }
    
        
                                /* Validering av antall rom */

        if (!ctype_digit($antallrom) || $antallrom<0) {
                print("");
                $hotellerror=1;
            }                   
    
    
    
                                /* Sjekker om hotell og romtype allerede er registrert */

        $filoperasjon="r";
        $fil = fopen($filnavn,$filoperasjon);
        
        while ($linje = fgets ($fil))
        { 
            if ($linje !="") {
                
                $del = explode (";" , $linje);
                $reghotellnavn = $del[0];
                $regromtype = $del[1];
                $regantallrom = $del[2];

                if ($reghotellnavn == $hotellnavn && $regromtype == $romtype)
                {
                    print("Hotell og romtype er allerede registrert. <br/>");
                    $hotellerror=1;
                    break;
                }
            }
        }
        fclose ($fil);
    

                                /* Validererer at hotellet er registrert */
        $filoperasjon="r";
        $fil = fopen("filer/hotell.txt",$filoperasjon);
        while ($linje = fgets ($fil))
            { 
                if ($linje != "") 
                {
                    $del = explode (";" , $linje);
                    $reghotellnavn = $del[0];

                    if ($reghotellnavn == $hotellnavn)
                    {
                        $hotelltreff=1;
                    }
                } 
            }

        if ($hotelltreff == 0) {
            
            $hotellerror = 1;
            print("Hotellet er ikke registrert, og må registreres før romtype kan registreres.<br>");

        }
                      

                            
                                /* Registrering av romtype */

        if ($hotellerror==0){
            
            $filoperasjon="a";
            $linje=$hotellnavn .";". $romtype .";". $antallrom . ";" . "\n"  ;
            $fil = fopen($filnavn,$filoperasjon);
            
            fwrite ($fil,$linje);
            fclose ($fil); 
            print ("Det er nå registrert $antallrom $romtype på $hotellnavn.<br/>");
        }
?>
    


