<!DOCTYPE html>

    <head>
    
        <meta charset="utf-8">
        <title>Registrering av rom</title>
        <link rel="stylesheet" href="style.css">
        <script src="jquery-3.3.1.min.js"></script>
        
    </head>

    <nav>
        
        <a href="registrer_hotell.php">Registrer hotell</a>
        <a href="registrer_rom.php">Registrer rom</a>
        <a href="registrer_romtype.php">Registrer romtype</a>

    </nav>
    

<div id="registrer_rom">
    
    <h1>Registrering av rom</h1>

        <p>Vennligst fyll inn informasjonen under</p>

            <form action="#" method="post" class="registrer_rom" onsubmit="return validateForm()">
    
                <table>
                    <tr class="input">
                        <td>Hotellnavn</td>
                        <td>Romtype</td>
                        <td>Romnummer</td>
                    </tr>
                    <tr>
                        <td><input class="input" id="hotellnavn" name="hotellnavn" type="text">
                            <span id="hotellnavn_error" style="display:none">Hotellnavn må fylles ut</span>
                            <span id="hover_hotellnavn" class="tooltip" style="display:none">Hotellnavn</span>
                        </td>
                        
                        <td><input class="input" id="romtype" name="romtype" type="text">
                            <span id="romtype_error" style="display:none">Romtype må fylles ut</span>
                            <span id="hover_romtype" class="tooltip" style="display:none">Romtype</span>
                        </td>
                        
                        <td><input class="input" id="romnr" name="romnr" type="text"> 
                            <span id="romnr_error" style="display:none">Romnummer må fylles ut</span>
                            <span id="hover_romnr" class="tooltip" style="display:none">Romnummer, tre siffer</span>
                        </td> 
                        
                        <td><input class="input" type="submit" value="Registrer rom" required></td>
                        <td><input type="reset" value="Nullstill skjema" name="nullstill"/></td> 
                    </tr> 
                </table>
                
                

            </form>
<script>
    
    

    
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

        var e = document.getElementById('romnr');
        
            e.onmouseover = function() {
              document.getElementById('hover_romnr').style.display = 'block';
            }
            e.onmouseout = function() {
              document.getElementById('hover_romnr').style.display = 'none';
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
        
    var name = document.getElementById("romnr").value;
    var errormessage_name = document.getElementById("romnr_error");

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
    
    </script>       
    
<?php
            $hotellnavn=$_POST ["hotellnavn"];
            $romtype=$_POST ["romtype"];
            $romnummer=$_POST ["romnr"];
    
            $romtype = strtolower($romtype);
    
            $hotellerror=0;
    
            $filnavn="filer/rom.txt";
    
    
    
                                /* Validerer tre siffer på romnummer input */
    
                if (!ctype_digit($romnummer) || $romnummer<0 || strlen($romnummer) != 3) {
                    
                    print("");
                    $hotellerror=1;
                }   
    

                                /* Validerer at alle felt er fylt ut */

    
                if (!$hotellnavn || !$romtype || !$romnummer){
                    print ("");
                    $hotellerror=1;
                }
    
    
                                /* Validererer at hotellnavn og romnr er unik */ 

        $filoperasjon="r";
        $fil = fopen($filnavn,$filoperasjon);
        
        while ($linje = fgets ($fil))
        { 
            if ($linje !="") {
                
                $del = explode (";" , $linje);
                $reghotellnavn = $del[0];
                $regromtype = $del[1];
                $regromnummer = $del[2];

                if ($reghotellnavn == $hotellnavn && $regromnummer == $romnummer)
                {
                    print("Hotell og romnummer er allerede registrert. <br/>");
                    $hotellerror=1;

                }
            }
        }
        fclose ($fil);

                                /* Validererer at hotellnavn og romtype er registrert */ 
    
        $filoperasjon="r";
        $fil = fopen("filer/romtyper.txt",$filoperasjon);
        while ($linje = fgets ($fil)) { 
                if ($linje != "") 
                {
                    $del = explode (";" , $linje);
                    $reghotellnavn = $del[0];
                    $regromtype = $del[1];

                    if ($reghotellnavn == $hotellnavn && $regromtype == $romtype)
                    {
                        $hotelltreff=1;
                    }
                } 
            }

        if ($hotelltreff == 0) {
            
            $hotellerror = 1;
            print("Denne romtypen er ikke registrert på hotellet, og må registreres før rommet kan registreres.<br>");

        }

    
                            /* Registrerer rommet */


    if ($hotellerror==0) {
        
        $filoperasjon="a";
        $linje=$hotellnavn .";". $romtype .";". $romnummer . ";" . "\n"  ;
        $fil = fopen($filnavn,$filoperasjon);
        
        fwrite ($fil,$linje);
        fclose ($fil); 
        print ("Romnummer $romnummer er nå registrert som $romtype på $hotellnavn <br/>");
        }
?>