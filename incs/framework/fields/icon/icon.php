<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: icon
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'WUPPO_Field_icon' ) ) {
  class WUPPO_Field_icon extends WUPPO_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $args = wp_parse_args( $this->field, array(
        'button_title' => esc_html__( 'Add Icon', 'wuppo' ),
        'remove_title' => esc_html__( 'Remove Icon', 'wuppo' ),
      ) );

      echo $this->field_before();

      $nonce  = wp_create_nonce( 'wuppo_icon_nonce' );
      $hidden = ( empty( $this->value ) ) ? ' hidden' : '';

      echo '<div class="wuppo-icon-select">';
      echo '<span class="wuppo-icon-preview'. esc_attr( $hidden ) .'"><i class="'. esc_attr( $this->value ) .'"></i></span>';
      echo '<a href="#" class="button button-primary wuppo-icon-add" data-nonce="'. esc_attr( $nonce ) .'">'. $args['button_title'] .'</a>';
      echo '<a href="#" class="button wuppo-warning-primary wuppo-icon-remove'. esc_attr( $hidden ) .'">'. $args['remove_title'] .'</a>';
      echo '<input type="hidden" name="'. esc_attr( $this->field_name() ) .'" value="'. esc_attr( $this->value ) .'" class="wuppo-icon-value"'. $this->field_attributes() .' />';
      echo '</div>';

      echo $this->field_after();

    }

    public function enqueue() {
      add_action( 'admin_footer', array( 'WUPPO_Field_icon', 'add_footer_modal_icon' ) );
      add_action( 'customize_controls_print_footer_scripts', array( 'WUPPO_Field_icon', 'add_footer_modal_icon' ) );
    }

    public static function add_footer_modal_icon() {
    ?>
      <div id="wuppo-modal-icon" class="wuppo-modal wuppo-modal-icon hidden">
        <div class="wuppo-modal-table">
          <div class="wuppo-modal-table-cell">
            <div class="wuppo-modal-overlay"></div>
            <div class="wuppo-modal-inner">
              <div class="wuppo-modal-title">
                <?php esc_html_e( 'Add Icon', 'wuppo' ); ?>
                <div class="wuppo-modal-close wuppo-icon-close"></div>
              </div>
              <div class="wuppo-modal-header">
                <input type="text" placeholder="<?php esc_html_e( 'Search...', 'wuppo' ); ?>" class="wuppo-icon-search" />
              </div>
              <div class="wuppo-modal-content">
                <div class="wuppo-modal-loading"><div class="wuppo-loading"></div></div>
                <div class="wuppo-modal-load"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php
    }

  }
}
