<?php session_start();
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
    if (!empty($data->product_id)) {
        if (!isset($_SESSION['USER_LOGIN']['customer_id'])){
            http_response_code(400);
            echo json_encode(array("status" => 400, "message" => "You need to be logged in to save item"));
        } else {
            $c_id = $_SESSION['USER_LOGIN']['customer_id'];
            $pro_id = $data->product_id;
            $wlist = $product->create_wish_list($c_id,$pro_id);
            if ($wlist === 'exist') {
                http_response_code(500);
                echo json_encode(array("status" => 500, "message" => "Item in your wishlist, to remove check your account profile"));
            } else if ($wlist === true) {
                http_response_code(200);
                echo json_encode(array("status" => 200, "message" => "Item saved to your wishlist"));
            } else {
                http_response_code(500);
                echo json_encode(array("status" => 500, "message" => "Product cannot be added to wishlist"));
            }
        }
    } else {
        http_response_code(500);
        echo json_encode(array("status" => 500, "message" => "Empty product/Invalid user"));
    }
} else {
    http_response_code(500);
    echo json_encode(array("status" => 500, "message" => "Access Denied"));
}