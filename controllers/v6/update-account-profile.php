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
    $fn = trim($_POST['firstname']);
    $ln = trim($_POST['lastname']);
    $em = trim($_POST['email']);
    $mb = trim($_POST['mobile']);

    if (!empty($fn) && !empty($ln) && !empty($em)) {
        $user_id = $_SESSION['USER_LOGIN']['customer_id'];
        if ($user->update_account_profile($fn,$ln,$em,$mb,$user_id)){
            http_response_code(200);
            echo json_encode(array("status"=>200,"message"=>"Your account has been updated. N.B.Changes will take effect on your next login."));
        } else {
            http_response_code(500);
            echo json_encode(array("status" =>500,"message"=>"Failed to update user profile, no changes detected. (Contact admin)"));
        }
    } else {
        http_response_code(500);
        echo json_encode(array("status" => 500, "message" => "Kindly fill the required field"));
    }
} else {
    http_response_code(503);
    echo json_encode(array("status" => 503, "message" => "Access Denied"));
}