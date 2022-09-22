<?php include_once("inc/header.nav.php"); ?>
<?php
include_once('controllers/config/database.php');
include_once('controllers/classes/Customer.class.php');
$db = new Database();
$connection = $db->connect();
$user = new Customer($connection);
if (isset($_POST['inst-id']) && !empty($user->fetch_project_installation_history($_POST['inst-id']))){
    $ist_his = $user->fetch_project_installation_history($_POST['inst-id']);
?>
<div id="user-project-history-page">
    <div class="bg-white py-5">
        <div class="container auto-wrapper">
            <h1 class="request-id">Installation ID: <span><?=$_POST['inst-id'];?></span></h1>
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
                            <div class="label">Name of installation:</div><div class="value"><?= $ist_his['name_of_ins'];?></div>
                        </div>
                    </td>
                    <td>
                        <div class="inner">
                            <div class="label">Size of installation:</div><div class="value"><?= $ist_his['size_of_ins'];?></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td scope="row">
                        <div class="inner">
                            <div class="label">System components</div><div class="value"><?= $ist_his['sys_comps'];?></div>
                        </div>
                    </td>
                    <td>
                        <div class="inner">
                            <div class="label">Date of completion of installation</div>
                            <div class="value"><?= date("d-M-Y",strtotime($ist_his['date_of_com']));?></div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <!-- item 1 -->
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
                            <p><?= $ist_his['issues_raised'];?></p>
                        </div>
                    </td>
                </tr>
                <tr class="border-bottom">
                    <th scope="row">
                        <div class="inner">o Date of issue report:</div>
                    </th>
                    <td>
                        <div class="inner"><?= date("d-M-Y",strtotime($ist_his['date_issued']));?></div>
                    </td>
                </tr>
                <tr class="border-bottom">
                    <th scope="row">
                        <div class="inner">o Troubleshooting and action performed for resolution:</div>
                    </th>
                    <td>
                        <div class="inner">
                            <p><?= $ist_his['trob_action'];?></p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <div class="inner">o Date resolved:</div>
                    </th>
                    <td>
                        <div class="inner"><?= date("d-M-Y",strtotime($ist_his['resolved_date']));?></div>
                    </td>
                </tr>
                </tbody>
            </table>
            <?php
                $main_res = $user->fetch_project_maintenance_history($_POST['inst-id']);
                if ($main_res->num_rows > 0) {
                    while ($main = $main_res->fetch_assoc()){
            ?>
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
                    <th scope="row"><div class="inner">o Issues raised:</div></th>
                    <td><div class="inner"><p><?=$main['issues_raised'];?></p></div></td>
                </tr>
                <tr class="border-bottom">
                    <th scope="row"><div class="inner">o Date of issue report:</div></th>
                    <td><div class="inner"><?=date("d-M-Y",strtotime($main['date_issued']));?></div></td>
                </tr>
                <tr class="border-bottom">
                    <th scope="row"><div class="inner">o Troubleshooting and action performed for resolution:</div></th>
                    <td><div class="inner"><p><?=$main['trob_action'];?></p></div></td>
                </tr>
                <tr>
                    <th scope="row"><div class="inner">o Date resolved:</div></th>
                    <td><div class="inner"><?=date("d-M-Y",strtotime($main['resolved_date']));?></div></td>
                </tr>
                </tbody>
            </table>
            <?php } } ?>
            <div id="user-action">
                <button class="btn btn-white rounded-0" id="print-btn" onclick="printPage()">PRINT</button>
                <button class="btn btn-danger rounded-0" id="close-btn" onclick="goBack()">CLOSE</button>
            </div>
        </div>
    </div>
</div>
<?php } else { ?>
    <div id="page-not-found-page">
        <div class="bg-white h-100">
            <div class="">
                <div class="content text-center">
                    <div>
                        <p class="status bold">404</p>
                        <h1 class="title">Page Not Found</h1>
                        <p><a href="./history" class="dark-link">Back to request page</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php include_once("inc/footer.nav.php"); ?>