<?php include_once("inc/header.nav.php"); ?>
<main>
    <div id="forgot-password-page" class="bg-white">
        <div class="container text-center">
            <div class="auth-form-container">
                <div class="inner">
                    <div class="logo-img-wrapper">
                        <img src="./assets/images/brand-logo.svg" alt="" class="img-fluid">
                    </div>
                    <h1 class="title">FORGOT PASSWORD</h1>
                    <p>Please enter the email address you registered with. We will send you a link</p>
                    <div class="form-wrapper">
                        <form name="forgotPassword" id="forgotPassword">
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" name="email" id="email" aria-label="" required>
                                <div class="input-group-append">
                                    <button class="btn btn-white rounded-0" type="submit" id="forgotPasswordBtn">SEND LINK</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <p class="text-successColor bold-600 my-3" id="forgotResp"></p>
                    <p class="text-danger bold-600 my-3" id="forgotRespErr"></p>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include_once("inc/footer.nav.php"); ?>