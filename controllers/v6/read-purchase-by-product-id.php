<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-type: application/json; charset=UTF-8");

include_once('../config/database.php');
include_once('../classes/Customer.class.php');
include_once('../classes/Product.class.php');

//create object for db
$db = new Database();
$connection = $db->connect();
$user = new Customer($connection);
$product = new Product($connection);

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    $order_id = isset($_GET['purchase_id']) ? hex2bin($_GET['purchase_id']):die();
    $products = $user->order_by_product($order_id);
    if ($products->num_rows > 0) {
        $products_arr = array();
        while ($row = $products->fetch_assoc()) {
            $products_arr[] = array(
                "order_id" => $row['order_id'],
                "order_details_id" => $row['order_details_id'],
                "pro_id" => $row['pro_id'],
                "pro_image1" => $row['pro_image1'],
                "pro_title" => $row['pro_title'],
                "product_qty" => $row['product_qty'],
                "pro_price" => $row['pro_price'],
            );
        }
        http_response_code(200); //200 means Ok status
        echo json_encode(array("status"=>200,"products"=>$products_arr,));
    } else {
        http_response_code(404);
        echo json_encode(array("status"=>404,"message"=>"No Record Found"));
    }
} else {
    http_response_code(503); //503 means service unavailable
    echo json_encode(array("status"=>503,"message"=>"Access Denied"));
}