<?php
    
    
if(isset($_POST['loginSubmit'])){
    session_start();
    require_once 'database_connect.php';
    echo " </br> Session wird gestartet. </br>";


    $benutzername = mysqli_real_escape_string($db_link, $_POST['Name']);
    $passwort = mysqli_real_escape_string($db_link, $_POST['Passwort']);

    $sql = "SELECT * FROM benutzer WHERE BINARY Name='$benutzername' AND Passwort='$passwort'";
    
    $sqlGetData = "SELECT * FROM benutzer WHERE Name='$benutzername'";
    
    $sqlGetUserInfo = $db_link->query($sqlGetData);
    
    while($db_UserInfo = $sqlGetUserInfo->fetch_assoc()){
        $rang = $db_UserInfo['Rang'];
    }
    
    
    
    $results = mysqli_query($db_link, $sql);

  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['Name'] = $benutzername;
        $_SESSION['Passwort'] = $passwort;
  	  $_SESSION['success'] = "Logged in";
        
        
        if($rang == 'Admin'){
            header('Location: inhaltAdmin.php');
            exit();
        }else{
            header('Location: inhalt2.0.php');
            exit();
        }
  	  
  	}else {
  		header("Location: loginFehler.html");
    exit();
  	}
    
}

else{
    
    //header("Location: login.html");
    //exit();
    
}
    

?>