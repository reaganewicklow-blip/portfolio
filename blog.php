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
    <title>Our Posts</title>
    <link rel "stylesheet" href='style.css'>

</head>
<body>
    <h1>Blog posts</h1>
    <form method='POST' action='post.php'>      <!-- ACTION says where we want to go-->

        <label for='author'>Author: </label>
        <input type='text' id='author' name='blogauthor' value="<?php echo isset($_COOKIE['username']) ? $_COOKIE['username'] : '';?>">
        <br>
        <label for='area'>Content: </label>
        <textarea id='area' name='blogpost'> 
        </textarea>
        <input type='submit' id='submit' value='Post'>

    </form>
    <section>
        <h2>Posts by other users:</h2>
        <p> 
            <?php
            if(file_exists('posts.txt')){
                echo file_get_contents('posts.txt');
            }
            ?>
        </p>
    </section>
    <footer>
        <hr>
        <p> &copy; <b>Reagan Wicklow</b> UCLA <i>2026</i></p>
    </footer>

</body>
</html>

