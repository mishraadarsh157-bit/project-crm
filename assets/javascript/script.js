////////login page///////////
var baseurl = "http://localhost/project/";

if (window.location.href == "http://localhost/project/usermaster/") {
  $(".side1").css("background", "orangered").css({
    color: "white",
    "margin-left": "25px",
    "border-right": "10px solid yellow",
  });
  userData();
} else if (window.location.href == "http://localhost/project/itemmaster/") {
  $(".side3").css("background", "orangered").css({
    color: "white",
    "margin-left": "25px",
    "border-right": "10px solid yellow",
  });
} else if (window.location.href == "http://localhost/project/invoice/") {
  $(".side4").css("background", "orangered").css({
    color: "white",
    "margin-left": "25px",
    "border-right": "10px solid yellow",
  });
}

function login() {
  var email = $("#email").val();
  if (!validEmail(email)) {
    return;
  }
  var password = $("#password").val();
  if (!validPass(password)) {
    return;
  }

  var save = $("#user_login").val();

  $.ajax({
    url: "/project/loginAPI/",
    type: "POST",
    data: {
      email: email,
      password: password,
      submit: save,
    },
    success: function (response) {
      if (response.trim() == "/project/home/") {
        window.location.href = response.trim();
      } else if (response.trim() == "0") {
        Swal.fire({
          title: "404",
          text: "NO USER FOUND",
          icon: "question",
        });
        Swal.fire({
          icon: "error",
          title: "404",
          text: "No User Found!",
          footer: '<a href="#">Please Try Again</a>',
        });
      }
    },
  });
}

$(".logout").click(function (e) {
  e.preventDefault();
  var logout = $(".logout").val();
  $.ajax({
    url: "/project/loginAPI/",
    type: "POST",
    data: {
      logout: logout,
    },
    success: function (response) {
      if (response.trim() == "logged_out") {
        window.location.href = "/project/";
      } else {
        Swal.fire({
          title: "Error",
          text: "Unable To Logout",
          icon: "question",
        });
      }
    },
  });
});

// $("#logo").click(function () {
//   window.location.href = "/project/home/";
//   dashboardData()
// });

$("#hide_sidebar").click(function () {
  $("#left_sidebar").css("width", "8%");
  $(".logo").css("width", "8%");
  $(".content-body").css("width", "92%");
  $(".naav").css("width", "92%");
  $(".logo").html("<img src='../assets/images/demo.png' class='mx-auto'>");
  $(".masters #user_master button").html('<i class="bi bi-people"></i>');
  $(".masters #client_master button").html(
    '<i class="bi bi-person-circle"></i>',
  );
  $(".masters #item_master button").html('<i class="bi bi-cart"></i>');
  $(".masters #invoice button").html('<i class="bi bi-receipt"></i>');
  $(" .logout").html('<i class="bi bi-box-arrow-left"></i>');
  $(".logout_form").css("width", "6.6%");
  $("#hide_sidebar").hide();
  $("#show_sidebar").show();
});
$("#show_sidebar").click(function () {
  $("#left_sidebar").css("width", "16.5%");
  $(".logo").css("width", "16.5%");
  $(".content-body").css("width", "83.5%");
  $(".naav").css("width", "83.5%");

  $(".logo").html(
    "<img src='../assets/images/demo.png' class='mx-auto'><b class='h4 logo_name ms-2'  > AppStack</b>",
  );
  $(".masters #user_master button").html(
    '<i class="bi me-3 bi-people"></i>  USER MASTER ',
  );
  $(".masters #client_master button").html(
    '<i class="bi me-3 bi-person-circle"></i>   CLIENT MASTER  ',
  );
  $(".masters #item_master button").html(
    '<i class="bi me-3 bi-cart"></i>    ITEM MASTER ',
  );
  $(".masters #invoice button").html('<i class="bi bi-receipt"></i>   INVOICE');
  $(" .logout").html(' <i class="bi me-3 bi-box-arrow-left"></i>   LOGOUT');
  $(".logout_form").css("width", "15%");
  $("#hide_sidebar").show();
  $("#show_sidebar").hide();
});

$(document).on("click", ".sort", function () {
  var value = $(this).text();
  $(".field").val(value);
  $("#invis").val(1);
  var page = $("#invis").val();
  userData(Number(page));
});

$(document).on("click", ".sort", function () {
  $(".order").val($(".order").val() === "asc" ? "desc" : "asc");
  $("#icon_hold").val(
    $("#icon_hold").val() === "bi-arrow-up" ? "bi-arrow-down" : "bi-arrow-up",
  );
});

function userData(page, limit) {
  var limit = $("#limit").val();
  var search_user = $("#search_user").val();
  var s_status = $("#search_status").val();
  var field = $(".field").val();
  var order = $(".order").val();
  $.ajax({
    url: "/project/usercontroller/",
    type: "POST",
    data: {
      page_no: page,
      search_user: search_user,
      status: s_status,
      field: field,
      order: order,
      limit: limit,
      page_name: "userpage",
    },
    success: function (data) {
      if (data.trim() == "empty") {
        let icon = $("#icon_hold").val();
        let table =
          '<div class="holding-table"><table border="1" class="table  bg-white table-bordered"> ';
        table += '<tr class="bg-blue" style="whitespace:nowrap;">';
        table += `<th class="srno text-center">Sr.NO</th>`;
        table += '<th class="action text-center">Action</th>';
        table += `<th onclick="userData()" class="name sort border">Name <i class="bi ${icon}" id="sort_icon"></i></th>`;
        table += `<th onclick="userData()" class="phone sort border">Phone <i class="bi ${icon}" id="sort_icon"></i></th>`;
        table += `<th onclick="userData()" class="email sort">Email <i class="bi ${icon}" id="sort_icon"></i></th>`;
        table += '<th class="status text-center">Status</th>';
        table += "</tr>";
        table += "<tr>";
        table +=
          '<th colspan="9" class="text-center"><h1>NO USER FOUND</h1></th>';
        table += "</tr>";
        $("#load_users").html(table);
      } else {
        data = JSON.parse(data);
        page = $("#invis").val();
        limit = $("#limit").val();

        let icon = $("#icon_hold").val();
        let table =
          '<div class="holding-table"><table border="1" class="table  bg-white table-bordered"> ';
        table += '<tr class="bg-blue" style="whitespace:nowrap;">';
        table += `<th class="srno text-center">Sr.NO</th>`;
        table += '<th class="action text-center">Action</th>';
        table += `<th onclick="userData()" class="name sort border">Name <i class="bi ${icon}" id="sort_icon"></i></th>`;
        table += `<th onclick="userData()" class="phone sort border">Phone <i class="bi ${icon}" id="sort_icon"></i></th>`;
        table += `<th onclick="userData()" class="email sort">Email <i class="bi ${icon}" id="sort_icon"></i></th>`;
        table += '<th class="status text-center">Status</th>';
        table += "</tr>";
        total_pages = data.total_page;
        total_records = data.total_record;
        data.data.forEach(function (value, index) {
          ind = index + 1;
          index = (page - 1) * limit + ind;
          table += '<tr class="data" style="height:40px;whitespace:nowrap;">';

          table += `<td class='text-muted text-center' >${index}</td>`;
          table += `<td class='text-muted text-center d-flex ps-5'>
        
         <ul class="nav me-2" id="nav-tab" role="tablist">


        <li class="nav-item " role="presentation">
           <button class='update btn btn-sm rounded-pill btn-outline-primary border border-0'  id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" name='update' type="button" role="tab" data-uid='${value["id"]}'  aria-controls="pills-profile" aria-selected="true"  value='update'><i class='bi bi-pencil-square'>
                </i></button>
        </li></ul>
                
                  
        <button class='btn btn-sm rounded-pill  btn-outline-danger border border-0' name='delete' data-did='${value["id"]}'  id='delete' value='delete'>
        <i class='bi bi-trash3'></i></button>
                
                
                </td>`;
          table += `<td class='text-success'>${value["name"]}</td>`;
          table += `<td class='text-muted'>${value["phone"]}</td>`;
          table += `<td class=''>${value["email"]}</td>`;
          if (value["STATUS"] == 1) {
            var btn_stat = "status-btn-green";
            var status = "ACTIVE";
          } else {
            var btn_stat = "status-btn-red";
            var status = "INACTIVE";
          }
          table += `<td class='text-muted text-center'><button id='' class='btn w-100 btn-sm ${btn_stat}'>${status}</button></td>`;

          table += "</tr>";
        });

        table += "</table></div>";
        table += '<hr><div class=" w-100 p-2 px-auto   d-flex justify-center">';
        table += '<ul class="pagination ms-5 ms-auto ">';

        if (page <= 1) {
          table +=
            ' <li class="page-item disabled"><a class="page-link">Previous</a></li>';
        } else if (page > 1) {
          table +=
            "<li class='page-item'><button class='page-link' id='back'>Previous</button></li>";
        }
        if (total_records >= limit) {
          for (i = 1; i <= total_pages; i++) {
            if (i <= 1) {
              table += `<li class="page-item"><a class="page-link" id='${page}' href="#">${page}</a></li>`;
            } else {
              continue;
            }
          }
        }
        if (page < total_pages) {
          table +=
            '<li class="page-item"><button class="page-link" id="forward" href="#">Next</button></li>';
        } else if ((page = total_pages)) {
          table +=
            '<li class="page-item disabled"><a class="page-link" href="#">Next</a></li>';
        }
        table += "</ul>";
        table += `<b class='on_page text-secondary mt-2 ms-auto'> Pages : ${page} / ${data.total_page} </b>`;
        table += `<b class='on_page mt-2 mx-auto text-secondary'> Total Records : ${total_records} </b>`;

        table += "</div>";
        $("#load_users").html(table);
      }
    },
  });
}

$(document).on("click", "#pagination a", function (e) {
  e.preventDefault();

  var limit = $("#limit").val();

  var page = $(this).attr("id");
  userData(page, limit);
  $("#invis").val(page);
});

////////////back button<<<<<<<<<<

$(document).on("click", "#back", function (e) {
  e.preventDefault();

  var limit = $("#limit").val();
  var page = $("#invis").val();
  var page = Number(page) - 1;
  $("#invis").val(page);

  userData(page, limit);
});

/////////////////forward button>>>>>>>>>>>>

$(document).on("click", "#forward", function (e) {
  e.preventDefault();

  var limit = $("#limit").val();
  var page = $("#invis").val();
  var page = Number(page) + 1;
  $("#invis").val(page);
  userData(page, limit);
});

function limitData() {
  $("#invis").val(1);

  var page = $("#invis").val();
  userData(Number(page));
}

window.addEventListener("load", () => {
  const path = window.location.pathname;
  const locate = path.replace(/\/$/, "").split("/").pop();
  if (locate.trim() == "user_master.php") {
    userData();
  }
});

function resetUserForm() {
  $(".add_usr").html("ADD USER");
  $(".name_valid").hide();
  $(".number_valid").hide();
  $(".pass_valid").hide();
  $(".email_valid").hide();
  $(".password").html(
    'User Password :\
                            <input type="password" title="PASSWORD" autocomplete="off" id="user_pass" placeholder="User Password" name="user_pass" class="form-control  border ">\
                            <div class="pass_valid" class="text-danger mb-3 "></div>',
  );
  $(".updBtn").html(
    '<input type="button" value="SAVE" id="save_user" class="save btn-outline-primary   btn my-3" onclick="insertUser()">\
                            <input type="reset" value="RESET" class="reset_insert  btn btn-outline-danger">',
  );
  $("#add_user").trigger("reset");
}

function insertUser() {
  let user_name = $("#user_name").val() ?? "";
  if (!validName(user_name)) {
    return;
  }
  let user_pass = $("#user_pass").val() ?? "";
  if (!validPass(user_pass)) {
    return;
  }
  let user_number = $("#user_number").val() ?? "";
  if (!validNumber(user_number.toString())) {
    return;
  }
  let user_email = $("#user_email").val() ?? "";
  if (!validEmail(user_email.toString())) {
    return;
  }
  let save_user = $("#save_user").val();
  $.ajax({
    url: "/project/usercontroller/",
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
        window.location.href = "/project/usermaster/";
        $("#add_user").trigger("reset");
        userData();
      } else {
        $(".email_valid").show();
        $(".email_valid").text("email already exist").css("color", "blue");
      }
    },
  });
}
//////////////////////update
$(document).on("click", ".update", function () {
  $("#pills-profile-tab").tab("show");
  $(".add_usr").html("EDIT USER");
  let id = $(this).data("uid");
  let update = $(".update").val();
  $.ajax({
    url: "/project/usercontroller/",
    type: "POST",
    data: {
      id: id,
      update: update,
    },
    success: function (data) {
      data = JSON.parse(data);
      console.log(data);
      data.data.forEach(function (value) {
        $(".userId").val(`${value["id"]}`);
        $("#user_name").val(`${value["name"]}`);
        $("#user_number").val(`${value["phone"]}`);
        $("#user_email").val(`${value["email"]}`);
        if (value["STATUS"] == 1) {
          var status = "ACTIVE";
        } else {
          var status = "INACTIVE";
        }
        $(".password")
          .html(`Status<select id='user_status' class='form-select mb-5' value='${value["STATUS"]}'>
          
          <option value='${value["STATUS"]}'>${status}</option>
          
          <option disabled>Select Status</option>
          <option value='1'>ACTIVE</option>
          <option value='0'>INACTIVE</option>
          </select>`);
      });
      $(".updBtn").html(
        "<input type='button' onclick='userData()' class='btn btn-outline-primary' id='edit' value='EDIT'>\
        <input type='reset' value='RESET' class='btn btn-outline-danger'>",
      );
    },
  });
});

$(document).on("click", "#edit", function (e) {
  e.preventDefault();
  let id = $(".userId").val() ?? "";
  if (id.trim() == "") {
    Swal.fire({
      title: "Error?",
      text: "User Not Found?",
      icon: "question",
    });
    return false;
  }
  let user_name = $("#user_name").val() ?? "";
  if (!validName(user_name)) {
    return;
  }
  let user_number = $("#user_number").val() ?? "";
  if (!validNumber(user_number)) {
    return;
  }
  let user_email = $("#user_email").val() ?? "";
  if (!validEmail(user_email)) {
    return;
  }
  let status = $("#user_status").val() ?? "";
  let update_user = $("#edit").val();
  $.ajax({
    url: "/project/usercontroller/",
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
      if (data.trim() == 1) {
        $("#pills-home-tab").tab("show");
        $("#add_user").trigger("reset");
        var page = $("#invis").val();
        userData(page);
      } else {
        $(".email_valid").show();
        $(".email_valid").text("email already exist").css("color", "blue");
      }
    },
  });
});

////////////////delete user //////

$(document).on("click", "#delete", function (e) {
  var id = $(this).data("did");
  var delet = $("#delete").val();
  Swal.fire({
    title: "Do you want to Delete this User?",
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: "Delete",
    denyButtonText: `Don't Delete`,
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire("Saved!", "", "success");

      var element = this;
      $.ajax({
        url: "/project/usercontroller/",
        type: "POST",
        data: {
          id: id,
          delete: delet,
        },
        success: function (data) {
          var page = $("#invis").val();
          userData(page);
          if (data.trim() == 1) {
            $(element).closest("tr").fadeOut();
          } else {
            alert("unable to delete this data");
          }
        },
      });
    } else if (result.isDenied) {
      Swal.fire("User Not Deleted", "", "info");
    }
  });
});
function searc() {
  var val = 1;
  $("#invis").val(val);
  var page = $("#invis").val();
  userData(Number(page));
}

function resetUsers() {
  $("#search_user").val("");
  var val = 1;
  $("#invis").val(val);
  var page = $("#invis").val();
  userData(Number(page));
}

$(document).on("keyup", "#user_pass", function () {
  insertUser();
});
