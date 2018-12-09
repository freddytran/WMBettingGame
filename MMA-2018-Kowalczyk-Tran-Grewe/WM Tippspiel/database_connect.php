<?php
    error_reporting(E_ALL);
 
        // Konfiguration zur Aufbau der Verbindung zur Datenbank
        define ( 'MYSQL_HOST',      'localhost' );
        define ( 'MYSQL_BENUTZER',  'root' );
        define ( 'MYSQL_KENNWORT',  '' );
        define ( 'MYSQL_DATENBANK', 'wmtipper' );
            
        //Hier wird die Verbindung mit der Datenbank hergestellt.
        $db_link = mysqli_connect (MYSQL_HOST, 
                                   MYSQL_BENUTZER, 
                                   MYSQL_KENNWORT, 
                                   MYSQL_DATENBANK);
        
        mysqli_set_charset($db_link, 'utf8');

        if ( $db_link )
        {
            
        }
        else
        {
            // hier sollte dann später dem Programmierer eine
            // E-Mail mit dem Problem zukommen gelassen werden
            die('keine Verbindung möglich: ' . mysqli_error());
        }
?>