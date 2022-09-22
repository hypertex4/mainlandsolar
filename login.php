<?php include_once("inc/header.nav.php"); ?>
<main>
    <div id="login-page" class="bg-white">
        <div class="container auto-wrapper">
            <ul class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li>Sign in</li>
            </ul>
            <div class="title-wrapper">
                <hr class="my-0">
                <h1 class="title mb-0">SIGN IN</h1>
                <hr class="my-0">
            </div>
            <section>
                <div class="auth-form-container">
                    <div class="card rounded-0">
                        <div class="card-body">
                            <div id="response-alert" class="mb-3"></div>
                            <form name="login_form" id="login_form">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                                <p><small><a href="./forgot-password" class="dark-link">Lost your password ?</a></small></p>
                                <button type="submit" class="btn btn-block btn-white rounded-0 bold-600" id="loginBtn">LOG IN</button>
                            </form>
                        </div>
                    </div>
                    <aside><p>DON’T HAVE AN ACCOUNT? <a href="./register.php" class="success-link">REGISTER NOW</a></p></aside>
                </div>
            </section>
        </div>
    </div>
</main>
<?php include_once("inc/footer.nav.php"); ?>