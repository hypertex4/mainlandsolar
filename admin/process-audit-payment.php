<?php
ob_start(); session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-type: application/json; charset=UTF-8");

include_once('../config/database.php');
include_once('../classes/Audit.class.php');

//create object for db
$db = new Database();
$connection = $db->connect();
$audit = new Audit($connection);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $first_name  = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $phone_no  = $_POST['phone_no'];
    $email  = $_POST['email'];
    $streetLga  = $_POST['streetLga'];
    $street_address  = $_POST['street_address'];
    $booking_date = $_SESSION['HOME_AUDIT']['checked_date'];
    $booking_time = $_SESSION['HOME_AUDIT']['picked_time'];
    $created_on = date("d-m-Y H:i:s");

    $payment_method  = $_POST['payment_method'];
    $payment_ref  = $_POST['payment_ref'];
    $amount = 15000;
    if (!empty($first_name) && !empty($last_name) && !empty($phone_no) && !empty($email) && !empty($streetLga) && !empty($street_address)) {
        $response = $audit->create_audit_request($first_name,$last_name,$phone_no,$email,$streetLga,$street_address,$booking_date,$booking_time,$created_on);
        if ($response !== false){
            if (empty($payment_ref)) $payment_ref = "T".rand(1000000000,9999999999);

            if ($payment_method==="Paystack") $payment_status = "Paid";
            else $payment_status = "Unverified";

            if ($audit->create_audit_payment($response,$amount,$payment_ref,$payment_method,$payment_status)){
                if ($payment_method == "bankTransfer"){
                    $acc_name = $_POST['aud_account_name'];
                    $tf_amt = $_POST['aud_amt_transferred'];
                    $audit->create_transfer_request($response,$acc_name,$tf_amt);
                }
                unset($_SESSION['HOME_AUDIT']);
                http_response_code(200);
                echo json_encode(array("status"=>1,"message"=>"Your booking has been received, our customer support will reach to you shortly."));
            } else {
                http_response_code(200);
                echo json_encode(array("status" => 0, "message" => "Payment cannot be created, cannot complete booking"));
            }
        } else {
            http_response_code(200);
            echo json_encode(array("status" => 0, "message" => "Internal server error, cannot complete booking"));
        }
    } else {
        http_response_code(200);
        echo json_encode(array("status" => 0, "message" => "Fill all required field and try again."));
    }
} else {
    http_response_code(503);
    echo json_encode(array("status" => 0, "message" => "Access Denied"));
}