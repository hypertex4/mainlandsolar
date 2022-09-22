<?php include_once("../inc/header.nav.php"); ?>

<?php $product_slug = (isset($_GET['pro_slug']) && !empty($_GET['pro_slug'])) ? $_GET['pro_slug'] : die();  ?>
<?php
include_once('../controllers/config/database.php');
include_once('../controllers/classes/Product.class.php');
$db = new Database();
$connection = $db->connect();
$product = new Product($connection);
$url = CONTROLLER_ROOT_URL."/v6/read-product-by-slug.php?pro_slug=$product_slug";
$object = $api->curlQueryGet($url);
if ($object->status == 200){
    foreach ($object->productSlug as $item) {
?>
<div id="product-details-page" class="bg-white">
    <div class="container auto-wrapper">
        <ul class="breadcrumb">
            <li><a href="./">Home</a></li>
            <li><a href="./product/">Products</a></li>
            <li><?=$item->pro_title;?></li>
        </ul>

        <!-- product preview -->
        <section id="product-preview" class="mb-5 product_click">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="" id="product-feature-images">
                        <div class="" id="img-preview-screen"></div>
                        <div class="" id="controls">
                            <ul class="list-style-none px-0 h-100">
                                <?php if ($item->pro_image1 != "null"){?>
                                <li class="select-img">
                                    <label for="img-1"></label>
                                    <input type="radio" id="img-1" name="preview-img" class="preview-img" value="admin/<?=$item->pro_image1;?>" checked>
                                </li>
                                <?php }?>
                                <?php if ($item->pro_image2 != "null"){?>
                                <li class="select-img">
                                    <label for="img-2"></label>
                                    <input type="radio" id="img-2" name="preview-img" class="preview-img" value="admin/<?=$item->pro_image2;?>">
                                </li>
                                <?php }?>
                                <?php if ($item->pro_image3 != "null"){?>
                                <li class="select-img">
                                    <label for="img-3"></label>
                                    <input type="radio" id="img-3" name="preview-img" class="preview-img" value="admin/<?=$item->pro_image3;?>">
                                </li>
                                <?php }?>
                            </ul>
                        </div>
                        <div id="share-product" class="mb-3 mb-md-0">Share with Friends :
                            <a href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.mainlandsolar.com%2F<?= $item->pro_slug; ?>" class="dark-link">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M24 12.073C24 5.40365 18.629 0 12 0C5.37097 0 0 5.40365 0 12.073C0 18.0988 4.38823 23.0935 10.125 24V15.563H7.07661V12.073H10.125V9.41306C10.125 6.38751 11.9153 4.71627 14.6574 4.71627C15.9706 4.71627 17.3439 4.95189 17.3439 4.95189V7.92146H15.8303C14.34 7.92146 13.875 8.85225 13.875 9.8069V12.073H17.2031L16.6708 15.563H13.875V24C19.6118 23.0935 24 18.0988 24 12.073Z" fill="#414143" />
                                </svg>
                            </a>
                            <a href="https://api.whatsapp.com/send?text=<?= $item->pro_title; ?> https%3A%2F%2Fwww.mainlandsolar.com%2Fdetails%2F<?= $item->pro_slug; ?>" class="dark-link">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.031 6.172C8.85 6.172 6.264 8.758 6.263 11.938C6.262 13.236 6.643 14.208 7.282 15.225L6.7 17.353L8.882 16.78C9.86 17.36 10.793 17.708 12.027 17.709C15.205 17.709 17.794 15.122 17.795 11.943C17.796 8.756 15.22 6.173 12.031 6.172ZM15.423 14.416C15.279 14.821 14.586 15.19 14.253 15.24C13.954 15.285 13.576 15.303 13.161 15.171C12.909 15.091 12.586 14.984 12.173 14.806C10.434 14.055 9.299 12.304 9.212 12.189C9.125 12.073 8.504 11.249 8.504 10.396C8.504 9.543 8.952 9.123 9.111 8.95C9.27 8.777 9.457 8.733 9.573 8.733L9.905 8.739C10.011 8.744 10.154 8.699 10.295 9.037C10.439 9.384 10.786 10.237 10.829 10.324C10.872 10.411 10.901 10.512 10.843 10.628C10.785 10.744 10.756 10.816 10.67 10.917L10.41 11.221C10.323 11.307 10.233 11.401 10.334 11.575C10.435 11.749 10.783 12.316 11.298 12.776C11.96 13.367 12.519 13.55 12.692 13.636C12.865 13.722 12.966 13.708 13.068 13.593C13.169 13.477 13.501 13.087 13.617 12.913C13.733 12.74 13.848 12.768 14.007 12.826C14.166 12.884 15.018 13.303 15.191 13.39C15.364 13.477 15.48 13.52 15.523 13.592C15.568 13.664 15.568 14.011 15.423 14.416ZM12 0C5.373 0 0 5.373 0 12C0 18.627 5.373 24 12 24C18.627 24 24 18.627 24 12C24 5.373 18.627 0 12 0ZM12.029 18.88C10.868 18.88 9.724 18.588 8.711 18.036L5.034 19L6.018 15.405C5.411 14.353 5.091 13.159 5.092 11.937C5.093 8.112 8.205 5 12.029 5C13.885 5.001 15.627 5.723 16.936 7.034C18.246 8.345 18.967 10.088 18.966 11.942C18.965 15.767 15.853 18.88 12.029 18.88Z" fill="#414143" />
                                </svg>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url=https%3A%2F%2Fwww.mainlandsolar.com%2Fdetails%2F<?= $item->pro_slug; ?>&text=<?= $item->pro_title; ?>&via=mainlandsolar" class="dark-link">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 0C5.373 0 0 5.373 0 12C0 18.627 5.373 24 12 24C18.627 24 24 18.627 24 12C24 5.373 18.627 0 12 0ZM18.066 9.645C18.249 13.685 15.236 18.189 9.902 18.189C8.28 18.189 6.771 17.713 5.5 16.898C7.024 17.078 8.545 16.654 9.752 15.709C8.496 15.686 7.435 14.855 7.068 13.714C7.519 13.8 7.963 13.775 8.366 13.665C6.985 13.387 6.031 12.143 6.062 10.812C6.45 11.027 6.892 11.156 7.363 11.171C6.084 10.316 5.722 8.627 6.474 7.336C7.89 9.074 10.007 10.217 12.394 10.337C11.975 8.541 13.338 6.81 15.193 6.81C16.018 6.81 16.765 7.159 17.289 7.717C17.943 7.589 18.559 7.349 19.113 7.02C18.898 7.691 18.443 8.253 17.85 8.609C18.431 8.539 18.985 8.385 19.499 8.156C19.115 8.734 18.629 9.24 18.066 9.645Z" fill="#414143" />
                                </svg>
                            </a>

                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-5">
                    <div class="product-info h-100">
                        <h5><?=ucfirst(strtolower($item->pro_title));?></h5>
                        <?php $rating=$product->read_average_review_rating($item->pro_id); if($rating>0){ ?>
                        <div class="star-rating">
                            <?php for ($i = 1; $i <= 5; $i++) {
                                if ($i <=$product->read_average_review_rating($item->pro_id)) echo "<i class='fas fa-star'></i>";
                                else echo "<i class='far fa-star'></i>";
                            }
                            ?>
                        </div>
                        <?php } else { ?>
                            <span class="star-rating small font-italic">
                                <i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                                <i class="far fa-star"></i><i class="far fa-star"></i>
                                <span>(No review yet)</span>
                            </span>
                        <?php } ?>
                        <div class="product-price bold-600">
                            <span class="label">Price:</span> ₦<span class="value"><?=number_format($item->pro_price,0);?></span>
                        </div>
                        <hr />
                        <ul class="product-spec list-style-none px-0 my-0">
                            <?php
                            $datas = explode(";",$item->pro_spec);
                            foreach ($datas as $keys => $values){
                            ?>
                            <li><?= $values; ?></li>
                            <?php } ?>
                        </ul>
                        <hr />
                        <div class="product-qty bold-600">
                            <span class="label">Quantity:</span>
                            <div>
                                <div class="inner qty-ctrl">
                                    <button class="btn btn-sm decreament-btn minus" id="<?=$item->pro_id; ?>">-</button>
                                    <div class="count" id="quantity">1</div>
                                    <button class="btn btn-sm increament-btn add" id="<?=$item->pro_id; ?>">+</button>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="action user-action">
                            <div class="add-to-cart">
                                <button id="my_btnData" class="btn btn-white add-to-cart-2"
                                    data-title="<?= $item->pro_title; ?>"
                                    data-slug="<?= $item->pro_slug; ?>"
                                    data-id="<?= $item->pro_id; ?>"
                                    data-count="1"
                                    data-price="<?= $item->pro_price; ?>"
                                    data-image="<?= $item->pro_image1; ?>">ADD TO CART</button>
                            </div>
                            <div class="add-to-wishlist">
                                <button class="btn btn-white alt-warning add_to_wlist" data-id="<?=$item->pro_id;?>">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                        <hr class="mb-0" />
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="related-products-widget h-100">
                        <div class="inner h-100">
                            <div class="widget-header">
                                <h6 class="my-0 bold">RELATED PRODUCTS</h6>
                            </div>
                            <?php
                            $url = CONTROLLER_ROOT_URL."/v6/read-related-product-by-slug.php?cat_id=".$item->category_id.'&slug='.$item->pro_slug;
                            $object = $api->curlQueryGet($url);
                            if ($object->status == 200){
                            foreach ($object->related_products as $related) {
                            ?>
                            <a href="product/details/<?=$related->pro_slug;?>" class="widget-item dark-link">
                                <div class="img-wrapper">
                                    <img src="admin/<?=$related->pro_image1;?>" alt="" class="img-fluid">
                                </div>
                                <div class="item-details">
                                    <div class="product-name"><?=$related->pro_title;?></div>
                                    <?php $rating=$product->read_average_review_rating($related->pro_id); if($rating>0){ ?>
                                        <div class="star-rating">
                                            <?php for ($i = 1; $i <= 5; $i++) {
                                                if ($i <=$product->read_average_review_rating($related->pro_id)) echo "<i class='fas fa-star'></i>";
                                                else echo "<i class='far fa-star'></i>";
                                            }
                                            ?>
                                        </div>
                                    <?php } else { ?>
                                        <span class="star-rating small font-italic">
                                            <i class="far fa-star"></i><span>&nbsp;(No review yet)</span>
                                        </span>
                                    <?php } ?>
                                    <div class="bold-600">₦ <?=number_format($related->pro_price,0);?></div>
                                </div>
                            </a>
                            <?php } } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- product details -->
        <section id="product-details">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-description-tab" data-toggle="pill" href="#pills-description" role="tab" aria-controls="pills-description" aria-selected="true">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-specification-tab" data-toggle="pill" href="#pills-specification" role="tab" aria-controls="pills-specification" aria-selected="false">Specification</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-reviews-tab" data-toggle="pill" href="#pills-reviews" role="tab" aria-controls="pills-reviews" aria-selected="false">Reviews</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
                    <article>
                        <h6 class="bold-600">ABOUT THE PRODUCT</h6>
                        <p><?=$item->pro_desc;?></p>
                        <dl class="key-features">

                        </dl>
                    </article>
                </div>
                <div class="tab-pane fade" id="pills-specification" role="tabpanel" aria-labelledby="pills-specification-tab">
                    <ul class="list-style-none px-0">
                        <?php
                        $datas = explode(";",$item->pro_spec);
                        foreach ($datas as $keys => $values){
                        ?>
                        <li><?= $values; ?></li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="tab-pane fade" id="pills-reviews" role="tabpanel" aria-labelledby="pills-reviews-tab">
                    <div class="inner">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                <tr>
                                    <th class="name-head"></th>
                                    <th class="comment-head"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $url = CONTROLLER_ROOT_URL."/v6/read-review-by-product-id.php?pid=".$item->pro_id;
                                    $object = $api->curlQueryGet($url);
                                    if ($object->status == 200){foreach ($object->reviews as $review) {
                                    ?>
                                    <tr class="user-item">
                                        <td scope="row">
                                            <div class="inner">
                                                <div class="name-label"><?=substr($review->review_name,0,1);?></div>
                                                <div class="customer-name-date">
                                                    <div class="name uppercase"><?=$review->review_name;?></div>
                                                    <div class="date"><?= date('F j, Y', strtotime($review->rated_on)); ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="comment-rating">
                                                <div class="star-rating">
                                                    <?php for ($i = 1; $i <= 5; $i++) {
                                                        if ($i <= $review->review_rate) echo "<i class='fas fa-star'></i>";
                                                        else echo "<i class='far fa-star'></i>";
                                                    }
                                                    ?>
                                                </div>
                                                <div><?=$review->review_comment;?></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php } } else { ?>
    <div id="page-not-found-page">
        <div class="bg-white h-100">
            <div class="">
                <div class="content text-center">
                    <div>
                        <p class="status bold">404</p>
                        <h1 class="title">Page Not Found</h1>
                        <p><a href="./" class="dark-link">Return to Home</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php include_once("../inc/footer.nav.php");?>
<script>
    $(document).on('click', '.add', function() {
        var product_id = $(this).attr("id");var value = parseInt(document.getElementById('quantity').innerText);document.getElementById('quantity').textContent = ++value;
        $("#my_btnData").attr("data-count", value);
    });
    const curValue = parseInt(document.getElementById('quantity').innerText);
    $(document).on('click', '.minus', function() {
        var product_id = $(this).attr("id");var value = parseInt(document.getElementById('quantity').innerText);
        if (value<=curValue) document.getElementById('quantity').textContent = curValue;
        else document.getElementById('quantity').textContent = --value;
        $("#my_btnData").attr("data-count", value);

    });
    $("#my_btnData").attr("data-count", parseInt(document.getElementById('quantity').innerText));
</script>
