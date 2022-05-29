<?php
    include "auth.php";
    include "infodb.php";

    if (!checkAuthentication()) exit; 

    $conn = mysqli_connect($infodb['host'],$infodb['user'],$infodb['password'],$infodb['name']);

    $img = mysqli_real_escape_string($conn, $_POST['src']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $id_user = mysqli_real_escape_string($conn, $_SESSION['usr_id']);
    $query = "INSERT INTO posts(userid,likes,content) VALUES('$id_user',0, JSON_OBJECT('url','$img','comment','$comment'))";
    mysqli_query($conn, $query);

    mysqli_close($conn);   
?>