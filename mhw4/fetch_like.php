<?php
/* verifica a quali post l'utente ha messo like */

    include "auth.php";
    include "infodb.php";

    if (! $user_id = checkAuthentication()) exit;

    $conn = mysqli_connect($infodb['host'],$infodb['user'],$infodb['password'],$infodb['name']) or die(mysqli_error($conn));

    $post_id = mysqli_real_escape_string($conn, $_GET['post_id']);
    $user_id = mysqli_real_escape_string($conn, $user_id);

    $query = "SELECT * FROM likes where user_id = $user_id and post_id =$post_id";

    $res = mysqli_query($conn, $query); 

    if (mysqli_num_rows($res) > 0) {
        $return_data = array('verify' => true);
    }else {
        $return_data = array('verify' => false);
    }
    echo json_encode($return_data);
    mysqli_close($conn);
?>