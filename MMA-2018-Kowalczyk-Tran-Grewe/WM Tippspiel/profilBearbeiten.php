<?php
    session_start();
    
    require_once 'database_connect.php';

    $benutzername = $_SESSION['Name'];
    //Mit dieser SQL - Anfrage wird der Benutzer, der gerade angemeldet ist aus der Datenbank herausgefiltert.
    $sql = "SELECT * FROM benutzer WHERE Name='$benutzername'";
            
    //Hier wird die SQL Anfrage an die Datenbank gesendet. Es wird ein Objekt zurückgegeben.
    $db_name = $db_link->query($sql);
        
    //Das zurückgegebene Objekt wird her verarbeitet und die einzelnen Daten werden Variablen zugeordnet.
    while($db_erg = $db_name->fetch_assoc()){
        $name = $db_erg['Name'];
        $alter = $db_erg['Alt'];
        $email = $db_erg['Mail'];
        $id = $db_erg['BenutzerID'];
        $aktuellesPasswort = $db_erg['Passwort'];
        $avatar = $db_erg['Avatar'];
        $nationalitaet = $db_erg['Team'];
        $tippScore = $db_erg['Score'];
    };

    
    $aktuellesPasswortEingabe = mysqli_real_escape_string($db_link, $_POST['aktuellesPasswort']);

    if(!($aktuellesPasswortEingabe == $aktuellesPasswort)){
        
        echo "Passwort falsch";
    }else{
        
        if(isset($_POST['neuBenutzername'])){
            $neuBenutzername = mysqli_real_escape_string($db_link, $_POST['neuBenutzername']);
            $_SESSION['Name'] = $neuBenutzername;
            $sqlBenutzername = "UPDATE benutzer SET Name='$neuBenutzername' WHERE BenutzerID='$id'";
            $db_link->query($sqlBenutzername);
        }

        if(isset($_POST['neuAlter'])){
            $neuAlter = mysqli_real_escape_string($db_link, $_POST['neuAlter']);
            $sqlAlter = "UPDATE benutzer SET Alt='$neuAlter' WHERE BenutzerID='$id'";
            $db_link->query($sqlAlter);
        }
        
        if(isset($_POST['neuEmail'])){
            $neuEmail = mysqli_real_escape_string($db_link, $_POST['neuEmail']);
            $sqlEmail = "UPDATE benutzer SET Mail='$neuEmail' WHERE BenutzerID='$id'";
            $db_link->query($sqlEmail);
        }
        
        if(isset($_POST['neuPasswort1']) AND isset($_POST['neuPasswort2'])){
            $neuPasswort1 = mysqli_real_escape_string($db_link, $_POST['neuPasswort1']);
            $neuPasswort2 = mysqli_real_escape_string($db_link, $_POST['neuPasswort2']);
            
            if($neuPasswort1 == $neuPasswort2){
                $sqlPasswort = "UPDATE benutzer SET Passwort='$neuPasswort1' WHERE BenutzerID='$id'";
                $db_link->query($sqlPasswort);
            }else{
                echo "eines der beiden Felder fürs neue Passwort falsch.";
            }
            
        }else if(isset($_POST['neuPasswort1']) AND !isset($_POST['neuPasswort2'])){
            
            header("Location: profil.php?errCode=1");
            exit();
            echo "Bitte beide Felder ausfüllen!";
            
        }else if(!isset($_POST['neuPasswort1']) AND isset($_POST['neuPasswort2'])){
            
            header("Location: profil.php?errCode=2");
            exit();
            echo "Bitte beide Felder ausfüllen!";
            
        }else if(!isset($_POST['neuPasswort1']) AND !isset($_POST['neuPasswort2'])){
            
            header("Location: profil.php?errCode=3");
            exit();
            echo "Keine Änderung am Passwort.";
        }
        
        
        header("Location: profil.php");
        exit();
    }

?>