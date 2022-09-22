<?php require_once('inc/header.inc.php'); ?>
<style>
    .jconfirm-box{background:#f8f8f9 !important;}
</style>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>
                            Audit Bookings<small>Mainlandsolar Admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="dashboard"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Audit Bookings</li>
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
                        <h5>Manage Audit Booking</h5>
                    </div>
                    <div class="card-body order-datatable">
                        <table class="table table-bordered display" id="basic-1" style="font-size: 10px;">
                            <thead>
                            <tr>
                                <th>s/no</th>
                                <th>Book ID</th>
                                <th>Client Name</th>
                                <th>Phone No</th>
                                <th>Email Address</th>
                                <th>Survey Address/Location</th>
                                <th>Pry Purpose</th>
                                <th>Panel Space</th>
                                <th>Booking Date</th>
                                <th>Booking Time</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $ord = $admin->list_audit_bookings();
                            if ($ord->num_rows > 0) { $n = 0;
                                while ($order = $ord->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?=++$n;?></td>
                                        <td><?=$order['payment_ref'];?></td>
                                        <td><?=$order['client_name'];?></td>
                                        <td><?=$order['phone_no'];?></td>
                                        <td><?=$order['email'];?></td>
                                        <td><?=$order['survey_address'];?>, <?=(trim($order['survey_location'])=='')?$order['survey_other_loc']:$order['survey_location'];?></td>
                                        <td><?=$order['pry_purpose'];?></td>
                                        <td><?=$order['panel_space'];?></td>
                                        <td><?=$order['b_date'];?></td>
                                        <td><?=$order['b_time'];?></td>
                                        <td>
                                            <?=($order['payment_status']=='Unverified')?
                                                '<span class="badge badge-secondary">Unverified</span>':
                                                '<span class="badge badge-success">Paid</span>';?>
                                        </td>
                                    </tr>
                                <?php } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once('inc/footer.inc.php'); ?>
<script>
    $(document).ready(function() { $('#basic-1').DataTable({
        bSort:false
    }); });
</script>
