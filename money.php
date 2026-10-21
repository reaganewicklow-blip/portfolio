#!/usr/local/bin/php
<?php
header('Content-Type: text/plain;');

if (!isset($_COOKIE['username']) || !isset($_POST['credit'])){
    echo 'Either the user or credit was not posted.';
    exit;
}

//This file is solely responsible for updating the database based on 
//what post info it recieves every time credit is updated!

//every time we update credit, 
// we need to request to the server who has access to the db 
// to see which user it is so we know their credit
// and no matter where the user logs in, they can access their credit.


//this file runs whenever we send the request from the js. It updates the database.
$posted_username = $_COOKIE['username'];
$posted_credit = $_POST['credit'];

//updates the database with what it recieves
$db = new SQLite3('credit.db');                 //open up that db

                                                //update that db
$db->exec(" UPDATE users                        
            SET credit = '$posted_credit'
            WHERE username='$posted_username'");

$db->close();

echo "HERE's MY CREDIT: " . $_POST['credit'];

?>