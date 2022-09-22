<?php include_once("../inc/header.nav.php");
if (!isset($_SESSION['USER_LOGIN']) && !isset($_SESSION['USER_LOGIN']['customer_id'])) header('Location: ../index');
?>
<main>
    <div id="user-profile-page">
        <div class="bg-white pb-5">
            <div class="container auto-wrapper">
                <ul class="breadcrumb">
                    <li><a href="./">Home</a></li>
                    <li><a href="./account/">My Account</a></li>
                    <li>Profile</li>
                </ul>
                <div class="title-wrapper">
                    <hr class="my-0">
                    <h1 class="title mb-0">MY ACCOUNT</h1>
                    <hr class="my-0">
                </div>
                <div class="my-3">
                    <button class="btn p-0" id="sidebar-toggler"><i class="fas fa-bars"></i></button>
                </div>
                <h6 class="user-greet">
                    HELLO, <?=$_SESSION['USER_LOGIN']['firstname']." ".$_SESSION['USER_LOGIN']['lastname'];?>
                </h6>
                <div id="user-content-wrapper">
                    <div class="sidenav-wrapper">
                        <?php include_once("account-sidenav.php"); ?>
                    </div>
                    <div class="main-content" id="user-account-settings-content">
                        <div class="card rounded-0 mb-3">
                            <div class="card-header">ACCOUNT SETTINGS</div>
                            <div class="card-body">
                                <form name="updateProfile" id="updateProfile">
                                    <div id="response-alert" class="mb-3"></div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="firstname">First Name</label>
                                            <input type="text" class="form-control" id="firstname" name="firstname" value="<?= $_SESSION['USER_LOGIN']['firstname']; ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="lastname">Last Name</label>
                                            <input type="text" class="form-control" id="lastname" name="lastname" value="<?= $_SESSION['USER_LOGIN']['lastname']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="mobile">Phone Number</label>
                                            <input type="text" class="form-control" id="mobile" name="mobile" value="<?= isset($_SESSION['USER_LOGIN']['mobile'])?$_SESSION['USER_LOGIN']['mobile']:''; ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email">Email Address</label>
                                            <input type="text" readonly class="form-control" id="email" name="email" value="<?= $_SESSION['USER_LOGIN']['email']; ?>">
                                        </div>
                                    </div>
                                    <button class="btn btn-white rounded-0 bold" id="updateProBtn">SAVE</button>
                                </form>
                            </div>
                        </div>

                        <!-- Change password -->
                        <div class="card rounded-0">
                            <div class="card-header">CHANGE PASSWORD</div>
                            <div class="card-body">
                                <form name="updatePwd" id="updatePwd">
                                    <div id="response-alert2" class="mb-3"></div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="new_password">New Password</label>
                                            <input type="password" class="form-control" id="new_password" name="new_password">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="repeat_password">Repeat Password</label>
                                            <input type="password" class="form-control" id="repeat_password" name="repeat_password">
                                        </div>
                                    </div>
                                    <button class="btn btn-white rounded-0 bold" id="updatePwdBtn">SAVE</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="overlay"></div>
</main>
<?php include_once("../inc/footer.nav.php"); ?>