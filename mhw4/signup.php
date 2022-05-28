<?php

include 'infodb.php';
include 'auth.php';

//verifico se è stata già fatta l'autenticazione
if (checkAuthentication()) {
    header("Location: home.php");
    exit;
}  

if ( !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password_1']) && !empty($_POST['password_2'])) {

        $conn = mysqli_connect($infodb['host'],$infodb['user'],$infodb['password'],$infodb['name']) or die(mysqli_error($conn));

        $errors = array();

        //validazione username 
        if (!preg_match('/^[a-zA-Z0-9_]{1,16}$/', $_POST['username'])){
            $errors[] = "username non valido";
        }else {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $q_username = "SELECT username FROM users WHERE username = '$username' ";
            $res = mysqli_query($conn, $q_username);

            if (mysqli_num_rows($res) > 0){
                $errors[] = "username già utilizzato";
            }
        }

        //validazione email
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $errors[] = "email non valida"; 
        }else {
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $res = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email' ");
            if(mysqli_num_rows($res) > 0){
                $errors[] = 'email già utilizzata';
            }
        }

        //validazione password
        if ($_POST['password_1'] < 8 ){
            $errors[] = "password debole";
        }
        if (strcmp($_POST['password_1'], $_POST['password_2']) != 0){
            $errors[] = "password diverse";
        }
        
        //registrazione nel db
        if (count($errors) == 0){
            $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);
            // criptiamo la password
            //$password = password_hash($password_2, PASSWORD_BCRYPT);
            

            $query = "INSERT INTO users (username, password, email) VALUES('$username', '$password_2', '$email')";
            if (mysqli_query($conn, $query)){
                //dichiarimao una variabile di sessione con il nome dell'utente
                $_SESSION['session_usr'] = $_POST['username'];
                //dichiarimao una variabile di sessione con l'id univoco dell'utente che proviene dalla tabella
                $_SESSION['usr_id'] = mysqli_insert_id($conn);
                mysqli_close($conn);
                header("Location: home.php");
                exit;
            }else {
                $errors[] = "errore di connessione al database";
            }
        }
        mysqli_close($conn);
    }
    else if (isset($_POST["username"])) {
        $errors[] = 'Riempire tutti i campi';
    }

    if (isset($errors)){
        foreach ($errors as $e){
            echo "<div> $e </div>";
        }
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
        <script src="signup.js" defer="true"></script>
    </head>
    <body>
    <header>
        <div id ="overlay"></div>
        <nav>
            <div class="logo">
                Space <br>in <br>Internet
            </div>
            <div class="links">
                <a href="home.php">HOME</a>
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
            <div id='input_username' class='input'>
                <div class='input_1'>
                    <label>Username</label>
                    <input type="text" name="username" required/>
                </div>
                <div class="div_error">
                    <span></span>
                </div>
            </div>
            <div id="input_email" class='input'>
                <div class="input_1">
                    <label>email</label>
                    <input type="text" name="email" required/>
                </div>
                <div class="div_error">
                    <span></span>
                </div>
            </div>
            <div id="input_password_1" class='input'>
                <div class="input_1">
                    <label>Password</label>
                    <input type="password" name="password_1" required/>
                </div>
                <div class="div_error">
                    <span></span>
                </div>
            </div>
            <div id="input_password_2" class='input'>
                <div class="input_1">
                    <label>Password</label>
                    <input type="password" name="password_2" required/>
                </div>
                <div class="div_error">
                    <span></span>
                </div>
            </div>
            <div class='input'>
                <div class="submit input_1">
                <input id="registrati" type='submit' value="Sign-up" disabled="true"/>
                </div>
            </div>
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