<?php

if(isset($_POST['registrierungSubmit'])){
    session_start();
    require_once 'database_connect.php';
    echo " </br> Session wird gestartet. </br>";
    $benutzername = mysqli_real_escape_string($db_link, $_POST['Name']);
    $passwort = mysqli_real_escape_string($db_link, $_POST['Passwort']);
    $email = mysqli_real_escape_string($db_link, $_POST['Email']);
    $alter = mysqli_real_escape_string($db_link, $_POST['Alter']);
    $team = mysqli_real_escape_string($db_link, $_POST['Team']);
    
   
    $sqlCheck = "SELECT * FROM benutzer WHERE Name='$benutzername'";
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    echo "$resultCheck";
    
    if($resultCheck > 0){
        
        header("Location: registrierungNameVergessen.html");
        exit();
        
    }
    
    else{
    $sql = "INSERT INTO benutzer(Name, Passwort, Mail, Alt, Team) VALUES ('$benutzername', '$passwort', '$email', '$alter', '$team')";

    $db_link->query($sql);
    
   

    header("Location: login.html");
        exit();
    }
    
}

else{
    
    header("Location: registrierung.html");
    exit();
    
}
?>
