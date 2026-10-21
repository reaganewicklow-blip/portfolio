//EVENT LISTENERS_________________________________________________________________________________________
const button = document.getElementById('Login');              //document Login button
let usernameEle = document.getElementsByTagName('input')[0];  //document username textbox element

//Login Button
button.addEventListener('click', function() {
  if (usernameEle.value !== '') {
    validate_username(); 
  }
});                                                                    //when button is clicked, validate username

//Enter Key     (executes only if user is typing in the box)
document.addEventListener('keydown', function(e){         //new function
  if (e.key === 'Enter' && usernameEle.value !== ''){     //if the event's key is enter
    validate_username();                             //then run the validate username function
  }
});



//this sets the username textbox value to the username, which is empty (or null???) when the cookie expires.
let username_box = document.getElementById('Username');
username_box.value = get_username();



/**
 This function validates a username.
 A string should be printed to the console after the username is evaluated.
 It'll be determined acceptable or relavent username errors will be printed.
 String formatting details are outlined in hw2.pdf.

 @param  {string} username : The username to validate.
 */
function validate_username() {
    let username = usernameEle.value;   //getting the user input

    //first seven
    let invalid = false;
    let errorMessage = "";
    if (username.length < 5) {errorMessage += "Username must be 5 characters or longer.\n"; invalid = true; }
    if (username.length > 40) {errorMessage += "Username must be 40 characters or fewer.\n"; invalid = true;}
    if (username.includes(" ")) {errorMessage += "Username cannot contain spaces.\n"; invalid = true;}
    if (username.includes(",")) {errorMessage += "Username cannot contain commas.\n"; invalid = true;}
    if (username.includes(";")) {errorMessage += "Username cannot contain semicolons.\n"; invalid = true;}
    if (username.includes("=")) {errorMessage += "Username cannot contain =.\n"; invalid = true;}
    if (username.includes("&")) {errorMessage += "Username cannot contain &.\n"; invalid = true;}
    
    //last check
    const possibleChars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^*()-_+[]{}:'|`~<.>/?";
    const errorMessage8 = "Username can only use characters from the following string:\nabcdefghijklmnopqrstuvwxyz\nABCDEFGHIJKLMNOPQRSTUVWXYZ\n0123456789\n!@#$%^*()-_+[]{}:'|`~<.>/?";

    if (!invalid) {
      let invalidChar = false;                  //flag for invalid character
      for (const char of username){             //iterates through the username
        if (!(possibleChars.includes(char))){   //checks each against allowed characters
            invalidChar = true;                 //flags for invalid character
            invalid = true;                     //flags for general issue.
        }
      }
      if (invalidChar) {errorMessage += errorMessage8;}
    }

    if(invalid) {alert(errorMessage);}    //after it checks all chars, if invalidChar, logs error message

    //IF (valid) ==>  1) SET a COOKIE  2) REDIRECT TO index.php
    if (!invalid) {
      let now = new Date();                 //sets a date one hour in the future
      now.setHours(now.getHours() + 1);

      document.cookie = `username=${username}; expires=${now.toUTCString()}`; //NEW STUFF: sets hours to current hour + 1

      window.location.assign('index.php');
    }
}


