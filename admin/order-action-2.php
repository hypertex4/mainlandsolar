<?php
include_once ('../controllers/classes/Admin.class.php');

if ($admin->update_transfer_request($_GET['order_id']) && $_GET['action']==101){
    http_response_code(200);
    echo json_encode(array("status"=>200,"message"=>"Order status updated and mark as delivered"));
}


?>