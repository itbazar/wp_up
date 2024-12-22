<div class="col-12 pr-5 pl-5">
    <div class="form-group">
        <input class="form-control w-100 wupp-lg-input mb-3" type="text" name="user_login" id="sign_in_user_name" placeholder="<?php echo __("Email or username", "user-panel-pro") ?>" maxlength="160">
    </div>

    <div class="form-group">
        <input class="form-control w-100 wupp-lg-input mt-3" type="password" name="password" id="sign_in_password" placeholder="<?php echo __("Password", "user-panel-pro") ?>" maxlength="60">
    </div>
</div>
<div class="col-12 pr-4 pl-4">
    <div class="pr-2 pl-2">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <div class="custom-control custom-checkbox mb-3">
                        <input type="checkbox" class="custom-control-input" name="wupp_sign_in_remember_me" id="wupp_sign_in_remember_me">
                        <label class="custom-control-label" for="wupp_sign_in_remember_me"></label>
                        <span class="pr-4 pl-4 mr-1 ml-1"><?php echo __('remember me', 'user-panel-pro'); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script data-role="wupp">
    loadingTag = '<span class="spinner-border spinner-border-sm" role="status"></span>';
    var isFirefox = navigator.userAgent.toLowerCase().indexOf('firefox') > -1;
    function sign_in(btn) {
        jQuery('#signinFormState')
            .addClass('d-none');
        var user_name = jQuery('#sign_in_user_name').val();
        var password = jQuery('#sign_in_password').val();
        var token = jQuery('#token').val();
        var remember_me = jQuery('#wupp_sign_in_remember_me').is(":checked") ? 1 : 0;

        if (!token) {
            token = '';
        }

        if (user_name && password) {
            jQuery(btn)
                .addClass('disabled')
                .attr('disabled', 'disabled')
                .html(loadingTag);
            $.ajax({
                data: {
                    action: 'wupp_sign_in',
                    user_name: user_name,
                    user_login: user_name,
                    password: password,
                    remember_me: remember_me,
                    token: token,
                },
                type: 'POST',
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                complete: function() {
                    setTimeout(function() {
                    jQuery(btn)
                        .removeClass('disabled')
                        .removeAttr('disabled', 'disabled')
                        .html('<?php echo __("Login", "user-panel-pro") ?>');
                    }, 500);
                },
                success: function(response) {
                    setTimeout(function() {
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
                error: function(e) {
                    jQuery('#signinFormState')
                        .html(e)
                        .addClass('alert-danger')
                        .removeClass('d-none');
                }
            });
        } else {
            jQuery('#signinFormState')
                .html('<?php echo __('Complete form', 'user-panel-pro'); ?>')
                .addClass('alert-danger')
                .removeClass('d-none');
        }
    }
</script>