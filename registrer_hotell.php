<!DOCTYPE html>

    <head>
    
        <meta charset="utf-8">
        <title>Registrering av hotell</title>
        <link rel="stylesheet" href="style.css">
        <script src="jquery-3.3.1.min.js"></script>
        
    </head>

    <nav>
        
        <a href="registrer_hotell.php">Registrer hotell</a>
        <a href="registrer_rom.php">Registrer rom</a>
        <a href="registrer_romtype.php">Registrer romtype</a>

    </nav>
    
    
    <body>
        
        <div id="registrer_hotell">

        <h1>Registrering av hotell</h1>

        <p>Vennligst fyll inn informasjonen under</p>

            <form action="#" method="post" id="registrerhotell" onsubmit="return validateForm()">
    
                <table>
                    <tr class="input">
                        <td>Hotellnavn</td>
                    </tr>
                    <tr>
                        <td><input class="input" id="hotellnavn" name="hotellnavn" type="text" onkeyup="duplikatHotell()">
                            <span id="hotellnavn_error" style="display:none">Hotellnavn må fylles ut</span>
                            <span id="hover_hotellnavn" class="tooltip" style="display:none">Hotellnavn</span>
                            <div class="ajax" id="liste"></div>
                        </td> 
                        
                        <td><input type="submit" value="Registrer hotell" required ></td>
                        <td><input type="reset" value="Nullstill" name="nullstill"/></td>
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
        
        return !hasError
    
}
            
            </script>
            
<?php


        
                                        /* UNIKT HOTELL OG INPUT */
            
                $filnavn="filer/hotell.txt";
                $hotellnavn=$_POST ["hotellnavn"];
                $hotellerror=0;

                if (!$hotellnavn)
                {
                    print ("Feltet må fylles ut");
                    $hotellerror=1;
                }

                $filoperasjon="r";
                $fil = fopen($filnavn,$filoperasjon);
                
                while ($linje = fgets ($fil))
                { 
                    if ($linje != "") 
                    {
                        $del = explode (";" , $linje);
                        if ($del[0]==$hotellnavn)
                        {
                            print("$hotellnavn er allerede registrert");
                            $hotellerror=1;
                            break;
                        }
                    }
                }

                fclose ($fil);

                if ($hotellerror==0) {
                    $filoperasjon="a";
                    $linje=$hotellnavn . ";" . "\n"  ;
                    $fil = fopen($filnavn,$filoperasjon);
                    
                    fwrite ($fil,$linje);
                    fclose ($fil); 
                    
                    print ("$hotellnavn er nå registrert <br/>");
                    
                    }
    
?>
    


