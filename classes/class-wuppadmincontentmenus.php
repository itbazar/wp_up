<?php


class WUPPAdminContentMenus
{

    public static function get_active_account_menus_conditions()
    {
        $conditions = [
            'woocommerce_account_menus' => WUPPTools::wupp_is_woocommerce_activated(),
            'edd_account_menus'         => WUPPTools::wupp_is_edd_active(),
            'wpas_account_menus'        => WUPPTools::wupp_is_awesome_Support_activated()
        ];
        return apply_filters('wupp_account_menus_sonditions', $conditions);
    }

    public static function get_user_menus()
    {
        $menus = [
            [
                'sub_menu_title'             => __('Default menus', 'user-panel-pro'),
                'sub_menu_use_content_title' => true,
                'sub_menu_content_title'     => __('Default menus', 'user-panel-pro'),
                'sub_menu_parent_slug'       => 'wupp_users_menus',
                'sub_menu_slug'              => 'wupp_default_users_menus',
                'sub_menu_is_custom_view'    => true,
                'sub_menu_is_active'         => true,
                'sub_menu_callable_function' => 'WUPPAdminViews::render_default_account_menus'
            ],
            [
                'sub_menu_title'             => __('WooCommerce menus', 'user-panel-pro'),
                'sub_menu_use_content_title' => true,
                'sub_menu_content_title'     => __('WooCommerce menus', 'user-panel-pro'),
                'sub_menu_parent_slug'       => 'wupp_users_menus',
                'sub_menu_slug'              => 'wupp_woocommerce_users_menus',
                'sub_menu_is_custom_view'    => true,
                'sub_menu_is_active'         => WUPPTools::wupp_is_woocommerce_activated(),
                'sub_menu_callable_function' => 'WUPPAdminViews::render_woocommerce_account_menus',
            ],
            [
                'sub_menu_title'             => __('EDD menus', 'user-panel-pro'),
                'sub_menu_use_content_title' => true,
                'sub_menu_content_title'     => __('EDD menus', 'user-panel-pro'),
                'sub_menu_parent_slug'       => 'wupp_users_menus',
                'sub_menu_slug'              => 'wupp_edd_users_menus',
                'sub_menu_is_custom_view'    => true,
                'sub_menu_is_active'         => WUPPTools::wupp_is_edd_active(),
                'sub_menu_callable_function' => 'WUPPAdminViews::render_edd_account_menus'
            ],
            [
                'sub_menu_title'             => __('Awesome support', 'user-panel-pro'),
                'sub_menu_use_content_title' => true,
                'sub_menu_content_title'     => __('Awesome support', 'user-panel-pro'),
                'sub_menu_parent_slug'       => 'wupp_users_menus',
                'sub_menu_slug'              => 'wupp_wpas_users_menus',
                'sub_menu_is_custom_view'    => true,
                'sub_menu_is_active'         => WUPPTools::wupp_is_awesome_Support_activated(),
                'sub_menu_callable_function' => 'WUPPAdminViews::render_wpas_account_menus'
            ],
            [
                'sub_menu_title'             => __('Links', 'user-panel-pro'),
                'sub_menu_use_content_title' => true,
                'sub_menu_content_title'     => __('Links', 'user-panel-pro'),
                'sub_menu_parent_slug'       => 'wupp_users_menus',
                'sub_menu_slug'              => 'wupp_default_users_links',
                'sub_menu_is_custom_view'    => true,
                'sub_menu_is_active'         => true,
                'sub_menu_callable_function' => 'WUPPAdminViews::render_default_users_links',
                'sub_menu_items'             => []
            ],
            [
                'sub_menu_title'             => __('Groups', 'user-panel-pro'),
                'sub_menu_use_content_title' => true,
                'sub_menu_content_title'     => __('Groups', 'user-panel-pro'),
                'sub_menu_parent_slug'       => 'wupp_users_menus',
                'sub_menu_slug'              => 'wupp_default_users_groups',
                'sub_menu_is_custom_view'    => true,
                'sub_menu_is_active'         => true,
                'sub_menu_callable_function' => 'WUPPAdminViews::render_default_users_groups',
                'sub_menu_items'             => []
            ],
            [
                'sub_menu_title'             => __('Arrange', 'user-panel-pro'),
                'sub_menu_use_content_title' => true,
                'sub_menu_content_title'     => __('Arrange', 'user-panel-pro'),
                'sub_menu_parent_slug'       => 'wupp_users_menus',
                'sub_menu_slug'              => 'wupp_setting_users_sortable',
                'sub_menu_is_custom_view'    => true,
                'sub_menu_is_active'         => true,
                'sub_menu_callable_function' => 'WUPPAdminViews::render_setting_users_sortable',
                'sub_menu_items'             => []
            ],
        ];
        return apply_filters('wupp_admin_users_menus_list', $menus);
    }

    public static function wupp_get_user_menus()
    {
        return [
            [
                'menu_title'     => __('menus', 'user-panel-pro'),
                'menu_icon'      => 'dashicons dashicons-rest-api',
                'menu_slug'      => 'wupp_users_menus',
                'menu_sub_menus' => self::get_user_menus()
            ],
        ];
    }
}
