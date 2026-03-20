function fetchClientData() {
  var name = $(".client-name-invoice").val()??"";
  if(name.trim()==""){
    return false
  }
  $.ajax({
    url: "/project/invoiceController/",
    type: "POST",
    data: {
      client_name: name.trim(),
    },
    success: function (data) 
    {
      if (data.trim() == "empty") {
        $(".client-email-invoice").val("no data").css("color", "red");
        $(".client-phone-invoice").val("no data").css("color", "red");
      } else {
        data = JSON.parse(data);
        data.data.forEach(function (value) {
          if(value==null){

          }
          else{

          $(".cli_Id").val(value["client_id"]);
          $(".client-email-invoice")
            .val(`${value["client_email"]}`)
            .css("color", "black");
          $(".client-phone-invoice")
            .val(`${value["phone"]}`)
            .css("color", "black");}
        });
      }
    },
  });
}
///////client name invoice//////

$(document).on('keyup','.client-name-invoice',function(){
  let value=$(this).val();
  $.ajax({
     url: "/project/invoiceController/",
    type: "POST",
    data: {
      clientSearch: value,
    },
    success:function(data){
      if(data.trim()=='empty'){
        let table='no client found'
        
        $('.clientselect').html(table).css('color','red') 
    $(".invalidclint").text("");
        
      }
      else{
        data=JSON.parse(data)
        $(function() {
          var availableclients  =  data;
          $( "#automplete-1" ).autocomplete({
            source: availableclients,
            select:  function(event,ui){
              fetchClientData()
            }
          });
    $(".invalidclint").text("");

          $('.clientselect').html('') 
        })
      }
    }
  })
})

$(document).on("keyup", ".item-name-invoice", function () {
  
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
        row.find(".itemselect").html(table).css('color','red');  
      }
      else{
        data = JSON.parse(data);
        row.find(".itemselect").html('');
        $(function() {
          var availableitems  =  data;
          row.find("#item_s").autocomplete({
        source: availableitems,
        select:function(event,ui){
          fetchItemData()
        }
        
      });
    })
  }
  
  
},
});
});

$(document).on("keyup", ".item-name-invoice", function () {
  
  let value = $(this).val()??"";
  if(value.trim()==""){
    $('.itm_Id').val('');
    $('.item-price-invoice').val('');
    $('.item-quantity-invoice').val(1);
  }


})

$(document).on("keyup", ".client-name-invoice", function () {
  
  let value = $(this).val()??"";
  if(value.trim()==""){
    $('.cli_Id').val('');
    $('.client-email-invoice').val('');
    $('.client-phone-invoice').val('');
  }


})



function fetchItemData() {
  let name = $("input[name='itemName[]']").map(function () {
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
function addMore() {
  var row = "<tr>";
  row +=
    '<td class="pb-3">Item Name <sup class="text-danger">*</sup><input type="text" name="itemName[]" id="item_s" onchange="fetchItemData(this)" class="item-name-invoice form-control" placeholder="Item Name"><div class="itemselect position-absolute "></div></td>\
<td class="pb-3"><input type="text" disabled hidden name="itm_id[]" class="itm_Id">  Item Price<input disabled type="text" name="price[]" class="item-price-invoice form-control bg-white" placeholder="Item Price"></td>\
<td class="pb-3">\
Quantity<input min="1" type="number" onchange="changeAmt()" oninput="this.value = this.value < 1 ? 1 : this.value" class="item-quantity-invoice form-control" name="quantity[]" bg-white  border border-0" value="1">\
   </td>\
    <td class="pb-3">Amount<input type="number" disabled placeholder="Amount" name="rowTotal[]" class="rowTotal bg-white form-control"></td>\
    <td class="pb-3"><button type="button" onclick="changeAmt()" class="removeForm btn btn-outline-danger border border-0">X</button></td></tr>\
    ';
    $(".itemTable").append(row);
    cutBtn();
  }
  
  $(document).on("click", ".removeForm", function () {
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
        table +="</tr>"
        table +="<tr>"
        table +="<td class='text-center' colspan='8'>"
        table +="<h1>NO INVOICE FOUND</h1>"
        table +="</td>"
        table += "</tr></table></div>";
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
        table += "<td class='text-center'> Action</td>";
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
          table += `<td class='text-center'>${index}</td>`;
          table += `<td class='d-flex justify-content-center'> <ul class="nav me-2" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
          <button onclick="changeAmt()" class="update_iv nav-link btn btn-sm rounded-pill btn-outline-primary border border-0" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" data-uid='${value["InvoiceNo"]}' name='update_i' value='update_i' role="tab" aria-controls="profile-tab-pane" aria-selected="false"><i class='bi bi-pencil-square'>
          </i></button>
          </li>
          </ul>
          <button type="button" class="mailBtn btn btn-outline-danger border border-0 rounded-pill" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id='${value['InvoiceNo']}'>
          <i class="bi bi-envelope-paper" ></i>
          </button>
          
          <button class='pdf btn ms-2 btn-outline-success border border-0 rounded-pill' id='${value['InvoiceNo']}'><i class="bi bi-filetype-pdf"></i></button>
          </td>`;
          
          table += `<td>${value["InvoiceNo"]}</td>`;
          table += `<td>
          <ul class="nav" id="myTab" role="tablist"><a onclick="changeAmt()" class="update_iv nav-link " id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" data-uid='${value["InvoiceNo"]}' name='update_i' value='update_i' role="tab" aria-controls="profile-tab-pane" aria-selected="false">
          #INV0${value["InvoiceNo"]}
          </a>
          </ul>
          </td>`;
          table += `<td>${value["InvDate"]}</td>`;
          table += `<td>${value["client_name"]}</td>`;
          table += `<td>${value["client_email"]}</td>`;
          table += `<td>${value["phone"]}</td>`;
          table += "</tr>";
        });
        table += "</table></div><hr>";
        
        table += "<div class='pagination pt-3 pb-5 w-100'>";
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
  $('.add_inv').html('Add Invoice')
  $(".client-name-invoice").prop('disabled',false);
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
        $(".loadButtons").html(
          'Total Amount<input type="text" disabled class="total-amount-invoice form-control mb-4 bg-white" placeholder="Total Amount">\
          <button onclick="addInvoic(),invoiceData()" class="btn btn-outline-primary mb-4 bg-white" type="button">Save Invoice</button><button type="reset" onclick="loadInvoiceNO()" class="btn btn-outline-danger ms-3 mb-4">Clear Form</button>',
        );
        addMore();
      }
    },
  });
}

function addInvoic() {
  
  let invoiceNo = $(".invoice_id").val()??"";
  if(invoiceNo.trim()==""){
    Swal.fire({
      title: "Error!",
      text: "Invoice Number Not Found?",
      icon: "error"
    });
    return false;
  }
  if ($(".client-email-invoice").val() == "no data") {
    $('.clientselect').html('') 
    $(".invalidclint").text("enter valid clint name");
    return false;
  }
  else{
    $(".invalidclint").text("");
  }
  let client = $(".cli_Id").val()??"";
  if(client.trim()==""){
     Swal.fire({
      title: "Error!",
      text: "Client Not Found?",
      icon: "error"
    });
    return false;
  }
  if (client == "") {
    $(".invalidclint").text("enter clint name");
    return false;
  } else {
    $(".invalidclint").hide();
  }
  let item = $("input[name='itm_id[]']")
    .map(function () {
      return this.value;
    })
    .get();
  if (item.some((element) => element == "")) {
    $(".insertall").text("insert proper items");
    return false;
  }
  let quantity = $("input[name='quantity[]']").map(function(){
    return this.value;
  }).get();
 if (quantity.some((element) => element == "" || quantity.some((element) => element <1 ))) {
    $(".quantityall").text("insert proper quantity");
    return false;
  }
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
      if(data.trim()==1){
      $("#home-tab").tab("show");
      $(".addInvoice").trigger("reset");
      invoiceData();}
      else{
        Swal.fire({
  icon: "error",
  title: "Oops...",
  text: "Data Not Inserted!",
  footer: '<a href="#">Some Values Are incorrect?</a>'
});
      }
    },
  });
}

///////invoice update ///
$(document).on("click", ".update_iv", function () {
  $("#profile-tab").tab("show");
  $('.add_inv').html('Edit Invoice')

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
        $(".client-name-invoice").val(value["client_name"]).prop('disabled',true);
        $(".client-email-invoice").val(value["client_email"]);
        $(".client-phone-invoice").val(value["phone"]);
        input += "<tr>";
        input += `<td class=''><input type="text" class="item-name-invoice form-control"  onchange="fetchItemData(this)" onkeyup="changeAmt()" name='itemName[]'  value="${value["item_name"]}"><div class="itemselect position-absolute"></div>
        <input type="text" disabled hidden name='itm_id[]' class='itm_Id' value="${value["item_id"]}">  </td>`;
        input += `<td><input type="text" disabled class="item-price-invoice bg-white form-control"  name="price[]"  value="${value["price"]}"></td>`;
        input += `<td><input min='1' type="number" class="item-quantity-invoice form-control"  onchange="changeAmt()" name='quantity[]'  value="${value["Quantity"]}"></td>`;
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
  let invoiceNo = $(".invoice_id").val()??"";
    if(invoiceNo.trim()==""){
     Swal.fire({
      title: "Error!",
      text: "Invoice Number Not Found?",
      icon: "error"
    });
    return false;
  }
  let item = $("input[name='itm_id[]']")
    .map(function () {
      return this.value;
    })
    .get();
  if (item.some((element) => element == "")) {
    $(".insertall").text("insert all items");
    return;
  }
   let quantity = $("input[name='quantity[]']").map(function(){
    return this.value;
  }).get();
 if (quantity.some((element) => element == "" || quantity.some((element) => element <1 ))) {
    $(".quantityall").text("insert proper quantity");
    return;
  }
  // let quantity = $();

  $.ajax({
    url: "/project/invoiceController/",
    type: "POST",
    data: {
      invoiceNo: invoiceNo,
      item: item,
      quantity:quantity,
      UpdateInvoice: "UpadteInvoice",
    },
    success: function (data) {

      $("#home-tab").tab("show");
      $(".addInvoice").trigger("reset");
      $(".itemTable").html("");
          var page = $("#invis_iv").val();

      invoiceData(page);
      $(".loadButtons").html(
        'Total Amount<input type="text" disabled class="total-amount-invoice form-control mb-4 bg-white" placeholder="Total Amount">\
    <button onclick="addInvoic(),invoiceData()" class="btn btn-outline-primary mb-4 bg-white" type="button">Save Invoice</button><button type="reset" onclick="loadInvoiceNO()" class="btn btn-outline-danger ms-3 mb-4">Clear Form</button>',
  );
  addMore();
  loadItems();
},
  });
}

$(document).on('click','.mailBtn',function(){
  $('#spinner').hide()
  let InvNo=$(this).attr('id')
  $.ajax({
     url: "/project/invoiceController/",
       type: "POST",
       data:{
        InvNo:InvNo,
        fetchMail:'fetchMail'
       },
       success: function(data){
        data=JSON.parse(data);
        let table="";
        data.data.forEach(function(value){
          table +=`Invoice No:<input type='text' id='mail_invoiceNo' class='form-control mb-3 bg-white' disabled value='${value['InvoiceNo']}'>`;
          table +=`Client Name:<input type='text' id='mail_client_name' disabled class='form-control mb-3 bg-white' value='${value['client_name']}'>`;
          table +='<div class="name_valid"></div>'
          table +=`Email:<input type='text' id='mail_id' disabled class='form-control mb-3 bg-white' value='${value['client_email']}'>`;
          table +='<div class="email_valid"></div>'
          table +=`Subject:<input type='text' id='subject' placeholder='Enter Subject' class='form-control mb-3 bg-white' value='Invoice FOR #INV0${value['InvoiceNo']} for App Stack'>`;
          table +="<div class='subject_valid text-danger'></div>"

          table +=`Messsage:<textarea type='text' rows='10' id='message' class='form-control mb-5 bg-white' placeholder='Enter Message'>Hi ${value['client_name']}, I hope you're doing well. Please find attached our invoice #INV0${value['InvoiceNo']} for your purchase, which is due on ${value['InvDate']}. Let me know if you have any questions. Best, Adarsh.</textarea>`;

          table +="<div class='message_valid text-danger'></div>"
        })
        $('.modal-body').html(table)
       }
  })
})
function sendMail(){
  $('.message_valid').hide()
  $('.subject_valid').hide()
  let invoiceNo=$('#mail_invoiceNo').val()??"";
  if(invoiceNo.trim()==''){
    alert('Invoice Number Not found')
    return false;
  }
  let name=$('#mail_client_name').val()??"";
  if(!validName(name)){
    return
  }
  let mailId=$('#mail_id').val()??"";
  if(!validEmail(mailId)){
    return
  }
  let subject=$('#subject').val()??"";
  if(subject.trim()==''){

    $('.subject_valid').show()
    $('.subject_valid').html('enter subject')
    return false;
  }
  let message=$('#message').val()??"";
  if(message.trim()==''){
    $('.message_valid').show()
    $('.message_valid').html('enter message')
    return false;
  }
  $.ajax({
    url: "/project/invoiceController/",
    type: "POST",
    data:{
      invoiceNo:invoiceNo,
      name:name,
      mailId:mailId,
      subject:subject,
      message:message,
      sendMail:'sendMail'
    },
    beforeSend: function(){
      
      $('#spinner').show()
      $('.message_valid').hide()
      $('.subject_valid').hide()
    }
    ,
    success:function(data){
      $('#staticBackdrop').hide()
      $('#spinner').hide()
      Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Mail Sent",
        showConfirmButton: false,
        timer: 1500
      });
    }
  })



}

$(document).on('click','.pdf',function(){

  let invId=$(this).attr('id')
  makePdf(invId)  
})


function makePdf(value){
let invId=value;
$.ajax({
      url: "/project/invoiceController/",
      type:'POST',
      data:{
        invId:invId,
        makePDF:'makePDF'
      },
      xhrFields: {
        responseType: "blob"
    },
      success:function(data){
        console.log(data,'string 1')
        let blob = new Blob([data], { type: "application/pdf" });
        let url = window.URL.createObjectURL(blob);
        
        window.open(url, "_blank");
        console.log(data,'string 2')


      }
      
})
}