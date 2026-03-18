<?php

include_once "dashboard.php";



?>

<div class="content-body col-10 pt-2 ps-3">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active text-dark fw-bold" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">All Items</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link text-dark fw-bold" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" onclick="resetItmForm()" aria-controls="profile-tab-pane" aria-selected="false">Add New Item</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <!-- all item  -->
        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <table class='table bg-white mt-3'>
                <tr>
                    <td class='w-25'>
                        <div class="search_holder m-2"><input type="text" placeholder="search" class='searc_i'><button onclick="searc_i()" class='search_button'><i class='bi bi-search'></i></button></div>
                    </td>
                    <td class='pt-3'>
                        <button class="reset_btn " type="reset" onclick="resetItems()"><i class="bi bi-arrow-repeat"></i></button>
                    </td>
                    <td>

                        <input type="text" hidden id="invis_i" value="1">
                        <input type="text" hidden class="field_i" onchange="loadItems()" value='item_id'>
                        <input type="text" hidden class='order_i' onchange="loadItems()" value='asc'>
                        <input type="text" hidden value='bi-arrow-down-up' id="icon_hold_i">

                    </td>

                    <td align='right'><select name="" onchange="limitItem()" id="limit_i" class='form-select w-25'>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                        </select></td>
                </tr>


                <tr>
                    <td colspan="5">
                        <div id="load_Items"></div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- edit item -->
        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
            <form id="itemInsertForm">
                <div class="row w-100 bg-white mx-0 mt-4 pt-4 px-4 pb-5 border ">
                    <h1 class='add_itm pt-3'>Add Item</h1>
                    <hr>
                    <div class="col-6 mb-5 mt-4">
                        Item Name
                        <input type="text" name='item_name' id="item_name" placeholder="Item name" class='item_name form-control '>
                        <div class="item_valid"></div>
                    </div>
                    <div class="col-6 mb-5 mt-4">
                        Item Price
                        <input type="tel"  min='1' name='item_price' id="item_price" placeholder="Item Price" class='form-control ' oninput="this.value = this.value < 1 ? 1 : this.value" value="1">
                        <div class="price_valid"></div>
                    </div>
                    <div class="col-12 mb-5 p-2">
                        Item Description
                        <input type="text" name='item_description' id="item_description" placeholder="Item Description" class='form-control '>
                        <div class="des_valid"></div>
                    </div>
                    <div class="col-6 mb-5 p-2">
                        Item Image
                        <div class='image_holder'>
                            <input type="file" accept="image/*" name='itemimage' onchange="itmImg(event)" id="item_image" class='form-control w-75'><button class="btn border border-0 btn-outline-danger" type="button" onclick="resetImage()"><i class="bi bi-x-lg"></i></button>
                        </div>
                        <div class="image_valid"></div>
                    </div>
                    <div class="col-6 mb-5 p-2"><img src="" name='image' alt="" height="100px" class="itemImage"></div>
                    <div class="col-9 updItm">
                        <input type="text" name='submit_item' hidden value='submititem'>
                    </div>
                    <div class="col-3 text-end ps-5 itemSaver">
                        <div class="valid_item text-danger mb-3"></div>
                        <button type="button" onclick="insertItem()" id="itemSubmit" name='itemSubmit' class="btn btn-outline-primary">Save Item</button>
                        <input type="reset" class='btn btn-outline-danger' onclick="resetImage()" value='Reset'>
                    </div>
                </div>
            </form>
        </div>
    </div>



</div>
</div>