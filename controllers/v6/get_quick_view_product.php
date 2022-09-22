<?php

header("Content-type: application/json; charset=UTF-8");

include_once('../config/database.php');
include_once('../classes/Customer.class.php');
include_once('../classes/Product.class.php');

//create object for db
$db = new Database();
$connection = $db->connect();
$user = new Customer($connection);
$product = new Product($connection);

$product_id = isset($_POST['product_id']) ? $_POST['product_id'] : die();
$prod = $product->read_product_details_by_id($product_id);
if ($prod->num_rows > 0) {
    $prod_arr = array();
    while ($row = $prod->fetch_assoc()){
        $prod_arr[] = array(
            "pro_id" => $row['pro_id'],
            "category_id" => $row['category_id'],
            "category_name" => $row['category_name'],
            "pro_title" => $row['pro_title'],
            "pro_slug" => $row['pro_slug'],
            "pro_image1" => $row['pro_image1'],
            "pro_image2" => $row['pro_image2'],
            "pro_image3" => $row['pro_image3'],
            "pro_price" => $row['pro_price'],
            "pro_weight" => $row['pro_weight'],
            "pro_features" => $row['pro_features'],
            "pro_spec" => $row['pro_spec'],
            "pro_desc" => $row['pro_desc'],
            "pro_date" => $row['pro_date'],
            "pro_active" => $row['pro_active']
        );
    }
    http_response_code(200);
    echo json_encode(array("status" => 200,"product" => $prod_arr));
}
