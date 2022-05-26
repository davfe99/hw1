<?php
    switch($_GET['type']) {
        case 'nasa': nasa(); break;
        case 'gif': gif(); break;
        default: break;
    }
    
    function nasa(){
    # Creo il CURL handle per l'URL selezionato
    $ch = curl_init($_GET['url']);
    # Setto che voglio ritornato il valore, anziché un boolean (default)
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    # Eseguo la richiesta all'URL
    $data = curl_exec($ch);
    # Libero le risorse
    curl_close($ch);
    # Ritorno il json
    echo ($data);
    }

    function gif(){
        
    }
?>