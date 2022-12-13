<?php

    $serverName = "127.0.0.1";
    $userName = "matte";
    $password = "matte";
    $dbName = "Biblioteca";

    // Connessione
    $link = mysqli_connect($serverName, $userName, $password, $dbName);
    // Check
    if (!$link){
        echo "Si è verificato un errore: Non riesco a collegarmi al database <br/>";
        echo "Codice errorte: " . mysqli_connect_errno() . "<br/>";
        echo "Messaggio errore: " . mysqli_connect_error() . "<br/>";
        exit(-1);
    }

?>

