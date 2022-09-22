<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type: application/json; charset=UTF-8");
include_once('../controllers/classes/Admin.class.php');

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $data = json_decode(file_get_contents("php://input"));

    if (trim($data->action_code) == '401' && !empty(trim($data->username))) {
        if ($admin->create_admin_user($data->username,$data->password)) {
            http_response_code(200);
            echo json_encode(array("status" => 1, "message" => "Admin User successfully created."));
        } else  {
            http_response_code(500);
            echo json_encode(array("status" => 0, "message" => "Unable to Create User."));
        }
    }

    if (trim($data->action_code) == '402' && !empty(trim($data->admin_id))) {
        if ($admin->delete_admin_user($data->admin_id)) {
            http_response_code(200);
            echo json_encode(array("status" => 1, "message" => "Admin user deleted successfully."));
        } else {
            http_response_code(500);
            echo json_encode(array("status" => 0, "message" => "Unable to delete user."));
        }
    }

    if (trim($data->action_code) == '403' && !empty(trim($data->edit_adm_username))) {
        if ($admin->update_admin_user($data->edit_adm_username,$data->edit_adm_id)) {
            http_response_code(200);
            echo json_encode(array("status" => 1, "message" => "Admin user updated successfully."));
        } else {
            http_response_code(500);
            echo json_encode(array("status" => 0, "message" => "Unable to update user."));
        }
    }



}