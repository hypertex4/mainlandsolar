<?php
include_once("inc/header.nav.php");
if (!isset($_SESSION['HOME_AUDIT']['checked_date']) || !isset($_SESSION['HOME_AUDIT']['picked_time']))
    echo "<script>window.location.replace('solar-audit')</script>";
?>
<main>
    <div id="solar-audit-page">
        <div id="schedule-audit-request">
            <div id="checkout">
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
                                <li class="active"><div class="ball"></div></li>
                            </ul>
                        </div>
                        <div class="row no-gutters">
                            <div class="col-12 col-md-7 col-lg-8">
                                <form name="audit-payment" id="audit-payment" class="m-1">
                                    <div id="response-alert"></div>
                                    <div class="card mb-2">
                                        <div class="card-header">PERSONAL DETAILS</div>
                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="form-group col-12 col-sm-6">
                                                    <label for="firstName">First Name</label>
                                                    <input id="firstName" type="text" class="form-control" name="first_name">
                                                </div>
                                                <div class="form-group col-12 col-sm-6">
                                                    <label for="lastName">Last Name</label>
                                                    <input id="lastName" type="text" class="form-control" name="last_name">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-12 col-sm-6">
                                                    <label for="phone">Phone Number</label>
                                                    <input id="phone" type="text" class="form-control" name="phone_no">
                                                </div>
                                                <div class="form-group col-12 col-sm-6">
                                                    <label for="email">Email Address</label>
                                                    <input id="email" type="text" class="form-control" name="email">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-12 col-sm-3">
                                                    <label for="streetLga">LGA</label>
                                                    <select name="streetLga" id="streetLga" class="form-control">
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
                                                    </select>
                                                </div>
                                                <div class="form-group col-12 col-sm-9">
                                                    <label for="streetAddress">Street Address</label>
                                                    <input id="streetAddress" type="text" class="form-control" name="street_address">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">PAYMENT METHOD</div>
                                        <div class="card-body p-0">
                                            <div class="px-3">
                                                <ul class="row list-style-none pl-0 mb-0">
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
                                                    <button class="btn btn-sm btn-success rounded-0">PLACE YOUR ORDER</button>
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
</main>
<?php include_once("inc/footer.nav.php"); ?>
<script src="https://js.paystack.co/v1/inline.js"></script>
