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
    <script src="home.js" defer="true" ></script>
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
    <div id="block1">
        <img src="image/LightRoom-0454.jpg" height="90"/>
        <p>
            Davide Ferro
        </p>
        <em>
            Ultimo Aggiornamento:<br> 28 gen
        </em>
    </div>
    <section class="box">
        <em class="log">
            <?php if (isset($_SESSION['session_usr'])) echo('Logged with :  ' .$_SESSION['session_usr']); ?>
        </em>
        <div class="post">
            <h1><strong>Immagine astronomica del giorno : </strong></h1>
            <p>
                Scegli una qualsiasi immagine presente nel database della nasa (a partire dal 1997), commentala a tuo piacere 
                e pubblicala per condividere il tuo punto di vista con la comunity.<br>NB: non puoi accedere alla comunity senza esserti
                prima registrato.
            </p>
            <form id="myForm">
                <input id="date" type="date" placeholder="YYYY-MM-DD Format Only">
                <input type="submit">
            </form>
            <h1 id="title_1"></h1>
            <img id="pic" src="" width="100%">
            <p id="explanation"></p>
        </div>
        <div id="descr">
            <div><label>Commenta...</label><input id="comment" type="text"></div>
            <input type="button" value="carica post" id="upload">
        </div>
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