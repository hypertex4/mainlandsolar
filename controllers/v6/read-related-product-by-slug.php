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
    $related = $product->read_related_product($_GET['cat_id'],$_GET['slug']);
    if ($related->num_rows > 0) {
        $related_arr = array();
        while ($row = $related->fetch_assoc()){
            $related_arr[] = array(
                "pro_id" => $row['pro_id'],
                "pro_title" => $row['pro_title'],
                "pro_slug" => $row['pro_slug'],
                "pro_image1" => $row['pro_image1'],
                "pro_price" => $row['pro_price']
            );
        }
        http_response_code(200);
        echo json_encode(array("status" => 200,"related_products" => $related_arr));
    } else {
        http_response_code(404);
        echo json_encode(array("status"=>404,"message"=>"No Record Found"));
    }
} else {
    http_response_code(503);
    echo json_encode(array("status"=>503,"message"=>"Access Denied"));
}