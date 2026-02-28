<div id="left_sidebar" class="left_sidebar bg-skyblue  col-2 p-1 pt-5 py-2 px-auto">

    <div class="masters d-flex align-items-start ms-3 text-muted">

        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">

            <a href="<?php echo "/project/usermaster/"; ?>" onclick='userData()' id="user_master">
                <button  class="nav-link side1" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="bi bi-people me-3"></i> USER MASTER</button>
            </a>
<hr>
            <a href="<?php echo "/project/clientmaster/"; ?>" onclick='clientData()' id="client_master">
                <button class="nav-link side2" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                    <i class="bi bi-person-circle me-3"></i>
                    CLIENT MASTER </button> </a>
<hr>
            <a href="<?php echo "/project/itemmaster/"; ?>" id="item_master">

                <button class="nav-link side3" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false"> <i class="bi bi-diagram-3 me-3"></i>
                    ITEM MASTER</button></a>
        </div>
    </div>



    
        <form action="" method="post" class="logout_form">
            <button class="btn bg-danger mt-5 ms-3 me-5 rounded  w-100 text-white logout" value="logout">
                <i class="bi bi-box-arrow-left"></i>
                LOGOUT </button>
        </form>
</div>

