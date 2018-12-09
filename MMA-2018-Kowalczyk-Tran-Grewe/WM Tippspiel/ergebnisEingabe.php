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
    
    $sqlCheck = "SELECT * FROM spielergebnis WHERE begegnungID='$spiel'";

    $sqlCheck2 = "SELECT * FROM begegnungen WHERE begegnungID='$spiel'";
    
    $db_win = $db_link->query($sqlCheck2);

    $teilnehmer = array();

    while($db_ergWin = $db_win->fetch_assoc()){
        
        array_push($teilnehmer, $db_ergWin['landName'], $db_ergWin['rolle']);
    }

    echo sizeof($teilnehmer);

    $HeimTeam = $teilnehmer[0];
    $GastTeam = $teilnehmer[2];

    echo $HeimTeam;
    echo $GastTeam;
    

    $result = mysqli_query($db_link, $sqlCheck);
    $resultCheck = mysqli_num_rows($result);
    
    echo "$resultCheck";
    
    if($resultCheck > 0){
        
        $sql = "UPDATE spielergebnis SET heimTore = '$heim', gastTore ='$gast' WHERE begegnungID='$spiel'";
        
        $results = mysqli_query($db_link, $sql);
        
        /*$sqlAbfrageBenutzerTipps = "SELECT * FROM tipps WHERE spielID = '$spiel'";
        
        $db_benutzerTipp = $db_link->query($sqlAbfrageBenutzerTipps);
        
        while($db_allBenutzerTipps = $db_benutzerTipp->fetch_assoc()){
            $benutzer = $db_allBenutzerTipps['BenutzerID'];
            $tippHeim = $db_allBenutzerTipps['TippHeim'];
            $tippGast = $db_allBenutzerTipps['TippGast'];
            $tippID = $db_allBenutzerTipps['TippID'];
            
            if($tippHeim == $heim && $tippGast == $gast){
                $sqlScoreVergabe = "SELECT * FROM benutzer WHERE BenutzerID='$benutzer'";
                
                $db_getScores = $db_link->query($sqlScoreVergabe);
                
                while($db_BenutzerScores = $db_getScores->fetch_assoc()){
                    $benutzerScore = $db_BenutzerScores['Score'];
                }
                
                $benutzerScore = $benutzerScore + 4;
                
                $sqlScoreUpdate = "UPDATE benutzer SET Score='$benutzerScore' WHERE BenutzerID='$benutzer'";
                
                $db_link->query($sqlScoreUpdate);
            }
        }*/
        
        
    }
    
    else{
        /////////////////////////////////Punkte Vergabe/////////////////////
        if($heim > $gast){
            
            /*bekommt team heim einen Sieg 
                und team Gast eine Niederlage*/
                
            $sqlGetWin = "SELECT * FROM land WHERE landName='$HeimTeam'";
            
            
            $db_HeimWin = $db_link->query($sqlGetWin);
    
            while($db_HeimWins = $db_HeimWin->fetch_assoc()){
                $wins = $db_HeimWins['win'];
                $pkt = $db_HeimWins['punkte'];
                $remis = $db_HeimWins['remi'];
            }
            
            $wins = $wins + 1;
            echo $wins;
            
            $pkt = 3 * $wins + $remis;
            
            $sqlInsertPointWin = "UPDATE land SET punkte='$pkt' WHERE landName='$HeimTeam'";
            $sqlInsertWin = "UPDATE land SET win='$wins' WHERE landName='$HeimTeam'";
            $db_link->query($sqlInsertWin);
            $db_link->query($sqlInsertPointWin);
            
            $sqlGetLose = "SELECT * FROM land WHERE landName='$GastTeam'";
            
            $db_GastLose = $db_link->query($sqlGetLose);
    
            while($db_GastLoss = $db_GastLose->fetch_assoc()){
                $lose = $db_GastLoss['lose']; 
            }
            
            $lose = $lose + 1;
            
            $sqlInsertLose = "UPDATE land SET lose='$lose' WHERE landName='$GastTeam'";
            $db_link->query($sqlInsertLose);
        }
        
        if($heim < $gast){
            
          $sqlGetWin = "SELECT * FROM land WHERE landName='$GastTeam'";
            
            
            $db_GastWin = $db_link->query($sqlGetWin);
    
            while($db_GastWins = $db_GastWin->fetch_assoc()){
                $wins = $db_GastWins['win'];
                $pkt = $db_GastWins['punkte'];
                $remis = $db_GastWins['remi'];
            }
            
            $wins = $wins + 1;
            echo $wins;
            
            $pkt = 3 * $wins + $remis;
            
            $sqlInsertPointWin = "UPDATE land SET punkte='$pkt' WHERE landName='$GastTeam'";
            $sqlInsertWin = "UPDATE land SET win='$wins' WHERE landName='$GastTeam'";
            $db_link->query($sqlInsertWin);
            $db_link->query($sqlInsertPointWin);
            
            $sqlGetLose = "SELECT * FROM land WHERE landName='$HeimTeam'";
            
            $db_HeimLose = $db_link->query($sqlGetLose);
    
            while($db_HeimLoss = $db_HeimLose->fetch_assoc()){
                $lose = $db_HeimLoss['lose']; 
            }
            
            $lose = $lose + 1;
            
            $sqlInsertLose = "UPDATE land SET lose='$lose' WHERE landName='$HeimTeam'";
            $db_link->query($sqlInsertLose);  
        }
        
        if($heim == $gast){
            $sqlGetRemi = "SELECT * FROM land WHERE landName='$HeimTeam'";
            
            
            $db_HeimRemi = $db_link->query($sqlGetRemi);
    
            while($db_HeimRemis = $db_HeimRemi->fetch_assoc()){
                $remi = $db_HeimRemis['remi'];
                $pktHeim = $db_HeimRemis['punkte'];
                $wins = $db_HeimRemis['win'];
            }
            
            $remi = $remi + 1;
            echo $remi;
            
            $pktHeim = 3 * $wins + $remi;
            
            $sqlInsRemiPointHeim = "UPDATE land SET punkte='$pktHeim' WHERE landName='$HeimTeam'";
            $sqlInsertRemi = "UPDATE land SET remi='$remi' WHERE landName='$HeimTeam'";
            $db_link->query($sqlInsertRemi);
            $db_link->query($sqlInsRemiPointHeim);
            
            $sqlGetRemi = "SELECT * FROM land WHERE landName='$GastTeam'";
            
            $db_GastRemi = $db_link->query($sqlGetRemi);
    
            while($db_GastRemis = $db_GastRemi->fetch_assoc()){
                $remiGast = $db_GastRemis['remi']; 
                $pktGast = $db_GastRemis['punkte'];
                $winGast = $db_GastRemis['win'];
            }
            
            $remiGast = $remiGast + 1;
            
            $pktGast = 3 * $winGast + $remiGast;
            
            $sqlInsRemiPointGast = "UPDATE land SET punkte='$pktGast' WHERE landName='$GastTeam'";
            $sqlInsertRemiGast = "UPDATE land SET remi='$remiGast' WHERE landName='$GastTeam'";
            $db_link->query($sqlInsertRemiGast); 
            $db_link->query($sqlInsRemiPointGast);
            
        }
        
        
    $sql = "INSERT INTO spielergebnis(heimTore, gastTore, begegnungID) VALUES ('$heim', '$gast', '$spiel')";
    
    
    
    $results = mysqli_query($db_link, $sql);
    }
    
    ////////////////////////Score Vergabe//////////////////////////////
    $sqlAbfrageSpielArt = "SELECT * FROM partien WHERE spielID='$spiel'";

        $db_getSpielArt = $db_link->query($sqlAbfrageSpielArt);
        
        while($db_SpielArt = $db_getSpielArt->fetch_assoc()){
            $spielArt = $db_SpielArt['Art'];
        }

    $sqlAbfrageBenutzerTipps = "SELECT * FROM tipps WHERE spielID = '$spiel'";
        
        $db_benutzerTipp = $db_link->query($sqlAbfrageBenutzerTipps);
        
        while($db_allBenutzerTipps = $db_benutzerTipp->fetch_assoc()){
            $benutzer = $db_allBenutzerTipps['BenutzerID'];
            $tippHeim = $db_allBenutzerTipps['TippHeim'];
            $tippGast = $db_allBenutzerTipps['TippGast'];
            $tippID = $db_allBenutzerTipps['TippID'];
            
            if($tippHeim == $heim && $tippGast == $gast){
                $sqlScoreVergabe = "SELECT * FROM benutzer WHERE BenutzerID='$benutzer'";
                
                $db_getScores = $db_link->query($sqlScoreVergabe);
                
                while($db_BenutzerScores = $db_getScores->fetch_assoc()){
                    $benutzerScore = $db_BenutzerScores['Score'];
                }
                
                if($spielArt == 'Viertelfinale'){
                    $benutzerScore = $benutzerScore + 6;
                }else if($spielArt == 'Halbfinale'){
                    $benutzerScore = $benutzerScore + 8;
                }else if($spielArt == 'Finale'){
                    $benutzerScore = $benutzerScore + 10;
                }else{
                    $benutzerScore = $benutzerScore + 4;
                };
                
                $sqlScoreUpdate = "UPDATE benutzer SET Score='$benutzerScore' WHERE BenutzerID='$benutzer'";
                
                $db_link->query($sqlScoreUpdate);
            }
            
            if(($heim > $gast) && ($tippHeim > $tippGast) && ($tippHeim != $heim) && ($tippGast != $gast)){
                $sqlScoreVergabe = "SELECT * FROM benutzer WHERE BenutzerID='$benutzer'";
                
                $db_getScores = $db_link->query($sqlScoreVergabe);
                
                while($db_BenutzerScores = $db_getScores->fetch_assoc()){
                    $benutzerScore = $db_BenutzerScores['Score'];
                }
                
                if($spielArt == 'Viertelfinale'){
                    $benutzerScore = $benutzerScore + 4;
                }else if($spielArt == 'Halbfinale'){
                    $benutzerScore = $benutzerScore + 6;
                }else if($spielArt == 'Finale'){
                    $benutzerScore = $benutzerScore + 8;
                }else{
                    $benutzerScore = $benutzerScore + 2;
                };
                
                $sqlScoreUpdate = "UPDATE benutzer SET Score='$benutzerScore' WHERE BenutzerID='$benutzer'";
                
                $db_link->query($sqlScoreUpdate);   
            }
        }

    //header("Location: inhaltAdmin.php");
    //exit();

?>