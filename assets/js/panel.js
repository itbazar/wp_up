
jQuery(document).ready(function () {
    jQuery('#wupp_edit_profile_form').on('submit', function (event) {
        event.preventDefault();
        var btn = jQuery("button[id='wupp_update_profile']");
        var title = jQuery(btn).html();
        var items = jQuery('#wupp_edit_profile_form').serializeArray();
        items.push({
            name: 'action',
            value: 'wupp_update_profile'
        });
        jQuery(btn).attr('disabled', 'disabled').addClass('disabled').html('<div class="spinner-grow text-primary spinner-grow-sm" role="status"></div>');

        jQuery.ajax({
            url: jQuery(btn).attr('data-url'),
            type: 'POST',
            data: items,
            complete: function () {
                jQuery(btn).removeAttr('disabled', 'disabled').removeClass('disabled').html(title);
            },
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: response.message,
                    showConfirmButton: false,
                    timer: 2000
                })
            },
            error: function (error) {
                Swal.fire({
                    icon: 'error',
                    title: error.message,
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        })
    })
});

// user panel pro js
/*========================
    account settings part
========================*/
// upload avatar
jQuery(document).ready(function () {
    // Update user photo on click of button
    accountUploadWrapper = jQuery('#account-vertical-general .media');
    accountUploadBtn = jQuery('#account-upload');
    accountUploadUrl = jQuery('input[name="upload-avatar-data"]').data("url");
    if (accountUploadBtn) {
        accountUploadBtn.on('change', function (e) {
            //set wait
            accountUploadWrapper.block({
                message: '<div class="spinner-border text-primary" role="status"></div>',
                css: {
                    backgroundColor: 'transparent',
                    border: '0'
                },
                overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.8
                }
            });
            if (jQuery(this).val() !== '') {
                //upload image
                var image = jQuery(this)[0].files[0];

                //init data
                var formdata = new FormData();
                formdata.append('image', image);
                formdata.append('action', 'wupp_ajax_request_upload_avatar');

                jQuery.ajax({
                    url: accountUploadUrl,
                    type: 'post',
                    data: formdata,
                    contentType: false,
                    processData: false,
                    complete: function () {
                        accountUploadWrapper.unblock();
                    },
                    success: function (response) {
                        if (response.success) {
                            jQuery('#account-upload-img').attr('src', response.data.url);
                            Swal.fire({
                                icon: 'success',
                                title: response.data.message,
                                showConfirmButton: false,
                                timer: 3000
                            })
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: response.data.message,
                                showConfirmButton: false,
                                timer: 3000
                            })
                        }
                    },
                });
            }

        });
    }
});
// edite accoutn general form
jQuery(document).ready(function () {
    jQuery('#wupp-edit-account-general').on('submit', function (event) {
        event.preventDefault();
        jQuery('#wupp-edit-account-general').block({
            message: '<div class="spinner-border text-primary" role="status"></div>',
            css: {
                backgroundColor: 'transparent',
                border: '0'
            },
            overlayCSS: {
                backgroundColor: '#fff',
                opacity: 0.8
            }
        });
        var items = jQuery('#wupp-edit-account-general').serializeArray();
        items.push({
            name: 'action',
            value: 'wupp_edit_account_general'
        });
        jQuery.ajax({
            url: this.action,
            type: 'POST',
            data: items,
            complete: function () {
                jQuery('#wupp-edit-account-general').unblock();
            },
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: response.message,
                    showConfirmButton: false,
                    timer: 2000
                })
            },
            error: function (error) {
                Swal.fire({
                    icon: 'error',
                    title: error.message,
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        })
    })
});

// edit account change pass form
jQuery(document).ready(function () {
    var change_pass_obj = jQuery('#wupp-edit-account-password');
    change_pass_obj.on('submit', function (event) {
        event.preventDefault();
        change_pass_obj.block({
            message: '<div class="spinner-border text-primary" role="status"></div>',
            css: {
                backgroundColor: 'transparent',
                border: '0'
            },
            overlayCSS: {
                backgroundColor: '#fff',
                opacity: 0.8
            }
        });
        var items = change_pass_obj.serializeArray();
        items.push({
            name: 'action',
            value: 'wupp_edit_account_password'
        });
        jQuery.ajax({
            url: this.action,
            type: 'POST',
            data: items,
            complete: function () {
                change_pass_obj.unblock();
            },
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 2000
                    })
                } else {
                    console.log(response);
                    Swal.fire({
                        title: response.data.message,
                        icon: 'warning',
                        showConfirmButton: false,
                        timer: 5700
                    });
                }
            },
            error: function (error) {
            }
        })
    })
});


