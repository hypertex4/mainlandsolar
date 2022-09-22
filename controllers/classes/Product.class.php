<?php


class Product
{
    public $customer_id;
    public $account_name;
    public $transferred_amount;

    public $order_id;

    private $conn;
    private $tbl_product;

    //constructor
    public function __construct($db) {
        $this->conn = $db;
        $this->tbl_product = 'tbl_products';
    }

    public function product_categories(){
        $cat_query = "SELECT * FROM tbl_categories ORDER BY category_name ASC";
        $cat_obj = $this->conn->prepare($cat_query);
        if ($cat_obj->execute()) {
            return $cat_obj->get_result();
        }
        return array();
    }

    public function read_product_details_by_slug($slug){
        $sku_query = "SELECT * FROM tbl_products p INNER JOIN tbl_categories c ON p.category_id = c.category_id
                        WHERE p.pro_slug='$slug' LIMIT 1";
        $sku_obj = $this->conn->prepare($sku_query);
        if ($sku_obj->execute()) {
            return $sku_obj->get_result();
        }
        return array();
    }

    public function read_product_details_by_id($product_id){
        $pro_query = "SELECT * FROM tbl_products p INNER JOIN tbl_categories c ON p.category_id = c.category_id
                        WHERE p.pro_id='$product_id' LIMIT 1";
        $pro_obj = $this->conn->prepare($pro_query);
        if ($pro_obj->execute()) {
            return $pro_obj->get_result();
        }
        return array();
    }

    public function read_average_review_rating($pid){
        $query = "SELECT ROUND(AVG(review_rate), 0) AS AverageRate FROM tbl_reviews WHERE pro_id='$pid'";
        $row = mysqli_fetch_assoc(mysqli_query($this->conn,$query));
        if ($row['AverageRate']>0) return $row['AverageRate'];
        else return 0;
    }

    public function count_customer_by_review_rate($val){
        $cnt = mysqli_num_rows(mysqli_query($this->conn, "SELECT * FROM tbl_reviews WHERE review_rate=$val"));
        if ($cnt > 0) return $cnt;
        return 0;
    }

    public function read_product_review_by_id($pid){
        $review_query = "SELECT * FROM tbl_reviews WHERE pro_id='$pid' LIMIT 2";
        $review_obj = $this->conn->prepare($review_query);
        if ($review_obj->execute()) {
            return $review_obj->get_result();
        }
        return array();
    }

    public function read_related_product($cid,$slug){
        $related_query = "SELECT * FROM tbl_products WHERE category_id=$cid AND pro_slug !='$slug' LIMIT 3";
        $related_obj = $this->conn->prepare($related_query);
        if ($related_obj->execute()) {
            return $related_obj->get_result();
        }
        return array();
    }

    public function create_wish_list($c_id,$pro_id){
        $wList_query = "SELECT * FROM tbl_wishlist WHERE customer_id=? AND pro_id=?";
        $check_obj = $this->conn->prepare($wList_query);
        $check_obj->bind_param("is",$c_id,$pro_id);
        if ($check_obj->execute()){
            $result = $check_obj->get_result();
            if ($result->num_rows> 0){return "exist";}
        }

        $query = "INSERT INTO tbl_wishlist SET customer_id=?, pro_id=?";
        $inserted_obj = $this->conn->prepare($query);
        $inserted_obj->bind_param("is",$c_id,$pro_id);
        $inserted_obj->execute();
        if ($inserted_obj->affected_rows > 0){
            return true;
        }
        return false;
    }

    public function create_order($o_ref,$c_id,$o_amt,$o_qty,$o_sfee,$r_fn,$r_ln,$r_em,$r_ph,$r_ad, $r_st,$s_type,$pay_opt){
        $query = "INSERT INTO tbl_orders SET order_ref=?,customer_id=?,order_amount=?,order_qty=?,order_ship_fee=?,receiver_fname=?,receiver_lname=?,
                                receiver_email=?,receiver_phone=?,receiver_address=?,receiver_state=?,shipping_type=?,payment_option=?";
        $inserted_obj = $this->conn->prepare($query);
        $inserted_obj->bind_param("sididssssssss", $o_ref,$c_id,$o_amt,$o_qty,$o_sfee,$r_fn,$r_ln,$r_em,$r_ph,$r_ad, $r_st,$s_type,$pay_opt);
        $inserted_obj->execute();
        if ($inserted_obj->affected_rows > 0){
            $this->order_id = mysqli_insert_id($this->conn);
            return $this->order_id;
        }
        return false;
    }

    public function create_order_payment($o_id,$o_amt,$pay_ref,$pay_status){
        $query = "INSERT INTO tbl_payments SET order_id=?,payment_amount=?,payment_ref=?,payment_status=?";
        $inserted_obj = $this->conn->prepare($query);
        $inserted_obj->bind_param("idss",$o_id,$o_amt,$pay_ref,$pay_status);
        $inserted_obj->execute();
        if ($inserted_obj->affected_rows > 0){
            $id = mysqli_insert_id($this->conn);
            $this->send_order_mail_to_admin($id);
            return true;
        }
        return false;
    }

    public function create_order_details($order_id,$c_id,$prot_id,$pro_qty){
        $query = "INSERT INTO tbl_order_details SET order_id=?,customer_id=?,pro_id=?,product_qty=?";
        $inserted_obj = $this->conn->prepare($query);
        $inserted_obj->bind_param("iisi",$order_id,$c_id,$prot_id,$pro_qty);
        $inserted_obj->execute();
        if ($inserted_obj->affected_rows > 0){
            return true;
        }
        return false;
    }

    public function create_transfer_request(){
        $query = "INSERT INTO tbl_transfer_payments SET order_id=?,account_name=?,transferred_amount=?";
        $inserted_obj = $this->conn->prepare($query);
        $inserted_obj->bind_param("isd",$this->order_id,$this->account_name,$this->transferred_amount);
        $inserted_obj->execute();
        if ($inserted_obj->affected_rows > 0){
            return true;
        }
        return false;
    }

    public function create_review_rating($review_name,$review_comment,$review_rate,$order_details_id,$product_id){
        $query = "INSERT INTO tbl_reviews SET review_name=?,review_comment=?,review_rate=?,pro_id=?";
        $inserted_obj = $this->conn->prepare($query);
        $inserted_obj->bind_param("ssis",$review_name,$review_comment,$review_rate,$product_id);
        $inserted_obj->execute();
        if ($inserted_obj->affected_rows > 0){
            $q=mysqli_query($this->conn,"UPDATE tbl_order_details SET review_status=1 WHERE order_details_id='$order_details_id'");
            if($q) return true;
            else return false;
        }
        return false;
    }

    public function send_order_mail_to_admin($id){
        $email_query = "SELECT * FROM tbl_payments p
                        INNER JOIN tbl_orders o ON o.order_id=p.order_id 
                        INNER JOIN tbl_customers c ON o.customer_id=c.customer_id
                        WHERE p.payment_id=$id";
        $user_obj = $this->conn->prepare($email_query);
        if ($user_obj->execute()){
            $res = $user_obj->get_result();
            $data= $res->fetch_assoc();
            $toEmail = 'fredrickbdn@gmail.com';
            $link="https://$_SERVER[HTTP_HOST]";
            $subject = "Mainlandsolar New Order Alert!";
            $name = $data['lastname'];
            $payment_option = $data['payment_option'];
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
                                        <p>New order just came in from ".$name.". Kindly login to admin dashboard to see order details. Thank You</p>
                                        <p>Follow this link to the admin dashboard <a href='".$link."/admin'>".$link."/admin</a></p>
                                        <p>Payment Method: ".$payment_option."</p>
                                    </div>
                                </tbody>
                            </table>
                        </div>
                        </body>
                        </html>";
            $mailHeaders ="MIME-Version: 1.0"."\r\n";
            $mailHeaders .="Content-type:text/html;charset=UTF-8"."\r\n";
            $mailHeaders .= "From: Mainlandsolar <".$toEmail.">\r\n";
            if (mail($toEmail, $subject, $content, $mailHeaders)) {
                return true;
            }
            return false;
        }
        return false;
    }

    public function read_product_by_category($category_id){
        $pro_query = "SELECT * FROM tbl_products p INNER JOIN tbl_categories c ON p.category_id = c.category_id
                        WHERE p.category_id=$category_id AND p.pro_active='1'";
        $pro_obj = $this->conn->prepare($pro_query);
        if ($pro_obj->execute()) {
            return $pro_obj->get_result();
        }
        return array();
    }

}

?>