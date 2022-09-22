<?php require_once('inc/header.inc.php'); ?>
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Payment Transactions List<small>Mainlandsolar Admin panel</small></h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="dashboard"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Payment</li>
                        <li class="breadcrumb-item active">List</li>
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
                    <div class="card-header"><h5>Payment Transactions</h5></div>
                    <div class="card-body order-datatable">
                        <table class="display" id="basic-1">
                            <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Payment Ref</th>
                                <th>Email</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Status</th>
                                <th>Order On</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $pay = $admin->payments();
                            if ($pay->num_rows > 0) {
                            while ($payment = $pay->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td>#<?=$payment['order_ref']?></td>
                                    <td><?=$payment['payment_ref']?></td>
                                    <td><?=$payment['email']?></td>
                                    <td>₦<?=number_format($payment['payment_amount'],0)?></td>
                                    <td><?=$payment['payment_option']?></td>
                                    <td><?=($payment['payment_status']=='Unverified')?
                                            '<span class="badge badge-danger">Unverified</span>':
                                            '<span class="badge badge-success">Paid</span>';?></td>
                                    <td><?= date('F j, Y', strtotime($payment['order_on'])); ?></td>
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
