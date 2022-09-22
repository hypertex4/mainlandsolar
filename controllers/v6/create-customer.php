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
    $f_name = trim($_POST['firstname']);
    $l_name = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $pwd = trim($_POST['password']);
    $rpt_pwd = trim($_POST['confirm_password']);
    if (!empty($f_name) && !empty($l_name) && !empty($email) && !empty($pwd) && !empty($rpt_pwd)) {
        if ($pwd !== $rpt_pwd){
            http_response_code(200);
            echo json_encode(array("status"=>0,"message"=>"Password combination did not match, try again."));
        } else {
            $password = password_hash($pwd, PASSWORD_DEFAULT);

            $email_data = $user->check_active_account($email);
            if (empty($email_data)) {
                if ($user->create_user($f_name,$l_name,$email,$phone,$password)) {
                    if ($user->create_temp_activate_account($email,$f_name)) {
                        http_response_code(200);
                        echo json_encode(array("status" => 1, "message" => "Almost done, confirmation code sent to your email to complete your registration. (NB: OTP will expire after 2hrs.)"));
                    } else {
                        http_response_code(200);
                        echo json_encode(array("status" => 0, "message" => "Internal server error, mail cannot be sent."));
                    }
                } else {
                    http_response_code(200);
                    echo json_encode(array("status" => 0, "message" => "Internal server error, failed to save user."));
                }
            } else {
                http_response_code(200);
                echo json_encode(array("status" => 0, "message" => "Customer email already exists, try another email address"));
            }
        }
    } else {
        http_response_code(200);
        echo json_encode(array("status"=>0,"message"=>"Kindly fill the required field"));
    }
} else {
    http_response_code(200);
    echo json_encode(array("status"=>0,"message"=>"Access Denied"));
}