<script data-role="wupp">
    // start -> remove extra tags from page
    var isCompleted = false;
    var removerForay = setInterval(function () {
        remove_other_tags();

        if (isCompleted) {
            clearInterval(removerForay)
        }
    }, 350);
    jQuery(document).ready(function () {
        remove_other_tags();
        isCompleted = true;
    });

    function remove_other_tags() {
        jQuery('.wupp-panel-body').children().each(function () {
            $bool1 = jQuery(this).hasClass('wupp') === false;
            $bool2 = jQuery(this).is('link') === false;
            $bool3 = jQuery(this).is('script') === false;
            $bool4 = jQuery(this).is('style') === false;
            $bool5 = jQuery(this).attr('id') !== 'wpadminbar';
            $bool6 = jQuery(this).hasClass('swal2-container') === false;
            $bool7 = jQuery(this).hasClass('cs-uwac__popup-wrapper') === false;
            $bool8 = jQuery(this).hasClass('dtwpFloatContainer') === false;
            if ($bool1 && $bool2 && $bool3 && $bool4 && $bool5 && $bool6 && $bool7 && $bool8) {
                jQuery(this).remove();
            }
        });
    }
    // end -> remove extra tags from page

    jQuery(document).ready(function () {

        // remove public styles and scripts
        jQuery('link[href*="wp-content/themes"]').remove();
        jQuery('link[href*="bs-booster-cache"]').remove();
        jQuery('link[href*="codevz"]').remove();
        jQuery('link[href*="wp-responsive-menu"]').remove();
        jQuery('#codevz-plugin-inline-css').remove();
        jQuery('link[href*="dynamic_avia"]').remove();
    });

    <?php echo $login_settings['login_page_custom_script'];?>
</script>