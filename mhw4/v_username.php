<?php 
// Controllo che l'username sia unico

    include 'infodb.php';

    $conn = mysqli_connect($infodb['host'], $infodb['user'], $infodb['password'], $infodb['name']);

    $username = mysqli_real_escape_string($conn, $_GET["q"]);

    $query = "SELECT username FROM users WHERE username = '$username' ";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

//controllo tramite operatore ternario: dichiarazione riempimento e verifica
    echo json_encode (array('exists' => mysqli_num_rows($res) > 0 ? true : false));

    mysqli_close($conn);
?>