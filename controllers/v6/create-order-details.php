<?php
ob_start(); session_start();
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
$errCount=0;
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $datas = json_decode(file_get_contents("php://input"));
    $order_id = $datas[0][0]->order_id;
    $customer_id = $_SESSION['USER_LOGIN']['customer_id'];

    foreach ($datas[1] as $data => $item){
        $product_id = $item->id;
        $product_qty = $item->qty;
        if ($product->create_order_details($order_id,$customer_id,$product_id,$product_qty)){}
        else {$errCount++;}
    }
} else { $errCount++; }

if ($errCount===0){
    unset($_SESSION['user_login_temp']);
    http_response_code(200);
    echo json_encode(array("status" => "SUCCESS", "message" => "Order successfully completed"));
} else  {
    http_response_code(500);
    echo json_encode(array("status" => "ServerErr", "message" => "Internal server error, cannot complete order"));
}