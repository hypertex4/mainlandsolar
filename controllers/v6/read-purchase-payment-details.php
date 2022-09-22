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
    $order_id = isset($_GET['purchase_id']) ? hex2bin($_GET['purchase_id']) : die();
    $order_payment = $user->order_by_payment($order_id);
    if ($order_payment->num_rows > 0) {
        $order_payment_arr = array();
        while ($row = $order_payment->fetch_assoc()) {
            $order_payment_arr[] = array(
                "order_id" => $row['order_id'],
                "payment_option" => $row['payment_option'],
                "payment_status" => $row['payment_status'],
                "payment_amount" => $row['payment_amount'],
                "shipping_type" => $row['shipping_type'],
                "order_ship_fee" => $row['order_ship_fee'],
                "receiver_fullname" => $row['receiver_fname']." ".$row['receiver_lname'],
                "receiver_full_add" => $row['receiver_address'].", ".$row['receiver_state'],
            );
        }
        http_response_code(200); //200 means Ok status
        echo json_encode(array("status"=>200,"order_payment"=>$order_payment_arr,));
    } else {
        http_response_code(404);
        echo json_encode(array("status"=>404,"message"=>"No Record Found"));
    }
} else {
    http_response_code(503); //503 means service unavailable
    echo json_encode(array("status"=>503,"message"=>"Access Denied"));
}