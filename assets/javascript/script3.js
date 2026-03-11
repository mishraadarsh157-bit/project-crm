
///////insert

function insertItem() {
  // const form=$('#itemInsertForm')
  var fd = new FormData(itemInsertForm);
  console.log(fd);
  $.ajax({
    url: "/project/itemcontroller/",
    type: "POST",
    data: fd,
    processData: false,
    contentType: false,
    success: function (data) {
      if (data.trim() == 1) {
        $("#itemInsertForm").trigger("reset");
        window.location.href = "/project/itemmaster/";
        loadItems();
      } else {
        $(".valid_item").text(data);
      }
    },
  });
}

function itmImg(event) {
  const imgPrieview = $(".itemImage");
  const files = event.target.files;
  if (files.length > 0) {
    const file = files[0];
    const tempUrl = URL.createObjectURL(file);
    $(".itemImage").attr("src", tempUrl);
    imgPrieview.onload = function () {
      URL.revokeObjectURL(this.src);
    };
  }
}

////////////////order by

$(document).on("click", ".sort_i", function () {
  var value = $(this).attr("id");
  $(".field_i").val(value);

  $("#invis_i").val(1);
  var page = $("#invis_i").val();
  loadItems(Number(page));
});
$(document).on("click", ".sort_i", function () {
  $(".order_i").val($(".order_i").val() === "asc" ? "desc" : "asc");

  $("#icon_hold_i").val(
    $("#icon_hold_i").val() === "bi-arrow-up" ? "bi-arrow-down" : "bi-arrow-up",
  );
});
//////////load

function loadItems(page) {
  var field = $(".field_i").val() ?? "item_id";
  var order = $(".order_i").val() ?? "asc";
  var searc = $(".searc_i").val() ?? "";
  var limit = $("#limit_i").val() ?? 5;
  var limit = Number(limit);
  $.ajax({
    url: "/project/itemcontroller/",
    type: "POST",
    data: {
      page: page,
      search: searc,
      field: field,
      order: order,
      limit: limit,
      showItems: "showItems",
    },
    success: function (data) {
      if (data.trim() == "empty") {
        limit = $("#limit_i").val();
        var page = $("#invis_i").val();

        let icon = $("#icon_hold_i").val();
        table =
          "<div class='holding-table'><table class='table bg-white table-bordered'>";
        table += "<tr class='bg-blue '>";
        table += "<th class='srno_c'>Sr. NO</th>";
        table += "<th class='action_c text-center'>Action</th>";
        table += `<th  onclick="loadItems()" id="item_name" class='sort_i ps-5'>Item <i class="bi ${icon}"></i></th>`;
        table += "<th>Description</th>";
        table += `<th onclick="loadItems()" id="price" class="sort_i">Price  <i class="bi ${icon}"></i></th>`;
        table += "</tr>";
        table +=
          "<tr><th colspan='5' class='text-center'><h1>NO ITEM FOUND</h1></th></tr></table></div>";
        console.log(data);
        $("#load_Items").html(table);
      } else {
        limit = $("#limit_i").val();
        var page = $("#invis_i").val();

        let icon = $("#icon_hold_i").val();
        table =
          "<div class='holding-table'><table class='table bg-white table-bordered'>";
        table += "<tr class='bg-blue '>";
        table += "<th class='srno_c'>Sr. NO</th>";
        table += "<th class='action_c text-center'>Action</th>";
        table += `<th  onclick="loadItems()" id="item_name" class='sort_i ps-5'>Item <i class="bi ${icon}"></i></th>`;
        table += "<th>Description</th>";
        table += `<th onclick="loadItems()" id="price" class="sort_i">Price  <i class="bi ${icon}"></i></th>`;
        table += "</tr>";
        data = JSON.parse(data);
        total_pages = data.total_page;
        total_records = data.total_record;
        data.data.forEach(function (value, index) {
          ind = index + 1;
          indx = (page - 1) * limit + ind;
          table += `<tr>`;

          table += `<td>${indx}</td>`;
          table += `<td class='text-center d-flex'>
 <ul class="nav me-2" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="update_i nav-link btn btn-sm rounded-pill btn-outline-primary border border-0" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" data-uid='${value["item_id"]}' name='update_i' value='update_i' role="tab" aria-controls="profile-tab-pane" aria-selected="false"><i class='bi bi-pencil-square'>
                </i></button>
        </li>
    </ul>
      
                 <button class='btn btn-sm rounded-pill  btn-outline-danger border border-0' name='delete' data-did='${value["item_id"]}'  id='delete_i' value='delete'>
        <i class='bi bi-trash3'></i></button>
        </td>`;

          table += `<td class='text-success'> <img src='/project/${data.data[index]["item_image"]}' height="50px" alt="" class="dynamicImg me-5">   ${value["item_name"]}</td>`;

          table += `<td class='text-secondary'>${value["description"]}</td>`;
          table += `<td class='text-primary'>₹ ${value["price"]}</td>`;

          table += `</tr>`;
        });
        table += "</table></div>";
        ///////////pagination
        table += '<hr><div class=" w-100    d-flex justify-center">';
        table += '<ul class="pagination_i ms-5 ms-auto d-flex">';

        if (page <= 1) {
          table +=
            ' <li class="page-item disabled"><a class="page-link">Previous</a></li>';
        } else if (page > 1) {
          table +=
            "<li class='page-item'><button class='page-link' id='back_i'>Previous</button></li>";
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
            '<li class="page-item"><button class="page-link" id="forward_i" href="#">Next</button></li>';
        } else if ((page = total_pages)) {
          table +=
            '<li class="page-item disabled"><a class="page-link" href="#">Next</a></li>';
        }
        table += "</ul>";
        table += `<b class='on_page text-secondary mt-2 ms-auto'> Pages : ${page} / ${total_pages} </b>`;
        table += `<b class='on_page mt-2 mx-auto text-secondary'> Total Records : ${total_records} </b>`;

        table += "</div>";

        $("#load_Items").html(table);
      }
    },
  });
}

$(document).on("click", "#pagination_i a", function (e) {
  e.preventDefault();

  var limit = $("#limit_i").val();
  var page = $(this).attr("id");
  $("#invis_i").val(page);
  loadItems(page, limit);
});

////////////back button<<<<<<<<<<

$(document).on("click", "#back_i", function (e) {
  e.preventDefault();

  var page = $("#invis_i").val();
  var page = Number(page) - 1;
  $("#invis_i").val(page);

  loadItems(page);
});

/////////////////forward button>>>>>>>>>>>>

$(document).on("click", "#forward_i", function (e) {
  e.preventDefault();

  var page = $("#invis_i").val();
  var page = Number(page) + 1;
  $("#invis_i").val(page);
  loadItems(page);
});

function limitItem() {
  $("#invis_i").val(1);
  var page = $("#invis_i").val();
  loadItems(Number(page));
}
if (window.location.href == "http://localhost/project/itemmaster/") {
  loadItems();
}

///////////update
$(document).on("click", ".update_i", function () {
  $('#profile-tab').tab('show')
  let id = $(this).data("uid");
  let update = $(".update_i").val();
  $.ajax({
    url: "/project/itemcontroller/",
    type: "POST",
    data: {
      id: id,
      update: update,
    },
    success: function (data) {
      data = JSON.parse(data);
      console.log(data)
      data.data.forEach(function (value) {
        
        $(".item_name").val(value[1]);
        console.log("name value : " ,  $(".item_name").val() )
        $('#item_description').val(value[2])
        $('#item_price').val(value[3])
        $('.itemImage').attr('src',`/project/${value[4]}`)
        $('.updItm').html(`
          <input type='number' name='item_id' value='${value[0]}'>
          <input type="text" name='updateItem' value="updateItm">
          
          `)
          $('.itemSaver').html("<div class='invalid_item text-danger mb-3'> </div>\
            <input type='button' onclick='updateItm()' class='btn btn-outline-primary w-25 me-2' value='Save'> \
            <input type='reset' class='btn btn-outline-danger w-25'>\
            ")
            
          });    
        },
      });
    });
    
function updateItm() {
  var fd = new FormData(itemInsertForm);
  $.ajax({
    url: "/project/itemcontroller/",
    type: "POST",
    data: fd,
    processData: false,
    contentType: false,
    success: function (data) {
      if (data.trim() == 1) {
        $('#home-tab').tab('show')


        $("#itemInsertForm").trigger("reset");
        // window.location.href='http://localhost/project/itemmaster/'
        var page = $("#invis_i").val();
        loadItems(Number(page));
      } else {
        $(".invalid_item").text(data);
      }
    },
  });
}
//////delete
$(document).on("click", "#delete_i", function () {
  var id = $(this).data("did");
  const isConfirm = confirm("do you really want to delete this item ");
  if (isConfirm) {
    var element = this;
    $.ajax({
      url: "/project/itemcontroller/",
      type: "POST",
      data: {
        id: id,
        delete: "delete",
      },
      success: function (data) {
        if (data.trim() == 1) {
          $(element).closest("tr").fadeOut();
          var page = $("#invis_i").val();
          loadItems(Number(page));
        }
      },
    });
  } else {
    loadItems();
  }
});

function searc_i() {
  var val = 1;
  $("#invis_i").val(val);
  var page = $("#invis_i").val();
  loadItems(Number(page));
}

/////reset btn////
////////////////////////////-----------------------------
function resetItems() {

  $(".searc_i").val("");
   $("#invis_i").val(1);
  var page = $("#invis_i").val();
  loadItems(Number(page));

}

function resetImage() {
  $("#item_image").val("");
  $(".itemImage").attr("src", "");
}
