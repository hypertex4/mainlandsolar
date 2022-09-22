<?php
// include headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type: application/json; charset=UTF-8");

include_once('../config/database.php');
include_once('../classes/Customer.class.php');
//create object for db
$db = new Database();
$connection = $db->connect();
$user = new Customer($connection);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $otp = isset($_POST['otp']) ? $_POST['otp'] : null;
    if (empty($otp)) {
        http_response_code(200);
        echo json_encode(array("status" => 0, "message" => "Could not validate your request"));
    } else {
        $activate_data = $user->check_account_activation_credentials($otp);
        if (!empty($activate_data)) {
            $email = $activate_data['temp_email'];
            $email_check = $user->check_active_account($email);
            if (empty($email_check)) {
                if ($user->activate_account($email)) {
                    http_response_code(200);
                    echo json_encode(array("status" => 1, "message" => "Account as been successfully activated, enjoy!"));
                } else {
                    http_response_code(200);
                    echo json_encode(array("status" => 0, "message" => "Error while trying to activate account, contact support (support@vanlagos.com)"));
                }
            } else {
                http_response_code(200);
                echo json_encode(array("status" => 0, "message" => "Account is already active, login to proceed"));
            }
        } else {
            http_response_code(200);
            echo json_encode(array("status" => 0, "message" => "Invalid/Expired OTP, re-submit your registration details to get a refresh OTP"));
        }
    }
} else {
    http_response_code(200);
    echo json_encode(array("status" => 0, "message" => "Access Denied"));
}
?>