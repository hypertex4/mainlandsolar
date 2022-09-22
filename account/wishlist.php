<?php
include_once("../inc/header.nav.php");
if (!isset($_SESSION['USER_LOGIN']) && !isset($_SESSION['USER_LOGIN']['customer_id'])) header('Location: ../index');
?>
<main>
    <div id="user-profile-page" class="product_click">
        <div class="bg-white pb-5">
            <div class="container auto-wrapper">
                <ul class="breadcrumb">
                    <li><a href="./">Home</a></li>
                    <li><a href="./account/">My Account</a></li>
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
                <h6 class="user-greet text-uppercase">
                    HELLO, <?=$_SESSION['USER_LOGIN']['firstname']." ".$_SESSION['USER_LOGIN']['lastname'];?>
                </h6>
                <div id="user-content-wrapper">
                    <div class="sidenav-wrapper">
                        <?php include_once("account-sidenav.php"); ?>
                    </div>
                    <div class="main-content" id="user-wishlist-content">
                        <div class="rounded-0 mb-3">
                            <div class="" id="table-header">
                                <div class="productName-col">Product Name</div>
                                <div class="price-col">Price</div>
                                <div class="action-col"></div>
                            </div>
                            <?php
                            $url = CONTROLLER_ROOT_URL."/v6/read-user-wishlist.php?customer_id=".$_SESSION['USER_LOGIN']['customer_id'];
                            $object = $api->curlQueryGet($url);
                            if($object->status == 200)  {
                            foreach ($object->wishlist as $wItem) {
                            ?>
                            <div class="table-row">
                                <div class="productName">
                                    <span class="mr-1"><?=$wItem->pro_title;?></span>
                                    <a href="product/details/<?=$wItem->pro_slug;?>" class="btn btn-sm btn-success rounded-0">Quick view</a>
                                </div>
                                <div class="price">₦ <?=number_format($wItem->pro_price,0);?></div>
                                <div class="action">
                                    <button href="#" class="btn btn-sm btn-white rounded-0 move-item-to-cart"
                                        data-title="<?= $wItem->pro_title; ?>"
                                        data-id="<?= $wItem->pro_id; ?>"
                                        data-wlist_id="<?= $wItem->wlist_id; ?>"
                                        data-count="1"
                                        data-price="<?= $wItem->pro_price; ?>"
                                        data-image="<?= $wItem->pro_image1; ?>">ADD TO CART</button></div>
                            </div>
                            <?php } } else { ?>
                            <div class="alert alert-light text-center" role="alert">No Item was saved!</div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="preview-wrapper">
                <div id="preview-widget" class="">
                    <div class='inner bg-white p-3'>
                        <div class='d-flex justify-content-end'>
                            <button class='btn btn-sm text-danger' id='close-preview-widget-btn'><i class='fas fa-times'></i></button>
                        </div>
                        <section id='product-preview' class='mb-5'>
                            <div class='row'>
                                <div class='col-12 col-lg-5'>
                                    <div class='' id='product-feature-images'>
                                        <div class='' id='img-preview-screen'></div>
                                        <div class='' id='controls'>
                                            <ul class='list-style-none px-0 h-100'>
                                                <li class='select-img'>
                                                    <label for='img-1'></label>
                                                    <input type='radio' id='img-1' name='preview-img' class='preview-img' value='' checked>
                                                </li>
                                                <li class='select-img'>
                                                    <label for='img-2'></label>
                                                    <input type='radio' id='img-2' name='preview-img' class='preview-img' value=''>
                                                </li>
                                                <li class='select-img'>
                                                    <label for='img-3'></label>
                                                    <input type='radio' id='img-3' name='preview-img' class='preview-img' value=''>
                                                </li>
                                            </ul>
                                        </div>
                                        <div id='share-product' class='mb-3 mb-md-0'>Share with Friends :
                                            <a href='https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.mainlandsolar.com%2F".$row['pro_slug']."' class='dark-link'>
                                            <svg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'>
                                                <path d='M24 12.073C24 5.40365 18.629 0 12 0C5.37097 0 0 5.40365 0 12.073C0 18.0988 4.38823 23.0935 10.125 24V15.563H7.07661V12.073H10.125V9.41306C10.125 6.38751 11.9153 4.71627 14.6574 4.71627C15.9706 4.71627 17.3439 4.95189 17.3439 4.95189V7.92146H15.8303C14.34 7.92146 13.875 8.85225 13.875 9.8069V12.073H17.2031L16.6708 15.563H13.875V24C19.6118 23.0935 24 18.0988 24 12.073Z' fill='#414143' />
                                            </svg>
                                            </a>
                                            <a href='https://api.whatsapp.com/send?text=".$row['pro_title']." https%3A%2F%2Fwww.mainlandsolar.com%2Fdetails%2F".$row['pro_slug']."' class='dark-link'>
                                            <svg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'>
                                                <path d='M12.031 6.172C8.85 6.172 6.264 8.758 6.263 11.938C6.262 13.236 6.643 14.208 7.282 15.225L6.7 17.353L8.882 16.78C9.86 17.36 10.793 17.708 12.027 17.709C15.205 17.709 17.794 15.122 17.795 11.943C17.796 8.756 15.22 6.173 12.031 6.172ZM15.423 14.416C15.279 14.821 14.586 15.19 14.253 15.24C13.954 15.285 13.576 15.303 13.161 15.171C12.909 15.091 12.586 14.984 12.173 14.806C10.434 14.055 9.299 12.304 9.212 12.189C9.125 12.073 8.504 11.249 8.504 10.396C8.504 9.543 8.952 9.123 9.111 8.95C9.27 8.777 9.457 8.733 9.573 8.733L9.905 8.739C10.011 8.744 10.154 8.699 10.295 9.037C10.439 9.384 10.786 10.237 10.829 10.324C10.872 10.411 10.901 10.512 10.843 10.628C10.785 10.744 10.756 10.816 10.67 10.917L10.41 11.221C10.323 11.307 10.233 11.401 10.334 11.575C10.435 11.749 10.783 12.316 11.298 12.776C11.96 13.367 12.519 13.55 12.692 13.636C12.865 13.722 12.966 13.708 13.068 13.593C13.169 13.477 13.501 13.087 13.617 12.913C13.733 12.74 13.848 12.768 14.007 12.826C14.166 12.884 15.018 13.303 15.191 13.39C15.364 13.477 15.48 13.52 15.523 13.592C15.568 13.664 15.568 14.011 15.423 14.416ZM12 0C5.373 0 0 5.373 0 12C0 18.627 5.373 24 12 24C18.627 24 24 18.627 24 12C24 5.373 18.627 0 12 0ZM12.029 18.88C10.868 18.88 9.724 18.588 8.711 18.036L5.034 19L6.018 15.405C5.411 14.353 5.091 13.159 5.092 11.937C5.093 8.112 8.205 5 12.029 5C13.885 5.001 15.627 5.723 16.936 7.034C18.246 8.345 18.967 10.088 18.966 11.942C18.965 15.767 15.853 18.88 12.029 18.88Z' fill='#414143' />
                                            </svg>
                                            </a>
                                            <a href='https://twitter.com/intent/tweet?url=https%3A%2F%2Fwww.mainlandsolar.com%2Fdetails%2F".$row['pro_slug']."&text=".$row['pro_title']."&via=mainlandsolar' class='dark-link'>
                                            <svg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'>
                                                <path d='M12 0C5.373 0 0 5.373 0 12C0 18.627 5.373 24 12 24C18.627 24 24 18.627 24 12C24 5.373 18.627 0 12 0ZM18.066 9.645C18.249 13.685 15.236 18.189 9.902 18.189C8.28 18.189 6.771 17.713 5.5 16.898C7.024 17.078 8.545 16.654 9.752 15.709C8.496 15.686 7.435 14.855 7.068 13.714C7.519 13.8 7.963 13.775 8.366 13.665C6.985 13.387 6.031 12.143 6.062 10.812C6.45 11.027 6.892 11.156 7.363 11.171C6.084 10.316 5.722 8.627 6.474 7.336C7.89 9.074 10.007 10.217 12.394 10.337C11.975 8.541 13.338 6.81 15.193 6.81C16.018 6.81 16.765 7.159 17.289 7.717C17.943 7.589 18.559 7.349 19.113 7.02C18.898 7.691 18.443 8.253 17.85 8.609C18.431 8.539 18.985 8.385 19.499 8.156C19.115 8.734 18.629 9.24 18.066 9.645Z' fill='#414143' />
                                            </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class='col-12 col-lg-7'>
                                    <div class='product-info h-100'>
                                        <h5>".$row['pro_title']."</h5>
                                        <div class='star-rating'>".$rating."</div>
                                        <div class='product-price bold-600'>
                                            <span class='label'>Price:</span>₦&nbsp;<span class='value'>7000</span>
                                        </div>
                                        <hr />
                                        <ul class='product-spec list-style-none px-0 my-0'>
                                            <li>SKU: SO442HL15ZRYMNAFAMZ</li>
                                            <li>Features: Wall Mounted</li>
                                            <li> Color: BLACK</li>
                                            <li> Main Material: ELEMENT</li>
                                            <li> Model: 2020</li>
                                            <li> Product Line: Arthur</li>
                                            <li> Weight (kg): 14</li>
                                        </ul>
                                        <hr />
                                        <div class='product-qty bold-600'>
                                            <span class='label'>Quantity:</span>
                                            <div>
                                                <div class='inner qty-ctrl'>
                                                    <button class='btn btn-sm decreament-btn'>-</button>
                                                    <div class='count'>1</div>
                                                    <button class='btn btn-sm increament-btn'>+</button>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class='action user-action'>
                                            <div class='add-to-cart'>
                                                <button class='btn btn-white'>ADD TO CART</button>
                                            </div>
                                            <div class='add-to-wishlist'>
                                                <button class='btn btn-white alt-warning'>
                                                    <i class='fas fa-heart'></i>
                                                </button>
                                            </div>
                                        </div>
                                        <hr class='mb-0' />
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="overlay"></div>
</main>
<?php include_once("../inc/footer.nav.php"); ?>