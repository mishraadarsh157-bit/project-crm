<?php


include '../project/database/db_logics.php';

include '../project/database/client_logics.php';


switch (true) {
    case isset($_POST['page_name']):
        $table1 = "client";
        $table2 = "cities";
        $table3 = "states";
        $page = $_POST['page_no'] ?? 1;
        $field = $_POST['field'] ?? 'client_id';
        $order = $_POST['order'];
        $search = $_POST['searc'] ?? '';
        $status = $_POST['status'] ?? '';
        $limit = $_POST['limit'] ?? 5;
        $limit = (int) $limit;
        $offset = ($page - 1) * $limit;

        $crud->fetchData(
            $table1,
            $limit,
            "SELECT client_id,client_name,phone,client_email,address,name,city,pincode,client_status FROM $table1 inner join $table2 on $table1.city_id=$table2.id inner join $table3 on $table1.state_id= $table3.id 
where client_status like '%$status%' and 
 ( client_name like '%$search%'
or phone like '%$search%' 
or client_email like '%$search%' 
or address like '%$search%' 
or name like '%$search%' 
or city like '%$search%' 
or pincode like '%$search%') 
order by $field $order ",
            "limit $offset, $limit"
        );

        break;

    case   isset($_POST['states']):

        $crud->fetchData('states', 100, 'select id,name from states ', '');
        break;

    case   isset($_POST['city']):
        $state = $_POST['state'];
        $crud->fetchData(
            'cities',
            100,
            "select cities.id, cities.city from cities inner join states on cities.state_id =states.id where states.id = '$state'",
            " "
        );
        break;


    case  isset($_POST['insert_client']) == 'submit':
        $c_name = $_POST['client_name'];
        $c_number = $_POST['client_phone'];
        $c_email = $_POST['client_email'];
        $c_address = $_POST['client_address'];
        $c_state = $_POST['client_state'];
        $c_city = $_POST['client_city'];
        $c_pincode = $_POST['client_pincode'];


        $crud->insertData("client", ['client_name' => $c_name, 'phone' => $c_number, 'client_email' => $c_email, 'address' => $c_address, 'city_id' => $c_city, 'state_id' => $c_state, 'pincode' => $c_pincode]);

        break;

    case  isset($_POST['update_c']):
        $id = $_POST['id'];
        $crud->fetchData("", 100, "select * from client inner join states on client.state_id = states.id inner join cities on client.city_id =cities.id where client_id=$id", "");

        break;

    case  isset($_POST['update_client']):
        $c_id = $_POST['id'];
        $c_name = $_POST['client_name'];
        $c_number = $_POST['client_phone'];
        $c_email = $_POST['client_email'];
        $c_address = $_POST['client_address'];
        $c_city = $_POST['client_city'];
        $c_state = $_POST['client_state'];
        $c_pincode = $_POST['client_pincode'];
        $c_status = $_POST['client_status'];

        $client->update("client", ['client_name' => $c_name, 'phone' => $c_number, 'client_email' => $c_email, 'address' => $c_address, 'city_id' => $c_city, 'state_id' => $c_state, 'pincode' => $c_pincode, 'client_status' => $c_status], $c_id);

        break;

    case   isset($_POST['delete']):
        $id = $_POST['id'];
        $table = 'client';
        $crud->modifyData("delete from $table where client_id =$id");
        break;

    default:

        break;
}
