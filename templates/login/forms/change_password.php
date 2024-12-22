
<script data-role="wupp">
    function change_password(btn) {
        var new_password = jQuery('#new_password').val();
        var repeat_new_password = jQuery('#repeat_new_password').val();
        var user_name = jQuery('#user_name').val();

        if (new_password && repeat_new_password && (new_password === repeat_new_password)) {
            jQuery(btn)
                .addClass('disabled')
                .attr('disabled', 'disabled')
                .html('<?php echo __("Waiting ...", "user-panel-pro")?>');
            $.ajax({
                data: {new_password: new_password, repeat_new_password: repeat_new_password, user_name: user_name, action: 'wupp_change_pass'},
                type: 'POST',
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                complete: function () {
                    jQuery(btn)
                        .removeClass('disabled')
                        .removeAttr('disabled', 'disabled')
                        .html('<?php echo __("Restore", "user-panel-pro")?>');
                },
                success: function (response) {
                    jQuery('#message_for')
                        .html(response.message)
                        .parent().parent().removeClass('d-none');
                    if (response.result === 2) {
                            location.assign(response.redirect_url);
                    }
                },
                error: function (e) {
                    jQuery('#message_for')
                        .html('<?php echo __('No internet connection!', 'user-panel-pro')?>')
                        .parent().parent().removeClass('d-none');
                }
            });
        }else{
            
        }
    }
</script>
<form action="" method="post">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <input class="form-control w-100 wupp-lg-input mb-3"
                       type="text"
                       name="new_password"
                       id="new_password"
                       placeholder="<?php echo __("New password", "user-panel-pro") ?>"
                       maxlength="60">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <input class="form-control w-100 wupp-lg-input mb-3"
                       type="text"
                       name="repeat_new_password"
                       id="repeat_new_password"
                       placeholder="<?php echo __("Repeat new password", "user-panel-pro") ?>"
                       maxlength="60">
            </div>
        </div>
        <div class="col-12">
            <input type="text" id="user_name" name="user_name" hidden value="<?php echo $user_login ?>">
        </div>
        <div class="col-12">
            <button class="btn btn-sm btn-primary"
                    onclick="change_password(this)"><?php echo __('change', 'user-panel-pro'); ?></button>
        </div>
    </div>
</form>

