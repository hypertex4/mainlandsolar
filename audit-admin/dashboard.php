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
            <div class="col-xl-4 col-md-4">
                <div class="card o-hidden  widget-cards">
                    <div class="bg-secondary card-body">
                        <div class="media static-top-widget">
                            <div class="media-body"><span class="m-0">Total Audit Amount</span>
                                <h4 class="mb-0">₦ <span class="counter"><?= number_format($admin->total_audit_booking(),0);?></span><small> Total Amount</small></h4>
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
                    <div class="bg-success card-body">
                        <div class="media static-top-widget">
                            <div class="media-body"><span class="m-0">Paid Audit Amount</span>
                                <h4 class="mb-0">₦ <span class="counter"><?= number_format($admin->total_paid_audit_booking(),0);?></span><small> Paid Booking</small></h4>
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
                    <div class="bg-danger card-body">
                        <div class="media static-top-widget">
                            <div class="media-body"><span class="m-0">Pending Audit Amount</span>
                                <h4 class="mb-0">₦ <span class="counter"><?=number_format($admin->total_pending_audit_booking(),0);?></span><small> Pending Booking</small></h4>
                            </div>
                            <div class="icons-widgets">
                                <i data-feather="box"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-xl-4 col-md-4">
                <div class="card o-hidden widget-cards">
                    <div class="bg-info card-body">
                        <div class="media static-top-widget">
                            <div class="media-body"><span class="m-0">Audit Booking</span>
                                <h3 class="mb-0"><span class="counter"><?=$admin->count_all_audit_request();?></span><small> No of Bookings</small></h3>
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
                            <div class="media-body"><span class="m-0">Paid Audit Booking</span>
                                <h3 class="mb-0"><span class="counter"><?=$admin->count_paid_audit_request();?></span><small> Paid Booking</small></h3>
                            </div>
                            <div class="icons-widgets"><i data-feather="users"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-4">
                <div class="card o-hidden widget-cards">
                    <div class="bg-dark card-body">
                        <div class="media static-top-widget">
                            <div class="media-body"><span class="m-0">Pending Audit Booking</span>
                                <h3 class="mb-0"><span class="counter"><?=$admin->count_pending_audit_request();?></span><small> Pending Booking</small></h3>
                            </div>
                            <div class="icons-widgets"><i data-feather="bookmark"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
<?php require_once('inc/footer.inc.php'); ?>