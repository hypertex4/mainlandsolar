<?php
// include headers
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
    $email = trim($_POST['email']);
    $pwd = trim($_POST['password']);
    if (!empty($email) && !empty($pwd)){
        $user_data = $user->login_user($email);
        if (!empty($user_data)){
            $email = $user_data['email'];
            $password = $user_data['password'];
            if (password_verify($pwd,$password)) {
                if (isset($_SESSION['USER_LOGIN']['oldUrl'])){ $location = "product/checkout"; }
                else {$location= "product/index";}
                $account_arr = array(
                    "customer_id"=>$user_data['customer_id'],
                    "firstname"=>$user_data['firstname'],
                    "lastname"=>$user_data['lastname'],
                    "email"=>$user_data['email'],
                    "mobile"=>$user_data['mobile']
                );
                http_response_code(200);
                echo json_encode(array("status"=>1, "user_details"=>$account_arr, "message"=>"User logged in successfully", "location"=> $location));
                $_SESSION['USER_LOGIN'] = $account_arr;
            } else {
                http_response_code(200);
                echo json_encode(array("status"=>0,"message"=>"Invalid credentials, password incorrect. Try resetting your password."));
            }
        } else {
            http_response_code(200);
            echo json_encode(array("status"=>0,"message"=>"Invalid credentials, email does not match any record."));
        }
    } else {
        http_response_code(200);
        echo json_encode(array("status"=>0,"message"=>"Kindly fill the required field"));
    }
} else {
    http_response_code(200);
    echo json_encode(array("status"=>0,"message"=>"Access Denied"));
}