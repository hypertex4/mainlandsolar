<?php
include_once("../inc/header.nav.php");
if (!isset($_SESSION['USER_LOGIN']) && !isset($_SESSION['USER_LOGIN']['customer_id'])) header('Location: ../../index');
include_once('../controllers/config/database.php');
include_once('../controllers/classes/Customer.class.php');

$db = new Database();
$connection = $db->connect();
$user = new Customer($connection);
?>
<div id="user-profile-page">
    <div class="bg-white pb-5">
        <div class="container auto-wrapper">
            <ul class="breadcrumb">
                <li><a href="./">Home</a></li>
                <li><a href="account/">My Account</a></li>
                <li>Profile</li>
            </ul>
            <div class="title-wrapper">
                <hr class="my-0">
                <h1 class="title mb-0">MY ACCOUNT</h1>
                <hr class="my-0">
            </div>
            <div class="my-3">
                <button class="btn p-0" id="sidebar-toggler"><i class="fas fa-bars"></i></button>
            </div>
            <h6 class="user-greet">HELLO <?=$_SESSION['USER_LOGIN']['firstname']." ".$_SESSION['USER_LOGIN']['lastname'];?></h6>
            <div id="user-content-wrapper">
                <div class="sidenav-wrapper">
                    <?php include_once('account-sidenav.php'); ?>
                </div>
                <div class="main-content" id="user-purchase-details-content">
                    <div class="inner">
                        <div class="title px-3 py-2 bold">
                            <button class="px-0 btn mr-3"><i class="fas fa-arrow-left"></i></button>
                            Order Details
                        </div>
                        <div class="order-summary p-3">
                        <?php
                        $url = CONTROLLER_ROOT_URL."/v6/read-purchase-details-by-id.php?purchase_id=".$_GET['purchase_id'];
                        $object = $api->curlQueryGet($url);
                        if($object->status !=200 )  { echo "<div class='col-12 col-md-6'>Purchase history details not found</div>"; }
                        else {
                            foreach ($object->order as $item) {
                        ?>
                            <ul class="px-0 mb-0 list-style-none">
                                <li><?= $item->order_qty; ?> Item(s)</li>
                                <li>Placed on <?= date('j F,Y', strtotime($item->order_on)); ?></li>
                                <li>Total: ₦<?= number_format($item->order_amount,0); ?></li>
                            </ul>
                        </div>
                        <hr class="horizontal-separator" />
                        <section class="p-3" id="order-items">
                            <h6>ITEMS IN YOUR ORDER</h6>
                            <div class="status p-3">STATUS:&nbsp;&nbsp;<?= ($item->order_status==='Delivered') ?
                                    "<span class='text-success'>Delivered</span>":
                                    "<span class='text-muted'>".$item->order_status."</span>"; ?></div>
                            <?php } } ?>
                            <ul class="px-0 mb-0 list-style-none item-list">
                            <?php
                            $url = CONTROLLER_ROOT_URL."/v6/read-purchase-by-product-id.php?purchase_id=".$_GET['purchase_id'];
                            $object = $api->curlQueryGet($url);
                            if($object->status !=200 )  {echo "<div class='col-12 col-md-6'>Product no found</div>";
                            } else {
                                foreach ($object->products as $product) {
                            ?>
                                <li class="item">
                                    <div class="item-details row p-3">
                                        <div class="img-wrapper col-4 col-md-2">
                                            <img src="admin/<?= $product->pro_image1; ?>" alt="" class="img-fluid">
                                        </div>
                                        <div class="name col-8 col-md-6"><?= $product->pro_title; ?></div>
                                        <div class="qty col-4 col-md-2 text-center">
                                            <div class="label">Quantity</div><div><?= $product->product_qty; ?></div>
                                        </div>
                                        <div class="price col-8 col-md-2 text-center">
                                            <div class="label">Price</div><div>₦<?= number_format($product->pro_price,0); ?></div>
                                        </div>
                                    </div>
                                </li>
                            <?php } } ?>
                            </ul>
                        </section>
                        <section class="p-3" id="payment-delivery-info">
                            <?php
                            $url = CONTROLLER_ROOT_URL."/v6/read-purchase-payment-details.php?purchase_id=".$_GET['purchase_id'];
                            $object = $api->curlQueryGet($url);
                            if($object->status !=200)  {
                            echo "<div class='col-12 col-md-6 p-0'>Payment no found</div>";} else {
                            foreach ($object->order_payment as $pay_item) {
                            ?>
                            <div class="row">
                                <div id="payment-info" class="col-12 col-md-6">
                                    <div class="inner">
                                        <h6>PAYMENT INFORMATION </h6>
                                        <dl>
                                            <dt>Payment Status: </dt><dd class="text-success">
                                                <?= ($pay_item->payment_status=="Unverified")?
                                                    "<span class='text-danger'>Pending Confirmation</span>":"Confirmed"; ?>
                                            </dd>
                                            <dt>Payment Method</dt>
                                            <dd><?= ($pay_item->payment_option=="DebitCard")? "Paystack (Debit Card)":"Bank Transfer"; ?></dd>
                                            <dt>Payment Details</dt>
                                            <dd>Items total: ₦ <?= number_format(($pay_item->payment_amount-$pay_item->order_ship_fee),0); ?></dd>
                                        </dl>
                                        <p>Shipping Fees: ₦ <?= number_format($pay_item->order_ship_fee,0); ?></p>
                                        <p class="bold-600">Total: ₦ <?= number_format(($pay_item->payment_amount),0); ?></p>
                                    </div>
                                </div>
                                <div id="delivery-info" class="col-12 col-md-6">
                                    <div class="inner">
                                        <h6>DELIVERY INFORMATION </h6>
                                        <dl>
                                            <dt>Delivery Method</dt>
                                            <dd>Standard Door Delivery</dd>
                                            <dt>Shipping Address</dt>
                                            <dd><?= $pay_item->receiver_full_add; ?> Nigeria.</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <?php } } ?>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once("../inc/footer.nav.php"); ?>