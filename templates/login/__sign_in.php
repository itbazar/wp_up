<div id="wupp_pnl_sign_in" class="<?php echo $is_restore_link ? 'd-none' : ''; ?> wupp-content col-12 col-md-6 position-absolute fade_in_to_left">

    <div class="row">
        <div class="col-12 p-0">
            <h1 class="text-center mt-4 mb-3"><?php echo __('Login', 'user-panel-pro'); ?></h1>
        </div>
        <div class="col-12 pr-5 pl-5 pt-1 pb-1">
            <div id="content_view_res"></div>
        </div>

        <?php do_action('wupp_before_login_form'); ?>
        <div class="col-12 pr-md-5 pl-md-5">
            <div id="signinFormState" class="alert d-none" role="alert">
            </div>
        </div>
        <div class="col-12 p-0">
            <form method="post" id="form_sign_in">
                <div class="col-12 mt-2">
                    <div class="row">
                        <?php do_action('wupp_start_login_form'); ?>
                        <?php $login_method = isset($login_method) ? $login_method : ''; ?>
                        <?php
                        if (is_null($login_method) || empty($login_method)) {
                            $is_default = true;
                            include_once WUPP_TPL . 'login/forms/default.php';
                        } else {
                            do_action('wupp_handel_login_form', $login_settings);
                        }
                        ?>
                        <?php do_action('wupp_end_login_form', 'login_captcha_element'); ?>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-6 pr-5 pl-5 float-end">
                    <button type="submit" id="wupp_sign_in_btn" class="btn btn-sm btn-outline-primary w-100 pr-5 pl-5 float-end">
                        <?php echo __("Login", "user-panel-pro") ?>
                    </button>
                </div>
                <?php do_action('wupp_login_form_button'); ?>
            </form>
        </div>

        <div class="clearfix"></div>
        <div class="col-12 d-none" id="wupp_sign_in_auth_pnl">
            <p class="pr-4 pl-4"><?php echo __('To enter, enter the verification code sent in this section!', 'user-panel-pro'); ?></p>
            <?php $pre_connect  = 'sign_in_'; ?>
            <?php include WUPP_TPL . 'login/forms/auth_code.php'; ?>
        </div>
        <?php do_action('wupp_after_login_form', $login_settings); ?>
        <div class="clearfix"></div>
        <div class="col-12">
            <hr>
        </div>
        <div class="col-12 p-0 w-100 align-content-center text-center">
            <?php if (isset($login_settings['forget_permission']) && $login_settings['forget_permission']) : ?>
                <button onclick="jQuery('#wupp_pnl_forgot').removeClass('fade_out_to_right fade_out_to_left d-none');jQuery('#wupp_pnl_sign_in').addClass('d-none');" class="btn btn-link text-decoration-none text-dark bg-transparent">
                    <?php echo __("Forgot your login information?", "user-panel-pro") ?>
                </button>
            <?php endif; ?>
            <br>
            <?php if (isset($login_settings['register_permission']) && $login_settings['register_permission']) : ?>
                <button onclick="load_sign_up()" class="btn btn-link text-decoration-none text-dark bg-transparent"><?php echo __('Create account', 'user-panel-pro'); ?>
                </button>
            <?php endif; ?>
        </div>
    </div>
</div>