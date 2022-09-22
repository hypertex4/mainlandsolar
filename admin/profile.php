<?php include_once("inc/header.inc.php") ; ?>
<div class="page-body">
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <div class="page-header-left">
                    <h3>
                        Profile<small>Mainlandsolar Admin panel</small>
                    </h3>
                </div>
            </div>
            <div class="col-lg-6">
                <ol class="breadcrumb pull-right">
                    <li class="breadcrumb-item"><a href="dashboard"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Settings</li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="profile-details text-center">
                        <img src="./assets/img/dashboard/avatar.png" alt="" class="img-fluid img-90 rounded-circle blur-up lazyloaded">
                        <h5 class="f-w-600 mb-0"><?= $_SESSION['ADMIN_LOGIN']['ADMIN_USERNAME']; ?></h5>
                        <span></span>
                        <div class="social">
                            <div class="form-group btn-showcase">
                                <button class="btn social-btn btn-fb d-inline-block"> <i class="fa fa-facebook"></i></button>
                                <button class="btn social-btn btn-twitter d-inline-block"><i class="fa fa-google"></i></button>
                                <button class="btn social-btn btn-google d-inline-block mr-0"><i class="fa fa-twitter"></i></button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="project-status">
                        <h5 class="f-w-600">Admin User Status</h5>
                        <div class="media">
                            <div class="media-body">
                                <h6>Performance<span class="pull-right">80%</span></h6>
                                <div class="progress sm-progress-bar">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 90%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card tab2-card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-material">
                        <li class="nav-item"><a class="nav-link active">Profile</a></li>
                    </ul>
                    <div>
                        <div class="table-responsive profile-table">
                            <table class="table table-responsive">
                                <tbody>
                                    <tr>
                                        <td>Username:</td>
                                        <td><?= $_SESSION['ADMIN_LOGIN']['ADMIN_USERNAME']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once("inc/footer.inc.php") ; ?>
<script src="assets/js/admin-form-reducer.js"></script>
