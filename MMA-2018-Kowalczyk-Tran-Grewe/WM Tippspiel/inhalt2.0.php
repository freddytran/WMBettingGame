<!DOCTYPE html>

<html>

    <head>
        <meta charset="utf-8">


        
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>


        
<link rel="stylesheet" href="styleInhalt.css"/>
<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
        
                                         
    </head>
<body> 

    
<?php
    session_start();
    require_once 'database_connect.php';
    $benutzername=$_SESSION['Name'];
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
                $avatar = $db_erg['Avatar'];
            };
        

    ?>    
    
<div id="komplett">  
    
<div class="container">   
    
    
<!-- Leiste-->      
    
<div class="container-fluid">
     <div class="row">
    <div class="col-xs-12"> 
        
<div class="card text-center">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link active" href="#">Home</a>
      </li>
        
        <li class="nav-item">
            <div id="Regeln">
        <a class="nav-link disabled" href="#">Spielregeln</a>
            </div>
      </li>   <li class="nav-item">
        <a class="nav-link disabled" href="profil.php">Profil</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="rangliste.php">Rangliste</a>
      </li>
           
        <li class="nav-item">
        <a class="nav-link disabled" href="logout.php">Logout</a>
      </li>
    </ul>
  </div>
        
         </div>
    </div>
    </div>
    </div>
<br>
<br>    
<!--Zwischenüberschrift-->
 <div class="jumbotron jumbotron-fluid">
     <div class="row">
    <div class="col-xs-12 col-lg-12">  
    <div class="container-fluid">
        <h1>Fußball-Weltmeisterschaft 2018</h1>
        </div>    
         </div>
     </div>
    </div>



<!-- ---------------Finale---------------------------- -->
    <div class="container-fluid">
     <div class="row">
    <div class="col-lg-4 col-xs-4 offset-lg-4 alert-info">
<p>Finale</p>
<div class="col-lg-12 alert-success">
    <p> 15.07.18 20:00 Uhr</p>
    <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Tippabgabe
</button>
        
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
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='Finale'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='Finale'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="Finale">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
         
    </form>
    

    
    </div> 
</div>
        </div>
    </div>
      <br>
<!-- ---------------Halbfinale------------------------ -->   
 
        <div class="container-fluid">
    
     <div class="row">
    <div class="col-lg-3 col-xs-4 offset-md-3 alert-info">
        <p> 1. Halbfinale </p>
        <div class="col-lg-12 alert-success">
            <p> 10.07.18 20:00 Uhr</p>
            <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2">
  Tippabgabe
</button>
                
<?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='Halb1'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='Halb1' AND BenutzerID='$id'";
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    if($resultCheck > 0){
    
    echo "<br> Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
$sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='Halb1'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='Halb1'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>                

<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim">
           <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast"> 
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="Halb1">Ergebnis speichern</button>
      </div>
    </div>
  </div>
</div>
    </form>
        </div>
         </div>
         
         
  <!----   H2--------------------------------->  
         
         
    <div class="col-lg-3 col-xs-4 col-lg-push-3 col-sx-push-2 alert-info">
        <p>2. Halbfinale</p>
        <div class="col-lg-12 alert-success">
            <p>11.07.18 20:00 Uhr</p>
            <form action="tippeingabe.php"method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal3">
  Tippabgabe
</button>
                <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='Halb2'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='Halb2' AND BenutzerID='$id'";
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    if($resultCheck > 0){
    
    echo "<br> Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
                
$sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='Halb2'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='Halb2'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }                
                
?>

<!-- Modal -->
<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel3">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="Halb2">Ergebnis speichern</button>
      </div>
    </div>
  </div>
</div>
    </form>
        </div>
         </div>
    
            </div>
    </div><br>
    
<!-- ----------------Viertelfinale------------------------    -->
<div class="container-fluid">
   
    <div class="row">
        
        
    <div class="col-lg-3 col-xs-4 alert-info">
        <p> 1. Viertelfinale </p>
        <div class="col-lg-12 alert-success">
            <p> 06.07.18 16:00 Uhr</p>
            <form action="tippeingabe.php"method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal4">
  Tippabgabe
</button>
                <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='Viertel1'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='Viertel1' AND BenutzerID='$id'";
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    if($resultCheck > 0){
    
    echo "<br> Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
                
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='Viertel1'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='Viertel1'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>


<!-- Modal -->
<div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel4">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="Viertel1">Ergebnis speichern</button>
      </div>
    </div>
  </div>
</div>
    </form>
        </div>
         </div>
        
    <div class="col-lg-3 col-xs-4 alert-info">
        <p>2. Viertelfinale</p>
        <div class="col-lg-12 alert-success">
            <p>06.07.18 20:00 Uhr</p>
            <form action="tippeingabe.php"method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal5">
  Tippabgabe
</button>
                <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='Viertel2'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='Viertel2' AND BenutzerID='$id'";
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    if($resultCheck > 0){
    
    echo "<br> Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
                $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='Viertel2'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='Viertel2'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>


<!-- Modal -->
<div class="modal fade" id="exampleModal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel5" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel5">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="Viertel2">Ergebnis speichern</button>
      </div>
    </div>
  </div>
</div>
    </form>
            
            
        </div>
         </div>
    <div class="col-lg-3 col-xs-4 alert-info">
        <p>3. Viertelfinale</p>
        <div class="col-lg-12 alert-success">
            <p> 07.07.18 16:00 Uhr</p>
            <form action="tippeingabe.php"method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal6">
  Tippabgabe
</button>
                <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='Viertel3'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='Viertel3' AND BenutzerID='$id'";
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    if($resultCheck > 0){
    
    echo "<br> Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
                $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='Viertel3'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='Viertel3'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>


<!-- Modal -->
<div class="modal fade" id="exampleModal6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel6" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel6">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="Viertel3">Ergebnis speichern</button>
      </div>
    </div>
  </div>
</div>
    </form>
        </div>
        </div>
    <div class="col-lg-3 col-xs-4 alert-info">
        <p>4. Viertelfinale</p>
        <div class="col-lg-12 alert-success">
            <p> 07.07.18 20:00 Uhr</p>
            <form action="tippeingabe"method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal7">
  Tippabgabe
</button>
                <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='Viertel4'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='Viertel4' AND BenutzerID='$id'";
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    if($resultCheck > 0){
    
    echo "<br> Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
                
                $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='Viertel4'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='Viertel4'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>


<!-- Modal -->
<div class="modal fade" id="exampleModal7" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel7" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel7">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="Viertel4">Ergebnis speichern</button>
      </div>
    </div>
  </div>
</div>
    </form>
        </div>
    </div> 
    
    </div>
    </div>
    <br>
   <!-- ----------------Achtelfinale---------------------   -->
    
  <!--<div class="container-fluid">  -->
    
     <div class="row">
    <div class="col-lg-3 col-xs-4 alert-info">
        <p> 1. Achtelfinale </p>
        <div class="col-lg-12 alert-success">
            <p> 30.06.18 16:00 Uhr</p>
            <form action="tippeingabe.php"method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal8">
  Tippabgabe
</button>
<?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='Achtel1'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='Achtel1' AND BenutzerID='$id'";
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    if($resultCheck > 0){
    
    echo "<br> Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
                $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='Achtel1'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='Achtel1'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>

<!-- Modal -->
<div class="modal fade" id="exampleModal8" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel8" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"8>Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="Achtel1">Ergebnis speichern</button>
      </div>
    </div>
  </div>
</div>
    </form>
        </div>
         </div>
        
    <div class="col-lg-3 col-xs-4 alert-info">
        <p>2. Achtelfinale</p>
        <div class="col-lg-12 alert-success">
            <p>30.06.18 20:00 Uhr</p>
            <form action="tippeingabe"method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal9">
  Tippabgabe
</button>
                
<?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='Achtel2'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='Achtel2' AND BenutzerID='$id'";
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    if($resultCheck > 0){
    
    echo " <br> Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
                $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='Achtel2'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='Achtel2'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>


<!-- Modal -->
<div class="modal fade" id="exampleModal9" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel9" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel9">Heim : Gast </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="Achtel2">Ergebnis speichern</button>
      </div>
    </div>
  </div>
</div>
    </form>
        </div>
         </div>
    <div class="col-lg-3 col-xs-4 alert-info">
        
        <p>3. Achtelfinale</p>
        <div class="col-lg-12 alert-success">
            <p> 01.07.18 16:00 Uhr</p>
            <form action="tippeingabe.php"method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal10">
  Tippabgabe
</button>
                
        <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='Achtel3'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='Achtel3' AND BenutzerID='$id'";
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    if($resultCheck > 0){
    
    echo "<br> Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
                $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='Achtel3'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='Achtel3'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>
        

<!-- Modal -->
<div class="modal fade" id="exampleModal10" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel10" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel10">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
   <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="Achtel3">Ergebnis speichern</button>
      </div>
    </div>
  </div>
</div>
    </form>
        </div>
        </div>
    <div class="col-lg-3 col-xs-4 alert-info">
        <p>4. Achtelfinale</p>
        <div class="col-lg-12 alert-success">
            <p> 01.07.18 20:00 Uhr</p>
            <form action="tippeingabe"method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal11">
  Tippabgabe
</button>
                
<?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='Achtel4'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='Achtel4' AND BenutzerID='$id'";
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    if($resultCheck > 0){
    
    echo "<br> Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
                $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='Achtel4'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='Achtel4'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>
                

<!-- Modal -->
<div class="modal fade" id="exampleModal11" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabe11l" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel11">Heim : Gast </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="Achtel4">Ergebnis speichern</button>
      </div>
    </div>
  </div>
</div>
    </form>
        </div>
    </div> 
    
     <div class="col-lg-3 col-xs-4 alert-info">
        <p>5. Achtelfinale</p>
        <div class="col-lg-12 alert-success">
            <p> 02.07.18 16:00 Uhr</p>
            <form action="tippeingabe.php"method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal12">
  Tippabgabe
</button>
                <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='Achtel5'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='Achtel5' AND BenutzerID='$id'";
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    if($resultCheck > 0){
    
    echo "<br> Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
                $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='Achtel5'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='Achtel5'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>


<!-- Modal -->
<div class="modal fade" id="exampleModal12" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel12" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel12">Heim : Gast </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
     <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="Achtel5">Ergebnis speichern</button>
      </div>
    </div>
  </div>
</div>
    </form>
        </div>
          </div>
    <div class="col-lg-3 col-xs-4 alert-info">
        <p>6. Achtelfinale</p>
        
        <div class="col-lg-12 alert-success">
            <p> 02.07.18 20:00 Uhr</p>
            <form action="tippeingabe.php"method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal13">
  Tippabgabe
</button>
                
<?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='Achtel6'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='Achtel6' AND BenutzerID='$id'";
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    if($resultCheck > 0){
    
    echo "<br> Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
                $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='Achtel6'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='Achtel6'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>
                

<!-- Modal -->
<div class="modal fade" id="exampleModal13" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel13" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel13">Heim : Gast </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="Achtel6">Ergebnis speichern</button>
      </div>
    </div>
  </div>
</div>
    </form>
        </div>
         </div>
         
    <div class="col-lg-3 col-xs-4 alert-info">
        <p>7. Achtelfinale</p>
        <div class="col-lg-12 alert-success">
            <p> 03.07.18 16:00 Uhr </p>
            <form action="tippeingabe.php"method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal14">
  Tippabgabe
</button>
                <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='Achtel7'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='Achtel7' AND BenutzerID='$id'";
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    if($resultCheck > 0){
    
    echo "<br> Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
      $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID= 'Achtel7'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='Achtel7'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>


<!-- Modal -->
<div class="modal fade" id="exampleModal14" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel14" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel14">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="Achtel7">Ergebnis speichern</button>
      </div>
    </div>
  </div>
</div>
    </form>
        </div>
         </div>
         
    <div class="col-lg-3 col-xs-4 alert-info">
        <p>8. Achtelfinale</p>
        <div class="col-lg-12 alert-success">
            <p> 03.07.18 16:00 Uhr </p>
            <form action="tippeingabe.php"method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal15">
  Tippabgabe
</button>
                
                <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='Achtel8'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='Achtel8' AND BenutzerID='$id'";
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    if($resultCheck > 0){
    
    echo "Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
                $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='Achtel8'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='Achtel8'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>


<!-- Modal -->
<div class="modal fade" id="exampleModal15" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel15" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel15">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
     <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="Achtel8">Ergebnis speichern</button>
      </div>
    </div>
  </div>
</div>
    </form>
    </div> 
   
     </div> 
    </div>
    
    <br>
    <br>
    
    <!-- ----------------Ergebnisse der Gruppenspiele------------------------    -->   
    
<!--Zwischenüberschrift-->
     <div class="jumbotron jumbotron-fluid">
     <div class="row">
    <div class="col-xs-12 col-lg-12">  
    <div class="container-fluid">
        <h1>Ergebnisse der Gruppenspiele</h1>
        </div>    
         </div>
     </div>
    </div>
    
    
    
    
    <!-- ---------------Gruppe A---------------------------------->   
 <div class="container">
    <div class="row">
    <div class="col-lg-6 col-xs-4 alert-info">
        <table class="table table-hover">
        <?php
            $sqlAbfrage ="SELECT * FROM land WHERE gruppe='A' ORDER BY punkte DESC";
            
            
            $db_landAbfrage = $db_link->query($sqlAbfrage);
            echo "<tr><th>Gruppe A</th>
                    <th>Win</th>
                    <th>Remis</th>
                    <th>Lose</th>
                    <th>Pkt</th></tr>";
            
            while($db_ergLand = $db_landAbfrage->fetch_assoc()){
                /*printf($db_ergLand['landName']);
                printf($db_ergLand['gruppe']);*/
                
                $landName = $db_ergLand['landName'];
                $landWin = $db_ergLand['win'];
                $remi = $db_ergLand['remi'];
                $lose = $db_ergLand['lose'];
                $punkte = $db_ergLand['punkte'];
                
                echo "<tr>
                        <td> $landName </td>
                        <td> $landWin </td>
                        <td> $remi </td>
                        <td> $lose </td>
                        <td> $punkte </td>
                        
                    </tr>";
            };
            
            /*echo mysqli_num_rows($db_landAbfrage);*/
        ?>
       <!-- <tr>
           <th>Gruppe A</th> 
             <th>Sp</th>
             <th>Pkt</th> 
             <th>Tore</th>
             <th>Diff</th>
             <th>g</th>
            <th>u</th> 
            <th>v</th>   
        </tr>
            <tr>
            <td>Spanien</td>
            <td>3</td>
            <td>5</td>
            <td>6:5</td>
            <td>1</td>
            <td>1</td>
            <td>2</td>
            <td>0</td>
            </tr>
        
            <tr>
            <td>Portugal</td>
            <td>3</td>
            <td>5</td>
            <td>5:4</td>
            <td>1</td>
            <td>1</td>
            <td>2</td>
            <td>0</td>
            </tr>
            
            <tr>
            <td>Iran</td>
            <td>3</td>
            <td>4</td>
            <td>2:2</td>
            <td>0</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            </tr>
            
            <tr>
            <td>Marokko</td>
            <td>3</td>
            <td>1</td>
            <td>2:4</td>
            <td>-2</td>
            <td>0</td>
            <td>1</td>
            <td>2</td>
            </tr>-->
        </table>
        
        </div>
    
 <!-- ---------------Gruppe B---------------------------------->       
    <div class="col-lg-6 col-xs-4 alert-info">
        <table class="table table-hover">
            
            <?php
            $sqlAbfrage ="SELECT * FROM land WHERE gruppe='B'ORDER BY punkte DESC";
            
            
            $db_landAbfrage = $db_link->query($sqlAbfrage);
            echo "<tr><th>Gruppe B</th>
                    <th>Win</th>
                    <th>Remis</th>
                    <th>Lose</th>
                    <th>Pkt</th></tr>";
            
            while($db_ergLand = $db_landAbfrage->fetch_assoc()){
                /*printf($db_ergLand['landName']);
                printf($db_ergLand['gruppe']);*/
                
                $landName = $db_ergLand['landName'];
                $landWin = $db_ergLand['win'];
                $remi = $db_ergLand['remi'];
                $lose = $db_ergLand['lose'];
                $punkte = $db_ergLand['punkte'];
                
                echo "<tr>
                        <td> $landName </td>
                        <td> $landWin </td>
                        <td> $remi </td>
                        <td> $lose </td>
                        <td> $punkte </td>
                        
                    </tr>";
            };
            
            /*echo mysqli_num_rows($db_landAbfrage);*/
        ?>
        
       <!-- <tr>
           <th>Gruppe B</th> 
             <th>Sp</th>
             <th>Pkt</th> 
             <th>Tore</th>
             <th>Diff</th>
             <th>g</th>
            <th>u</th> 
            <th>v</th>   
        </tr>
            <tr>
            <td>Spanien</td>
            <td>3</td>
            <td>5</td>
            <td>6:5</td>
            <td>1</td>
            <td>1</td>
            <td>2</td>
            <td>0</td>
            </tr>
        
            <tr>
            <td>Portugal</td>
            <td>3</td>
            <td>5</td>
            <td>5:4</td>
            <td>1</td>
            <td>1</td>
            <td>2</td>
            <td>0</td>
            </tr>
            
            <tr>
            <td>Iran</td>
            <td>3</td>
            <td>4</td>
            <td>2:2</td>
            <td>0</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            </tr>
            
            <tr>
            <td>Marokko</td>
            <td>3</td>
            <td>1</td>
            <td>2:4</td>
            <td>-2</td>
            <td>0</td>
            <td>1</td>
            <td>2</td>
            </tr>-->
        </table>
        
        </div>
  <!-- ---------------Gruppe c---------------------------------->        
        <div class="col-lg-6 col-xs-4 alert-info">
        <table class="table table-hover">
        <?php
            $sqlAbfrage ="SELECT * FROM land WHERE gruppe='C'ORDER BY punkte DESC";
            
            
            $db_landAbfrage = $db_link->query($sqlAbfrage);
            echo "<tr><th>Gruppe C</th>
                    <th>Win</th>
                    <th>Remis</th>
                    <th>Lose</th>
                    <th>Pkt</th></tr>";
            
            while($db_ergLand = $db_landAbfrage->fetch_assoc()){
                /*printf($db_ergLand['landName']);
                printf($db_ergLand['gruppe']);*/
                
                $landName = $db_ergLand['landName'];
                $landWin = $db_ergLand['win'];
                $remi = $db_ergLand['remi'];
                $lose = $db_ergLand['lose'];
                $punkte = $db_ergLand['punkte'];
                
                echo "<tr>
                        <td> $landName </td>
                        <td> $landWin </td>
                        <td> $remi </td>
                        <td> $lose </td>
                        <td> $punkte </td>
                        
                    </tr>";
            };
            
            /*echo mysqli_num_rows($db_landAbfrage);*/
        ?>
        <!--
<tr>
           
             <th>Pkt</th> 
             <th>Tore</th>
             <th>Diff</th>
             <th>g</th>
            <th>u</th> 
            <th>v</th>   
        </tr>
            <tr>
            <td>Frankreich</td>
            <td>3</td>
            <td>5</td>
            <td>6:5</td>
            <td>1</td>
            <td>1</td>
            <td>2</td>
            <td>0</td>
            </tr>
        
            <tr>
            <td>Dänemark</td>
            <td>3</td>
            <td>5</td>
            <td>5:4</td>
            <td>1</td>
            <td>1</td>
            <td>2</td>
            <td>0</td>
            </tr>
            
            <tr>
            <td>Australien</td>
            <td>3</td>
            <td>4</td>
            <td>2:2</td>
            <td>0</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            </tr>
            
            <tr>
            <td>Peru</td>
            <td>3</td>
            <td>1</td>
            <td>2:4</td>
            <td>-2</td>
            <td>0</td>
            <td>1</td>
            <td>2</td>
            </tr>-->
        </table>
        
        </div>
     <!-- ---------------Gruppe D--------------------------------->     
        <div class="col-lg-6 col-xs-4 alert-info">
        <table class="table table-hover">
        <?php
            $sqlAbfrage ="SELECT * FROM land WHERE gruppe='D'ORDER BY punkte DESC";
            
            
            $db_landAbfrage = $db_link->query($sqlAbfrage);
            echo "<tr><th>Gruppe D</th>
                    <th>Win</th>
                    <th>Remis</th>
                    <th>Lose</th>
                    <th>Pkt</th></tr>";
            
            while($db_ergLand = $db_landAbfrage->fetch_assoc()){
                /*printf($db_ergLand['landName']);
                printf($db_ergLand['gruppe']);*/
                
                $landName = $db_ergLand['landName'];
                $landWin = $db_ergLand['win'];
                $remi = $db_ergLand['remi'];
                $lose = $db_ergLand['lose'];
                $punkte = $db_ergLand['punkte'];
                
                echo "<tr>
                        <td> $landName </td>
                        <td> $landWin </td>
                        <td> $remi </td>
                        <td> $lose </td>
                        <td> $punkte </td>
                        
                    </tr>";
            };
            
            /*echo mysqli_num_rows($db_landAbfrage);*/
        ?>
        <!--<tr>
        
            <td>0</td>
            </tr>
        
            <tr>
            <td>Nigeria</td>
            <td>3</td>
            <td>5</td>
            <td>5:4</td>
            <td>1</td>
            <td>1</td>
            <td>2</td>
            <td>0</td>
            </tr>
            
            <tr>
            <td>Island</td>
            <td>3</td>
            <td>4</td>
            <td>2:2</td>
            <td>0</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            </tr>
            
            <tr>
            <td>Argentinien</td>
            <td>3</td>
            <td>1</td>
            <td>2:4</td>
            <td>-2</td>
            <td>0</td>
            <td>1</td>
            <td>2</td>
            </tr>-->
        </table>
        </div>
     <!-- ---------------Gruppe E---------------------------------->     
        
        <div class="col-lg-6 col-xs-4 alert-info">
        <table class="table table-hover">
        <?php
            $sqlAbfrage ="SELECT * FROM land WHERE gruppe='E'ORDER BY punkte DESC";
            
            
            $db_landAbfrage = $db_link->query($sqlAbfrage);
            echo "<tr><th>Gruppe E</th>
                    <th>Win</th>
                    <th>Remis</th>
                    <th>Lose</th>
                    <th>Pkt</th></tr>";
            
            while($db_ergLand = $db_landAbfrage->fetch_assoc()){
                /*printf($db_ergLand['landName']);
                printf($db_ergLand['gruppe']);*/
                
                $landName = $db_ergLand['landName'];
                $landWin = $db_ergLand['win'];
                $remi = $db_ergLand['remi'];
                $lose = $db_ergLand['lose'];
                $punkte = $db_ergLand['punkte'];
                
                echo "<tr>
                        <td> $landName </td>
                        <td> $landWin </td>
                        <td> $remi </td>
                        <td> $lose </td>
                        <td> $punkte </td>
                        
                    </tr>";
            };
            
            /*echo mysqli_num_rows($db_landAbfrage);*/
        ?>
            
            
            
        <!--<tr>
           <th>Gruppe E</th> 
             <th>Sp</th>
             <th>Pkt</th> 
             <th>Tore</th>
             <th>Diff</th>
             <th>g</th>
            <th>u</th> 
            <th>v</th>   
        </tr>
            <tr>
            <td>Brasilien</td>
            <td>3</td>
            <td>5</td>
            <td>6:5</td>
            <td>1</td>
            <td>1</td>
            <td>2</td>
            <td>0</td>
            </tr>
        
            <tr>
            <td>Schweiz</td>
            <td>3</td>
            <td>5</td>
            <td>5:4</td>
            <td>1</td>
            <td>1</td>
            <td>2</td>
            <td>0</td>
            </tr>
            
            <tr>
            <td>Serbien</td>
            <td>3</td>
            <td>4</td>
            <td>2:2</td>
            <td>0</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            </tr>
            
            <tr>
            <td>Costa Rica</td>
            <td>3</td>
            <td>1</td>
            <td>2:4</td>
            <td>-2</td>
            <td>0</td>
            <td>1</td>
            <td>2</td>
            </tr>-->
        </table>
        
        </div>
 <!-- ---------------Gruppe F---------------------------------->         
       <div class="col-lg-6 col-xs-4 alert-info">
        <table class="table table-hover">
            
          <?php
            $sqlAbfrage ="SELECT * FROM land WHERE gruppe='F'ORDER BY punkte DESC";
            
            
            $db_landAbfrage = $db_link->query($sqlAbfrage);
            echo "<tr><th>Gruppe F</th>
                    <th>Win</th>
                    <th>Remis</th>
                    <th>Lose</th>
                    <th>Pkt</th></tr>";
            
            while($db_ergLand = $db_landAbfrage->fetch_assoc()){
                /*printf($db_ergLand['landName']);
                printf($db_ergLand['gruppe']);*/
                
                $landName = $db_ergLand['landName'];
                $landWin = $db_ergLand['win'];
                $remi = $db_ergLand['remi'];
                $lose = $db_ergLand['lose'];
                $punkte = $db_ergLand['punkte'];
                
                echo "<tr>
                        <td> $landName </td>
                        <td> $landWin </td>
                        <td> $remi </td>
                        <td> $lose </td>
                        <td> $punkte </td>
                        
                    </tr>";
            };
            
            /*echo mysqli_num_rows($db_landAbfrage);*/
        ?>
            
            
       <!-- <tr>
           <th>Gruppe F</th> 
             <th>Sp</th>
             <th>Pkt</th> 
             <th>Tore</th>
             <th>Diff</th>
             <th>g</th>
            <th>u</th> 
            <th>v</th>   
        </tr>
            <tr>
            <td>MexiKo</td>
            <td>3</td>
            <td>5</td>
            <td>6:5</td>
            <td>1</td>
            <td>1</td>
            <td>2</td>
            <td>0</td>
            </tr>
        
            <tr>
            <td>Deutschland</td>
            <td>3</td>
            <td>5</td>
            <td>5:4</td>
            <td>1</td>
            <td>1</td>
            <td>2</td>
            <td>0</td>
            </tr>
            
            <tr>
            <td>Schweden</td>
            <td>3</td>
            <td>4</td>
            <td>2:2</td>
            <td>0</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            </tr>
            
            <tr>
            <td>Südkorea</td>
            <td>3</td>
            <td>1</td>
            <td>2:4</td>
            <td>-2</td>
            <td>0</td>
            <td>1</td>
            <td>2</td>
            </tr>-->
        </table>
        
        </div>
     <!-- ---------------Gruppe G---------------------------------->     
        <div class="col-lg-6 col-xs-4 alert-info">
        <table class="table table-hover">
              <?php
            $sqlAbfrage ="SELECT * FROM land WHERE gruppe='G'ORDER BY punkte DESC";
            
            
            $db_landAbfrage = $db_link->query($sqlAbfrage);
            echo "<tr><th>Gruppe G</th>
                    <th>Win</th>
                    <th>Remis</th>
                    <th>Lose</th>
                    <th>Pkt</th></tr>";
            
            while($db_ergLand = $db_landAbfrage->fetch_assoc()){
                /*printf($db_ergLand['landName']);
                printf($db_ergLand['gruppe']);*/
                
                $landName = $db_ergLand['landName'];
                $landWin = $db_ergLand['win'];
                $remi = $db_ergLand['remi'];
                $lose = $db_ergLand['lose'];
                $punkte = $db_ergLand['punkte'];
                
                echo "<tr>
                        <td> $landName </td>
                        <td> $landWin </td>
                        <td> $remi </td>
                        <td> $lose </td>
                        <td> $punkte </td>
                        
                    </tr>";
            };
            
            /*echo mysqli_num_rows($db_landAbfrage);*/
        ?>
        
        <!--<tr>
           <th>Gruppe G</th> 
             <th>Sp</th>
             <th>Pkt</th> 
             <th>Tore</th>
             <th>Diff</th>
             <th>g</th>
            <th>u</th> 
            <th>v</th>   
        </tr>
            <tr>
            <td>Belgien</td>
            <td>3</td>
            <td>5</td>
            <td>6:5</td>
            <td>1</td>
            <td>1</td>
            <td>2</td>
            <td>0</td>
            </tr>
        
            <tr>
            <td>England</td>
            <td>3</td>
            <td>5</td>
            <td>5:4</td>
            <td>1</td>
            <td>1</td>
            <td>2</td>
            <td>0</td>
            </tr>
            
            <tr>
            <td>Tunesien</td>
            <td>3</td>
            <td>4</td>
            <td>2:2</td>
            <td>0</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            </tr>
            
            <tr>
            <td>Panama</td>
            <td>3</td>
            <td>1</td>
            <td>2:4</td>
            <td>-2</td>
            <td>0</td>
            <td>1</td>
            <td>2</td>
            </tr>-->
        </table>
        
        </div>
        
 <!-- ---------------Gruppe H---------------------------------->         
    <div class="col-lg-6 col-xs-4 alert-info">
        <table class="table table-hover">
          <?php
            $sqlAbfrage ="SELECT * FROM land WHERE gruppe='H'ORDER BY punkte DESC";
            
            
            $db_landAbfrage = $db_link->query($sqlAbfrage);
            echo "<tr><th>Gruppe H</th>
                    <th>Win</th>
                    <th>Remis</th>
                    <th>Lose</th>
                    <th>Pkt</th></tr>";
            
            while($db_ergLand = $db_landAbfrage->fetch_assoc()){
                /*printf($db_ergLand['landName']);
                printf($db_ergLand['gruppe']);*/
                
                $landName = $db_ergLand['landName'];
                $landWin = $db_ergLand['win'];
                $remi = $db_ergLand['remi'];
                $lose = $db_ergLand['lose'];
                $punkte = $db_ergLand['punkte'];
                
                echo "<tr>
                        <td> $landName </td>
                        <td> $landWin </td>
                        <td> $remi </td>
                        <td> $lose </td>
                        <td> $punkte </td>
                        
                    </tr>";
            };
            
            /*echo mysqli_num_rows($db_landAbfrage);*/
        ?>
       <!-- 
<tr>
           <th>Gruppe H</th> 
             <th>Sp</th>
             <th>Pkt</th> 
             <th>Tore</th>
             <th>Diff</th>
             <th>g</th>
            <th>u</th> 
            <th>v</th>   
        </tr>
            <tr>
            <td>Japan</td>
            <td>3</td>
            <td>5</td>
            <td>6:5</td>
            <td>1</td>
            <td>1</td>
            <td>2</td>
            <td>0</td>
            </tr>
        
            <tr>
            <td>Senegal</td>
            <td>3</td>
            <td>5</td>
            <td>5:4</td>
            <td>1</td>
            <td>1</td>
            <td>2</td>
            <td>0</td>
            </tr>
            
            <tr>
            <td>Kolumbien</td>
            <td>3</td>
            <td>4</td>
            <td>2:2</td>
            <td>0</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            </tr>
            
            <tr>
            <td>Polen</td>
            <td>3</td>
            <td>1</td>
            <td>2:4</td>
            <td>-2</td>
            <td>0</td>
            <td>1</td>
            <td>2</td>
            </tr>-->
        </table>
        
        </div>
     </div>
    </div>
        <br>
    
       
<!--Zwischenüberschrift-->
     <div class="jumbotron jumbotron-fluid">
     <div class="row">
    <div class="col-xs-12 col-lg-12">  
    <div class="container-fluid">
        <h1>Übersicht der Tippabgaben</h1>
        </div>    
         </div>
     </div>
    </div>

<!--Tippabgabe Gruppenspiele --> 
    
    <div class="container">
    <div class="row">
    
        
        

 <!---------------------- Gruppe A--------------------------->        
    <div class="col-lg-6 col-xs-4 alert-info">
        <table class="table table-hover">
                          
        <tr>
           <th>Gruppe A</th>    
        </tr>
            <tr>
           <td>14.06.18</td> 
             <td>17:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Russland </td>
                <td>Saudi-Arabien</td>
                 
            
            <td>
                
                
    <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalA1">
  Tippabgabe
</button>
                    <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrASp1'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrASp1' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrASp1'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrASp1'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>


<!-- Modal -->
<div class="modal fade" id="exampleModalA1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelA1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelA1">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrASp1">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
    </td>
            </tr>   
<!---- --->           
      <tr>
           <td>15.06.18</td> 
             <td>14:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Ägypten</td>
                <td>Uruguay</td>
                 
            
            <td>
                
                
                <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalA2">
  Tippabgabe
</button>
<?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrASp2'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrASp2' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrASp2'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrASp2'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>

<!-- Modal -->
<div class="modal fade" id="exampleModalA2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelA2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelA2">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrASp2">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
                </td>
    <!-- --->            
            </tr>
               <tr>
           <td>19.06.18</td> 
             <td>20:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Russland </td>
                <td>Ägypten</td>
                 
            
            <td>
                
                
<form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalA3">
  Tippabgabe
</button>
    <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrASp3'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrASp3' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrASp3'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrASp3'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>


<!-- Modal -->
<div class="modal fade" id="exampleModalA3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelA3" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelA3">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrSpA3">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
    </td>
            </tr>       
                
    <!-- -->            
               <tr>
           <td>20.06.18</td> 
             <td>17:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Uruguay</td>
                <td>Saudi Arabien</td>
                 
            
            <td>
                
                
                <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalA4">
  Tippabgabe
</button>
                    
    <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrASp4'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrASp4' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrASp4'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrASp4'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>

<!-- Modal -->
<div class="modal fade" id="exampleModalA4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelA4" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelA4">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrASp4">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
    </td>
            </tr>
<!-- -->            
               <tr>
           <td>25.06.18</td> 
             <td>16:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Uruguay</td>
                <td>Russland </td>
             
                 
            
            <td>
                
                
                <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalA5">
  Tippabgabe
</button>
                    
    <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrASp5'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrASp5' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrASp5'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrASp5'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>

<!-- Modal -->
<div class="modal fade" id="exampleModalA5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelA5" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrASp5">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
    </td>
            </tr>            
               <tr>
           <td>25.06.18</td> 
             <td>16:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Saudi Arabien</td>
                <td>Ägypten</td>
                
                
                
                
                 <td>
                
                
                <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalA6">
  Tippabgabe
</button>

    <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrASp6'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrASp6' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrASp6'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrASp6'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>
<!-- Modal -->
<div class="modal fade" id="exampleModalA6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelA6" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelA6">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrASp6">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
   
    </td>
            </tr>
                </table>        
            </div>
                
                
                
        
                
      
        
                 
 <!-------------------- Gruppe B--------------------------------> 
                
                               
    
    <div class="col-lg-6 col-xs-4 alert-info">
        <table class="table table-hover">
        
        <tr>
           <th>Gruppe B</th>    
        </tr>
            <tr>
           <td>15.06.18</td> 
             <td>17:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Marokko </td>
                <td>Iran</td>
                 
            
            <td>
                
                
                 
<form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalB1">
  Tippabgabe

    </button>
    <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrBSp1'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrBSp1' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrBSp1'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrBSp1'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>

<!-- Modal -->
<div class="modal fade" id="exampleModalB1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelB1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelB1">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrBSp1">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
    </td>
            </tr>                
    <!-- -->            
      <tr>
           <td>15.06.18</td> 
             <td>20 Uhr Uhr</td>
                 
        </tr>
            <tr>
                <td>Portugal</td>
                <td>Spanien</td>
                 
            
            <td>
                
                
                
<form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalB2">
  Tippabgabe

    </button>
    <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrBSp2'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrBSp2' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrBSp2'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrBSp2'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>

<!-- Modal -->
<div class="modal fade" id="exampleModalB2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelB2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelB2">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrBSp2">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
    </td>
            </tr>
               <tr>
           <td>20.06.18</td> 
             <td>14:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Portugal</td>
                <td>Marokko</td>
                 
            
            <td>
                
                
                                
<form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalB3">
  Tippabgabe

    </button>
    <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrBSp3'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrBSp3' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrBSp3'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrBSp3'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>

<!-- Modal -->
<div class="modal fade" id="exampleModalB3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelB3" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelB3">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrBSp3">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
    </td>
             
            </tr>
            <tr>
           <td>20.06.18</td> 
             <td>20:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Iran</td>
                <td>Spanien</td>
                 
            
            <td>
                
                
                               
<form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalB4">
  Tippabgabe
</button>
    
    <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrASp4'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrASp4' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrASp4'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrASp4'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>

<!-- Modal -->
<div class="modal fade" id="exampleModalB4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelB4" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelB4">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrBSp4">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
    </td>
            </tr>
               <tr>
           <td>25.06.18</td> 
             <td>20:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Spanien</td>
                <td>Marokko </td>
             
                 
            
            <td>
                
                
                               
<form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalB5">
  Tippabgabe
</button>
    
    <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrBSp5'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrBSp5' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrASp3'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrBSp5'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>

<!-- Modal -->
<div class="modal fade" id="exampleModalB5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelB5" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelB5">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="B5">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
    </td>
            </tr>
               <tr>
           <td>25.06.18</td> 
             <td>20:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Iran</td>
                <td>Portugal</td>
                 
            
            <td>
                
                
                                
<form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalB6">
  Tippabgabe
</button>
    
    <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrBSp6'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrBSp6' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrBSp6'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrBSp6'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>

<!-- Modal -->
<div class="modal fade" id="exampleModalB6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelB6" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelB6">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrBSp6">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
    </td>
            </tr>
                         

            
    
        </table>
        </div>
     

        
<!--------------- Gruppe C----------------------------------------->        
    <div class="col-lg-6 col-xs-4 alert-info">
        <table class="table table-hover">
                          
        <tr>
           <th>Gruppe C</th>    
        </tr>
            <tr>
           <td>16.06.18</td> 
             <td>12:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Frankreich</td>
                <td>Australien</td>
                 
            
            <td>
                
                
                <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalC1">
  Tippabgabe
</button>
                    
    <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrCSp1'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrCSp1' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrCSp1'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrCSp1'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>

<!-- Modal -->
<div class="modal fade" id="exampleModalC1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelC1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelC1">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrCSp1">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
    </td>
            </tr>       
      <tr>
           <td>16.06.18</td> 
             <td>18:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Peru</td>
                <td>Dänemark</td>
                 
            
            <td>
                
                
                <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalC2">
  Tippabgabe
</button>
                
    <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrCSp2'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrCSp2' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrCSp2'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrCSp2'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>

<!-- Modal -->
<div class="modal fade" id="exampleModalC2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelC2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelC2">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrCSp2">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
                </td>
            </tr>
               <tr>
           <td>21.06.18</td> 
             <td>14:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Dänemark </td>
                <td>Australien</td>
                 
            
            <td>
                
                
<form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalC3">
  Tippabgabe
</button>

    <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrCSp3'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrCSp3' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrCSp3'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrCSp3'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>
    
<!-- Modal -->
<div class="modal fade" id="exampleModalC3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelC3" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelC3">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrCSp3">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
    </td>
            </tr>       
                
                
               <tr>
           <td>21.06.18</td> 
             <td>17:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Frankreich</td>
                <td>Peru</td>
                 
            
            <td>
                
                
                <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalC4">
  Tippabgabe
                    </button>
    <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrCSp4'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrCSp4' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrCSp4'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrCSp4'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>

<!-- Modal -->
<div class="modal fade" id="exampleModalC4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelC4" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelC4">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrCSp4">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
    </td>
            </tr>
               <tr>
           <td>26.06.18</td> 
             <td>16:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Dänkemark</td>
                <td>Frankreich </td>
             
                 
            
            <td>
                
                
                <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalC5">
  Tippabgabe
                        
</button>

    <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrCSp5'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrCSp5' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrCSp5'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrCSp5'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>
<!-- Modal -->
<div class="modal fade" id="exampleModalC5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelC5" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelC5">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrCSp5">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
    </td>
            </tr>            
               <tr>
           <td>26.06.18</td> 
             <td>16:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Australien</td>
                <td>Peru</td>
                
                
                
                
                 <td>
                
                
                <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalC6">
  Tippabgabe
</button>
                    
    <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrCSp6'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrCSp6' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrCSp6'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrCSp6'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>

<!-- Modal -->
<div class="modal fade" id="exampleModalC6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelC6" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelC6">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="C6">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
   
    </td>
            </tr>
                </table>        
            </div>
                
                
                
        
                
      
<!--------------------- Gruppe D------------------------------>        
    <div class="col-lg-6 col-xs-4 alert-info">
        <table class="table table-hover">
                          
        <tr>
           <th>Gruppe D</th>    
        </tr>
            <tr>
           <td>16.06.18</td> 
             <td>15:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Argentinien </td>
                <td>Island</td>
                 
            
            <td>
                
                
                <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalD5">
  Tippabgabe
</button>
                    
    <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrDSp1'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrDSp1' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrDSp1'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrDSp1'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>
                 

<!-- Modal -->
<div class="modal fade" id="exampleModalD5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelD5" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelD5">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrDSp1">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
    </td>
            </tr>       
      <tr>
           <td>16.06.18</td> 
             <td>21:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Kroatien</td>
                <td>Nigeria</td>
                 
            
            <td>
                
                
                <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalD2">
  Tippabgabe
</button>
                     <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrDSp2'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrDSp2' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrDSp2'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrDSp2'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>


<!-- Modal -->
<div class="modal fade" id="exampleModalD2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelD2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelD2">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrDSp2">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
                </td>
            </tr>
               <tr>
           <td>21.06.18</td> 
             <td>20:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Argentinien</td>
                <td>Kroatien</td>
                 
            
            <td>
                
                
<form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalD3">
  Tippabgabe
</button>
     <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrDSp3'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrDSp3' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrDSp3'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrDSp3'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>


<!-- Modal -->
<div class="modal fade" id="exampleModalD3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelD3" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelD3">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrDSp3">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
    </td>
            </tr>       
                
                
               <tr>
           <td>22.06.18</td> 
             <td>17:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Nigeria</td>
                <td>Island</td>
                 
            
            <td>
                
                
                <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalD4">
  Tippabgabe
</button>
                     <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrDSp4'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrDSp4' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrDSp4'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrDSp4'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>


<!-- Modal -->
<div class="modal fade" id="exampleModalD4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelD4" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelD4">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrDSp4">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
    </td>
            </tr>
               <tr>
           <td>26.06.18</td> 
             <td>20:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Island</td>
                <td>Kroatien</td>
             
                 
            
            <td>
                
                
                <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalD5">
  Tippabgabe
</button>
 <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrDSp5'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrDSp5' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrDSp5'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrDSp5'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>

<!-- Modal -->
<div class="modal fade" id="exampleModalD5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelD5" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelD5">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrDSp5">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
    </td>
            </tr>            
               <tr>
           <td>26.06.18</td> 
             <td>20:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Nigeria</td>
                <td>Argentinien</td>
                
                
                
                
                 <td>
                
                
                <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalD6">
  Tippabgabe
</button>
                     <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrDSp6'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrDSp6' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrDSp6'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrDSp6'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>


<!-- Modal -->
<div class="modal fade" id="exampleModalD6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelD6" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelD6">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="D6">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
   
    </td>
            </tr>
                </table>        
            </div>
                
                
                
        
                
      
<!----------------- Gruppe E-------------------------------->   
        
    <div class="col-lg-6 col-xs-4 alert-info">
        <table class="table table-hover">
                          
        <tr>
           <th>Gruppe E</th>    
        </tr>
            <tr>
           <td>17.06.18</td> 
             <td>14:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Costa Rica </td>
                <td>Serbien</td>
                 
            
            <td>
                
                
                <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalE1">
  Tippabgabe
</button>
                     <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrESp1'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrESp1' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrESp1'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrESp1'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>


<!-- Modal -->
<div class="modal fade" id="exampleModalE1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelE1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelE1">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="E1">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
    </td>
            </tr>       
      <tr>
           <td>17.06.18</td> 
             <td>20:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Brasilien</td>
                <td>Schweiz</td>
                 
            
            <td>
                
                
                <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalE2">
  Tippabgabe
</button>
                     <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrESp2'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrESp2' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrESp2'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrESp2'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>


<!-- Modal -->
<div class="modal fade" id="exampleModalE2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelE2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelE2">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrESp2">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
                </td>
            </tr>
               <tr>
           <td>22.06.18</td> 
             <td>14:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Brasilien </td>
                <td>Costa Rica</td>
                 
            
            <td>
                
                
<form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalE3">
  Tippabgabe
</button>
     <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrESp3'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrESp3' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrESp3'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrESp3'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>


<!-- Modal -->
<div class="modal fade" id="exampleModalE3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelE3" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelE3">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrESp3">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
    </td>
            </tr>       
                
                
               <tr>
           <td>22.06.18</td> 
             <td>20:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Serbien</td>
                <td>Schweiz</td>
                 
            
            <td>
                
                
                <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalE4">
  Tippabgabe
</button>
                     <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrESp4'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrESp4' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrESp4'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrESp4'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>


<!-- Modal -->
<div class="modal fade" id="exampleModalE4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelE4" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelE4">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrESp4">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
    </td>
            </tr>
               <tr>
           <td>27.06.18</td> 
             <td>20:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Serbien</td>
                <td>Brasilien </td>
             
                 
            
            <td>
                
                
                <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalE5">
  Tippabgabe
</button>
                     <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrESp5'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrESp5' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrESp5'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrESp5'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>


<!-- Modal -->
<div class="modal fade" id="exampleModalE5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelE5" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelE5">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrESp5">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
    </td>
            </tr>            
               <tr>
           <td>27.06.18</td> 
             <td>20:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Schweiz</td>
                <td>Costa Rica</td>
                
                
                
                
                 <td>
                
                
                <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalE6">
  Tippabgabe
</button>
                     <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrESp6'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrESp6' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrESp6'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrESp6'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>


<!-- Modal -->
<div class="modal fade" id="exampleModalE6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelE6" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelE6">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrESp6">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
   
    </td>
            </tr>
                </table>        
            </div>
                
                
                
        
                
      
        <!-------------------- Gruppe F---------------------> 
        
    <div class="col-lg-6 col-xs-4 alert-info">
        <table class="table table-hover">
                          
        <tr>
           <th>Gruppe F</th>    
        </tr>
            <tr>
           <td>17.06.18</td> 
             <td>17:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Deutschland </td>
                <td>Mexiko</td>
                 
            
            <td>
                
                
                <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalF1">
  Tippabgabe
</button>
                     <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrFSp1'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrFSp1' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrFSp1'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrFSp1'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>


<!-- Modal -->
<div class="modal fade" id="exampleModalF1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelF1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelF1">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrFSp1">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
    </td>
            </tr>       
      <tr>
           <td>18.06.18</td> 
             <td>14:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Schweden</td>
                <td>Südkorea</td>
                 
            
            <td>
                
                
                <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalF2">
  Tippabgabe
</button>
                     <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrFSp2'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrFSp2' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrFSp2'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrFSp2'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>


<!-- Modal -->
<div class="modal fade" id="exampleModalF2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelF2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrFSp2">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
                </td>
            </tr>
               <tr>
           <td>23.06.18</td> 
             <td>17:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Südkorea </td>
                <td>Mexiko</td>
                 
            
            <td>
                
                
<form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalF3">
  Tippabgabe
</button>
     <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrFSp3'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrFSp3' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrFSp3'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrFSp3'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>


<!-- Modal -->
<div class="modal fade" id="exampleModalF3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelF3" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelF3">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrFSp3">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
    </td>
            </tr>       
                
                
               <tr>
           <td>23.06.18</td> 
             <td>20:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Deutschland</td>
                <td>Schweden</td>
                 
            
            <td>
                
                
                <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalF4">
  Tippabgabe
</button>
                     <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrFSp4'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrFSp4' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrFSp4'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrFSp4'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>


<!-- Modal -->
<div class="modal fade" id="exampleModalF4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelF4" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelF4">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrFSp4">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
    </td>
            </tr>
               <tr>
           <td>27.06.18</td> 
             <td>16:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Mexiko</td>
                <td>Schweden</td>
             
                 
            
            <td>
                
                
                <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalF5">
  Tippabgabe
</button>
 <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrFSp5'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrFSp5' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrFSp5'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrFSp5'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>

<!-- Modal -->
<div class="modal fade" id="exampleModalF5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelF5" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelF5">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="F5">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
    </td>
            </tr>            
               <tr>
           <td>27.06.18</td> 
             <td>16:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Südkorea</td>
                <td>Deutschland</td>
                
                
                
                
                 <td>
                
                
                <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalF6">
  Tippabgabe
</button>
                     <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrFSp6'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrFSp6' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrFSp6'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrFSp6'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>


<!-- Modal -->
<div class="modal fade" id="exampleModalF6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelF6" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelF6">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrFSp6">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
   
    </td>
            </tr>
                </table>        
            </div>
                
                
                
        
                
      
        <!----------------- Gruppe G-------------------------->        
    <div class="col-lg-6 col-xs-4 alert-info">
        <table class="table table-hover">
                          
        <tr>
           <th>Gruppe G</th>    
        </tr>
            <tr>
           <td>18.06.18</td> 
             <td>17:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Belgien </td>
                <td>Panama</td>
                 
            
            <td>
                
                
                <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalG1">
  Tippabgabe
</button>
                     <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrGSp1'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrGSp1' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrGSp1'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrGSp1'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>


<!-- Modal -->
<div class="modal fade" id="exampleModalG1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelG1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelG1">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrGSp1">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
    </td>
            </tr>       
      <tr>
           <td>18.06.18</td> 
             <td>20:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Tunesien</td>
                <td>England</td>
                 
            
            <td>
                
                
                <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalG2">
  Tippabgabe
</button>
                     <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrGSp2'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrGSp2' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrGSp2'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrGSp2'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>


<!-- Modal -->
<div class="modal fade" id="exampleModalG2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelG2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelG2">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrGSp2">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
                </td>
            </tr>
               <tr>
           <td>23.06.18</td> 
             <td>14:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Belgien </td>
                <td>Tunesien</td>
                 
            
            <td>
                
                
<form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalG3">
                        
  Tippabgabe
</button>
    
     <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrGSp3'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrGSp3' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrGSp3'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrGSp3'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>


<!-- Modal -->
<div class="modal fade" id="exampleModalG3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelG3" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelG3">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrGSp3">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
    </td>
            </tr>       
                
                
               <tr>
           <td>24.06.18</td> 
             <td>14:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>England </td>
                <td>Panama</td>
                 
            
            <td>
                
                
                <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalG4">
  Tippabgabe
</button>
                     <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrGSp4'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrGSp4' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrGSp4'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrGSp4'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>


<!-- Modal -->
<div class="modal fade" id="exampleModalG4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelG4" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelG4">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrGSp4">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
    </td>
            </tr>
               <tr>
           <td>28.06.18</td> 
             <td>20:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>England</td>
                <td>Belgien </td>
             
                 
            
            <td>
                
                
                <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalG5">
  Tippabgabe
</button>
                    
     <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrGSp5'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrGSp5' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrGSp5'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrGSp5'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>
                

<!-- Modal -->
<div class="modal fade" id="exampleModalG5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelG5" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelG5">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrGSp5">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
    </td>
            </tr>            
               <tr>
           <td>28.06.18</td> 
             <td>20:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Panama</td>
                <td>Tunesien</td>
                
                
                
                
                 <td>
                
                
                <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalG6">
  Tippabgabe
</button>
                    
                    
     <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrGSp6'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrGSp6' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrGSp6'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrGSp6'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>
                

<!-- Modal -->
<div class="modal fade" id="exampleModalG6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelG6" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrGSp6">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
   
    </td>
            </tr>
                </table>        
            </div>
                
                
                
        
                
      
        <!---------------- Gruppe H----------------------->        
    <div class="col-lg-6 col-xs-4 alert-info">
        <table class="table table-hover">
                          
        <tr>
           <th>Gruppe H</th>    
        </tr>
            <tr>
           <td>19.06.18</td> 
             <td>14:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Kolumbien</td>
                <td>Japan</td>
                 
            
            <td>
                
                
                <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalH1">
  Tippabgabe
</button>
                     <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrHSp1'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrHSp1' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrHSp1'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrHSp1'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>


<!-- Modal -->
<div class="modal fade" id="exampleModalH1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelH1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelH1">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrHSp1">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
    </td>
            </tr>       
      <tr>
           <td>19.06.18</td> 
             <td>17:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Polen</td>
                <td>Senegal</td>
                 
            
            <td>
                
                
                <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalH2">
  Tippabgabe
</button>
                     <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrHSp2'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrHSp2' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrHSp2'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrHSp2'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>


<!-- Modal -->
<div class="modal fade" id="exampleModalH2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelH2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelH2">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrHSp2">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
                </td>
            </tr>
               <tr>
           <td>24.06.18</td> 
             <td>17:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Japan</td>
                <td>Senegal</td>
                 
            
            <td>
                
                
<form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalH3">
  Tippabgabe
</button>
    
     <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrHSp3'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrHSp3' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrHSp3'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrHSp3'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>


<!-- Modal -->
<div class="modal fade" id="exampleModalH3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelH3" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelH3">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrHSp3">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
    </td>
            </tr>       
                
                
               <tr>
           <td>24.06.18</td> 
             <td>20:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Polen</td>
                <td>Kolumbien</td>
                 
            
            <td>
                
                
                <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalH4">
  Tippabgabe
</button>
                    
 <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrHSp4'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrHSp4' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrHSp4'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrHSp4'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>
                    

<!-- Modal -->
<div class="modal fade" id="exampleModalH4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelH4" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelH4">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrHSp4">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
    </td>
            </tr>
               <tr>
           <td>28.06.18</td> 
             <td>16:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Senegal</td>
                <td>Kolumbien</td>
             
                 
            
            <td>
                
                
                <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalH5">
  Tippabgabe
</button>
                     <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrHSp5'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrHSp5' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrHSp5'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrHSp5'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>


<!-- Modal -->
<div class="modal fade" id="exampleModalH5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelH5" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelH5">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrHSp5">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
    </td>
            </tr>            
               <tr>
           <td>28.06.18</td> 
             <td>16:00 Uhr</td>
                 
        </tr>
            <tr>
                <td>Japan</td>
                <td>Polen</td>
                
                
                
                
                 <td>
                
                
                <form action="tippeingabe.php" method="post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalH6">
  Tippabgabe
</button>
                     <?php
            
    $sqlTipp= "SELECT * FROM tipps WHERE BenutzerID='$id' AND spielID='GrHSp6'";
    
    $db_tippAbfrage = $db_link->query($sqlTipp);
    
        
    while($db_ergTipps = $db_tippAbfrage->fetch_assoc()){
                $tippHeim = $db_ergTipps['TippHeim'];
                $tippGast = $db_ergTipps['TippGast'];
            };
        
        
    $sqlCheck = "SELECT * FROM tipps WHERE spielID='GrHSp6' AND BenutzerID='$id'";
    
    
    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    
    if($resultCheck > 0){
    
    echo "<br>Tipp: ";
    echo $tippHeim;
    echo " : ";
    echo $tippGast;
        
    }else{
        
    }
    
    $sqlErgebnis = "SELECT * FROM spielergebnis WHERE begegnungID='GrHSp6'";
        
    $db_ErgebnisAbfrage = $db_link->query($sqlErgebnis);
    
    while($db_ergErgebnis = $db_ErgebnisAbfrage->fetch_assoc()){
                $ergHeim = $db_ergErgebnis['heimTore'];
                $ergGast = $db_ergErgebnis['gastTore'];
            };
        
    $sqlCheckErg = "SELECT * FROM spielergebnis WHERE begegnungID='GrHSp6'";
        
    $resultErg = mysqli_query($db_link, $sqlCheckErg);
    $resultCheckErg = mysqli_num_rows($resultErg);
        
    if($resultCheckErg > 0){
        echo "<br>Ergebnis: ";
        echo $ergHeim;
        echo " : ";
        echo $ergGast; 
    }
?>


<!-- Modal -->
<div class="modal fade" id="exampleModalH6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelH6" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelH6">Heim : Gast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="number" min="0" max="99" step="1" placeholder="0" name="Heim"> :
          <input type="number" min="0" max="99" step="1" placeholder="0" name="Gast">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn btn-primary" name="Spiel" value="GrHSp6">Ergebnis speichern</button>
      </div>
       
    </div>
  </div>
</div>
    </form>
   
    </td>
            </tr>
                </table>        
            </div>
        
        
        
        
    
    </div>
    </div>
    </div>
       
    </div> 
    <script>
    
    var reg = document.getElementById("Regeln").addEventListener("click", function(){
    alert("Willkommen bei diesem Tippspiel zur Fußball Weltmeisterschaft 2018\n\n Klicken Sie jewails auf die Buttons mit der Aufschrift 'Tipp abngeben' um eine Tipp für die Partie abzugeben. Für einen richtigen Tipp Bekommen Sie in der Gruppenphase 4 Punkte und bei einer richtigen Tendenz 2 Punkte. In die KO-Runden erhöhen sich die Punkte in beiden Kategorien jeweils um 2 Punkte pro aufsteigende Stufe.\n Viel Spaß beim Tippen");
});
    </script>
</body>
</html>