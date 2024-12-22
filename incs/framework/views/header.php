<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

  $demo    = get_option( 'wuppo_demo_mode', false );
  $text    = ( ! empty( $demo ) ) ? 'Deactivate' : 'Activate';
  $status  = ( ! empty( $demo ) ) ? 'deactivate' : 'activate';
  $class   = ( ! empty( $demo ) ) ? ' wuppo-warning-primary' : '';
  $section = ( ! empty( $_GET[ 'section' ] ) ) ? sanitize_text_field( wp_unslash( $_GET[ 'section' ] ) ) : 'about';
  $links   = array(
    'about'           => 'About',
    'quickstart'      => 'Quick Start',
    'documentation'   => 'Documentation',
    'free-vs-premium' => 'Free vs Premium',
    'support'         => 'Support',
    'relnotes'        => 'Release Notes',
  );

?>
<div class="wuppo-welcome wuppo-welcome-wrap">

  <h1>Welcome to Wuppo Framework v<?php echo esc_attr( WUPPO::$version ); ?></h1>

  <p class="wuppo-about-text">A Simple and Lightweight WordPress Option Framework for Themes and Plugins</p>

  <p class="wuppo-demo-button"><a href="<?php echo esc_url( add_query_arg( array( 'wuppo-demo' => $status ) ) ); ?>" class="button button-primary<?php echo esc_attr( $class ); ?>"><?php echo esc_attr( $text ); ?> Demo</a></p>

  <div class="wuppo-logo">
    <div class="wuppo--effects"><i></i><i></i><i></i><i></i></div>
    <div class="wuppo--wp-logos">
      <div class="wuppo--wp-logo"></div>
      <div class="wuppo--wp-plugin-logo"></div>
    </div>
    <div class="wuppo--text">Wuppo Framework</div>
    <div class="wuppo--text wuppo--version">v<?php echo esc_attr( WUPPO::$version ); ?></div>
  </div>

  <h2 class="nav-tab-wrapper wp-clearfix">
    <?php

      foreach ( $links as $key => $link ) {

        if ( WUPPO::$premium && $key === 'free-vs-premium' ) { continue; }

        $activate = ( $section === $key ) ? ' nav-tab-active' : '';

        echo '<a href="'. esc_url( add_query_arg( array( 'page' => 'wuppo-welcome', 'section' => $key ), admin_url( 'tools.php' ) ) ) .'" class="nav-tab'. esc_attr( $activate ) .'">'. esc_attr( $link ) .'</a>';

      }

    ?>
  </h2>
