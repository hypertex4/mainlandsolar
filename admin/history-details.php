<?php
if (!isset($_GET['historyId']) || $_GET['historyId'] == NULL ) {
    echo "<script>window.location = 'installation-histories'; </script>";
} else {
    $historyId = $_GET['historyId'];
}
?>
<?php
$message = '';
$connect = new PDO("mysql:host=localhost;dbname=mainlandsolar","root","");
function fetch_installation_data($connect) {
    global $historyId;
    $query = "SELECT * FROM tbl_project_history WHERE history_id='$historyId'";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row) {
        $output = '
			<h1 class="request-id">Request ID: <span>'.$row["history_id"].'</span></h1>
            <table class="installation-data border">
                <thead>
                <tr>
                    <th scope="col" class="col"></th>
                    <th scope="col" class="col"></th>
                </tr>
                </thead>
                <tbody>
                <tr class="border-bottom">
                    <td scope="row">
                        <div class="inner">
                            <div class="label">Name of installation:</div>
                            <div class="value">'.$row["name_of_ins"].'</div>
                        </div>
                    </td>
                    <td>
                        <div class="inner">
                            <div class="label">Size of installation:</div>
                            <div class="value">'.$row["size_of_ins"].'</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td scope="row">
                        <div class="inner">
                            <div class="label">System components</div>
                            <div class="value">'.$row["sys_comps"].'</div>
                        </div>
                    </td>
                    <td>
                        <div class="inner">
                            <div class="label">Date of completion of installation</div>
                            <div class="value">'.date("d-M-Y", strtotime($row["date_of_com"])).'</div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <table class="installation-details border">
                    <thead>
                    <tr>
                        <th scope="col" colspan="2" class="py-2">
                            <div>ENTRIES OF MAINTENANCE OPERATIONS ON THE INSTALLATION HAVING:</div>
                        </th>
                    </tr>
                    <tr>
                        <th scope="col" class="col"></th>
                        <th scope="col" class="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="border-bottom">
                        <th scope="row">
                            <div class="inner">o Issues raised:</div>
                        </th>
                        <td>
                            <div class="inner">
                                <p>'.$row["issues_raised"].'</p>
                            </div>
                        </td>
                    </tr>
                    <tr class="border-bottom">
                        <th scope="row">
                            <div class="inner">o Date of issue report:</div>
                        </th>
                        <td>
                            <div class="inner">'.date("d-M-Y",strtotime($row["date_issued"])).'</div>
                        </td>
                    </tr>
                    <tr class="border-bottom">
                        <th scope="row">
                            <div class="inner">o Troubleshooting and action performed for resolution:</div>
                        </th>
                        <td>
                            <div class="inner">
                                <p>'.$row["trob_action"].'</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <div class="inner">o Date resolved:</div>
                        </th>
                        <td>
                            <div class="inner">'.date("d-M-Y", strtotime($row["resolved_date"])).'</div>
                        </td>
                    </tr>
                    </tbody>
                </table>
		';
    }
    return $output;
}

if(isset($_POST["action"]))
{
    include('pdf.php');
    $file_name = md5(rand()) . '.pdf';
    $html_code = '<link rel="stylesheet" href="bootstrap.min.css">';
    $html_code .= fetch_installation_data($connect);
    $pdf = new Pdf();
    $pdf->load_html($html_code);
    $pdf->render();
    $file = $pdf->output();
    file_put_contents($file_name, $file);

    require 'class/class.phpmailer.php';
    $mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->Host = 'mail.vanlagos.com';
    $mail->Port = '465';
    $mail->SMTPAuth = true;
    $mail->Username = 'test12@vanlagos.com';
    $mail->Password = 'phrase@123$';
    $mail->SMTPSecure = 'ssl';
    $mail->From = 'test12@vanlagos.com';
    $mail->FromName = 'Mainlandsolar';
    $mail->AddAddress('riseoffreddy@gmail.com', 'Fred Code');
    $mail->WordWrap = 50;
    $mail->IsHTML(true);
    $mail->AddAttachment($file_name);
    $mail->Subject = 'Installation Report';
    $mail->Body = 'Please find installation report in the attached PDF File.';
    if($mail->Send()) {
        $message = '<label class="text-success ml-4">Mail sent successfully..</label>';
    }
    unlink($file_name);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mainland Solar | Your No 1 choice for Solar Installations & Support</title>
    <link rel="icon" type="image/png" class="img-fluid" href="../assets/images/navbrand-logo-min.png" sizes="16x16">
    <meta name="description" content="Your No 1 choice for Solar Installations & Support">
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
    <script src="jquery.min.js"></script>
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel="stylesheet" href="style.min.css" />
    <script src="bootstrap.min.js"></script>
</head>
<main>
    <div id="user-project-history-page">
        <div class="bg-white py-5">
            <div class="container auto-wrapper">
                <div style="display: flex;justify-content: center" class="mb-4"><img src="../assets/images/brand-logo.svg" alt=""></div>
                <?php echo fetch_installation_data($connect); ?>
<!--                <form method="post">-->
                <div id="user-action" class="no-print">
                    <button class="btn btn-white rounded-0" id="print-btn" onclick="printPage()">PRINT & SAVE</button>
                    <a class="btn btn-white rounded-0" href="add-maintenance-history/<?=$historyId;?>">ADD MAINTENANCE HISTORY</a>
                    <button class="btn btn-danger rounded-0" id="close-btn" onclick="goBack()">CLOSE</button>
                </div>
<!--                </form>-->
            </div>
        </div>
    </div>
</main>
</body>
</html>
<script>
    function printPage() {
        const footerTopWidget = document.querySelector(".no-print");
        footerTopWidget.style.display = 'none';
        window.print();
    }
    /* go back */
    function goBack() {
        window.history.back();
    }
</script>
