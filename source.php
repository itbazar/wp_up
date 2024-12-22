<?php
define('WUPP_VERSION', '8.7.0');
define('WUPP_APP_NAME', __('user panel pro', 'user-panel-pro'));
define('WUPP_SLUG_ADMIN_MENU', 'wupp_user_panel_admin_menu');
define('WUPP_ROOT_PATH', trailingslashit(plugin_dir_path(__FILE__)));
define('WUPP_ROOT_DIR', trailingslashit(plugin_dir_url(__FILE__)));
define('WUPP_ASSETS', trailingslashit(WUPP_ROOT_DIR . 'assets'));
define('WUPP_TPL', trailingslashit(WUPP_ROOT_PATH . 'templates'));
define('WUPP_APP', trailingslashit(WUPP_ROOT_PATH . 'app'));
define('WUPP_ASSETS_FONTS', trailingslashit(WUPP_ASSETS . 'fonts'));
define('WUPP_ASSETS_CSS', trailingslashit(WUPP_ASSETS . 'css'));
define('WUPP_ASSETS_IMGS', trailingslashit(WUPP_ASSETS . 'imgs'));
define('WUPP_ASSETS_JS', trailingslashit(WUPP_ASSETS . 'js'));
define('WUPP_ASSETS_VENDORS', trailingslashit(WUPP_ASSETS . 'vendors'));
define('WUPP_CLASSES', trailingslashit(WUPP_ROOT_PATH . 'classes'));
define('WUPP_GATEWAYS', trailingslashit(WUPP_ROOT_PATH . 'gateways'));
define('WUPP_INCLUDES', trailingslashit(WUPP_ROOT_PATH . 'incs'));

define('WUPP_WUPP_TEMPLATES', trailingslashit(WUPP_TPL . 'panel/self'));
define('WUPP_WOO_TEMPLATES', trailingslashit(WUPP_TPL . 'panel/woo'));
define('WUPP_EDD_TEMPLATES', trailingslashit(WUPP_TPL . 'panel/edd'));
define('WUPP_WPAS_TEMPLATES', trailingslashit(WUPP_TPL . 'panel/wpas'));

define('WUPP_FRAMEWORK', trailingslashit(WUPP_INCLUDES . 'framework'));
define('WUPP_REPOSITORIES', trailingslashit(WUPP_ROOT_PATH . 'repositories'));
define('WUPP_TOOLS', trailingslashit(WUPP_ROOT_PATH . 'tools'));
define('WUPP_LIBRARIES', trailingslashit(WUPP_ROOT_PATH . 'libs'));