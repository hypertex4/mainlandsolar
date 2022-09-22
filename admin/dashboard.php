<?php require_once('inc/header.inc.php'); ?>
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Dashboard<small>Mainlandsolar panel</small></h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="dashboard"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-md-3">
                <div class="card o-hidden  widget-cards">
                    <div class="bg-secondary card-body">
                        <div class="media static-top-widget">
                            <div class="media-body"><span class="m-0">Products Sales</span>
                                <h4 class="mb-0">₦ <span class="counter"><?= number_format($admin->today_booking_amt(),0);?></span><small> Today</small></h4>
                            </div>
                            <div class="icons-widgets">
                                <i data-feather="box"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-4">
                <div class="card o-hidden  widget-cards">
                    <div class="bg-secondary card-body">
                        <div class="media static-top-widget">
                            <div class="media-body"><span class="m-0">Products Sales</span>
                                <h4 class="mb-0">₦ <span class="counter"><?= number_format($admin->month_booking_amt(),0);?></span><small> This Month</small></h4>
                            </div>
                            <div class="icons-widgets">
                                <i data-feather="box"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-md-5 xl-40">
                <div class="card o-hidden  widget-cards">
                    <div class="bg-secondary card-body">
                        <div class="media static-top-widget">
                            <div class="media-body"><span class="m-0">Total Products Sales</span>
                                <h4 class="mb-0">₦ <span class="counter"><?=number_format($admin->total_booking_amt(),0);?></span><small> Total</small></h4>
                            </div>
                            <div class="icons-widgets">
                                <i data-feather="box"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-md-4">
                <div class="card o-hidden widget-cards">
                    <div class="bg-primary card-body">
                        <div class="media static-top-widget">
                            <div class="media-body"><span class="m-0">Total Orders</span>
                                <h3 class="mb-0"><span class="counter"><?=$admin->count_all_order();?></span><small> No of Orders</small></h3>
                            </div>
                            <div class="icons-widgets">
                                <i data-feather="message-square"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-4">
                <div class="card o-hidden widget-cards">
                    <div class="bg-warning card-body">
                        <div class="media static-top-widget">
                            <div class="media-body"><span class="m-0">Customers</span>
                                <h3 class="mb-0"><span class="counter"><?=$admin->count_customer();?></span><small> Total Customer</small></h3>
                            </div>
                            <div class="icons-widgets"><i data-feather="users"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-4">
                <div class="card o-hidden widget-cards">
                    <div class="bg-success card-body">
                        <div class="media static-top-widget">
                            <div class="media-body"><span class="m-0">Total Product</span>
                                <h3 class="mb-0"><span class="counter"><?=$admin->count_all_product();?></span><small> No of Product</small></h3>
                            </div>
                            <div class="icons-widgets"><i data-feather="bookmark"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-md-6 xl-50 mx-auto">
                <div class="card o-hidden  widget-cards">
                    <div class="bg-danger card-body">
                        <div class="media static-top-widget">
                            <div class="media-body"><span class="m-0">Pending Payment(Transfer Request)</span>
                                <h3 class="mb-0">₦ <span class="counter"><?= number_format($admin->pending_transfer_request(),0);?></span><small> Pending</small></h3>
                            </div>
                            <div class="icons-widgets">
                                <i data-feather="lock"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 xl-100">
                <div class="card">
                    <div class="card-header">
                        <h5>Latest Orders</h5>
                    </div>
                    <div class="card-body">
                        <div class="user-status table-responsive latest-order-table">
                            <table class="table table-bordernone">
                                <thead>
                                <tr>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Order Total</th>
                                    <th scope="col">Payment Method</th>
                                    <th scope="col">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $ord = $admin->list_latest_five_orders();
                                if ($ord->num_rows > 0) {$n=0;
                                while ($order = $ord->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?=++$n;?></td>
                                    <td class="font-success digits">₦ <?=number_format($order['order_amount'],0);?></td>
                                    <td class="font-info"><?= $order['payment_option']?></td>
                                    <td class="digits"><?=$order['order_status']?></td>
                                </tr>
                            <?php } } ?>
                                </tbody>
                            </table>
                            <a href="orders" class="btn btn-primary">View All Orders</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
<?php require_once('inc/footer.inc.php'); ?>