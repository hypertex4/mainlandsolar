<?php session_start();
include_once("component/header.php");
if (!isset($_SESSION['HOME_AUDIT']['checked_date']) || !isset($_SESSION['HOME_AUDIT']['picked_time']))
    echo "<script>window.location.replace('./')</script>";
?>
<?php
print_r($_SESSION);
?>
<div id="solar-audit-page">
    <div id="schedule-audit-request">
        <div id="checkout">
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
                            <li class="active"><div class="ball"></div></li>
                        </ul>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-12 col-md-7 col-lg-8">
                            <form name="audit-payment" id="audit-payment" class="m-1">
                                <div id="response-alert"></div>
                                <div class="card mb-2">
                                    <div class="card-header">BOOKING DETAILS</div>
                                    <div class="card-body">
                                        <div class="form-row">
                                            <div class="form-group col-12 col-sm-6">
                                                <label for="client_name">Client Name or Organisation and contact person</label>
                                                <input id="client_name" type="text" class="form-control" name="client_name">
                                            </div>
                                            <div class="form-group col-12 col-sm-6">
                                                <label for="phone">Client Phone or WhatsApp Number</label>
                                                <input id="phone" type="text" class="form-control" name="phone_no" maxlength="11">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-12 col-sm-8">
                                                <label for="email">Client Email Address</label>
                                                <input id="email" type="text" class="form-control" name="email">
                                            </div>
                                            <div class="form-group col-12 col-sm-4">
                                                <label for="survey_loc">Survey location</label>
                                                <select name="survey_loc" id="survey_loc" class="form-control">
                                                    <option value=""></option>
                                                    <option value="Agege">Agege</option>
                                                    <option value="Ajeromi-Ifelodun">Ajeromi-Ifelodun</option>
                                                    <option value="Alimosho">Alimosho</option>
                                                    <option value="Amuwo-Odofin">Amuwo-Odofin</option>
                                                    <option value="Apapa">Apapa</option>
                                                    <option value="Badagry">Badagry</option>
                                                    <option value="Epe">Epe</option>
                                                    <option value="Eti Osa">Eti Osa</option>
                                                    <option value="Ibeju-Lekki">Ibeju-Lekki</option>
                                                    <option value="Ifako-Ijaiye">Ifako-Ijaiye</option>
                                                    <option value="Ikeja">Ikeja</option>
                                                    <option value="Ikorodu">Ikorodu</option>
                                                    <option value="Kosofe">Kosofe</option>
                                                    <option value="Lagos Island">Lagos Island</option>
                                                    <option value="Lagos Mainland">Lagos Mainland</option>
                                                    <option value="Mushin">Mushin</option>
                                                    <option value="Ojo">Ojo</option>
                                                    <option value="Oshodi-Isolo">Oshodi-Isolo</option>
                                                    <option value="Shomolu">Shomolu</option>
                                                    <option value="Surulere">Surulere</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-12 col-sm-8">
                                                <label for="survey_add">Survey Address</label>
                                                <input id="survey_add" type="text" class="form-control" name="survey_add">
                                            </div>
                                            <div class="form-group col-12 col-sm-4 other_survey_loc">
                                                <label for="sur_other_loc">Specify Survey Location</label>
                                                <input id="sur_other_loc" type="text" class="form-control" name="sur_other_loc">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-12 col-sm-6">
                                                <label for="pry_purpose">Primary Purpose for Solar</label>
                                                <select name="pry_purpose" id="pry_purpose" class="form-control">
                                                    <option value=""></option>
                                                    <option value="Stop Gap btw NEPA and Gen(Usually less than 1hr)">Stop Gap btw NEPA and Gen(Usually less than 1hr)</option>
                                                    <option value="Back Up to NEPA (1 hour - 6 hours)">Back Up to NEPA (1 hour - 6 hours)</option>
                                                    <option value="Primary means of Electricity (6 - 24 hrs per day)">Primary means of Electricity (6 - 24 hrs per day)</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-12 col-sm-6">
                                                <label for="solar_coverage">Level of Solar Coverage</label>
                                                <select name="solar_coverage" id="solar_coverage" class="form-control">
                                                    <option value=""></option>
                                                    <option value="Stop Gap btw NEPA and Gen(Usually less than 1hr)">Stop Gap btw NEPA and Gen(Usually less than 1hr)</option>
                                                    <option value="Back Up to NEPA (1 hour - 6 hours)">Back Up to NEPA (1 hour - 6 hours)</option>
                                                    <option value="Primary means of Electricity (6 - 24 hrs per day)">Primary means of Electricity (6 - 24 hrs per day)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-12 col-sm-6">
                                                <label for="panel_space">Space for Panels</label>
                                                <select name="panel_space" id="panel_space" class="form-control">
                                                    <option value=""></option>
                                                    <option value="Roof">Roof</option>
                                                    <option value="Garage/Car Park">Garage/Car Park</option>
                                                    <option value="Ground">Ground</option>
                                                    <option value="None">None</option>
                                                    <option value="Not Sure">Not Sure</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-12 col-sm-6">
                                                <label for="other_info">Any Other Information</label>
                                                <textarea class="form-control" name="other_info" id="other_info" cols="4"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">PAYMENT METHOD</div>
                                    <div class="card-body p-0">
                                        <div class="px-3">
                                            <ul class="row list-style-none pl-0 mb-2">
                                                <li class="col-12 col-md-5">
                                                    <input type="hidden" name="payment_ref" id="payment_ref">
                                                    <input checked class="radio form-control" type="radio" name="payment_method" id="bankTransfer" value="bankTransfer">
                                                    <label for="bankTransfer"><span>Bank Transfer</span><span class="ui-radio"></span></label>
                                                </li>
                                                <li class="col-12 col-md-5">
                                                    <input class="radio form-control" type="radio" name="payment_method" id="paystack" value="Paystack">
                                                    <label for="paystack"><span>Paystack</span><span class="ui-radio"></span></label>
                                                </li>
                                            </ul>
                                        </div>
                                        <div id="bank-account-details" class="px-3">
                                            <table class="table table-borderless mb-0">
                                                <tbody>
                                                <tr>
                                                    <th scope="row" class="label">Bank Account Name:</th>
                                                    <td class="bank-name">TEP/POSTMAIL EXPRESS GTPAY REVENUE</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="label">Bank Account No:</th>
                                                    <td class="account-number">0465918189</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="label">Bank Name:</th>
                                                    <td class="bank-name">GT Bank</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="p-3 border-top">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <a href="audit-time" class="btn btn-sm btn-white rounded-0">GO BACK</a>
                                                <button class="btn btn-sm btn-success rounded-0">PLACE BOOKING</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-12 col-md-5 col-lg-4">
                            <div class="card border-0 m-1">
                                <div class="card-header">BOOKING SUMMARY</div>
                                <div class="card-body p-0">
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <th scope="row">Selected Date</th>
                                            <td><?=date("d, F, Y", strtotime($_SESSION['HOME_AUDIT']['checked_date']));?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Selected Time</th>
                                            <td><?=$_SESSION['HOME_AUDIT']['picked_time'];?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Price</th>
                                            <td>₦ 15,000</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="payWithTransferAudit" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="staticBackdropLabel">Enter sender account name (If transfer has been made)</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="bg-white shadow p-3">
                    <ul class="pl-0" style="list-style: none">
                        <li><p>Bank Account Name: <br><span><b>TEP/POSTMAIL EXPRESS GTPAY REVENUE</b></span></p></li>
                        <li><p>Bank Account Number: <span><b>0465918189</b></span></p></li>
                        <li><p>Bank Name: <span><b>GT Bank</b></span></p></li>
                    </ul>
                </div>
                <form name="transfer_request_audit_form" id="transfer_request_audit_form">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="aud_account_name" class="col-form-label">Sender Account Name:</label>
                            <input type="text" class="form-control" id="aud_account_name" name="aud_account_name">
                        </div>
                        <div class="form-group">
                            <label for="aud_amt_transferred" class="col-form-label">Amount Transferred (₦)</label>
                            <input readonly type="text" value="15000" class="form-control" id="aud_amt_transferred" name="aud_amt_transferred" />
                        </div>
                    </div>
                    <div class="modal-footer" style="display: flex; justify-content: space-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-white rounded-0 bold">SUBMIT</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php include_once("component/footer.php"); ?>
<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
    jQuery(".other_survey_loc").hide();
    jQuery("#survey_loc").on("change", function () {
        if (jQuery(this).val() === 'Others') {
            jQuery(".other_survey_loc").show();
        } else {
            jQuery(".other_survey_loc").hide();
        }
    });
</script>
