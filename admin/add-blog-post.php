<?php include_once("inc/header.inc.php") ; ?>
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>
                            ADD BLOG POST<small>Mainlandsolar Admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="dashboard"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Blog</li>
                        <li class="breadcrumb-item active">Add</li>
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
                        <h5>Blog Details</h5>
                    </div>
                    <form name="createBlog" id="createBlog">
                        <div class="card-body">
                            <div class="digital-add needs-validation">
                                <div class="row">
                                    <div class="form-group col-md-8">
                                        <label for="title" class="col-form-label pt-0"><span>*</span> Post Title</label>
                                        <input class="form-control prep_slug" id="title" name="title" type="text">
                                        <input type="hidden" name="action_code" value="801">
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
                                                    <option value="<?=$category['category_id'];?>"><?=$category['category_name'];?></option>
                                                <?php } }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="slug" class="col-form-label pt-2"><span>*</span> Post SLUG</label>
                                        <input class="form-control" id="slug" name="slug" type="text">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="author" class="col-form-label pt-2"><span>*</span> Post Author</label>
                                        <input type="text" id="author" name="author" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label class="col-form-label pt-2"><span>*</span> Post Featured Image </label>
                                        <input type="file" id="image_1" name="image_1" class="form-control" accept="image/*">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="body" class="col-form-label pt-2"><span>*</span> Post Body</label>
                                        <textarea name="body" id="body" rows="5" cols="12" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col"><hr style="1px solid #ccc" /></div>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="product-buttons text-center">
                                        <button type="submit" class="btn btn-primary" id="createBlogBtn">
                                            <i class="fa fa-spinner fa-spin mr-3 d-none"></i>Create Blog Post
                                        </button>
                                        <button type="reset" class="btn btn-light">Discard</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
        $('input[name="title"]').val(($(this).val()).replace(/[^a-z0-9\s]/gi, ''));
    });
</script>
