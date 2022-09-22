<?php include_once("inc/header.nav.php"); ?>
<?php if ($_GET['product_id']=='' || $_GET['order_detail_id']=='') {die("INVALID LINK");} ?>
<div id="user-review-page">
    <div class="bg-white d-flex">
        <div class="container auto-wrapper">
            <div class="review-form-wrapper">
                <div class="header py-2 text-center">
                    <div class="brandlogo-wrapper">
                        <img src="./assets/images/navbrand-logo-min.png" alt="" class="img-fluid">
                    </div>
                </div>
                <aside>Help us improve more by giving your feedback</aside>
                <div class="item-preview px-3">
                    <div class="inner">
                        <?php
                        $url = CONTROLLER_ROOT_URL."/v6/read-product-by-order-details-id.php?order_detail_id=".$_GET['order_detail_id']."&product_id=".$_GET['product_id'];
                        $object = $api->curlQueryGet($url);
                        if ($object->status == 200){
                        foreach ($object->product as $item) {
                        ?>
                        <div class="img-wrapper">
                            <img src="admin/<?= $item->pro_image1;?>" alt="" class="img-fluid">
                        </div>
                        <div class="body bold-600">
                            <div>
                                <div class="item-name"><?= $item->pro_title;?></div>
                                <div>Qty: <?= $item->product_qty;?></div>
                            </div>
                        </div>
                        <?php } } ?>
                    </div>
                </div>
                <hr class="horizontal-line" />
                <form class="p-3" name="review" id="review">
                    <div class="form-group">
                        <label for="review_name">Name</label>
                        <input type="text" class="form-control" id="review_name" name="review_name">
                    </div>
                    <div class="form-group">
                        <label for="review_comment">Comment</label>
                        <textarea class="form-control" name="review_comment" id="review_comment" cols="30" rows="6"></textarea>
                    </div>
                    <div class="form-group form_grp">
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

                    </div>
                    <button type="submit" class="btn btn-block btn-white rounded-0 bold-600" id="review_btn">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include_once("inc/footer.nav.php"); ?>