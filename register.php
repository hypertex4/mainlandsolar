<?php include_once("inc/header.nav.php"); ?>
<main>
    <div id="register-page" class="bg-white">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li>Register</li>
            </ul>
            <div class="title-wrapper">
                <hr class="my-0">
                <h1 class="title mb-0">REGISTER</h1>
                <hr class="my-0">
            </div>
            <section>
                <div class="auth-form-container">
                    <div class="card rounded-0">
                        <div class="card-body">
                            <div id="response-alert" class="mb-3"></div>
                            <form name="createAccount" id="createAccount">
                                <div class="form-group">
                                    <label for="firstname">First Name</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname">
                                </div>
                                <div class="form-group">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">Repeat Password</label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                                </div>
                                <p>&nbsp;</p>
                                <button type="submit" class="btn btn-block btn-white rounded-0 bold-600" id="createAccountBtn">SIGN UP</button>
                            </form>
                        </div>
                    </div>
                    <aside><p>HAVE AN ACCOUNT? <a href="./login" class="success-link">LOGIN</a></p></aside>
                </div>
            </section>
        </div>
    </div>
</main>
<?php include_once("inc/footer.nav.php"); ?>