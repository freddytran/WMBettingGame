

<!DOCTYPE html>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>


        
<link rel="stylesheet" type="text/css"  href="styleInhalt.css"/>
        <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    
    </head>
<body style="height:1000px;">
    <div id="komplett">
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
        <a class="nav-link disabled" href="#">Profil</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Rangliste</a>
      </li>
        
           <li class="nav-item">
        <a class="nav-link disabled" href="benutzer.php">Benutzer</a>
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
        <h1>Benutzer verwalten</h1>
        </div>    
         </div>
     </div>
    </div>
    
    <div class="container-fluid">
    <?php 
    //session_start();
    
    require_once 'database_connect.php';
    $benutzername="Freddy";
    //Mit dieser SQL - Anfrage wird der Benutzer, der gerade angemeldet ist aus der Datenbank herausgefiltert.
            $sql = "SELECT * FROM benutzer";
            
            //Hier wird die SQL Anfrage an die Datenbank gesendet. Es wird ein Objekt zurückgegeben.
            $db_name = $db_link->query($sql);
        
            //Das zurückgegebene Objekt wird her verarbeitet und die einzelnen Daten werden Variablen zugeordnet.
            echo"<form action='löschen.php' method='post'>
                    <input type='text' name='löschen'>
                    <button type='submit'>Löschen</button>
                </form>";

            echo " <br><div class='container'>
    <div class='row'>
    <div class='col-lg-6 col-xs-4 offset-lg-3 alert-info'> <table>
                    <tr>
                        <th>BenutzerID</th>
                        <th>Benutzername</th>
                        <th>Alter</th>
                        <th>E-Mail</th>
                    </tr>";

            while($db_erg = $db_name->fetch_assoc()){
                $name = $db_erg['Name'];
                $alter = $db_erg['Alt'];
                $email = $db_erg['Mail'];
                $id = $db_erg['BenutzerID'];
                $avatar = $db_erg['Avatar'];
                
                echo "<tr>
                        <td>$id</td>
                        <td>$name</td>
                        <td>$alter</td>
                        <td>$email</td>
                    </tr>";
                
            };

            echo "</table>  </div> </div> </div>";
        

        
?>
        </div>
    </div>
    
       <script>
    
    var reg = document.getElementById("Regeln").addEventListener("click", function(){
    alert("Willkommen bei diesem Tippspiel zur Fußball Weltmeisterschaft 2018\n\n Klicken Sie jewails auf die Buttons mit der Aufschrift 'Tipp abngeben' um eine Tipp für die Partie abzugeben. Für einen richtigen Tipp Bekommen Sie in der Gruppenphase 4 Punkte und bei einer richtigen Tendenz 2 Punkte. In die KO-Runden erhöhen sich die Punkte in beiden Kategorien jeweils um 2 Punkte pro aufsteigende Stufe.\n Viel Spaß beim Tippen");
});
    </script>
</body>
</html>