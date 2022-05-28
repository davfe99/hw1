<?php 

    include 'infodb.php';

    include 'auth.php';
    if (!$user_id = checkAuthentication()) exit;

    $conn = mysqli_connect($infodb['host'], $infodb['user'], $infodb['password'], $infodb['name']);

    $user_id = mysqli_real_escape_string($conn, $user_id);
    $post_id = mysqli_real_escape_string($conn, $_GET["post_id"]);

    // Elimino se presente
    $in_query = "DELETE FROM likes WHERE user = '$user_id' AND post = '$post_id'";
    // Si attiva il trigger che aggiorna il numero di likes
    
    $res = mysqli_query($conn, $in_query) or die (mysqli_error($conn));
    
    if ($res) {
        
        // Prendo il nuovo numero di likes
        $out_query = "SELECT likes FROM posts WHERE id = '$post_id'";

        $res = mysqli_query($conn, $out_query);

        if (mysqli_num_rows($res) > 0) {

            $entry = mysqli_fetch_assoc($res);

            $return_data [] = array('var' => false, 'post_id' => $post_id, 'likes' => $entry['likes']);

            echo json_encode($return_data);

            mysqli_close($conn);

            exit;
        }
    }

    mysqli_close($conn);
    echo json_encode(array('post_id' => $post_id));
?>