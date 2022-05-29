<?php 
// Controllo che la mail sia unica

    include 'infodb.php';

    $conn = mysqli_connect($infodb['host'], $infodb['user'], $infodb['password'], $infodb['name']);

    $email = mysqli_real_escape_string($conn, $_GET["q"]);

    $query = "SELECT email FROM users WHERE email = '$email' ";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

//controllo tramite operatore ternario: dichiarazione riempimento e verifica
    echo json_encode (array('exists' => mysqli_num_rows($res) > 0 ? true : false));

    mysqli_close($conn);
?>