<div class="d-none d-md-block col-12 col-md-6 overlay-left-fo position-absolute
                text-center align-content-center position-relative pt-5" id="wupp_des_pnl">
    <div id="wupp_p_login" class="p-3">
       <?php echo nl2br($login_settings['login_side_message_one']); ?>
    </div>
    <div id="wupp_p_signup" class="p-3 d-none">
        <?php echo nl2br($login_settings['login_side_message_two']); ?>
    </div>

    <div class="position-absolute w-100" style="bottom: 65px; left: 0; right: 0;">
        <?php if ($login_settings['register_permission']): ?>
            <button id="wupp_btn_signup" onclick="load_sign_up()"
                    class="btn btn-outline-light pr-4 pl-4"><?php echo __('Register', 'user-panel-pro') ?></button>
        <?php endif; ?>
        <button id="wupp_btn_login" onclick="load_sign_in()"
                class="btn btn-outline-light pr-4 pl-4 d-none"><?php echo __('Login', 'user-panel-pro') ?></button>
    </div>
</div>