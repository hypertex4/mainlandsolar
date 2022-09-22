<?php include_once("../inc/header.nav.php"); ?>
<?php
echo "<script>
    var cart = JSON.parse(localStorage.getItem('shoppingCart'));
    if (typeof cart ==='undefined' || cart === null || cart.length === null || cart.length < 1 ) {
        window.location.replace('product/cart')
    }
    </script>";
$cid = isset($_SESSION['USER_LOGIN']['customer_id'])?$_SESSION['USER_LOGIN']['customer_id'] : 0;
include_once('../controllers/config/database.php');
include_once('../controllers/classes/Customer.class.php');
$db = new Database();
$user = new Customer($db->connect());
$address = $user->get_latest_shop_to_address($cid);
?>
<main>
    <div id="checkout-page">
        <div class="bg-white pb-5">
            <div class="container auto-wrapper">
                <ul class="breadcrumb">
                    <li><a href="./">Home</a></li>
                    <li><a href="./product/cart">Cart</a></li>
                    <li>Checkout</li>
                </ul>
                <div class="title-wrapper">
                    <hr class="my-0">
                    <h1 class="title mb-0">CHECKOUT</h1>
                    <hr class="my-0">
                </div>
                <form name="checkout" id="checkout">
                    <fieldset>
                        <legend>PERSONAL DETAILS</legend>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="firstname">First Name</label>
                                <input type="text" class="form-control" name="firstname" id="firstname"
                                       value="<?php
                                       if (isset($_SESSION['user_login_temp']['temp_fname'])) echo $_SESSION['user_login_temp']['temp_fname'];
                                       else if (isset($_SESSION['USER_LOGIN']['firstname'])) echo $_SESSION['USER_LOGIN']['firstname'];
                                       else echo "";
                                       ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lastname">Last Name</label>
                                <input type="text" class="form-control" name="lastname" id="lastname"
                                       value="<?php
                                       if (isset($_SESSION['user_login_temp']['temp_lname'])) echo $_SESSION['user_login_temp']['temp_lname'];
                                       else if (isset($_SESSION['USER_LOGIN']['lastname'])) echo $_SESSION['USER_LOGIN']['lastname'];
                                       else echo "";
                                       ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="phone">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                       value="<?php
                                        if (isset($_SESSION['user_login_temp']['temp_phone'])) echo $_SESSION['user_login_temp']['temp_phone'];
                                        else if (isset($_SESSION['USER_LOGIN']['mobile'])) echo $_SESSION['USER_LOGIN']['mobile'];
                                        else echo "";
                                        ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email"
                                       value="<?php
                                        if (isset($_SESSION['user_login_temp']['temp_email'])) echo $_SESSION['user_login_temp']['temp_email'];
                                        else if (isset($_SESSION['USER_LOGIN']['email'])) echo $_SESSION['USER_LOGIN']['email'];
                                        else echo "";
                                        ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="address">Street Address</label>
                                <input type="text" class="form-control" name="address" id="address"
                                       value="<?php
                                       if (isset($_SESSION['user_login_temp']['temp_add'])) echo $_SESSION['user_login_temp']['temp_add'];
                                       else if ($address !== false) echo $address['receiver_address'];
                                       else echo "";
                                       ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="state">State</label>
                                <select name="state" id="state" class="w-100">
                                    <option value="">-Select-</option>
                                    <option value="Abia" <?= ($address!==false && $address['receiver_state']=='Abia')?'selected':'';?>>Abia</option>
                                    <option value="Adamawa" <?= ($address!==false && $address['receiver_state']=='Adamawa')?'selected':'';?>>Adamawa</option>
                                    <option value="AkwaIbom" <?= ($address!==false && $address['receiver_state']=='AkwaIbom')?'selected':'';?>>AkwaIbom</option>
                                    <option value="Anambra" <?= ($address!==false && $address['receiver_state']=='Anambra')?'selected':'';?>>Anambra</option>
                                    <option value="Bauchi" <?= ($address!==false && $address['receiver_state']=='Bauchi')?'selected':'';?>>Bauchi</option>
                                    <option value="Bayelsa" <?= ($address!==false && $address['receiver_state']=='Bayelsa')?'selected':'';?>>Bayelsa</option>
                                    <option value="Cross River" <?= ($address!==false && $address['receiver_state']=='Cross River')?'selected':'';?>>Cross River</option>
                                    <option value="Delta" <?= ($address!==false && $address['receiver_state']=='Delta')?'selected':'';?>>Delta</option>
                                    <option value="Ebonyi" <?= ($address!==false && $address['receiver_state']=='Ebonyi')?'selected':'';?>>Ebonyi</option>
                                    <option value="Edo" <?= ($address!==false && $address['receiver_state']=='Edo')?'selected':'';?>>Edo</option>
                                    <option value="Ekiti" <?= ($address!==false && $address['receiver_state']=='Ekiti')?'selected':'';?>>Ekiti</option>
                                    <option value="Enugu" <?= ($address!==false && $address['receiver_state']=='Enugu')?'selected':'';?>>Enugu</option>
                                    <option value="FCT" <?= ($address!==false && $address['receiver_state']=='FCT')?'selected':'';?>>FCT</option>
                                    <option value="Imo" <?= ($address!==false && $address['receiver_state']=='Imo')?'selected':'';?>>Imo</option>
                                    <option value="Jigawa" <?= ($address!==false && $address['receiver_state']=='Jigawa')?'selected':'';?>>Jigawa</option>
                                    <option value="Kaduna" <?= ($address!==false && $address['receiver_state']=='Kaduna')?'selected':'';?>>Kaduna</option>
                                    <option value="Kano" <?= ($address!==false && $address['receiver_state']=='Kano')?'selected':'';?>>Kano</option>
                                    <option value="Katsina" <?= ($address!==false && $address['receiver_state']=='Katsina')?'selected':'';?>>Katsina</option>
                                    <option value="Kogi" <?= ($address!==false && $address['receiver_state']=='Kogi')?'selected':'';?>>Kogi</option>
                                    <option value="Kwara" <?= ($address!==false && $address['receiver_state']=='Kwara')?'selected':'';?>>Kwara</option>
                                    <option value="Lagos" <?= ($address!==false && $address['receiver_state']=='Lagos')?'selected':'';?>>Lagos</option>
                                    <option value="Nasarawa" <?= ($address!==false && $address['receiver_state']=='Nasarawa')?'selected':'';?>>Nasarawa</option>
                                    <option value="Niger" <?= ($address!==false && $address['receiver_state']=='Niger')?'selected':'';?>>Niger</option>
                                    <option value="Ogun" <?= ($address!==false && $address['receiver_state']=='Ogun')?'selected':'';?>>Ogun</option>
                                    <option value="Ondo" <?= ($address!==false && $address['receiver_state']=='Ondo')?'selected':'';?>>Ondo</option>
                                    <option value="Osun" <?= ($address!==false && $address['receiver_state']=='Osun')?'selected':'';?>>Osun</option>
                                    <option value="Oyo" <?= ($address!==false && $address['receiver_state']=='Oyo')?'selected':'';?>>Oyo</option>
                                    <option value="Rivers" <?= ($address!==false && $address['receiver_state']=='Rivers')?'selected':'';?>>Rivers</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <input type="hidden" name="total_amount" id="total_amount">
                    <input type="hidden" name="order_shipping" id="order_shipping">
                    <input type="hidden" name="total_qty" id="total_qty">
                    <input type="hidden" name="s_email" id="s_email" value="<?= isset($_SESSION['USER_LOGIN']['email'])?$_SESSION['USER_LOGIN']['email']:""; ?>">
                    <input type="hidden" name="payment_ref" id="payment_ref">
                    <fieldset>
                        <legend>YOUR ORDER</legend>
                        <table class="table table-bordered" id="order-table">
                            <thead>
                            <tr>
                                <th scope="col" class="name-header">Product name</th>
                                <th scope="col" class="total-header">Total</th>
                            </tr>
                            </thead>
                            <tbody class="show_checkout_data"></tbody>
                        </table>
                        <table class="table table-bordered" style="border-top: 0" id="order-table">
                            <tr><th scope="row" style="width: 50%">Subtotal</th><td>₦&nbsp;<span class="sub-total-cart"></span></td></tr>
                            <tr><th scope="row" class="">Shipping fee</th><td>₦&nbsp;<span class="total-shipping"></span></td></tr>
                            <tr><th scope="row">VAT</th><td>₦&nbsp;<span class="VAT"></span><small class="italic"> (inclusive)</small> </td></tr>
                            <tr><th scope="row">TOTAL</th><td>₦&nbsp;<span class="total-cart"></span></td></tr>
                        </table>
                        <table class="table table-bordered" id="order-table">
                            <thead>
                            <tr>
                                <th scope="col" class="name-header">PAYMENT METHOD</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">
                                    <ul class="list-style-none d-flex px-0 mb-0">
                                        <li class="custom-check-wrapper mb-3">
                                            <input type="radio" name="payment_method" id="bank_transfer" value="BankTransfer" class="check_rej">
                                            <label for="bank_transfer">Bank Transfer<span class="fake-radio custom_checkbox"></span></label>
                                        </li>
                                        <li class="custom-check-wrapper">
                                            <input type="radio" name="payment_method" id="third_party" value="DebitCard" checked class="check_rej">
                                            <label for="third_party">Card Payment (Paystack)<span class="fake-radio custom_checkbox"></span></label>
                                        </li>
                                    </ul>
                                </th>

                            </tr>
                            <tr>
                                <th scope="row">
                                    <button type="submit" class="btn btn-white rounded-0 bold" id="checkout_btn">PLACE YOUR ORDER</button>
                                </th>
                            </tr>
                            </tbody>
                        </table>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="payWithTransfer" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="staticBackdropLabel">Enter sender account name(If transfer has been made)</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="bg-white shadow p-3">
                    <ul style="list-style: none">
                        <li><p>Bank Account Name:<br /><span><b>TEP/POSTMAIL EXPRESS GTPAY REVENUE</b></span></p></li>
                        <li><p>Bank Account Number:<br /><span><b>0465918189</b></span></p></li>
                        <li><p>Bank Name:<br /><span><b>GT Bank</b></span></p></li>
                    </ul>
                </div>
                <form name="transfer_request_form" id="pay_with_transfer">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="account_name" class="col-form-label">Sender Account Name:</label>
                            <input type="text" class="form-control" id="account_name" name="account_name">
                        </div>
                        <div class="form-group">
                            <label for="amount_transferred" class="col-form-label">Amount Transferred (₦)</label>
                            <input readonly type="text" class="form-control" id="amount_transferred" name="amount_transferred" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-white rounded-0 bold" id="pay_transfer_btn">
                            SUBMIT
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</main>
<?php include_once("../inc/footer.nav.php"); ?>
<script src="https://js.paystack.co/v1/inline.js"></script>
