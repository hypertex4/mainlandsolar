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

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $data = json_decode(file_get_contents("php://input"));
    if (isset($_SESSION['USER_LOGIN']['customer_id'])) {
        if (!empty($data->order_id) && !empty($data->account_name) && !empty($data->amount)) {
            $product->order_id = $data->order_id;
            $product->account_name = $data->account_name;
            $product->transferred_amount = $data->amount;

            if ($product->create_transfer_request()) {
                unset($_SESSION['user_login_temp']);
                http_response_code(200);
                echo json_encode(array("status" => "SUCCESS", "message" => "Request submitted successfully"));
            } else {
                http_response_code(500);
                echo json_encode(array("status" => "ServerErr", "message" => "Error submitting transfer request"));
            }
        } else {
            http_response_code(500);
            echo json_encode(array("status" => "EmptyErr", "message" => "Some required field is empty"));
        }
    } else {
        http_response_code(503);
        echo json_encode(array("status" => 0, "message" => "Access Denied"));
    }
}