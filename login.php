#!/usr/local/bin/php
<?php

session_save_path(__DIR__ . '/sessions/');
session_name('myWebpage');
session_start();

$incorr_submiss = false; 


  //this will run every time the page is reloaded so when the form is submitted and the page loads itself, it checks this again
if (isset($_POST['submittedPassword'])){
    validate($_POST['submittedPassword'], $incorr_submiss);
}


function validate($submiss, &$incorr_submiss){ //passes incorr_submission by reference so we can update it! Remember, reference is necessary for global things to be accessible.
    //dealing with the file
    $file = fopen('h_password.txt','r') or die('Unable to find the hashed password.');
    $hashed_password = fgets($file); // this loads the first line in the file
    $hashed_password = trim($hashed_password); // this will remove any white space or new line characters
    fclose($file);

    //trimming the user submission
    $submiss = trim($submiss);
    $hashed_submiss = hash('md2', $submiss); //hashing user submission password

    //comparing user submission with file contents
    if ($hashed_password !== $hashed_submiss){
      $_SESSION['loggedin'] = false;        //not logged in
      $incorr_submiss = true;               //set bool
    } else {
      $_SESSION['loggedin'] = true;         //logged in
      header ("Location: index.php");
      exit;
    } 
}

?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset='UTF-8'>
        <title>Login</title>
        <script src="username.js" defer></script>
        <script src="login.js" defer></script>
        <link rel "stylesheet" href='style.css'>


    </head>
    <body>
        <header>
            <h1> Welcome! Ready to check out my webpage?</h1>
        </header>
        <main>
            <section>
                <h2>Enter a username.</h2>
                <p>So that you can make your own posts and purchases, select a username and password.</p>
                <fieldset>
                    <form method="POST" id = 'form' action="<?php echo $_SERVER['PHP_SELF']; ?>">  <!---redirects to itself to validate the password before redirecting-->
                    <label for="Username">Username: </label>
                    <input type="text" id="Username" name="Username">
                    <br>
                    <label for="pass">Password: </label> 
                    <input type="password" id="pass" name="submittedPassword">
                    <input type="submit" id='Login' value="Login">
                </form>
                </fieldset>
                <?php
                if ($incorr_submiss){
                    echo '<br>';
                    echo "Invalid password!";
                    echo '<br>';
                    echo '<br>';
                }
                ?>
            </section>
        </main>
        <footer>
            <hr>
            <p> &copy; Reagan Wicklow, 2026</p>
        </footer>
        
    </body>


</html>