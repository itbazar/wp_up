<style type="text/css" data-role="wupp">
    @font-face {
        font-family: IRANSans;
        font-weight: normal;
        src: url('<?php echo WUPP_ASSETS_FONTS; ?>Woff/IRANSansXFaNum-Regular.woff') format('woff');
        src: url('<?php echo WUPP_ASSETS_FONTS; ?>Woff2/IRANSansXFaNum-Regular.woff2') format('woff2');
    }

    @font-face {
        font-family: IRANSans;
        font-weight: bold;
        src: url('<?php echo WUPP_ASSETS_FONTS; ?>Woff/IRANSansXFaNum-Bold.woff') format('woff');
        src: url('<?php echo WUPP_ASSETS_FONTS; ?>Woff2/IRANSansXFaNum-Bold.woff2') format('woff2');
    }

    #wupp_main_pnl,
    body,
    .wupp,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    a,
    table,
    .btn {
        font-family: <?php echo $login_settings['wupp_main_typography']['font-family']; ?> !important;
        font-weight: <?php echo $login_settings['wupp_main_typography']['font-weight']; ?>;
        font-size: <?php echo $login_settings['wupp_main_typography']['font-size'] . $login_settings['wupp_main_typography']['unit']; ?>;
        color: <?php echo $login_settings['wupp_main_typography']['color']; ?>;
        line-height: <?php echo $login_settings['wupp_main_typography']['line-height']; ?>;
    }

    body {
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: 0;
        background: linear-gradient(<?php echo $login_settings['login_background']['background-gradient-direction'] . ',' . $login_settings['login_background']['background-gradient-color'] . ',' . $login_settings['login_background']['background-color']; ?>) !important;
        <?php if (!empty($login_settings['login_background']['background-image']['url'])) : ?>background-image: url(<?php echo $login_settings['login_background']['background-image']['url']; ?>) !important;
        background-repeat: <?php echo $login_settings['login_background']['background-repeat']; ?> !important;
        background-position: <?php echo $login_settings['login_background']['background-position']; ?> !important;
        background-size: <?php echo $login_settings['login_background']['background-size']; ?> !important;
        background-attachment: <?php echo $login_settings['login_background']['background-attachment']; ?> !important;
        <?php endif; ?>
    }

    .btn-outline-primary {
        border-color: <?php echo $login_settings['login_buttons_color']['color']; ?> !important;
        color: <?php echo $login_settings['login_buttons_color']['color']; ?> !important;
    }

    .btn-outline-primary:hover {
        background-color: <?php echo $login_settings['login_buttons_color']['hover']; ?> !important;
        color: white !important;
    }

    .overlay-left-fo {
        height: 100% !important;
        right: 0;
        left: 50%;
        color: white;
        font-size: 1rem !important;
        background: linear-gradient(<?php echo $login_settings['login_side_background']['background-gradient-direction'] . ',' . $login_settings['login_side_background']['background-gradient-color'] . ',' . $login_settings['login_side_background']['background-color']; ?>) !important;
        <?php if (!empty($login_settings['login_side_background']['background-image']['url'])) : ?>background-image: url(<?php echo $login_settings['login_side_background']['background-image']['url']; ?>) !important;
        background-repeat: <?php echo $login_settings['login_side_background']['background-repeat']; ?> !important;
        background-position: <?php echo $login_settings['login_side_background']['background-position']; ?> !important;
        background-size: <?php echo $login_settings['login_side_background']['background-size']; ?> !important;
        background-attachment: <?php echo $login_settings['login_side_background']['background-attachment']; ?> !important;
        <?php endif; ?>
    }

    .wupp-content {
        direction: <?php echo is_rtl() ? 'rtl' : 'ltr'; ?>;
    }

    .wupp-lg-input {
        height: 40px;
        text-align: <?php echo is_rtl() ? 'right' : 'left'; ?>;
    }

    <?php echo $login_settings['login_page_custom_style']; ?>
</style>