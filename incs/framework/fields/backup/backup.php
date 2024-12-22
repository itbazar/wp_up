<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: backup
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'WUPPO_Field_backup' ) ) {
  class WUPPO_Field_backup extends WUPPO_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $unique = $this->unique;
      $nonce  = wp_create_nonce( 'wuppo_backup_nonce' );
      $export = add_query_arg( array( 'action' => 'wuppo-export', 'unique' => $unique, 'nonce' => $nonce ), admin_url( 'admin-ajax.php' ) );

      echo $this->field_before();

      echo '<textarea name="wuppo_import_data" class="wuppo-import-data"></textarea>';
      echo '<button type="submit" class="button button-primary wuppo-confirm wuppo-import" data-unique="'. esc_attr( $unique ) .'" data-nonce="'. esc_attr( $nonce ) .'">'. esc_html__( 'Import', 'wuppo' ) .'</button>';
      echo '<hr />';
      echo '<textarea readonly="readonly" class="wuppo-export-data">'. esc_attr( json_encode( get_option( $unique ) ) ) .'</textarea>';
      echo '<a href="'. esc_url( $export ) .'" class="button button-primary wuppo-export" target="_blank">'. esc_html__( 'Export & Download', 'wuppo' ) .'</a>';
      echo '<hr />';
      echo '<button type="submit" name="wuppo_transient[reset]" value="reset" class="button wuppo-warning-primary wuppo-confirm wuppo-reset" data-unique="'. esc_attr( $unique ) .'" data-nonce="'. esc_attr( $nonce ) .'">'. esc_html__( 'Reset', 'wuppo' ) .'</button>';

      echo $this->field_after();

    }

  }
}
