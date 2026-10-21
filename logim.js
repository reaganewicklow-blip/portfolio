

let haHeading = 'HA';

function haha(){
    const button = document.getElementsByTagName('h1')[0];
    button.innerHTML = haHeading;
    haHeading += 'HA';
}

function mocking(){
    let password = passwordEle.value;
    const para = document.createElement('p');
    const text = document.createTextNode("Somebody knows the password you like to use is ");
    const boldPassword = document.createElement('b');
    boldPassword.textContent = `${password}.`;
    para.append(text);
    para.append(boldPassword);
    const section = document.getElementsByTagName('section')[0];
    section.appendChild(para);
}




//LOGIM EVENT LISTENERS________________________________________________________________________

const button = document.getElementById('Login');              //get the Login button
let passwordEle = document.getElementsByTagName('input')[1];  //get the password textbox element


//LOGIN BUTTON
button.addEventListener('click', function() {
  if (passwordEle.value !== '') {
    haha();
    mocking(); 
  }

});                                                                    //when button is clicked, validate username

//ENTER KEY
document.addEventListener('keydown', function(e){         //new function
  if (e.key === 'Enter' && passwordEle.value !== ''){    //if the event's key is enter
    haha();
    mocking();                                 
  }
});