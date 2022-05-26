<?php
    include "auth.php";
    include "infodb.php";

    if (!$user_id = checkAuthentication()) exit;

    $conn = mysqli_connect($infodb['host'],$infodb['user'],$infodb['password'],$infodb['name']) or die(mysqli_error($conn));

    $img = mysqli_real_escape_string($conn, $_POST['src']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);

//  fare controllo per verificare se è presente la descrizione, per non caricarla vuota
    $query = "INSERT INTO posts(user_id, content) VALUES('$user_id', JSON_OBJECT('url','$img','comment','$comment'))";

    mysqli_query($conn, $query);
    
    echo json_encode(array('ok' => true, 'altro' => $_POST['src']));

    mysqli_close($conn);   
?>