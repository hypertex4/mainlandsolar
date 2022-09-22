<?php include_once("inc/header.inc.php") ; ?>
<?php
if (!isset($_GET['postId']) || $_GET['postId'] == NULL ) {
    echo "<script>window.location = 'blog-post'; </script>";
} else {
    $postId = $_GET['postId'];
}
?>
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>
                            EDIT BLOG POST<small>Mainlandsolar Admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="dashboard"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Blog</li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
    <div class="container-fluid">
        <div class="row product-adding">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Post Details</h5>
                    </div>
                    <?php
                    $post=$admin->get_blog_post_by_id($postId);
                    if ($post->num_rows > 0) {
                        while ($value = $post->fetch_assoc()) {
                            ?>
                            <form name="editBlog" id="editBlog">
                                <div class="card-body">
                                    <div class="digital-add needs-validation">
                                        <div class="row">
                                            <div class="form-group col-md-8">
                                                <label for="title" class="col-form-label pt-0"><span>*</span> Post Title</label>
                                                <input class="form-control prep_slug" id="title" name="title" type="text" value="<?=$value['post_title']; ?>">
                                                <input id="p_id" name="p_id" type="hidden" value="<?=$value['post_id']; ?>">
                                                <input type="hidden" name="action_code" value="803">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="category" class="col-form-label pt-0"><span>*</span> Post Categories</label>
                                                <select class="custom-select" name="category" id="category">
                                                    <option value="">--Select Category--</option>
                                                    <?php
                                                    $cat = $admin->list_blog_category();
                                                    if ($cat->num_rows > 0) {
                                                        while ($category = $cat->fetch_assoc()) {
                                                            ?>
                                                            <option <?=($value['post_cat']==$category['category_id'])?'selected':'';?> value="<?=$category['category_id'];?>"><?=$category['category_name'];?></option>
                                                        <?php } }?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="slug" class="col-form-label pt-0"><span>*</span> Post SLUG</label>
                                                <input class="form-control" id="slug" name="slug" type="text" value="<?=$value['post_slug'];?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="author" class="col-form-label pt-2"><span>*</span> Post Author</label>
                                                <input type="text" id="author" name="author" class="form-control" value="<?=$value['post_author'];?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="body" class="col-form-label pt-2"><span>*</span> Post Body</label>
                                                <textarea name="body" id="body" rows="5" cols="12" class="form-control"><?=$value['post_body'];?></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="col-form-label pt-2"><span>*</span> Post Featured Image</label>
                                                <input type="file" id="image_1" name="image_1" class="form-control" accept="image/*">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <div style="border: 2px dotted #ccc;padding: 15px;"><img style="max-height: 70px;" src="<?= $value['post_image1'];?>" alt=""></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col"><hr style="1px solid #ccc" /></div>
                                        </div>
                                        <div class="form-group mb-0">
                                            <div class="product-buttons text-center">
                                                <button type="submit" class="btn btn-success" id="editBlogBtn">
                                                    <i class="fa fa-spinner fa-spin mr-3 d-none"></i>Update Product
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <?php } } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once("inc/footer.inc.php") ; ?>
<script src="assets/js/admin-form-reducer.js"></script>
<script>
    $('.prep_slug').on('blur', function () {
        $('input[name="slug"]').val(($(this).val()).replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g,'-').toLowerCase());
    });
    $("#category").on('change', function () {
        $("#subcategory").load("inc/subCatGetter.php?cat_id=" + $("#category").val());
    });
</script>
