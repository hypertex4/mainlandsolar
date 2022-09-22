<?php include_once("../inc/header.nav.php"); ?>
<main>
    <div id="products-page" class="product_action_filter">
        <div class="bg-white">
            <div class="container auto-wrapper">
                <ul class="breadcrumb">
                    <li><a href="./">Home</a></li>
                    <li>Products</li>
                </ul>
                <div id="sort-options">
                    <div class="inner">
                        <div id="sort-input">
                            <div class="input-group">
                                <input type="text" class="form-control border-0 search" placeholder="Search for product" aria-label="Search for product">
                                <div class="input-group-append">
                                    <button class="btn product_check" type="button" id="button-addon2">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.4479 15.4479C14.8257 16.0702 13.8124 16.0702 13.1902 15.4479L10.2568 12.5146C9.22571 13.1546 8.01682 13.5102 6.70127 13.5102C2.95016 13.5102 -0.0898438 10.4702 -0.0898438 6.70127C-0.0898438 2.93238 2.95016 -0.0898438 6.70127 -0.0898438C10.4524 -0.0898438 13.5102 2.95016 13.5102 6.70127C13.5102 7.99905 13.1368 9.20794 12.5146 10.2568L15.4479 13.1902C16.0702 13.8124 16.0702 14.8257 15.4479 15.4479ZM6.70127 1.90127C4.05238 1.90127 1.90127 4.05238 1.90127 6.70127C1.90127 9.35016 4.05238 11.5013 6.70127 11.5013C9.35016 11.5013 11.5013 9.35016 11.5013 6.70127C11.5013 4.05238 9.36793 1.90127 6.70127 1.90127Z" fill="#414143" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div id="sort-select-dropdown">
                            <div class="label">Sort by:</div>
                            <div class="sort-radios">
                                <div id="selected">Recommended</div>
                                <div class="dropdown-wrapper">
                                    <ul class="dropdown list-style-none">
                                        <li>
                                            <input type="radio" name="sort" id="newArrival" class="sort-radio product_check sortBy" value="">
                                            <label for="newArrival">New arrival</label>
                                        </li>
                                        <li>
                                            <input type="radio" name="sort" id="highToLow" class="sort-radio product_check sortBy" value="asc">
                                            <label for="highToLow">Price: Lowest to Highest</label>
                                        </li>
                                        <li>
                                            <input type="radio" name="sort" id="lowToHigh" class="sort-radio product_check sortBy" value="desc">
                                            <label for="lowToHigh">Price: Highest to lowest</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <section id="product-list">
                    <div class="inner product_click">
                        <div class="row no-gutters all-products" id="all-products">
                            <?php require('filter_products.php'); ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</main>
<?php include_once("../inc/footer.nav.php"); ?>
<script src="./assets/js/filter_product.js"></script>
