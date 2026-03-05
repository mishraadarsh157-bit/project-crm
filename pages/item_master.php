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
                    <td><input type="text"></td>
                    <td><select name="" id=""></select>
                        <input type="text" id="#invis_i" value="1">
                        <input type="text" class="field_i" value='item_id'>
                        <input type="text" class='order_i' value='asc'>

                    </td>

                    <td><select name="" id="">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                        </select></td>
                </tr>

            </table>
        </div>

        <!-- edit item -->
        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
            <h1>Add Item</h1>
            <form id="itemInsertForm">
                <div class="row w-100 bg-white mx-0 p-0 pb-5 border">
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