<?php


include '../project/database/db_logics.php';



switch (true) {


    case    isset($_POST['submit_item']):
        $table = 'items';
        $i_name = $_POST['item_name'];
        if (empty($i_name)) {
            echo "enter name";
            return;
        }
        $i_price = $_POST['item_price'];
        if (empty($i_price)) {
            echo "enter price";
            return;
        }
        else if($i_price<1){
        $i_price=1;
        }
        $i_description = $_POST['item_description'];
        if (empty($i_description)) {
            echo "enter description";
            return;
        }
        $i_image_name = $_FILES['itemimage']['name'];
        if (empty($i_image_name)) {
            echo "enter image";
            return;
        }
        
        $i_image_tmp = $_FILES['itemimage']['tmp_name'];
        $i_image_type = $_FILES['itemimage']['type'];
        $i_image_content = file_get_contents($i_image_tmp);
        $uploadDir = 'uploads/';
        $filePath = $uploadDir . basename($i_image_name);
        move_uploaded_file($i_image_tmp, $filePath);

        $crud->insertData($table, ['item_name' => $i_name, 'price' => $i_price, 'description' => $i_description, 'item_image' => $filePath]);

        break;



    case    isset($_POST['showItems']):
        $table = 'items';
        $page = $_POST['page'] ?? 1;
        $field = $_POST['field'] ?? 'item_id';
        $order = $_POST['order'] ?? 'asc';
        $limit = $_POST['limit'] ?? 10;
        $limit = (int) $limit;
        $offset = ($page - 1) * $limit;
        $search = $_POST['search'] ?? "";
        $crud->fetchData($table, $limit, "select * from $table 
    where
     item_name like '%$search%'
      order by $field $order      
    ", " limit $offset , $limit");
        break;


    case    isset($_POST['update']):
        $table = 'items';
        $id = $_POST['id'];
        $crud->updateForm("select * from $table where item_id=$id");
        break;


    case   isset($_POST['updateItem']):
        $table = 'items';
        $id = $_POST['item_id'];
        $name = $_POST['item_name'];
        if (empty($name)) {
            echo "enter name";
            return;
        }
        $description = $_POST['item_description'];
        if (empty($description)) {
            echo "enter description";
            return;
        }
        $price = $_POST['item_price'];
        if (empty($price)) {
            echo "enter price";
            return;
        }
        $image_name = $_FILES['itemimage']['name'];

        if (empty($image_name)) {
            $path = "";
        } else {
            $image_tmp = $_FILES['itemimage']['tmp_name'];
            $image_type = $_FILES['itemimage']['type'];

            $image_content = file_get_contents($image_tmp);
            $uploadDir = 'uploads/';
            $filePath = $uploadDir . basename($image_name);
            move_uploaded_file($image_tmp, $filePath);
            $path = ", item_image = '$filePath' ";
        }

        $crud->modifyData("update $table set 
    item_name='$name' ,
    description='$description' ,
    price=$price 
    $path 
    where item_id=$id
    ");
        break;


    case    isset($_POST['delete']):
        $id = $_POST['id'];
        $table = 'items';
        $crud->modifyData("delete from $table where item_id =$id");
        break;

    default:
        break;
}
