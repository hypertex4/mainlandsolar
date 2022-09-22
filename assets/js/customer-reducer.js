$(function() {
    $("form[name='createAccount']").validate({
        rules: {
            firstname: "required",
            lastname: "required",
            email: {required: true, email: true},
            phone: {required: true, digits: true},
            password: {required: true, minlength: 6},
            confirm_password: {required: true, equalTo: '[name="password"]'},
            captcha_answer: {equalTo: '[name="captcha_answer_raw"]'},
            captcha_answer_raw: "required"
        },
        messages: {
            firstname: "Enter your firstname",
            lastname: "Enter your lastname",
            email: "Enter a valid email",
            phone: "Enter a valid phone number",
            password: {required: "Enter a password", minlength: "Password must be at least six(6) characters"},
            confirm_password: {required: "Required", equalTo: "Password not matched"},
            captcha_answer: "Incorrect answer, try again"
        },
        submitHandler: function (form, e) {
            e.preventDefault();
            var createAccountBtn = $("#createAccountBtn");
            createAccountBtn.attr("disabled", true); createAccountBtn.css("cursor", 'not-allowed');
            createAccountBtn.html("<i class='fa fa-spinner fa-pulse'></i>");

            $.ajax({
                url: "controllers/v6/create-customer.php", type: "POST", data: $("#createAccount").serialize(),
                success: function (data) {
                    if (data.status === 1){
                        document.getElementById("createAccount").reset();
                        sendSuccessResponse(data.message);
                        toastr.success("Successful! "+ data.message);
                        window.location.replace('otp-verification?response=true');
                    } else {
                        sendErrorResponse(data.message);
                    }
                },
                error: function (errData) {},
                complete: function () {
                    createAccountBtn.attr("disabled", false); createAccountBtn.css("cursor", 'pointer');
                    createAccountBtn.html("CREATE ACCOUNT");
                }
            });

        }
    });

    $("form[name='verify_form']").validate({
        rules: {
            digit_1: "required", digit_2: "required", digit_3: "required", digit_4: "required", digit_5: "required", digit_6: "required",
        },
        messages: {
            digit_1: " ", digit_2: " ", digit_3: " ", digit_4: " ", digit_5: " ", digit_6: " "
        },
        submitHandler: function(form, e) {
            e.preventDefault();
            var conData = $('#verify_form').serializeObject();
            var verifyBtn = $("#verifyBtn");
            let otp = conData.digit_1+conData.digit_2+conData.digit_3+conData.digit_4+conData.digit_5+conData.digit_6;

            verifyBtn.attr("disabled", true);verifyBtn.css("cursor", 'not-allowed');verifyBtn.html("<i class='fa fa-spinner fa-pulse'></i>");
            $.ajax({
                url: "controllers/v6/confirm-email.php", type: "POST", data: {otp:otp},
                success: function (data) {
                    if (data.status === 1){
                        sendSuccessResponse(data.message);
                        toastr.success("Successful! "+ data.message);
                        document.getElementById("verify_form").reset();
                        setTimeout(()=>{window.location.replace('login');},3000);
                    } else {
                        sendErrorResponse(data.message);
                    }
                },
                error: function (errData) {},
                complete: function () {
                    verifyBtn.attr("disabled", false); verifyBtn.css("cursor", 'pointer');verifyBtn.html("Complete");
                }
            });
        }
    });

    $("form[name='login_form']").validate({
        rules: {email: "required", password: "required",},
        messages: {email: "Enter a valid email address", password: "Enter your password",},
        submitHandler: function(form, e) {
            e.preventDefault();
            var login_form = $('#login_form');
            $("#loginBtn").attr("disabled", true);$('#loginBtn').css("cursor", 'not-allowed');
            $("#loginBtn").html("<i class='fa fa-spinner fa-pulse'></i>");
            $.ajax({
                url: "controllers/v6/login-customer.php",type:"POST",data:login_form.serialize(),
                success: function(data) {
                    if (data.status === 1){
                        document.getElementById("login_form").reset();
                        if (data.location === 'checkout') window.location.replace(data.location);
                        else window.location.replace(data.location);
                    } else {
                        sendErrorResponse(data.message);
                    }
                },
                error: function(errData){},
                complete: function () {
                    $('#loginBtn').attr("disabled", false);$('#loginBtn').css("cursor", 'pointer');
                    $("#loginBtn").html("LOGIN");
                }
            });
        }
    });

    $("form[name='forgotPassword']").validate({
        rules: {email: "required"},
        messages: {email: " "},
        submitHandler: function(form, e) {
            e.preventDefault();
            $("#forgotRespErr").html("");
            $("#forgotResp").html("");
            var login_form = $('#forgotPassword');
            $("#forgotPasswordBtn").attr("disabled", true);$('#forgotPasswordBtn').css("cursor", 'not-allowed');
            $("#forgotPasswordBtn").html("<i class='fa fa-spinner fa-pulse'></i>");
            $.ajax({
                url: "controllers/v6/forgot-password.php",type:"POST",data:login_form.serialize(),
                success: function(data) {
                    if (data.status === 1){
                        $("#forgotResp").html(data.message);
                        toastr.success(data.message);
                        document.getElementById("forgotPassword").reset();
                    } else {
                        $("#forgotRespErr").html(data.message);
                    }
                },
                error: function(errData){},
                complete: function () {
                    $('#forgotPasswordBtn').attr("disabled", false);$('#forgotPasswordBtn').css("cursor", 'pointer');
                    $("#forgotPasswordBtn").html("SEND LINK");
                }
            });
        }
    });

    $("form[name='resetPassword']").validate({
        rules: {
            password: {required: true, minlength: 6},
            rpt_password: {equalTo: '[name="password"]'}
        },
        messages: {
            password: {required: "Enter a password",minlength: "Password must be at least six(6) characters long"},
            rpt_password: {equalTo: "Enter Confirm password same as password"}
        },
        submitHandler: function(form, e) {
            e.preventDefault();
            var resetPassword = $('#resetPassword');
            $("#resetPasswordBtn").attr("disabled", true);$('#resetPasswordBtn').css("cursor", 'not-allowed');
            $("#resetPasswordBtn").html("<i class='fa fa-spinner fa-pulse'></i>");
            $.ajax({
                url: "controllers/v6/reset-password.php",type:"POST",data:resetPassword.serialize(),
                success: function(data) {
                    if (data.status === 1){
                        sendSuccessResponse(data.message+", redirecting to login shortly.");
                        toastr.success(data.message+", redirecting to login shortly.");
                        document.getElementById("resetPassword").reset();
                        setTimeout(()=>{window.location.replace('login');},3000);
                    } else {
                        sendErrorResponse(data.message);
                    }
                },
                error: function(errData){},
                complete: function () {
                    $('#resetPasswordBtn').attr("disabled", false);$('#resetPasswordBtn').css("cursor", 'pointer');
                    $("#resetPasswordBtn").html("SAVE");
                }
            });
        }
    });

    $("form[name='newsLetter']").on('submit',function (e) {
        e.preventDefault();
        $("#newsBtn").attr("disabled", true);$('#newsBtn').css("cursor", 'not-allowed');
        $("#newsBtn").html("<i class='fa fa-spinner fa-pulse'></i>");
        $.ajax({
            url: "controllers/v6/create-newsletter.php", type: "POST",data: $('#newsLetter').serialize(),
            success: function (data) {
                toastr.options = {"closeButton": true, "positionClass": "toast-bottom-right"};
                if (data.status === 1){
                    document.getElementById("newsLetter").reset();
                    toastr["success"](data.message);
                } else {
                    toastr["error"](data.message);
                }
            },
            error: function (errData) {},
            complete: function () {
                $('#newsBtn').attr("disabled", false);$('#newsBtn').css("cursor", 'pointer');
                $("#newsBtn").html("GO");
            }
        });
    });

    $("form[name='contactUs']").validate({
        rules: {
            firstname: "required",
            lastname: "required",
            phone: {required: true, digits: true},
            email: {required: true, email: true},
            request: "required",
            description: {required: true, minlength: 10},
            captcha_answer: {equalTo: '[name="captcha_answer_raw"]'},
            captcha_answer_raw: "required"
        },
        messages: {
            firstname: "Enter your firstname",
            lastname: "Enter your lastname",
            phone: "Enter a valid phone number",
            email: "Enter a valid email address",
            request: "Select a service",
            description: "Provide a description of the service (min. of 10 character)",
            captcha_answer:"Incorrect answer, try again"
        },
        submitHandler: function(form, e) {
            e.preventDefault();
            $("#contactUsBtn").attr("disabled", true);$('#contactUsBtn').css("cursor", 'not-allowed');
            $("#contactUsBtn").html("<i class='fa fa-spinner fa-pulse'></i>");
            $.ajax({
                url: "controllers/v6/contact-us.php",type:"POST",data:$('#contactUs').serialize(),
                success: function(data) {
                    if (data.status === 1) {
                        document.getElementById("contactUs").reset();
                        sendSuccessResponse(data.message);
                    } else {
                        sendErrorResponse(data.message);
                    }
                },
                error: function(errData){},
                complete: function () {
                    $('#contactUsBtn').attr("disabled", false);$('#contactUsBtn').css("cursor", 'pointer');
                    $("#contactUsBtn").html("SUBMIT");
                }
            });
        }
    });

    $("form[name='checkout']").validate({
        rules: {
            firstname:"required",
            lastname:"required",
            email:{required:true,email:true},
            phone:{required:true,digits:true},
            address:"required",
            state:"required"
        },
        messages: {
            firstname:"enter receivers firstname",
            lastname:"enter receivers lastname",
            email:"enter a valid email address",
            phone:"enter valid mobile number",
            address:"enter receivers address",
            state:"enter receivers state"
        },
        submitHandler: function(form, e) {
            e.preventDefault();
            if ($.trim($('#s_email').val()) !== "") {
                if($('input[name=payment_method]:checked', '#checkout').val() === 'DebitCard') {
                    var total_amount = $('#total_amount').val();
                    payWithPaystack();
                    function payWithPaystack(){
                        var handler = PaystackPop.setup({
                            key: 'pk_test_84b96ad57b85b12841d6e3757327b9d49b291627',
                            email: $('#s_email').val(),
                            amount: total_amount * 100,
                            currency: "NGN",
                            ref: 'MS'+Math.floor((Math.random() * 100000000) + 1),
                            metadata: {custom_fields: [{display_name: "Mainlandsolar"}]},
                            callback: function(response){
                                $("#payment_ref").val(response.reference);
                                $("#checkout_btn").attr("disabled", true);$('#checkout_btn').css("cursor", 'not-allowed');
                                $("#checkout_btn").html('<i class="fa fa-spinner fa-spin"></i>');

                                var checkout_form = $('#checkout');
                                var form_data = JSON.stringify(checkout_form.serializeObject());
                                $.ajax({url: "controllers/v6/create-order.php",type:"POST", contentType:'application/json', data: form_data,
                                    success: function (data){
                                        storeOrderDetails(data.order_id);
                                        document.getElementById("checkout").reset();
                                        localStorage.removeItem('shoppingCart');
                                        window.location.replace("_success");
                                    }, error: function () {
                                        toastr.options = {"closeButton": true, "positionClass": "toast-bottom-right"};
                                        if (errData.responseJSON.message !== "AuthErr") {
                                            toastr["error"](errData.responseJSON.message);
                                        } else {
                                            window.location.replace('login');
                                        }
                                    }
                                });
                            },
                            onClose: function(){
                                alert('window closed');
                                $('#checkout_btn').attr("disabled", false);$('#checkout_btn').css("cursor", 'pointer');
                                $("#checkout_btn").html('PLACE YOUR ORDER');
                            }
                        });
                        handler.openIframe();
                    }
                } else {
                    $('#payWithTransfer').modal({
                        keyboard: false
                    });
                }
            } else {
                var checkout_form = $('#checkout');
                var form_data = checkout_form.serializeObject();
                $.ajax({
                    url: "controllers/v6/storeUrl.php", type : "POST", data : form_data,
                    success: function(data) { window.location.replace('login'); }
                });
            }
        }
    });

    $("form[name='transfer_request_form']").validate({
        rules: {account_name:"required"},
        messages: {account_name:"enter sender account name"},
        submitHandler: function(form, e) {
            e.preventDefault();
            var name = $("#account_name").val();
            var amount_trans = $("#amount_transferred").val();
            $("#checkout_btn").attr("disabled", true);
            $('#checkout_btn').css("cursor", 'not-allowed');
            $('#checkout_btn').html('<i class="fa fa-spinner fa-spin"></i>');
            $("#pay_transfer_btn").attr("disabled", true);
            $('#pay_transfer_btn').css("cursor", 'not-allowed');
            $('#pay_transfer_btn').html('<i class="fa fa-spinner fa-spin"></i>');
            var checkout_form = $('#checkout');
            var form_data = JSON.stringify(checkout_form.serializeObject());
            $.ajax({url: "controllers/v6/create-order.php",type:"POST", contentType:'application/json', data: form_data,
                success: function (data){
                    storeOrderDetails(data.order_id);
                    document.getElementById("checkout").reset();
                    localStorage.removeItem('shoppingCart');
                    storeTransferRequest(data.order_id,name,amount_trans);
                    window.location.replace("_success");
                }, error: function () {
                    toastr.options = {"closeButton": true, "positionClass": "toast-bottom-right"};
                    if (errData.responseJSON.message !== "AuthErr") {
                        toastr["error"](errData.responseJSON.message);
                    } else {
                        window.location.replace('login');
                    }
                },complete: function () {
                    $('#checkout_btn').attr("disabled", false);
                    $('#checkout_btn').css("cursor", 'pointer');
                    $('#checkout_btn').html('CONFIRM ORDER');
                    $('#pay_transfer_btn').attr("disabled", false);
                    $('#pay_transfer_btn').css("cursor", 'pointer');
                    $('#pay_transfer_btn').html('SUBMIT');
                }
            });
        }
    });

    $("form[name='updateProfile']").validate({
        rules: {
            firstname: "required",
            lastname: "required",
            mobile: "required",
            email: {required: true, email: true},
        },
        messages: {
            firstname: "Enter your firstname",
            lastname: "Enter your lastname",
            mobile: "Enter your mobile phone number",
            email: "Please enter a valid email address",
        },
        submitHandler: function(form, e) {
            e.preventDefault();
            $("#updateProBtn").attr("disabled", true); $("#updateProBtn").css("cursor", 'not-allowed');
            $("#updateProBtn").html("<i class='fa fa-spinner fa-pulse'></i>");
            $.ajax({
                url: "controllers/v6/update-account-profile.php", type : "POST", data : $("#updateProfile").serialize(),
                success: function(data) {
                    sendSuccessResponse(data.message)
                },
                error: function(errData){
                    sendErrorResponse(errData.responseJSON.message)
                },
                complete: function () {
                    $("#updateProBtn").attr("disabled", false); $("#updateProBtn").css("cursor", 'pointer');
                    $("#updateProBtn").html("SAVE");
                }
            });
        }
    });

    $("form[name='updatePwd']").validate({
        rules: {new_password: {required:true,minlength:6},repeat_password: {equalTo: '[name="new_password"]'}},
        messages: {
            new_password: {
                required: "Enter password",
                minlength: "Password must be at least 6 characters long"
            },
            repeat_password: {equalTo:"Password not matched"},
        },
        submitHandler: function(form, e) {
            e.preventDefault();
            $("#updatePwdBtn").attr("disabled", true); $("#updatePwdBtn").css("cursor", 'not-allowed');
            $("#updatePwdBtn").html("<i class='fa fa-spinner fa-pulse'></i>");
            $.ajax({
                url: "controllers/v6/update-account-password.php", type : "POST", data : $("#updatePwd").serialize(),
                success: function(data) {
                    sendSuccessResponse2(data.message)
                },
                error: function(errData){
                    sendErrorResponse2(errData.responseJSON.message)
                },
                complete: function () {
                    $("#updatePwdBtn").attr("disabled", false); $("#updatePwdBtn").css("cursor", 'pointer');
                    $("#updatePwdBtn").html("Save");
                }
            });
        }
    });

    $("form[name='review']").validate({
        rules: {
            review_name: "required",
            rating_value: "required",
            review_comment: {required:true,minlength:10},
        },
        messages: {
            review_name: "Name is required",
            rating_value: "Rating is required",
            review_comment: {required: "Comment is required", minlength: "Comment must be at least 10 characters"},
        },
        submitHandler: function (form, e) {
            e.preventDefault();
            var review_form = $('#review');
            var form_data = JSON.stringify(review_form.serializeObject());

            $('#review_btn').attr("disabled", true);
            $('#review_btn').css("cursor", 'not-allowed');
            $('#review_btn').html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                url: "controllers/v6/create-review-rating.php",
                type: "POST",
                contentType: 'application/json',
                data: form_data,
                success: function () {
                    document.getElementById("review").reset();
                    window.location.replace('_feedback');
                },
                error: function (errData) {
                    toastr.options = {"closeButton": true, "positionClass": "toast-bottom-right"};
                    toastr["error"](errData.responseJSON.message);
                },
                complete: function () {
                    $('#review_btn').attr("disabled", false);
                    $('#review_btn').css("cursor", 'pointer');
                    $('#review_btn').html('SUBMIT');
                }
            });
        }
    });
});

$('.product_click').on('click', '.add_to_wlist', function(e) {
    e.preventDefault();
    var product_id = $(this).data('id');
    if (product_id==="") {
        $.confirm({
            icon: 'fa fa-exclamation-triangle', title: 'Encountered an error',typeAnimated: true, buttons: false,
            content: 'Something went wrong, refresh and try again.', type: 'red'
        });
    } else {
        $.ajax({
            url: "controllers/v6/create-user-wishlist.php", type : "POST", contentType : 'application/json',
            data : JSON.stringify({product_id:product_id}),
            success: function(data) {
                toastr.options = {"closeButton": true, "positionClass": "toast-bottom-right"};
                toastr["success"](data.message);
                $('#wBtn'+product_id).addClass('active');
            },
            error: function(errData){
                if (errData.responseJSON.status===400) {
                    $.confirm({
                        icon: 'fa fa-exclamation-triangle',closeIcon: true, title: "Error!",typeAnimated: true, content: errData.responseJSON.message,
                        type: 'red',buttons: {tryAgain: {text: 'Login', btnClass: 'btn-red', action: function(){window.location.replace('login')} }}
                    });
                } else {
                    toastr.options = {"closeButton": true, "positionClass": "toast-bottom-left"};
                    toastr["error"](errData.responseJSON.message);
                }
            }
        });
    }
});

$('.product_click').on('click', '.quick_view', function(e) {
    e.preventDefault();
    let product_id = $(this).data('id');
    let img1 = $(this).data('img1');
    $("#img-1").val("admin/"+img1);
    let output = "";
    if (product_id==="") {
        $.confirm({
            icon: 'fa fa-exclamation-triangle', title: 'Encountered an error',typeAnimated: true, buttons: false,
            content: 'Something went wrong, refresh and try again.', type: 'red'
        });
    } else {
        $.ajax({
            url: "controllers/v6/get_quick_view_product.php", type : "POST",
            data : {product_id:product_id},
            success: function(data) {
                $("#img-1").val("admin/"+data.product[0].pro_image1);
            },
            error: function(errData){},
            complete: function (){ openPreview();}
        });

    }
});

$('#schedule-audit-request').on('click', '.check-date', function(e) {
    e.preventDefault();
    var f_date = $(this).data('fdate');
    if (f_date==="") { return false; }
    else {
        $.ajax({
            url: "controllers/v6/process-solar-audit.php", type : "POST",data : {picked_date:f_date},
            success: function(data) { window.location.replace(data.location)},
            error: function(errData){}
        });
    }
});

$("form[name='transfer_request_audit_form']").validate({
    rules: {account_name:"required"},
    messages: {account_name:"enter sender account name"},
    submitHandler: function(form, e) {
        e.preventDefault();
        var $submitButton = $(this.submitButton),
            submitButtonText = $submitButton.html();
        $submitButton.val( $submitButton.data('loading-text') ? $submitButton.data('loading-text') : 'Please wait..' ).attr('disabled', true);

        $.ajax({url: "controllers/v6/process-audit-payment",type:"POST", data: $('#audit-payment').add($("#transfer_request_audit_form")).serializeArray(),
            success: function (data){
                if (data.status === 1){
                    $.alert({
                        icon: 'fa fa-check-circle',title:'Booking Successful',typeAnimated: true,content:data.message,type:'green',
                        columnClass: 'col-md-6 col-md-offset-3 col-10 offset-1', buttons: {ok: ()=> { window.location.replace('./');}}
                    });
                } else {
                    $.dialog({
                        icon:'fa fa-exclamation-triangle',title: 'Booking Failed',typeAnimated:true,type:'red',
                        columnClass: 'col-md-5 col-md-offset-3 col-10 offset-1',content:errData.responseJSON.message
                    });
                }
            },
            error: function () {},
            complete: function () { $submitButton.val( submitButtonText ).attr('disabled', false); }
        });
    }
});

$("form[name='audit_time_form']").validate({
    submitHandler: function(form, e) {
        e.preventDefault();
        var $form = $(form),
            $submitButton = $(this.submitButton),
            submitButtonText = $submitButton.val();

        $submitButton.val( $submitButton.data('loading-text') ? $submitButton.data('loading-text') : 'Please wait...' ).attr('disabled', true);

        $.ajax({
            url: "controllers/v6/process-audit-time.php", type : "POST", data : $form.serialize(),
            success: function(data) {
                if (data.status === 1){
                    window.location.replace("audit-payment");
                } else {
                    sendErrorResponse(data.message);
                }
            },
            error: function(errData){},
            complete: function () {$submitButton.val( submitButtonText ).attr('disabled', false);}
        });
    }
});

$("form[name='audit-payment']").validate({
    rules: {
        first_name:"required",
        last_name:"required",
        phone_no:{required:true,digits:true},
        email:{required:true,email:true},
        streetLga:"required",
        street_address:"required",
        payment_method:"required"
    },
    messages: {
        first_name:"enter receivers firstname",
        last_name:"enter receivers lastname",
        phone_no:"enter valid mobile number",
        email:"enter a valid email address",
        streetLga:"select your lga",
        street_address:"enter your address",
        payment_method:"select you preferred payment method"
    },
    errorPlacement: function(error, element) {
        if(element.attr('type') === 'radio' || element.attr('type') === 'checkbox') {
            error.appendTo(element.closest('.form-control'));
        } else if( element.is('select') && element.closest('.custom-select-1') ) {
            error.appendTo(element.closest('.form-group'));
        } else {
            if( element.closest('.form-group').length ) {
                error.appendTo(element.closest('.form-group'));
            } else {
                error.insertAfter(element);
            }
        }
    },
    submitHandler: function(form, e) {
        e.preventDefault();
        var $form = $(form),
            $submitButton = $(this.submitButton),
            submitButtonText = $submitButton.val();

        $submitButton.val( $submitButton.data('loading-text') ? $submitButton.data('loading-text') : 'Please wait...' ).attr('disabled', true);

        if($('input[name=payment_method]:checked', '#checkout').val() === 'Paystack') {
            var total_amount = 15000;
            payWithPaystack();
            function payWithPaystack(){
                var handler = PaystackPop.setup({
                    key: 'pk_test_84b96ad57b85b12841d6e3757327b9d49b291627',
                    email: $('#email').val(),
                    amount: total_amount * 100,
                    currency: "NGN",
                    ref: 'MS'+Math.floor((Math.random() * 100000000) + 1),
                    metadata: {custom_fields: [{display_name: "Mainlandsolar"}]},
                    callback: function(response){
                        $("#payment_ref").val(response.reference);
                        $.ajax({url: "controllers/v6/process-audit-payment.php",type:"POST", data: $form.serialize(),
                            success: function (data){
                                if (data.status === 1){
                                    $.alert({
                                        icon: 'fa fa-check-circle',title:'Booking Successful',typeAnimated: true,content:data.message,type:'green',
                                        columnClass: 'col-md-6 col-md-offset-3 col-10 offset-1', buttons: {ok: ()=> { window.location.replace('./');}}
                                    });
                                } else {
                                    $.dialog({
                                        icon:'fa fa-exclamation-triangle',title: 'Booking Failed',typeAnimated:true,type:'red',
                                        columnClass: 'col-md-5 col-md-offset-3 col-10 offset-1',content:errData.responseJSON.message
                                    });
                                }
                            },
                            error: function () {},
                            complete: function () {$submitButton.val( submitButtonText ).attr('disabled', false);}
                        });
                    },
                    onClose: function(){ $submitButton.val( submitButtonText ).attr('disabled', false); }
                });
                handler.openIframe();
            }
        } else {
            $submitButton.val( submitButtonText ).attr('disabled', false);
            $('#payWithTransferAudit').modal({ keyboard: false });
        }
    }
});

function storeOrderDetails(id) {
    //Retrieve Data from Local Storage
    var order_id_arr = [];
    var general_arr=[];

    var cart = JSON.parse(localStorage.getItem('shoppingCart'));
    order_id_arr.push({order_id: id});
    general_arr.push(order_id_arr,cart);

    general_arr = JSON.stringify(general_arr);
    $.ajax({
        url: "controllers/v6/create-order-details.php", type : "POST", contentType : 'application/json', data : general_arr,
        success: function(data) {},
        error: function(errData){}
    });
}

function storeTransferRequest(order_id,account_name,amount) {
    $.ajax({
        url: "controllers/v6/create-transfer-request.php", type : "POST", contentType : 'application/json',
        data : JSON.stringify({order_id:order_id,account_name:account_name,amount:amount}),
        success: function(data) {
            document.getElementById("checkout").reset();
            setTimeout(function () {window.location.replace("_success");}, 1500);
        },
        error: function(errData){
            toastr.options = {"closeButton": true, "positionClass": "toast-bottom-right"};
            toastr["error"](errData.responseJSON.message);
        }
    });
}

function sendSuccessResponse(resp) {
    $("#response-alert").html('<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">'+ resp +
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="width: unset">\n' +
        '     <span aria-hidden="true">&times;</span>\n' +
        ' </button></div></div></div>');
}

function sendErrorResponse(resp) {
    $("#response-alert").html('<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">' + resp +
        ' <button type="button" class="close" data-dismiss="alert" style="width: unset">\n' +
        '     <span aria-hidden="true">&times;</span>\n' +
        ' </button></div></div></div>');
    toastr.error(resp);
}

function sendSuccessResponse2(resp) {
    $("#response-alert2").html('<div class="alert alert-success" style="border-radius:0;" role="alert">'+resp+'</div>');
    toastr['success'](resp);
}

function sendErrorResponse2(resp) {
    $("#response-alert2").html('<div class="alert alert-danger" style="border-radius:0;" role="alert">'+resp+'</div>');
    toastr['error'](resp);
}