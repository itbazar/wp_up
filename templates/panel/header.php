<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="nav-item"><a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a></li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url(); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo __('go home page', 'user-panel-pro'); ?>">
                        <i class="ficon" data-feather="home"></i>
                    </a>
                </li>
            </ul>
        </div>
        <ul class="nav navbar-nav align-items-center ml-auto">
            <?php do_action('wupp_panel_header'); ?>
            <?php
            $role = array_values($user_info->roles)[0];
            $role_name = isset($role) ? wp_roles()->get_names()[$role] : ''; ?>
            <!--/ Notifications  PART -->
            <li class="nav-item dropdown dropdown-user">
                <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder"><?= WUPPTools::get_user_name($user_info) ?></span><span class="user-status"><?= translate_user_role($role_name); ?></span></div><span class="avatar"><img class="round" src="<?php echo WUPPUsers::get_avatar($user_info->ID) ?>" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                    <a class="dropdown-item" href="<?php echo WUPPTools::wupp_get_dashboard_url() . WUPPTools::wupp_get_menu_link_by_slug('default_account_menus', 'private_messages'); ?>"><i class="mr-50" data-feather="mail"></i><?php echo __('Inbox', 'user-panel-pro'); ?> </a>
                    <a class="dropdown-item" href="<?php echo WUPPTools::wupp_get_dashboard_url() . WUPPTools::wupp_get_menu_link_by_slug('default_account_menus', 'wupp_edit_profile'); ?>"><i class="mr-50" data-feather="settings"></i><?php echo __('Settings', 'user-panel-pro'); ?> </a>
                    <div class="dropdown-divider"></div>
                    <?php $tag = (count(explode('?', WUPPPages::get_login_page_permalink())) > 1 ? '&' : '?'); ?>
                    <a class="dropdown-item" href="<?php echo wp_logout_url(); ?>"><i class="mr-50" data-feather="power"></i><?php echo __('Logout', 'user-panel-pro'); ?></a>
                </div>
            </li>
        </ul>
    </div>
</nav>