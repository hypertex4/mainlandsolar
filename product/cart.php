<?php include_once("../inc/header.nav.php"); ?>
<main>
    <div id="shopping-cart-page">
        <div class="bg-white pb-5">
            <div class="container auto-wrapper show_empty">
                <ul class="breadcrumb">
                    <li><a href="./">Home</a></li>
                    <li>Cart</li>
                </ul>
                <div class="title-wrapper">
                    <hr class="my-0">
                    <h1 class="title mb-0">CART</h1>
                    <hr class="my-0">
                </div>
                <div id="shopping-cart-header">
                    <div class="inner">
                        <div class="image-col">Image</div>
                        <div class="name-col">Product Name</div>
                        <div class="quantity-col">Quantity</div>
                        <div class="price-col">Price</div>
                        <div class="sub-total-col">Sub-total</div>
                    </div>
                </div>

                <div class="show-cart"></div>

                <div id="total-cost">
                    <div class="inner my-4">CART TOTAL: <span>₦&nbsp;</span><span class="sub-total-cart"></span></div>
                </div>
                <div class="proceed-to-checkout-link-wrapper">
                    <a href="./product/checkout" class="btn btn-white my-4 rounded-0">PROCEED TO CHECKOUT</a>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include_once("../inc/footer.nav.php"); ?>