const MAX_SIZE = 1048576;
let previousURL  = "";

var avatar = document.getElementById('avatar');
var ip_avatar = document.getElementById('ip_avatar');
var error_msg = document.getElementById('error');


var password = document.getElementById('password');
var confirmPassword = document.getElementById('confirmPassword');


var msg_password = document.getElementById('msg_password');
var msg_confpass = document.getElementById('msg_confpass');


var nameElement = document.getElementById('name');
var msg_name = document.getElementById('msg_name');

nameElement.onblur= function(e) {
    let content = e.target.value;
    
    if (content.trim() == "") {
        msg_name.style.display = "block";
        nameElement.style.border= "1px solid red";
    }else{
        msg_name.style.display = "none";
        nameElement.style.border = "";
    }
}

password.onblur = function (e) {
    password.value = e.target.value;
    if (password.value !== confirmPassword.value && confirmPassword.value !== "") {
            msg_password.style.display = "block";
            password.style.border= "1px solid red";

    }
    else{
        msg_password.style.display = "none";
        msg_confpass.style.display = "none";
        password.style.border= "";
        confirmPassword.style.border= "";
    }
}

confirmPassword.onblur = function(e) {
     confirmPassword.value = e.target.value;
     if (password.value !== confirmPassword.value && password.value !== "") {
        confirmPassword.style.border= "1px solid red";
        msg_confpass.style.display = "block";
     }
     else{
        msg_confpass.style.display = "none";
        msg_password.style.display = "none";
        confirmPassword.style.border= "";
        password.style.border= "";


     }
}

ip_avatar.onchange = function(e) {
    let file = e.target.files[0];
    let imageURL = URL.createObjectURL(file);
    avatar.src = imageURL;
    
    if (imageURL !== previousURL) {
        URL.revokeObjectURL(previousURL);
    }
    if (file.size > MAX_SIZE) {
        error_msg.style.display="block";
    }
    else{
        error_msg.style.display="none";
    }
    previousURL = imageURL;
}


var list_input = document.querySelectorAll('list-input input');
console.log(list_input);
console.log("hello world");