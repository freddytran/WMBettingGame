<?php
    require_once 'database_connect.php';
    echo " </br> Session wird gestartet. </br>";
    
    
    $spiel = 'Finale';

    $benutzername = "Freddy";

    $sqlTime = "SELECT * FROM partien WHERE spielID='$spiel'";

        $db_GetTime = $db_link->query($sqlTime);
    while($db_PlayTime = $db_GetTime->fetch_assoc()){
        
        $time = $db_PlayTime['Uhrzeit'];
    }

    $dataTime = date_create($time);
    echo date('H:i:s');

    $currentTime = date('H:i:s');

    $currentTimeObj = date_create($currentTime);

    $diff = date_diff($dataTime, $currentTimeObj);
    echo date_format($diff, 'H:i:s');
?>