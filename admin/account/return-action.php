<?php
ob_start(); session_start();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type: application/json; charset=UTF-8");

include_once('../controllers/config/database.php');
include_once('../controllers/classes/Customer.class.php');

$db = new Database();
$connection = $db->connect();
$user = new Customer($connection);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $order_detail_id = trim($_POST['order_detail_id']);
    $order_comment = trim($_POST['order_comment']);

    if ($user->update_order_details_item_status($order_detail_id,$order_comment,"Returned")){
        http_response_code(200);
        echo json_encode(array("status" => 200, "message" => "Thanks, your report will be attended to shortly"));
    } else {
        http_response_code(400);
        echo json_encode(array("status" => 400, "message" => "Failed, cannot send report now. try again"));
    }
}