<?php include_once("inc/header.inc.php") ; ?>
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>
                            Create Admin User<small>Mainlandsolar Admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="dashboard"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">create user</li>
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
                        <h5>Account Details</h5>
                    </div>
                    <div class="card-body">
                        <form name="createUser" id="createUser" class="needs-validation">
                            <div class="form-group row">
                                <label for="username" class="col-xl-3 col-md-4"><span>*</span> User Name</label>
                                <input class="form-control col-xl-8 col-md-7" id="username" type="text" name="username">
                                <input type="hidden" name="action_code" value="401">
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-xl-3 col-md-4"><span>*</span> Password</label>
                                <input class="form-control col-xl-8 col-md-7" id="password" type="password" name="password">
                                <div class="errorPass offset-md-4 offset-xl-3"></div>
                            </div>
                            <div class="form-group row">
                                <label for="confirm_password" class="col-xl-3 col-md-4"><span>*</span> Confirm Password</label>
                                <input class="form-control col-xl-8 col-md-7" id="confirm_password" type="password" name="confirm_password">
                                <div class="errorCPass offset-md-4 offset-xl-3"></div>
                            </div>
                            <div class="pull-left">
                                <button type="submit" id="createUserBtn" class="btn btn-primary">
                                    <i class="fa fa-spinner fa-spin mr-3 d-none"></i>Create Admin Account
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php include_once("inc/footer.inc.php") ; ?>
<script src="assets/js/admin-form-reducer.js"></script>
