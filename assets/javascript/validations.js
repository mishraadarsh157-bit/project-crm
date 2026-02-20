function validName(name) {            ////////////////////////////////name
  if (name == "") {
    $("#name_valid").show();
    $("#name_valid").text("enter name").css("color", "red");
    
  }
  else if(name.length <2 && name.length >15 ){

    $("#name_valid").show();
    $("#name_valid").text("enter valid name").css("color", "red");
    
  }
  else{
    
    $("#name_valid").hide();
    
  }
}
function validPass(password) {                       /////////////////password
    const regex=/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()\-+.])[a-zA-Z0-9!@#$%^&*()\-.+]{8,20}$/;
  if (password == "") {
    $("#pass_valid").show();
    $("#pass_valid").text("enter password").css("color", "red");
  }else if(regex.test(password)==false){
    $("#pass_valid").show();
    $("#pass_valid").text("invalid password").css("color", "red");
  }else{
    $("#pass_valid").hide();
  }

}

function validNumber(number){                          ///////////////////////number
  var phoneno = /[0-9]{10}$/;
// var phoneno = /^\d{10}$/;
  if (number == "") {
    $("#number_valid").show();
    $("#number_valid").text("enter number").css("color", "red");
}else if(!number.match(phoneno)){
  $("#number_valid").show();
    $("#number_valid").text("enter valid number").css("color", "red");

}else{
    $("#number_valid").hide();
  }

}

function validEmail(email){                          //////////////////email
 const regex = /^((?!\.)[\w\-_.]*[^.])(@\w+)(\.\w+(\.\w+)?[^.\W])$/;
 if(email==''){
    $("#email_valid").show();
    $("#email_valid").text("enter email").css("color", "red");
 }else if(regex.test(email)==false){
    $("#email_valid").show();
    $("#email_valid").text("enter valid eamil").css("color", "red");
 }else{
    $("#email_valid").hide();
  }
}
console.log("working");
