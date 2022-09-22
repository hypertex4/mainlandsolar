<?php require_once('inc/header.inc.php'); ?>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Energy Audit Transfer<small>Mainlandsolar Admin panel</small></h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="dashboard"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Audit Pending Transfer</li>
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
                        <h5>Pending Transfer</h5>
                    </div>
                    <div class="card-body order-datatable">
                        <table class="table table-bordered display" id="basic-1">
                            <thead>
                            <tr>
                                <th>Book ID</th>
                                <th>Customer Email</th>
                                <th>Account Name</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $req = $admin->energy_audit_transfer_request();
                            if ($req->num_rows > 0) {$n=0;
                                while ($request = $req->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td>#<?=$request['payment_ref']?></td>
                                        <td><?=$request['email']?></td>
                                        <td><?=$request['account_name']?></td>
                                        <td>₦<?=number_format($request['transferred_amount'],0)?></td>
                                        <td><?=($request['transferred_status']==0)?
                                                '<span class="badge badge-danger">Pending</span>':
                                                '<span class="badge badge-success">Confirmed</span>';?></td>
                                        <td><?= date('M j, Y', strtotime($request['transferred_on'])); ?></td>
                                        <td>
                                            <?php if ($request['transferred_status']==0){ ?>
                                                <button class="btn btn-success" id="audit_transfer_status" type="button"
                                                        data-aud_pay_id="<?=$request['aud_pay_id'];?>" data-aud_book_sno="<?=$request['aud_book_sno'];?>">
                                                    Mark as Confirm
                                                </button>
                                            <?php } else { ?>
                                                <button style="cursor:not-allowed" disabled class="btn btn-outline-primary btn-xs px-3 py-1">Confirmed</button>
                                            <?php }  ?>
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
<script src="assets/js/admin-form-reducer.js"></script>
<script>
    $(document).ready(function() {
        $('#basic-1').DataTable({bSort:false});

        $(".display").on("click",'#audit_transfer_status',function (e) {
            e.preventDefault();
            var r = confirm("Are you sure you want to update energy audit payment status?");
            if (r===true){
                var aud_pay_id = $(this).data('aud_pay_id');
                var aud_book_sno = $(this).data('aud_book_sno');
                var action = 102;
                $.get("audit-action.php?aud_pay_id="+aud_pay_id+"&aud_book_sno="+aud_book_sno+"&action="+action, function () {
                    toastr["success"]('Transfer marked as paid');
                    setTimeout(function () {window.location.replace('audit-pending-payment');},2000);
                });
            }
        });
    });
</script>
