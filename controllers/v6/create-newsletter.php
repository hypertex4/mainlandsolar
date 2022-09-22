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
    $subscriber_email = $_POST['email'];
    if (!empty($subscriber_email)) {
        $email_data = $user->check_news_subscriber_email($subscriber_email);
        if (!empty($email_data)) {
            http_response_code(200);
            echo json_encode(array("status" => 0, "message" => "Subscriber email already exists."));
        } else {
            if ($user->create_subscriber($subscriber_email)) {
                http_response_code(200);
                echo json_encode(array("status" => 1, "message" => "Congrats!, you have successfully subscribe to our news channel."));
            } else {
                http_response_code(200);
                echo json_encode(array("status" => 0, "message" => "Failed to save user"));
            }
        }
    }
} else {
    http_response_code(200);
    echo json_encode(array("status" => 0, "message" => "Access Denied"));
}