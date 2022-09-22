<?php
include_once("../inc/header.main.php");
if (!isset($_SESSION['USER_LOGIN']) && !isset($_SESSION['USER_LOGIN']['customer_id'])) header('Location: ../../index');
include_once('../controllers/config/database.php');
include_once('../controllers/classes/Customer.class.php');

$db = new Database();
$connection = $db->connect();
$user = new Customer($connection);
?>
</div>
    <div class="container my-md-5 w-100 user_account user_order_page" id="user_order_page">
        <div class="row no-gutters">
            <div class="col-3"><?php include_once 'account-sidebar.php'; ?></div>
            <div class="col-12 col-md-9">
                <main class="main_area">
                    <div class="px-3 mb-5">
                    <?php
                    $url = CONTROLLER_ROOT_URL."/v5/read-order-details-by-id.php?order_id=".$_GET['order_id'];
                    $object = $api->curlQueryGet($url);
                    if($object->status !=200 )  {echo "<div class='col-12 col-md-6'>Order no found</div>";}
                    else {
                        foreach ($object->order as $item) {
                    ?>
                        <div class="d-flex align-items-center border-bottom">
                            <button class="btn p-0 my-3" id="userAccountMenuBtn"><span data-feather="arrow-left"></span></button>
                            <h5>Order Details</h5>
                        </div>
                        <div class="border-bottom py-3">
                            <ul class="list_style_0 my-0">
                                <li style="color: #91808D"><span><?= $item->order_qty; ?></span>&nbsp;<span>Items</span></li>
                                <li style="color: #91808D"><span>Placed on&nbsp;<?= date('j F,Y', strtotime($item->order_on)); ?></span></li>
                                <li style="color: #91808D"><span>Total:&nbsp;</span>₦<?= number_format($item->order_amount,0); ?></li>
                            </ul>
                        </div>
                        <div class="py-3">
                            <h5>ITEMS IN YOUR ORDER</h5>
                            <div class="border">
                                <div class="p-2 border-bottom">
                                    Status : <?= ($item->order_status==='Delivered') ?
                                        "<span class='text-success'>Delivered</span>":
                                        "<span class='text-muted'>".$item->order_status."</span>"; ?>
                                </div>
                                <?php } } ?>
                                <div class="container p-0">
                                <?php
                                $url = CONTROLLER_ROOT_URL."/v5/read-order-by-product-id.php?order_id=".$_GET['order_id'];
                                $object = $api->curlQueryGet($url);
                                if($object->status !=200 )  {echo "<div class='col-12 col-md-6'>Product no found</div>";
                                } else {
                                    foreach ($object->products as $product) {
                                ?>
                                    <div class="row py-2 border m-2">
                                        <div class="col-4 col-md-2 p-0 m-0">
                                            <img src="<?="sellers/". $product->pro_image1; ?>" alt="" class="img-fluid">
                                        </div>
                                        <div class="col-8 col-md-4 p-0 m-0"><h6 class="m-0"><?= $product->pro_title; ?></h6></div>
                                        <div class="col-4 col-md-1 text-center p-0 m-0">
                                            <dl><dt>Qty</dt><dd><?= $product->product_qty; ?></dd></dl>
                                        </div>
                                        <div class="col-4 col-md-2 text-center p-0 m-0">
                                            <dl><dt>Price</dt><dd>₦&nbsp;<?= $product->pro_price; ?></dd></dl>
                                        </div>
                                        <div class="col-4 col-md-1 text-center p-0 m-0">
                                            <dl><dt>Status</dt><dd class="text-muted"><?= $product->vendor_del_status; ?></dd></dl>
                                        </div>
                                        <div class="col-12 col-md-2 text-center m-0">
                                        <?php if ($user->check_returned_order_item($product->order_details_id)) { ?>
                                            <button data-odi="<?= $product->order_details_id; ?>" class="btn btn-block btn_primary btn-sm trigger_page_modal resolveBtn">
                                                RETURN
                                            </button>
                                        <?php } ?>
                                        </div>
                                    </div>
                                    <?php } } ?>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid px-0">
                            <div class="row">
                            <?php
                            $url = CONTROLLER_ROOT_URL."/v5/read-order-payment-details.php?order_id=".$_GET['order_id'];
                            $object = $api->curlQueryGet($url);
                            if($object->status !=200)  {
                                echo "<div class='col-12 col-md-6 p-0'>Payment no found</div>";} else {
                                foreach ($object->order_payment as $pay_item) {
                            ?>
                                <div class="col-12 col-md-6">
                                    <div class="card h-100 my-2 rounded-0">
                                        <div class="card-body">
                                            <h5 class="card-title">PAYMENT INFORMATION</h5>
                                            <dl>
                                                <dt>Payment Status: </dt><dd class="text-success">
                                                    <?= ($pay_item->payment_status=="Unverified")?
                                                        "<span class='text-danger'>Pending Confirmation</span>":"Confirmed"; ?>
                                                </dd>
                                                </dt>
                                                <dt>Payment Method</dt>
                                                <dd style="color: #91808D"><?= ($pay_item->payment_option=="DebitCard")? "Third-Party Payment Interface":"Bank Transfer"; ?></dd>
                                                <dt>Payment Details</dt>
                                                <dd style="color: #91808D">Items total: ₦ <?= number_format(($pay_item->payment_amount-$pay_item->order_ship_fee),0); ?></dd>
                                            </dl>
                                            <p style="color: #91808D">Shipping Fees: ₦ <?= number_format($pay_item->order_ship_fee,0); ?></p>
                                            <p>Total: ₦ <?= number_format($pay_item->payment_amount,0); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="card h-100 my-2 rounded-0">
                                        <div class="card-body">
                                            <h5 class="card-title">DELIVERY INFORMATION</h5>
                                            <dl>
                                                <dt>Delivery Method</dt>
                                                <dd style="color: #91808D"><?= $pay_item->shipping_type; ?></dd>
                                                <dt>Shipping Address</dt>
                                                <dd style="color: #91808D"><?= $pay_item->receiver_full_add; ?> Nigeria.</dd>
                                            </dl>
                                            <p style="color: #91808D"><?=$pay_item->receiver_fullname;?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php } } ?>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
    <div class="overlay hide"></div>
    <div class="user_order_page modal_form hide">
        <div class="inner" id="responseBox">
            <div class="card border-0 mb-5">
                <div class="card-header bg-light text-dark">
                    <h5 >REPORT</h5>
                    <button class="btn btn-sm p-0 m-0 cancel_modal_close_btn text-dark">
                        <span class="icon feather-icon" data-feather="x-circle"></span>
                    </button>
                </div>
                <div class="px-4 py-2" style="background:#0496FF;color:#ffffff">
                    Let us know the problem you what the problem is, including the product name, order details
                </div>
                <div class="card-body">
                    <form name="statusForm" id="statusForm">
                        <input type="hidden" name="order_detail_id" id="order_detail_id" value="">
                        <div>
                            <textarea name="order_comment" id="order_comment" rows="9" style="width:100%;resize:none;"></textarea>
                        </div>
                        <button class="btn btn_primary px-3" id="refundBtn" style="border-radius:0">REFUND</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include_once("../inc/footer.main.php"); ?>
<script>
    $(".user_order_page").on("click",".resolveBtn",function (e) {
        e.preventDefault();
        var odi = $(this).data('odi');
        $("#order_detail_id").val(odi);
    });

    $("form[name='statusForm']").validate({
        rules: { order_comment: { "required":true, minlength:3} },
        message: {  },
        submitHandler: function (form, e) {
            e.preventDefault();
            var statusForm = $('#statusForm');

            $("#refundBtn").attr("disabled", true); $('#refundBtn').css("cursor", 'not-allowed');
            $("#refundBtn").html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                url: "account/return-action.php",
                type: "POST",
                data: statusForm.serialize(),
                success: function (data) {
                    toastr["success"](data.message);
                    $("#responseBox").html('' +
                        '<div class="card border-0">\n' +
                        '<div class="card-body text-center">\n' +
                        '<div class="w-50 m-auto"><img src="images/iconmonstr-check-mark.png" alt="iconmonstr-check-mark" class="img img-fluid"></div>\n' +
                        '<h5 class="text_link2 pt-3" style="color:#BCAE00">SENT</h5>\n' +
                        '<p class="text-muted">Your report will be attended to</p>\n' +
                        '<p class="pt-4 font-weight-bold"><a class="cancel_modal_close_btn" style="color:#BCAE00" href="javascript:void(0)">GO BACK</a></p>\n' +
                        '</div>\n' +
                        '</div>');
                },
                error: function (errData) {
                    toastr["error"](errData.responseJSON.message);
                },
                complete: function () {
                    $('#refundBtn').attr("disabled", false); $('#refundBtn').css("cursor", 'pointer');
                    $("#refundBtn").html('REFUND');
                }
            });
        }
    });
</script>
