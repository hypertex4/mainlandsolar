<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type: application/json; charset=UTF-8");
include_once('../controllers/classes/Admin.class.php');

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    if (trim($_POST['action_code']) == '601' && !empty(trim($_POST['title']))) {
        $uploadDir = 'uploads/';
        $ti = $_POST['title'];
        $ca = $_POST['category'];
        $st = $_POST['solar_type'];
        $bt = $_POST['battery_type'];
        $bv = $_POST['battery_volt'];
        $it = $_POST['inverter_type'];
        $iv = $_POST['inverter_volt'];
        $sl = $_POST['slug'];
        $pr = $_POST['price'];
        $sp = $_POST['specification'];
        $de = $_POST['description'];
        $images = $_FILES;
        $data = [];

        $err = 0;
        foreach ($images as $key => $image) {
            $name = $image['name'];
//            $fileName = bin2hex(random_bytes(16));
            $fileType = pathinfo($name, PATHINFO_EXTENSION);
            $targetFilePath = $uploadDir . $name;
            $allowTypes = array('jpg', 'png', 'jpeg','pdf');

            if (in_array($fileType, $allowTypes)) {
                if (move_uploaded_file($image['tmp_name'], $targetFilePath)) {
                    $data[$key]['success'] = true;
                    $data[$key]['src'] = 'uploads/' . $name;
                } else {
                    $data[$key]['success'] = false;
                    $data[$key]['src'] = 'uploads/' . $name;
                    ++$err;
                }
            }
        }
        if ($err == 0) {
            $img1 = isset($data['image_1']['src']) ? $data['image_1']['src'] : "null";
            $img2 = isset($data['image_2']['src']) ? $data['image_2']['src'] : "null";
            $img3 = isset($data['image_3']['src']) ? $data['image_3']['src'] : "null";
            $dataset = isset($data['dataset']['src']) ? $data['dataset']['src'] : "null";
            if ($admin->create_product($img1,$img2,$img3,$dataset,$ti,$ca,$st,$bt,$bv,$it,$iv,$sl,$pr,$sp,$de)) {
                http_response_code(200);
                echo json_encode(array("status" => 200, "message" => "Product created successfully."));
                exit;
            } else {
                http_response_code(500);
                echo json_encode(array("status" => 500, "message" => "Unable to create product."));
                exit;
            }
        }
    }

    if (trim($_POST['action_code']) == '603' && !empty(trim($_POST['title']))) {
        $uploadDir = 'uploads/';
        $ti = $_POST['title'];
        $ca = $_POST['category'];
        $st = $_POST['solar_type'];
        $bt = $_POST['battery_type'];
        $bv = $_POST['battery_volt'];
        $it = $_POST['inverter_type'];
        $iv = $_POST['inverter_volt'];
        $sl = $_POST['slug'];
        $pr = $_POST['price'];
        $sp = $_POST['specification'];
        $de = $_POST['description'];
        $p_id = $_POST['p_id'];
        $images = $_FILES;
        $data = [];

        $err = 0;
        foreach ($images as $key => $image) {
            $name = $image['name'];
//            $fileName = bin2hex(random_bytes(16));
            $fileType = pathinfo($name, PATHINFO_EXTENSION);
            $targetFilePath = $uploadDir . $name;
            $allowTypes = array('jpg', 'png', 'jpeg','pdf');

            if (in_array($fileType, $allowTypes)) {
                if (move_uploaded_file($image['tmp_name'], $targetFilePath)) {
                    $data[$key]['success'] = true;
                    $data[$key]['src'] = 'uploads/' . $name;
                } else {
                    $data[$key]['success'] = false;
                    $data[$key]['src'] = 'uploads/' . $name;
                    ++$err;
                }
            }
        }
        if ($err == 0) {
            $img1 = isset($data['image_1']['src']) ? $data['image_1']['src'] : "null";
            $img2 = isset($data['image_2']['src']) ? $data['image_2']['src'] : "null";
            $img3 = isset($data['image_3']['src']) ? $data['image_3']['src'] : "null";
            $dataset = isset($data['dataset']['src']) ? $data['dataset']['src'] : "null";
            if ($admin->update_product($img1,$img2,$img3,$dataset,$ti,$ca,$st,$bt,$bv,$it,$iv,$sl,$pr,$sp,$de,$p_id)) {
                http_response_code(200);
                echo json_encode(array("status" => 200, "message" => "Product updated successfully."));
                exit;
            } else {
                http_response_code(500);
                echo json_encode(array("status" => 500, "message" => "Unable to Update product."));
                exit;
            }
        }
    }

    if (trim($_POST['action_code']) == '801' && !empty(trim($_POST['title']))) {
        $uploadDir = 'posts/';
        $ti = $_POST['title'];
        $ca = $_POST['category'];
        $sl = $_POST['slug'];
        $au = $_POST['author'];
        $bo = $_POST['body'];
        $images = $_FILES;
        $data = [];

        $err = 0;
        foreach ($images as $key => $image) {
            $name = $image['name'];
            $fileType = pathinfo($name, PATHINFO_EXTENSION);
            $targetFilePath = $uploadDir . $name;
            $allowTypes = array('jpg', 'png', 'jpeg');

            if (in_array($fileType, $allowTypes)) {
                if (move_uploaded_file($image['tmp_name'], $targetFilePath)) {
                    $data[$key]['success'] = true;
                    $data[$key]['src'] = 'posts/' . $name;
                } else {
                    $data[$key]['success'] = false;
                    $data[$key]['src'] = 'posts/' . $name;
                    ++$err;
                }
            }
        }
        if ($err == 0) {
            $img1 = isset($data['image_1']['src']) ? $data['image_1']['src'] : "null";
            if ($admin->create_blog($img1,$ti,$ca,$sl,$au,$bo)) {
                http_response_code(200);
                echo json_encode(array("status" => 200, "message" => "Blog post created successfully."));
                exit;
            } else {
                http_response_code(500);
                echo json_encode(array("status" => 500, "message" => "Unable to create product."));
                exit;
            }
        }
    }

    if (trim($_POST['action_code']) == '803' && !empty(trim($_POST['title']))) {
        $uploadDir = 'posts/';
        $ti = $_POST['title'];
        $ca = $_POST['category'];
        $sl = $_POST['slug'];
        $au = $_POST['author'];
        $bo = $_POST['body'];
        $p_id = $_POST['p_id'];
        $images = $_FILES;
        $data = [];

        $err = 0;
        foreach ($images as $key => $image) {
            $name = $image['name'];
            $fileType = pathinfo($name, PATHINFO_EXTENSION);
            $targetFilePath = $uploadDir . $name;
            $allowTypes = array('jpg', 'png', 'jpeg');

            if (in_array($fileType, $allowTypes)) {
                if (move_uploaded_file($image['tmp_name'], $targetFilePath)) {
                    $data[$key]['success'] = true;
                    $data[$key]['src'] = 'posts/' . $name;
                } else {
                    $data[$key]['success'] = false;
                    $data[$key]['src'] = 'posts/' . $name;
                    ++$err;
                }
            }
        }
        if ($err == 0) {
            $img1 = isset($data['image_1']['src']) ? $data['image_1']['src'] : "null";
            if ($admin->update_blog($img1,$ti,$ca,$sl,$au,$bo,$p_id)) {
                http_response_code(200);
                echo json_encode(array("status" => 200, "message" => "Blog post updated successfully."));
                exit;
            } else {
                http_response_code(500);
                echo json_encode(array("status" => 500, "message" => "Unable to Update product."));
                exit;
            }
        }
    }
}


