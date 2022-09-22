<?php
include_once("inc/header.nav.php");
if (isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN']['STATUS']==200) header('Location: index');
?>
<main>
<?php
$selector = isset($_GET['selector']) ? $_GET['selector']:null;
$validator = isset($_GET['validator']) ? $_GET['validator']:null;

if (empty($selector) || empty($validator)) { ?>
    <div class="container" id="" style="margin: 100px auto;">
        <div><h1 class="text-center text-danger" style="font-size: 120px">404</h1></div>
        <div class="mt-5 mb-4"><p class="text-center" style="font-size: 24px">Page not found</p></div>
        <p class="text-center" style="font-size: 16px"><a href="forgot-password">Back to forgot password</a></p>
    </div>
<?php } else {
    if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
?>
    <div id="change-password-page" class="bg-white">
        <div class="container text-center">
            <div class="auth-form-container">
                <div class="inner">
                    <div class="logo-img-wrapper">
                        <img src="./assets/images/brand-logo.svg" alt="" class="img-fluid">
                    </div>
                    <form name="resetPassword" id="resetPassword">
                        <div class="card text-left">
                            <div class="card-header">CHANGE PASSWORD</div>
                            <div class="card-body">
                                <div id="response-alert" class="mb-3"></div>
                                <input type="hidden" name="selector" id="selector" value="<?= $selector; ?>">
                                <input type="hidden" name="validator" id="validator" value="<?= $validator; ?>">
                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                                <div class="form-group">
                                    <label for="rpt_password">Retype Password</label>
                                    <input type="password" class="form-control" id="rpt_password" name="rpt_password">
                                </div>
                                <hr class="my-5" />
                                <button type="submit" class="btn btn-block btn-white rounded-0 bold-600" id="resetPasswordBtn">SAVE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
<div class="container" id="" style="margin: 100px auto;">
    <div><h1 class="text-center text-danger" style="font-size: 120px">404</h1></div>
    <div class="mt-5 mb-4"><p class="text-center" style="font-size: 24px">Page not found</p></div>
    <p class="text-center" style="font-size: 16px"><a href="forgot-password">Back to forgot password</a></p>
</div>
<?php } } ?>
</main>
<?php include_once("inc/footer.nav.php"); ?>