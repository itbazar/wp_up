<?php
/*
 * Template Name: UP panel page
 * Description: A Page Template for up plugin panel page.
 */
defined( 'ABSPATH' ) || exit;
if ( ! function_exists( 'is_user_logged_in' ) || ! is_user_logged_in() && ! empty( WUPPPages::get_login_page_permalink() ) ) {
	header( 'Location: ' . WUPPPages::get_login_page_permalink() );
}
$panel_settings = WUPPAdminViews::get_options();
$user_info      = wp_get_current_user();
$save_menus     = WUPPAdminMethods::get_account_menus();
if ( ! $save_menus || is_null( $save_menus ) ) {
	$save_menus = WUPPAdminViews::convert_user_menus_sub_menus();
}
if ( get_query_var( 'panelpage' ) !== false && ! empty( get_query_var( 'panelpage' ) ) ) {
	$page_tag = get_query_var( 'panelpage' );
}
if ( ! isset( $page_tag ) ) {
	foreach ( $save_menus as $menu ) {
		if ( $menu['type'] == 'menu' ) {
			$page_tag = $menu['link'];
			break;
		}
	}
};
?>
    <!DOCTYPE html>
    <html class="loading " lang="<?php echo get_locale() ?>"
          data-textdirection="<?php echo is_rtl() ? 'rtl' : 'ltr'; ?>">
    <!-- BEGIN: Head-->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
        <meta name="author" content="WEBIHA">
        <title><?= WUPPPages::get_dashboard_title() . ' - ' . $user_info->display_name; ?></title>
        <link rel="shortcut icon" type="image/x-icon"
              href="<?= isset( $panel_settings['favicon_logo_url'] ) ? $panel_settings['favicon_logo_url'] : '#'; ?>">
		<?php WUPPAsset::wupp_enqueue_scripts_styles( 'panel' ); ?>
        <script src="<?= WUPP_ASSETS_JS ?>jquery-3.6.0.min.js"></script>
		<?php include WUPP_TPL . 'panel/assets/scripts.php' ?>
		<?php do_action( 'wupp_panel_head_before' ); ?>
		<?php wp_head(); ?>
		<?php do_action( 'wupp_panel_head_after' ); ?>
    </head>
    <!-- END: Head-->

    <!-- BEGIN: Body-->
    <body class="wupp-panel-body vertical-layout vertical-menu-modern navbar-floating footer-static <?php echo $panel_settings['sidebar_menu_style'] == 'collapse' ? 'menu-collapsed' : ''; ?> <?= is_rtl() ? 'rtl' : ''; ?>"
          data-open="click" data-menu="vertical-menu-modern" data-col="">
    <span class="wupp">
        <!-- BEGIN: user custom style-->
        <?php include_once WUPP_TPL . 'panel/assets/panel-style.php'; ?>
        <!-- END: user custom style-->

        <!-- BEGIN: Header-->
        <?php include_once WUPP_TPL . 'panel/header.php'; ?>
        <!-- END: Header-->

        <!-- BEGIN: Main Menu-->
        <?php include_once WUPP_TPL . 'panel/side-menu.php'; ?>
        <!-- END: Main Menu-->

        <!-- BEGIN: Content-->
        <?php include_once WUPP_TPL . 'panel/content.php'; ?>
        <!-- END: Content-->

        <!-- BEGIN: Footer-->
        <?php include_once WUPP_TPL . 'panel/footer.php'; ?>
        <!-- END: Footer-->

        <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>

    </span>
    <!-- <script type="text/javascript">
        $.noConflict(true);
    </script> -->
    <?php wp_footer(); ?>
    <?php do_action( 'wupp_panel_footer' ); ?>

    <!-- BEGIN: user custom script -->
    <?php include WUPP_TPL . '/panel/assets/panel-script.php'; ?>
    <!-- END: user custom script -->
    <script>
    jQuery(document).ready(function (){
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
    </body>
    <!-- END: Body-->

    </html>
<?php //exit; ?>