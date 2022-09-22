<?php
include_once("../inc/header.main.php");
if (!isset($_SESSION['USER_LOGIN']) && !isset($_SESSION['USER_LOGIN']['customer_id'])) header('Location: ../index');
?>
</div>
<div class="container my-md-5 w-100 user_account" id="user_order_page">
    <div class="row no-gutters">
        <div class="col-3"><?php include_once 'account-sidebar.php'; ?></div>
        <div class="col-12 col-md-9">
            <main class="main_area">
                <div class="px-3">
                    <div>
                        <button class="btn p-0 my-3 d-block d-md-none" id="userAccountMenuBtn"><span data-feather="menu"></span></button>
                    </div>
                    <?php
                    $url = CONTROLLER_ROOT_URL."/v5/read-order-pending-review.php?customer_id=".$_SESSION['USER_LOGIN']['customer_id'];
                    $object = $api->curlQueryGet($url);
                    if($object->status != 200 )  {
                        echo "<div class='card container-fluid mb-3 border-0'><div class='row no-gutters'><div class='col p-4'>No item to review</div></div></div>";
                    } else {
                        foreach ($object->pendingReview as $item) {
                    ?>
                    <div class="container p-0">
                        <div class="row py-2 border m-2 item_row">
                            <div class="col-5 col-lg-2 p-0 m-0">
                                <img src="sellers/<?=$item->pro_image1;?>" alt="" class="img-fluid">
                            </div>
                            <div class="col-7 col-lg-7">
                                <div class="row">
                                    <div class="col-12 col-lg-7">
                                        <h6 class="m-0"><?=$item->pro_title;?></h6>
                                        <div><strong>₦&nbsp;<span><?=number_format($item->pro_price,0);?></span></strong></div>
                                    </div>
                                    <div class="col-12 col-lg-5">
                                        <div class="d-flex align-items-center">
                                            <div><?= date('d/m/Y', strtotime($item->order_on)); ?>&nbsp;</div>
                                            <div class="text-success ml-md-3"><?=$item->order_status;?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <a href="account/review/<?=$item->order_details_id;?>/<?=$item->pro_id;?>" class="btn btn_primary btn-sm float-md-right btn_action">Rate this product</a>
                            </div>
                        </div>
                    </div>
                    <?php } } ?>
                </div>
            </main>
        </div>
    </div>
</div>
<?php include_once("../inc/footer.main.php"); ?>