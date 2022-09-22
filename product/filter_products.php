<?php

include_once('../controllers/config/database.php');
include_once('../controllers/classes/Product.class.php');
include_once("../controllers/classes/GlobalApi.class.php");

$db = new Database();
$connection = $db->connect();
$productCon = new Product($connection);

// Default limit
$limit = isset($_GET['per_page']) ? $_GET['per_page'] : 20;

// Default offset
$offset = 0;
$current_page = 1;
if(isset($_GET['page-number'])) {
    $current_page = (int)$_GET['page-number'];
    $offset = ($current_page * $limit) - $limit;
}

$whereSQL = $orderSQL = '';
if(!empty($_GET['search'])){
    $whereSQL .= " AND (p.pro_title LIKE '%".$_GET['search']."%' OR p.pro_desc LIKE '%".$_GET['search']."%')";
}

if(!empty($_GET['sortBy'])){
    $orderSQL = " ORDER BY p.pro_price ".$_GET['sortBy'];
} else {
    $orderSQL = " ORDER BY p.pro_sno DESC ";
}

$query = $connection->query("SELECT p.*,r.review_rate FROM tbl_products p LEFT JOIN tbl_reviews r ON p.pro_id=r.pro_id 
                                    WHERE p.pro_sno>0 AND p.pro_active='1' $whereSQL $orderSQL");
if($query->num_rows > 0){
    $latest_arr = array();
    while ($row = $query->fetch_assoc()){
        $latest_arr[] = array(
            "pro_id" => $row['pro_id'], "pro_title" => $row['pro_title'], "pro_slug" => $row['pro_slug'],"pro_stock" => $row['pro_stock'],
            "pro_image1" => $row['pro_image1'], "pro_price" => $row['pro_price'],"review_rate" => $row['review_rate']
        );
    }
    $products = $latest_arr;
    $paged_products = array_slice($products, $offset, $limit);
    $total_products = count($products);

// Get the total pages rounded up the nearest whole number
    $total_pages = ceil( $total_products / $limit );
    $paged = $total_products > count($paged_products) ? true : false;

    if (count($paged_products)) {
        foreach ($paged_products as $product) { ?>
            <div class="col-6 col-sm-4 col-md-3">
                <div class="product-card card <?=($product['pro_stock']=='0'?'out-of-stock':'');?>">
                    <img src="admin/<?=$product['pro_image1'];?>" class="card-img-top" alt="<?=$product['pro_title'];?>">
                    <div class="card-body">
                        <p class="card-text mb-0">
                            <a href="product/details/<?=$product['pro_slug'];?>" class="dark-link">
                                <?=(strlen($product['pro_title'])>60)?substr(ucfirst(strtolower($product['pro_title'])),0,60).'...':ucfirst(strtolower($product['pro_title']));?>
                            </a>
                        </p>
                        <?php $rating=$productCon->read_average_review_rating($product['pro_id']); if($rating>0){ ?>
                            <div class="star-rating">
                                <?php for ($i = 1; $i <= 5; $i++) {
                                    if ($i <=$productCon->read_average_review_rating($product['pro_id'])) echo "<i class='fas fa-star'></i>";
                                    else echo "<i class='far fa-star'></i>";
                                }
                                ?>
                            </div>
                        <?php } else { ?>
                            <span class="star-rating small"><i class="far fa-star"></i><span>(No review yet)</span></span>
                        <?php } ?>
                        <p class="price">₦ <?=number_format($product['pro_price'],0);?></p>
                    </div>
                    <div class="card-body action-wrapper">
                        <div class="action user-action">
                            <div class="add-to-cart">
                                <button class="btn btn-white add-to-cart-2"
                                        data-title="<?= $product['pro_title']; ?>"
                                        data-slug="<?= $product['pro_slug']; ?>"
                                        data-id="<?= $product['pro_id']; ?>"
                                        data-count="1"
                                        data-price="<?= $product['pro_price']; ?>"
                                        data-image="<?= $product['pro_image1']; ?>">
                                    <?=($product['pro_stock']=='0'?'OUT OF STOCK':'ADD TO CART');?>
                                    </button>
                            </div>
                            <div class="add-to-wishlist">
                                <button class="btn btn-white add_to_wlist" data-id="<?=$product['pro_id'];?>">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
        if ($paged) {
            require('pagination.php');}
    }  else {
        echo '<p class="alert alert-warning" >No Products found.</p>';
    }
} else {
    echo '<p class="alert alert-warning" >No Products found.</p>';
}


