////////////////////////////////////client master

// load select states into form////

function loadStates() {
  $.ajax({
    url: "/project/clientcontroller/",
    type: "POST",
    data: {
      states: "states",
    },
    success: function (data) {
      $("#loadState").html(data);
    },
  });
}

function loadedState() {
  var state = $("#select_state").val();
  loadCity(state);
}

function loadCity(state) {
  console.log(state);
  $.ajax({
    url: "/project/clientcontroller/",
    type: "POST",
    data: {
      city: "city",
      state: state,
    },
    success: function (data) {
      $("#loadCity").html(data);
    },
  });
}

function insertClient() {
  let client_name = $("#client_name_c").val();
  console.log(client_name);
  if (!validName(client_name)) {
    return;
  }

  let client_number = $("#client_number").val();
  if (!validNumber(String(client_number))) {
    return;
  }
  let client_email = $("#client_email_c").val();
  if (!validEmail(client_email)) {
    return;
  }
  let client_address = $("#client_address").val();
  if (!validAddress(client_address)) {
    return;
  }

  let client_state = $("#select_state").val();

  let client_city = $("#select_city").val();

  let client_pincode = $("#client_pincode").val();
  if (!validPincode(client_pincode)) {
    return;
  }

  let insert_client = $("#insert_client").val();

  $.ajax({
    url: "/project/clientcontroller/",
    type: "POST",
    data: {
      client_name: client_name,
      client_phone: client_number,
      client_email: client_email,
      client_address: client_address,
      client_city: client_city,
      client_state: client_state,
      client_pincode: client_pincode,
      insert_client: insert_client,
    },
    success: function (data) {
      if (data.trim() == 1) {
        console.log(data);
        window.location.href = "/project/clientmaster/";
        $("#add_client").trigger("reset");
      } else {
        console.log(data);
        console.log("error");
      }
    },
  });
}

/////sorting/////

$(document).on("click", ".sort_c", function () {
  var value = $(this).attr("id");
  $(".field_c").val(value);
});
$(document).on("click", ".sort_c", function () {
  $(".order_c").val($(".order_c").val() === "asc" ? "desc" : "asc");

  $("#icon_hold_c").val(
    $("#icon_hold_c").val() === "bi-arrow-up" ? "bi-arrow-down" : "bi-arrow-up",
  );
});

$(document).on("click", ".sort", function () {});

/////////////////////first load table using json
function clientData(page) {
  // debugger
  try {
    var field = $(".field_c").val() ?? "client_id";
    var order = $(".order_c").val() ?? "asc";
    var searc = $(".searc_c").val() ?? "";
    var status_c = $("#status_c").val() ?? "";
    var limit = $("#limit_c").val() ?? 5;
    var limit = Number(limit);
    $.ajax({
      url: "/project/clientcontroller/",
      type: "POST",
      data: {
        page_no: page,
        searc: searc,
        status: status_c,
        limit: limit,
        field: field,
        order: order,
        page_name: "clientPage",
      },
      success: function (data) {
        // console.log(data);
        if (data.trim() == "empty") {
          let icon = $("#icon_hold_c").val();
          let table =
            '<div class="holding-table"><table class="table table-bordered bg-white"> ';
          table += '<tr class="bg-blue" style="whitespace:nowrap;">';
          table += "<th class='srno_c'>SR.NO</th>";
          table += '<th class="action_c text-center">Action</th>';
          table += `<th onclick='clientData()' id='client_name' class='sort_c name_c'>Name <i class="bi ${icon}"></i></th>`;
          table += `<th onclick='clientData()' id='phone' class='sort_c phone_c'>Phone <i class="bi ${icon}"></i></th>`;
          table += `<th onclick='clientData()' id='client_email' class='sort_c email_c'>Email <i class="bi ${icon}"></i></th>`;
          table += '<th class="address_c">Address</th>';
          table += '<th class="pincode_c">Pincode</th>';
          table += '<th class="status_c text-center">Status</th>';
          table += "</tr>";
          table += "<tr>";
          table +=
            '<th colspan="9" class="text-center"><h1>NO CLIENT FOUND</h1></th>';
          table += "</tr></table>";
          $("#load_clients").html(table);
        } else {
          data = JSON.parse(data);
          page = $("#invis_c").val();
          limit = $("#limit_c").val();
          let icon = $("#icon_hold_c").val();
          let table =
            '<div class="holding-table"><table class="table table-bordered bg-white"> ';
          table += '<tr class="bg-blue" style="whitespace:nowrap;">';
          table += "<th class='srno_c'>SR.NO</th>";
          table += '<th class="action_c text-center">Action</th>';
          table += `<th onclick='clientData()' id='client_name' class='sort_c name_c'>Name <i class="bi ${icon}"></i></th>`;
          table += `<th onclick='clientData()' id='phone' class='sort_c phone_c'>Phone <i class="bi ${icon}"></i></th>`;
          table += `<th onclick='clientData()' id='client_email' class='sort_c email_c'>Email <i class="bi ${icon}"></i></th>`;
          table += '<th class="address_c">Address</th>';
          table += '<th class="pincode_c">Pincode</th>';
          table += '<th class="status_c text-center">Status</th>';
          table += "</tr>";
          total_pages = data.total_page;
          total_records = data.total_record;
          data.data.forEach(function (value, index) {
            ind = index + 1;
            index = (page - 1) * limit + ind;
            table += '<tr style="height:40px;whitespace:nowrap;">';
            table += `<td class='text-muted text-center'>${index}</td>`;

            table += `<td class='text-muted text-center   '>
        
        <button class='btn btn-sm rounded-pill btn-outline-primary' name='update' data-bs-toggle='modal' data-bs-target='#myModal' data-uid='${value["client_id"]}'  id='update_c' value='update_c'>
                <i class='bi bi-pencil-square'>
                </i></button>
                
                
        <button class='btn btn-sm rounded-pill  btn-outline-danger' name='delete' data-did='${value["client_id"]}'  id='delete_c' value='delete'>
        <i class='bi bi-trash3'></i></button>
                
                
                </td>`;
            table += `<td class='text-success'>${value["client_name"]}</td>`;
            table += `<td class='text-muted'>${value["phone"]}</td>`;
            table += `<td class=''>${value["client_email"]}</td>`;
            table += `<td class='text-muted'>${value["address"]} , ${value["city"]} (${value["name"]})</td>`;
            table += `<td class='text-muted'>${value["pincode"]}</td>`;
            if (value["client_status"] == 1) {
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
          table += '<hr><div class=" w-100    d-flex justify-center">';
          table += '<ul class="pagination_c ms-5 ms-auto d-flex">';

          if (page <= 1) {
            table +=
              ' <li class="page-item disabled"><a class="page-link">Previous</a></li>';
          } else if (page > 1) {
            table +=
              "<li class='page-item'><button class='page-link' id='back_c'>Previous</button></li>";
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
              '<li class="page-item"><button class="page-link" id="forward_c" href="#">Next</button></li>';
          } else if ((page = total_pages)) {
            table +=
              '<li class="page-item disabled"><a class="page-link" href="#">Next</a></li>';
          }
          table += "</ul>";
          table += `<b class='on_page text-secondary mt-2 ms-auto'> Pages : ${page} / ${total_pages} </b>`;
          table += `<b class='on_page mt-2 mx-auto text-secondary'> Total Records : ${total_records} </b>`;

          table += "</div>";
          $("#load_clients").html(table);
        }
      },
    });
  } catch (response) {
    console.log(response + "this is a error");
  }
}
clientData();

/////update form load //////

////////pagination//

$(document).on("click", "#pagination_c a", function (e) {
  e.preventDefault();

  var limit = $("#limit_c").val();
  var page = $(this).attr("id");
  clientData(page, limit);
  $("#invis_c").val(page);
});

////////////back button<<<<<<<<<<

$(document).on("click", "#back_c", function (e) {
  e.preventDefault();

  var page = $("#invis_c").val();
  var page = Number(page) - 1;
  $("#invis_c").val(page);

  clientData(page);
});

/////////////////forward button>>>>>>>>>>>>

$(document).on("click", "#forward_c", function (e) {
  e.preventDefault();

  var page = $("#invis_c").val();
  var page = Number(page) + 1;
  $("#invis_c").val(page);
  clientData(page);
});

function limitData_c() {
  $("#invis_c").val(1);
  var page = $("#invis_c").val();
  clientData(Number(page));
}

// window.addEventListener("load", () => {
//   const path = window.location.pathname;
//   const locate = path.replace(/\/$/, "").split("/").pop();
//   if (locate.trim() == "client_master.php") {
//     clientData();
//   }
// });

$(document).on("click", "#update_c", async function () {
  let id = $(this).data("uid");
  let update_c = $("#update_c").val();
  $.ajax({
    url: "/project/clientcontroller/",
    type: "POST",
    data: {
      id: id,
      update_c: update_c,
    },
    success: function (data) {
      data = JSON.parse(data);
      // console.log(data, "clientdata");
      let table = "";

      data.forEach(async function (value) {
        table += `<div class='row'><input type='text' hidden id='updId'  value='${value[0]}'>`;

        table += `<div class='col-12'><input type='text' placeholder='name'  id='client_name_up' class='form-control form-control-sm mb-3' value='${value[1]}' required><div id='name_valid' class='text-danger mb-3 ''></div>`;

        table += `</div><div class='col-6'><input type='text' placeholder='name'  id='client_number_up' class='form-control form-control-sm mb-3' value='${value[2]}' required><div id='name_valid' class='text-danger mb-3 ''></div>`;

        table += `</div><div class='col-6'><input type='text' placeholder='name'  id='client_email_up' class='form-control form-control-sm mb-3' value='${value[3]}' required><div id='name_valid' class='text-danger mb-3 ''></div>`;

        table += `</div><div class='col-12'><input type='text' placeholder='name'  id='client_address_up' class='form-control form-control-sm mb-3' value='${value[4]}' required><div id='name_valid' class='text-danger mb-3 ''></div>`;
        table += `</div><div class='col-4 mb-3'  id='states_up'>`;
        table += `</div><div class='col-4' id='cities_up'></select>`;

        table += `</div><div class='col-4'><input type='text' placeholder='name'  id='client_pincode_up' class='form-control form-control-sm mb-3' value='${value[7]}' required><div id='name_valid' class='text-danger mb-3 ''></div>`;
        if (value[8] == 1) {
          text = "ACTIVE";
        } else {
          text = "INACTIVE";
        }
        table += `</div><div class='col-6 mb-5'><select class='form-select form-select-sm' id='status_up'  value='${value[8]}' >
        <option value='${value[8]}'>${text}</option>
        <option value='' disabled>Select Status</option>
        <option value='ACTIVE'>ACTIVE</option>
        <option value='INACTIVE'>INACTIVE</option>
        </select></div>`;

        table +=
          "</div><hr><div class='col-4'><input type='button' class='btn btn-outline-primary me-2' onclick='updateClient()' id='update_client' value='SAVE'><input type='reset' class='btn btn-outline-danger' value='RESET'></div>";

        await $.ajax({
          url: "/project/clientcontroller/",
          type: "POST",
          data: {
            states: "states",
          },
          success: function (data) {
            $("#states_up").html(data);
          },
        });

        // console.log(data,"d");

        $("#select_state").val(Number(data[0].state_id));
        state = $("#select_state").val();
        // console.log(state,"hhh")
      await  loadCity(Number(state));

        // $("#select_state").on("", function () {

        // });
        
      $("#select_city").val(Number(data[0].city_id));
      $("#select_city").val();  
        async function loadCity(state) {
          await $.ajax({
            url: "/project/clientcontroller/",
            type: "POST",
            data: {
              city: "city",
              state: state,
            },
            success: function (data) {
              // console.log(data);

              $("#cities_up").html(data);
            },
          });
        }
      });

      $(".update_client_form").html(table);
    },
  });
});

function updateClient() {
  let id = $("#updId").val();
  let client_name = $("#client_name_up").val();
  validName(client_name);

  let client_number = $("#client_number_up").val();
  // validNumber(String(client_number));
  let client_email = $("#client_email_up").val();
  validEmail(client_email);
  let client_address = $("#client_address_up").val();
  validAddress(client_address);

  let client_state = $("#select_state").val();

  let client_city = $("#cities_up #select_city").val();
  console.log("not");
  console.log(client_city);
  let client_pincode = $("#client_pincode_up").val();
  validPincode(client_pincode);
  let client_status = $("#status_up").val();
  let update_client = $("#update_client").val();

  $.ajax({
    url: "/project/clientcontroller/",
    type: "POST",
    data: {
      id: id,
      client_name: client_name,
      client_phone: client_number,
      client_email: client_email,
      client_address: client_address,
      client_city: client_city,
      client_state: client_state,
      client_pincode: client_pincode,
      client_status: client_status,
      update_client: update_client,
    },
    success: function (data) {
      if (data.trim() == 1) {
        console.log(data);
        var page = $("#invis_c").val();
        clientData(Number(page));
        $("#myModal").hide();
      } else {
        console.log(data);
        console.log("error");
      }
    },
  });
}

///////delete client

$(document).on("click", "#delete_c", function () {
  var id = $(this).data("did");
  const isConfirm = confirm(
    "do you really want to delete data for client id " + id,
  );
  if (isConfirm) {
    var element = this;
    $.ajax({
      url: "/project/clientcontroller/",
      type: "POST",
      data: {
        id: id,
        delete: "deleteClient",
      },
      success: function (data) {
        if (data.trim() == 1) {
          $(element).closest("tr").fadeOut();
          var page = $("#invis_c").val();
          clientData(Number(page));
        } else {
          console.log(data);
        }
      },
    });
  } else {
    clientData();
  }
});

function searc_c() {
  var val = 1;
  $("#invis_c").val(val);
  var page = $("#invis_c").val();
  clientData(Number(page));
}
