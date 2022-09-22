<?php include_once("inc/header.inc.php") ; ?>
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Blog Posts<small>Mainlandsolar Admin panel</small></h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="dashboard"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Blog</li>
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Blog List</h5>
                    </div>
                    <div class="card-body">
                        <table class="display" id="Product" style="font-size: 12px">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th></th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $posts = $admin->list_blog_posts();
                            if ($posts->num_rows > 0) {
                                while ($post = $posts->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td class="font-weight-bold"><a href="edit-post/<?= $post['post_id']; ?>">#<?= $post['post_id'];?></a></td>
                                        <td><img src="<?=$post['post_image1'];?>" alt="" style="height: 50px; width: 50px;"></td>
                                        <td><a href="edit-post/<?= $post['post_id']; ?>"><?=$post['post_title'];?></a></td>
                                        <td><?=$post['category_name'];?></td>
                                        <td><?=$post['post_author'];?></td>
                                        <?php if ($post['post_active'] =="0") { ?>
                                            <td><span class="badge badge-danger">In-Active</span></td>
                                        <?php } elseif ($post['post_active'] =="1") { ?>
                                            <td><span class="badge badge-success">Active</span></td>
                                        <?php } ?>
                                        <td>
                                            <?php if ($post['post_active'] =="0"){ ?>
                                            <div style="display: flex;">
                                                <button type="button" class="btn btn-sm btn-success" id="ApprovedBlogBtn" data-id="<?= $post['post_id'];?>"
                                                        data-status="1"><i class="fa fa-spinner fa-spin mr-3 d-none"></i> Enable</button>
                                                <?php } else if ($post['post_active'] =="1"){ ?>
                                                    <div>
                                                        <button type="button" class="btn btn-sm btn-danger" id="ApprovedBlogBtn" data-id="<?= $post['post_id'];?>"
                                                                data-status="0"><i class="fa fa-spinner fa-spin mr-3 d-none"></i> Disable</button></div>
                                                <?php } ?>
                                        </td>
                                    </tr>
                                <?php } }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once("inc/footer.inc.php") ; ?>
    <script src="assets/js/admin-form-reducer.js"></script>
    <script>
        $(document).ready(function() {
            $('#Product').DataTable({
                "bSort":false
            });
        });
    </script>
