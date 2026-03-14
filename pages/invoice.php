<?php

include_once "dashboard.php";



?>


<div class="content-body col-10 p-2 pe-4 ps-3">
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active text-dark fw-bold" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">All Invoice</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link text-dark fw-bold" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" onclick='loadInvoiceNO(),cutBtn()' aria-selected="false">Add New Invoice</button>
  </li>
 
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade  show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

  <div class="table_show mt-3 bg-white border ">
    
  <div class="search_area p-3 row pt-3 pb-1 d-flex">
  <div class="col-9 d-flex">
    <div class="search_holder w-25 d-flex">
        <input type="text" onchange="invoiceData()" placeholder="search" class="searc_iv border border-0">
        <button class='searchbtniv' onclick="invoiceData(),searc_iv()"><i class="bi bi-search"></i></button>
      </div><div>
      <button class="reset_btn " type="reset" onclick="invoiceData(),resetinvoice  ()"><i class="bi bi-arrow-repeat"></i></button></div>
      <input type="text" hidden  id="invis_iv" value="1">
    <input type="text" hidden onchange='invoiceData()' class="field_iv" value="InvoiceNo">
    <input type="text" hidden onchange='invoiceData()' class="order_iv" value="asc">
    <input type="text" hidden onchange='invoiceData()' id="icon_hold_iv" value="bi-arrow-down-up">

  </div>
  <div class="col-3" align='right'>
    <select name="" id="limit_iv" onchange="invoiceData(),limitData_iv()" class="form-select w-25">
      <option value="5">5</option>
      <option value="10">10</option>
      <option value="15">15</option>
      <option value="20">20</option>
    </select>
  </div>
  
  
  
  </div><hr>


    <div class="loadInvoice p-2"></div>
  </div>
  </div>
  <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
     <form class="addInvoice">

    <div class="invoice_form w-100 ms-1 row bg-white border mt-3 px-3">
        <div class="col-9"><h1 class='pt-3'>Add Invoice</h1></div>
        <div class="col-3 pt-3" align='right'><button type="button" class="btn btn-outline-primary" onclick="addMore()">Add More</button></div>
        <hr>
      <!-- invoice id  -->
       <div class="col-12">
         <input type="number" disabled class='invoice_id bg-white form-control w-25'>
        </div>
      <!-- invoice date  -->
    <!-- client part -->
    
        <div class="col-4 mt-4">Client Name <sup class="text-danger">*</sup><input type="text" onchange="fetchClientData()" class="client-name-invoice form-control  " placeholder="Client Name">
      <div class="invalidclint text-danger"></div>
      </div>
    <div class="col-4 mt-4">Client Email<input type="text" disabled class="client-email-invoice bg-white form-control  " placeholder="Client Email"></div>
    <div class="col-4 mt-4">Client Phone
    <input type="text" hidden name='cli_id' class='cli_Id'>  
    <input disabled type="text" class="client-phone-invoice bg-white form-control  " placeholder="Client Phone"></div>
    <!-- item part  -->
     <!-- <table class="ItemDta w-100">
      <tr>
        <td>

            
            Item Name <sup class="text-danger">*</sup><input type="text" onchange="fetchItemData(this)" onkeyup="changeAmt()" name='itemName[]' class="item-name-invoice form-control" placeholder="Item Name">
            <div class="itemselect"></div>
          </td>
          <td>
            Item Price
              <input type="text" disabled hidden name='itm_id[]' class='itm_Id'>  
              <input disabled type="text" name="price[]" class="item-price-invoice form-control bg-white" placeholder="Item Price">
          </td>
              <td>
                  Quantity
                  <input type="number" onkeyup="changeAmt()" name='quantity[]' class="item-quantity-invoice form-control" value='1'>
              </td>
                <td>
Amount<input type="number" name="rowTotal[]" placeholder="Amount" disabled class="rowTotal form-control bg-white"></td><td><button type="button" class="btn btn-outline-danger border border-0">     </button></td></tr>
  <input type="text" name="addInvoice" hidden value="addInvoice">
  </table> -->
  <table class="w-100 itemTable">
     <div class="loadmoreForm">
<tr>
    <td>Item Name <sup class="text-danger">*</sup><input type="text" name="itemName[]" onchange="fetchItemData(this)" class="item-name-invoice form-control" placeholder="Item Name"><div class="itemselect"></div></td>
<td><input type="text" disabled hidden name="itm_id[]" class="itm_Id">  Item Price<input disabled type="text" name="price[]" class="item-price-invoice form-control bg-white" placeholder="Item Price"></td>
<td>
    Quantity<input  type="number" onkeyup="changeAmt()" class="item-quantity-invoice form-control" name="quantity[]" bg-white  border border-0" value="1">
   </td>
    <td>Amount<input type="number" disabled placeholder="Amount" name="rowTotal[]" class="rowTotal bg-white form-control"></td>
    <td><button type="button" class="removeForm btn btn-outline-danger border border-0">X</button></td></tr>
     </div>
     </table>
     <div class="insertall text-danger mb-3 col-12"></div>
    <div class="col-8"></div>
    <div class="loadButtons col-4 mt-4" align="right">Total Amount<input type="text" class="total-amount-invoice form-control mb-4" placeholder="Total Amount">
    <button onclick="addInvoic(),invoiceData()" class="btn btn-outline-primary mb-4" type="button">Save Invoice</button><button type="reset" onclick="loadInvoiceNO()" class="btn btn-outline-danger ms-3 mb-4">Clear Form</button></div>
    
    
  </div>
</form>

</div>
</div>




</div>
</div>