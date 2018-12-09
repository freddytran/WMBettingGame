<?php
    session_start();

    require_once 'database_connect.php';
    $benutzername="Freddy";
    //Mit dieser SQL - Anfrage wird der Benutzer, der gerade angemeldet ist aus der Datenbank herausgefiltert.
    
    $benutzer = $_POST['löschen'];
    
    $sqlDelete = "DELETE FROM benutzer WHERE Name='$benutzer'";

    $db_link->query($sqlDelete);
    
    header("Location: benutzer.php");
    exit();
?>