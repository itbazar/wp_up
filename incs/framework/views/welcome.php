<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Setup Framework Class
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'WUPPO_Welcome' ) ) {
  class WUPPO_Welcome{

    private static $instance = null;

    public function __construct() {

      if ( WUPPO::$premium && ( ! WUPPO::is_active_plugin( 'wuppo-framework/wuppo-framework.php' ) || apply_filters( 'wuppo_welcome_page', true ) === false ) ) { return; }

      add_action( 'admin_menu', array( $this, 'add_about_menu' ), 0 );
      add_filter( 'plugin_action_links', array( $this, 'add_plugin_action_links' ), 10, 5 );
      add_filter( 'plugin_row_meta', array( $this, 'add_plugin_row_meta' ), 10, 2 );

      $this->set_demo_mode();

    }

    // instance
    public static function instance() {
      if ( is_null( self::$instance ) ) {
        self::$instance = new self();
      }
      return self::$instance;
    }

    public function add_about_menu() {
      add_management_page( 'Wuppo Framework', 'Wuppo Framework', 'manage_options', 'wuppo-welcome', array( $this, 'add_page_welcome' ) );
    }

    public function add_page_welcome() {

      $section = ( ! empty( $_GET['section'] ) ) ? sanitize_text_field( wp_unslash( $_GET['section'] ) ) : '';

      WUPPO::include_plugin_file( 'views/header.php' );

      // safely include pages
      switch ( $section ) {

        case 'quickstart':
          WUPPO::include_plugin_file( 'views/quickstart.php' );
        break;

        case 'documentation':
          WUPPO::include_plugin_file( 'views/documentation.php' );
        break;

        case 'relnotes':
          WUPPO::include_plugin_file( 'views/relnotes.php' );
        break;

        case 'support':
          WUPPO::include_plugin_file( 'views/support.php' );
        break;

        case 'free-vs-premium':
          WUPPO::include_plugin_file( 'views/free-vs-premium.php' );
        break;

        default:
          WUPPO::include_plugin_file( 'views/about.php' );
        break;

      }

      WUPPO::include_plugin_file( 'views/footer.php' );

    }

    public static function add_plugin_action_links( $links, $plugin_file ) {

      if ( $plugin_file === 'wuppo-framework/wuppo-framework.php' && ! empty( $links ) ) {
        $links['wuppo--welcome'] = '<a href="'. esc_url( admin_url( 'tools.php?page=wuppo-welcome' ) ) .'">Settings</a>';
        if ( ! WUPPO::$premium ) {
          $links['wuppo--upgrade'] = '<a href="http://wuppoframework.com/">Upgrade</a>';
        }
      }

      return $links;

    }

    public static function add_plugin_row_meta( $links, $plugin_file ) {

      if ( $plugin_file === 'wuppo-framework/wuppo-framework.php' && ! empty( $links ) ) {
        $links['wuppo--docs'] = '<a href="http://wuppoframework.com/documentation/" target="_blank">Documentation</a>';
      }

      return $links;

    }

    public function set_demo_mode() {

      $demo_mode = get_option( 'wuppo_demo_mode', false );

      $demo_activate = ( ! empty( $_GET[ 'wuppo-demo' ] ) ) ? sanitize_text_field( wp_unslash( $_GET[ 'wuppo-demo' ] ) ) : '';

      if ( ! empty( $demo_activate ) ) {

        $demo_mode = ( $demo_activate === 'activate' ) ? true : false;

        update_option( 'wuppo_demo_mode', $demo_mode );

      }

      if ( ! empty( $demo_mode ) ) {

        WUPPO::include_plugin_file( 'samples/admin-options.php' );

        if ( WUPPO::$premium ) {

          WUPPO::include_plugin_file( 'samples/customize-options.php' );
          WUPPO::include_plugin_file( 'samples/metabox-options.php'   );
          WUPPO::include_plugin_file( 'samples/nav-menu-options.php'  );
          WUPPO::include_plugin_file( 'samples/profile-options.php'   );
          WUPPO::include_plugin_file( 'samples/shortcode-options.php' );
          WUPPO::include_plugin_file( 'samples/taxonomy-options.php'  );
          WUPPO::include_plugin_file( 'samples/widget-options.php'    );
          WUPPO::include_plugin_file( 'samples/comment-options.php'   );

        }

      }

    }

  }

  WUPPO_Welcome::instance();
}
