<?php

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
    $captcha_answer = htmlspecialchars(strip_tags($_POST['captcha_answer']));
    $fname = htmlspecialchars(strip_tags($_POST['firstname']));
    $lname = htmlspecialchars(strip_tags($_POST['lastname']));
    $phone = htmlspecialchars(strip_tags($_POST['phone']));
    $email = htmlspecialchars(strip_tags($_POST['email']));
    $service = htmlspecialchars(strip_tags($_POST['request']));
    $description = htmlspecialchars(strip_tags($_POST['description']));
    if (!empty($fname) && !empty($lname) && !empty($phone) && !empty($email) && !empty($service) && !empty($description) && !empty($captcha_answer)) {
        if ($captcha_answer != 73){
            http_response_code(200);
            echo json_encode(array("status"=>0,"message"=>"Incorrect caption answer."));
        } else {
            if ($user->send_contact_us_mail($fname,$lname,$phone,$email,$service,$description)) {
                http_response_code(200);
                echo json_encode(array("status" => 1, "message" => "Message sent. Our customer support will get back to you shortly."));
            } else {
                http_response_code(200);
                echo json_encode(array("status" => 0, "message" => "Failed to send message"));
            }
        }
    } else {
        http_response_code(200);
        echo json_encode(array("status"=>0,"message"=>"Fill all required field"));
    }
} else {
    http_response_code(200);
    echo json_encode(array("status" => 0, "message" => "Access Denied"));
}