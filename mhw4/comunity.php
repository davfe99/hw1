<?php 

    include 'auth.php';

//verifico se è stata già fatta l'autenticazione
/* if (checkAuthentication()) {
    header("Location: home.php");
    exit;
}   */
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
        <script src="comunity.js" defer="true"></script>
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
    <section class="box">
        <em class="log">
            <?php if($_SESSION['session_usr']) echo('Logged with :  ' .$_SESSION['session_usr']); ?>
        </em>
    </section>
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