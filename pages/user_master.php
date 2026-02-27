<?php

include_once "dashboard.php";



?>

<div class="content-body col-10">

    <ul class="nav nav-tabs  mb-3 mt-2 " id="nav-tab" role="tablist">


        <li class="nav-item " role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">All Users</button>
        </li>


        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Add Users</button>
        </li>

    </ul>
    <div class="tab-content" id="pills-tabContent">
        <!-- start boxes-->

        <div class="tab-pane fade bg-white  rounded" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
            <div class="form_area w-100 border">
                <!-- /////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////// -->

                <form id="add_user" class="p-5">
                    <div class="row w-100">
                        <h1>ADD USER</h1>
                        <hr>
                        <div class="col-12">
                            User Name <sup class="text-danger">*</sup>:
                            <input type="text" title="NAME" id="user_name" name="user_name" minlength="2" maxlength="15" class="form-control    border ">
                            <div id="name_valid" class="text-danger mb-3 "></div>
                        </div>
                        <div class="col-6">
                            User Password :
                            <input type="password" title="PASSWORD" id="user_pass" name="user_pass" class="form-control  border ">
                            <div id="pass_valid" class="text-danger mb-3 "></div>
                        </div>
                        <div class="col-6"> User Number :
                            <input type="number" title="NUMBER" id="user_number" name="user_number" class="form-control  border " required>
                            <div id="number_valid" class="text-danger mb-3 "></div>
                        </div>
                        <div class="col-12">
                            User E-Mail
                            <input type="email" title="Email" id="user_email" required name="user_email" class="form-control  border ">
                            <div id="email_valid" class="text-danger mb-3 "></div>
                        </div>
                        <hr>
                        <div class="col-8"></div>
                        <div class="col-4">
                            <input type="button" value="SAVE" id="save_user" class="save w-50 status-btn-green  btn-sm bg-skyblue btn my-3" onclick="insertUser()">
                            <input type="reset" value="RESET" class="reset_insert w-25 btn btn-sm status-btn-red">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- part -->
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
            <table class='bg-white w-100 border rounded mb-3 table' style='box-shadow:0px 0px 5px #afb9b9;'>
                <tr>

                    <th  class='p-2 '>Id</th>
                    <th  class='p-2 '>Name</th>
                    <th  class='p-2 '>Email</th>
                    <th  class='p-2 '>Number</th>
                    <th  class='p-2'>Status</th>
                    <th class=""></th>
                </tr>
                <tr>
                    <form>
                        <td class='search-box ps-2'>
                            <input class='form-control' id="search_id" placeholder='search ' type='number'>
                        </td>
                        <td class='search-box pb-0 ps-2'><input class='form-control' id='search_name' placeholder='search ' type='text'></td>
                        <td class='search-box pb-0 ps-2'><input class='form-control' id='search_email' placeholder='search ' type='email'></td>
                        <td class='search-box pb-0 ps-2'><input class='form-control' id='search_number' placeholder='search ' type='number'></td>
                        <td class='search-box pb-0 ps-2'><select name='' id="search_status" class=' form-select'>
                                <option value='ACTIVE'>ACTIVE</option>
                                <option value='INACTIVE'>INACTIVE</option>
                            </select></td>
                        <td class='search-box-last '>

                            <button type="button" onclick="searc()" class="btn bg-skyblue ms-4" name="search" value="search"><i class="bi bi-search"></i></button>
                            <button class="bg-danger btn " type="reset" onclick="userData()"><i class="bi bi-arrow-clockwise"></i></button>
                        </td>
                    </form>
                </tr>
            </table>
            <table class='w-100'>
                <tr>
                    <td colspan="5" align="">
                    <input id="invis" hidden type="text" value='1'>
                    <input type="text" class='field' onchange='userData()' value='id'>
                    <input type="text" class='order' onchange='userData()' value='asc'></td><td>
                <select class='form-select' onchange='limitData()' name="" value='' id="limit">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                </select>    
                </td>
                </tr>
            </table>
            <div id="load_users" style='box-shadow:0px 0px 5px #afb9b9;' class="table_area bg-white rounded border">

            </div>

        </div>

        <!-- end boxes -->
    </div>




    <!-- /////////////end -->
</div>
</div>

<div class="modal " id="myModal" data-bs-backdrop="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header  bg-skyblue">
                <h4 class="modal-title">Update User Data</h4>
                <button type="button" class="btn-close btn-outline-danger" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="" class="update_user_form p-3">


                </form>
            </div>

        </div>
    </div>
</div>