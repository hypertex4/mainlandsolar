<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type: application/json; charset=UTF-8");
include_once('../controllers/classes/Admin.class.php');

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $data = json_decode(file_get_contents("php://input"));
    if (trim($data->action_code) == '101' && !empty(trim($data->cat_name))) {
        if ($admin->add_category_product($data->cat_name)) {
            http_response_code(200);
            echo json_encode(array("status" => 1, "message" => "Product category successfully created."));
        } else  {
            http_response_code(500);
            echo json_encode(array("status" => 0, "message" => "Unable to Add Category."));
        }
    }

    if (trim($data->action_code) == '102' && !empty(trim($data->cat_id))) {
        if ($admin->delete_category_product($data->cat_id)) {
            http_response_code(200);
            echo json_encode(array("status" => 1, "message" => "Product category deleted successfully."));
        } else  {
            http_response_code(500);
            echo json_encode(array("status" => 0, "message" => "Unable to delete category."));
        }
    }

    if (trim($data->action_code) == '103' && !empty(trim($data->edit_cat_name)) && !empty(trim($data->edit_cat_id))) {
        if ($admin->update_category_product($data->edit_cat_id,$data->edit_cat_name)) {
            http_response_code(200);
            echo json_encode(array("status" => 1, "message" => "Product category updated successfully."));
        } else {
            http_response_code(500);
            echo json_encode(array("status" => 0, "message" => "Unable to update category."));
        }
    }

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

    if (trim($data->action_code) == '604') {
        if ($admin->update_product_status($data->pid,$data->status)) {
            http_response_code(200);
            echo json_encode(array("status" => 1, "message" => "Product status updated successfully."));
        } else {
            http_response_code(500);
            echo json_encode(array("status" => 0, "message" => "Unable to update product status."));
        }
    }

    if (trim($data->action_code) == '605') {
        if ($admin->update_product_stock_status($data->pid,$data->status)) {
            http_response_code(200);
            echo json_encode(array("status" => 1, "message" => "Product stock status updated successfully."));
        } else {
            http_response_code(500);
            echo json_encode(array("status" => 0, "message" => "Unable to update product stock status."));
        }
    }

    if (trim($data->action_code) == '701' && !empty(trim($data->cat_name))) {
        if ($admin->add_blog_category_product($data->cat_name)) {
            http_response_code(200);
            echo json_encode(array("status" => 1, "message" => "Blog category successfully created."));
        } else  {
            http_response_code(500);
            echo json_encode(array("status" => 0, "message" => "Unable to Add Blog Category."));
        }
    }

    if (trim($data->action_code) == '702' && !empty(trim($data->cat_id))) {
        if ($admin->delete_blog_category_product($data->cat_id)) {
            http_response_code(200);
            echo json_encode(array("status" => 1, "message" => "Product category deleted successfully."));
        } else  {
            http_response_code(500);
            echo json_encode(array("status" => 0, "message" => "Unable to delete category."));
        }
    }

    if (trim($data->action_code) == '703' && !empty(trim($data->edit_cat_name)) && !empty(trim($data->edit_cat_id))) {
        if ($admin->update_blog_category_product($data->edit_cat_id,$data->edit_cat_name)) {
            http_response_code(200);
            echo json_encode(array("status" => 1, "message" => "Blog category updated successfully."));
        } else {
            http_response_code(500);
            echo json_encode(array("status" => 0, "message" => "Unable to update category."));
        }
    }

    if (trim($data->action_code) == '804') {
        if ($admin->update_blog_status($data->pid,$data->status)) {
            http_response_code(200);
            echo json_encode(array("status" => 1, "message" => "Blog post status updated successfully."));
        } else {
            http_response_code(500);
            echo json_encode(array("status" => 0, "message" => "Unable to update blog post status."));
        }
    }

    if (trim($data->action_code) == '1001' && !empty(trim($data->name))) {
        if ($admin->add_installation_history(
            $data->name,$data->size,$data->components,$data->comp_date,$data->issues,$data->action,$data->issue_date,
            $data->resolved_date,$data->client_email,$data->client_add,$data->client_city,$data->client_state
        )) {
            http_response_code(200);
            echo json_encode(array("status" => 1, "message" => "Installation history successfully created."));
        } else  {
            http_response_code(500);
            echo json_encode(array("status" => 0, "message" => "Unable to Add Installation history."));
        }
    }

    if (trim($data->action_code) == '1002' && !empty(trim($data->name))) {
        if ($admin->add_maintenance_history($data->project_id,
            $data->name,$data->size,$data->components,$data->comp_date,$data->issues,$data->action,$data->issue_date,
            $data->resolved_date,$data->client_email,$data->client_add,$data->client_city,$data->client_state
        )) {
            http_response_code(200);
            echo json_encode(array("status" => 1, "message" => "Maintenance history successfully created."));
        } else  {
            http_response_code(500);
            echo json_encode(array("status" => 0, "message" => "Unable to Add Maintenance history."));
        }
    }

}