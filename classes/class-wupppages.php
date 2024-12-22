<?php
defined( 'ABSPATH' ) || die( 'No Access' );

class WUPPPages {

	//pages methods
	public static function handel_pages() {
		self::handel_old_pages();
		self::handel_create_pages();
		self::fix_rlregisterbo_bug();
	}

	public static function handel_create_pages() {
		$login_page_id = get_option( 'wupp_login_page_id', 0 );
		$page_id       = get_option( 'wupp_panel_page_id', 0 );

		if ( intval( $login_page_id ) == 0 || empty( $login_page_id ) ) {
			self::add_page_sign_up_sign_in();
		}
		if ( intval( $page_id ) == 0 || empty( $page_id ) ) {
			self::add_page_dashboard();
		}
	}

	public static function add_page_dashboard() {
		$page = WUPPAdminViews::get_option( 'panel_page', '' );
		if ( isset( $page ) && ! empty( $page ) ) {
			update_option( 'wupp_panel_page_id', $page );

			return $page;
		}
		$post_details = array(
			'post_title'   => self::get_dashboard_title(),
			'post_name'    => 'panel',
			'post_content' => '[wupp_user_panel]',
			'post_status'  => 'publish',
			'post_author'  => 1,
			'post_type'    => 'page'
		);
		$post_id      = self::add_page( $post_details );
		update_option( 'wupp_panel_page_id', $post_id );
	}

	public static function add_page_sign_up_sign_in() {
		$page = WUPPAdminViews::get_option( 'login_register_page', '' );
		if ( isset( $page ) && ! empty( $page ) ) {
			update_option( 'wupp_login_page_id', $page );

			return $page;
		}
		$post_details = array(
			'post_title'   => self::get_login_title(),
			'post_name'    => 'login',
			'post_content' => '[wupp_user_login]',
			'post_status'  => 'publish',
			'post_author'  => 1,
			'post_type'    => 'page'
		);
		$post_id      = self::add_page( $post_details );
		update_option( 'wupp_login_page_id', $post_id );
	}


	//add methods
	public static function add_page( $details ) {
		$page = get_page_by_path( $details['post_name'] );
		if ( ! $page ) {
			return wp_insert_post( $details );
		} else {
			if ( get_option( 'wupp_is_started_v7', 0 ) == 0 ) {
				update_option( 'wupp_is_started_v7', 1 );
				wp_update_post( [
					'ID'           => $page->ID,
					'post_content' => $details['post_content']
				] );
			}
		}
	}


	//other methods
	public static function get_login_urls() {
		return [
			self::get_login_page_permalink(),
			self::get_dashboard_page_permalink()
		];
	}

	public static function get_login_page_path() {
		$default = get_page_by_path( 'login' );
		$page    = WUPPAdminViews::get_option( 'login_register_page', '' );
		if ( isset( $page ) && ! empty( $page ) ) {
			$selected_page = get_post( $page );
			if ( isset( $selected_page ) ) {
				return apply_filters( 'wupp_login_register_page_path', $selected_page->ID );
			}
		} elseif ( $default && isset( $default->ID ) && $default->ID > 0 ) {
			if ( has_shortcode( $default->post_content, 'wupp_user_login' ) ) {
				return apply_filters( 'wupp_login_register_page_path', $default->post_name );
			}
		}

		return null;
	}

	public static function get_panel_page_path() {
		$default = get_page_by_path( 'panel' );
		$page    = WUPPAdminViews::get_option( 'panel_page', '' );
		if ( isset( $page ) && ! empty( $page ) ) {
			$selected_page = get_post( $page );
			if ( isset( $selected_page ) && has_shortcode( $selected_page->post_content, 'wupp_user_panel' ) ) {
				return apply_filters( 'wupp_panel_page_path', $selected_page->post_name );
			}
		} elseif ( $default && isset( $default->ID ) && $default->ID > 0 ) {
			if ( has_shortcode( $default->post_content, 'wupp_user_panel' ) ) {
				return apply_filters( 'wupp_panel_page_path', $default->post_name );
			}
		}

		return null;
	}

	public static function get_login_page_permalink() {
		if ( self::get_login_page_path() !== null && ! empty( self::get_login_page_path() ) ) {
			return get_permalink( self::get_login_page_path() );
		}

		return false;
	}

	public static function get_dashboard_page_permalink() {
		$path = get_page_by_path( self::get_panel_page_path() );

		if ( $path ) {
			return get_permalink( intval( $path->ID ) );
		}

		return $path;
	}

	public static function wupp_is_self_page() {
		$shortcode = WUPPUsers::have_wupp_shortcodes();

		if ( $shortcode == '[wupp_user_login]' ) {
			if ( function_exists( 'is_user_logged_in' ) ) {
				if ( is_user_logged_in() ) {
					return false;
				}
			}
		} else if ( $shortcode == '[wupp_user_panel]' ) {
			return true;
		}

		// return self::wupp_check_self_url();
		return false;
	}

	private static function wupp_check_self_url() {
		$structure = get_option( 'permalink_structure' );
		$bool1     = in_array( WUPPUriParser::get_full_current_route( false ), self::get_login_urls() ) ||
		             in_array( WUPPUriParser::get_full_current_route( false ) . '/', self::get_login_urls() );

		$bool2 = in_array( WUPPUriParser::get_full_current_route(), self::get_login_urls() );

		return ( $bool1 && ! is_null( $structure ) && ! empty( $structure ) ) || $bool2;
	}

	/**
	 * Checks whether the content passed contains a specific short code.
	 *
	 * @param string $tag Shortcode tag to check.
	 *
	 * @return bool
	 */
	private static function wupp_post_content_has_shortcode( $tag = '' ) {
		global $post;

		return is_singular() && is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, $tag );
	}


	/**
	 * Is_panel_page - Returns true when viewing an account page.
	 *
	 * @return bool
	 */
	public static function is_panel_page() {
		$page_id = WUPPAdminViews::get_option( 'panel_page', '' );

		return ( $page_id && is_page( $page_id ) ) || self::wupp_post_content_has_shortcode( 'wupp_user_panel' ) || ( get_query_var( 'panelpage' ) !== null && ! empty( get_query_var( 'panelpage' ) ) );
	}

	public static function is_login_page() {
		$page_id = WUPPAdminViews::get_option( 'login_register_page', '' );

		return ( $page_id && is_page( $page_id ) ) || self::wupp_post_content_has_shortcode( 'wupp_user_login' );
	}

	public static function get_login_title() {
		$page_id = WUPPAdminViews::get_option( 'login_register_page', '' );

		return get_the_title( $page_id );
	}

	public static function get_dashboard_title() {
		$page_id = WUPPAdminViews::get_option( 'panel_page', '' );

		return get_the_title( $page_id );
	}

	private static function handel_old_pages() {
		if ( get_option( 'wupp_is_started_v7', 0 ) == 0 ) {
			$login_page_id = get_option( 'wupp_login_page_id', 0 );
			$page_id       = get_option( 'wupp_page_id', 0 );

			if ( intval( $login_page_id ) > 0 ) {
				wp_update_post( [
					'ID'           => $login_page_id,
					'post_content' => '[wupp_user_login]'
				] );
			}
			if ( intval( $page_id ) > 0 ) {
				wp_update_post( [
					'ID'           => $page_id,
					'post_content' => '[wupp_user_panel]'
				] );
			}
			update_option( 'wupp_is_started_v7', 1 );
		}
	}

	private static function fix_rlregisterbo_bug() {
		if ( get_option( 'wupp_is_started_v7', 1 ) == 1 ) {
			$register_form_items = get_option( 'wupp_rl_register_form_items', 0 );
			$register_form_items = str_replace( "user_pass", "password", $register_form_items );
			update_option( 'wupp_rl_register_form_items', $register_form_items );
			update_option( 'wupp_is_started_v7', 2 );
		}
		if ( get_option( 'wupp_is_started_v7', 1 ) == 1 || get_option( 'wupp_is_started_v7', 2 ) == 2 ) {
			$register_form_items = get_option( 'wupp_rl_register_form_items', 0 );
			$register_form_items = str_replace( "repeat_password", "password_repeat", $register_form_items );
			update_option( 'wupp_rl_register_form_items', $register_form_items );
			update_option( 'wupp_is_started_v7', 3 );
		}
		if ( get_option( 'wupp_is_started_v7', 1 ) <= 4 ) {
			$register_form_items = get_option( 'wupp_rl_register_form_items', 0 );
			$register_form_items = wp_unslash( $register_form_items );
			update_option( 'wupp_rl_register_form_items', $register_form_items );

			$menus_items = get_option( 'wupp_account_menus', 0 );
			$menus_items = wp_unslash( $menus_items );
			update_option( 'wupp_account_menus', $menus_items );
			update_option( 'wupp_is_started_v7', 5 );
		}
		if ( get_option( 'wupp_is_started_v7', 1 ) <= 5 ) {
			flush_rewrite_rules();
			update_option( 'wupp_is_started_v7', 6 );
		}
	}
}