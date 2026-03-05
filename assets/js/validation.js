function loginValidate(){

var email=document.getElementById("email").value;
var password=document.getElementById("password").value;

if(email==""||password==""){
alert("All fields required");
return false;
}

return true;
}

function formValidate(){

var inputs=document.querySelectorAll("input[required]");

for(var i=0;i<inputs.length;i++){

if(inputs[i].value==""){
alert("Please fill all required fields");
return false;
}

}

return true;

}