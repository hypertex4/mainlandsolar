<?php

// include headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-type: application/json; charset=UTF-8");

include_once('../config/database.php');
include_once('../classes/Customer.class.php');

//create object for db
$db = new Database();
$connection = $db->connect();
$user = new Customer($connection);

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    $customer_id = isset($_GET['customer_id']) ? $_GET['customer_id'] : die();
    $orders = $user->orders($customer_id);
        if ($orders->num_rows > 0) {
            $orders_arr = array();
            while ($row = $orders->fetch_assoc()) {
                $orders_arr[] = array(
                    "order_id" => $row['order_id'],
                    "order_ref" => $row['order_ref'],
                    "order_amount" => $row['order_amount'],
                    "receiver_fullname" => $row['receiver_fname']." ".$row['receiver_lname'],
                    "order_on" => $row['order_on'],
                    "order_status" => $row['order_status'],
                    "order_address" => $row['receiver_address']." ".$row['receiver_state'],
                    "payment_status" => $row['payment_status'],
                );
            }
            http_response_code(200); //200 means Ok status
            echo json_encode(array("status" => 200, "orders" => $orders_arr,));
        } else {
            http_response_code(404);
            echo json_encode(array("status" => 404, "message" => "No Record Found"));
        }
} else {
    http_response_code(503); //503 means service unavailable
    echo json_encode(array("status" => 503, "message" => "Access Denied"));
}