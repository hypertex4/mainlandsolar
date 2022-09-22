<?php
include_once("../inc/header.main.php");
if (!isset($_SESSION['USER_LOGIN']) && !isset($_SESSION['USER_LOGIN']['customer_id'])) header('Location: ../index');
?>
</div>
<div class="container mt-md-5 w-100 user_account" id="">
    <div class="row no-gutters">
        <div class="col-3"><?php include_once 'account-sidebar.php'; ?></div>
        <div class="col-12 col-md-9">
            <main class="main_area">
                <div class="px-3">
                    <div>
                        <button class="btn p-0 my-3 d-block d-md-none" id="userAccountMenuBtn"><span data-feather="menu"></span></button>
                    </div>
                    <div id="response-alert"></div>
                    <div class="p-3 border"><h4 class="m-0">Account Overview</h4></div>
                    <form name="updateProfile" id="updateProfile" >
                        <div class="border border-top-0">
                            <div class="p-3">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form_control_wrapper mb-3">
                                            <input type="text" name="firstname" id="firstname" placeholder="Firstname" value="<?= $_SESSION['USER_LOGIN']['firstname']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form_control_wrapper mb-3">
                                            <input type="text" name="lastname" id="lastname" placeholder="Lastname" value="<?= $_SESSION['USER_LOGIN']['lastname']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form_control_wrapper mb-3">
                                            <input readonly type="email" name="email" id="email" value="<?= $_SESSION['USER_LOGIN']['email']; ?>" placeholder="Current Email Address">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form_control_wrapper">
                                            <input type="text" name="mobile" id="mobile" placeholder="Phone Number" value="<?= isset($_SESSION['USER_LOGIN']['mobile'])?$_SESSION['USER_LOGIN']['mobile']:''; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="form_control_wrapper mb-3 mb-md-0">
                                            <input type="text" name="address" id="address" placeholder="Address" value="<?= isset($_SESSION['USER_LOGIN']['address'])?$_SESSION['USER_LOGIN']['address']:''; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3 border-top">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="text-muted font-weight-bold text-uppercase">
                                            <span class="text-danger">*</span> (leave it empty if you are not updating your password)
                                        </label>
                                    </div>
                                    <div class="col-6">
                                        <div class="form_control_wrapper">
                                            <input type="password" name="new_password" id="new_password" placeholder="New Password">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form_control_wrapper">
                                            <input type="password" name="repeat_password" id="repeat_password" placeholder="Repeat Password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="my-3"><button type="submit" class="btn btn_primary py-2 rounded-0" id="updateProBtn">UPDATE PROFILE</button></div>
                    </form>
                </div>
            </main>
        </div>
    </div>
</div>
<?php include_once("../inc/footer.main.php"); ?>