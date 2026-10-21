function get_username() {
    if (document.cookie.indexOf('username') === -1){//!!!??? 
        return '';
    }
    let cookie = document.cookie;
    if (cookie.includes('username')===false){       //filters out any cases where 'username' doesn't show up at all
        return "";
    } else {
        let usernameIdx = 0;      //now we must test for things like Nusername and usernameN
        let a = 0;
        while (true){
          usernameIdx = cookie.indexOf('username',a); //finds index of username
          //          (the two leading characters must be "; "    or  its the first char) AND (the char directly after should be an =)
          let valid = (cookie.substring(usernameIdx-2,usernameIdx) === "; " || usernameIdx === 0) && (cookie.charAt(usernameIdx+8) === '=');
          if (valid) {break;}     //if valid, move on.
          a = usernameIdx + 8;   //otherwise, check for another 'username' 8 characters later in the string
          if (usernameIdx === -1) {return "";}    //if there is no other 'username', --> return empty string
          if (a > cookie.length) {return "";}     //if we get to the end,            --> return empty string
        }

        let start = cookie.indexOf('=',usernameIdx) + 1;      //starting at usernameIdx, finds the index of the first = and adds 1
        let length = cookie.indexOf(';',start) - start;       //finds length by searching for the first ; after idx, then subtracts start
        if (length < 0) {length = cookie.length - start;}     //in case there is no semicolon after username (when username is the last key/value),
                                                              //We calculate the username length by taking total string length - the starting character. 
        
        let username = cookie.substring(start,start + length);
        return username;
    }
}