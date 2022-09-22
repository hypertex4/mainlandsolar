<?php
include_once("inc/header.nav.php");
if (isset($_GET['c'])){
    $_SESSION['temp_category_id']=$_GET['c'];
} else {
    $_SESSION['temp_category_id']=3842;
}
?>
<div id="resources-page" class="product_action_filter">
    <div class="bg-white py-5">
        <div class="container auto-wrapper">
            <ul class="breadcrumb">
                <li><a href="../">Home</a></li>
                <li>Resources</li>
            </ul>
            <div id="user-resources-content">
                <div class="inner">
                    <div id="content-wrapper">
                        <ul class="px-0 list-style-none all-resources" id="all-resources">
                            <?php require('filter_resources.php'); ?>
                        </ul>
                    </div>
                    <?php include_once('resources-sidebar.php'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once("inc/footer.nav.php"); ?>
<script src="./assets/js/filter_resources.js"></script>
