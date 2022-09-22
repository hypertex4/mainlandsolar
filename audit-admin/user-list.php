<?php include_once("inc/header.inc.php") ; ?>
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>
                            Admin User List<small>Mainlandsolar Admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="dashboard"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Admin User List</li>
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
                        <h5>Admin User List</h5>
                    </div>
                    <div class="card-body">
                        <div class="btn-popup pull-right">
                            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title f-w-600" id="editModalLabel">Edit Admin Role</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        </div>
                                        <form name="updateAdmUser" id="updateAdmUser">
                                            <div class="modal-body">
                                                <div class="form">
                                                    <div class="form-group">
                                                        <label for="edit_adm_username" class="font-weight-bold mb-1">UserName :</label>
                                                        <input class="form-control" id="edit_adm_username" name="edit_adm_username" type="text">
                                                        <input type="hidden" id="edit_adm_id" name="edit_adm_id">
                                                        <input type="hidden" name="action_code" value="403">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-primary" type="submit" id="updateAdmUserBtn">
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
                                <th>#</th>
                                <th>Admin Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $adm = $admin->list_admin_users();
                            if ($adm->num_rows > 0) {
                                while ($admin = $adm->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td>#<?= $admin['admin_id'];?></td>
                                        <td><h6><?= $admin['admin_username']; ?></h6></td>
                                        <td>
                                            <div>
                                                <i style="cursor: pointer;" class="fa fa-edit mr-2 font-success" id="edit_adm_user"  data-toggle="modal" data-target="#editModal"
                                                   data-id="<?=$admin['admin_id'];?>" data-user="<?=$admin['admin_username'];?>">
                                                </i>
                                                <i style="cursor: pointer;" class="fa fa-trash font-danger" id="delete_adm_user" data-id="<?=$admin['admin_id']; ?>"></i>
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
