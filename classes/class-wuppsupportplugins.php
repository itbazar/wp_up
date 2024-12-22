<?php

class WUPPSupportPlugins
{

    public static function handel()
    {
        self::handel_add_filters();
    }

    private static function handel_add_filters()
    {
        add_filter('wupp_admin_users_menus_list', function ($menus) {
            $menus = array_merge($menus, self::get_support_plugins_menus());

            return $menus;
        });

        add_filter('wupp_account_menus', function ($menus) {
            $my_menus = self::get_support_plugins_content();
            foreach ($my_menus as $parent_slug => $sub_menus) {
                if (!isset($menus[$parent_slug])) {
                    $menus[$parent_slug] = $sub_menus;
                } else {
                    $slugs = WUPPAdminMethods::get_account_menus_slugs($menus[$parent_slug]);
                    foreach ($sub_menus as $sub_menu) {
                        if (!in_array($sub_menu['slug'], $slugs)) {
                            $menus[$parent_slug][] = $sub_menu;
                        }
                    }
                }
            }

            return $menus;
        });


        add_filter('wupp_account_sortable_menus', function ($menus) {
            $my_menus = self::get_support_plugins_content();
            foreach ($my_menus as $parent_slug => $my_menu) {
                $menus = WUPPAdminMethods::add_menus_to_account_menus($menus, $my_menu, WUPPAdminMethods::get_account_menus_slugs($my_menu));
            }

            return $menus;
        });

        add_filter('wupp_account_menus_sonditions', function ($checkers) {
            $main_menus = self::get_support_plugins_menus();
            foreach ($main_menus as $main_menu) {
                $checkers[$main_menu['sub_menu_slug']] = $main_menu['sub_menu_is_active'];
            }

            return $checkers;
        });
    }


    //Main menu and content view

    public static function render_wpast_support_ticket_content_view()
    {
        echo '<div class="col-12">';
        WUPPAdminViews::submit_btn(__('Save', 'user-panel-pro'), '', 'save_menus(this)');
        WUPPAdminViews::other_btn(__('Add menu', 'user-panel-pro'), '', "new_menu_item(this, 'menu', 'pills-wupp_default_users_menus')");
        echo '</div>';
        echo '<div class="clearfix"></div>';
        $menus = WUPPAdminViews::get_menus_sub_menus()['wupp_wpast_support_ticket'];

        if ($menus && is_array($menus)) {
            foreach ($menus as $menu) {
                extract($menu);
                include WUPP_INCLUDES . 'admin/users/account-menu-item.php';
            }
        }
    }

    public static function render_view_woowallet_content_view()
    {
        echo '<div class="col-12">';
        WUPPAdminViews::submit_btn(__('Save', 'user-panel-pro'), '', 'save_menus(this)');
        WUPPAdminViews::other_btn(__('Add menu', 'user-panel-pro'), '', "new_menu_item(this, 'menu', 'pills-wupp_default_users_menus')");
        echo '</div>';
        echo '<div class="clearfix"></div>';
        $menus = WUPPAdminViews::get_menus_sub_menus()['wupp_view_woo_wallet'];

        if ($menus && is_array($menus)) {
            foreach ($menus as $menu) {
                extract($menu);
                include WUPP_INCLUDES . 'admin/users/account-menu-item.php';
            }
        }
    }

    public static function render_view_subscription_content_view()
    {
        echo '<div class="col-12">';
        WUPPAdminViews::submit_btn(__('Save', 'user-panel-pro'), '', 'save_menus(this)');
        WUPPAdminViews::other_btn(__('Add menu', 'user-panel-pro'), '', "new_menu_item(this, 'menu', 'pills-wupp_default_users_menus')");
        echo '</div>';
        echo '<div class="clearfix"></div>';
        $menus = WUPPAdminViews::get_menus_sub_menus()['wupp_view_subscription'];

        if ($menus && is_array($menus)) {
            foreach ($menus as $menu) {
                extract($menu);
                include WUPP_INCLUDES . 'admin/users/account-menu-item.php';
            }
        }
    }

    public static function wupp_wpast_support_ticket_activated()
    {
        return class_exists('WPAST_Support_Ticket');
    }

    public static function wupp_wc_subscriptions_activated()
    {
        return class_exists('WC_Subscriptions');
    }

    public static function wupp_woo_wallet_activated()
    {
        return class_exists('WooWallet');
    }

    public static function get_support_plugins_menus()
    {
        return [
            [
                'sub_menu_title' => __('Advanced support ticket', 'user-panel-pro'),
                'sub_menu_use_content_title' => true,
                'sub_menu_content_title' => __('Advanced support ticket', 'user-panel-pro'),
                'sub_menu_parent_slug' => 'wupp_users_menus',//don't edit this
                'sub_menu_slug' => 'wupp_wpast_support_ticket',
                'sub_menu_is_custom_view' => true,
                'sub_menu_is_active' => self::wupp_wpast_support_ticket_activated(),
                'sub_menu_callable_function' => 'WUPPSupportPlugins::render_wpast_support_ticket_content_view'
            ],
            ['sub_menu_title' => __('My wallet', 'user-panel-pro'),
                'sub_menu_use_content_title' => true,
                'sub_menu_content_title' => __('My wallet', 'user-panel-pro'),
                'sub_menu_parent_slug' => 'wupp_users_menus',//don't edit this
                'sub_menu_slug' => 'wupp_view_woo_wallet',
                'sub_menu_is_custom_view' => true,
                'sub_menu_is_active' => self::wupp_woo_wallet_activated(),
                'sub_menu_callable_function' => 'WUPPSupportPlugins::render_view_woowallet_content_view'
            ],
            ['sub_menu_title' => __('My Subscription', 'user-panel-pro'),
                'sub_menu_use_content_title' => true,
                'sub_menu_content_title' => __('My Subscription', 'user-panel-pro'),
                'sub_menu_parent_slug' => 'wupp_users_menus',//don't edit this
                'sub_menu_slug' => 'wupp_view_subscription',
                'sub_menu_is_custom_view' => true,
                'sub_menu_is_active' => self::wupp_wc_subscriptions_activated(),
                'sub_menu_callable_function' => 'WUPPSupportPlugins::render_view_subscription_content_view'
            ]
        ];
    }

    //sub menus
    public static function get_support_plugins_content()
    {
        return [
            'wupp_wpast_support_ticket' => [
                [
                    'title' => __('Support ticket', 'user-panel-pro'),
                    'link' => 'tickets',
                    'type' => 'menu',
                    'parent_slug' => 'wupp_wpast_support_ticket',
                    'slug' => 'ticket',
                    'default_icon' => '',
                    'custom_class' => '',
                    'default_role' => '',
                    'use_card_view' => true,
                    'default_content' => '[wpast-ticket-panel]',
                ]
            ],
            'wupp_view_woo_wallet' => [
                [
                    'title' => __('My wallet', 'user-panel-pro'),
                    'link' => 'woo-wallet',
                    'type' => 'menu',
                    'parent_slug' => 'wupp_view_woo_wallet',
                    'slug' => 'view_woo_wallet',
                    'default_icon' => '',
                    'custom_class' => '',
                    'default_role' => '',
                    'use_card_view' => true,
                    'default_content' => '[woo-wallet]',
                ]
            ],
            'wupp_view_subscription' => [
                [
                    'title' => __('My Subscription', 'user-panel-pro'),
                    'link' => 'view-subscription',
                    'type' => 'menu',
                    'parent_slug' => 'wupp_view_subscription',
                    'slug' => 'view_subscription',
                    'default_icon' => '',
                    'custom_class' => '',
                    'default_role' => '',
                    'use_card_view' => true,
                    'default_content' => '[ywcmap_woocommerce_subscription]',
                ]
            ]
        ];
    }

    public static function find_un_set_menus ($menus, $slugs = []) {
        if(is_null($slugs) || !is_array($slugs) || count($slugs) <= 0){
            $slugs = ['wupp_edit_profile' => 'wupp_edit_profile'];
        }
        foreach ($menus as $menu) {
            if($menu['type'] == 'group'){
                $menus = $menu['items'];
                $slugs = self::find_un_set_menus($menus, $slugs);
            }else if (in_array($menu['slug'], array_keys($slugs))) {
                if(isset($menu['slug']) && $menu['slug'] != null){
                    unset($slugs[$menu['slug']]);
                }
            }
        }
        return $slugs;
    }

    public static function push_menus_to ($default_menus, $new_menus, $slugs) {
        if ($slugs && count($slugs)) {
            foreach ($new_menus as $new_menu) {
                if (in_array($new_menu['slug'], $slugs)) {
                    $default_menus[] = $new_menu;
                }
            }
        }

        return $default_menus;
    }
}
