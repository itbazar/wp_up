<?php if (!defined('ABSPATH')) {
  die;
} // Cannot access directly.

//
// Set a unique slug-like ID
//
$prefix = 'wuppo_dashboard_shortcodes';

//
// Create a shortcoder
//
WUPPO::createShortcoder($prefix, array(
  // 'button_title'   => 'Add Shortcode',
  // 'select_title'   => 'Select a shortcode',
  // 'insert_title'   => 'Insert Shortcode',
  // 'show_in_editor' => true,
  // 'gutenberg'      => array(
  //   'title'        => 'WUPPO Shortcodes',
  //   'description'  => 'WUPPO Shortcode Block',
  //   'icon'         => 'screenoptions',
  //   'category'     => 'widgets',
  //   'keywords'     => array( 'shortcode', 'wuppo', 'insert' ),
  //   'placeholder'  => 'Write shortcode here...',
  // )
));

//
// A shortcode [wupp_user_comment]
//
WUPPO::createSection($prefix, array(
  'title'     =>  __('User comments', 'user-panel-pro'),
  'view'      => 'normal',
  'shortcode' => 'wupp_user_comment',
  'fields'    => array(
    array(
      'type'    => 'notice',
      'style'   => 'info',
      'content' => __('This shortcode returns all user comments on the site'),
    ),
  )
));
//
// A shortcode [wupp_user_purchase_number]
//
WUPPO::createSection($prefix, array(
  'title'     =>  __('User purchase number', 'user-panel-pro'),
  'view'      => 'normal',
  'shortcode' => 'wupp_user_purchase_number',
  'fields'    => array(
    array(
      'type'    => 'notice',
      'style'   => 'info',
      'content' => __('This shortcode returns user total number of products purchased in woo and edd'),
    ),
  )
));
//
// A shortcode [wupp_user_total_order_amount]
//
WUPPO::createSection($prefix, array(
  'title'     =>  __('User total order amount', 'user-panel-pro'),
  'view'      => 'normal',
  'shortcode' => 'wupp_user_total_order_amount',
  'fields'    => array(
    array(
      'type'    => 'notice',
      'style'   => 'info',
      'content' => __('This shortcode returns user total amount of orders in woo and edd'),
    ),
  )
));
//
// A shortcode [wupp_user_support_tickets]
//
WUPPO::createSection($prefix, array(
  'title'     =>  __('User tickets number', 'user-panel-pro'),
  'view'      => 'normal',
  'shortcode' => 'wupp_user_support_tickets',
  'fields'    => array(
    array(
      'type'    => 'notice',
      'style'   => 'info',
      'content' => __('This shortcode returns user the total number of tickets in awesome support and advanced ticket plugin'),
    ),
  )
));
//
// A shortcode [wupp_user_woo_wallet]
//
WUPPO::createSection($prefix, array(
  'title'     =>  __('User wallet amount', 'user-panel-pro'),
  'view'      => 'normal',
  'shortcode' => 'wupp_user_woo_wallet',
  'fields'    => array(
    array(
      'type'    => 'notice',
      'style'   => 'info',
      'content' => __('This shortcode returns user the total amount of wallet'),
    ),
  )
));