<?php

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
    $order = $user->order_by_id($order_id);
    if ($order->num_rows > 0) {
        $order_arr = array();
        while ($row = $order->fetch_assoc()) {
            $order_arr[] = array(
                "order_id" => $row['order_id'],                
                "customer_id" => $row['customer_id'],
                "order_amount" => $row['order_amount'],
                "order_qty" => $row['order_qty'],
                "receiver_fullname" => $row['receiver_fname']." ".$row['receiver_lname'],
                "order_on" => $row['order_on'],
                "receiver_email" => $row['receiver_email'],
                "order_status" => $row['order_status']
            );
        }
        http_response_code(200);
        echo json_encode(array("status" => 200, "order" => $order_arr,));
    } else {
        http_response_code(404);
        echo json_encode(array("status" => 404, "message" => "No Record Found"));
    }
} else {
    http_response_code(503);
    echo json_encode(array("status" => 503, "message" => "Access Denied"));
}