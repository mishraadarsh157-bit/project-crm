<?php

include_once "dashboard.php";



?>

<div class="content-body col-10 pt-3">

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">All Clints</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab " onclick='loadStates()' data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Add Clints</button>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">

        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <table class="table">
                <tr>
                    <td>table</td>
                </tr>
            </table>

        </div>

        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
            <h1 class="mt-4">add clint</h1>
            <div class="row m-0 mt-3 clint_form w-100 bg-white border p-4">
                 <form>
                    <div class="row">
                       
                        <div class="col-6 p-3 pt-5">
                            Name:
                            <input type="text" class="form-control mb-3" id="clint_name">
                            <div id="name_valid" class="text-danger mb-3 "></div>
                        </div>
                        <div class="col-6 p-3 pt-5">
                            Phone:
                            <input type="Number" class="form-control mb-3" id="clint_number">
                            <div id="number_valid" class="text-danger mb-3 "></div>
                        </div>
                        <div class="col-12 p-3 pt-5">
                            Address:
                            <input type="text" class="form-control mb-3" id="clint_address">
                            <div id="address_valid" class="text-danger mb-3 "></div>
                        </div>
                        <div class="col-4  p-3 pt-5">State:
                            <div id="loadState">

                            </div>
                        </div>
                        <div class="col-4  p-3 pt-5">City
                            <div id="loadCity">

                            </div>
                        </div>
                        <div class="col-4  p-3 pt-5">Pincode<input type="Number" id="clint_pincode" class="form-control mb-3"></div>
                        <div id="pincode_valid" class="text-danger mb-3 "></div>
                        <div class="col-8 p-3 pt-5"></div>
                        <div class="col-4 px-3">
                            <input type="button" p-3 pt-5' id="insert_clint" onclick='insertClint()' class="btn btn-outline-success w-25" value='submit'>
                            <button type='button' onclick="city()">city</button>
                            <button type="reset" class="btn  btn-outline-danger w-25">Reset</button>
                        </div>


                    </div>


                </form>
            </div>


        </div>
    </div>


</div>
</div>