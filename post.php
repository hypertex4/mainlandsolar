<?php include_once("inc/header.nav.php"); ?>
<?php $post_slug = (isset($_GET['post_slug']) && !empty($_GET['post_slug'])) ? $_GET['post_slug'] : die();  ?>
<?php
include_once('controllers/config/database.php');
include_once('controllers/classes/Customer.class.php');
$db = new Database();
$connection = $db->connect();
$user = new Customer($connection);
?>
<?php
$url = CONTROLLER_ROOT_URL."/v6/read-blog-post-by-slug.php?post_slug=$post_slug";
$object = $api->curlQueryGet($url);
if ($object->status == 200){
foreach ($object->postSlug as $item) { ?>
<div id="resources-page">
    <div class="bg-white pb-5">
        <div class="container auto-wrapper">
            <ul class="breadcrumb">
                <li><a href="./">Home</a></li>
                <li><a href="resources">Resources</a></li>
                <li><a href="resources"><?=$item->category_name;?></a></li>
                <li><?=$item->post_title;?></li>
            </ul>
            <div id="user-resources-content">
                <div class="inner">
                    <div id="content-wrapper">
                        <div id="blogpost-details" class="mb-4">
                            <h5 id="post-title"><?=ucwords($item->post_title);?></h5>
                            <small class="date mb-2"><?=date("M j, Y", strtotime($item->post_created));?></small>
                            <div class="card border-0 blog-post">
                                <img src="admin/<?=$item->post_image1;?>" class="card-img-top rounded-0" alt="<?=$item->post_slug;?>">
                                <div class="card-body px-0">
                                    <p class="card-text"><?=$item->post_body;?></p>
                                    <div id="share-icons">
                                        <span class="label bold-600">Share with Friends :</span>
                                        <span>
                                        <ul class="icons px-0 list-style-none">
                                            <li>
                                                <a href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.mainlandsolar.com%2F<?= $item->post_slug; ?>" class="dark-link">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M24 12.073C24 5.40365 18.629 0 12 0C5.37097 0 0 5.40365 0 12.073C0 18.0988 4.38823 23.0935 10.125 24V15.563H7.07661V12.073H10.125V9.41306C10.125 6.38751 11.9153 4.71627 14.6574 4.71627C15.9706 4.71627 17.3439 4.95189 17.3439 4.95189V7.92146H15.8303C14.34 7.92146 13.875 8.85225 13.875 9.8069V12.073H17.2031L16.6708 15.563H13.875V24C19.6118 23.0935 24 18.0988 24 12.073Z" fill="#414143" />
                                                    </svg>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://api.whatsapp.com/send?text=<?= $item->post_title; ?> https%3A%2F%2Fwww.mainlandsolar.com%2Fdetails%2F<?= $item->post_slug; ?>" class="dark-link">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12.031 6.172C8.85 6.172 6.264 8.758 6.263 11.938C6.262 13.236 6.643 14.208 7.282 15.225L6.7 17.353L8.882 16.78C9.86 17.36 10.793 17.708 12.027 17.709C15.205 17.709 17.794 15.122 17.795 11.943C17.796 8.756 15.22 6.173 12.031 6.172ZM15.423 14.416C15.279 14.821 14.586 15.19 14.253 15.24C13.954 15.285 13.576 15.303 13.161 15.171C12.909 15.091 12.586 14.984 12.173 14.806C10.434 14.055 9.299 12.304 9.212 12.189C9.125 12.073 8.504 11.249 8.504 10.396C8.504 9.543 8.952 9.123 9.111 8.95C9.27 8.777 9.457 8.733 9.573 8.733L9.905 8.739C10.011 8.744 10.154 8.699 10.295 9.037C10.439 9.384 10.786 10.237 10.829 10.324C10.872 10.411 10.901 10.512 10.843 10.628C10.785 10.744 10.756 10.816 10.67 10.917L10.41 11.221C10.323 11.307 10.233 11.401 10.334 11.575C10.435 11.749 10.783 12.316 11.298 12.776C11.96 13.367 12.519 13.55 12.692 13.636C12.865 13.722 12.966 13.708 13.068 13.593C13.169 13.477 13.501 13.087 13.617 12.913C13.733 12.74 13.848 12.768 14.007 12.826C14.166 12.884 15.018 13.303 15.191 13.39C15.364 13.477 15.48 13.52 15.523 13.592C15.568 13.664 15.568 14.011 15.423 14.416ZM12 0C5.373 0 0 5.373 0 12C0 18.627 5.373 24 12 24C18.627 24 24 18.627 24 12C24 5.373 18.627 0 12 0ZM12.029 18.88C10.868 18.88 9.724 18.588 8.711 18.036L5.034 19L6.018 15.405C5.411 14.353 5.091 13.159 5.092 11.937C5.093 8.112 8.205 5 12.029 5C13.885 5.001 15.627 5.723 16.936 7.034C18.246 8.345 18.967 10.088 18.966 11.942C18.965 15.767 15.853 18.88 12.029 18.88Z" fill="#414143" />
                                                    </svg>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://twitter.com/intent/tweet?url=https%3A%2F%2Fwww.mainlandsolar.com%2Fdetails%2F<?= $item->post_slug; ?>&text=<?= $item->post_title; ?>&via=mainlandsolar" class="dark-link">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12 0C5.373 0 0 5.373 0 12C0 18.627 5.373 24 12 24C18.627 24 24 18.627 24 12C24 5.373 18.627 0 12 0ZM18.066 9.645C18.249 13.685 15.236 18.189 9.902 18.189C8.28 18.189 6.771 17.713 5.5 16.898C7.024 17.078 8.545 16.654 9.752 15.709C8.496 15.686 7.435 14.855 7.068 13.714C7.519 13.8 7.963 13.775 8.366 13.665C6.985 13.387 6.031 12.143 6.062 10.812C6.45 11.027 6.892 11.156 7.363 11.171C6.084 10.316 5.722 8.627 6.474 7.336C7.89 9.074 10.007 10.217 12.394 10.337C11.975 8.541 13.338 6.81 15.193 6.81C16.018 6.81 16.765 7.159 17.289 7.717C17.943 7.589 18.559 7.349 19.113 7.02C18.898 7.691 18.443 8.253 17.85 8.609C18.431 8.539 18.985 8.385 19.499 8.156C19.115 8.734 18.629 9.24 18.066 9.645Z" fill="#414143" />
                                                    </svg>
                                                </a>
                                            </li>
                                        </ul>
                                        </span>
                                    </div>
                                    <hr />
                                    <div class="category">Category:&nbsp;<span><?=$item->category_name;?></span></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div id="post-nav">
                                    <div class="inner">
                                        <?php $res = $user->fetch_prev_blog_post($item->post_sno); ?>
                                        <a href="post/<?= $res['post_slug']; ?>" class="dark-link">
                                            <div id="previous-post">
                                                <div class="post-nav">PREVIOUS POST</div>
                                                <div class="nav-post-title bold-600"><?= strtoupper($res['post_title']); ?></div>
                                            </div>
                                        </a>
                                        <div class="vertical-separator"></div>
                                        <?php $res2 = $user->fetch_next_blog_post($item->post_sno); ?>
                                        <a href="post/<?= $res2['post_slug']; ?>" class="dark-link">
                                            <div id="next-post">
                                                <div class="post-nav">NEXT POST </div>
                                                <div class="nav-post-title bold-600"><?= strtoupper($res2['post_title']); ?></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php include_once('resources-sidebar.php'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } } else { ?>
<div class="container text-center" style="margin: 50px auto;">
    <div class="text-center text-danger" style="font-size: 120px">404</div>
    <div class="text-center" style="font-size: 24px">Page not found </div>
    <div class="text-center" style="font-size: 16px"><a href="./" class="dark-link">Back to homepage</a></div>
</div>
<?php } ?>
<?php include_once("inc/footer.nav.php");?>