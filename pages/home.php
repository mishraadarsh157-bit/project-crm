<?php

include_once "dashboard.php";



?>

<div class="content-body m-0 p-0 ps-3 col-10 ">
    <h1>Dashboard</h1>

    <div class="row  ms-4 me-0 p-0">
        <div class="home-con-h col-6 row text-warning ">
            <div class="col-12 row user-box border  mt-2">

                <div class="col-6 ">
                    <div class=" pt-3 col-12">
                        <h3>Welcome ,<b class='text-white h1'>User</b></h3>
                    </div>
                    <div class=" pt-5 col-12" id="load_name"></div>
                </div>
                <div class="col-6 image"><img src="../assets/images/user_image.png" height="190px" alt=""></div>
            </div>

            <div class="dash-col col-6">
                <div class=" dash-col p-5 bg-white border">
                    <h3 class='text-danger'>Users Status</h3>
                    <br>
                    <button class='status-btn-green border-0 me-2'><span id="total_active_users">Active </span></button>
                    <button class='status-btn-red border-0'><span id="total_inactive_users">Inactive </span></button>
                </div>
            </div>

            <div class="dash-col col-6">
                <div class=" dash-col p-5 bg-white border">
                    <h3 class='text-danger'>Clients Status</h3> <br>
                    <button class='status-btn-green border-0 me-2'><span id="total_active_client">Active </span></button>
                    <button class='status-btn-red border-0'><span id="total_inactive_client">Inactive </span></button>
                </div>
            </div>
        </div>

        <div class="home-con-h col-6   rounded row ">
            <div class="col-6 dash-col rounded mt-2">
                <div class="dash-col border p-5 bg-white">
                    <h3 class='text-danger'>Total Users</h3>
                    <h1 id='total_users'></h1>
                </div>
            </div>
            <div class="col-6 dash-col  rounded mt-2">
                <div class="dash-col p-5 border bg-white">
                    <h3 class='text-danger'>Total Clients</h3>
                    <h1 id='total_clients'></h1>
                </div>
            </div>
            <div class="col-6 dash-col  rounded mt-2">
                <div class="dash-col p-5 border bg-white">
                    <h3 class='text-danger'>Total Items</h3>
                    <h1 id="total_items"></h1>
                </div>
            </div>
            <div class="col-6 dash-col  rounded mt-2">
                <div class="dash-col p-5 border bg-white">
                    <h3 class="text-danger">Total Invoice</h3>
                    <h1 id="total_invoice"></h1>
                </div>
            </div>

        </div>


    </div>

</div>

</div>

<?php


$value1 = $_SESSION['admin'];
echo '<script>
$("#load_name").html("<p>You have logged In with <br><b>' . $value1 . ' </b></p>");
</script>';

?>