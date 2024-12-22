<?php
$is_restore_link = WUPPTools::is_restore_request();
do_action('wupp_start_login_page');
?>

    <script type="text/javascript" src="<?php echo WUPP_ASSETS_JS . 'wupp-login.js' ?>"></script>
    <script type="text/javascript" src="<?php echo WUPP_ASSETS_JS . 'login-global.js' ?>"></script>

    <br>
    <div class="wupp col-11 col-md-10 card bg-white shadow-lg border-0 wupp-p login-pnl">
        <?php $is_default = false; ?>
        <div class="row">
            <?php include_once WUPP_TPL . 'login/__sign_in.php' ?>
            <?php if ($login_settings['forget_permission']) : ?>
                <?php include_once WUPP_TPL . 'login/__forget.php' ?>
            <?php endif; ?>
            <?php if ($login_settings['register_permission']) : ?>
                <?php include_once WUPP_TPL . 'login/__register.php' ?>
            <?php endif; ?>
            <?php include_once WUPP_TPL . 'login/__side.php' ?>
        </div>
    </div>


<?php
if (WUPPAdminViews::get_option('login_show_back_btn', 1)) {
    $btn_position = WUPPAdminViews::get_option('login_back_btn_position', 'Left');
    include WUPP_TPL . 'login/back_button.php';
}
?>


    <script data-role="wupp">
        const loadingTag = '<span class="spinner-border spinner-border-sm" role="status"></span>'
        <?php
        if ($is_default != true) : ?>
        $(document).ready(function () {
            $("#wupp_sign_in_btn").on("click", function (e) {
                e.preventDefault();
                sign_in($(this), false)
            });
            $("#wupp_sign_in_code_btn").on("click", function (e) {
                e.preventDefault();
                sign_in($(this), true)
            });
        });

        function sign_in(btn, id_main) {
            var btn_title = jQuery(btn).html();
            jQuery('#signinFormState')
                .addClass('d-none')
            var form = jQuery('#form_sign_in');
            var data = [];
            if (id_main !== undefined && id_main === true) {
                var vv = jQuery(jQuery(form).find("input[name='user_login']")[0]).val();
                id_main = vv !== undefined && vv !== '';
                data.push({
                    name: 'user_login',
                    value: vv
                });
                data.push({
                    name: 'action',
                    value: 'wupp_sign_in'
                });
            } else {
                data = jQuery(form).serializeArray();
                data.push({
                    name: 'action',
                    value: 'wupp_sign_in'
                });
                // check persian and arabic numbers
                data = $.each(data, function (i, field) {
                    field.value = convert_number.toNormal(field.value);
                });
            }
            if (!id_main) {
                jQuery(form).find('input').each(function () {
                    var name = jQuery(this).attr('name');
                    if (jQuery(this).val() === '' && name !== 'token') {
                        data = false;
                    }
                });
            }
            if (data || id_main) {
                jQuery(btn)
                    .addClass('disabled')
                    .attr('disabled', 'disabled')
                    .html(loadingTag);

                $.ajax({
                    data: data,
                    type: 'POST',
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    complete: function () {
                        setTimeout(function () {
                            jQuery(btn)
                                .removeClass('disabled')
                                .removeAttr('disabled', 'disabled')
                                .html(btn_title);
                        }, 500);
                    },
                    success: function (response) {
                        setTimeout(function () {
                            if (response.result === 2) {
                                jQuery('#signinFormState')
                                    .html(response.message)
                                    .removeClass('alert-danger')
                                    .addClass('alert-success')
                                    .removeClass('d-none');
                                const queryString = window.location.search;
                                const urlParams = new URLSearchParams(queryString);
                                const redirect = urlParams.get('redirect_to')
                                if (redirect) {
                                    location.replace(redirect);
                                } else
                                    location.replace(response.redirect_url);
                            } else if (response.result === 1) {
                                jQuery('#form_sign_in').addClass('d-none');
                                jQuery('#wupp_sign_in_auth_pnl').removeClass('d-none');
                                jQuery('#sign_in_auth_helper').val(response.auth_helper);
                                if (response.auth_type !== undefined && response.auth_type !== null && response.auth_type !== '') {
                                    jQuery('#sign_in_auth_type').val(response.auth_type);
                                }
                                start_auth_time(jQuery('#sign_in_wupp_try_new_code'));
                            } else if (response.result === 3) {
                                jQuery('#content_view_res').html(response.view);
                            } else if (response.result === 4) {
                                jQuery('#signinFormState')
                                    .html('<?php echo __('Account not found, register if you do not have an account', 'user-panel-pro'); ?><button class="btn btn-link text-decoration-none" onclick="load_sign_up()"><ins><?php _e('sign up', 'user-panel-pro'); ?></ins></button>')
                                    .addClass('alert-danger')
                                    .removeClass('d-none');
                            } else if (response.result === 0) {
                                jQuery('#signinFormState')
                                    .html(response.message)
                                    .addClass('alert-danger')
                                    .removeClass('d-none');
                            } else {
                                jQuery('#signinFormState')
                                    .html(response.message)
                                    .addClass('alert-danger')
                                    .removeClass('d-none');
                            }
                        }, 500);
                    },
                    error: function (e) {
                        jQuery('#signinFormState')
                            .html(e)
                            .addClass('alert-danger')
                            .removeClass('d-none');
                    }
                });
            } else {
                jQuery('#signinFormState')
                    .html('<?php echo __('Complete form!', 'user-panel-pro'); ?>')
                    .addClass('alert-danger')
                    .removeClass('d-none');
            }
        }
        <?php endif; ?>

        jQuery(document).ready(function () {
            jQuery('#um_default_css-inline-css').remove();
            jQuery('#form_sign_up').on('submit', function (e) {
                e.preventDefault();
                jQuery('#signupFormState')
                    .addClass('d-none');
                var sign_up_allow = true;
                var password = '';
                jQuery(this).find("input").each(function () {
                    var required = jQuery(this).attr('data-required');
                    var value = jQuery(this).val();

                    if (required && required === 'required' && !value) {
                        sign_up_allow = false;
                        jQuery(this).addClass('danger-border');
                        jQuery('#signupFormState')
                            .html('<?php echo __('Fill in the star fields', 'user-panel-pro') ?>')
                            .addClass('alert-danger')
                            .removeClass('d-none');
                    } else {
                        jQuery(this).removeClass('danger-border');
                    }

                    if (jQuery(this).attr('name') === 'password') {
                        password = jQuery(this).val();
                    } else if (jQuery(this).attr('name') === 'password_repeat') {
                        if (password !== jQuery(this).val()) {
                            sign_up_allow = false;
                            jQuery(this).addClass('danger-border');
                            jQuery('#signupFormState')
                                .html('<?php echo __('Passwords is wrong') ?>')
                                .addClass('alert-danger')
                                .removeClass('d-none');
                        }
                    }
                });

                if (sign_up_allow) {
                    var btn = jQuery('#btn_sub_sign_up');
                    if (jQuery('#check_box_wupp_remember_me').is(':checked')) {
                        var data = jQuery(this).serializeArray();
                        data.push({
                            name: 'action',
                            value: 'wupp_sign_up'
                        });
                        jQuery(btn)
                            .addClass('disabled')
                            .attr('disabled', 'disabled')
                            .html(loadingTag);
                        $.ajax({
                            data: data,
                            type: 'POST',
                            url: '<?php echo admin_url('admin-ajax.php'); ?>',
                            complete: function () {
                                jQuery(btn)
                                    .removeClass('disabled')
                                    .removeAttr('disabled', 'disabled')
                                    .html('<?php echo __("Register", "user-panel-pro") ?>');
                            },
                            success: function (response) {
                                if (response.result === 2) {
                                    jQuery('#signupFormState')
                                        .html(response.message)
                                        .removeClass('alert-danger')
                                        .addClass('alert-success')
                                        .removeClass('d-none');
                                    const queryString = window.location.search;
                                    const urlParams = new URLSearchParams(queryString);
                                    const redirect = urlParams.get('redirect_to')
                                    if (redirect) {
                                        location.replace(redirect);
                                    } else
                                        location.replace(response.redirect_url);
                                } else if (response.result === 1) {
                                    jQuery('#sign_up_auth').removeClass('d-none');
                                    jQuery('#form_sign_up').addClass('d-none');
                                    jQuery('#register_auth_helper').val(response.auth_helper);
                                    jQuery('#register_auth_type').val(response.auth_type);
                                    start_auth_time(jQuery('#register_wupp_try_new_code'));
                                } else if (response.result === 0) {
                                    jQuery('#signupFormState')
                                        .html(response.message)
                                        .addClass('alert-danger')
                                        .removeClass('d-none');
                                } else {
                                    jQuery('#signupFormState')
                                        .html(response.message)
                                        .addClass('alert-danger')
                                        .removeClass('d-none');
                                }
                            },
                            error: function (e) {
                                jQuery('#signupFormState')
                                    .html(e)
                                    .removeClass('d-none');
                            }
                        });
                    } else {
                        jQuery('#signupFormState')
                            .html('<?php echo __('accept the rules', 'user-panel-pro'); ?>')
                            .removeClass('d-none');
                    }
                }
            });
            jQuery('#form_sign_in').on('submit', function (e) {
                e.preventDefault();
                sign_in(jQuery('#btn_sub_sign_in'));
            });
            jQuery('#forget_form').on('submit', function (e) {
                e.preventDefault();
                forgot(jQuery('#btn_sub_forget'));
            });
        });

        function forgot(btn) {
            var user_login = true;
            var form = jQuery('#forget_form');
            var form_data = jQuery(form).serializeArray();
            form_data.push({
                name: 'action',
                value: 'wupp_forget'
            });
            jQuery('#forgetFormState').addClass('d-none');

            jQuery(form).find('input').each(function () {
                var name = jQuery(this).attr('name');
                var val = jQuery(this).val();
                if (name !== 'token' && (val === undefined || val === '')) {
                    user_login = false;
                }
            });

            if (user_login) {
                jQuery(btn)
                    .addClass('disabled')
                    .attr('disabled', 'disabled')
                    .html(loadingTag);
                $.ajax({
                    data: form_data,
                    type: 'POST',
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    complete: function () {
                        jQuery(btn)
                            .removeClass('disabled')
                            .removeAttr('disabled', 'disabled')
                            .html('<?php echo __("Restore", "user-panel-pro") ?>');
                    },
                    success: function (response) {
                        if (response.result === 1) {
                            jQuery('#wupp_forget_auth_pnl').removeClass('d-none');
                            jQuery('#forget_form').addClass('d-none');
                            jQuery('#forget_auth_helper').val(response.auth_helper);
                            jQuery('#forget_auth_type').val('verify_restore');
                            start_auth_time(jQuery('#forget_wupp_try_new_code'));
                        } else if (response.result === 2) {
                            jQuery('#forgetFormState')
                                .html(response.message)
                                .removeClass('alert-danger')
                                .addClass('alert-success')
                                .removeClass('d-none');
                        } else {
                            jQuery('#forgetFormState')
                                .html(response.message)
                                .addClass('alert-danger')
                                .removeClass('d-none');
                        }
                    },
                    error: function (e) {
                        jQuery('#forgetFormState')
                            .html(e)
                            .addClass('alert-danger')
                            .removeClass('d-none');
                    }
                });
            } else {
                jQuery('#forgetFormState')
                    .html('<?php echo __('Complete form inputs', 'user-panel-pro'); ?>')
                    .addClass('alert-danger')
                    .removeClass('d-none');
            }
        }

        function auth_in(btn, form_id) {
            var form = jQuery(form_id);
            var data = jQuery(form).serializeArray();
            data = $.each(data, function (i, field) {
                field.value = convert_number.toNormal(field.value);
            });
            data.push({
                name: 'action',
                value: 'wupp_auth'
            });
            // jQuery(form).find('input').each(function() {
            //     var name = jQuery(this).attr('name');
            //     if (jQuery(this).val() === '' && name !== 'token' && name !== 'sign_in_auth_type') {
            //         data = false;
            //     }
            // });
            jQuery('#message_auth')
                .addClass('d-none');
            if (data) {
                jQuery(btn)
                    .addClass('disabled')
                    .attr('disabled', 'disabled')
                    .html(loadingTag);

                $.ajax({
                    data: data,
                    type: 'POST',
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    complete: function () {
                        jQuery(btn)
                            .removeClass('disabled')
                            .removeAttr('disabled', 'disabled')
                            .html('<?php echo __("authentication", "user-panel-pro"); ?>');
                    },
                    success: function (response) {
                        if (response.result === 2) {
                            const queryString = window.location.search;
                            const urlParams = new URLSearchParams(queryString);
                            const redirect = urlParams.get('redirect_to')
                            if (redirect) {
                                location.replace(redirect);
                            } else
                                location.replace(response.redirect_url);
                        } else if (response.result === 1) {
                            jQuery('#forget_wupp_change_password_pnl').prev().addClass('d-none');
                            jQuery('#forget_wupp_change_password_pnl').html(response.content);
                        } else {
                            jQuery('#message_auth')
                                .html(response.message)
                                .removeClass('d-none');
                        }
                    },
                    error: function (e) {
                        jQuery('#message_auth')
                            .html('<?php echo __('No internet connection!', 'user-panel-pro') ?>')
                            .removeClass('d-none');
                    }
                });
            } else {
                jQuery('#message_auth')
                    .html('<?php echo __('Complete form!', 'user-panel-pro'); ?>')
                    .removeClass('d-none');
            }
        }

        function start_auth_time(btn) {
            jQuery(btn)
                .addClass('disabled')
                .attr('disabled', 'disabled')
                .html('<?php echo __('Send code again', 'user-panel-pro'); ?>');
            var time = <?php echo class_exists('WUPPRLTools') ? WUPPRLTools::get_sms_otp_send_again_time() : 0; ?>;
            $time_id = setInterval(function () {
                --time;
                jQuery(btn).html(time);
                if (time <= 0) {
                    jQuery(btn).html('<?php echo __('Send code again', 'user-panel-pro'); ?>').removeAttr('disabled').removeClass('disabled');
                    clearInterval($time_id);
                }
            }, 1000);
        }

        function try_again(btn, helper_id, type) {
            jQuery(btn)
                .addClass('disabled')
                .attr('disabled', 'disabled')
                .html(loadingTag);
            helper = jQuery('#' + helper_id).val();
            var data = [{
                name: 'helper',
                value: helper
            },
                {
                    name: 'type',
                    value: type
                }
            ];
            data.push({
                name: 'action',
                value: 'wupp_try_again'
            });
            $.ajax({
                data: data,
                type: 'POST',
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                complete: function () {
                    jQuery(btn)
                        .removeClass('disabled')
                        .removeAttr('disabled', 'disabled')
                        .html('<?php echo __("Send code again", "user-panel-pro"); ?>');
                },
                success: function (response) {
                    start_auth_time(btn)
                },
                error: function (e) {
                    jQuery('#message_auth')
                        .html('<?php echo __('No internet connection!', 'user-panel-pro') ?>')
                        .removeClass('d-none');
                }
            });
        }
    </script>

<?php do_action('wupp_end_login_page'); ?>