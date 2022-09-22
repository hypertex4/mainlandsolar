<?php
session_start();
//echo session_id();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-type: application/json; charset=UTF-8");

unset($_SESSION['HOME_AUDIT']);
$_SESSION['HOME_AUDIT']['checked_date'] = isset($_POST['picked_date'])?date('d-m-Y', strtotime($_POST['picked_date'])):"";

http_response_code(200);
echo json_encode(array("status"=>1,"location"=>"audit-time"));
?>