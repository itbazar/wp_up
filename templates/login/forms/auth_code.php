<?php $ref = rand( 10, 999999999 ) ?>
<?php $ref_func = rand( 10, 120000 ); ?>
<div class="col-12 pr-5 pl-5 pt-1 pb-1 d-none">
    <div class="pt-1 pb-1 pl-3 pr-3 shadow-sm" style="background-color: #ffd9bb">
        <span id="message_auth" style="font-size: .8rem" class="text-danger "></span>
    </div>
</div>
<div class="col-12">
    <form method="post" action="" class="<?php echo $is_restore_link ? 'd-none' : ''; ?>"
          id="form_sign_in_auth_<?php echo $ref ?>">
        <div class="col-12 mb-4 mt-4">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <input class="form-control w-100 wupp-lg-input mb-3"
                               type="text"
                               name="auth_code"
                               placeholder="<?php echo __( "Auth code", "user-panel-pro" ) ?>"
							<?php if ( isset( $send_sms_auth_length ) && intval( $send_sms_auth_length ) > 0 ): ?>
                                maxlength="<?php echo intval( $send_sms_auth_length ) ?>"
							<?php endif; ?>
                        >
                    </div>
                    <input type="text" name="<?php echo $pre_connect == 'register_' ? $pre_connect : '';?>auth_helper" id="<?php echo $pre_connect; ?>auth_helper" hidden>
                    <input type="text" value="<?php echo apply_filters('wupp_auth_type',  implode(',',(array)$login_method)); ?>" name="auth_type"
                           id="<?php echo $pre_connect; ?>auth_type" hidden>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 mb-3">
                    <button type="button" id="<?php echo $pre_connect; ?>wupp_try_new_code"
                            class="btn btn-sm btn-success disabled col-12 col-md-5"
                            onclick="try_again(this, '<?php echo $pre_connect; ?>auth_helper', '<?php echo $pre_connect; ?>')"
                            style="min-width: 55px!important;"
                    ><?php echo class_exists( 'WUPPRLTools' ) ? WUPPRLTools::get_sms_otp_send_again_time() : '0' ?></button>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <button type="button"
                            onclick="auth_in(this, '#form_sign_in_auth_<?php echo $ref ?>')"
                            class="float-end btn btn-sm btn-outline-primary col-12 auth-btn">
						<?php echo __( "authentication", "user-panel-pro" ) ?>
                    </button>
                </div>
            </div>
        </div>
    </form>
    <div id="<?php echo $pre_connect; ?>wupp_change_password_pnl">
		<?php if ( $is_restore_link && $pre_connect == 'forget_' ): ?>
			<?php echo WUPPAdminViews::get_change_password_view( $_GET['login'] ) ?>
		<?php endif; ?>
    </div>
</div>