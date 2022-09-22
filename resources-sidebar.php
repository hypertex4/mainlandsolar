<?php
include_once('controllers/config/database.php');
include_once('controllers/classes/Customer.class.php');
$db = new Database();
$connection = $db->connect();
$user = new Customer($connection);
?>
<div id="sidebar-widget">
    <div id="category">
        <h6 class="600-bold">CATEGORY</h6>
        <ul class="px-0 list-style-none">
            <?php
            $blog_cat= $user->read_blog_post_categories();
            if ($blog_cat->num_rows > 0) {
            while ($row = $blog_cat->fetch_assoc()){
                if ($user->count_blog_post_categories_by_id($row['category_id']) > 0){
            ?>
            <li class="menu-list">
                <a href="resources?c=<?=$row['category_id'];?>" class="menu-link"><?=strtoupper($row['category_name']);?></a>
                <span>(<?=$user->count_blog_post_categories_by_id($row['category_id']);?>)</span>
            </li>
            <?php } } } ?>
        </ul>
    </div>
    <div id="latest-post">
        <h6 class="bold-600">LATEST POSTS</h6>
        <ul class="px-0 list-style-none">
            <?php
            $blog = $user->read_latest_blog_post_limit_5();
            if ($blog->num_rows > 0) {
            while ($row = $blog->fetch_assoc()){
            ?>
            <li class="menu-list">
                <a href="post/<?=$row['post_slug']?>" class="menu-link"><?= strtoupper($row['post_title']);?></a>
            </li>
            <?php } } ?>
        </ul>
    </div>
</div>