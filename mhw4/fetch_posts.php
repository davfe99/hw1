<?php
/* ritorna i post presenti nel database  */

    include "auth.php";
    include "infodb.php";

    if (!checkAuthentication()) exit;

    $conn = mysqli_connect($infodb['host'],$infodb['user'],$infodb['password'],$infodb['name']) or die(mysqli_error($conn));

    $query = "SELECT * FROM posts p join users u on p.user_id = u.user_id order by p.post_id desc";

    $res = mysqli_query($conn, $query); 

    $a_post = array();
    while($r = mysqli_fetch_object($res)) {
        $a_post[] = array('post_id' => $r->post_id, 'username' => $r->username, 'like' => $r->likes, 'content' => json_decode($r->content));
    }
    echo json_encode($a_post);

    mysqli_close($conn);   
?>