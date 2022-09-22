<?php
include_once ('../controllers/classes/Admin.class.php');

if (isset($_GET['order_id'])) {
    if ($admin->update_order_status($_GET['order_id'])) {
        http_response_code(200);
        echo json_encode(array("status" => 200, "message" => "Order status updated and mark as delivered"));
    }
}

?>