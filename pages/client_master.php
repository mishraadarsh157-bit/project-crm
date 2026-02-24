<?php

include_once "dashboard.php";



?>

<div class="content-body col-10 pt-3">

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">All Clients</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab " onclick='loadStates()' data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Add Clients</button>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">

        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

            <div id="load_clients" class='table_area bg-white rounded border'>

            </div>

        </div>

        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
            <h1 class="mt-4">Add Client</h1>
            <div class="row m-0 mt-3 client_form w-100 bg-white border p-4">
                <form id="add_client">
                    <div class="row">

                        <div class="col-6 p-3 pt-5">
                            Name:
                            <input type="text" class="form-control mb-3" id="client_name">
                            <div id="name_valid" class="text-danger mb-3 "></div>
                        </div>
                        <div class="col-6 p-3 pt-5">
                            Phone:
                            <input type="Number" class="form-control mb-3" id="client_number">
                            <div id="number_valid" class="text-danger mb-3 "></div>
                        </div>
                        <div class="col-6 p-3 pt-5">
                            Address:
                            <textarea name="" class="form-control mb-3" id="client_address"></textarea>
                            <div id="address_valid" class="text-danger mb-3 "></div>
                        </div>
                        <div class="col-6 p-3 pt-5">
                            Email:
                            <input type="email" class="form-control mb-3" id="client_email">
                            <div id="email_valid" class="text-danger mb-3 "></div>
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
                        <div class="col-4  p-3 pt-5">Pincode:<input type="Number" id="client_pincode" class="form-control mb-3">
                            <div id="pincode_valid" class="text-danger mb-3 "></div>
                        </div>

                        <div class="col-8 p-3 pt-5"></div>
                        <div class="col-4 px-3">
                            <input type="button" p-3 pt-5' id="insert_client" onclick='insertClient()' class="btn btn-outline-success w-50" value='Submit'>
                            <button type="reset" class="btn  btn-outline-danger w-25">Reset</button>
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
                <button type="button" class="btn-close btn-outline-danger" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="" class="update_client_form p-3">


                </form>
            </div>

        </div>
    </div>
</div>