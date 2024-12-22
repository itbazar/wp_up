<?php
/*
Plugin Name: User Panel Pro
Plugin URI: https://www.zhaket.com/web/advanced-woocommerce-panel
Description: User Panel Pro is The most powerful and best plugin for creating user panel in WordPress; Synchronized with Woocommers and Easy digital downloads With unique facilities.
Version: 8.8.0
Author: Webiha
Author URI: https://webiha.com
Text Domain: user-panel-pro
Domain Path: /languages/
Requires at least: 5.5
Requires PHP: 7.1 or Higher
*/

defined('ABSPATH') || die('No Access');

if (!defined('WUPP_PLUGIN_FILE')) {
    define('WUPP_PLUGIN_FILE', __FILE__);
}

/**
 * Final Class of User panel plugin
 */
final class WUPP_User_Panel
{

    /**
     * Plugin version
     *
     * @var string
     */
    public $version = '8.8.0';

    /**
     * Single instance of class
     * @var null
     */
    private static $instance = null;

    /**
     * Get class single instance
     * @return null|WUPP_User_Panel
     */
    public static function get_instance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Create a new object
     * WUPP_User_Panel constructor.
     */
    public function __construct()
    {
        // Make plugin translation ready
        add_action('plugin_loaded', array($this, 'load_plugin_textdomain'));
        $this->_include();
        require_once WUPP_CLASSES . 'wupploader.php';
        register_activation_hook(__FILE__, array($this, 'plugin_activation'));
        WUPPHandler::handel();
        WUPPSupportPlugins::handel();
        new WUPPRouter;
       \f0d9f80517fdb6ba6a7f52819473789c::c07890211086832e177288a96314f($this);
    }

    /**
     * Load plugin textdomain
     */
    public function load_plugin_textdomain()
    {
        if (version_compare($GLOBALS['wp_version'], '6.7', '<')) {
            load_plugin_textdomain('user-panel-pro', false, basename(dirname(__FILE__)) . '/languages');
        } else {
            load_textdomain('user-panel-pro', plugin_dir_path(__FILE__) . 'languages/user-panel-pro-' . determine_locale() . '.mo');
        }
    }

    /**
     * Load plugin setup
     */
    public function setup()
    {
        // Define plugin constants.
        $this->define_constants();
        WUPPPages::handel_create_pages();
        // if pro version not included
        if (!class_exists('WUPP_User_Panel_Pro')) {
            WUPPOptions::load_options();
        }
        // Loaded action.
        do_action('user-panel/loaded');
    }

    /**
     * Define the plugin constants.
     */
    private function define_constants()
    {
        define('USER_PANEL_VERSION', $this->version);
    }

    /**
     * Include files
     */
    private function _include()
    {
        include_once 'source.php';
        include_once 'autoloader.php';
        include_once __DIR__ . '/incs/ion-checker.php';
        if (!empty($wupp_ioncube_error_checker)) {
            add_action('admin_notices', function () use ($wupp_ioncube_error_checker) {
                printf('<div class="notice notice-error notice-alt"> <p>%s</p> </div>', implode('<hr>', $wupp_ioncube_error_checker));
            }, 1);
        }
        if (is_admin()) {
            require_once WUPP_FRAMEWORK . 'wuppo-framework.php';
//            require_once WUPP_INCLUDES . 'admin/helper/update/updator.php';
        }
        require_once __DIR__ . '/incs/loaderbase/validate-locked.php';
    }

    /**
     * This function call when plugin is activate
     */
    public function plugin_activation()
    {
        if (get_option('wupp_version') != WUPP_VERSION) {
            update_option('wupp_version', WUPP_VERSION);
        }
    }

    /**
     * Applied to the list of links to display on the plugins page (beside the activate/deactivate links)
     *
     * @param $links
     *
     * @return array
     */
    public function add_action_links($links)
    {
    }


    public function __clone()
    {
    }

    public function __wakeup()
    {
    }
}

WUPP_User_Panel::get_instance();