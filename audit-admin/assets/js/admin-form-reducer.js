$(function() {
    $("form[name='addCategory']").validate({
        rules: {cat_name: {"required":true,minlength:3}},
        submitHandler: function (form, e) {
            e.preventDefault();
            var addCategory = $('#addCategory');
            var form_data = JSON.stringify(addCategory.serializeObject());
            $("#addCategoryBtn").attr("disabled", true);
            $('#addCategoryBtn').css("cursor", 'not-allowed');
            $(".fa-spin").addClass("d-inline-block");

            $.ajax({
                url: "form-reducer-action.php",
                type: "POST",
                contentType: 'application/json',
                data: form_data,
                success: function (data) {
                    toastr.options = {"closeButton": true, "positionClass": "toast-top-right"};
                    toastr["success"](data.message);
                    setTimeout(function () {
                        document.getElementById("addCategory").reset();
                        window.location.replace('product-category');
                    }, 1500);
                },
                error: function (errData) {
                    toastr.options = {"closeButton": true, "positionClass": "toast-top-right"};
                    toastr["error"](errData.responseJSON.message);
                },
                complete: function () {
                    $('#addCategoryBtn').attr("disabled", false);
                    $('#addCategoryBtn').css("cursor", 'pointer');
                    $(".fa-spin").removeClass("d-inline-block");
                }
            });
        }
    });

    $("form[name='updateCategory']").validate({
        rules: {edit_cat_name: {"required":true,minlength:3}},
        submitHandler: function (form, e) {
            e.preventDefault();
            var updateCategory = $('#updateCategory');
            var form_data = JSON.stringify(updateCategory.serializeObject());
            $("#updateCategoryBtn").attr("disabled", true);
            $('#updateCategoryBtn').css("cursor", 'not-allowed');
            $(".fa-spin").addClass("d-inline-block");

            $.ajax({
                url: "form-reducer-action.php",
                type: "POST",
                contentType: 'application/json',
                data: form_data,
                success: function (data) {
                    toastr.options = {"closeButton": true, "positionClass": "toast-top-right"};
                    toastr["success"](data.message);
                    setTimeout(function () {
                        document.getElementById("updateCategory").reset();
                        window.location.replace('product-category');
                    }, 1000);
                },
                error: function (errData) {
                    toastr.options = {"closeButton": true, "positionClass": "toast-top-right"};
                    toastr["error"](errData.responseJSON.message);
                },
                complete: function () {
                    $('#updateCategoryBtn').attr("disabled", false);
                    $('#updateCategoryBtn').css("cursor", 'pointer');
                    $(".fa-spin").removeClass("d-inline-block");
                }
            });
        }
    });

    $("form[name='createUser']").validate({
        rules: {
            username: {required:true,minlength:5},
            password: {required:true,minlength:6},
            confirm_password: { equalTo: '[name="password"]'}
        },
        errorPlacement: function(error, element) {
        if(element[0].id === "confirm_password") error.appendTo($(element).parents('div').find($('.errorCPass')));
        if(element[0].id ==='password') error.appendTo($(element).parents('div').find($('.errorPass')));
    },
        submitHandler: function (form, e) {
            e.preventDefault();
            var createUser = $('#createUser');
            var form_data = JSON.stringify(createUser.serializeObject());
            $("#createUserBtn").attr("disabled", true);
            $('#createUserBtn').css("cursor", 'not-allowed');
            $(".fa-spin").addClass("d-inline-block");

            $.ajax({
                url: "form-reducer-action.php",
                type: "POST",
                contentType: 'application/json',
                data: form_data,
                success: function (data) {
                    toastr.options = {"closeButton": true, "positionClass": "toast-top-right"};
                    toastr["success"](data.message);
                    setTimeout(function () {
                        document.getElementById("createUser").reset();
                        window.location.replace('user-list');
                    }, 1500);
                },
                error: function (errData) {
                    toastr.options = {"closeButton": true, "positionClass": "toast-top-right"};
                    toastr["error"](errData.responseJSON.message);
                },
                complete: function () {
                    $('#createUserBtn').attr("disabled", false);
                    $('#createUserBtn').css("cursor", 'pointer');
                    $(".fa-spin").removeClass("d-inline-block");
                }
            });
        }
    });

    $("form[name='updateAdmUser']").validate({
        rules: {
            edit_adm_username: {"required":true,minlength:3},
        },
        submitHandler: function (form, e) {
            e.preventDefault();
            var updateAdmUser = $('#updateAdmUser');
            var form_data = JSON.stringify(updateAdmUser.serializeObject());
            $("#updateAdmUserBtn").attr("disabled", true);
            $('#updateAdmUserBtn').css("cursor", 'not-allowed');
            $(".fa-spin").addClass("d-inline-block");

            $.ajax({
                url: "form-reducer-action.php",
                type: "POST",
                contentType: 'application/json',
                data: form_data,
                success: function (data) {
                    toastr["success"](data.message);
                    setTimeout(function () {
                        document.getElementById("updateAdmUser").reset();
                        window.location.replace('user-list');
                    }, 1000);
                },
                error: function (errData) {
                    toastr["error"](errData.responseJSON.message);
                },
                complete: function () {
                    $('#updateAdmUserBtn').attr("disabled", false);
                    $('#updateAdmUserBtn').css("cursor", 'pointer');
                    $(".fa-spin").removeClass("d-inline-block");
                }
            });
        }
    });

    $("form[name='createProduct']").validate({
        rules: {
            title: {"required":true,minlength:10},
            category: "required",
            slug: "required",
            image_1: "required",
            price: {"required":true,number:true},
        },
        submitHandler: function (form, e) {
            e.preventDefault();
            $("#createProductBtn").attr("disabled", true);
            $('#createProductBtn').css("cursor", 'not-allowed');
            $(".fa-spin").addClass("d-inline-block");

            $.ajax({
                url: "form-reducer-action-img.php",
                type: "POST",
                data: new FormData(form),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData:false,
                success: function (data) {
                    toastr["success"](data.message);
                    setTimeout(function () {
                        document.getElementById("createProduct").reset();
                        window.location.replace('product-list');
                    }, 1000);
                },
                error: function (errData) {
                    toastr["error"](errData.responseJSON.message);
                },
                complete: function () {
                    $('#createProductBtn').attr("disabled", false);
                    $('#createProductBtn').css("cursor", 'pointer');
                    $(".fa-spin").removeClass("d-inline-block");
                }
            });
        }
    });

    $("form[name='editProduct']").validate({
        rules: {
            title: {"required":true,minlength:10},
            category: "required",
            slug: "required",
            price: {"required":true,number:true},
        },
        submitHandler: function (form, e) {
            e.preventDefault();
            var editProduct = $('#editProduct');
            var form_data = JSON.stringify(editProduct.serializeObject());
            $("#editProductBtn").attr("disabled", true);
            $('#editProductBtn').css("cursor", 'not-allowed');
            $("#editProductBtn .fa-spin").addClass("d-inline-block");

            $.ajax({
                url: "form-reducer-action-img.php",
                type: "POST",
                data: new FormData(form),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData:false,
                success: function (data) {
                    toastr["success"](data.message);
                    setTimeout(function () {
                        document.getElementById("editProduct").reset();
                        window.location.replace('product-list');
                    }, 1000);
                },
                error: function (errData) {
                    toastr["error"](errData.responseJSON.message);
                },
                complete: function () {
                    $('#editProductBtn').attr("disabled", false);
                    $('#editProductBtn').css("cursor", 'pointer');
                    $("#editProductBtn .fa-spin").removeClass("d-inline-block");
                }
            });
        }
    });

    $("form[name='addBlogCategory']").validate({
        rules: {cat_name: {"required":true,minlength:3}},
        submitHandler: function (form, e) {
            e.preventDefault();
            var addBlogCategory = $('#addBlogCategory');
            var form_data = JSON.stringify(addBlogCategory.serializeObject());
            $("#addBlogCategoryBtn").attr("disabled", true);
            $('#addBlogCategoryBtn').css("cursor", 'not-allowed');
            $(".fa-spin").addClass("d-inline-block");

            $.ajax({
                url: "form-reducer-action.php",
                type: "POST",
                contentType: 'application/json',
                data: form_data,
                success: function (data) {
                    toastr.options = {"closeButton": true, "positionClass": "toast-top-right"};
                    toastr["success"](data.message);
                    setTimeout(function () {
                        document.getElementById("addBlogCategory").reset();
                        window.location.replace('blog-category');
                    }, 1500);
                },
                error: function (errData) {
                    toastr.options = {"closeButton": true, "positionClass": "toast-top-right"};
                    toastr["error"](errData.responseJSON.message);
                },
                complete: function () {
                    $('#addBlogCategoryBtn').attr("disabled", false);
                    $('#addBlogCategoryBtn').css("cursor", 'pointer');
                    $(".fa-spin").removeClass("d-inline-block");
                }
            });
        }
    });

    $("form[name='updateBlogCategory']").validate({
        rules: {edit_cat_name: {"required":true,minlength:3}},
        submitHandler: function (form, e) {
            e.preventDefault();
            var updateBlogCategory = $('#updateBlogCategory');
            var form_data = JSON.stringify(updateBlogCategory.serializeObject());
            $("#updateBlogCategoryBtn").attr("disabled", true);
            $('#updateBlogCategoryBtn').css("cursor", 'not-allowed');
            $(".fa-spin").addClass("d-inline-block");

            $.ajax({
                url: "form-reducer-action.php",
                type: "POST",
                contentType: 'application/json',
                data: form_data,
                success: function (data) {
                    toastr.options = {"closeButton": true, "positionClass": "toast-top-right"};
                    toastr["success"](data.message);
                    setTimeout(function () {
                        document.getElementById("updateBlogCategory").reset();
                        window.location.replace('blog-category');
                    }, 1000);
                },
                error: function (errData) {
                    toastr.options = {"closeButton": true, "positionClass": "toast-top-right"};
                    toastr["error"](errData.responseJSON.message);
                },
                complete: function () {
                    $('#updateBlogCategoryBtn').attr("disabled", false);
                    $('#updateBlogCategoryBtn').css("cursor", 'pointer');
                    $(".fa-spin").removeClass("d-inline-block");
                }
            });
        }
    });

    $("form[name='createBlog']").validate({
        rules: {
            title: {"required":true,minlength:10},
            category: "required",
            slug: "required",
            author: "required",
            image_1: "required",
            body: {"required":true,minlength:10},
        },
        submitHandler: function (form, e) {
            e.preventDefault();
            $("#createBlogBtn").attr("disabled", true);
            $('#createBlogBtn').css("cursor", 'not-allowed');
            $(".fa-spin").addClass("d-inline-block");

            $.ajax({
                url: "form-reducer-action-img.php",
                type: "POST",
                data: new FormData(form),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData:false,
                success: function (data) {
                    toastr["success"](data.message);
                    setTimeout(function () {
                        document.getElementById("createBlog").reset();
                        window.location.replace('blog-post');
                    }, 1000);
                },
                error: function (errData) {
                    toastr["error"](errData.responseJSON.message);
                },
                complete: function () {
                    $('#createBlogBtn').attr("disabled", false);
                    $('#createBlogBtn').css("cursor", 'pointer');
                    $(".fa-spin").removeClass("d-inline-block");
                }
            });
        }
    });

    $("form[name='editBlog']").validate({
        rules: {
            title: {"required":true,minlength:10},
            category: "required",
            slug: "required",
            author: "required",
            body: {"required":true,minlength:10},
        },
        submitHandler: function (form, e) {
            e.preventDefault();
            $("#editBlogBtn").attr("disabled", true);
            $('#editBlogBtn').css("cursor", 'not-allowed');
            $("#editBlogBtn .fa-spin").addClass("d-inline-block");

            $.ajax({
                url: "form-reducer-action-img.php",
                type: "POST",
                data: new FormData(form),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData:false,
                success: function (data) {
                    toastr["success"](data.message);
                    setTimeout(function () {
                        document.getElementById("editBlog").reset();
                        window.location.replace('blog-post');
                    }, 1000);
                },
                error: function (errData) {
                    toastr["error"](errData.responseJSON.message);
                },
                complete: function () {
                    $('#editBlogBtn').attr("disabled", false);
                    $('#editBlogBtn').css("cursor", 'pointer');
                    $("#editProductBtn .fa-spin").removeClass("d-inline-block");
                }
            });
        }
    });

    $("form[name='createInstallationHistory']").validate({
        rules: {
            name: "required",
            size: "required",
            components: "required",
            comp_date: "required",
            issues: "required",
            action: "required",
            issue_date: "required",
            resolved_date: "required",
            client_add: "required",
            client_city: "required",
            client_state: "required",
            client_email: {"required":true,email:true},
        },
        submitHandler: function (form, e) {
            e.preventDefault();
            var createInstallationHistory = $('#createInstallationHistory');
            var form_data = JSON.stringify(createInstallationHistory.serializeObject());
            $("#createInsHistoryBtn").attr("disabled", true);
            $('#createInsHistoryBtn').css("cursor", 'not-allowed');
            $(".fa-spin").addClass("d-inline-block");

            $.ajax({
                url: "form-reducer-action.php",
                type: "POST",
                contentType: 'application/json',
                data: form_data,
                success: function (data) {
                    toastr.options = {"closeButton": true, "positionClass": "toast-top-right"};
                    toastr["success"](data.message);
                    setTimeout(function () {
                        document.getElementById("createInstallationHistory").reset();
                        window.location.replace('installation-histories');
                    }, 1000);
                },
                error: function (errData) {
                    toastr.options = {"closeButton": true, "positionClass": "toast-top-right"};
                    toastr["error"](errData.responseJSON.message);
                },
                complete: function () {
                    $('#createInsHistoryBtn').attr("disabled", false);
                    $('#createInsHistoryBtn').css("cursor", 'pointer');
                    $(".fa-spin").removeClass("d-inline-block");
                }
            });
        }
    });

    $("form[name='createMaintenanceHistory']").validate({
        rules: {
            project_id: "required",
            name: "required",
            size: "required",
            components: "required",
            comp_date: "required",
            issues: "required",
            action: "required",
            issue_date: "required",
            resolved_date: "required",
            client_add: "required",
            client_city: "required",
            client_state: "required",
            client_email: {"required":true,email:true},
        },
        submitHandler: function (form, e) {
            e.preventDefault();
            var createMaintenanceHistory = $('#createMaintenanceHistory');
            var form_data = JSON.stringify(createMaintenanceHistory.serializeObject());
            $("#createMainHistoryBtn").attr("disabled", true);
            $('#createMainHistoryBtn').css("cursor", 'not-allowed');
            $(".fa-spin").addClass("d-inline-block");

            $.ajax({
                url: "form-reducer-action.php",
                type: "POST",
                contentType: 'application/json',
                data: form_data,
                success: function (data) {
                    toastr.options = {"closeButton": true, "positionClass": "toast-top-right"};
                    toastr["success"](data.message);
                    setTimeout(function () {
                        document.getElementById("createMaintenanceHistory").reset();
                        window.location.replace('maintenance-histories');
                    }, 1000);
                },
                error: function (errData) {
                    toastr.options = {"closeButton": true, "positionClass": "toast-top-right"};
                    toastr["error"](errData.responseJSON.message);
                },
                complete: function () {
                    $('#createMainHistoryBtn').attr("disabled", false);
                    $('#createMainHistoryBtn').css("cursor", 'pointer');
                    $(".fa-spin").removeClass("d-inline-block");
                }
            });
        }
    });

});

$(document).on("click", "#delete_category", function (e) {
    e.preventDefault();
    var cat_id = $(this).data("id");
    var r = confirm("Are you sure you want to delete category?");
    if (r===true){
        $.ajax({
            url: "form-reducer-action.php", type: "POST",
            data: JSON.stringify({cat_id:cat_id,action_code:102}),
            success: function (data) {
                toastr["success"](data.message);
                setTimeout(function () {window.location.replace('product-category'); }, 500);
            },
            error: function (errData)  {toastr["error"](data.message); }
        });
    }
});

$(document).on("click", "#edit_category", function (e) {
    e.preventDefault();
    var cat_id = $(this).data("id");
    var cat_name = $(this).data("cat_name");
    $("#edit_cat_name").val(cat_name);
    $("#edit_cat_id").val(cat_id);
});

$(document).on("click", "#ApprovedProductBtn", function (e) {
    e.preventDefault();
    var pid = $(this).data("id");
    var status = $(this).data("status");
    var r = confirm("Are you sure you want to update product status?");
    $("#ApprovedProductBtn").attr("disabled", true);
    $('#ApprovedProductBtn').css("cursor", 'not-allowed');$(".fa-spin").addClass("d-inline-block");

    if (r===true){
        $.ajax({
            url: "form-reducer-action.php", type: "POST",
            data: JSON.stringify({pid:pid,status:status,action_code:604}),
            success: function (data) {
                toastr["success"](data.message);
                setTimeout(function () {window.location.replace('product-list'); }, 500);
            },
            error: function (errData)  {toastr["error"](data.message); },
            complete: function () {
                $('#ApprovedProductBtn').attr("disabled", false);
                $('#ApprovedProductBtn').css("cursor", 'pointer');$(".fa-spin").removeClass("d-inline-block");
            }
        });
    } else {
        $('#ApprovedProductBtn').attr("disabled", false);
        $('#ApprovedProductBtn').css("cursor", 'pointer');$(".fa-spin").removeClass("d-inline-block");
    }
});


$(document).on("click", "#StockProductBtn", function (e) {
    e.preventDefault();
    var pid = $(this).data("id");
    var status = $(this).data("status");
    var r = confirm("Are you sure you want to update product stock status?");
    $("#StockProductBtn").attr("disabled", true);
    $('#StockProductBtn').css("cursor", 'not-allowed');$(".fa-spin").addClass("d-inline-block");

    if (r===true){
        $.ajax({
            url: "form-reducer-action.php", type: "POST",
            data: JSON.stringify({pid:pid,status:status,action_code:605}),
            success: function (data) {
                toastr["success"](data.message);
                setTimeout(function () {window.location.replace('product-list'); }, 500);
            },
            error: function (errData)  {toastr["error"](data.message); },
            complete: function () {
                $('#StockProductBtn').attr("disabled", false);
                $('#StockProductBtn').css("cursor", 'pointer');$(".fa-spin").removeClass("d-inline-block");
            }
        });
    } else {
        $('#StockProductBtn').attr("disabled", false);
        $('#StockProductBtn').css("cursor", 'pointer');$(".fa-spin").removeClass("d-inline-block");
    }
});

$(document).on("click", "#delete_adm_user", function (e) {
    e.preventDefault();
    var admin_id = $(this).data("id");
    var r = confirm("Are you sure you want to delete admin user?");
    if (r===true){
        $.ajax({
            url: "form-reducer-action.php", type: "POST",
            data: JSON.stringify({admin_id:admin_id,action_code:402}),
            success: function (data) {
                toastr["success"](data.message);
                setTimeout(function () {window.location.replace('user-list'); }, 500);
            },
            error: function (errData)  {toastr["error"](data.message); }
        });
    }
});

$(document).on("click", "#edit_adm_user", function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    var user = $(this).data("user");

    $("#edit_adm_id").val(id);
    $("#edit_adm_username").val(user);
});

$(document).on("click", "#delete_product", function (e) {
    e.preventDefault();
    var product_id = $(this).data("id");
    var r = confirm("Are you sure you want to delete product?");
    if (r===true){
        $.ajax({
            url: "form-reducer-action.php", type: "POST",
            data: JSON.stringify({product_id:product_id,action_code:602}),
            success: function (data) {
                toastr["success"](data.message);
                setTimeout(function () {window.location.replace('product-list'); }, 500);
            },
            error: function (errData)  {toastr["error"](data.message); }
        });
    }
});

$(document).on("click", "#delete_blog_category", function (e) {
    e.preventDefault();
    var cat_id = $(this).data("id");
    var r = confirm("Are you sure you want to delete blog category?");
    if (r===true){
        $.ajax({
            url: "form-reducer-action.php", type: "POST",
            data: JSON.stringify({cat_id:cat_id,action_code:702}),
            success: function (data) {
                toastr["success"](data.message);
                setTimeout(function () {window.location.replace('blog-category'); }, 500);
            },
            error: function (errData)  {toastr["error"](data.message); }
        });
    }
});

$(document).on("click", "#ApprovedBlogBtn", function (e) {
    e.preventDefault();
    var pid = $(this).data("id");
    var status = $(this).data("status");
    var r = confirm("Are you sure you want to update blog post status?");
    $("#ApprovedBlogBtn").attr("disabled", true);
    $('#ApprovedBlogBtn').css("cursor", 'not-allowed');$(".fa-spin").addClass("d-inline-block");

    if (r===true){
        $.ajax({
            url: "form-reducer-action.php", type: "POST",
            data: JSON.stringify({pid:pid,status:status,action_code:804}),
            success: function (data) {
                toastr["success"](data.message);
                setTimeout(function () {window.location.replace('blog-post'); }, 500);
            },
            error: function (errData)  {toastr["error"](data.message); },
            complete: function () {
                $('#ApprovedBlogBtn').attr("disabled", false);
                $('#ApprovedBlogBtn').css("cursor", 'pointer');$(".fa-spin").removeClass("d-inline-block");
            }
        });
    } else {
        $('#ApprovedBlogBtn').attr("disabled", false);
        $('#ApprovedBlogBtn').css("cursor", 'pointer');$(".fa-spin").removeClass("d-inline-block");
    }
});