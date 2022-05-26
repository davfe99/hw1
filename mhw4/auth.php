<?php

//Controlla che l'utente sia già autenticato       
    include 'infodb.php';

    session_start();

    function checkAuthentication() {
        // Se esiste già una sessione, la ritorno 
        if (isset($_SESSION['usr_id'])) {
            return $_SESSION['usr_id'];
        } else 
            return 0;
    }
?>