<?php

/**
 * User Panel plugin login main
 *
 * This template load login base graphics
 *
 */
defined('ABSPATH') || exit;

//all options for login page.
$login_settings = WUPPAdminViews::get_options();
?>
<!doctype html>
<html lang="<?php echo get_locale() ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo WUPPPages::get_login_title(); ?></title>
    <script src="<?php echo WUPP_ASSETS_JS . 'jquery-3.6.0.min.js'; ?>"></script>
    <?php include WUPP_TPL . 'login/assets/scripts.php' ?>
    <?php WUPPAsset::wupp_enqueue_scripts_styles('login'); ?>
    <?php wp_head(); ?>
    <?php do_action('wupp_account_header'); ?>
    <?php include WUPP_TPL . '/login/assets/login-style.php'; ?>

</head>

<body>
    <div id="wupp_main_pnl" class="wupp">
        <script src="<?php echo WUPP_ASSETS_JS . 'wupp-login.js' ?>"></script>
        <?php $login_options = WUPPTools::wupp_get_login_settings(); ?>
        <?php extract($login_options); ?>
        <?php include WUPPTools::wupp_get_login_view_path(); ?>
    </div>
    <?php wp_footer(); ?>
    <?php do_action('wupp_account_footer'); ?>
    <?php include WUPP_TPL . '/login/assets/login-script.php'; ?>
</body>

</html>
<?php exit; ?>