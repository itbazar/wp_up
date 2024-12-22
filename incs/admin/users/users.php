<?php include_once WUPP_INCLUDES . 'pub/modal_dialog.php' ?>
<?php include_once WUPP_INCLUDES . 'pub/admin-style.php' ?>
<?php wp_enqueue_media();?>
<script src="<?php echo WUPP_ASSETS_JS.'jquery-3.6.0.min.js'; ?>"></script>
<div class="wupp container-fluid">
    <div class="p-5">
        <div class="row shadow">
            <?php $users_menus = WUPPAdminContentMenus::wupp_get_user_menus(); ?>
            <?php $settings_menus = apply_filters('wupp_admin_users_menus', $users_menus); ?>
            <div class="col-12 col-md-4 col-lg-3">
                <div class="row">
                    <?php include_once WUPP_INCLUDES . 'admin/side_menus.php' ?>
                </div>
            </div>

            <div class="col-12 col-md-8 col-lg-9 ">
                <form id="wupp_users_settings" action="" method="post">
                    <div class="row">
                        <?php include_once WUPP_INCLUDES . 'admin/contents.php' ?>
                        <?php wp_nonce_field('wupp_save_new_role'); ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function () {
        jQuery('#collapse-menu').css('font-size', '13px');
    });

    function remove_an_account_menu_item(completed_id, id) {
        var sort_completed_id = 'wupp_mm_item_' + id;
        var action = 'remove_account_menu_item';

        jQuery('#pnl_modal_item').css('display', 'block');
        jQuery('#pnl_modal').css('display', 'block');
        jQuery('#wupp_mod_don_btn')
            .attr('data-action', action)
            .attr('data-tag', completed_id)
            .on('click', function (e) {
                if (jQuery(this).attr('data-action') === action) {
                    e.preventDefault();
                    jQuery('#' + completed_id).remove();
                    jQuery('#' + sort_completed_id).remove();
                    close_pnl_modal();
                }
            });

    }

    function remove_an_account_group_item(completed_id, id) {
        var sort_completed_id = 'wupp_mm_item_' + id;
        var allow = true;
        var uls = jQuery('#' + sort_completed_id).find('ul');
        uls.each(function () {
            var len = jQuery(this).find('li').length;
            if (len > 0) {
                allow = false;
            }
        });

        if (allow) {
            var action = 'remove_account_menu_item';

            jQuery('#pnl_modal_item').css('display', 'block');
            jQuery('#pnl_modal').css('display', 'block');
            jQuery('#wupp_mod_don_btn')
                .attr('data-action', action)
                .attr('data-tag', completed_id)
                .on('click', function (e) {
                    if (jQuery(this).attr('data-action') === action) {
                        e.preventDefault();
                        jQuery('#' + completed_id).remove();
                        jQuery('#' + sort_completed_id).remove();
                        close_pnl_modal();
                    }
                });
        } else {
            jQuery('#btn_saveing_by_group').next().html('<?php  echo __("The group should not be empty", "user-panel-pro")?>');
        }
    }

</script>