<!doctype html>
<html lang="de">
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="stylesheetFred.css">
        
        <!--<meta charset="UTF-8">-->
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
	</head>
	<title>
		Mein Profil
	</title>
	<body>
        <?php
            session_start();
            $benutzername = $_SESSION['Name'];
            
            //Hier wird der Datenbankzugriff hergestellt mit einem Verweis auf eine ausgelagerte php Datei.
            require_once 'database_connect.php';
        
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
                $nationalitaet = $db_erg['Team'];
                $tippScore = $db_erg['Score'];
            };
        
        if($avatar == ''){
            $bildPfad = "userAvatar/default.jpg";
            $sqlUpdatePic = "UPDATE benutzer SET Avatar='$bildPfad' WHERE BenutzerID='$id'";
            //Befehl für das Hinzufügen des Bildes zur Datenbank.
            if (!$db_link->query( $sqlUpdatePic)){

                die(mysql_error());
            }
        }
        ////////////////////////////////////////////////////AVATAR AUSWAHL///////////////////////////////////////////////////////
        //Wenn ein Bild ausgewählt wurde zum Hochladen dann gehe in den if - Zweig
        if (array_key_exists('img',$_FILES)) {
            
            $bildname = $_FILES['img']['name'];
            $tmpname = $_FILES['img']['tmp_name'];
            $size = getimagesize($tmpname);
            //echo "'$size[0], '$size[1]'";

            $type = $_FILES['img']['type'];
            
            //Je nachdem welcher Dateityp das Bild ist wird hier die Endung zum Pfad hinzugefügt.
            if($type == 'image/jpeg'){
                $bildTyp = "jpeg";
                $bildname = "$id.$bildTyp";
            }
            
            if($type == 'image/png'){
                $bildTyp = "png";
                $bildname = "$id.$bildTyp";
            }
            
            //echo $bildname;
            
            //Prüfung ob es sich auch um eine Bilddatei handelt.
            if(!($type == 'image/jpeg' OR $type == 'image/png')){
                
                echo "<br>Der Dateityp ist nicht zulässig<br>";
                
            }else if($size[0] > 300 OR $size[1] > 300 ){
                
                echo "<script type='text/javascript'>alert('Das Bild ist zu groß. Max: 300x300px!');</script>";
                
            }else{
                
                //Wenn der Benutzer schon einen Avatar hochgeladen hat, dann ändere das Bild.
                
                    //echo "Bild wurde aktualisiert";
                    
                    $bildPfad = "userAvatar/".$bildname;
                    move_uploaded_file($tmpname, $bildPfad);
                    
                    $sqlUpdatePic = "UPDATE benutzer SET Avatar='$bildPfad' WHERE BenutzerID='$id'";
                    //Befehl für das Hinzufügen des Bildes zur Datenbank.
                    if (!$db_link->query( $sqlUpdatePic)){

                        die(mysql_error());
                    }
                }
            }
        
        ///////////////////////////////////////NATIONALITÄT AUSWAHL////////////////////////////////////////////
        
        $landArray = array(
            'Ägypten' => 'Ägypten',
            'Argentinien' => 'Argentinien',
            'Australien' => 'Australien',
            'Belgien' => 'Belgien',
            'Brasilien' => 'Brasilien',
            'Costa Rica'=> 'Costa Rica',
            'Dänemark' => 'Dänemark',
            'Deutschland' => 'Deutschland',
            'England' => 'England',
            'Frankreich' => 'Frankreich',
            'Iran' => 'Iran',
            'Island' => 'Island',
            'Japan' => 'Japan',
            'Kolumbien' => 'Kolumbien',
            'Kroatien' => 'Kroatien',
            'Marokko' => 'Marokko',
            'Mexiko' => 'Mexiko',
            'Nigeria' => 'Nigeria',
            'Panama' => 'Panama',
            'Peru' => 'Peru',
            'Polen' => 'Polen',
            'Portugal' => 'Portugal',
            'Russland' => 'Russland',
            'Saudi-Arabien' => 'Saudi-Arabien',
            'Schweden' => 'Schweden',
            'Schweiz' => 'Schweiz',
            'Senegal' => 'Senegal',
            'Serbien' => 'Serbien',
            'Spanien' => 'Spanien',
            'Südkorea' => 'Südkorea',
            'Tunesien' => 'Tunesien',
            'Uruguay' => 'Uruguay',
        );
            
        if(isset($_POST['nationalitaet'])){
            $land = $_POST['nationalitaet'];
            //echo $land;
            $sqlLand = "UPDATE benutzer SET Team='$land' WHERE BenutzerID='$id'";
            
            $db_link->query($sqlLand);
        }else{
            $land = $nationalitaet;
        }

        ?>
        
        <div class="container-fluid">
     <div class="row">
    <div class="col-xs-12"> 
        
<div class="card text-center">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link active" href="inhalt2.0.php">Home</a>
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
        <h1>Profil verwalten</h1>
        </div>    
         </div>
     </div>
    </div>
		<div class="container">
			<div class="row align-items-center alert-success">
				<div class="col-lg-4 col-sm-12 avatar">
                    <div class="row justify-content-center">
                        <div class="col-lg-12 col-sm-12 text-md-center avatarDiv">
                            <?php
                                echo "<img src='".$avatar."'>";
                            ?>
                            <br><br>
					   </div>
                    </div>
                    <div class="row justify-content-center">
                        <!--Das bei action bewirkt, dass die aktuelle Seite selbst wieder aufgerufen wird-->
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                            <!--<div class="row justify-content-center">
                                <div class="col-lg-6 col-sm-12">
                                    <label class="btn btn-secondary">
                                        Durchsuchen... <input type="file" name="img" hidden>
                                    </label>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <label class="btn btn-secondary">
                                        Hochladen <input type="submit" name="submit" value="Hochladen" hidden>
                                    </label>
                                </div>
                            </div>-->
                            <label class="btn btn-secondary">
                                Durchsuchen... <input type="file" name="img" hidden>
                            </label>
                            <!--<input type="file" name="img" class="btn btn-primary"><br><br>-->
                            <label class="btn btn-secondary">
                                Hochladen <input type="submit" name="submit" value="Hochladen" hidden>
                            </label>
                        </form>
                    </div>
				</div>
				<div class="col-lg-8 col-sm-12 profilInfo alert-success">
					<div class="userDetail">
                        <div class="row">
                            <div class="col-lg-2 offset-lg-9 col-sm-12">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                  Bearbeiten
                                </button><p></p>
                                
                                <!-- Modal -->
                                <div class="modal fade modalDiv" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title modalDiv" id="exampleModalLabel">Profil Bearbeiten</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                    <form action="profilBearbeiten.php" method="post">    
                                      <div class="modal-body">
                                        <!--<form action="profilBearbeiten.php" method="post">-->
                                            <div class="row">
                                                <div class="col-lg-5 offset-lg-1 col-sm-12">
                                                    Benutzername:
                                                </div>
                                                <div class="col-lg-4 col-sm-12">
                                                    <input type="text" name="neuBenutzername">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-5 offset-lg-1 col-sm-12">
                                                   Alter: 
                                                </div>
                                                <div class="col-lg-4 col-sm-12">
                                                    <input type="number" name="neuAlter">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-5 offset-lg-1 col-sm-12">
                                                   E-Mail:
                                                </div>
                                                <div class="col-lg-4 col-sm-12">
                                                    <input type="email" name="neuEmail">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-5 offset-lg-1 col-sm-12">
                                                   aktuelles Passwort: 
                                                </div>
                                                <div class="col-lg-4 col-sm-12">
                                                    <input type="password" name="aktuellesPasswort" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-5 offset-lg-1 col-sm-12">
                                                   neues Passwort:
                                                </div>
                                                <div class="col-lg-4 col-sm-12">
                                                    <input type="password" name="neuPasswort1">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-5 offset-lg-1 col-sm-12">
                                                   Passwort wiederholen:
                                                </div>
                                                <div class="col-lg-4 col-sm-12">
                                                    <input type="password" name="neuPasswort2">
                                                </div>
                                            </div>
                                        <!--</form>-->
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Speichern</button>
                                      </div>
                                    </form>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
					</div>
                    <div class="userDetail">
                        <div class="row">
                            <div class="col-lg-3 col-sm-12">
                                <h5>Name:</h5>
                            </div>
                            <div class="col-lg-7">
                                <?php
                                echo $name;
                                ?>
                            </div>
                        </div>
					</div>
					<div class="userDetail">
                        <div class="row">
                            <div class="col-lg-3 col-sm-12">
                                <h5>Alter:</h5>	
                            </div>
                            <div class="col">
                                <?php
                                   echo $alter;
                                ?>
                            </div>
                        </div>
					</div>
					<div class="userDetail">
                        <div class="row">
                            <div class="col-lg-3 col-sm-12">
                                <h5>Email Adresse:</h5>    
                            </div>
                            <div class="col">
                                <?php
                                echo $email;
                                ?>
                            </div>
                        </div>
					</div>
					<div class="userDetail">
						<h5>Team:</h5>
						<!--<p>
							<img src="imgs/flags/'".$land."'.png" alt="egypt" />
						</p>-->
                        <div class="row">
                            <div class="col-lg-3 col-sm-12">
                                <form id="landwahl" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                    <select name="nationalitaet" onchange="landwahlSubmit()">
                                    <?php foreach( $landArray as $var => $landArray ): ?>
                                        <option value="<?php echo $var ?>"<?php if( $var == $land ): ?> selected="selected"<?php endif; ?>><?php echo $landArray ?></option>
                                    <?php endforeach; ?>  
                                    </select>
                                </form>
                            </div>
                            <div class="col">
                                <p>
                                <?php
                                    echo "<img src='Bilder/flags/".$land.".png'>";
                                ?>
                                </p>
                            </div>
                        </div>
					</div>
                    <div class="userDetail">
                        <div class="row">
                            <div class="col-lg-3 col-sm-12">
                                <h5>Tipp Score:</h5>
                            </div>
                            <div class="col">
                                <?php
                                echo $tippScore;
                                ?>
                            </div>
                        </div>
					</div>
				</div>
			</div><br>
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <h5>Wett Punkte</h5>
                </div>
                <div class="col-lg-12 col-sm-12">
                    <canvas id="myCanvas"></canvas>
                    <?php
                        echo "<script type='text/javascript' src='WMTipperJS.js'></script>";
                    ?>
                </div>
            </div>
		</div>
            <?php 
                /////////////////////////////////Funktioniert noch nicht richtig////////////////////////////
                if(!isset($_GET['errCode'])){
                    exit;
                }else{
                    $empfangeneErr = $_GET['errCode'];

                    if($empfangeneErr == 1 OR $empfangeneErr == 2){
                        echo "<script type='text/javascript'>alert('Bitte beide Felder ausfüllen!');</script>";
                    }    
                    if($empfangeneErr == 3){
                        echo "<script type='text/javascript'>alert('Keine Änderung am Passwort.');</script>";
                    }
                }
        
            ?>
        <script>
    
    var reg = document.getElementById("Regeln").addEventListener("click", function(){
    alert("Willkommen bei diesem Tippspiel zur Fußball Weltmeisterschaft 2018\n\n Klicken Sie jewails auf die Buttons mit der Aufschrift 'Tipp abngeben' um eine Tipp für die Partie abzugeben. Für einen richtigen Tipp Bekommen Sie in der Gruppenphase 4 Punkte und bei einer richtigen Tendenz 2 Punkte. In die KO-Runden erhöhen sich die Punkte in beiden Kategorien jeweils um 2 Punkte pro aufsteigende Stufe.\n Viel Spaß beim Tippen");
});
    </script>
	</body>
</html>