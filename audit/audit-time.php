<?php
session_start();
include_once("component/header.php");
include_once('database.php');
include_once('Audit.class.php');
$db = new Database();
$connection = $db->connect();
$audit = new Audit($connection);
?>
<main>
    <div id="solar-audit-page">
        <div id="pick-a-time">
            <div class="bg-white">
                <div class="container">
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
                                <label for="" class="text-dark">Select Time for Audit</label>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">Available time</th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (empty($audit->get_audit_booking_time($_SESSION['HOME_AUDIT']['checked_date'],'9:00am - 11:00am'))) { ?>
                                    <tr>
                                        <td><label class="cursor-pointer" for="9am">9:00am - 11:00am</label></td>
                                        <td>
                                            <input type="radio" name="time" id="9am" value="9:00am - 11:00am" class="radio">
                                            <label for="9am"><span class="ui-radio"></span></label>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <?php if (empty($audit->get_audit_booking_time($_SESSION['HOME_AUDIT']['checked_date'],'11:00am - 1:00pm'))) {?>
                                    <tr>
                                        <td><label class="cursor-pointer" for="11am">11:00pm - 1:00pm</label></td>
                                        <td>
                                            <input type="radio" name="time" id="11am" value="11:00am - 1:00pm" class="radio">
                                            <label for="12pm"><span class="ui-radio"></span></label>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <?php if (empty($audit->get_audit_booking_time($_SESSION['HOME_AUDIT']['checked_date'],'1:00pm - 3:00pm'))) {?>
                                    <tr>
                                        <td><label class="cursor-pointer" for="1pm">1:00pm - 3:00pm</label></td>
                                        <td>
                                            <input type="radio" name="time" id="1pm" value="1:00pm - 3:00pm" class="radio">
                                            <label for="1pm"><span class="ui-radio"></span></label>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <?php if (empty($audit->get_audit_booking_time($_SESSION['HOME_AUDIT']['checked_date'],'3:00pm - 5:00pm'))) {?>
                                    <tr>
                                        <td><label class="cursor-pointer" for="3pm">3:00pm - 5:00pm</label></td>
                                        <td>
                                            <input type="radio" name="time" id="3pm" value="3:00pm - 5:00pm" class="radio">
                                            <label for="1pm"><span class="ui-radio"></span></label>
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
                                                <a href="./" class="btn btn-sm">GO BACK</a>
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
<?php include_once("component/footer.php"); ?>