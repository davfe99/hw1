<?php

//Controlla che l'utente sia già autenticato       
    include 'infodb.php';

    session_start();

    function checkAuthentication() {
        // Se esiste già una sessione, la ritorno 
        if (isset($_SESSION['session_usr'])) {
            return $_SESSION['session_usr'];
        } else 
            return 0;
    }
?>