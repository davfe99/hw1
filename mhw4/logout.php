<?php
    include 'infodb.php';

    // Distruggo la sessione esistente
    session_start();
    session_destroy();

    header('Location: home.html');
?>