<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-type: application/json; charset=UTF-8");

include_once('../config/database.php');
include_once('../classes/Customer.class.php');
include_once('../classes/Product.class.php');

//create object for db
$db = new Database();
$connection = $db->connect();
$user = new Customer($connection);

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    $post_slug = isset($_GET['post_slug']) ? $_GET['post_slug'] : die();
    $post_res = $user->read_blog_post_by_slug($post_slug);
    if ($post_res->num_rows > 0) {
        $post_slug_arr = array();
        while ($row = $post_res->fetch_assoc()){
            $post_slug_arr[] = array(
                "post_sno" => $row['post_sno'],
                "post_id" => $row['post_id'],
                "post_image1" => $row['post_image1'],
                "post_title" => $row['post_title'],
                "post_slug" => $row['post_slug'],
                "post_author" => $row['post_author'],
                "post_body" => $row['post_body'],
                "category_name" => $row['category_name'],
                "post_created" => $row['post_created']
            );
        }
        http_response_code(200);
        echo json_encode(array("status" => 200,"postSlug" => $post_slug_arr));
    } else {
        http_response_code(404);
        echo json_encode(array("status"=>404,"message"=>"No Record Found"));
    }
} else {
    http_response_code(503);
    echo json_encode(array("status"=>503,"message"=>"Access Denied"));
}