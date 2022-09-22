<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-type: application/json; charset=UTF-8");

include_once('database.php');
include_once('Audit.class.php');

//create object for db
$db = new Database();
$connection = $db->connect();
$audit = new Audit($connection);


if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $client_name  = $_POST['client_name'];
    $phone_no  = $_POST['phone_no'];
    $email  = $_POST['email'];
    $survey_loc  = $_POST['survey_loc'];
    $survey_add  = $_POST['survey_add'];
    $sur_other_loc  = $_POST['sur_other_loc'];
    $pry_purpose  = $_POST['pry_purpose'];
    $solar_coverage  = $_POST['solar_coverage'];
    $panel_space  = $_POST['panel_space'];
    $other_info  = $_POST['other_info'];
    $booking_date = $_SESSION['HOME_AUDIT']['checked_date'];
    $booking_time = $_SESSION['HOME_AUDIT']['picked_time'];
    $created_on = date("d-m-Y H:i:s");


    $payment_method  = $_POST['payment_method'];
    $payment_ref  = $_POST['payment_ref'];
    $amount = 15000;
    if (!empty($client_name) && !empty($phone_no) && !empty($email) && !empty($survey_loc) && !empty($survey_add)
        && !empty($pry_purpose) && !empty($solar_coverage) && !empty($panel_space)) {
        $response = $audit->create_audit_request(
            $client_name,$phone_no,$email,$survey_loc,$survey_add,$sur_other_loc,$pry_purpose,$solar_coverage,
            $panel_space,$other_info,$booking_date,$booking_time,$created_on
        );
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