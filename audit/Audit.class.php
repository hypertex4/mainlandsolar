<?php

$filepath = realpath(dirname(__FILE__));
require $filepath.'/vendor/autoload.php';
use \Mailjet\Resources;


class Audit {
    private $conn;
    //constructor
    public function __construct($db) {
        $this->conn = $db;
    }

    public function create_audit_request(
        $client_name,$phone_no,$email,$survey_loc,$survey_add,$sur_other_loc,$pry_purpose,$solar_coverage,$panel_space,
        $other_info,$b_date,$b_time,$created_on
    ){
        $query = "INSERT INTO tbl_audit_booking 
                    SET client_name=?,phone_no=?,email=?,survey_location=?,survey_address=?,survey_other_loc=?,pry_purpose=?,
                    solar_coverage=?,panel_space=?,other_info=?,b_date=?,b_time=?,b_created_on=?";
        $inserted_obj = $this->conn->prepare($query);
        $inserted_obj->bind_param(
            "sssssssssssss",
            $client_name,$phone_no,$email,$survey_loc,$survey_add,$sur_other_loc,$pry_purpose,$solar_coverage,$panel_space,
            $other_info,$b_date,$b_time,$created_on
        );
        $inserted_obj->execute();
        if ($inserted_obj->affected_rows > 0){
            $booking_id = mysqli_insert_id($this->conn);
            return $booking_id;
        }
        return false;
    }

    public function create_audit_payment($response,$amount,$payment_ref,$payment_method,$payment_status){
        $query = "INSERT INTO tbl_audit_payment SET booking_id=?,payment_amount=?,payment_ref=?,payment_method=?,payment_status=?";
        $inserted_obj = $this->conn->prepare($query);
        $inserted_obj->bind_param("idsss",$response,$amount,$payment_ref,$payment_method,$payment_status);
        $inserted_obj->execute();
        if ($inserted_obj->affected_rows > 0){
            $id = mysqli_insert_id($this->conn);
            if ($payment_method=="Paystack") {
                $this->send_audit_booking_mail($id);
            }
            return true;
        }
        return false;
    }

    public function create_transfer_request($booking_id,$account_name,$transferred_amount){
        $query = "INSERT INTO tbl_audit_transfer SET booking_id=?,account_name=?,transferred_amount=?";
        $inserted_obj = $this->conn->prepare($query);
        $inserted_obj->bind_param("isd",$booking_id,$account_name,$transferred_amount);
        $inserted_obj->execute();
        if ($inserted_obj->affected_rows > 0){
            return true;
        }
        return false;
    }

    public function send_audit_booking_mail($id){
        $aud_query = "SELECT * FROM tbl_audit_payment p INNER JOIN tbl_audit_booking b ON b.aud_book_sno=p.booking_id 
                        WHERE p.aud_pay_id=$id";
        $aud_obj = $this->conn->prepare($aud_query);
        if ($aud_obj->execute()){
            $res = $aud_obj->get_result();
            $data = $res->fetch_assoc();

            $mj = new \Mailjet\Client('afb6878877604f15e363e079ec9afdf2','0dadbeab47e25b93c19bc78ff6812eca', true, ['version' => 'v3.1']);
            $body = ['Messages' => [[
                'From' => ['Email' => "support@mainlandtech.com", 'Name' => "Mainlandsolar"],
                'To' => [
                    [
                        'Email' => $data['email'],
                        'Name' => $data['client_name']
                    ]
                ],
                'Subject' => "Mainlandsolar Energy Audit - Payment Receipt",
                'HTMLPart' => "
                <!DOCTYPE html>
                <html lang='en' xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:v='urn:schemas-microsoft-com:vml'>
                <head>
                <title></title>
                <meta charset='utf-8'/>
                <meta content='width=device-width, initial-scale=1.0' name='viewport'/>
                <!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]-->
                <style>
                    * {box-sizing: border-box;}
                    body {margin: 0;padding: 0;}
                    a[x-apple-data-detectors] {color: inherit !important;text-decoration: inherit !important;}
                    #MessageViewBody a {color: inherit;text-decoration: none;}
                    p {line-height: inherit}
                    @media (max-width:660px) {
                        .icons-inner {text-align: center;}
                        .icons-inner td {margin: 0 auto;}
                        .row-content {width: 100% !important;}
                        .stack .column {width: 100%;display: block;}
                    }
                </style>
                </head>
                <body style='background-color: #f8f8f9; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;'>
                <table border='0' cellpadding='0' cellspacing='0' class='nl-container' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f8f8f9;' width='100%'>
                <tbody>
                <tr>
                <td>
                <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-1' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #1aa19c;' width='100%'>
                <tbody>
                <tr>
                <td>
                <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #1aa19c; color: #000000; width: 640px;' width='640'>
                <tbody>
                <tr>
                <td class='column' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
                <table border='0' cellpadding='0' cellspacing='0' class='divider_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                <tr>
                <td>
                <div align='center'>
                <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                <tr>
                <td class='divider_inner' style='font-size: 1px; line-height: 1px; border-top: 4px solid #209E02;'><span> </span></td>
                </tr>
                </table>
                </div>
                </td>
                </tr>
                </table>
                </td>
                </tr>
                </tbody>
                </table>
                </td>
                </tr>
                </tbody>
                </table>
                <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-2' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fff;' width='100%'>
                <tbody>
                <tr>
                <td>
                <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fff; color: #000000; width: 640px;' width='640'>
                <tbody>
                <tr>
                <td class='column' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
                <table border='0' cellpadding='0' cellspacing='0' class='image_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                <tr>
                <td style='padding-bottom:25px;padding-top:22px;width:100%;padding-right:0px;padding-left:0px;'>
                <div align='center' style='line-height:10px'><img alt='Logo' src='https://i.ibb.co/Z6Ck09y/navbrand-logo-min.png' style='display: block; height: auto; border: 0; width: 100px; max-width: 100%;' title='Logo' width='100'/></div>
                </td>
                </tr>
                </table>
                </td>
                </tr>
                </tbody>
                </table>
                </td>
                </tr>
                </tbody>
                </table>
                <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-3' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                <tbody>
                <tr>
                <td>
                <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f8f8f9; color: #000000; width: 640px;' width='640'>
                <tbody>
                <tr>
                <td class='column' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
                <table border='0' cellpadding='20' cellspacing='0' class='divider_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                <tr>
                <td>
                <div align='center'>
                <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                <tr>
                <td class='divider_inner' style='font-size: 1px; line-height: 1px; border-top: 0px solid #BBBBBB;'><span> </span></td>
                </tr>
                </table>
                </div>
                </td>
                </tr>
                </table>
                </td>
                </tr>
                </tbody>
                </table>
                </td>
                </tr>
                </tbody>
                </table>
                <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-4' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                <tbody>
                <tr>
                <td>
                <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fff; color: #000000; width: 640px;' width='640'>
                <tbody>
                <tr>
                <td class='column' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
                <table border='0' cellpadding='0' cellspacing='0' class='image_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                <tr>
                <td style='padding-left:40px;padding-right:40px;width:100%;'>
                <div align='center' style='line-height:10px'><img alt='Success' src='https://i.ibb.co/WvHrQ3Q/check-mark-removebg-preview.png' style='display: block; height: auto; border: 0; width: 160px; max-width: 100%;' title='Sucess' width='160'/></div>
                </td>
                </tr>
                </table>
                <table border='0' cellpadding='0' cellspacing='0' class='divider_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                <tr>
                <td style='padding-top:50px;'>
                <div align='center'>
                <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                <tr>
                <td class='divider_inner' style='font-size: 1px; line-height: 1px; border-top: 0px solid #BBBBBB;'><span> </span></td>
                </tr>
                </table>
                </div>
                </td>
                </tr>
                </table>
                <table border='0' cellpadding='0' cellspacing='0' class='text_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                <tr>
                <td style='padding-bottom:10px;padding-left:40px;padding-right:40px;padding-top:10px;'>
                <div style='font-family: sans-serif'>
                <div style='font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;'>
                <p style='margin: 0; font-size: 16px; text-align: center;'><span style='font-size:30px;color:#2b303a;'><strong>Thank you for the payment</strong></span></p>
                </div>
                </div>
                </td>
                </tr>
                </table>
                <table border='0' cellpadding='0' cellspacing='0' class='text_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                <tr>
                <td style='padding-bottom:10px;padding-left:40px;padding-right:40px;padding-top:10px;'>
                <div style='font-family: sans-serif'>
                <div style='font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 18px; color: #555555; line-height: 1.5;'>
                <p style='margin: 0; font-size: 14px; text-align: center;'>Hi ".$data['client_name'].", this is a confirmation that we’ve just received your online payment for Solar Audit
                 <span id='166c679c-c52f-47e0-ab65-2830067c661d' style=''>@ ".$data['survey_address'].", ".$data['survey_location'].$data['survey_other_loc']."</span>. 
                    Thank you for trusting us. Our esteem team will reach out to you shortly</p>
                </div>
                </div>
                </td>
                </tr>
                </table>
                <table border='0' cellpadding='0' cellspacing='0' class='text_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                <tr>
                <td style='padding-bottom:10px;padding-left:40px;padding-right:40px;padding-top:20px;'>
                <div style='font-family: sans-serif'>
                <div style='font-size: 12px; mso-line-height-alt: 18px; color: #555555; line-height: 1.5; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;'>
                <p style='margin: 0; font-size: 15px; text-align: left; mso-line-height-alt: 21px;'><span style='font-size:14px;'><span style='font-size:16px;'><strong>Find Details Below</strong></span></span></p>
                <p style='margin: 0; font-size: 15px; text-align: left; mso-line-height-alt: 22.5px;'><span style='font-size:15px;'><strong>Survey Address</strong>: ".
                    $data['survey_address'].", ".$data['survey_location'].$data['survey_other_loc']."</span></p>
                <p style='margin: 0; font-size: 15px; text-align: left; mso-line-height-alt: 22.5px;'><span style='font-size:15px;'><strong>Purpose for Solar</strong>: ".$data['pry_purpose']."</span></p>
                <p style='margin: 0; font-size: 15px; text-align: left; mso-line-height-alt: 22.5px;'><span style='font-size:15px;'><strong>Level of Solar Coverage</strong>: ".$data['solar_coverage']."</span></p>
                <p style='margin: 0; font-size: 15px; text-align: left; mso-line-height-alt: 22.5px;'><span style='font-size:15px;'><strong>Space for Panels</strong>: ".$data['panel_space']."</span></p>
                <p style='margin: 0; font-size: 15px; text-align: left; mso-line-height-alt: 22.5px;'><span style='font-size:15px;'><strong>Other Information</strong>: ".$data['other_info']."</span></p>
                <p style='margin: 0; font-size: 15px; text-align: left; mso-line-height-alt: 22.5px;'><span style='font-size:15px;'><strong>Date</strong>: ".date('d F, Y',strtotime($data['b_date']))."</span></p>
                <p style='margin: 0; font-size: 15px; text-align: left; mso-line-height-alt: 22.5px;'><span style='font-size:15px;'><strong>Time</strong>: ".$data['b_time']."</span></p>
                </div>
                </div>
                </td>
                </tr>
                </table>
                <table border='0' cellpadding='0' cellspacing='0' class='divider_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                <tr>
                <td style='padding-top:50px;'>
                <div align='center'>
                <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                <tr>
                <td class='divider_inner' style='font-size: 1px; line-height: 1px; border-top: 0px solid #BBBBBB;'><span> </span></td>
                </tr>
                </table>
                </div>
                </td>
                </tr>
                </table>
                </td>
                </tr>
                </tbody>
                </table>
                </td>
                </tr>
                </tbody>
                </table>
                <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-5' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                <tbody>
                <tr>
                <td>
                <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fff; color: #000000; width: 640px;' width='640'>
                <tbody>
                <tr>
                <td class='column' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top;' width='50%'>
                <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                <tr>
                <td style='width:20px;background-color:#FFF'> </td>
                <td style='background-color:#f3fafa;border-right:8px solid #FFF;border-top:0px;border-bottom:0px;width:300px;'>
                <table border='0' cellpadding='0' cellspacing='0' class='divider_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                <tr>
                <td>
                <div align='center'>
                <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                <tr>
                <td class='divider_inner' style='font-size: 1px; line-height: 1px; border-top: 4px solid #209E02;'><span> </span></td>
                </tr>
                </table>
                </div>
                </td>
                </tr>
                </table>
                <table border='0' cellpadding='0' cellspacing='0' class='text_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                <tr>
                <td style='padding-bottom:40px;padding-left:5px;padding-right:5px;padding-top:35px;'>
                <div style='font-family: sans-serif'>
                <div style='font-size: 12px; mso-line-height-alt: 18px; color: #555555; line-height: 1.5; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;'>
                <p style='margin: 0; font-size: 16px; text-align: center; mso-line-height-alt: 18px;'><span style='color:#a2a9ad;font-size:12px;'><strong>PAYMENT REFERENCE</strong></span></p>
                <p style='margin: 0; font-size: 16px; text-align: center; mso-line-height-alt: 30px;'><span style='color:#2b303a;font-size:20px;'><strong>#".$data['payment_ref']."</strong></span></p>
                </div>
                </div>
                </td>
                </tr>
                </table>
                </td>
                </tr>
                </table>
                </td>
                <td class='column' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top;' width='50%'>
                <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                <tr>
                <td style='background-color:#f3fafa;border-left:8px solid #FFF;border-top:0px;border-bottom:0px;width:300px;'>
                <table border='0' cellpadding='0' cellspacing='0' class='divider_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                <tr>
                <td>
                <div align='center'>
                <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                <tr>
                <td class='divider_inner' style='font-size: 1px; line-height: 1px; border-top: 4px solid #209E02;'><span> </span></td>
                </tr>
                </table>
                </div>
                </td>
                </tr>
                </table>
                <table border='0' cellpadding='0' cellspacing='0' class='text_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                <tr>
                <td style='padding-bottom:40px;padding-left:5px;padding-right:5px;padding-top:35px;'>
                <div style='font-family: sans-serif'>
                <div style='font-size: 12px; mso-line-height-alt: 18px; color: #555555; line-height: 1.5; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;'>
                <p style='margin: 0; font-size: 16px; text-align: center; mso-line-height-alt: 18px;'><span style='color:#a2a9ad;font-size:12px;'><strong>TOTAL</strong></span></p>
                <p style='margin: 0; font-size: 16px; text-align: center; mso-line-height-alt: 30px;'><span style='color:#2b303a;font-size:20px;'><strong>₦".number_format($data['payment_amount'],2)."</strong></span></p>
                </div>
                </div>
                </td>
                </tr>
                </table>
                </td>
                <td style='width:20px;background-color:#FFF'> </td>
                </tr>
                </table>
                </td>
                </tr>
                </tbody>
                </table>
                </td>
                </tr>
                </tbody>
                </table>
                <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-6' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                <tbody>
                <tr>
                <td>
                <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fff; color: #000000; width: 640px;' width='640'>
                <tbody>
                <tr>
                <td class='column' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
                <table border='0' cellpadding='0' cellspacing='0' class='divider_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                <tr>
                <td style='padding-bottom:12px;padding-top:60px;'>
                <div align='center'>
                <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                <tr>
                <td class='divider_inner' style='font-size: 1px; line-height: 1px; border-top: 0px solid #BBBBBB;'><span> </span></td>
                </tr>
                </table>
                </div>
                </td>
                </tr>
                </table>
                </td>
                </tr>
                </tbody>
                </table>
                </td>
                </tr>
                </tbody>
                </table>
                <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-7' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                <tbody>
                <tr>
                <td>
                <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f8f8f9; color: #000000; width: 640px;' width='640'>
                <tbody>
                <tr>
                <td class='column' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
                <table border='0' cellpadding='20' cellspacing='0' class='divider_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                <tr>
                <td>
                <div align='center'>
                <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                <tr>
                <td class='divider_inner' style='font-size: 1px; line-height: 1px; border-top: 0px solid #BBBBBB;'><span> </span></td>
                </tr>
                </table>
                </div>
                </td>
                </tr>
                </table>
                </td>
                </tr>
                </tbody>
                </table>
                </td>
                </tr>
                </tbody>
                </table>
                <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-8' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                <tbody>
                <tr>
                <td>
                <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #2b303a; color: #000000; width: 640px;' width='640'>
                <tbody>
                <tr>
                <td class='column' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
                <table border='0' cellpadding='0' cellspacing='0' class='divider_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                <tr>
                <td>
                <div align='center'>
                <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                <tr>
                <td class='divider_inner' style='font-size: 1px; line-height: 1px; border-top: 4px solid #209E02;'><span> </span></td>
                </tr>
                </table>
                </div>
                </td>
                </tr>
                </table>
                <table border='0' cellpadding='0' cellspacing='0' class='social_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                <tr>
                <td style='padding-bottom:10px;padding-left:10px;padding-right:10px;padding-top:28px;text-align:center;'>
                <table align='center' border='0' cellpadding='0' cellspacing='0' class='social-table' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='104px'>
                <tr>
                <td style='padding:0 10px 0 10px;'></td>
                <td style='padding:0 10px 0 10px;'></td>
                </tr>
                </table>
                </td>
                </tr>
                </table>
                <table border='0' cellpadding='0' cellspacing='0' class='divider_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                <tr>
                <td style='padding-bottom:10px;padding-left:40px;padding-right:40px;padding-top:10px;'>
                <div align='center'>
                <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                <tr>
                <td class='divider_inner' style='font-size: 1px; line-height: 1px; border-top: 1px solid #555961;'><span> </span></td>
                </tr>
                </table>
                </div>
                </td>
                </tr>
                </table>
                <table border='0' cellpadding='0' cellspacing='0' class='text_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                <tr>
                <td style='padding-bottom:30px;padding-left:40px;padding-right:40px;padding-top:20px;'>
                <div style='font-family: sans-serif'>
                <div style='font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2;'>
                <p style='margin: 0; font-size: 14px; text-align: left;'><span style='color:#95979c;font-size:12px;'>Mainlandsolar Copyright © 2021</span></p>
                </div>
                </div>
                </td>
                </tr>
                </table>
                </td>
                </tr>
                </tbody>
                </table>
                </td>
                </tr>
                </tbody>
                </table>
                <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-9' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                <tbody>
                <tr>
                <td>
                <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 640px;' width='640'>
                <tbody>
                <tr>
                <td class='column' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
                <table border='0' cellpadding='0' cellspacing='0' class='icons_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                <tr>
                <td style='color:#9d9d9d;font-family:inherit;font-size:15px;padding-bottom:5px;padding-top:5px;text-align:center;'>
                <table cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                <tr>
                <td style='text-align:center;'>
                <table align='left' cellpadding='0' cellspacing='0' role='presentation' style='display:inline-block;padding-left:0px;padding-right:0px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                </td>
                </tr>
                </table>
                </td>
                </tr>
                </table>
                </td>
                </tr>
                </tbody>
                </table>
                </td>
                </tr>
                </tbody>
                </table>
                </td>
                </tr>
                </tbody>
                </table><!-- End -->
                </body>
                </html>",
            ]]];
            $response = $mj->post(Resources::$Email, ['body' => $body]);
            if ($response->success()){
                return true;
            }
            return false;
        }
        return false;
    }

    public function get_audit_bookings(){
        $book_q = "SELECT * FROM tbl_audit_booking";
        $book_obj = $this->conn->prepare($book_q);
        if ($book_obj->execute()) {
            return $book_obj->get_result();
        }
        return array();
    }

    public function update_energy_audit_transfer_request($book_sno,$aud_pay_id){
        $transfer_query = "UPDATE tbl_audit_transfer SET transferred_status=1 WHERE booking_id=$book_sno";
        $transfer_query2 = "UPDATE tbl_audit_payment SET payment_status='Paid' WHERE booking_id=$book_sno";
        $transfer_obj = $this->conn->prepare($transfer_query);
        $transfer_obj2 = $this->conn->prepare($transfer_query2);
        if ($transfer_obj->execute()) {
            if ($transfer_obj2->execute()){
                if ($this->send_audit_booking_mail($aud_pay_id)){
                    return true;
                }
            }
        }
        return false;
    }

    public function get_audit_booking_time($selected_date,$pick_time){
        $book_q = "SELECT * FROM tbl_audit_booking WHERE b_date='$selected_date' AND b_time='$pick_time'";
        $book_obj = $this->conn->prepare($book_q);
        if ($book_obj->execute()) {
            return $book_obj->get_result()->fetch_assoc();
        }
        return array();
    }

    public function get_audit_booking_all($selected_date){
        $book_q = "SELECT * FROM tbl_audit_booking WHERE b_date='$selected_date'";
        $book_obj = $this->conn->prepare($book_q);
        if ($book_obj->execute()) {
            return $book_obj->get_result();
        }
        return array();
    }

}

?>