<?php
session_start();
// include headers
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
    // set ID property of record to read
    $product_id = isset($_GET['product_id']) ? $_GET['product_id'] : die();
    $order_detail_id = isset($_GET['order_detail_id']) ? $_GET['order_detail_id'] : die();

    $prod = $user->read_product_by_order_details_id($product_id,$order_detail_id);
    if ($prod->num_rows > 0) {
        $product_arr = array();
        while ($row = $prod->fetch_assoc()){
            $product_arr[] = array(
                "product_qty" => $row['product_qty'],
                "pro_id" => $row['pro_id'],
                "pro_title" => $row['pro_title'],
                "pro_price" => $row['pro_price'],
                "pro_image1" => $row['pro_image1']
            );
        }
        http_response_code(200); //200 means Ok status
        echo json_encode(array("status" => 200, "product" => $product_arr,));
    } else {
        http_response_code(404);
        echo json_encode(array("status" => 404, "message" => "No Record Found"));
    }
} else {
    http_response_code(503);
    echo json_encode(array("status" => 503, "message" => "Access Denied"));
}