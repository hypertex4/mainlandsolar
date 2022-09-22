<?php include_once("inc/header.inc.php") ; ?>
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>
                            Customer List<small>Mainlandsolar Admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="dashboard"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Customer List</li>
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
                        <h5>Customer List</h5>
                    </div>
                    <div class="card-body">
                        <table class="display" id="Category">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>FirstName</th>
                                <th>LastName</th>
                                <th>Email ID</th>
                                <th>Phone Number</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $usr = $admin->list_customers();
                            if ($usr->num_rows > 0) {
                                while ($user = $usr->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td>#<?= $user['customer_id'];?></td>
                                        <td><h6><?= $user['firstname']; ?></h6></td>
                                        <td><h6><?= $user['lastname']; ?></h6></td>
                                        <td><h6><?= $user['email']; ?></h6></td>
                                        <td><h6><?= $user['mobile']; ?></h6></td>
                                        <td>
                                            <h6>
                                                <?= ($user['active']==1)?
                                                    '<span class="badge badge-success">Active</span>':
                                                    '<span class="badge badge-danger">Pending Activation</span>'; ?>
                                            </h6>
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
