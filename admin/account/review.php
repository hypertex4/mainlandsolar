<?php
include_once("../inc/header.main.php");
if (!isset($_SESSION['USER_LOGIN']) && !isset($_SESSION['USER_LOGIN']['customer_id'])) header('Location: ../index');
if ($_GET['product_id']=='' || $_GET['order_detail_id']=='') {die("INVALID LINK");}
?>
</div>
<div class="container mt-md-5 w-100 user_account" id="user_review_page">
    <div class="row no-gutters">
        <div class="col-3"><?php include_once 'account-sidebar.php'; ?></div>
        <div class="col-12 col-md-9">
            <main class="main_area">
                <div class="px-3">
                    <div>
                        <button class="btn p-0 my-3 d-block d-md-none" id="userAccountMenuBtn"><span data-feather="menu"></span></button>
                    </div>
                    <div class="border">
                        <div class="d-flex align-items-center border-bottom p-2">
                            <button class="btn p-0" id="userAccountMenuBtn" onclick="goBack()"><span data-feather="arrow-left"></span></button>
                            <h5>Review product</h5>
                        </div>
                        <div class="bg-danger p-2 text-white">Help us get better by giving your feedback</div>
                        <?php
                        $url = CONTROLLER_ROOT_URL."/v5/read-product-by-order-details-id.php?order_detail_id=".$_GET['order_detail_id']."&product_id=".$_GET['product_id'];
                        $object = $api->curlQueryGet($url);
                        if ($object->status == 200){
                            foreach ($object->product as $item) {
                        ?>
                        <div class="container-fluid border-bottom">
                            <div class="row no-gutters">
                                <div class="col-4 col-md-3">
                                    <img src="sellers/<?=$item->pro_image1;?>" alt="" class="img-fluid">
                                </div>
                                <div class="col-8 col-md-9">
                                    <h6><?=$item->pro_title;?> <br />Qty:&nbsp;<span><?=$item->product_qty;?><span></h6>
                                </div>
                            </div>
                        </div>
                        <?php } } ?>
                        <div class="container py-2">
                            <form name="review" id="review">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-row">
                                            <div class="col-12">
                                                <div class="form_grp mb-3">
                                                    <label class="text_capital d-block" for="review_name">Full Name</label>
                                                    <input type="text" class="d-block w-100" id="review_name" name="review_name"
                                                       value="<?=$_SESSION['USER_LOGIN']['firstname'];?> <?=$_SESSION['USER_LOGIN']['lastname'];?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form_grp mb-3">
                                                    <label for="rating" class="my-0" style="display: block">Rate</label>
                                                    <span class="star-rating">
                                                        <i class="far fa-star text-warning review_star"></i>
                                                        <i class="far fa-star text-warning review_star"></i>
                                                        <i class="far fa-star text-warning review_star"></i>
                                                        <i class="far fa-star text-warning review_star"></i>
                                                        <i class="far fa-star text-warning review_star"></i>
                                                    </span>
                                                    <input type="hidden" name="rating_value" id="rating_value">
                                                    <input type="hidden" name="order_details_id" id="order_details_id" value="<?=$_GET['order_detail_id'];?>">
                                                    <input type="hidden" name="product_id" id="product_id" value="<?= $_GET['product_id']; ?>">
                                                    <input type="hidden" name="customer_id" id="customer_id" value="<?=$_SESSION['USER_LOGIN']['customer_id'];?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form_grp">
                                            <label class="text_capital d-block" for="review_comment">Comment</label>
                                            <textarea type="text" rows="5" class="d-block w-100" id="review_comment" name="review_comment"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form_grp">
                                    <button type="submit" class="btn btn_primary py-2 px-5 rounded-0" id="review_btn">SUBMIT</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
<?php include_once("../inc/footer.main.php"); ?>