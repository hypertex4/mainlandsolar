<?php require_once('inc/header.inc.php'); ?>
<style>
    .jconfirm-box{background:#f8f8f9 !important;}
</style>
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>
                            Order List<small>Mainlandsolar Admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="dashboard"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Order</li>
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
                    <div class="card-header">
                        <h5>Manage Order</h5>
                    </div>
                    <div class="card-body order-datatable">
                        <table class="display" id="basic-1">
                            <thead>
                                <tr>
                                    <th>Order Id</th>
                                    <th>Product</th>
                                    <th>Pay Status</th>
                                    <th>Pay Method</th>
                                    <th>Order Status</th>
                                    <th>Customer</th>
                                    <th>Customer Email</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Order Details</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $ord = $admin->list_orders();
                            if ($ord->num_rows > 0) {
                            while ($order = $ord->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td>#<?=$order['order_ref'];?></td>
                                    <td>
                                        <div class="d-flex">
                                        <?php $det = $admin->list_ordered_items($order['order_id']);if ($det->num_rows > 0) {while ($detail = $det->fetch_assoc()) {?>
                                        <img src="./<?=$detail['pro_image1'];?>" alt="" class="img-fluid img-30 mr-2 blur-up lazyloaded">
                                        <?php } }?>
                                        </div>
                                    </td>
                                    <td><?=($order['payment_status']=='Unverified')?
                                            '<span class="badge badge-secondary">Unverified</span>':
                                            '<span class="badge badge-success">Paid</span>';?></td>
                                    <td><?=$order['payment_option']; ?></td>
                                    <td>
                                        <?php if ($order['order_status']=='New Order'){ ?>
                                            <span class="badge badge-light">New Order</span>
                                        <?php } elseif ($order['order_status']=='Processing/shipped'){ ?>
                                            <span class="badge badge-secondary">Processing/shipped</span>
                                        <?php } elseif ($order['order_status']=='Delivered'){ ?>
                                            <span class="badge badge-success">Delivered</span>
                                        <?php } ?>
                                    </td>
                                    <td><?=$order['firstname'].' '.$order['lastname']; ?></td>
                                    <td><?=$order['email']; ?></td>
                                    <td><?= date('M j, Y', strtotime($order['order_on'])); ?></td>
                                    <td>₦ <?=number_format($order['order_amount'],0);?></td>
                                    <td class="text-info">
                                        <i data-feather="folder-plus" style="cursor: pointer;"
                                           onclick="detailsModal(<?=$order['order_id'];?>,
                                                   '<?=$order['receiver_address'].','.$order['receiver_state'];?>',
                                                    '<?=$order['receiver_phone'];?>',
                                                   '<?=$order['receiver_fname'].' '.$order['receiver_lname'];?>',
                                                   '<?=$order['receiver_email'];?>')"></i>
                                    </td>
                                    <td>
                                    <?php if ($order['payment_status']=='Paid' && $order['order_status'] !='Delivered'){ ?>
                                        <button class="btn btn-success" type="button" id="order_status" data-id="<?=$order['order_id'];?>">
                                            <i class="fa fa-spinner fa-spin mr-3 d-none"></i>Mark as Delivered
                                        </button>
                                    <?php } ?>
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
    <?php require_once('inc/footer.inc.php'); ?>
    <script src="assets/js/admin-form-reducer.js"></script>
    <script>
        $(document).ready(function() {
            $('#basic-1').DataTable();

            $(".display").on("click",'#order_status',function (e) {
                e.preventDefault();
                var r = confirm("Are you sure you want to update status?");
                if (r===true){
                    var order_id = $(this).data('id');
                    $.get("order-action.php?order_id="+order_id, function () {
                        toastr["success"]('Order status updated and mark as delivered');
                        setTimeout(function () {window.location.replace('orders');},2000);
                    });
                }
            });
        });
        
        function detailsModal(id,add,phone,name,email) {
            $.confirm({
                title: 'Order Item Details',
                content: 'url:http://localhost/mainlandsolar/admin/getOrderItems.php?order_id='+id,
                onContentReady: function () {
                    this.setContentPrepend('<div class="mt-2 mb-2"><span>Receiver\'s Email: </span><span class="font-weight-bold">'+email+'</span></div>');
                    this.setContentPrepend('<div class="mt-2"><span>Shipping Address: </span><span class="font-weight-bold">'+add+'</span></div>');
                    this.setContentPrepend('<div class="mt-2"><span>Receiver\'s Phone: </span><span class="font-weight-bold">'+phone+'</span></div>');
                    this.setContentPrepend('<div><span>Receiver\'s Name: </span><span class="font-weight-bold">'+name+'</span></div>');
                },
                columnClass: 'large',
                containerFluid: true,
            });
        }
    </script>
