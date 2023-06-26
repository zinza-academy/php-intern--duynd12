const MAX_SIZE = 1048576;
let previousURL  = "";

var ip_avatar = document.getElementById('ip_avatar');
var avatar = document.getElementById('avatar');


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

    console.log("Line 22 : ",imageURL);
}

