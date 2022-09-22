<?php require_once('inc/header.inc.php'); ?>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Audit Payment Transactions<small>Mainlandsolar Admin panel</small></h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="dashboard"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Audit Payment</li>
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
                    <div class="card-header"><h5>Audit Payment Transactions</h5></div>
                    <div class="card-body order-datatable">
                        <table class="table table-bordered display" id="basic-1">
                            <thead>
                            <tr>
                                <th>Payment Ref</th>
                                <th>Email</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Status</th>
                                <th>Booked On</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $pay = $admin->list_audit_bookings();
                            if ($pay->num_rows > 0) {
                                while ($payment = $pay->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?=$payment['payment_ref']?></td>
                                        <td><?=$payment['email']?></td>
                                        <td>₦<?=number_format($payment['payment_amount'],0)?></td>
                                        <td><?=$payment['payment_method']?></td>
                                        <td><?=($payment['payment_status']=='Unverified')?
                                                '<span class="badge badge-danger">Unverified</span>':
                                                '<span class="badge badge-success">Paid</span>';?></td>
                                        <td><?= date('F j, Y', strtotime($payment['b_created_on'])); ?></td>
                                    </tr>
                                <?php } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once('inc/footer.inc.php'); ?>
    <script src="assets/js/admin-form-reducer.js"></script>
    <script>
        $(document).ready(function() {
            $('#basic-1').DataTable({bSort:false});
        });
    </script>
