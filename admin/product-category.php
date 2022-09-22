<?php include_once("inc/header.inc.php") ; ?>
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Product Category<small>Mainlandsolar Admin panel</small></h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="dashboard"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Product Category</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Category</h5>
                    </div>
                    <div class="card-body">
                        <div class="btn-popup pull-right">
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-original-title="test" data-target="#exampleModal">Add Product Category</button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title f-w-600" id="exampleModalLabel">Add Product Category</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        </div>
                                        <form name="addCategory" id="addCategory">
                                            <div class="modal-body">
                                                <div class="form">
                                                    <div class="form-group">
                                                        <label for="cat_name" class="font-weight-bold mb-1">Category Name :</label>
                                                        <input class="form-control" id="cat_name" name="cat_name" type="text">
                                                        <input type="hidden" name="action_code" value="101">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-primary" type="submit" id="addCategoryBtn">
                                                    <i class="fa fa-spinner fa-spin mr-3 d-none"></i>Save
                                                </button>
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title f-w-600" id="editModalLabel">Edit Product Category</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        </div>
                                        <form name="updateCategory" id="updateCategory">
                                            <div class="modal-body">
                                                <div class="form">
                                                    <div class="form-group">
                                                        <label for="edit_cat_name" class="font-weight-bold mb-1">Category Name :</label>
                                                        <input class="form-control" id="edit_cat_name" name="edit_cat_name" type="text">
                                                        <input type="hidden" id="edit_cat_id" name="edit_cat_id" value="103">
                                                        <input type="hidden" name="action_code" value="103">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-primary" type="submit" id="updateCategoryBtn">
                                                    <i class="fa fa-spinner fa-spin mr-3 d-none"></i>Update
                                                </button>
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="display" id="Category">
                            <thead>
                            <tr>
                                <th>Category Id</th>
                                <th>Category Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $cat = $admin->list_product_category();
                            if ($cat->num_rows > 0) {
                                while ($category = $cat->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td>#<?= $category['category_id'];?></td>
                                        <td>
                                            <h6><?= $category['category_name']; ?></h6>
                                        </td>
                                        <td>
                                            <div>
                                                <i style="cursor: pointer;" class="fa fa-edit mr-2 font-success" id="edit_category"  data-toggle="modal" data-target="#editModal"
                                                   data-id="<?= $category['category_id']; ?>" data-cat_name="<?= $category['category_name']; ?>">
                                                </i>
                                                <i style="cursor: pointer;" class="fa fa-trash font-danger" id="delete_category" data-id="<?= $category['category_id']; ?>"></i>
                                            </div>
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
            $('#Category').DataTable({
                "searching":false,
                "lengthChange":false,
                "bSort":false
            });
        });
    </script>
