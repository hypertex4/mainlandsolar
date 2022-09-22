<?php
include_once('../controllers/config/database.php');
include_once ('../controllers/classes/Audit.class.php');

//create object for db
$db = new Database();
$connection = $db->connect();
$audit = new Audit($connection);

if ($audit->update_energy_audit_transfer_request($_GET['aud_pay_id'],$_GET['aud_book_sno']) && $_GET['action']==102){
    http_response_code(200);
    echo json_encode(array("status"=>200,"message"=>"Energy Audit Booking status updated and mark as paid"));
}

?>