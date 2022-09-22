<?php
include_once("inc/header.nav.php");
include_once('controllers/config/database.php');
include_once('controllers/classes/Audit.class.php');
$db = new Database();
$connection = $db->connect();
$audit = new Audit($connection);
?>
<link rel="stylesheet" href="./assets/css/heroVideo.min.css" />
<main>
    <div id="solar-audit-page">
        <div id="pick-a-time">
            <div class="bg-white">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="./">Home</a></li>
                        <li>Schedule a Audit Request</li>
                    </ul>
                    <div class="title-wrapper">
                        <hr class="my-0">
                        <h1 class="title mb-0">SCHEDULE A AUDIT REQUEST</h1>
                        <hr class="my-0">
                    </div>
                    <div class="audit-progress-bar">
                        <ul class="list-style-none pl-0 labels">
                            <li>SELECT A DATE </li>
                            <li>PICK A TIME </li>
                            <li>CHECKOUT </li>
                        </ul>
                        <ul class="list-style-none pl-0 indicators">
                            <li class="active"><div class="ball"></div></li>
                            <li class="active"><div class="ball"></div></li>
                            <li><div class="ball"></div></li>
                        </ul>
                    </div>
                    <div id="time-select">
                        <div class="inner">
                            <form name="audit_time_form" id="audit_time_form">
                                <div id="response-alert" class="mb-3"></div>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">Available time</th>
                                        <th scope="col">Last</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (empty($audit->get_audit_booking_time($_SESSION['HOME_AUDIT']['checked_date'],'9:00am - 11:00am'))) {?>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td><label class="cursor-pointer" for="9am">9:00am - 11:00am</label></td>
                                        <td>
                                            <input type="radio" name="time" id="9am" value="9:00am - 11:00am" class="radio">
                                            <label for="9am"><span class="ui-radio"></span></label>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <?php if (empty($audit->get_audit_booking_time($_SESSION['HOME_AUDIT']['checked_date'],'12:00pm - 2:00pm'))) {?>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td><label class="cursor-pointer" for="12pm">12:00pm - 2:00pm</label></td>
                                        <td>
                                            <input type="radio" name="time" id="12pm" value="12:00pm - 2:00pm" class="radio">
                                            <label for="12pm"><span class="ui-radio"></span></label>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <?php if (empty($audit->get_audit_booking_time($_SESSION['HOME_AUDIT']['checked_date'],'3:00pm - 5:00pm'))) {?>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td><label class="cursor-pointer" for="3pm">3:00pm - 5:00pm</label></td>
                                        <td>
                                            <input type="radio" name="time" id="3pm" value="3:00pm - 5:00pm" class="radio">
                                            <label for="3pm"><span class="ui-radio"></span></label>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <?php
                                    $resp = $audit->get_audit_booking_all($_SESSION['HOME_AUDIT']['checked_date']);
                                    if ($resp->num_rows >= 3) {
                                    ?>
                                    <tr>
                                        <td colspan="3"><label>No available time for selected date</label></td>
                                    </tr>
                                    <?php } else { ?>
                                    <tr>
                                        <td colspan="3">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <a href="solar-audit" class="btn btn-sm">GO BACK</a>
                                                <button type="submit" class="btn btn-sm">CONTINUE</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include_once("inc/footer.nav.php"); ?>