

jQuery('#schedule-audit-request').on('click', '.check-date', function(e) {
    e.preventDefault();
    var f_date = jQuery(this).data('fdate');
    if (f_date==="") { return false; }
    else {
        jQuery.ajax({
            url: "process-solar-audit.php", type : "POST",data : {picked_date:f_date},
            success: function(data) { window.location.replace(data.location)},
            error: function(errData){}
        });
    }
});

jQuery("form[name='transfer_request_audit_form']").validate({
    rules: {account_name:"required"},
    messages: {account_name:"enter sender account name"},
    submitHandler: function(form, e) {
        e.preventDefault();
        var jQuerysubmitButton = jQuery(this.submitButton),
            submitButtonText = jQuerysubmitButton.html();
        jQuerysubmitButton.val( jQuerysubmitButton.data('loading-text') ? jQuerysubmitButton.data('loading-text') : 'Please wait..' ).attr('disabled', true);

        jQuery.ajax({url: "process-audit-payment",type:"POST", data: jQuery('#audit-payment').add(jQuery("#transfer_request_audit_form")).serializeArray(),
            success: function (data){
                if (data.status === 1){
                    jQuery.alert({
                        icon: 'fa fa-check-circle',title:'Booking Successful',typeAnimated: true,content:data.message,type:'green',
                        columnClass: 'col-md-6 col-md-offset-3 col-10 offset-1', buttons: {ok: ()=> { window.location.replace('./');}}
                    });
                } else {
                    jQuery.dialog({
                        icon:'fa fa-exclamation-triangle',title: 'Booking Failed',typeAnimated:true,type:'red',
                        columnClass: 'col-md-5 col-md-offset-3 col-10 offset-1',content:errData.responseJSON.message
                    });
                }
            },
            error: function () {},
            complete: function () { jQuerysubmitButton.val( submitButtonText ).attr('disabled', false); }
        });
    }
});

jQuery("form[name='audit_time_form']").validate({
    submitHandler: function(form, e) {
        e.preventDefault();
        var jQueryform = jQuery(form),
            jQuerysubmitButton = jQuery(this.submitButton),
            submitButtonText = jQuerysubmitButton.val();

        jQuerysubmitButton.val( jQuerysubmitButton.data('loading-text') ? jQuerysubmitButton.data('loading-text') : 'Please wait...' ).attr('disabled', true);

        jQuery.ajax({
            url: "process-audit-time.php", type : "POST", data : jQueryform.serialize(),
            success: function(data) {
                if (data.status === 1){
                    window.location.replace("audit-payment");
                } else {
                    sendErrorResponse(data.message);
                }
            },
            error: function(errData){},
            complete: function () {jQuerysubmitButton.val( submitButtonText ).attr('disabled', false);}
        });
    }
});

jQuery("form[name='audit-payment']").validate({
    rules: {
        client_name:"required",
        phone_no:{required:true,digits:true},
        email:{required:true,email:true},
        survey_loc:"required",
        survey_add:"required",
        sur_other_loc:"required",
        pry_purpose:"required",
        solar_coverage:"required",
        panel_space:"required",
        payment_method:"required"
    },
    messages: {
        client_name:"enter client/organisation name",
        phone_no:"enter valid mobile number",
        email:"enter a valid email address",
        survey_loc:"select your survey location",
        survey_add:"enter your survey address",
        pry_purpose:"required",
        solar_coverage:"required",
        panel_space:"required",
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
        var jQueryform = jQuery(form),
            jQuerysubmitButton = jQuery(this.submitButton),
            submitButtonText = jQuerysubmitButton.val();

        jQuerysubmitButton.val( jQuerysubmitButton.data('loading-text') ? jQuerysubmitButton.data('loading-text') : 'Please wait...' ).attr('disabled', true);

        if(jQuery('input[name=payment_method]:checked', '#checkout').val() === 'Paystack') {
            var total_amount = 15000;
            payWithPaystack();
            function payWithPaystack(){
                var handler = PaystackPop.setup({
                    key: 'pk_test_84b96ad57b85b12841d6e3757327b9d49b291627',
                    email: jQuery('#email').val(),
                    amount: total_amount * 100,
                    currency: "NGN",
                    ref: 'MS'+Math.floor((Math.random() * 100000000) + 1),
                    metadata: {custom_fields: [{display_name: "Mainlandsolar"}]},
                    callback: function(response){
                        jQuery("#payment_ref").val(response.reference);
                        jQuery.ajax({url: "process-audit-payment.php",type:"POST", data: jQueryform.serialize(),
                            success: function (data){
                                if (data.status === 1){
                                    jQuery.alert({
                                        icon: 'fa fa-check-circle',title:'Booking Successful',typeAnimated: true,content:data.message,type:'green',
                                        columnClass: 'col-md-6 col-md-offset-3 col-10 offset-1', buttons: {ok: ()=> { window.location.replace('./');}}
                                    });
                                } else {
                                    jQuery.dialog({
                                        icon:'fa fa-exclamation-triangle',title: 'Booking Failed',typeAnimated:true,type:'red',
                                        columnClass: 'col-md-5 col-md-offset-3 col-10 offset-1',content:errData.responseJSON.message
                                    });
                                }
                            },
                            error: function () {},
                            complete: function () {jQuerysubmitButton.val( submitButtonText ).attr('disabled', false);}
                        });
                    },
                    onClose: function(){ jQuerysubmitButton.val( submitButtonText ).attr('disabled', false); }
                });
                handler.openIframe();
            }
        } else {
            jQuerysubmitButton.val( submitButtonText ).attr('disabled', false);
            jQuery('#payWithTransferAudit').modal({ keyboard: false });
        }
    }
});

function sendSuccessResponse(resp) {
    jQuery("#response-alert").html('<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">'+ resp +
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="width: unset">\n' +
        '     <span aria-hidden="true">&times;</span>\n' +
        ' </button></div></div></div>');
}

function sendErrorResponse(resp) {
    jQuery("#response-alert").html('<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">' + resp +
        ' <button type="button" class="close" data-dismiss="alert" style="width: unset">\n' +
        '     <span aria-hidden="true">&times;</span>\n' +
        ' </button></div></div></div>');
    toastr.error(resp);
}

function sendSuccessResponse2(resp) {
    jQuery("#response-alert2").html('<div class="alert alert-success" style="border-radius:0;" role="alert">'+resp+'</div>');
    toastr['success'](resp);
}

function sendErrorResponse2(resp) {
    jQuery("#response-alert2").html('<div class="alert alert-danger" style="border-radius:0;" role="alert">'+resp+'</div>');
    toastr['error'](resp);
}