<?php
ob_start(); session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-type: application/json; charset=UTF-8");

include_once('database.php');
include_once('Audit.class.php');

//create object for db
$db = new Database();
$connection = $db->connect();
$audit = new Audit($connection);

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    $res = $audit->get_audit_bookings();
	$bookings_arr = array();
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()){
            $bookings_arr[] = date("d/m/Y",strtotime($row['b_date']));
        }
		http_response_code(200);
		echo json_encode(array("status"=>1,"message"=>"Done.","b_dates"=>$bookings_arr));
    } else {
        http_response_code(200);
        echo json_encode(array("status"=>0,"message"=>"No Record Found","b_dates"=>$bookings_arr));
    }
} else {
    http_response_code(503);
    echo json_encode(array("status" => 0, "message" => "Access Denied"));
}