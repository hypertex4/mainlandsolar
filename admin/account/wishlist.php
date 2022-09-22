<?php
include_once("../inc/header.main.php");
if (!isset($_SESSION['USER_LOGIN']) && !isset($_SESSION['USER_LOGIN']['customer_id'])) header('Location: ../index');
?>
</div>
<div class="container my-md-5 w-100 user_account" id="">
    <div class="row no-gutters">
        <div class="col-3"><?php include_once 'account-sidebar.php'; ?></div>
        <div class="col-12 col-md-9">
            <main class="main_area">
                <div class="px-3">
                    <div>
                        <button class="btn p-0 my-3 d-block d-md-none" id="userAccountMenuBtn"><span data-feather="menu"></span></button>
                    </div>
                    <div class="container p-0">
                    <?php
                    $url = CONTROLLER_ROOT_URL."/v5/read-all-wish-list.php?customer_id=".$_SESSION['USER_LOGIN']['customer_id'];
                    $object = $api->curlQueryGet($url);
                    if($object->status == 200)  {
                    foreach ($object->wishlist as $wItem) {
                    ?>
                        <div class="row py-2 border m-2 item_row">
                            <div class="col-5 col-lg-2 p-0 m-0"><img src="sellers/<?=$wItem->pro_image1;?>" alt="" class="img-fluid"></div>
                            <div class="col-7 col-lg-7">
                                <h6 class="m-0"><?=$wItem->pro_title;?></h6>
                                <div><strong>₦&nbsp;<span><?=number_format($wItem->pro_price,0);?></span></strong></div>
                            </div>
                            <div class="col-12 col-lg-3 text-center">
                                <button class="btn btn_primary btn-sm btn_action  move-item-to-cart"
                                    data-title="<?= $wItem->pro_title; ?>"
                                    data-id="<?= $wItem->pro_id; ?>"
                                    data-wlist_id="<?= $wItem->wlist_id; ?>"
                                    data-count="1"
                                    data-price="<?= $wItem->pro_price; ?>"
                                    data-image="<?= $wItem->pro_image1; ?>">ADD TO CART</button>
                                <button class="btn text-danger btn-sm btn_action wishlist_remove" data-id="<?= $wItem->wlist_id; ?>">
                                    <i class="fas fa-trash"></i>&nbsp;&nbsp;REMOVE
                                </button>
                            </div>
                        </div>
                        <?php } } else { ?>
                        <div class="alert alert-info text-center" role="alert">No Item was saved!</div>
                        <?php } ?>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
<?php include_once("../inc/footer.main.php"); ?>