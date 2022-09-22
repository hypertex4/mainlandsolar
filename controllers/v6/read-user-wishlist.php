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
    $customer_id = isset($_GET['customer_id']) ? $_GET['customer_id'] : die();
    $wList = $user->read_customer_wish_list($customer_id);
    if ($wList->num_rows > 0) {
        $wList_arr = array();
        while ($row = $wList->fetch_assoc()) {
            $wList_arr[] = array(
                "wlist_id" => $row['wlist_id'],
                "pro_id" => $row['pro_id'],
                "pro_title" => $row['pro_title'],
                "pro_slug" => $row['pro_slug'],
                "pro_price" => $row['pro_price'],
                "pro_image1" => $row['pro_image1']
            );
        }
        http_response_code(200);
        echo json_encode(array("status" => 200, "wishlist" => $wList_arr));
    } else {
        http_response_code(404);
        echo json_encode(array("status" => 404, "message" => "No Record Found"));
    }
} else {
    http_response_code(503);
    echo json_encode(array("status" => 503, "message" => "Access Denied"));
}