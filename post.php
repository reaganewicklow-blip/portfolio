#!/usr/local/bin/php
<?php 
header('Content-Type: text/plain; charset= utf-8');

session_save_path(__DIR__ . '/sessions/');
session_name('myWebpage');
session_start();


$loggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin']; 
$usernameExists = isset($_COOKIE['username']);

if (!$loggedIn || !$usernameExists){
    header('Location: login.php');        //go back to login if not logged in
    exit;
}


if(isset($_POST['blogpost'])){ //only does this if it got sent here through a request??? or if there is a post at all... that's not good...
    
    echo 'post successfully written';
    
    if(isset($_POST['blogauthor']))
    $user = $_POST['blogauthor'] =='' ? $_COOKIE['username'] : $_POST['blogauthor'];
    $message = $_POST['blogpost'];
    
    
    //file_put_contents('log.txt',"<b>$user</b> says: $message\n", FILE_APPEND);   
    $chatLog = fopen('posts.txt','a');
    if($chatLog){
        $formattedMessage = str_replace(" ","&nbsp;", $message);
        $formattedMessage2 = str_replace("\n","<br>", $formattedMessage);

        fwrite($chatLog, "<p><b>$user</b> says: $formattedMessage2</p>");
        fclose($chatLog);    
    }
    else{
        echo 'No chatLog file found';
    }
    
}
else{
    echo 'Nobody has made a post.';
}


//if redirected from submitting a post on blog.php
//if posts.text DNE before, make it


?>