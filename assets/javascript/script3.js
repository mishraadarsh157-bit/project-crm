console.log("working");

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
      console.log(data);
      if (data.trim == 1) {
        window.location.href = "/project/itemmaster/";

        loadItems();
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

//////////load

function loadItems() {
  var page = $("#invis_i").val() ?? 1;
  var field = $(".field_i").val() ?? "item_id";
  console.log(field);
  var order = $(".order_i").val() ?? "asc";
  console.log(order);
  var searc = $(".searc_i").val() ?? "";
  console.log(searc);
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
      data = JSON.parse(data);

      table = "<table class='table bg-white table-bordered'>";
      table += "<tr class='bg-blue '>";
      table += "<th class='srno_c'>Sr. NO</th>";
      table += "<th class='action_c'>Action</th>";
      table += "<th class='ps-5'>Item</th>";
      table += "<th>Description</th>";
      table += "<th>Price</th>";
      table += "</tr>";
      page = 1;
      data.data.forEach(function (value, index) {
        ind = index + 1;
        indx = (page - 1) * limit + ind;
        table += `<tr>`;

        table += `<td>${indx}</td>`;
        table += `<td>
        <button class='btn btn-sm rounded-pill btn-outline-primary' name='update_i' data-bs-toggle='modal' data-bs-target='#myModal' data-uid='${value["item_id"]}'  id='update_i' value='update_i'>
                <i class='bi bi-pencil-square'>
                </i></button>
        </td>`;

        table += `<td class='fw-bold'> <img src='/project/${data.data[index]["item_image"]}' height="50px" alt="" class="dynamicImg me-5">   ${value["item_name"]}</td>`;

        table += `<td>${value["description"]}</td>`;
        table += `<td>${value["price"]}</td>`;

        table += `</tr>`;
      });
      table += "</table>";
      /////////////pagination
      //  table += '<hr><div class=" w-100    d-flex justify-center">';
      //           table += '<ul class="pagination_c ms-5 ms-auto d-flex">';

      //           if (page <= 1) {
      //             table +=
      //               ' <li class="page-item disabled"><a class="page-link">Previous</a></li>';
      //           } else if (page > 1) {
      //             table +=
      //               "<li class='page-item'><button class='page-link' id='back_c'>Previous</button></li>";
      //           }
      //           if (total_records >= limit) {
      //             for (i = 1; i <= total_pages; i++) {
      //               if (i <= 1) {
      //                 table += `<li class="page-item"><a class="page-link" id='${page}' href="#">${page}</a></li>`;
      //               } else {
      //                 continue;
      //               }
      //             }
      //           }
      //           if (page < total_pages) {
      //             table +=
      //               '<li class="page-item"><button class="page-link" id="forward_c" href="#">Next</button></li>';
      //           } else if ((page = total_pages)) {
      //             table +=
      //               '<li class="page-item disabled"><a class="page-link" href="#">Next</a></li>';
      //           }
      //           table += "</ul>";
      //           table += `<b class='on_page text-secondary mt-2 ms-auto'> Pages : ${page} / ${total_pages} </b>`;
      //           table += `<b class='on_page mt-2 mx-auto text-secondary'> Total Records : ${total_records} </b>`;

      //           table += "</div>";

      $("#load_Items").html(table);
    },
  });
}

function limitItem() {
  $("#invis_i").val(1);
  var page = $("#invis_i").val();
  loadItems(Number(page));
}
if (window.location.href == "http://localhost/project/itemmaster/") {
  loadItems();
}


///////////update
$(document).on("click", "#update_i", function () {
  let id = $(this).data("uid");
  let update = $("#update_i").val();
  $.ajax({
    url: "/project/itemcontroller/",
    type: "POST",
    data: {
      id: id,
      update: update,
    },
    success: function (data) {
      data = JSON.parse(data);
      data.data.forEach(function (value) {
        table = `<input type="text" name='id'  class="form-control mb-5" value="${value[0]}">`;
        table += `<input type="text" name='item_name' class="form-control mb-5" value="${value[1]}">`;
        table += `<input type="text" name='des' class="form-control mb-5" value="${value[2]}">`;
        table += `<input type="text" name='price' class="form-control mb-5" value="${value[3]}">`;
        table += `<input type="file" onchange='itmUpImg(event)' name='itemUpImage' class="itemUpImage form-control mb-2" value="">`;
        table += `<img src='/project/${value[4]}' height='30px' class='upimg mb-5'>`;
        
        table += `<input type="text" class="form-control mb-2" hidden name='updateItem' value="updateItm">`;
        table += `<input type="button" onclick='updateItm()' class="btn btn-outline-primary w-100 mb-2" value="Save">`;
      });
      
      $(".update_item_form").html(table);
    },
  });
});

function itmUpImg(event) {
  const imgPrieview = $(".itemUpImage");
  const files = event.target.files;
  if (files.length > 0) {
    const file = files[0];
    const tempUrl = URL.createObjectURL(file);
    console.log(tempUrl)
    $(".upimg").attr("src", tempUrl);
    imgPrieview.onload = function () {
      URL.revokeObjectURL(this.src);
    };
  }
}


function updateItm() {
  var fd = new FormData(update_Item_Form);
  console.log(fd);
  $.ajax({
    url: "/project/itemcontroller/",
    type: "POST",
    data: fd,
    processData: false,
    contentType: false,
    success: function (data) {
      console.log(data);
      if(data.trim()==1){
          $("#myModal").hide()
        loadItems()
      }
    },
  });
}
//////delete
