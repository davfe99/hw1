<?php 
    /*
        aggiunge un like al post per l'utente loggato solo se non lo ha già messo in quel post
    */

    include 'infodb.php';

    //se non sei loggato non potrai mettere like --> exit
    include 'auth.php';
    if (!$user_id = checkAuthentication()) exit;

    $conn = mysqli_connect($infodb['host'], $infodb['user'], $infodb['password'], $infodb['name']);
//                                              user_id preso dal return di cheackautentication
    $user_id = mysqli_real_escape_string($conn, $user_id);

    $post_id = mysqli_real_escape_string($conn, $_GET["post_id"]);

    // query per verificare se esiste già questa copppia di valori
    $in_query = "INSERT INTO likes(user_id, post_id) VALUES($user_id, $post_id)";
    // attivazione trigger se l'inserimento è andato a buon fine
    
    // salvo il risultato della query di verifica
    $res = mysqli_query($conn, $in_query) or die (mysqli_error($conn));
    
    //  solo se il ris dell'inserimento è true aggiorno il num di like del post
    if ($res) {
        
        // Prendo il nuovo numero di like
        $out_query = "SELECT likes FROM posts WHERE post_id = $post_id";
        $res = mysqli_query($conn, $out_query);
    
        if (mysqli_num_rows($res) > 0) {
            
            $entry = mysqli_fetch_assoc($res);

            $return_data = array('ok' => true, 'likes' => $entry['likes']);

            echo json_encode($return_data);

            mysqli_close($conn);

            exit;
        }
    }
    mysqli_close($conn);
    echo json_encode(array('ok' => false));
?>