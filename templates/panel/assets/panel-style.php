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
    .btn,
    input,
    textarea,
    button,
    .tooltip,
    .woocommerce-error,
    .woocommerce-info,
    .woocommerce-message {
        font-family: <?php echo $panel_settings['wupp_main_typography']['font-family']; ?> !important;
    }

    /* start - header sytles */
    .navbar-light,
    .navbar-light.navbar-horizontal {
        background: <?php echo $panel_settings['header_bg_color']; ?>;
    }

    .header-navbar .navbar-container ul.navbar-nav li i.ficon,
    .header-navbar .navbar-container ul.navbar-nav li svg.ficon,
    .header-navbar .navbar-container ul.navbar-nav li>a.nav-link {
        color: <?php echo $panel_settings['header_text_color']; ?>;
    }

    .main-menu .navbar-header .navbar-brand .brand-text {
        color: <?php echo $panel_settings['header_brand_text_color']; ?>;
        font-size: <?php echo $panel_settings['header_brand_text_size']; ?>rem;
    }

    /* end - header style */

    /* start - sidebar styles */
    .main-menu.menu-light,
    .main-menu.menu-light .navigation {
        background: <?php echo $panel_settings['sidebar_bg_color']; ?>;
    }

    .main-menu.menu-light .navigation li a {
        color: <?php echo $panel_settings['side_menu_links_color']['color']; ?>;
    }

    .main-menu.menu-light .navigation>li.active>a, .main-menu.menu-light .navigation>li ul .active {
        background: <?php echo $panel_settings['side_menu_links_bg_color']['active']; ?>;
        box-shadow: 0 0 10px 1px <?php echo $panel_settings['side_menu_links_shadow_color']; ?>;
        color: <?php echo $panel_settings['side_menu_links_color']['active']; ?>;
    }

    /* end - sidebar style */

    /* start - content style */
    html body {
        background-color: <?php echo $panel_settings['panel_base_background']['background-color']; ?>;
        <?php if (!empty($panel_settings['panel_base_background']['background-image']['url'])) : ?>background-image: url(<?php echo $panel_settings['panel_base_background']['background-image']['url']; ?>) !important;
        background-repeat: <?php echo $panel_settings['panel_base_background']['background-repeat']; ?> !important;
        background-position: <?php echo $panel_settings['panel_base_background']['background-position']; ?> !important;
        background-size: <?php echo $panel_settings['panel_base_background']['background-size']; ?> !important;
        background-attachment: <?php echo $panel_settings['panel_base_background']['background-attachment']; ?> !important;
        <?php endif; ?>
    }

    /* end - content style */
    <?php echo $panel_settings['panel_page_custom_style']; ?>
</style>