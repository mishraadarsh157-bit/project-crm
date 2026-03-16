function validName(name) {            ////////////////////////////////name
  const pattern=/^([a-zA-Z ]){2,30}$/;

  if (name.trim() == "") {
    $(".name_valid").show();
    $(".name_valid").text("enter name").css("color", "red");
    return false;
    
  }
  else if(pattern.test(name.trim())==false){

    $(".name_valid").show();
    $(".name_valid").text("enter valid name").css("color", "red");
    return false;
    
  }
  else{
    
    $(".name_valid").hide();
    return true;
    }
}
function validPass(password) {                       /////////////////password
    const regex=/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()\-+.])[a-zA-Z0-9!@#$%^&*()\-.+]{8,20}$/;
  if (password == "") {
    $(".pass_valid").show();
    $(".pass_valid").text("enter password").css("color", "red");
    return false
  }else if(regex.test(password)==false){
    $(".pass_valid").show();
    $(".pass_valid").text("invalid password").css("color", "red");
    return false
  }else{
    $(".pass_valid").hide();
    return true
  }

}

function validNumber(number){                          ///////////////////////number
  var phoneno = /[0-9]{10,10}$/;

  if (number == "") {
    $(".number_valid").show();
    $(".number_valid").text("enter number").css("color", "red");
    return false;
}else if(phoneno.test(number)==false){
  $(".number_valid").show();
    $(".number_valid").text("enter valid number").css("color", "red");
  return false;
}
else if(number.length !==10){
 $(".number_valid").show();
    $(".number_valid").text("enter 10 digit number").css("color", "red");
  return false;
}
else{
    $(".number_valid").hide();
    return true;
  }

}

function validEmail(email){                          //////////////////email
 const regex = /^((?!\.)[\w\-_.]*[^.])(@\w+)(\.\w+(\.\w+)?[^.\W])$/;
 if(email==''){
    $(".email_valid").show();
    $(".email_valid").text("enter email").css("color", "red");
    return false
 }else if(regex.test(email)==false){
    $(".email_valid").show();
    $(".email_valid").text("enter valid eamil").css("color", "red");
return false
  }else{
    $(".email_valid").hide();
    return true
  }
}
function validAddress(address)
{
  if (address == "") {
    $(".address_valid").show();
    $(".address_valid").text("enter address").css("color", "red");
  return false    
  }
  else{
    
    $(".address_valid").hide();
    return true
  }
}
function validPincode(pincode){
  if (pincode == "") {
    $(".pincode_valid").show();
    $(".pincode_valid").text("enter pincode").css("color", "red");
    return false
  }
  
  else{
    
    $(".pincode_valid").hide();
    return true
  }
}
function validPrice(price){
    if (price == "") {
    $(".price_valid").show();
    $(".price_valid").text("enter price").css("color", "red");
    return false
  }
  
  else{
    
    $(".price_valid").hide();
    return true
  }
}

function validDescription(des){
    if (des == "") {
    $(".des_valid").show();
    $(".des_valid").text("enter Description").css("color", "red");
    return false
  }
  
  else{
    
    $(".des_valid").hide();
    return true
  }
}

function validState(state){
  if(state==""){
    $(".state_valid").show()
    $(".state_valid").text("plese select state").css('color','red')
    return false
  }
  else if(state=="----Select State----"){
    $(".state_valid").show()
    $(".state_valid").text("plese select state").css('color','red')
    return false
  }
  else{
    $(".state_valid").hide()
    return true
    
  }
}

function validCity(city){
  if(city==""){
    $(".city_valid").show()
    $(".city_valid").text("plese select city").css('color','red')
    return false
  }
  else if(state=="----Select City----"){
    $(".city_valid").show()
    $(".city_valid").text("plese select city").css('color','red')
    return false
  }
  else{
    $(".city_valid").hide()
    return true

      }
}