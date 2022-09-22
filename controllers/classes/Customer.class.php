<?php


class Customer {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function create_subscriber($email) {
        $client_query = "INSERT INTO tbl_newsletters SET subscriber_email=?";
        $client_obj = $this->conn->prepare($client_query);
        $client_obj->bind_param("s",$email);
        if ($client_obj->execute()){
            return true;
        }
        return false;
    }

    public function check_news_subscriber_email($email){
        $email_query = "SELECT * FROM tbl_newsletters WHERE subscriber_email=?";
        $client_obj = $this->conn->prepare($email_query);
        $client_obj->bind_param("s", $email);
        if ($client_obj->execute()){
            $data = $client_obj->get_result();
            return $data->fetch_assoc();
        }
        return array();
    }

    public function create_user($f_name,$l_name,$email,$phone,$pwd) {
        //Delete any existing user token entry
        $del_user_obj = $this->conn->prepare("DELETE FROM tbl_customers WHERE email=? AND active=0");
        $del_user_obj->bind_param("s",$email);
        $del_user_obj->execute();

        $user_query = "INSERT INTO tbl_customers SET firstname=?,lastname=?,email=?,mobile=?,password=?";
        $user_obj = $this->conn->prepare($user_query);

        $f_name = htmlspecialchars(strip_tags($f_name));
        $l_name = htmlspecialchars(strip_tags($l_name));
        $email = htmlspecialchars(strip_tags($email));
        $phone = htmlspecialchars(strip_tags($phone));
        $pwd = htmlspecialchars(strip_tags($pwd));
        $user_obj->bind_param("sssss",$f_name,$l_name,$email,$phone,$pwd);
        if ($user_obj->execute()){
            $user_id = mysqli_insert_id($this->conn);
//            $this->create_temp_activate_account($email,$f_name);
            return true;
        }
        return false;
    }

    public function create_temp_activate_account($email,$f_name) {
        $expires = date("U") + 7200;
        //Delete any existing user token entry
        $del_reset_obj = $this->conn->prepare("DELETE FROM tbl_temp_activate_account WHERE temp_email=?");
        $del_reset_obj->bind_param("s",$email);
        $del_reset_obj->execute();

        $host = "https://$_SERVER[HTTP_HOST]";
        $otp= rand(100000,999999);

        $temp_query = "INSERT INTO tbl_temp_activate_account SET temp_email=?,temp_fname=?,temp_token=?,temp_expire=?";
        $temp_obj = $this->conn->prepare($temp_query);
        $temp_obj->bind_param("ssss",$email,$f_name,$otp,$expires);
        if ($temp_obj->execute()){
            $toEmail = $email;
            $subject = "Mainlandsolar Account Activation";
            $content = "<html>
                        <head>
                            <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
                            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                            <title>Mainlandsolar</title>
                            <style>
                            @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,500;0,700;0,900;1,300&display=swap');
                            body {font-family: 'Roboto', sans-serif;font-weight: 400}
                            .wrapper {max-width: 600px;margin: 0 auto}
                            .company-name {text-align: left;background-color: #209E02;padding: 20px;}
                            table {width: 100%;}
                            .table-head {color: #fff;}
                            .mt-3 {margin-top: 3em;}
                            a {text-decoration: none;}
                            .not-active { pointer-events: none !important; cursor: default !important; color:#740774;font-weight:bolder; }
                        </style>
                        </head>
                        <body>
                            <div class='wrapper'>
                            <table>
                                <thead>
                                    <tr>
                                        <th class='table-head' colspan='4'><h1 class='company-name'>Mainlandsolar</h1></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class='mt-3'>
                                                <p>Dear ".$f_name.",</p>
                                                <p>
                                                    Welcome to Mainlandsolar. Thank you for joining us. Get ready to begin an exciting journey regular power supply!
                                                </p>
                                                <p>Enter the code below to complete your registration:</p>
                                                <div style='background:#E7E7E7;padding:20px 0;width:250px;margin: 0 auto;text-align:center;font-size:35px;color:#787878'>
                                                    ".substr($otp,0,3)."-".substr($otp,3,6)."
                                                </div>
                                                <p>NB: This OTP will expire after 2hrs.</p>
                                                <p>Thank you once again for joining us. Have a nice day.</p>
                                                <p>Regards,<br/>The Mainlandsolar Team</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        </body>
                        </html>";
            $mailHeaders ="MIME-Version: 1.0"."\r\n";
            $mailHeaders .="Content-type:text/html;charset=UTF-8"."\r\n";
            $mailHeaders .= "From: Mainlandsolar <support@mainlandsolar.com>\r\n";
            if (mail($toEmail, $subject, $content, $mailHeaders)) {
                return true;
            }
            return false;
        }
        return false;
    }

    public function check_email($email){
        $email_query = "SELECT * FROM tbl_customers WHERE email=?";
        $user_obj = $this->conn->prepare($email_query);
        $user_obj->bind_param("s", $email);
        if ($user_obj->execute()) {
            $data = $user_obj->get_result();
            return $data->fetch_assoc();
        }
        return array();
    }

    public function check_active_account($email){
        $email_query = "SELECT * FROM tbl_customers WHERE email=? AND active=1";
        $user_obj = $this->conn->prepare($email_query);
        $user_obj->bind_param("s", $email);
        if ($user_obj->execute()) {
            $data = $user_obj->get_result();
            if ($data->num_rows > 0) {
                return $data->fetch_assoc();
            }
            return array();
        }
        return array();
    }

    public function check_account_activation_credentials($temp_token){
        $currentDate = date("U");
        $check_query = "SELECT * FROM tbl_temp_activate_account WHERE temp_token=? AND temp_expire >= ?";
        $check_obj = $this->conn->prepare($check_query);
        $check_obj->bind_param("ss", $temp_token,$currentDate);
        if ($check_obj->execute()){
            $data = $check_obj->get_result();
            return $data->fetch_assoc();
        }
        return array();
    }

    public function activate_account($email){
        $email_query = "UPDATE tbl_customers SET active=1 WHERE email=? ";
        $user_obj = $this->conn->prepare($email_query);
        $user_obj->bind_param("s", $email);
        if ($user_obj->execute()){
            if ($user_obj->affected_rows > 0) {
                //Delete any existing user token entry
                $del_reset_obj = $this->conn->prepare("DELETE FROM tbl_temp_activate_account WHERE temp_email=?");
                $del_reset_obj->bind_param("s",$email);
                $del_reset_obj->execute();
                return true;
            }
            return false;
        }
        return false;
    }

    public function login_user($email) {
        $email_query = "SELECT * FROM tbl_customers WHERE email=? AND active='1'";
        $user_obj = $this->conn->prepare($email_query);
        $user_obj->bind_param("s", $email);
        if ($user_obj->execute()){
            $data = $user_obj->get_result();
            return $data->fetch_assoc();
        }
        return array();
    }

    public function reset_password_request($email){
        $selector = bin2hex(random_bytes(4));
        $token = random_bytes(15);

        $host = "www.$_SERVER[HTTP_HOST]";
        $url= $host."/change-password/".$selector."/".bin2hex($token);
        $expires = date("U") + 1200;

        //Delete any existing user token entry
        $del_reset_obj = $this->conn->prepare("DELETE FROM tbl_pwd_reset WHERE reset_email=?");
        $del_reset_obj->bind_param("s",$email);
        $del_reset_obj->execute();

        //Insert reset credentials
        $reset_query = "INSERT INTO tbl_pwd_reset SET reset_email=?,reset_selector=?,reset_token=?,reset_expires=?";
        $reset_obj = $this->conn->prepare($reset_query);
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        $reset_obj->bind_param("ssss",$email,$selector,$hashedToken,$expires);
        //execute query
        if ($reset_obj->execute()) {
            $to = $email;
            $subject = "Mainlandsolar password reset";
            $content = '<!DOCTYPE html>
                        <html lang="en">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <title>Reset Password</title>
                        </head>
                        <style>
                            @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap");
                            * {box-sizing: border-box;}
                            body {font-family: "Roboto", sans-serif;margin: 0;padding: 0;font-size: 14px;line-height: 20px;}
                            h2 {margin: 0;}
                            table {margin: 2em;}
                            @media(min-width: 700px) {  body {font-size: 15px;}  }
                        </style>
                        <body>
                            <div style="max-width:600px;margin:0 auto;line-height:30px">
                                <table style="border: 1px solid #c4c4c4;">
                                    <thead>
                                        <tr>
                                            <th>
                                                <h2 style="text-align: center;background:#ffffff;color: #ffffff;padding:.3em .7em">
                                                    <img src="https://i.ibb.co/Z6Ck09y/navbrand-logo-min.png" alt="navbrand-logo-min" width="52px" border="0">
                                                </h2>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="padding: .7em 2em;">
                                                <p style="font-weight: 600">You’re receiving this mail because you requested a password reset for your
                                                    Mainlandsolar.<br /><br /> Please tap the link below to create a new password :<br />
                                                    <a style="color: #33813B;" href="'.$url.'">'.$url.'</a>
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </body>
                        </html>';
            $mailHeaders ="MIME-Version: 1.0"."\r\n";
            $mailHeaders .="Content-type:text/html;charset=UTF-8"."\r\n";
            $mailHeaders .= "From: Mainlandsolar <support@mainlandsolar.com>\r\n";
            if (mail($to, $subject, $content, $mailHeaders)) {
                return true;
            }
            return false;
        }
        return false;
    }

    public function check_reset_pwd_credentials($reset_selector){
        $currentDate = date("U");
        $email_query = "SELECT * FROM tbl_pwd_reset WHERE reset_selector=? AND reset_expires >= ?";
        $cust_obj = $this->conn->prepare($email_query);
        $cust_obj->bind_param("ss",$reset_selector,$currentDate);
        if ($cust_obj->execute()){
            $data = $cust_obj->get_result();
            return $data->fetch_assoc();
        }
        return array();
    }

    public function update_reset_password($password,$email) {
        $update_query = "UPDATE tbl_customers SET password=? WHERE email=?";
        $update_obj = $this->conn->prepare($update_query);
        $update_obj->bind_param("ss",$password,$email);
        if ($update_obj->execute()){
            if ($update_obj->affected_rows > 0) {
                //Delete any existing user token entry
                $del_reset_obj = $this->conn->prepare("DELETE FROM tbl_pwd_reset WHERE reset_email=?");
                $del_reset_obj->bind_param("s",$email);
                $del_reset_obj->execute();
                return true;
            }
            return false;
        }
        return false;
    }

    public function update_account_profile($fn,$ln,$em,$mb,$c_id){
        $update_query = "UPDATE tbl_customers SET firstname=?,lastname=?,email=?,mobile=? WHERE customer_id=?";
        $update_obj = $this->conn->prepare($update_query);
        $update_obj->bind_param("ssssi",$fn,$ln,$em,$mb,$c_id);
        if ($update_obj->execute()){
            if ($update_obj->affected_rows > 0){
                return true;
            }
            return false;
        } else {
            return false;
        }
    }

    public function update_account_password($pwd,$c_id){
        $update_query = "UPDATE tbl_customers SET password=? WHERE customer_id=?";
        $update_obj = $this->conn->prepare($update_query);
        $update_obj->bind_param("si",$pwd,$c_id);
        if ($update_obj->execute()){
            if ($update_obj->affected_rows > 0){
                return true;
            }
            return false;
        } else {
            return false;
        }
    }

    public function send_contact_us_mail($fname,$lname,$phone,$email,$service,$description){
//        $toEmail = 'support@mainlandsolar.com';
        $toEmail = 'fredrickbdn@gmail.com';
        $link="www.$_SERVER[HTTP_HOST]";
        $subject = "Contact Us Alert!";
        $content = "<html>
                        <head>
                            <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
                            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                            <title>Mainlandsolar</title>
                            <style>
                                @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,500;0,700;0,900;1,300&display=swap');
                                body {font-family: 'Roboto', sans-serif;font-weight: 400}
                                .wrapper {max-width: 600px;margin: 0 auto}
                                .company-name {text-align: left}
                                table {width: 80%;}
                            </style>
                        </head>
                        <body>
                        <div class='wrapper'>
                            <table>
                                <thead>
                                    <tr><th class='table-head' colspan='4'><h1 class='company-name'>Mainlandsolar</h1></th></tr>
                                </thead>
                                <tbody>
                                    <div class='mt-3'>
                                        <p>Hi, Admin</p>
                                        <p>".$email."(".$fname." ".$lname.") with mobile number ".$phone.", send the following contact message: </p>
                                        <p>".$service."</p>
                                        <p>".$description."</p>
                                    </div>
                                </tbody>
                            </table>
                        </div>
                        </body>
                        </html>";
        $mailHeaders ="MIME-Version: 1.0"."\r\n";
        $mailHeaders .="Content-type:text/html;charset=UTF-8"."\r\n";
        $mailHeaders .= "From: Mainlandsolar <".$email.">\r\n";
        if (mail($toEmail, $subject, $content, $mailHeaders)) {
            return true;
        }
        return false;
    }

    public function read_blog_post_limit_3(){
        $post_query = "SELECT * FROM tbl_blog_posts bp INNER JOIN tbl_blog_categories bc ON bp.post_cat=bc.category_id 
                        WHERE bp.post_active='1' LIMIT 3";
        $post_obj = $this->conn->prepare($post_query);
        if ($post_obj->execute()) {
            return $post_obj->get_result();
        }
        return array();
    }

    public function read_blog_post_by_slug($post_slug){
        $post_query = "SELECT * FROM tbl_blog_posts bp INNER JOIN tbl_blog_categories bc ON bp.post_cat = bc.category_id
                        WHERE bp.post_slug='$post_slug' LIMIT 1";
        $post_obj = $this->conn->prepare($post_query);
        if ($post_obj->execute()) {
            return $post_obj->get_result();
        }
        return array();
    }

    public function read_customer_wish_list($c_id){
        $wlist_query = "SELECT * FROM tbl_wishlist w INNER JOIN tbl_products p ON w.pro_id=p.pro_id WHERE w.customer_id=?";
        $wlist_obj = $this->conn->prepare($wlist_query);
        $wlist_obj->bind_param("i",$c_id);
        if ($wlist_obj->execute()) {
            return $wlist_obj->get_result();
        }
        return array();
    }

    public function delete_customer_wish_list_item($cid,$wid){
        $delquery = "DELETE FROM tbl_wishlist WHERE customer_id=$cid AND wlist_id=$wid";
        $delete_obj = $this->conn->prepare($delquery);
        if ($delete_obj->execute()){
            if ($delete_obj->affected_rows > 0){
                return true;
            }
            return false;
        } else {
            return false;
        }
    }

    public function get_latest_shop_to_address($cid){
        $query = "SELECT order_id,receiver_address,receiver_state FROM tbl_orders WHERE customer_id=$cid ORDER BY order_id DESC LIMIT 1";
        $add_obj = $this->conn->prepare($query);
        if ($add_obj->execute()){
            $address = $add_obj->get_result();
            if ($address->num_rows > 0){ return $address->fetch_assoc(); }
            return false;
        }
        return false;
    }

    public function orders($c_id){
        $order_query = "SELECT * FROM tbl_orders o INNER JOIN tbl_payments p ON p.order_id=o.order_id WHERE o.customer_id=?";
        $order_obj = $this->conn->prepare($order_query);
        $order_obj->bind_param("i",$c_id);
        if ($order_obj->execute()) {
            return $order_obj->get_result();
        }
        return array();
    }

    public function order_by_id($order_id){
        $order_query = "SELECT * FROM tbl_orders WHERE order_id=?";
        $order_obj = $this->conn->prepare($order_query);
        $order_obj->bind_param("i",$order_id);
        if ($order_obj->execute()) {
            return $order_obj->get_result();
        }
        return array();
    }

    public function order_by_payment($order_id){
        $order_query = "SELECT * FROM tbl_payments p INNER JOIN tbl_orders o ON p.order_id=o.order_id WHERE p.order_id=?";
        $order_obj = $this->conn->prepare($order_query);
        $order_obj->bind_param("i",$order_id);
        if ($order_obj->execute()) {
            return $order_obj->get_result();
        }
        return array();
    }

    public function order_by_product($order_id){
        $order_query = "SELECT * FROM tbl_order_details o INNER JOIN tbl_products p ON o.pro_id=p.pro_id WHERE o.order_id=?";
        $order_obj = $this->conn->prepare($order_query);
        $order_obj->bind_param("i",$order_id);
        if ($order_obj->execute()) {
            return $order_obj->get_result();
        }
        return array();
    }

    public function read_product_by_order_details_id($product_id,$order_detail_id){
        $order_query = "SELECT * FROM tbl_order_details o INNER JOIN tbl_products p ON o.pro_id=p.pro_id 
                        WHERE o.pro_id=? AND o.order_details_id=?";
        $order_obj = $this->conn->prepare($order_query);
        $order_obj->bind_param("si",$product_id,$order_detail_id);
        if ($order_obj->execute()) {
            return $order_obj->get_result();
        }
        return array();
    }

    public function order_pending_review($customer_id){
        $order_query = "SELECT * FROM tbl_orders o INNER JOIN tbl_order_details od ON od.order_id=o.order_id  
                        INNER JOIN tbl_products p ON p.pro_id=od.pro_id WHERE od.customer_id=? AND od.review_status=0";
        $order_obj = $this->conn->prepare($order_query);
        $order_obj->bind_param("i",$customer_id);
        if ($order_obj->execute()) {
            return $order_obj->get_result();
        }
        return array();
    }

    public function update_order_details_return($odi){
        $de_query = "UPDATE tbl_order_details SET returned='Y' WHERE order_details_id=$odi";
        $de_obj = $this->conn->prepare($de_query);
        if ($de_obj->execute()) {
//            if ($this->send_return_mail_admin($odi)){
            return true;
        }
//            return false;
//        }
        return false;
    }

    public function update_order_details_item_status($odi,$comment,$status){
        $de_query = "UPDATE tbl_order_details SET vendor_del_status='$status',return_comment='$comment' WHERE order_details_id=$odi";
        $de_obj = $this->conn->prepare($de_query);
        if ($de_obj->execute()) {
            if ($de_obj->affected_rows > 0){
                if ($this->send_return_order_mail_to_sellers_and_admin($odi)) {
                    return true;
                }
            }
            return false;
        }
        return false;
    }

    public function order_details_by_order_detail_id($odi){
        $email_query = "SELECT od.*,c.*,v.* FROM tbl_order_details od INNER JOIN tbl_vendors v ON od.ven_id=v.ven_id 
                        INNER JOIN tbl_customers c ON c.customer_id=od.customer_id 
                        INNER JOIN tbl_orders o ON o.order_id=od.order_id 
                        WHERE order_details_id=$odi";
        $user_obj = $this->conn->prepare($email_query);
        if ($user_obj->execute()){
            return $user_obj->get_result();
        }
        return array();
    }

    public function fetch_prev_blog_post($id){
        if ($id == 1) {
            $p_query = "SELECT * FROM tbl_blog_posts ORDER BY post_sno DESC LIMIT 1";
        } else {
            $p_query = "SELECT * FROM tbl_blog_posts WHERE post_sno < $id ORDER BY post_sno DESC LIMIT 1";
        }
        $p_obj = $this->conn->prepare($p_query);
        if ($p_obj->execute()) {
             $data = $p_obj->get_result();
             return $data->fetch_assoc();
        }
        return array();
    }

    public function fetch_next_blog_post($id){
        $p_query = "SELECT * FROM tbl_blog_posts WHERE post_sno > $id ORDER BY post_sno LIMIT 1";
        $p_obj = $this->conn->prepare($p_query);
        if ($p_obj->execute()) {
             $data = $p_obj->get_result();
             if ($data->num_rows > 0){
                 return $data->fetch_assoc();
             } else {
                 $p_query2 = "SELECT * FROM tbl_blog_posts LIMIT 1";
                 $p_obj2 = $this->conn->prepare($p_query2);
                 if ($p_obj2->execute()) {
                     $data2 = $p_obj2->get_result();
                     return $data2->fetch_assoc();
                 }
             }

        }
        return array();
    }

    public function read_latest_blog_post_limit_5(){
        $blog_query = "SELECT * FROM tbl_blog_posts ORDER BY post_sno DESC LIMIT 5";
        $blog_obj = $this->conn->prepare($blog_query);
        if ($blog_obj->execute()) {
            return $blog_obj->get_result();
        }
        return array();
    }

    public function read_blog_post_categories(){
        $blog_query = "SELECT * FROM tbl_blog_categories";
        $blog_obj = $this->conn->prepare($blog_query);
        if ($blog_obj->execute()) {
            return $blog_obj->get_result();
        }
        return array();
    }

    public function count_blog_post_categories_by_id($cat_id){
        $cnt = mysqli_num_rows(mysqli_query($this->conn, "SELECT * FROM tbl_blog_posts WHERE post_cat=$cat_id"));
        if ($cnt > 0) return $cnt;
        return 0;
    }

    public function fetch_project_installation_history($inst_id){
        $ins_query = "SELECT * FROM tbl_project_history WHERE history_id='$inst_id' LIMIT 1";
        $ins_obj = $this->conn->prepare($ins_query);
        if ($ins_obj->execute()) {
            $data = $ins_obj->get_result();
            if ($data->num_rows > 0) {
                return $data->fetch_assoc();
            }
            return array();
        }
        return array();
    }

    public function fetch_project_maintenance_history($main_id){
        $ins_query = "SELECT * FROM tbl_maintenance_history WHERE history_id='$main_id'";
        $ins_obj = $this->conn->prepare($ins_query);
        if ($ins_obj->execute()) {
            return $ins_obj->get_result();
        }
        return array();
    }

}

?>