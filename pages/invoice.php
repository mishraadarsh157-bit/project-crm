<?php

include_once "dashboard.php";



?>


<div class="content-body col-10 p-2 pe-4 ps-3">
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active text-dark fw-bold" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">All Invoice</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link text-dark fw-bold" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Add New Invoice</button>
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
    <input type="text" hidden onchange='invoiceData()' class="field_iv" value="invoiceID">
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
     <form>

    <div class="invoice_form w-100 ms-1 row bg-white border mt-3 px-3">
        <div class="col-9"><h1 class='pt-3'>Add Invoice</h1></div>
        <div class="col-3 pt-3" align='right'><button type="button" class="btn btn-outline-primary" onclick="addMore()">Add More</button></div>
        <hr>
    
    <!-- client part -->
    
        <div class="col-4 mt-4">Client Name <sup class="text-danger">*</sup><input type="text" onchange="fetchClientData()" class="client-name-invoice form-control mb-5 " placeholder="Client Name"></div>
    <div class="col-4 mt-4">Client Email<input type="text" disabled class="client-email-invoice bg-white form-control mb-5 " placeholder="Client Email"></div>
    <div class="col-4 mt-4">Client Phone<input disabled type="text" class="client-phone-invoice bg-white form-control mb-5 " placeholder="Client Phone"></div>
<!-- item part  -->
<div class="col-4">Item Name <sup class="text-danger">*</sup><input type="text" onchange="fetchItemData()" class="item-name-invoice form-control mb-3" placeholder="Item Name"></div>
<div class="col-4">Item Price<input disabled type="text" class="item-price-invoice form-control mb-3 bg-white" placeholder="Item Price"></div>

<div class="col-4 d-flex align-item-center">
  <button class="btn btn-sm" type="button" onclick="subQty()">
    <i class="bi bi-dash-lg"></i></button>
    <input disabled type="number" class="item-quantity-invoice bg-white  border border-0" value='1'>
    <button class="btn  btn-sm" type="button" onclick="addQty()"><i class="bi bi-plus-lg"></i></button></div>
    <!-- total -->
     <div class="loadmoreForm w-100 row"></div>
    <div class="col-8"></div>
    <div class="col-4 mt-4" align="right">Total Amount<input type="text" class="total-amount-invoice form-control mb-4" placeholder="Total Amount"><button  class="btn btn-outline-primary mb-4" type="button">Save Invoice</button><button type="reset" class="btn btn-outline-danger ms-3 mb-4">Clear Form</button></div>
    
    
  </div>
</form>

</div>
</div>




</div>
</div>