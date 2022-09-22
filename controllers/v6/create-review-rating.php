<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
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
        if (!empty($data->rating_value) && !empty($data->review_comment)) {
            $review_rate = $data->rating_value;
            $review_comment = $data->review_comment;
            $review_name = $data->review_name;
            $product_id = $data->product_id;
            $order_details_id = $data->order_details_id;

            if ($product->create_review_rating($review_name,$review_comment,$review_rate,$order_details_id,$product_id)){
                http_response_code(200);
                echo json_encode(array("status"=>200,"message"=>"Feedback received"));
            } else {
                http_response_code(500);
                echo json_encode(array("status"=>500,"message"=>"Feedback not sent, try again later"));
            }
        } else {
            http_response_code(500);
            echo json_encode(array("status" =>500,"message"=>"Comment/Rating value is needed"));
        }
} else {
    http_response_code(503);
    echo json_encode(array("status"=>503,"message"=>"Access Denied"));
}