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
    $pro_slug = isset($_GET['pro_slug']) ? $_GET['pro_slug'] : die();
    $prod_slug = $product->read_product_details_by_slug($pro_slug);
    if ($prod_slug->num_rows > 0) {
        $prod_slug_arr = array();
        while ($row = $prod_slug->fetch_assoc()){
            $prod_slug_arr[] = array(
                "pro_id" => $row['pro_id'],
                "category_id" => $row['category_id'],
                "category_name" => $row['category_name'],
                "pro_title" => $row['pro_title'],
                "pro_slug" => $row['pro_slug'],
                "pro_image1" => $row['pro_image1'],
                "pro_image2" => $row['pro_image2'],
                "pro_image3" => $row['pro_image3'],
                "dataset" => $row['dataset'],
                "pro_price" => $row['pro_price'],
                "solar_panel" => $row['solar_panel'],
                "batt_type" => $row['batt_type'],
                "batt_volts" => $row['batt_volts'],
                "pro_spec" => $row['pro_spec'],
                "pro_desc" => $row['pro_desc'],
                "pro_date" => $row['pro_date'],
                "pro_active" => $row['pro_active']
            );
        }
        http_response_code(200);
        echo json_encode(array("status" => 200,"productSlug" => $prod_slug_arr));
    } else {
        http_response_code(404);
        echo json_encode(array("status"=>404,"message"=>"No Record Found"));
    }
} else {
    http_response_code(503);
    echo json_encode(array("status"=>503,"message"=>"Access Denied"));
}