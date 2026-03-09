<?php

include_once "dashboard.php";



?>

<div class="content-body col-10 pt-2">

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold active text-dark" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">All Clients</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold text-dark" id="profile-tab " onclick='loadStates()' data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Add New Clients</button>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">

        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <table class="table mt-3 border bg-white">
                <tr>
                    <td><table class=" w-100">
                        <tr>
                            <form>
                        <td class='w-25 search-box p-2'>
                            <div class="search_holder">
                            <input type="text" placeholder="search" class='searc_c'><button onclick='clientData(),searc_c()' type="button" class='search_button'><i class='bi bi-search'></i></button></div></td><td>
                            <select name="" class='searc_sel rounded ps-2' onchange='clientData()' id="status_c">
                                <option value="">STATUS</option>
                                <option value="1">ACTIVE</option>
                                <option value="0">INACTIVE</option>
                            </select>
                            <input type="text" hidden id='invis_c' value='1' >
                            <input type="text" hidden class='field_c' value='client_id' >
                            <input type="text" hidden class='order_c' value='asc' >
                            <input type="text" hidden value='bi-arrow-down-up' id="icon_hold_c">
                        <button class="reset_btn " type="reset" onclick="clientData(),resetClient()"><i class="bi bi-arrow-repeat"></i></button>
                        </td></form>
                        <td class='w-25' align='right'>
                            <select class='form-select w-25' onchange='clientData(),limitData_c()'  name="" id="limit_c">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                        </select></td>
                    </tr>
                    </table></td>
                </tr>
                <tr><td colspan="5">
            <div id="load_clients" class='p-0'>

            </div>
            </td>
            </table>
        </div>

        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
            <div class="row m-0 mt-3 client_form w-100 bg-white border p-4">
                <form id="add_client">
                    <div class="row">
                        <h1 class="mt-4">Add Client</h1><hr>

                        <div class="col-6 p-3 pt-5">
                            Client Name:
                            <input type="text" class="form-control mb-3" placeholder="Client Name" id="client_name_c">
                            <div class="name_valid text-danger mb-3 "></div>
                        </div>
                        <div class="col-6 p-3 pt-5">
                           Client Phone:
                            <input type="Number" placeholder="Client phone number" class="form-control mb-3" minlength="2" maxlength="15"  id="client_number">
                            <div class="number_valid text-danger mb-3 "></div>
                        </div>
                        <div class="col-6 p-3 pt-5">
                            Client's Address:
                            <textarea name="" placeholder="Address" class="form-control mb-3" id="client_address"></textarea>
                            <div class="address_valid text-danger mb-3 "></div>
                        </div>
                        <div class="col-6 p-3 pt-5">
                           Client Email:
                            <input type="email" placeholder="Client email" class="form-control mb-3" id="client_email_c">
                            <div class="email_valid text-danger mb-3 "></div>
                        </div>
                        <div class="col-4  p-3 pt-5">State:
                            <div id="loadState">

                            </div>
                        </div>
                        <div class="col-4  p-3 pt-5">City:
                            <div id="loadCity">
                                <select name="" id="" class='form-select'>
                                    <option value="">----Select City----</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4  p-3 pt-5">Pincode:<input type="Number" placeholder="Pincode" id="client_pincode" class="form-control mb-3">
                            <div class="pincode_valid text-danger mb-3 "></div>
                        </div>

                        <div class="col-8 p-3 pt-5"></div>
                        <div class="col-4 ps-5 text-end">
                            <input type="button"  id="insert_client" onclick='insertClient()' class="btn btn-outline-primary " value='Submit'>
                            <button type="reset" class="btn btn-outline-danger ">Reset</button>
                        
                        </div>
                        


                    </div>


                </form>
            </div>


        </div>
    </div>








    <!-- /////end div// -->
</div>
</div>

<div class="modal " id="myModal" data-bs-backdrop="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header bg-skyblue">
                <h4 class="modal-title">Update Client Data</h4>
                <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form class="update_client_form p-3">


                </form>
            </div>

        </div>
    </div>
</div>

