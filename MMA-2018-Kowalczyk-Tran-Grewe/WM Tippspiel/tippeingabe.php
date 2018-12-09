<?php


    session_start();
    require_once 'database_connect.php';
    echo " </br> Session wird gestartet. </br>";
    
    $heim = $_POST['Heim'];
    $gast = $_POST['Gast'];
    $spiel = $_POST['Spiel'];

    
    echo $spiel;



    $benutzername = $_SESSION['Name'];

    $sql = "SELECT * FROM benutzer WHERE Name='$benutzername'";
            
            //Hier wird die SQL Anfrage an die Datenbank gesendet. Es wird ein Objekt zurückgegeben.
            $db_name = $db_link->query($sql);
        
            //Das zurückgegebene Objekt wird her verarbeitet und die einzelnen Daten werden Variablen zugeordnet.
            while($db_erg = $db_name->fetch_assoc()){
                $name = $db_erg['Name'];
                $alter = $db_erg['Alt'];
                $email = $db_erg['Mail'];
                $id = $db_erg['BenutzerID'];
                $avatar = $db_erg['Avatar'];
            }
    
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='$spiel' AND BenutzerID='$id'";
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    echo "$resultCheck";
    
    if($resultCheck > 0){
        
        $sql = "UPDATE tipps SET TippHeim = '$heim', TippGast ='$gast' WHERE BenutzerID ='$id' AND spielID='$spiel'";
        

        $results = mysqli_query($db_link, $sql);
        
        
        
    }
    
    else{
    $sql = "INSERT INTO tipps(TippHeim, TippGast, spielID, BenutzerID) VALUES ('$heim', '$gast', '$spiel', '$id')";
    
    
    
    $results = mysqli_query($db_link, $sql);
    }

    header("Location: inhalt2.0.php");
    exit();

?>