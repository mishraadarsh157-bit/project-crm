<?php

include_once "dashboard.php";



?>


<div class="content-body col-10 p-2 pe-4 ps-3">
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active text-dark fw-bold" onclick='invoiceData()' id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">All Invoice</button>
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
            </div>
            <div>
              <button class="reset_btn " type="reset" onclick="invoiceData(),resetinvoice  ()"><i class="bi bi-arrow-repeat"></i></button>
            </div>
            <input type="text" hidden id="invis_iv" value="1">
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



        </div>
        <hr>


        <div class="loadInvoice p-2"></div>
      </div>
    </div>
    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
      <form class="addInvoice">

        <div class="invoice_form w-100 ms-1 row bg-white border mt-3 px-3">
          <div class="col-9">
            <h1 class='pt-3'>Add Invoice</h1>
          </div>
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
            <input disabled type="text" class="client-phone-invoice bg-white form-control  " placeholder="Client Phone">
          </div>

          <table class="w-100 itemTable">

          </table>
          <div class="loadmoreForm"></div>
          <div class="insertall text-danger mb-3 col-6"></div>
          <div class="quantityall text-danger mb-3 col-6"></div>
          <div class="col-8"></div>
          <div class="loadButtons col-4 mt-4" align="right">Total Amount<input type="text" class="total-amount-invoice form-control mb-4" placeholder="Total Amount">
            <button onclick="addInvoic(),invoiceData()" class="btn btn-outline-primary mb-4" type="button">Save Invoice</button><button type="reset" onclick="loadInvoiceNO()" class="btn btn-outline-danger ms-3 mb-4">Clear Form</button>
          </div>


        </div>
      </form>

    </div>
  </div>




</div>
</div>


<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="false" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-blue">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form class='mailForm'>

        <div class="modal-body">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="sendMail()"><span class="spinner-border spinner-border-sm" id='spinner' aria-hidden="true"></span> Send Mail</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </form>
    </div>
  </div>
</div>
</div>