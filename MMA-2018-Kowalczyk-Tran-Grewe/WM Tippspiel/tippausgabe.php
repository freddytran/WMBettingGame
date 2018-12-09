<?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='Finale'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='Finale' AND BenutzerID='$id'";
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    if($resultCheck > 0){
    
    echo $tippHeim;
    echo $tippGast;
    echo $spielID;
        
    }else{
        
    }
?>