<?php

include_once "dashboard.php";



?>

<style>



</style>

<div class="content-body col-10">

    <ul class="nav nav-tabs  mb-3 mt-2 " id="nav-tab" role="tablist">


        <li class="nav-item " role="presentation">
            <button class="nav-link fw-bold active text-dark" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">All Users</button>
        </li>


        <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold text-dark" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Edit Users</button>
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
                        <div class="col-12 my-4">
                            User Name <sup class="text-danger">*</sup>:
                            <input type="text" title="NAME" id="user_name" placeholder="User Name" name="user_name" minlength="2" maxlength="15" class="form-control    border ">
                            <div class="name_valid text-danger mb-3 "></div>
                        </div>
                        <div class="col-6 mb-4">
                            User Password :
                            <input type="password" title="PASSWORD" id="user_pass" placeholder="User Password" name="user_pass" class="form-control  border ">
                            <div id="pass_valid" class="text-danger mb-3 "></div>
                        </div>
                        <div class="col-6"> User Number :
                            <input type="number" placeholder="User Phone Number" title="NUMBER" id="user_number" name="user_number" class="form-control  border " required>
                            <div id="number_valid" class="text-danger mb-3 "></div>
                        </div>
                        <div class="col-12 mb-4">
                            User E-Mail :
                            <input type="email" placeholder="User E-mail" title="Email" id="user_email" required name="user_email" class="form-control  border ">
                            <div id="email_valid" class="text-danger mb-3 "></div>
                        </div>
                        <div class="col-8"></div>
                        <div class="col-4">
                            <input type="button" value="SAVE" id="save_user" class="save w-50 btn-outline-primary  btn-sm  btn my-3" onclick="insertUser()">
                            <input type="reset" value="RESET" class="reset_insert w-25 btn btn-sm btn-outline-danger">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- part -->
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
            
            <table class='w-100'>
                <tr class='w-100 bg-white border'>  
                    <form>
                        <td class='search-box p-3 pe-0 w-25' colspan="">
                           <div class="search_holder"> <input class='' id='search_user' placeholder='search ' type='text'><button type="button" onclick="userData(),searc()" class="search_button" name="search" value="search"><i class="bi bi-search"></i></button></div>
                        </td>
                        <td class='search-box p-3 pe-0'>
                            <select name='' onchange='userData()' id="search_status" class=' form-select searc_sel'>
                                <option value=''>STATUS</option>
                                <option value='1'>ACTIVE</option>
                                <option value='0'>INACTIVE</option>
                            </select>
                            </td>
                        <td class='w-50'>
                            <button class="reset_btn " type="reset" onclick="userData()"><i class="bi bi-arrow-repeat"></i></button></td>
                    </form>
                    <td colspan="" class="" align="">
                    <input id="invis" hidden type="text" value='1'>
                    <input type="text"  class='field' onchange='userData()' hidden value='id'>
                    <input type="text" class='order' onchange='userData()' hidden value='asc'>
                    <input type="text" hidden id="icon_hold" value='bi-arrow-down-up'>
                </td><td align='right' class="w-50">
                <select class='form-select w-25 mb-2 me-3' onchange='limitData()' name="" value='' id="limit">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                </select>    
                </td>
                </tr>
            </table>
            <div id="load_users" class="table_area bg-white rounded border">

            

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
                <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="" class="update_user_form p-3">


                </form>
            </div>

        </div>
    </div>
</div>

