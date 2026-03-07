<?php

include_once "dashboard.php";



?>

<div class="content-body col-10 pt-2 ps-3">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active text-dark fw-bold" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">All Items</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link text-dark fw-bold" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Add New Item</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <!-- all item  -->
        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <table class='table bg-white mt-3'>
                <tr>
                    <td class='w-25'><div class="search_holder m-2"><input type="text" placeholder="search" class='searc_i'><button onclick="loadItems(),searc_i()" class='search_button'><i class='bi bi-search'></i></button></div></td>
                    <td class='pt-3'> <button class="reset_btn " type="reset" onclick="clientData()"><i class="bi bi-arrow-repeat"></i></button></td>
                    <td>
                        
                        <input type="text"  hidden id="invis_i" value="1">
                        <input type="text"  hidden class="field_i" onchange="loadItems()" value='item_id'>
                        <input type="text"  hidden class='order_i' onchange="loadItems()" value='asc'>
                         <input type="text" hidden  value='bi-arrow-down-up' id="icon_hold_i">

                    </td>

                    <td align='right'><select name="" onchange="loadItems(),limitItem()" id="limit_i" class='form-select w-25'>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                        </select></td>
                </tr>

            
            <tr><td colspan="5">
            <div id="load_Items"></div>
            </td></tr>
        </table>
        </div>

        <!-- edit item -->
        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
            <h1>Add Item</h1>
            <form id="itemInsertForm">
                <div class="row w-100 bg-white mx-0 mt-4 pt-5 pb-5 border">
                    <div class="col-6 mb-5 ">
                        Item Name
                        <input type="text" name='item_name' id="item_name" class='form-control '>
                    </div>
                    <div class="col-6 mb-5 ">
                        Item Price
                        <input type="number" name='item_price' id="item_price" class='form-control '>
                    </div>
                    <div class="col-12 mb-5 p-2">
                        Item Description
                        <input type="text" name='item_description' id="item_description" class='form-control '>
                    </div>
                    <div class="col-6 mb-5 p-2">
                        Item Image
                        <input type="file" name='itemimage' onchange="itmImg(event)" id="item_image" class='form-control'>
                    </div>
                    <div class="col-6 mb-5 p-2"><img src="" name='image' alt="" height="100px" class="itemImage"></div>
                    <div class="col-9"></div>
                    <div class="col-3">
                        <input type="text" name='submit_item' hidden value='submititem'>
                        <button type="button" onclick="insertItem()" id="itemSubmit" name='itemSubmit' class="btn btn-outline-primary">Save Item</button>
                    </div>
</div>
                    </form>
        </div>
    </div>



</div>
</div>

<div class="modal " id="myModal" data-bs-backdrop="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header bg-skyblue">
                <h4 class="modal-title">Update Item Data</h4>
                <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="" name="update_Item_Form" class="update_item_form p-3">


                </form>
            </div>

        </div>
    </div>
</div>

