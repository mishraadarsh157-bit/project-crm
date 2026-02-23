////////login page///////////
var baseurl='http://localhost/project/';

console.log('working')


$("#user_login").click(function (e) {
  e.preventDefault();
  var name = $("#name").val();
  validName(name);
  var password = $("#password").val();
  validPass(password);
  var save = $("#user_login").val();

  $.ajax({
    url: baseurl + "controllers/loginAPI.php",
    type: "POST",
    data: {
      name: name,
      password: password,
      submit: save,
    },
    success: function (response) {
      console.log(response);
      console.log(typeof response);

      if (response.trim() == "http://localhost/project/pages/home.php") {
        console.log(response)
        window.location.href = response.trim();
      } else {
        console.log("unknown user");
      }
    },
  });
});

$("#logout").click(function (e) {
  e.preventDefault();
  console.log("logout");
  var logout = $("#logout").val();
  $.ajax({
    url: "../controllers/loginAPI.php",
    type: "POST",
    data: {
      logout: logout,
    },
    success: function (response) {
      if (response.trim() == "logged_out") {
        window.location.href = "login.php";
        console.log("logouted");
      } else {
        console.log("error");
      }
    },
  });
});

$("#logo").click(function () {
  window.location.href = "home.php";
});

$("#hide_sidebar").click(function () {
  console.log("good");
  $("#left_sidebar").css("width", "8%");
  $(".content-body").css("width", "92%");
  $(".masters li #user_master").html('<i class="bi bi-people"></i>');
  $(".masters li #client_master").html('<i class="bi bi-person-circle"></i>');
  $(".masters li #item_master").html('<i class="bi bi-diagram-3"></i>');
  $(".logout form #logout").html('<i class="bi bi-box-arrow-left"></i>');
  $(".logout form").css("width", "5%");
  $("#hide_sidebar").hide();
  $("#show_sidebar").show();
});
$("#show_sidebar").click(function () {
  console.log("good");
  $("#left_sidebar").css("width", "16.5%");
  $(".content-body").css("width", "83.5%");
  $(".masters li #user_master").html(
    '<i class="bi bi-people"></i>  USER MASTER ',
  );
  $(".masters li #client_master").html(
    '<i class="bi bi-person-circle"></i>   CLIENT MASTER  ',
  );
  $(".masters li #item_master").html(
    '<i class="bi bi-diagram-3"></i>    ITEM MASTER ',
  );
  $(".logout form #logout").html(' <i class="bi bi-box-arrow-left"></i>   LOGOUT');
  $(".logout form").css("width", "15%");
  $("#hide_sidebar").show();
  $("#show_sidebar").hide();
});












  


function userData(page,limit,asc_id,asc_name,asc_phone) {
  $.ajax({
    url: baseurl + 'controllers/user_controller.php',
    type: "POST",
    data: {
    
      limit:limit,
      page_no: page,
      page_name: "userpage",
      asc_id:asc_id,
      asc_name:asc_name,
      asc_phone:asc_phone,
    },
    success: function (data) {
      $("#load_users").html(data);
    },
  });
}




$(document).on("click", "#pagination a", function (e) {
  e.preventDefault();
  var asc_id=$('#id_asc').val();
  
  var asc_name=$('#name_asc').val();
  var asc_phone=$('#phone_asc').val();
  var limit=$('#limit').val();
  var page = $(this).attr("id");
  console.log(page)
  userData(page,limit,asc_id,asc_name,asc_phone);
   $('#invis').val(page)
   console.log("this page is :" + $('#invis').val())
  
});


////////////back button<<<<<<<<<<

$(document).on("click", "#back", function (e) {
  e.preventDefault();
  var asc_id=$('#id_asc').val();
  var asc_name=$('#name_asc').val();
  var asc_phone=$('#phone_asc').val();
  var limit=$('#limit').val();
  var page = $('#invis').val()-1;
  console.log(Number(page))
  
  userData(page,limit,asc_id,asc_name,asc_phone);
});

/////////////////forward button>>>>>>>>>>>>

$(document).on("click", "#forward", function (e) {
  e.preventDefault();
  var asc_id=$('#id_asc').val();
  var asc_name=$('#name_asc').val();
  var asc_phone=$('#phone_asc').val();
  var limit=$('#limit').val();
  var page = $('#invis').val();
  var page=Number(page)+1
  console.log(page)
  userData(page,limit,asc_id,asc_name,asc_phone);
});

$('#id_asc').hide();
$(document).on("click", "#id_desc", function (e) {
  e.preventDefault();
  var asc_id=$('#id_desc').val()  ? 'desc' : 'asc';
  
  var asc_name=$('#name_asc').val();
  var asc_phone=$('#phone_asc').val();
  var limit=$('#limit').val();
  var page = $('#pagination a').attr("id");
  console.log(userData(page,limit,asc_id,asc_name,asc_phone));
  userData(page,limit,asc_id,asc_name,asc_phone);
});
$(document).on("click", "#id_asc", function (e) {
  e.preventDefault();
  var asc_id=$('#id_asc').val();
  var asc_name=$('#name_asc').val();
  var asc_phone=$('#phone_asc').val();
  var limit=$('#limit').val();
  var page = $('#pagination a').attr("id");
  console.log(userData(page,limit,asc_id,asc_name,asc_phone));
  userData(page,limit,asc_id,asc_name,asc_phone);
});


///////////order by name
$(document).on("click", "#name_desc", function (e) {
  e.preventDefault();
  var asc_id=$('#id_desc').val()  ? 'desc' : 'asc';
  var asc_name=$('#name_desc').val()  ? 'desc' : 'asc';
  var asc_phone=$('#phone_desc').val()  ? 'desc' : 'asc';
  var limit=$('#limit').val();
  var page = $('#pagination a').attr("id");
  console.log(userData(page,limit,asc_id,asc_name,asc_phone));
  userData(page,limit,asc_id,asc_name,asc_phone);
});
$(document).on("click", "#name_asc", function (e) {
  e.preventDefault();
  var asc_id=$('#id_asc').val();
  var asc_name=$('#name_asc').val();
  var asc_phone=$('#phone_asc').val();
  var limit=$('#limit').val();
  var page = $('#pagination a').attr("id");
  console.log(userData(page,limit,asc_id,asc_name,asc_phone));
  userData(page,limit,asc_id,asc_name,asc_phone);
});

///////////order by number
$(document).on("click", "#phone_desc", function (e) {
  e.preventDefault();
 var asc_id=$('#id_desc').val()  ? 'desc' : 'asc';
  var asc_name=$('#name_desc').val()  ? 'desc' : 'asc';
  var asc_phone=$('#phone_desc').val()  ? 'desc' : 'asc';
  var limit=$('#limit').val();
  var page = $('#pagination a').attr("id");
  console.log(userData(page,limit,asc_id,asc_name,asc_phone));
  userData(page,limit,asc_id,asc_name,asc_phone);
});
$(document).on("click", "#phone_asc", function (e) {
  e.preventDefault();
  var asc_id=$('#id_asc').val();
  var asc_name=$('#name_asc').val();
  var asc_phone=$('#phone_asc').val();
  var limit=$('#limit').val();
  var page = $('#pagination a').attr("id");
  console.log(userData(page,limit,asc_id,asc_name,asc_phone));
  userData(page,limit,asc_id,asc_name,asc_phone);
});


function limitData(){
  var limit=$('#limit').val();
  console.log(limit)
  var page = $(this).attr("id");
  userData(page,Number(limit));
}


window.addEventListener("load", () => {
  const path = window.location.pathname;
  const locate = path.replace(/\/$/, "").split("/").pop();
  // console.log(locate)
  // console.log(typeof(locate))
  if (locate.trim() == "user_master.php") {
    userData();
  }
});







function insertUser() {
  let user_name = $("#user_name").val();
  validName(user_name);
  let user_pass = $("#user_pass").val();
  validPass(user_pass);
  let user_number = $("#user_number").val();
  validNumber(String(user_number));
  let user_email = $("#user_email").val();
  validEmail(user_email);
  let save_user = $("#save_user").val();
  $.ajax({
      url: baseurl + 'controllers/user_controller.php',
    type: "POST",
    data: {
      user_name: user_name,
      user_pass: user_pass,
      user_phone: user_number,
      user_email: user_email,
      save_user: save_user,
    },
    success: function (data) {
      if (data.trim() == 1) {
        window.location.href='user_master.php';
        userData();
      $("#add_user").trigger("reset");
      $("#add_user div").hide();
    
      } else {
        console.log("error");
      }
    },
  });
}
//////////////////////update
$(document).on("click", "#update", function () {
  let id = $(this).data("uid");
  let update=$('#update').val();
  $.ajax({
    url: baseurl + 'controllers/user_controller.php',
    type: "POST",
    data: {
      id: id,
      update:update
    },
    success: function (data) {
      $(".update_user_form").html(data);
    },
  });
});

$(document).on("click", "#edit", function (e) {
  e.preventDefault();
  let id = $("#id").val();
  let user_name = $("#name").val();
  validName(user_name)
  let user_number = $("#number").val();
  // validNumber(user_number)
  let user_email = $("#email").val();
  validEmail(user_email)
  let status = $("#status").val();
  let update_user = $("#edit").val();
  console.log(update_user)
  $.ajax({
    url: baseurl + 'controllers/user_controller.php',
    type: "POST",
    data: {
      id: id,
      name: user_name,
      number: user_number,
      email: user_email,
      status: status,
      update_user: update_user,
    },
    success: function (data) {
      if(data.trim()==1){
      userData();

      $("#myModal").hide();
    }
    else{
      console.log("update js error")
    }
  },
  });
});
userData();

////////////////delete user //////

$(document).on("click", "#delete", function (e) {
  var id=$(this).data('did'); 
  alert('DO YOU REALLY WANT TO DELETE DATA FOR ID: ' + id);
var delet=$('#delete').val();
var element=this;
$.ajax({
  url: baseurl + 'controllers/user_controller.php',
  type:'POST',
  data:{
    id:id,
    delete:delet
  },
  success: function(data){
    console.log(data)
    userData();
  if(data.trim()==1){
 $(element).closest("tr").fadeOut();
  }
  else{
    console.log(data)
    console.log('not deleted in js')
  }
  }

})

})

  

function searc(){

var s_id=$('#search_id').val()
var s_name=$('#search_name').val()
var s_email=$('#search_email').val()
var s_number=$('#search_number').val()
var s_status=$('#search_status').val()
  var search='search'
$.ajax({
    url: baseurl + 'controllers/user_controller.php',
    type:'POST',
    data:{
      id:s_id,
      name:s_name,
      email:s_email,
      number:s_number,
      status:s_status,
      search:search
    },
    success:function(data){
    
      $('#load_users').html(data)
    }

  })

}



////////////////////////////////////client master

// load select states into form////

function loadStates(){

  $.ajax({
    url:baseurl + "controllers/client_controller.php",
    type:'POST',
    data:{
      states:'states'
    },
    success:function(data){
      $('#loadState').html(data)

    }
  })

}

function loadedState(){
  var state=$('#select_state').val();
  loadCity(state)
}


function loadCity(state){
console.log(state)
  $.ajax({
    url:baseurl + "controllers/client_controller.php",
    type:'POST',
    data:{
      city:'city',
      state:state
    },
    success:function(data){
      
      $('#loadCity').html(data)
    }
  })
}


function insertClient() {
  let client_name = $("#client_name").val();
  validName(client_name);
  
  let client_number = $("#client_number").val();
  // validNumber(String(client_number));
  let client_email=$('#client_email').val();
  validEmail(client_email);
  let client_address = $("#client_address").val();
  validAddress(client_address);

  let client_state=$('#select_state').val();

  let client_city=$('#select_city').val();
  

  let client_pincode = $("#client_pincode").val();
  validPincode(client_pincode);

  let insert_client = $("#insert_client").val();

  $.ajax({
      url: baseurl + 'controllers/client_controller.php',
    type: "POST",
    data: {
      client_name: client_name,
      client_phone: client_number,
      client_email:client_email,
      client_address: client_address,
      client_city: client_city,
      client_state: client_state,
      client_pincode: client_pincode,
      insert_client: insert_client,
    },
    success: function (data) {
      if (data.trim() == 1) {
console.log(data)
        window.location.href='client_master.php';
      $("#add_client").trigger("reset");
    
      } else {
        console.log(data)
        console.log("error");
      }
    },
  });
}
/////////////////////first load table using json
function clientData(){
console.log('client data')
  $.ajax({
    url: baseurl + 'controllers/client_controller.php',
    type:'POST',
    datatype:'json',
    data:{
      page_name:'clientPage'
    },
    success: function(data){
       data=JSON.parse(data)
       console.log(data)
    let table = '<table border="1" class="table bg-white"><tr class="bg-skyblue" style="whitespace:nowrap;">';
      table += '<th class="id">id</th>'
      table += '<th class="name">name</th>'
      table += '<th class="phone">Phone</th>'
      table += '<th class="email">email</th>'
      table += '<th class="address">Address</th>'
      table += '<th class="state">State</th>'
      table += '<th class="city">City</th>'
      table += '<th class="pincode">Pincode</th>'
      table += '<th class="status text-center">Status</th>'
      table += '<th class="action">Action</th>'
    table += '</tr>';
    data.forEach(function(value) {
      table += '<tr style="height:40px;whitespace:nowrap;">';
        table += `<td class='text-muted'>${value[0]}</td>`;
        table += `<td class='text-success'>${value[1]}</td>`;
        table += `<td class='text-muted'>${value[2]}</td>`;
        table += `<td class=''>${value[3]}</td>`;
        table += `<td class='text-muted'>${value[4]}</td>`;
        table += `<td class='text-muted'>${value[5]}</td>`;
        table += `<td class='text-muted'>${value[6]}</td>`;
        table += `<td class='text-muted'>${value[7]}</td>`;
        if(value[8]=='ACTIVE'){
          var btn_stat='status-btn-green';
        }
        else{
          var btn_stat='status-btn-red';
        }
        table += `<td class='text-muted text-center'><button id='' class='btn w-100 btn-sm ${btn_stat}'>${value[8]}</button></td>`;
        table += `<td class='text-muted'><button class='btn btn-sm rounded-pill status-btn-green' name='update' data-bs-toggle='modal' data-bs-target='#myModal' data-uid='{$row['id']}'  id='update' value='update'>
                <i class='bi bi-pencil-square'>
                </i></button> <button class='btn btn-sm rounded-pill  status-btn-red' name='delete' data-did='{$row['id']}'  id='delete' value='delete'>
                <i class='bi bi-trash3'>
                </i></button></td>`;
      table += '</tr>';
    });
    
    table += '</table>';
    $('#load_clients').html(table); 
    }

  })
}
clientData()
