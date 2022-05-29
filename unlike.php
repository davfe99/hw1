<?php 
    include 'infodb.php';

    $conn = mysqli_connect($infodb['host'], $infodb['user'], $infodb['password'], $infodb['name']);
    $user_id = mysqli_real_escape_string($conn, $_SESSION['usr_id']);
    $post_id = mysqli_real_escape_string($conn, $_GET['post_id']);

    $query = "DELETE FROM likes WHERE id_user = '$user_id' AND post_id = '$post_id'";
    
    $res = mysqli_query($conn, $query) or die (mysqli_error($conn));
    
    if ($res) {
        
        $out_query = "SELECT likes FROM posts WHERE postid = '$post_id'";
        $res = mysqli_query($conn, $out_query);
    
        if (mysqli_num_rows($res) > 0) {
            
            $entry = mysqli_fetch_assoc($res);

            $return_data = array('var' => false, 'post_id' => $post_id, 'likes' => $entry['likes']);

            echo json_encode($return_data);

            mysqli_close($conn);

            exit;
        }
    }
    mysqli_close($conn);
    
?>