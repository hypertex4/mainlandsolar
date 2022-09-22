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
    $review = $product->read_product_review_by_id($_GET['pid']);
    if ($review->num_rows > 0) {
        $review_arr = array();
        while ($row = $review->fetch_assoc()) {
            $review_arr[] = array(
                "review_id" => $row['review_id'],
                "review_name" => $row['review_name'],
                "review_comment" => $row['review_comment'],
                "review_rate" => $row['review_rate'],
                "rated_on" => $row['rated_on']
            );
        }
        http_response_code(200);
        echo json_encode(array("status" => 200, "reviews" => $review_arr,));
    } else {
        http_response_code(404);
        echo json_encode(array("status" => 404, "message" => "No Record Found"));
    }
} else {
    http_response_code(503);
    echo json_encode(array("status" => 503, "message" => "Access Denied"));
}