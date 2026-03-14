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
        console.log(data);
        data.data.forEach(function (value) {
          $(".cli_Id").val(value["client_id"]);
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

$(document).on("keyup", ".item-name-invoice", function () {
  $(".itemselect").show();
  $(".item-selected").show();

  let value = $(this).val();
  let row = $(this).closest("tr");
  $.ajax({
    url: "/project/invoiceController/",
    type: "POST",
    data: {
      itemSearch: value,
    },
    success: function (data) {
      if(data.trim()=='empty'){
      let table='no item found'
    row.find(".itemselect").html(table);  
    }
      else{
      data = JSON.parse(data);
      let table =
      "<ul class='item-selected  list-group  bg-white'>";
      data.data.forEach(function (value) {
        table += `<li class='itemvalue list-group-item  list-group-item-action'>${value["item_name"]}</li>`;
        table += "</ul>";
      });
      row.find(".itemselect").html(table);}
    },
  });
});

$(document).on("click", ".itemvalue", function () {
  let itm = $(this).text();
  console.log(itm);
  let row = $(this).closest("tr");
  row.find(".item-name-invoice").val(itm);
  $(".item-selected").hide();
  $(".itemselect").hide();
  fetchItemData();
});

function fetchItemData(inde) {
  let name = $("input[name='itemName[]']")
    .map(function () {
      return this.value;
    })
    .get();
  $.ajax({
    url: "/project/invoiceController/",
    type: "POST",
    data: {
      item_name: name,
    },
    success: function (data) {
      if (data.trim() == "empty") {
        $(".item-price-invoice").val("no data").css("color", "red");
        $(".total-amount-invoice").val("no data").css("color", "red");
      } else {
        data = JSON.parse(data);
        data.forEach(function (value, index) {
          if (value == null) {
          } else {
            $(".item-price-invoice").eq(index).val(value["price"]);
            $(".itm_Id").eq(index).val(value["item_id"]);
            $(".invoice-quantity-invoice").eq(index).val(1);
            $(".rowTotal").eq(index).val(value["price"]);
            let amount = $("input[name='rowTotal[]']")
              .map(function () {
                return this.value;
              })
              .get();
            let total = 0;
            amount.forEach(function (value) {
              total += Number(value);
            });
            $(".total-amount-invoice").val(total);
          }
        });
      }
    },
  });
}

function changeAmt() {
  let price = $("input[name='price[]']")
    .map(function () {
      return this.value;
    })
    .get();
  let quantity = $("input[name='quantity[]']")
    .map(function () {
      return this.value;
    })
    .get();
  let amount = [];
  price.forEach(function (value, index) {
    amount.push(value * quantity[index]);
  });
  amount.forEach(function (value, index) {
    if (value == null) {
    } else {
      $(".rowTotal").eq(index).val(value);
    }
    let total = 0;
    amount.forEach(function (value) {
      total += value;
    });
    $(".total-amount-invoice").val(total);
  });
}

function cutBtn() {
  let row = $(".item-name-invoice").length;
  if (row <= 1) {
    $(".removeForm").prop("disabled", true);
  } else {
    $(".removeForm").removeAttr("disabled");
  }
}
cutBtn();
function addMore() {
  var row = "<tr>";
  row +=
    '<td class="">Item Name <sup class="text-danger">*</sup><input type="text" name="itemName[]" onchange="fetchItemData(this)" class="item-name-invoice form-control" placeholder="Item Name"><div class="itemselect position-absolute "></div></td>\
<td><input type="text" disabled hidden name="itm_id[]" class="itm_Id">  Item Price<input disabled type="text" name="price[]" class="item-price-invoice form-control bg-white" placeholder="Item Price"></td>\
<td>\
Quantity<input  type="number" onchange="changeAmt()" class="item-quantity-invoice form-control" name="quantity[]" bg-white  border border-0" value="1">\
   </td>\
    <td>Amount<input type="number" disabled placeholder="Amount" name="rowTotal[]" class="rowTotal bg-white form-control"></td>\
    <td><button type="button" onclick="changeAmt()" class="removeForm btn btn-outline-danger border border-0">X</button></td></tr>\
    ';
  $(".itemTable").append(row);
  cutBtn();
}

$(document).on("click", ".removeForm", function () {
  console.log("remove");
  $(this).closest("tr").remove();
  changeAmt();
  cutBtn();
});

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
    $("#icon_hold_iv").val() === "bi-arrow-up"
      ? "bi-arrow-down"
      : "bi-arrow-up",
  );
});

function invoiceData(page) {
  var field = $(".field_iv").val() ?? "InvoiceNo";
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
        $(".loadInvoice").html(table);
      } else {
        data = JSON.parse(data);
        var limit = $("#limit_iv").val();
        var page = $("#invis_iv").val();

        let icon = $("#icon_hold_iv").val();
        var table =
          "<div class='holding-table'><table class='table table-bordered'>";
        table += "<tr class='bg-blue'>";
        table += "<td> Sr.No</td>";
        table += "<td> Action</td>";
        table += `<td class='sort_iv' id='InvoiceNo'> Invoice Id <i class='bi ${icon}'></i></td>`;
        table += `<td class='sort_iv' id='InvoiceNo'> Invoice No <i class='bi ${icon}'></i></td>`;
        table += `<td class='sort_iv' id='InvDate'> Date <i class='bi ${icon}'></i></td>`;
        table += `<td class='sort_iv' id='ClientABN'> Client Name <i class='bi ${icon}'></i></td>`;
        table += `<td class='sort_iv' id='client_email'> Email <i class='bi ${icon}'></i></td>`;
        table += `<td class='sort_iv' id='phone'> Phone <i class='bi ${icon}'></i></td>`;

        table += "</tr>";
        total_pages = data.total_page;
        total_records = data.total_record;
        data.data.forEach(function (value, index) {
          ind = index + 1;
          index = (page - 1) * limit + ind;
          table += "<tr>";
          table += `<td>${index}</td>`;
          table += `<td class='d-flex'> <ul class="nav me-2" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button onclick="changeAmt()" class="update_iv nav-link btn btn-sm rounded-pill btn-outline-primary border border-0" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" data-uid='${value["InvoiceNo"]}' name='update_i' value='update_i' role="tab" aria-controls="profile-tab-pane" aria-selected="false"><i class='bi bi-pencil-square'>
                </i></button>
        </li>
    </ul>
    /M/P</td>`;

          table += `<td>${value["InvoiceNo"]}</td>`;
          table += `<td>INV0${value["InvoiceNo"]}</td>`;
          table += `<td>${value["InvDate"]}</td>`;
          table += `<td>${value["client_name"]}</td>`;
          table += `<td>${value["client_email"]}</td>`;
          table += `<td>${value["phone"]}</td>`;
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
function resetinvoice() {
  $(".searc_iv").val("");
  var val = 1;
  $("#invis_iv").val(val);
  var page = $("#invis_iv").val();
  invoiceData(Number(page));
}

if (window.location.href.trim() == "http://localhost/project/invoice/") {
  invoiceData();
}

function loadInvoiceNO() {
  $(".addInvoice").trigger("reset");
  $(".itemTable").html("");
  $.ajax({
    url: "/project/invoiceController/",
    type: "POST",
    data: {
      invoice_No: "invoice_no",
    },
    success: function (data) {
      if (data.trim() == "empty") {
        $(".invoice_id").val(1);
      } else {
        data = JSON.parse(data);
        data.data.forEach(function (value) {
          $(".invoice_id").val(Number(value["InvoiceNo"]) + 1);
        });
        addMore();
      }
    },
  });
}

function addInvoic() {
  
  let invoiceNo = $(".invoice_id").val();
  if ($(".client-email-invoice").val() == "no data") {
    $(".invalidclint").text("enter valid clint name");
    return;
  }
  let client = $(".cli_Id").val();
  if (client == "") {
    $(".invalidclint").text("enter clint name");
    return;
  } else {
    $(".invalidclint").hide();
  }
  let item = $("input[name='itm_id[]']")
    .map(function () {
      return this.value;
    })
    .get();
  console.log(item);
  if (item.some((element) => element == "")) {
    $(".insertall").text("insert proper items");
    return;
  }
  let quantity = $("input[name='quantity[]']").map(function(){
    return this.value;
  }).get();
  console.log(quantity);

  $.ajax({
    url: "/project/invoiceController/",
    type: "POST",
    data: {
      invoiceNo: invoiceNo,
      client: client,
      item: item,
      quantity:quantity,
      addInvoice: "addInvoice",
    },
    success: function (data) {
      $("#home-tab").tab("show");
      $(".addInvoice").trigger("reset");
      invoiceData();
    },
  });
}

///////invoice update ///
$(document).on("click", ".update_iv", function () {
  $("#profile-tab").tab("show");
  let invId = $(this).data("uid");
  $(".invoice_id").val(Number(invId));
  $.ajax({
    url: "/project/invoiceController/",
    type: "POST",
    data: {
      invId: invId,
      update_iv: "update_iv",
    },
    success: function (data) {
      $(".itemTable").remove();
      data = JSON.parse(data);
      let input = "<table class='w-100 itemTable'>";

      data.data.forEach(function (value, index) {
        $(".cli_Id").val(value["client_id"]);
        $(".client-name-invoice").val(value["client_name"]);
        $(".client-email-invoice").val(value["client_email"]);
        $(".client-phone-invoice").val(value["phone"]);
        input += "<tr>";
        input += `<td class=''><input type="text" class="item-name-invoice form-control"  onchange="fetchItemData(this)" onkeyup="changeAmt()" name='itemName[]'  value="${value["item_name"]}"><div class="itemselect position-absolute"></div>
        <input type="text" disabled hidden name='itm_id[]' class='itm_Id' value="${value["item_id"]}">  </td>`;
        input += `<td><input type="text" disabled class="item-price-invoice bg-white form-control"  name="price[]"  value="${value["price"]}"></td>`;
        input += `<td><input type="number" class="item-quantity-invoice form-control"  onchange="changeAmt()" name='quantity[]'  value="${value["Quantity"]}"></td>`;
        let amount = Number(value["Quantity"]) * Number(value["price"]);
        input += `<td><input type="text" disabled class="rowTotal bg-white form-control"  name="rowTotal[]" value="${amount}"></td>`;
        input +=
          '<td><button type="button" class="removeForm btn btn-outline-danger border border-0">X</button></td>';
        input += "</tr>";
      });
      input += "</table>";
      $(".loadmoreForm").html(input);
      let buttons =
        "Total Amount<input type='number' placeholder='Total Amount' disabled  class='total-amount-invoice form-control bg-white'>";
      buttons +=
        "<button type='button' class='btn btn-outline-primary mt-2' onclick='updateInvoice()'>";
      buttons += "Update";
      buttons += "</button>";
      $(".loadButtons").html(buttons);
      // $(".total-amount-invoice").val(total);
      changeAmt();
      cutBtn();
    },
  });
});
function updateInvoice() {
  let invoiceNo = $(".invoice_id").val();
  let item = $("input[name='itm_id[]']")
    .map(function () {
      return this.value;
    })
    .get();
  console.log(item);
  if (item.some((element) => element == "")) {
    $(".insertall").text("insert proper items");
    return;
  }
  // let quantity = $();

  $.ajax({
    url: "/project/invoiceController/",
    type: "POST",
    data: {
      invoiceNo: invoiceNo,
      item: item,
      UpdateInvoice: "UpadteInvoice",
    },
    success: function (data) {
      console.log(data);

      $("#home-tab").tab("show");
      $(".addInvoice").trigger("reset");
      $(".itemTable").html("");
      invoiceData();
      $(".loadButtons").html(
        'Total Amount<input type="text" class="total-amount-invoice form-control mb-4" placeholder="Total Amount">\
    <button onclick="addInvoic(),invoiceData()" class="btn btn-outline-primary mb-4" type="button">Save Invoice</button><button type="reset" onclick="loadInvoiceNO()" class="btn btn-outline-danger ms-3 mb-4">Clear Form</button>',
      );
      addMore();
      loadItems();
    },
  });
}
