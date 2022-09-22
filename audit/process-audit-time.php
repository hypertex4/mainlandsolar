<?php
session_start();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-type: application/json; charset=UTF-8");

if (!empty($_POST['time'])) {
    $_SESSION['HOME_AUDIT']['picked_time'] = isset($_POST['time']) ? $_POST['time'] : "";

    http_response_code(200);
    echo json_encode(array("status"=>1,"location"=>"audit-payment"));
} else {
    http_response_code(200);
    echo json_encode(array("status"=>0,"message"=>"Please select your audit time"));
}
?>