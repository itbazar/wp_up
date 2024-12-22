<div id="wupp_pnl_forgot" class="wupp-content col-12 col-md-6 position-absolute <?php echo $is_restore_link ? '' : 'd-none';?> fade_in_to_left">
    <div class="row">
        <div class="col-12 p-0 mb-3">
            <h1 class="text-center mt-4"><?php echo __('Forget password', 'user-panel-pro'); ?></h1>
        </div>
        <div class="col-12 pr-md-5 pl-md-5">
            <div id="forgetFormState" class="alert d-none" role="alert">
            </div>
        </div>
        <div class="col-12 p-0">
            <form action="<?php echo admin_url(); ?>admin-ajax.php" method="post" class="<?php echo $is_restore_link ? 'd-none' : '';?>" id="forget_form">

                <div class="col-12 mb-4">
                    <div class="row">
                        <div class="col-12 pr-5 pl-5">
                            <?php do_action('wupp_before_forget_form'); ?>
                            <div class="form-group">
                                <input class="form-control w-100 wupp-lg-input mb-3"
                                       type="text"
                                       name="user_login"
                                       id="forget_user_login"
                                       placeholder="<?php echo apply_filters('wupp_forget_input_lable', __('Email or userName', 'user-panel-pro')); ?>"
                                       maxlength="160">
                            </div>
                            <?php do_action( 'lostpassword_form' );?>
                            <?php do_action('wupp_after_forget_form'); ?>
                        </div>

                        <?php do_action('wupp_end_forget_form', 'forget_captcha_element');?>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-5 pr-5 pl-5 float-end">
                    <button type="submit"
                            id="btn_sub_forget"
                            class="btn btn-sm btn-outline-primary w-100 pr-1 pl-1 float-end">
                        <?php echo __('Restore', 'user-panel-pro'); ?>
                    </button>
                </div>
            </form>
        </div>
        <div class="clearfix"></div>
        <div class="col-12 <?php echo $is_restore_link ? '' : 'd-none';?>" id="wupp_forget_auth_pnl">
            <p class="pr-4 pl-4"><?php echo __('Fill required data to reset your password!', 'user-panel-pro'); ?></p>
            <?php $pre_connect  = 'forget_';?>
            <?php include WUPP_TPL . 'login/forms/auth_code.php'; ?>
        </div>
        <div class="clearfix"></div>
        <div class="col-12">
            <hr>
        </div>
        <div class="col-12">
            <div class="w-100 align-content-center text-center">
                <button
                        onclick="jQuery('#wupp_pnl_sign_in').removeClass('d-none');jQuery('#wupp_pnl_forgot').addClass('d-none');"
                        class="btn btn-link text-decoration-none text-dark bg-transparent"><?php echo __('Remember your information?', 'user-panel-pro'); ?>
                </button>
            </div>
        </div>
    </div>
</div>