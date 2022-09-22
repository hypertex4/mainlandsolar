<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../config/database.php');

class Admin
{
    public $conn;
    private $tbl_admin;

    //constructor
    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
        $this->tbl_admin = "tbl_admin_users";
    }

    public function list_customers(){
        $user_query = "SELECT * FROM tbl_customers";
        $user_obj = $this->conn->prepare($user_query);
        if ($user_obj->execute()) {
            return $user_obj->get_result();
        }
        return array();
    }

    public function create_admin_user($a_username,$a_password){
        $admin_query = "SELECT * FROM tbl_admin_users WHERE admin_username='$a_username'";
        $admin_obj = $this->conn->prepare($admin_query);
        if ($admin_obj->execute()){
            $data = $admin_obj->get_result()->num_rows;
            if ($data > 0){
                return false;
            } else {
                $pass = md5($a_password);
                $admin_query = "INSERT INTO tbl_admin_users SET admin_username='$a_username',admin_password='$pass'";
                $admin_obj = $this->conn->prepare($admin_query);
                if ($admin_obj->execute()){
                    return true;
                }
                return false;
            }
        }
        return false;
    }

    public function list_admin_users(){
        $adm_query = "SELECT * FROM tbl_admin_users";
        $adm_obj = $this->conn->prepare($adm_query);
        if ($adm_obj->execute()) {
            return $adm_obj->get_result();
        }
        return array();
    }

    public function delete_admin_user($adm_id){
        $del_query = "DELETE FROM tbl_admin_users WHERE admin_id=$adm_id";
        $del_obj = $this->conn->prepare($del_query);
        if ($del_obj->execute()){
            if ($del_obj->affected_rows > 0){ return true; }
            return false;
        }
        return false;
    }

    public function update_admin_user($user,$admin_id){
        $product_query = "UPDATE tbl_admin_users SET admin_username='$user' WHERE admin_id=$admin_id";
        $product_obj = $this->conn->prepare($product_query);
        if ($product_obj->execute()){
            if ($product_obj->affected_rows > 0){
                return true;
            }
            return false;
        }
        return false;
    }

    public function list_news_subscribers(){
        $news_query = "SELECT * FROM tbl_newsletters";
        $news_obj = $this->conn->prepare($news_query);
        if ($news_obj->execute()) {
            return $news_obj->get_result();
        }
        return array();
    }

    public function add_category_product($cat_name){
        $cat_query = "SELECT * FROM tbl_categories WHERE category_name='$cat_name'";
        $cat_obj = $this->conn->prepare($cat_query);
        if ($cat_obj->execute()){
            $data = $cat_obj->get_result()->num_rows;
            if ($data > 0){
                return false;
            } else {
                $cat_id= 4000+rand(100,999);
                $admin_query = "INSERT INTO tbl_categories SET category_id=$cat_id, category_name='$cat_name'";
                $admin_obj = $this->conn->prepare($admin_query);
                if ($admin_obj->execute()){
                    return true;
                }
                return false;
            }
        }
        return false;
    }

    public function list_product_category(){
        $cat_query = "SELECT * FROM tbl_categories";
        $cat_obj = $this->conn->prepare($cat_query);
        if ($cat_obj->execute()) {
            return $cat_obj->get_result();
        }
        return array();
    }

    public function delete_category_product($cat_id){
        $del_query = "DELETE FROM tbl_categories WHERE category_id=$cat_id";
        $del_obj = $this->conn->prepare($del_query);
        if ($del_obj->execute()){
            if ($del_obj->affected_rows > 0){ return true; }
            return false;
        }
        return false;
    }

    public function update_category_product($cat_id,$cat_name){
        $product_query = "UPDATE tbl_categories SET category_name='$cat_name' WHERE category_id=$cat_id";
        $product_obj = $this->conn->prepare($product_query);
        if ($product_obj->execute()){
            if ($product_obj->affected_rows > 0){
                return true;
            }
            return false;
        }
        return false;
    }

    public function add_blog_category_product($cat_name){
        $cat_query = "SELECT * FROM tbl_blog_categories WHERE category_name='$cat_name'";
        $cat_obj = $this->conn->prepare($cat_query);
        if ($cat_obj->execute()){
            $data = $cat_obj->get_result()->num_rows;
            if ($data > 0){
                return false;
            } else {
                $cat_id= 3000+rand(100,999);
                $admin_query = "INSERT INTO tbl_blog_categories SET category_id=$cat_id, category_name='$cat_name'";
                $admin_obj = $this->conn->prepare($admin_query);
                if ($admin_obj->execute()){
                    return true;
                }
                return false;
            }
        }
        return false;
    }

    public function list_blog_category(){
        $cat_query = "SELECT * FROM tbl_blog_categories";
        $cat_obj = $this->conn->prepare($cat_query);
        if ($cat_obj->execute()) {
            return $cat_obj->get_result();
        }
        return array();
    }

    public function delete_blog_category_product($cat_id){
        $del_query = "DELETE FROM tbl_blog_categories WHERE category_id=$cat_id";
        $del_obj = $this->conn->prepare($del_query);
        if ($del_obj->execute()){
            if ($del_obj->affected_rows > 0){ return true; }
            return false;
        }
        return false;
    }

    public function update_blog_category_product($cat_id,$cat_name){
        $product_query = "UPDATE tbl_blog_categories SET category_name='$cat_name' WHERE category_id=$cat_id";
        $product_obj = $this->conn->prepare($product_query);
        if ($product_obj->execute()){
            if ($product_obj->affected_rows > 0){
                return true;
            }
            return false;
        }
        return false;
    }

    public function add_installation_history(
        $name,$size,$components,$comp_date,$issues,$action,$issue_date,$resolved_date,$client_email,$client_add,$client_city,$client_state
    ){
//        $history_id= "MS".rand(100000,999999).date("Ymd",strtotime($comp_date)).strtoupper($client_city);
        $history_id= "MS".rand(10000,99999).strtoupper($client_city);
        $admin_query = "INSERT INTO tbl_project_history SET history_id='$history_id',name_of_ins='$name',size_of_ins='$size',sys_comps='$components',
                        date_of_com='$comp_date',issues_raised='$issues',trob_action='$action',date_issued='$issue_date',resolved_date='$resolved_date',
                        client_email='$client_email',client_add='$client_add',client_city='$client_city',client_state='$client_state'";
        $admin_obj = $this->conn->prepare($admin_query);
        if ($admin_obj->execute()){
            return true;
        }
        return false;
    }

    public function add_maintenance_history(
        $p_id,$name,$size,$components,$comp_date,$issues,$action,$issue_date,$resolved_date,$client_email,$client_add,$client_city,$client_state
    ){
        if ($p_id==""){
            $history_id= "MS".rand(10000,99999).strtoupper($client_city);
        } else {
            $history_id = $p_id;
        }
        $admin_query = "INSERT INTO tbl_maintenance_history SET history_id='$history_id',name_of_ins='$name',size_of_ins='$size',sys_comps='$components',
                        date_of_com='$comp_date',issues_raised='$issues',trob_action='$action',date_issued='$issue_date',resolved_date='$resolved_date',
                        client_email='$client_email',client_add='$client_add',client_city='$client_city',client_state='$client_state'";
        $admin_obj = $this->conn->prepare($admin_query);
        if ($admin_obj->execute()){
            return true;
        }
        return false;
    }

    public function list_installation_histories(){
        $ins_query = "SELECT * FROM tbl_project_history";
        $ins_obj = $this->conn->prepare($ins_query);
        if ($ins_obj->execute()) {
            return $ins_obj->get_result();
        }
        return array();
    }

    public function read_installation_histories_by_id($hid){
        $main_query = "SELECT * FROM tbl_project_history WHERE history_id='$hid'";
        $main_obj = $this->conn->prepare($main_query);
        if ($main_obj->execute()) {
            $res = $main_obj->get_result();
            return $res->fetch_assoc();
        }
        return array();
    }

    public function update_product($img1,$img2,$img3,$dataset,$ti,$ca,$st,$bt,$bv,$it,$iv,$sl,$pr,$sp,$de,$p_id){
        if (($img1=="null" && $img2=="null" && $img3=="null") && $dataset=="null"){
            $product_query = "UPDATE tbl_products SET pro_title=?,category_id=?,solar_panel=?,batt_type=?,batt_volts=?,inv_type=?,inv_volts=?,pro_slug=?,pro_price=?,
                                pro_spec=?,pro_desc=? WHERE pro_id='$p_id'";
            $product_obj = $this->conn->prepare($product_query);
            $product_obj->bind_param("sissssssdss",$ti,$ca,$st,$bt,$bv,$it,$iv,$sl,$pr,$sp,$de);
        }
        if (($img1=="null" && $img2=="null" && $img3=="null") && $dataset!="null"){
            $product_query = "UPDATE tbl_products SET dataset=?,pro_title=?,category_id=?,solar_panel=?,batt_type=?,batt_volts=?,inv_type=?,inv_volts=?,pro_slug=?,pro_price=?,
                                pro_spec=?,pro_desc=? WHERE pro_id='$p_id'";
            $product_obj = $this->conn->prepare($product_query);
            $product_obj->bind_param("ssissssssdss",$dataset,$ti,$ca,$st,$bt,$bv,$it,$iv,$sl,$pr,$sp,$de);
        }
        if (($img1 !="null" && $img2 =="null" && $img3=="null") && $dataset !="null"){
            $product_query = "UPDATE tbl_products SET pro_image1=?,dataset=?,pro_title=?,category_id=?,pro_slug=?,pro_price=?,solar_panel=?,
                                batt_type=?,batt_volts=?,inv_type=?,inv_volts=?,pro_spec=?,pro_desc=? WHERE pro_id='$p_id'";
            $product_obj = $this->conn->prepare($product_query);
            $product_obj->bind_param("sssisdsssssss",$img1,$dataset,$ti,$ca,$sl,$pr,$st,$bt,$bv,$it,$iv,$sp,$de);
        }

        if (($img1 !="null" && $img2 =="null" && $img3=="null") && $dataset =="null"){
            $product_query = "UPDATE tbl_products SET pro_image1=?,pro_title=?,category_id=?,pro_slug=?,pro_price=?,solar_panel=?,
                                batt_type=?,batt_volts=?,inv_type=?,inv_volts=?,pro_spec=?,pro_desc=? WHERE pro_id='$p_id'";
            $product_obj = $this->conn->prepare($product_query);
            $product_obj->bind_param("ssisdsssssss",$img1,$ti,$ca,$sl,$pr,$st,$bt,$bv,$it,$iv,$sp,$de);
        }
        if (($img1 !="null" && $img2 !="null" && $img3=="null") && $dataset !="null"){
            $product_query = "UPDATE tbl_products SET pro_image1=?,pro_image2=?,dataset=?,pro_title=?,category_id=?,pro_slug=?,pro_price=?,
                                solar_panel=?,batt_type=?,batt_volts=?,inv_type=?,inv_volts=?,pro_spec=?,pro_desc=? WHERE pro_id='$p_id'";
            $product_obj = $this->conn->prepare($product_query);
            $product_obj->bind_param("ssssisdsssssss",$img1,$img2,$dataset,$ti,$ca,$sl,$pr,$st,$bt,$bv,$it,$iv,$sp,$de);
        }
        if (($img1 !="null" && $img2 !="null" && $img3=="null") && $dataset =="null"){
            $product_query = "UPDATE tbl_products SET pro_image1=?,pro_image2=?,pro_title=?,category_id=?,pro_slug=?,pro_price=?,
                                solar_panel=?,batt_type=?,batt_volts=?,inv_type=?,inv_volts=?,pro_spec=?,pro_desc=? WHERE pro_id='$p_id'";
            $product_obj = $this->conn->prepare($product_query);
            $product_obj->bind_param("sssisdsssssss",$img1,$img2,$ti,$ca,$sl,$pr,$st,$bt,$bv,$it,$iv,$sp,$de);
        }
        if (($img1 !="null" && $img2 !="null" && $img3 !="null") && $dataset !="null"){
            $product_query = "UPDATE tbl_products SET pro_image1=?,pro_image2=?,pro_image3=?,dataset=?,pro_title=?,category_id=?,pro_slug=?,
                                pro_price=?,solar_panel=?,batt_type=?,batt_volts=?,inv_type=?,inv_volts=?,pro_spec=?,pro_desc=? WHERE pro_id='$p_id'";
            $product_obj = $this->conn->prepare($product_query);
            $product_obj->bind_param("sssssisdsssssss",$img1,$img2,$img3,$dataset,$ti,$ca,$sl,$pr,$st,$bt,$bv,$it,$iv,$sp,$de);
        }
        if (($img1 !="null" && $img2 !="null" && $img3 !="null") && $dataset =="null"){
            $product_query = "UPDATE tbl_products SET pro_image1=?,pro_image2=?,pro_image3=?,pro_title=?,category_id=?,pro_slug=?,
                                pro_price=?,solar_panel=?,batt_type=?,batt_volts=?,inv_type=?,inv_volts=?,pro_spec=?,pro_desc=? WHERE pro_id='$p_id'";
            $product_obj = $this->conn->prepare($product_query);
            $product_obj->bind_param("ssssisdsssssss",$img1,$img2,$img3,$ti,$ca,$sl,$pr,$st,$bt,$bv,$it,$iv,$sp,$de);
        }
        if ($product_obj->execute()){
            if ($product_obj->affected_rows > 0){
                return true;
            }
            return false;
        }
        return false;
    }

    public function update_product_status($p_id,$status){
        $product_query = "UPDATE tbl_products SET pro_active='$status' WHERE pro_id='$p_id'";
        $product_obj = $this->conn->prepare($product_query);
        if ($product_obj->execute()){
            if ($product_obj->affected_rows > 0){
                return true;
            }
            return false;
        }
        return false;
    }

    public function update_product_stock_status($p_id,$status){
        $product_query = "UPDATE tbl_products SET pro_stock='$status' WHERE pro_id='$p_id'";
        $product_obj = $this->conn->prepare($product_query);
        if ($product_obj->execute()){
            if ($product_obj->affected_rows > 0){
                return true;
            }
            return false;
        }
        return false;
    }

    public function create_product($im1,$im2,$im3,$dataset,$ti,$ca,$st,$bt,$bv,$it,$iv,$sl,$pr,$sp,$de){
        $prod_query = "SELECT * FROM tbl_products WHERE pro_slug='$sl'";
        $prod_obj = $this->conn->prepare($prod_query);
        if ($prod_obj->execute()){
            $data = $prod_obj->get_result()->num_rows;
            if ($data > 0){
                return false;
            } else {
                $pro_id= 4000000000+rand(10000000,99999999);
                $pro_query = "INSERT INTO tbl_products SET pro_id=?,pro_image1=?,pro_image2=?,pro_image3=?,dataset=?,pro_title=?,
                                category_id=?,solar_panel=?,batt_type=?,batt_volts=?,inv_type=?,inv_volts=?,pro_slug=?,pro_price=?,pro_spec=?,pro_desc=?";
                $pro_obj = $this->conn->prepare($pro_query);
                $pro_obj->bind_param("ssssssissssssdss",$pro_id,$im1,$im2,$im3,$dataset,$ti,$ca,$st,$bt,$bv,$it,$iv,$sl,$pr,$sp,$de);
                if ($pro_obj->execute()){
                    return true;
                }
                return false;
            }
        }
        return false;
    }

    public function list_products(){
        $prod_query = "SELECT * FROM tbl_products p INNER JOIN tbl_categories c ON c.category_id=p.category_id";
        $prod_obj = $this->conn->prepare($prod_query);
        if ($prod_obj->execute()) {
            return $prod_obj->get_result();
        }
        return array();
    }

    public function get_product_by_id($productId){
        $prod_query = "SELECT * FROM tbl_products p WHERE p.pro_id='$productId'";
        $prod_obj = $this->conn->prepare($prod_query);
        if ($prod_obj->execute()) {
            return $prod_obj->get_result();
        }
        return array();
    }

    public function update_blog($img1,$ti,$ca,$sl,$au,$bo,$p_id){
        if ($img1=="null"){
            $post_query = "UPDATE tbl_blog_posts SET post_title=?,post_cat=?,post_slug=?,post_author=?,post_body=? WHERE post_id='$p_id'";
            $post_obj = $this->conn->prepare($post_query);
            $post_obj->bind_param("sisss",$ti,$ca,$sl,$au,$bo);
        }
        if ($img1 !="null"){
            $post_query = "UPDATE tbl_blog_posts SET post_image1=?,post_title=?,post_cat=?,post_slug=?,post_author=?,post_body=? 
                            WHERE post_id='$p_id'";
            $post_obj = $this->conn->prepare($post_query);
            $post_obj->bind_param("ssisss",$img1,$ti,$ca,$sl,$au,$bo);
        }
        if ($post_obj->execute()){
            if ($post_obj->affected_rows > 0){
                return true;
            }
            return false;
        }
        return false;
    }

    public function update_blog_status($p_id,$status){
        $product_query = "UPDATE tbl_blog_posts SET post_active='$status' WHERE post_id='$p_id'";
        $product_obj = $this->conn->prepare($product_query);
        if ($product_obj->execute()){
            if ($product_obj->affected_rows > 0){
                return true;
            }
            return false;
        }
        return false;
    }

    public function create_blog($img1,$ti,$ca,$sl,$au,$bo){
        $prod_query = "SELECT * FROM tbl_blog_posts WHERE post_slug='$sl'";
        $prod_obj = $this->conn->prepare($prod_query);
        if ($prod_obj->execute()){
            $data = $prod_obj->get_result()->num_rows;
            if ($data > 0){
                return false;
            } else {
                $post_id= 8000000000+rand(10000000,99999999);
                $pro_query = "INSERT INTO tbl_blog_posts SET post_id=?,post_image1=?,post_title=?,post_cat=?,post_slug=?,post_author=?,
                                post_body=?";
                $pro_obj = $this->conn->prepare($pro_query);
                $pro_obj->bind_param("sssssss",$post_id,$img1,$ti,$ca,$sl,$au,$bo);
                if ($pro_obj->execute()){
                    return true;
                }
                return false;
            }
        }
        return false;
    }

    public function list_blog_posts(){
        $prod_query = "SELECT * FROM tbl_blog_posts b INNER JOIN tbl_blog_categories c ON c.category_id=b.post_cat";
        $prod_obj = $this->conn->prepare($prod_query);
        if ($prod_obj->execute()) {
            return $prod_obj->get_result();
        }
        return array();
    }

    public function get_blog_post_by_id($postId){
        $post_query = "SELECT * FROM tbl_blog_posts b WHERE b.post_id='$postId'";
        $post_obj = $this->conn->prepare($post_query);
        if ($post_obj->execute()) {
            return $post_obj->get_result();
        }
        return array();
    }

    public function count_customer(){
        $cnt = mysqli_num_rows(mysqli_query($this->conn, "SELECT * FROM tbl_customers"));
        if ($cnt > 0) return $cnt;
        return 0;
    }

    public function count_all_product(){
        $cnt = mysqli_num_rows(mysqli_query($this->conn, "SELECT * FROM tbl_products"));
        if ($cnt > 0) return $cnt;
        return 0;
    }

    public function count_all_order(){
        $cnt = mysqli_num_rows(mysqli_query($this->conn, "SELECT * FROM tbl_orders"));
        if ($cnt > 0) return $cnt;
        return 0;
    }

    public function today_booking_amt(){
        $amt_query = "SELECT SUM(order_amount) as myAmt FROM tbl_orders WHERE order_on > DATE_SUB(NOW(), INTERVAL 1 DAY)";
        $amt_obj = $this->conn->prepare($amt_query);
        if ($amt_obj->execute()) {
            $data= $amt_obj->get_result()->fetch_assoc();
            return $data['myAmt'];
        }
        return '';
    }

    public function month_booking_amt(){
        $amt_query = "SELECT SUM(order_amount) as myAmt FROM tbl_orders WHERE order_on > DATE_SUB(NOW(), INTERVAL 1 MONTH)";
        $amt_obj = $this->conn->prepare($amt_query);
        if ($amt_obj->execute()) {
            $data= $amt_obj->get_result()->fetch_assoc();
            return $data['myAmt'];
        }
        return '';
    }

    public function total_booking_amt(){
        $amt_query = "SELECT SUM(order_amount) as myAmt FROM tbl_orders";
        $amt_obj = $this->conn->prepare($amt_query);
        if ($amt_obj->execute()) {
            $data= $amt_obj->get_result()->fetch_assoc();
            return $data['myAmt'];
        }
        return '';
    }

    public function best_selling_product_amount(){
        $amt_query = "SELECT pro_id, SUM(product_qty) AS TotalQty FROM tbl_order_details
                        GROUP BY pro_id ORDER BY SUM(product_qty) DESC LIMIT 5";
        $amt_obj = $this->conn->prepare($amt_query);
        if ($amt_obj->execute()) {
            $data= $amt_obj->get_result()->fetch_assoc();
            return $data['TotalQty'];
        }
        return array();
    }

    public function list_best_selling(){
        $prod_query= "SELECT p.*,od.pro_id,SUM(od.product_qty) AS TotalQty FROM tbl_order_details od 
                        INNER JOIN tbl_products p ON p.pro_id=od.pro_id 
                         GROUP BY od.pro_id ORDER BY SUM(od.product_qty) 
                        DESC LIMIT 6";
        $prod_obj = $this->conn->prepare($prod_query);
        if ($prod_obj->execute()) {
            return $prod_obj->get_result();
        }
        return array();
    }

    public function read_average_review_rating($pid){
        $query = "SELECT ROUND(AVG(review_rate), 0) AS AverageRate FROM tbl_reviews WHERE pro_id='$pid'";
        $row = mysqli_fetch_assoc(mysqli_query($this->conn,$query));
        if ($row['AverageRate']>0) return $row['AverageRate'];
        else return 0;
    }

    public function pending_transfer_request(){
        $amt_query = "SELECT SUM(transferred_amount) as myAmt FROM tbl_transfer_payments WHERE transferred_status=0";
        $amt_obj = $this->conn->prepare($amt_query);
        if ($amt_obj->execute()) {
            $data= $amt_obj->get_result()->fetch_assoc();
            return $data['myAmt'];
        }
        return '';
    }

    public function list_latest_five_orders(){
        $order_query = "SELECT * FROM tbl_orders";
        $order_obj = $this->conn->prepare($order_query);
        if ($order_obj->execute()) {
            return $order_obj->get_result();
        }
        return array();
    }

    public function list_orders(){
        $order_query = "SELECT * FROM tbl_orders o INNER JOIN tbl_payments p ON p.order_id=o.order_id
                        INNER JOIN tbl_customers c ON c.customer_id=o.customer_id";
        $order_obj = $this->conn->prepare($order_query);
        if ($order_obj->execute()) {
            return $order_obj->get_result();
        }
        return array();
    }

    public function list_audit_bookings(){
        $order_query = "SELECT * FROM tbl_audit_booking b INNER JOIN tbl_audit_payment p ON p.booking_id=b.aud_book_sno";
        $order_obj = $this->conn->prepare($order_query);
        if ($order_obj->execute()) {
            return $order_obj->get_result();
        }
        return array();
    }

    public function list_ordered_items($order_id){
        $order_query = "SELECT * FROM tbl_order_details od INNER JOIN tbl_products p 
                        ON p.pro_id=od.pro_id WHERE od.order_id=$order_id";
        $order_obj = $this->conn->prepare($order_query);
        if ($order_obj->execute()) {
            return $order_obj->get_result();
        }
        return array();
    }

    public function update_order_status($order_id){
        $order_query = "UPDATE tbl_orders SET order_status='Delivered' WHERE order_id='$order_id'";
        $order_obj = $this->conn->prepare($order_query);
        if ($order_obj->execute()) {
            if ($this->send_rating_review_link($order_id)){
                return true;
            }
            return false;
        }
        return false;
    }

    public function order_by_id($order_id){
        $order_query = "SELECT * FROM tbl_orders WHERE order_id=?";
        $order_obj = $this->conn->prepare($order_query);
        $order_obj->bind_param("i",$order_id);
        if ($order_obj->execute()) {
            $data = $order_obj->get_result();
            return $data->fetch_assoc();
        }
        return array();
    }

    public function order_by_product($order_id){
        $order_query = "SELECT * FROM tbl_order_details od INNER JOIN tbl_products p ON od.pro_id=p.pro_id WHERE od.order_id=?";
        $order_obj = $this->conn->prepare($order_query);
        $order_obj->bind_param("i",$order_id);
        if ($order_obj->execute()) {
            return $order_obj->get_result();
        }
        return array();
    }

    public function send_rating_review_link($order_id){
        $order = $this->order_by_id($order_id);
        $productData="";
        $n=0;

        $link = "http://$_SERVER[HTTP_HOST]";
        $toEmail = $order['receiver_email'];
        $toName = $order['receiver_fname'];
        $orderId = $order['order_id'];

        $order_items = $this->order_by_product($orderId);
        if ($order_items->num_rows > 0) {
            while ($item = $order_items->fetch_assoc()) {
                $title = (strlen($item['pro_title']) > 30) ? substr($item['pro_title'],0,26)."...":$item['pro_title'];
                $trim_title = ucfirst(strtolower($title));
                if ($n % 2 == 0) $f_style='float:left;';else $f_style='float:right;';
                $productData .= '
                    <div class="item-card" style="width: calc(100%/2 - 18px);background: #ffffff;'.$f_style.'">
                        <a href="'.$link.'/review/'.$item['order_details_id'].'/'.$item['pro_id'] .'" class="link-decoration-none">
                        <div class="inner">
                            <div class="img">
                                <div class="img-wrapper"><img src="https://vanlagos.com/assets/images/'.$item['pro_image1'].'" alt=""></div>
                            </div>
                            <div class="body">
                                <div>
                                    <div class="item-name">'.$trim_title.'</div>
                                    <div class="item-qty">Qty: '.$item['product_qty'].'</div>
                                    <div>
                                        <div class="ratings-label-wrapper">
                                            <div class="label">Rate it:&nbsp;</div>
                                            <div class="star-rating list-style-none px-0 m-0">
                                                <span><img src="https://i.ibb.co/187FKxt/fiveStar.png" alt="fiveStar" style="width: 70px" border="0"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>';
                ++$n;
            }
        }

        $subject = 'Mainlandsolar Product Feedback';
        $content = "<!DOCTYPE html>
                    <html lang='en'>
                    <head>
                        <meta charset='UTF-8'>
                        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                        <title>Mainlandsolar Product Review</title>
                        <link rel='preconnect' href='https://fonts.gstatic.com' />
                        <link href='https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' rel='stylesheet' />
                        <style>
                            html, body {
                                font-size: 14px; width: 100%;min-height: 100%;margin: 0;padding: 0;font-family: 'Montserrat', sans-serif;
                                font-weight: 500;word-break: break-word;
                            }
                            .container {max-width: 500px;margin: 0 auto;padding: 1em;}
                            thead {background-color: #F1F2F1;border: 1px solid #C4C4C4;}
                            .brand-logo {max-width: 70px;margin: 0 auto;}
                            .brand-logo img {width: 100%;}
                            .header {padding: .5em 0;}
                            .item-card {font-size: .8rem;border: 1px solid #9F9F9F;padding: .5em;}
                            .item-card .inner {overflow: auto;}
                            .item-card .inner .img {width: 38%;float: left;}
                            img {width: 100%;}
                            .item-card .inner .img,
                            .item-card .inner .body {}
                            .item-card .inner .body {width: 60%;float: right;}
                            @media(max-width:430px){  .item-card .inner .body {margin-top: 2em;}  }
                            .item-name, .item-qty {margin-bottom: .5em;}
                            .footer-brand-logo .img-wrapper {width: 50px;}
                            .px-0 {padding-right: 0;padding-left: 0;}
                            .list-style-none {list-style: none;}
                            .bold-600 {font-weight: 600;}
                            .pl-2 {padding-left: 1em;}
                            .px-0 {padding-right: 0;padding-left: 0;}
                            .p-0 {padding-right: 0;padding-left: 0;padding-top: 0;padding-bottom: 0;}
                            .m-0 {margin-right: 0;margin-left: 0;margin-top: 0;margin-bottom: 0;}
                            .my-0 {margin-bottom: 0;}
                            a.link-decoration-none {text-decoration: none !important;color: #000000 !important;}
                            a.link-decoration-none:hover {text-decoration: none !important;}
                            .ratings-label-wrapper {background-color: #202020;padding: .5em;}
                            .ratings-label-wrapper .label {color: #ffffff;}
                            .ratings-label-wrapper .star-rating .fa-star {color: #F7B710;}
                            .product-list .item-card {margin-bottom: 3px;}
                            .ratings-label-wrapper {overflow: auto;}
                            .ratings-label-wrapper .label {float: left;height: 100%;}
                            .ratings-label-wrapper .star-rating {float: right;white-space: nowrap;}
                            @media screen and (min-width: 430px) { .item-card .inner .img {width:35%;}
                            .item-card .inner .body {width: 63%;}
                            .product-list {overflow: auto;}
                            .product-list .item-card {width: calc(100%/2 - 18px);background: #ffffff;}
                            .product-list .item-card:nth-child(odd) {float: left;}
                            .product-list .item-card:nth-child(even) {float: right;} }
                        </style>
                    </head>
            <body>
                <div class='container'>
                    <table class='table'>
                        <thead>
                            <tr>
                                <th colspan='2'>
                                    <div class='header'>
                                        <div class='img-wrapper brand-logo'>
                                            <img src='https://i.ibb.co/Z6Ck09y/navbrand-logo-min.png' alt='navbrand-logo-min' border='0'>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan='2'>
                                    <p>Dear ".$toName.",<br/><br/>
                                        Thank you for stopping by Mainland solar.<br/><br/>
                                        Please help us improve our service and give all customers a better understanding about the product(s) you ordered!
                                    </p>
                                </td>
                            </tr>
                            <tr>
                            <td>
                                <div class='product-list'>
                            ".$productData."   
                                </div>
                            </td>
                            </tr>
                            <tr>
                                <td colspan='2'>Happy Shopping!
                                    <br/><br/> Best Regards, <br/><br/>
                                    <div class='footer-brand-logo'>
                                        <div class='img-wrapper'>
                                            <img src='https://i.ibb.co/Z6Ck09y/navbrand-logo-min.png' alt='navbrand-logo-min' border='0'>
                                        </div>
                                    </div>
                                    <br/>MS Team
                                    <p><span class='bold-600'>Got any questions?</span><br/><span class='pl-2'>Get in touch wit us via email or call +2348099973409</span></p>
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

    public function send_order_receipt_mail_to_customer($id){
        $req_query = "SELECT tp.*,o.*,c.* FROM tbl_transfer_payments tp INNER JOIN tbl_orders o ON o.order_id=tp.order_id 
                        INNER JOIN tbl_customers c ON o.customer_id=c.customer_id WHERE tp.order_id=$id";
        $req_obj = $this->conn->prepare($req_query);
        if ($req_obj->execute()){
            $res = $req_obj->get_result();
            $data= $res->fetch_assoc();
            $toEmail = $data['email'];
            $link="https://$_SERVER[HTTP_HOST]";
            $subject = "Made-in-Lagos Order Receipt";
            $name = $data['firstname']." ".$data['lastname'];

            $content = "<html>
                    <head>
                        <meta charset='UTF-8'>
                        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                        <title>User Order Receipt</title>
                        <style>
                            @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap');
                            * {box-sizing: border-box;}
                            body {font-family: \"Roboto\", sans-serif;margin: 0;padding: 0;font-size: 14px;line-height: 10px;}
                            .brand_logo {width: 120px;}
                            .brand_logo img {width: 100%;}
                            h2 {margin: 0;}
                            .wrapper {max-width: 600px;margin: 0 auto;line-height: 15px;}
                            th {background-color: #254c0c;color: #ffffff;padding: .5em .7em;}
                            .brand_logo {text-align: left;background-color: #254c0c;padding: 1em;display: flex;border-radius: 5px;}
                            .brand_logo#header_brand_logo {width: 45px;margin: 0 auto;padding: 0;}
                           
                            @media(min-width: 700px) {
                                body {font-size: 15px;}
                            }
                        </style>
                    </head>
                    <body>
                        <div class='wrapper'>
                        <table>
                            <thead>
                                <tr>
                                    <th colspan='2'>
                                        <h2 class='brand_logo' id='header_brand_logo'>
                                            <img src='https://i.ibb.co/3cQYjXJ/MILlogowhitepx.png' alt='MILlogowhitepx' border='0'>
                                        </h2>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan='2'>
                                        <p>Hi, ".$name."</p>
                                        <p>Your payment was successful and has been received by Made in Lagos.</p>
                                        <h4>Amount Paid: <span style='color:#740774;'>₦".number_format($data['order_amount'],0)."</span></h4>
                                        <h5>Quantity: ".$data['order_qty']."</h5>
                                        <h5 >Order Reference: MIL".$data['order_ref']."</h5>
                                        <hr style='width: 100%; margin: auto;' />
                                        <p style='color:#c3df34;text-align:center;'>". date('l F j Y', strtotime($data['order_on']))."</p>
                                    </td>
                                </tr>
                              
                                <tr>
                                    <td colspan='2'>
                                        <p>Happy Shopping!<br> Best Regards,</p>
                                        <img src='https://i.ibb.co/n7y04q5/favicon.png' alt='favicon' border='0' width='59px'>
                                        <p>
                                            <strong>Got any questions?</strong><br>
                                            Get in touch wit us via email or call 01 888 1100 / 0700 600 0000 or simply reply to this email.
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </body>
                    </html>";
            $mailHeaders ="MIME-Version: 1.0"."\r\n";
            $mailHeaders .="Content-type:text/html;charset=UTF-8"."\r\n";
            $mailHeaders .= "From: Made-in-lagos <support@made-in-lagos.com.com>\r\n";
            if (mail($toEmail, $subject, $content, $mailHeaders)) {
                return true;
            }
            return false;
        }
        return false;
    }

    public function transfer_request(){
        $order_query = "SELECT * FROM tbl_transfer_payments t INNER JOIN tbl_orders o ON o.order_id=t.order_id
                        INNER JOIN tbl_customers c ON o.customer_id=c.customer_id WHERE t.transferred_status=0 ORDER BY t.transfer_id DESC";
        $order_obj = $this->conn->prepare($order_query);
        if ($order_obj->execute()) {
            return $order_obj->get_result();
        }
        return array();
    }

    public function energy_audit_transfer_request(){
        $order_query = "SELECT * FROM tbl_audit_transfer t INNER JOIN tbl_audit_booking b ON b.aud_book_sno=t.booking_id
                        INNER JOIN tbl_audit_payment p ON p.booking_id=b.aud_book_sno
                        WHERE t.transferred_status=0 ORDER BY t.aud_tran_id DESC";
        $order_obj = $this->conn->prepare($order_query);
        if ($order_obj->execute()) {
            return $order_obj->get_result();
        }
        return array();
    }

    public function update_transfer_request($order_id){
        $transfer_query = "UPDATE tbl_transfer_payments SET transferred_status=1 WHERE order_id=$order_id";
        $transfer_query2 = "UPDATE tbl_payments SET payment_status='Paid' WHERE order_id=$order_id";
        $transfer_obj = $this->conn->prepare($transfer_query);
        $transfer_obj2 = $this->conn->prepare($transfer_query2);
        if ($transfer_obj->execute()) {
            if ($transfer_obj2->execute()){
                if ($this->send_order_receipt_mail_to_customer($order_id)){
                    return true;
                }
            }
        }
        return false;
    }

    public function payments(){
        $order_query = "SELECT * FROM tbl_payments p INNER JOIN tbl_orders o ON o.order_id=p.order_id
                        INNER JOIN tbl_customers c ON o.customer_id=c.customer_id ORDER by p.payment_id DESC";
        $order_obj = $this->conn->prepare($order_query);
        if ($order_obj->execute()) {
            return $order_obj->get_result();
        }
        return array();
    }

    public function count_new_order(){
        $cnt = mysqli_num_rows(mysqli_query($this->conn, "SELECT * FROM tbl_orders WHERE order_status='New Order'"));
        if ($cnt > 0) return $cnt;
        return 0;
    }

    public function get_last_order_time(){
        $order_query = "SELECT order_status,order_on,order_id FROM tbl_orders WHERE order_status='New Order' ORDER BY order_id DESC";
        $order_obj = $this->conn->prepare($order_query);
        if ($order_obj->execute()) {
            $data= $order_obj->get_result()->fetch_assoc();
            return $data['order_on'];
        }
        return array();
    }

}

$admin = new Admin();
?>