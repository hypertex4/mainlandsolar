<?php ob_start(); if (!isset($_SESSION['temp_category_id'])){session_start();}

include_once('controllers/config/database.php');
include_once('controllers/classes/Product.class.php');
include_once("controllers/classes/GlobalApi.class.php");

$db = new Database();
$connection = $db->connect();
$productCon = new Product($connection);

// Default limit
$limit = isset($_GET['per_page']) ? $_GET['per_page'] : 2;

// Default offset
$offset = 0;
$current_page = 1;
if(isset($_GET['page-number'])) {
    $current_page = (int)$_GET['page-number'];
    $offset = ($current_page * $limit) - $limit;
}

$whereSQL = $orderSQL = '';

$query = $connection->query("SELECT * FROM tbl_blog_posts bp INNER JOIN tbl_blog_categories bc ON bp.post_cat=bc.category_id 
                                    WHERE bp.post_cat=".$_SESSION['temp_category_id']." $whereSQL $orderSQL");
if($query->num_rows > 0){
    $latest_arr = array();
    while ($row = $query->fetch_assoc()){
        $latest_arr[] = array(
            "post_id" => $row['post_id'], "post_image1" => $row['post_image1'], "post_title" => $row['post_title'],
            "post_slug" => $row['post_slug'], "post_author" => $row['post_author'],"post_body" => $row['post_body'],
            "post_created" => $row['post_created'],"category_name" => $row['category_name']
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
            <li>
                <div class="card border-0 blog-post">
                    <img src="admin/<?=$product['post_image1'];?>" class="card-img-top rounded-0" alt="<?=$product['post_title'];?>">
                    <div class="card-body px-0">
                        <h5 class="card-title">
                            <a href="post/<?=$product['post_slug'];?>" class="dark-link"><?=strtoupper($product['post_title']);?></a>
                        </h5>
                        <div class="date mb-2"><?=date("M j, Y", strtotime($product['post_created']));?></div>
                        <p class="card-text"><?=$product['post_body'];?></p>
                        <hr />
                        <div class="category">Category:&nbsp;<span><?=$product['category_name'];?></span></div>
                    </div>
                </div>
            </li>
        <?php }
        if ($paged) {
            require('product/pagination.php');}
    }  else {
        echo '<p class="alert alert-warning" >No blog post found.</p>';
    }
} else {
    echo '<p class="alert alert-warning" >No blog post found.</p>';
}


