<?php include_once("../inc/header.nav.php");
if (!isset($_SESSION['USER_LOGIN']) && !isset($_SESSION['USER_LOGIN']['customer_id'])) header('Location: ../index');
?>
<main>
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
                <h6 class="user-greet">
                    HELLO, <?=$_SESSION['USER_LOGIN']['firstname']." ".$_SESSION['USER_LOGIN']['lastname'];?>
                </h6>

                <div id="user-content-wrapper">
                    <div class="sidenav-wrapper">
                        <?php include_once("account-sidenav.php"); ?>
                    </div>
                    <div class="main-content" id="user-purchase-history-content">
                        <div class="rounded-0 mb-3">
                            <div class="" id="table-header">
                                <div class="date-col">Date</div>
                                <div class="shipTo-col">Ship to</div>
                                <div class="totalPrice-col">Total price</div>
                                <div class="status-col">Status</div>
                                <div class="details-col">Details</div>
                            </div>
                            <?php
                            $url = CONTROLLER_ROOT_URL."/v6/read-user-order.php?customer_id=".$_SESSION['USER_LOGIN']['customer_id'];
                            $object = $api->curlQueryGet($url);
                            if($object->status == 200)  {
                            ?>
                            <?php $n = 0; foreach ($object->orders as $item) { ?>
                            <div class="table-row">
                                <div class="date"><?= date('d/m/Y', strtotime($item->order_on)); ?></div>
                                <div class="shipTo"><?= $item->order_address; ?></div>
                                <div class="totalPrice">₦ <?= number_format($item->order_amount,2); ?></div>
                                <div class="status">
                                    <?=($item->order_status==='Delivered')?
                                        "<span class='text-success'>Delivered</span>":
                                        "<span class='text-muted'>".$item->order_status."</span>"; ?>
                                </div>
                                <div class="details">
                                    <a href="account/purchase-details/<?= bin2hex($item->order_id); ?>" class="btn btn-sm btn-white rounded-0">Quick view</a>
                                </div>
                            </div>
                            <?php } ?>
                            <?php } else { ?>
                            <div class="alert alert-light text-center" role="alert">No Purchase History</div>
                            <?php }  ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div id="overlay"></div>
</main>
<?php include_once("../inc/footer.nav.php"); ?>