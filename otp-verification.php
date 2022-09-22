<?php
ob_start(); session_start();
if (isset($_SESSION['user_login']) && isset($_SESSION['user_login']['user_id'])) header('Location: account');
include_once('inc/header.nav.php');
?>
<style>
    .digit-group input{width: 50px;height: 50px;border:1px solid #ced4da;line-height:50px;text-align:center;font-size:24px;margin:0 2px;}
    .splitter {padding: 0 5px;font-size: 24px;}
    .prompt {margin-bottom: 20px;font-size: 20px;}
    #success-message .inner{padding: 1em 0 !important;}
</style>
<main>
    <div id="register-page" class="bg-white">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li>OTP Verification</li>
            </ul>
            <?php  if (!empty($_GET['response']) && $_GET['response']=='true'){?>
            <section id="success-message">
                <div class="inner">
                    <h1>REGISTRATION ALMOST COMPLETE</h1>
                    <p>Enter the confirmation code sent to your email to complete your registration.</p>
                </div>
            </section>
            <?php }  ?>
            <div class="row">
                <div class="col-12 col-sm-9 col-md-8 col-lg-6 mx-auto text-center">
                    <div class="card my-2">
                        <div class="card-body p-3 p-md-5">
                            <h4 class="text-center"><strong>OTP Verification</strong></h4>
                            <div id="response-alert" class="my-4"></div>
                            <form name="verify_form" id="verify_form" class="digit-group" data-group-name="digits" data-autosubmit="false" autocomplete="off">
                                <div class="form-row text-center">
                                    <div class="form-group col-md-12 mb-4">
                                        <input type="text" id="digit-1" name="digit_1" data-next="digit-2" />
                                        <input type="text" id="digit-2" name="digit_2" data-next="digit-3" data-previous="digit-1" />
                                        <input type="text" id="digit-3" name="digit_3" data-next="digit-4" data-previous="digit-2" />
                                        <span class="splitter">&ndash;</span>
                                        <input type="text" id="digit-4" name="digit_4" data-next="digit-5" data-previous="digit-3" />
                                        <input type="text" id="digit-5" name="digit_5" data-next="digit-6" data-previous="digit-4" />
                                        <input type="text" id="digit-6" name="digit_6" data-previous="digit-5" />
                                    </div>
                                </div>
                                <div class="form-row text-center mx-1">
                                    <div class="form-group col-10 mx-auto mb-4">
                                        <button type="submit" class="btn btn-block btn-white rounded-0 bold-600 my-2" id="verifyBtn">Complete</button>
                                    </div>
                                    <div class="form-group col-md-12 mb-4">
                                        <div class="text-center"><a href="register" class="regular-link">Go back</a></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include_once('inc/footer.nav.php'); ?>
<script>
    $('.digit-group').find('input').each(function() {
        $(this).attr('maxlength', 1);
        $(this).on('keyup', function(e) {
            var parent = $($(this).parent());
            if(e.keyCode === 8 || e.keyCode === 37) {
                var prev = parent.find('input#' + $(this).data('previous'));
                if(prev.length) {
                    $(prev).select();
                }
            } else if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
                var next = parent.find('input#' + $(this).data('next'));
                if(next.length) {
                    $(next).select();
                } else {
                    if(parent.data('autosubmit')) {
                        parent.submit();
                    }
                }
            }
        });
    });
</script>
