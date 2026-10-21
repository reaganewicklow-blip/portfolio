const prices = [17.00, 68.50, 195.99, 299.99];

const spans = document.getElementsByTagName('span');        //for prices
const images = document.getElementsByTagName('img'); 
const checkboxes = document.getElementsByTagName('input');  //selects all 6 inputs
const checkout_btn = document.getElementsByTagName('input')[5];
const your_credit = document.getElementById('cred');    //the 2nd <p>
const credit_para = document.getElementsByTagName('p')[6];    //the 7th <p>

const coupon_box = document.getElementById('couponCode');  //type here


//**************************
let credit = Number(your_credit.innerHTML); //must be whatever is injected by merch.php

window.onload = function(){   //resets credit to whatever is in the html
  update_credit();
}
//**************************


// Put the prices in the spans
for (let i=1; i < prices.length+1; i++){
  spans[i].innerHTML = "$" + prices[i-1];
}


// Add 6 event listeners_______________________________________________
//IMAGES X4
  for (let i=0; i<4; i++){                          
    images[i].addEventListener('click', function(){
      if(!checkboxes[i].disabled){
        checkboxes[i].checked = !checkboxes[i].checked;   //toggles on and off
      }
    });
  }

//ENTER ON COUPON BOX
coupon_box.addEventListener('keydown', function(e){   
  if (e.key === 'Enter'){
    validate_coupon_code(coupon_box.value);   //validate the value the user typed into couponCode box
    sales_total();
  }
});

//CHECKOUT BUTTON
checkout_btn.addEventListener('click', function(){
  validate_coupon_code(coupon_box.value);
  sales_total();
});



//FUNCTIONS_____________________________________________________________

//************************************/
function update_credit() {
  let request = new XMLHttpRequest();   //new request
  let data = new FormData();              //format data
  data.append('credit',credit);


  request.onload = function(){          //callback func
    if(request.status == 200){

        //update credit display when it returns...
        your_credit.innerHTML = credit.toFixed(2);
    }
  };

  request.open('POST','money.php');       //prep and send
  request.send(data);

}
//************************************/



function validate_coupon_code(code) {
  if (code === '') {return;}
  if (code === "COUPON5"){credit += 5;}
  if (code === "COUPON10"){credit += 10;}
  if (code === "COUPON20"){credit += 20;}

  credit_para.innerHTML = '';         //only do this at start of a sale or when no check boxes checked...???
  update_credit();         
  coupon_box.value = '';
}



function sales_total(arr) {
  let total = 0;
  let totalPlusTax = 0;
  const taxRate = 0.0725;
  let creditParaMessage = '';

  // Calculate the price from only the checked checkboxes
  for (let i=0; i<images.length; i++){      //iterate through each image
    if (checkboxes[i].checked){             //if its checkbox is checked
      total += prices[i];                   //add its price to the total
    }
  }

  // Calculate the price with tax
  totalPlusTax = total + (total*taxRate);                         //calculate after tax
  
  // Check if you have enough credit 
  let insufficientCredit = totalPlusTax > credit;
  if (insufficientCredit) {                  // Credit INSUFFICIENT
    alert("You have insufficient credit for this purchase.");
    credit_para.innerHTML = '';
  }
  else {                                      // Credit SUFFICIENT, go!
    credit -= totalPlusTax;
    update_credit();
    // Change 
    // checked boxes to be disabled.
    // Also, check if there are no checked boxes (no displayed message).
    let checkedBoxes = false;
    for (let i=0; i<images.length; i++){      //iterate through each image
      if (checkboxes[i].checked){             //if its checkbox is checked
        checkboxes[i].checked = false;         //uncheck it
        checkboxes[i].disabled = true;         //disable it
        checkedBoxes = true;                   //flags any checked boxes
      }
    }  

    creditParaMessage += `$${total}`;             //add to message
    creditParaMessage += `<br>+ sales tax (7.25%)<br>= $${totalPlusTax.toFixed(2)}`;   //add to message

    // Update the message in the BOTTOM <p> element. (only if there are actually checked boxes)
    if(checkedBoxes){
      credit_para.innerHTML = creditParaMessage;            //only happens if credit is sufficient
    }
  }
}
