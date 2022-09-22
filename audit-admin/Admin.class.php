<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../audit/database.php');

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

    public function count_all_audit_request(){
        $cnt = mysqli_num_rows(mysqli_query($this->conn, "SELECT * FROM tbl_audit_payment"));
        if ($cnt > 0) return $cnt;
        return 0;
    }

    public function count_paid_audit_request(){
        $cnt = mysqli_num_rows(mysqli_query($this->conn, "SELECT * FROM tbl_audit_payment WHERE payment_status='Paid'"));
        if ($cnt > 0) return $cnt;
        return 0;
    }

    public function count_pending_audit_request(){
        $cnt = mysqli_num_rows(mysqli_query($this->conn, "SELECT * FROM tbl_audit_payment WHERE payment_status='Unverified'"));
        if ($cnt > 0) return $cnt;
        return 0;
    }

    public function total_audit_booking(){
        $amt_query = "SELECT SUM(payment_amount) as payment_amount FROM tbl_audit_payment";
        $amt_obj = $this->conn->prepare($amt_query);
        if ($amt_obj->execute()) {
            $data= $amt_obj->get_result()->fetch_assoc();
            return $data['payment_amount'];
        }
        return 0;
    }

    public function total_pending_audit_booking(){
        $amt_query = "SELECT SUM(payment_amount) as payment_amount FROM tbl_audit_payment WHERE payment_status='Unverified'";
        $amt_obj = $this->conn->prepare($amt_query);
        if ($amt_obj->execute()) {
            $data= $amt_obj->get_result()->fetch_assoc();
            return $data['payment_amount'];
        }
        return 0;
    }

    public function total_paid_audit_booking(){
        $amt_query = "SELECT SUM(payment_amount) as payment_amount FROM tbl_audit_payment WHERE payment_status='Paid'";
        $amt_obj = $this->conn->prepare($amt_query);
        if ($amt_obj->execute()) {
            $data= $amt_obj->get_result()->fetch_assoc();
            return $data['payment_amount'];
        }
        return 0;
    }

    public function list_audit_bookings(){
        $order_query = "SELECT * FROM tbl_audit_booking b INNER JOIN tbl_audit_payment p ON p.booking_id=b.aud_book_sno";
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

}

$admin = new Admin();
?>