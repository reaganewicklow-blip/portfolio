#!/usr/local/bin/php
<?php

session_save_path(__DIR__ . '/sessions/');
session_name('myWebpage');
session_start();


$loggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin']; 
$usernameExists = isset($_COOKIE['username']);

if (!$loggedIn || !$usernameExists){
    header('Location: login.php');        //go back to login if not logged in
    exit;
}

if($usernameExists){    $username = $_COOKIE['username'];   }

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Hungarian</title>
        <link rel "stylesheet" href='style.css'>

    </head>

    <body>
        <header>
            <span id="greeting"> <?php echo "Hello, " . htmlspecialchars($username) . "!" ?> </span>
            <h1>Learning Hungarian</h1>
            <p>This website will cover the basics of hungarian for anyone who wishes to learn.</p>
            <hr>
        </header>
        
        <main>
            <section>
                <h2>Alphabet</h2>
                <p>a á b c d e é f g h i í j k l m n o ó ö ő p q r s t u ú ü ű v w x y z</p>
                <h3>Front Vowels (Magas)</h3>
                <p>e, é, i, í, ö, ö, ü, ü</p>
                <h3>Back Vowels (Mély)</h3>
                <p>a, á, u, ú, o, ó</p>
            </section>
            <figure>
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Flag_of_Hungary.svg/500px-Flag_of_Hungary.svg.png">
                <figcaption>The hungarian flag.</figcaption>
            </figure>
            <hr>
            <section>
                <h2>Letter Pairs</h2>
                <ul>
                    <li>Gy; gyufa</li>
                    <li>Ny; nyolc</li>
                    <li>Ty; tyúk</li>
                    <li>Ly; lyuk</li>
                </ul>
                <ul>
                    <li>Cs; csocoládé</li>
                    <li>Dz; bodza</li>
                    <li>Dzs; dzsip</li>
                    <li>Sz; szalámi</li>
                    <li>Zs; zsiráf</li>
                </ul>
            </section>
            <hr>
            <section>
                <h2>Important Considerations</h2>
                <p>Remember that 'sz' makes an 'sss' sound while 's' makes an 'shh' sound.</p>
            </section>
            <hr>
            <section>
                <h2>Some recent posts by other users:</h2>
                <h3><b>malicious666</b> says: </h3>
                <p>Could anyone see how I can fix my <a href="scarf1.html" target="_blank" rel="opener">scarf</a>? Please help. I'm so sad. Here's a <a href="scarf2.html" target="_blank" rel="opener">picture</a> of the other side.</p>
            </section>
        </main>
        <hr>
        <footer>
            <p> &copy; <b>Reagan Wicklow</b> UCLA <i>2026</i></p>
        </footer>

    </body>

</html>