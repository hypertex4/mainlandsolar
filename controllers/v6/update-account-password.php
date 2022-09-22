<?php

session_start();
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
    $np = trim($_POST['new_password']);
    $r_np = trim($_POST['repeat_password']);

    if (!empty($np) && !empty($r_np)) {
        if (empty(trim($r_np)) || strlen($np) < 6) {
            http_response_code(404);
            echo json_encode(array("status"=>404,"message"=>"New/Repeat password must be at least six(6) character"));
        } else {
            if (trim($np) !== trim($r_np)) {
                http_response_code(500);
                echo json_encode(array("status"=>500,"message"=>"New password combination did not match, try again."));
            } else {
                $email = $_SESSION['USER_LOGIN']['email'];
                $user_data = $user->login_user($email);
                if (password_verify($np,$user_data['password'])) {
                    http_response_code(500);
                    echo json_encode(array("status" =>500,"message"=>"Password already in use."));
                } else {
                    $user_id = $_SESSION['USER_LOGIN']['customer_id'];
                    $new_pwd = password_hash($np,PASSWORD_DEFAULT);

                    if ($user->update_account_password($new_pwd,$user_id)){
                        http_response_code(200);
                        echo json_encode(array("status"=>200,"message"=>"Successfully Updated, your account has been updated. N.B.Changes will take effect on your next login."));
                    } else {
                        http_response_code(500);
                        echo json_encode(array("status" =>500,"message"=>"Failed to update user, contact admin via the help line"));
                    }
                }
            }
        }
    } else {
        http_response_code(500);
        echo json_encode(array("status" => 500, "message" => "Kindly fill the required field"));
    }
} else {
    http_response_code(503);
    echo json_encode(array("status" => 503, "message" => "Access Denied"));
}