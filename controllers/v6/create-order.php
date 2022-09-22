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
    if (!empty($data->total_amount) && !empty($data->total_qty)) {
        if (isset($_SESSION['USER_LOGIN']['customer_id'])) {
            $o_ref = 200000+rand(1000,9999);
            $c_id = $_SESSION['USER_LOGIN']['customer_id'];
            $o_amt = $data->total_amount;
            $o_sfee = $data->order_shipping;
            $o_qty = $data->total_qty;
            $r_fn = $data->firstname;
            $r_ln = $data->lastname;
            $r_em = $data->email;
            $r_ph = $data->phone;
            $r_ad = $data->address;
            $r_st = $data->state;
            $s_type = "";
            $pay_opt = $data->payment_method;

            $response = $product->create_order($o_ref,$c_id,$o_amt,$o_qty,$o_sfee,$r_fn,$r_ln,$r_em,$r_ph,$r_ad, $r_st,$s_type,$pay_opt);
            if ($response !== false){
                if (!empty($data->payment_ref)) $payment_ref = $data->payment_ref;
                else $payment_ref = "T".rand(100000000000000,999999999999999);

                if ($data->payment_method==="DebitCard") $payment_status = "Paid";
                else $payment_status = "Unverified";

                if ($product->create_order_payment($response,$o_amt,$payment_ref,$payment_status)){
                    http_response_code(200);
                    echo json_encode(array("status"=>200,"order_id"=>$response));
                } else {
                    http_response_code(500);
                    echo json_encode(array("status" => "PaymentErr", "message" => "Payment cannot be created, cannot complete order"));
                }
            } else {
                http_response_code(500);
                echo json_encode(array("status" => "ServerErr", "message" => "Internal server error, cannot complete order"));
            }
        } else {
            $_SESSION['user_login_temp']['oldUrl'] = "true";
            http_response_code(500);
            echo json_encode(array("status" => "AuthErr", "message" => "Unauthorized, kindly login to complete order"));
        }
    } else {
        http_response_code(500);
        echo json_encode(array("status" => "CartErr", "message" => "Internal server error, cannot complete order"));
    }
} else {
    http_response_code(503);
    echo json_encode(array("status" => 0, "message" => "Access Denied"));
}