<?php
session_start();
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
    if (!empty($data->wList_id)){
        $cid = $_SESSION['USER_LOGIN']['customer_id'];
        $wid = $data->wList_id;

        if ($user->delete_customer_wish_list_item($cid,$wid)){
            http_response_code(200); //200 means Ok status
            echo json_encode(array("status" => 200, "message" => "Item successfully removed"));
        } else {
            http_response_code(404);
            echo json_encode(array("status" => 404, "message" => "Unable to remove item"));
        }
    } else {
        http_response_code(404);
        echo json_encode(array("status" => 404, "message" => "Server error, try again later"));
    }
} else {
    http_response_code(503); //503 means service unavailable
    echo json_encode(array("status" => 503, "message" => "Access Denied"));
}