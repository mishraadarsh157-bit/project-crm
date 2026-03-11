function fetchClientData() {
  var name = $(".client-name-invoice").val();
  $.ajax({
    url: "/project/invoiceController/",
    type: "POST",
    data: {
      client_name: name.trim(),
    },
    success: function (data) {
      if (data.trim() == "empty") {
        $(".client-email-invoice").val("no data").css("color", "red");
        $(".client-phone-invoice").val("no data").css("color", "red");
      } else {
        data = JSON.parse(data);
        data.data.forEach(function (value) {
          $(".client-email-invoice")
            .val(`${value["client_email"]}`)
            .css("color", "black");
          $(".client-phone-invoice")
            .val(`${value["phone"]}`)
            .css("color", "black");
        });
      }
    },
  });
}

function fetchItemData() {
  var name = $(".item-name-invoice").val();
  $.ajax({
    url: "/project/invoiceController/",
    type: "POST",
    data: {
      item_name: name.trim(),
    },
    success: function (data) {
      if (data.trim() == "empty") {
        $(".item-price-invoice").val("no data").css("color", "red");
        $(".total-amount-invoice").val("no data").css("color", "red");
      } else {
        data = JSON.parse(data);
        data.data.forEach(function (value) {
          $(".item-price-invoice")
            .val(`${value["price"]}`)
            .css("color", "black");
          $(".total-amount-invoice")
            .val(`${value["price"]}`)
            .css("color", "black");
        });
      }
    },
  });
}

function addQty() {
  var amount = $(".item-price-invoice").val();
  var total = $(".total-amount-invoice").val();
  var addedAmt = Number(amount) + Number(total);
  $(".total-amount-invoice").val(addedAmt);
  var qty = Number($(".item-quantity-invoice").val()) + 1;
  $(".item-quantity-invoice").val(Number(qty));
}
function subQty() {
  var amount = $(".item-price-invoice").val();
  var total = $(".total-amount-invoice").val();
  if (total > 0) {
    var subAmt = Number(total) - Number(amount);
    $(".total-amount-invoice").val(subAmt);

    var qty = Number($(".item-quantity-invoice").val()) - 1;
    $(".item-quantity-invoice").val(Number(qty));
  }
}

function addMore(){
  var row ='<table class="table"><tr>'
row +='<td>Item Name <sup class="text-danger">*</sup><input type="text" onchange="fetchItemData()" class="item-name-invoice form-control mb-3" placeholder="Item Name"></td>\
<td>Item Price<input disabled type="text" class="item-price-invoice form-control mb-3 bg-white" placeholder="Item Price"></td>\
<div class="col-4 d-flex align-item-center">\
  <td class="d-flex"><button class="btn btn-sm" type="button" onclick="subQty()">\
    <i class="bi bi-dash-lg"></i></button>\
    <input disabled type="number" class="item-quantity-invoice  bg-white  border border-0" value="1">\
    <button class="btn  btn-sm" type="button" onclick="addQty()"><i class="bi bi-plus-lg"></i></button></td>\
    <td><button type="button" class="removeForm btn btn-outline-danger">X</button></div></td></tr></table>\
'

$('.loadmoreForm').append(row);
}

$(document).on('click','.removeForm',function(){
  console.log('remove')
  $(this).closest('tr').remove()
})



function insertInvoice() {} /////////////////////////////////////////////////


$(document).on("click", ".sort_iv", function () {
  var value = $(this).attr("id");
  $(".field_iv").val(value);
    $("#invis_iv").val(1);
  var page = $("#invis_iv").val();
  invoiceData(Number(page));
});
$(document).on("click", ".sort_iv", function () {
  $(".order_iv").val($(".order_iv").val() === "asc" ? "desc" : "asc");

  $("#icon_hold_iv").val(
    $("#icon_hold_iv").val() === "bi-arrow-up" ? "bi-arrow-down" : "bi-arrow-up",
  );
});


function invoiceData(page) {
  var field = $(".field_iv").val() ?? "invoiceID";
  var order = $(".order_iv").val() ?? "asc";
  var searc = $(".searc_iv").val() ?? "";
  var limit = $("#limit_iv").val() ?? 5;

  $.ajax({
    url: "/project/invoiceController/",
    type: "POST",
    data: {
      page: page,
      search: searc,
      field: field,
      order: order,
      limit: limit,
      invoice: "invoice",
    },
    success: function (data) {
        if (data.trim() == "empty") {
            var table =
            "<div class='holding-table border'><table class='table table-bordered   '>";
            table += "<tr class='bg-blue'>";
            table += "<th class='text-center'>Sr.No</th>";
            table += "<th class='text-center'>Action</th>";

        table += `<th id='invoiceID' class='sort_iv text-center'>Invoice</th>`;

        table += `<th id='client_name' class='sort_iv'>Client Name</th>`;

        table += `<th id='item_name' class='sort_iv'>Item Name</th>`;

        table += `<th id='itemPrice' class='sort_iv text-center'>Price</th>`;

        table += `<th id='quantity' class='sort_iv text-center'>Quantity</th>`;

        table += `<th id='issueTime' class='sort_iv'>Issue Date</th>`;

        table += `<th id='total' class='sort_iv text-center'>Total</th>`;

        table += "</tr>";
        table += "<tr>";
        table += "<td colspan='9' align='center'><h1>NO DATA FOUND</h1>";
        table += "</td>";
        table += "</tr>";
        table += "</table>";
        
        $(".loadInvoice").html(table);
      } else {
        data = JSON.parse(data);
        var limit = $("#limit_iv").val();
        var page = $("#invis_iv").val();

        let icon = $("#icon_hold_iv").val();
        var table =
          "<div class='holding-table border'><table class='table table-bordered   '>";
        table += "<tr class='bg-blue'>";
        table += "<th class='text-center'>Sr.No</th>";
            table += "<th class='text-center'>Action</th>";
        table += `<th id='invoiceID' class='sort_iv text-center'>Invoice <i class="bi ${icon}"></i></th>`;

        table += `<th id='client_name' class='sort_iv'>Client Name <i class="bi ${icon}"></i></th>`;

        table += `<th id='item_name' class='sort_iv'>Item Name <i class="bi ${icon}"></i></th>`;

        table += `<th id='itemPrice'  class='sort_iv text-center'>Price <i class="bi ${icon}"></i></th>`;

        table += `<th id='quantity' class='sort_iv text-center'>Quantity <i class="bi ${icon}"></i></th>`;

        table += `<th id='issueTim  e' class='sort_iv'>Issue Date <i class="bi ${icon}"></i></th>`;

        table += `<th id='total' class='sort_iv text-center'>Total <i class="bi ${icon}"></i></th>`;
        table += "</tr>";
        total_pages = data.total_page;
        total_records = data.total_record;
        data.data.forEach(function (value, index) {
          ind = index + 1;
          index = (page - 1) * limit + ind;
          table += `<tr><td class='text-center'>${index }</td>`;
          table += `<td class='text-muted text-center   '>
        
        <button class='btn btn-sm rounded-pill btn-outline-primary border border-0x' name='update' data-bs-toggle='modal' data-bs-target='#myModal' data-uid='${value["client_id"]}'  id='update_iv' value='update_iv'>
                <i class='bi bi-pencil-square'>
                </i></button>
                
                
        <button class='btn btn-sm rounded-pill  btn-outline-danger border border-0x' name='delete' data-did='${value["client_id"]}'  id='delete_iv' value='delete'>
        <i class='bi bi-trash3'></i></button>
                
                <button class='btn btn-sm rounded-pill btn-outline-info border border-0x'><i class="bi bi-envelope-paper"></i></button>
                <button class='btn btn-sm rounded-pill btn-outline-success border border-0x'><i class="bi bi-filetype-pdf"></i></button>
                </td>`;
          table += `<td class="text-info text-center">#${value["invoiceID"]}</td>`;
          table += `<td class="text-success">${value["client_name"]}</td>`;
          table += `<td class="text-danger">${value["item_name"]}</td>`;
          table += `<td class='text-center'>₹ ${value["itemPrice"]}</td>`;
          table += `<td class='text-center'>${value["quantity"]}</td>`;
          table += `<td>${value["issueTime"]}</td>`;
          table += `<td class='text-center'>₹ ${value["total"]}</td>`;
          table += "</tr>";
        });
        table += "</table></div>";

        table += "<div class='pagination pt-3 w-100'>";
        table += '<ul class="pagination_iv ms-5 ms-auto d-flex">';
        if (page <= 1) {
          table +=
            ' <li class="page-item disabled"><a class="page-link">Previous</a></li>';
        } else if (page > 1) {
          table +=
            "<li class='page-item'><button class='page-link' id='back_iv'>Previous</button></li>";
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
              '<li class="page-item"><button class="page-link" id="forward_iv" href="#">Next</button></li>';
          } else if ((page = total_pages)) {
            table +=
              '<li class="page-item disabled"><a class="page-link" href="#">Next</a></li>';
          }
          table += "</ul>";
     
        table += `<b class='on_page text-secondary mt-2 ms-auto'> Pages : ${page} / ${total_pages} </b>`;
        table += `<b class='on_page mt-2 mx-auto text-secondary'> Total Records : ${total_records} </b>`;

        table += "</div>";

        $(".loadInvoice").html(table);
      }
    },
  });
}



$(document).on("click", "#pagination_iv a", function (e) {
  e.preventDefault();

  var limit = $("#limit_iv").val();
  var page = $(this).attr("id");
  invoiceData(page, limit);
  $("#invis_iv").val(page);
});

////////////back button<<<<<<<<<<

$(document).on("click", "#back_iv", function (e) {
  e.preventDefault();

  var page = $("#invis_iv").val();
  var page = Number(page) - 1;
  $("#invis_iv").val(page);

  invoiceData(page);
});

/////////////////forward button>>>>>>>>>>>>

$(document).on("click", "#forward_iv", function (e) {
  e.preventDefault();

  var page = $("#invis_iv").val();
  var page = Number(page) + 1;
  $("#invis_iv").val(page);
  invoiceData(page);
});

function limitData_iv() {
  $("#invis_iv").val(1);
  var page = $("#invis_iv").val();
  invoiceData(Number(page));
}
function searc_iv() {
  var val = 1;
  $("#invis_iv").val(val);
  var page = $("#invis_iv").val();
  invoiceData(Number(page));
}
function resetinvoice(){
  $('.searc_iv').val('')
  var val = 1;
  $("#invis_iv").val(val);
  var page = $("#invis_iv").val();
  invoiceData(Number(page));    
}



if (window.location.href.trim() == "http://localhost/project/invoice/") {
  invoiceData();
}
