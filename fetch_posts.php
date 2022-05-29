<?php
/* ritorna i post presenti nel database e verica a quali post l'utente 
    loggato ha messo like */

    include "auth.php";
    include "infodb.php";

    if (! $user_id = checkAuthentication()) exit;

    $conn = mysqli_connect($infodb['host'],$infodb['user'],$infodb['password'],$infodb['name']) or die(mysqli_error($conn));

    $user_id = mysqli_real_escape_string($conn, $_SESSION['usr_id']);

    $query = "SELECT * FROM posts p join users u on p.userid = u.id order by p.postid desc";

    $res = mysqli_query($conn, $query); 

    $a_post = array();
    while($r = mysqli_fetch_object($res)) {
        // verifica like user
        $v_query = "SELECT * FROM likes where id_user = '$user_id' and post_id =  '$r->postid'";
        $out = mysqli_query($conn, $v_query);
        if (mysqli_num_rows($out) > 0){
            $verify = true;
        }else{
            $verify = false;
        }

        $a_post[] = array(
            'verify' => $verify,
            'post_id' => $r->postid, 
            'username' => $r->username, 
            'like' => $r->likes, 
            'content' => json_decode($r->content)
        );
    }
    echo json_encode($a_post);

    mysqli_close($conn);   
?>