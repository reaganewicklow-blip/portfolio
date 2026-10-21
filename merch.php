#!/usr/local/bin/php
<?php


//SESSIONS LOGIC
session_save_path(__DIR__ . '/sessions/');
session_name('myWebpage');
session_start();

$loggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin']; 
$usernameExists = isset($_COOKIE['username']);

if (!$loggedIn || !$usernameExists){
    header('Location: login.php');        //go back to login if not logged in
    exit;
}
if($usernameExists){    $user = $_COOKIE['username'];   }


//This page is the actual merch page. It needs to update its visuals according to the database.
//All this is doing is every time it loads, 
//  1) Access the db 
//  2) Update the page's graphics with what is actually on the DB


//DATABSE LOGIC ************************************************
$user_credit = 0; //initialize user_credit

$db = new SQLite3('credit.db');     //access db (or create on first time)
$db->exec('CREATE TABLE IF NOT EXISTS users(username TEXT UNIQUE, credit REAL)'); //create table (if DNE)


$query = $db->query("SELECT * FROM users WHERE username='$user'");  //query for current user's row
$current_user_arr= $query->fetchArray();                            //turn query --> array


//if user exists
if($current_user_arr){
    $user_credit = (double) $current_user_arr['credit'];                        //get their credit (from query array)
}
//if user DNE
if(!$current_user_arr){
    $db->exec("INSERT INTO users (username, credit) VALUES ('$user', 20)");     //insert them into the db (give $20.00)
    $user_credit =  20.00;                                                      //we know its $20 now, so just use this literal
}

//************************************************************************
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Our Merchandise</title>
    <script src="merch.js" defer></script>
    <link rel "stylesheet" href='style.css'>

</head>
<body>
    <header>
        <h1>Our Merchandise</h1>
    </header>
    <main>
        <section>
            <h2>Irish Instruments</h2>
            <p>Please have a look around. Our new members are awarded with $20.00 in credit.
                You can add credit at anytime with a coupon code. When you want to make
                a purchase, please select the checkboxes of the items you wish to purchase and
                click the "Checkout" button below.
            </p>        
            <p>Your credit: $<span id='cred'><?php echo $user_credit ?></span></p>   <!-- your_credit -->
            <table>
                <tbody>
                    <tr>
                        <td>
                            <img src="https://www.tradschool.com/wp-content/uploads/2023/12/c-irish-flute-polymer.jpg" width="300" height="300" alt="Irish Flute">
                            <h3>Irish Flute</h3>
                            <input type="checkbox" id="item1">
                            <span></span>
                            <p>Traditional wooden flute without keys.</p>
                        </td>
                        <td> 
                            <img src="https://upload.wikimedia.org/wikipedia/commons/1/1a/Bodhran.jpg" width="300" height="300" alt="Bodhrán Drum">
                            <h3>Bodhrán Drum</h3>
                            <input type="checkbox" id="item2">
                            <span></span>
                            <p>Played with a double-sided mallet.</p>                
                        </td>  
                    </tr>
                    <tr>             
                        <td>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/79/A_converter_free-bass_piano-accordion_and_a_Russian_bayan.jpg/330px-A_converter_free-bass_piano-accordion_and_a_Russian_bayan.jpg" width="300" height="300" alt="Accordion">
                            <h3>Accordion</h3>
                            <input type="checkbox" id="item3">
                            <span></span>
                            <p>A ridiculously cheap set of accordions.</p>                
                        </td>
                        <td> 
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQlyDjS6-ADypxlPMhF1wcx4YOLzYPzKjwoOQ&s" width="300" height="300" alt="Fiddle">
                            <h3>Fiddle</h3>
                            <input type="checkbox" id="item4">
                            <span></span>
                            <p>Bow not included... sorry.</p>                    
                        </td>
                    </tr>
                </tbody>    
            </table>
        </section>
        <fieldset>
            <label for="couponCode">Coupon Code: </label>
            <input type="text" id="couponCode"> 
            <br>
            <input type="button" value='Checkout' id="checkout">
            <p></p> <!-- credit_para -->
        </fieldset>
    </main>
    <footer>
        <hr>
        <p> &copy; <b>Reagan Wicklow</b> UCLA <i>2026</i></p>
    </footer>
    

</body>
</html>