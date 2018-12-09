<?php
    session_start();
    require_once 'database_connect.php';
    echo " </br> Session wird gestartet. </br>";
    
    
    $benutzername = "Freddy";

    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE"
?>