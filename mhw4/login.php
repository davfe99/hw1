<?php

include 'infodb.php';
include 'auth.php';

//verifico se è stata già fatta l'autenticazione
if (checkAuthentication()) {
    header("Location: home.html");
    exit;
}  

if (!empty($_POST['username']) && !empty($_POST['password'])) {

        $conn = mysqli_connect($infodb['host'],$infodb['user'],$infodb['password'],$infodb['name']) or die(mysqli_error($conn));

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        //cerca corrispondenza 
        $search_field = filter_var($username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        //recupero info dal db
        $query = "SELECT user_id, username, password FROM users WHERE $search_field = '$username' ";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

        if (mysqli_num_rows($res) > 0){
            $usr = mysqli_fetch_object($res);

            if ($password === $usr->password){
                // Imposto la sessione dell'utente se verificato
                $_SESSION["session_usr"] = $usr->username;
                $_SESSION["usr_id"] = $usr->user_id;
                header("Location: home.html");
                mysqli_free_result($res);
                mysqli_close($conn);
                exit;
            }
        }
    }
    else if (isset($_POST["username"]) || isset($_POST["password"])) {
        // solo uno dei due è impostato
        $error = "Inserisci username e password";
    }
?> 


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <title>Top ∞ universe</title>
        <link rel="stylesheet" href="mhw4.css"><link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@100&family=Inconsolata&family=Montserrat:wght@100;300&family=Source+Code+Pro:wght@600&display=swap" rel="stylesheet">
    </head>
    <body>
    <header>
        <div id ="overlay"></div>
        <nav>
            <div class="logo">
                Space <br>in <br>Internet
            </div>
            <div class="links">
                <a href="home.html">HOME</a>
                <a href="login.php"> LOGIN</a>
                <a href="logout.php"> LOGOUT</a>
                <a href="comunity.php">COMUNITY</a>
                <a class="button">MENÙ</a>
            </div>
        </nav>
        <h1 class="title">TOP UNIVERSE</h1>
    </header>
    
    <article>
        <form id="signup_form" name='signup' method='post'>
            <div class='input'>
                <div class='input_1'>
                    <label>username o <br> email</label>
                    <input type="text" name="username" required/>
                </div>
            </div>
            <div class='input'>
                <div class="input_1">
                    <label>password</label>
                    <input type="password" name="password" required/>
                </div>
                <div class="div_error">
                    <?php
                    // Verifica la presenza di errori
                    if (isset($error)) {
                        echo "<span class='text_error'>$error</span>";
                    }?>
                </div>
            </div>
            <div class='input'>
                <div class="submit input_1">
                <input id="registrati" type='submit' value="Login"/>
                </div>
            </div>
            <h3>
                <a href="signup.php">Sign-up</a>
            </h3>
        </form>
    </article>
    
    <footer>
        <p>
            Davide Ferro
        </p>
        <p>
            1000002097@studium.unict.it
        </p>
        <p>
            <span>GitHub: https://github.com/davfe99 ;</span>
            <span class="credit">
                Copyright©   01/04/2022
            </span>
        </p>
    </footer>
    </body>
    </html>


    