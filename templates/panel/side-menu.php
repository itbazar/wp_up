<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <?php if ($panel_settings['header_logo']) : ?>
                    <?php $logo_url = $panel_settings['header_logo_url']; ?>
                    <a class="navbar-brand" href="<?php echo isset($panel_settings['header_logo_redirect_link']['url']) ? $panel_settings['header_logo_redirect_link']['url'] : '#'; ?>">
                        <span class="brand-logo">
                            <?php if (!empty($logo_url)) : ?>
                                <img src="<?php echo $logo_url; ?>" alt="site logo">
                            <?php endif; ?>
                        </span>
                        <h2 class="brand-text"><?php echo $panel_settings['header_brand_text']; ?></h2>
                    </a>
                <?php endif; ?>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <?php $active_class = ''; ?>
            <?php $menu_count = 0; ?>
            <?php $panel_permalink = WUPPPages::get_dashboard_page_permalink(); ?>
            <?php foreach ($save_menus as $save_menu) : ?>
                <?php
                $bool2 = $save_menu['type'] == 'menu' && isset($save_menu['link']) && $save_menu['link'] == $page_tag;
                $active_class = $bool2 ? 'active ' : '';
                ?>
                <?php $save_menu['type'] == 'menu' ? $menu_count++ : null; ?>
                <?php $hidden_v = isset($save_menu['hidden']) ? intval($save_menu['hidden']) : 1; ?>
                <?php if (WUPPAdminMethods::check_active_account_menu($save_menu['parent_slug']) && $hidden_v && (WUPPTools::wupp_user_can($user_info, $save_menu['default_role']) || !$save_menu['default_role'])) : ?>

                    <?php if ($save_menu['type'] == 'menu') : ?>

                        <!-- BEGIN: Show simple menus-->
                        <li class="nav-item <?php echo $active_class . ' ' . $save_menu['custom_class']; ?>">
                            <a class="d-flex align-items-center wupp-menu-link" id="<?php echo $save_menu['link']; ?>" href="<?php echo $panel_permalink . $save_menu['link']; ?>">
                                <i class="<?php echo $save_menu['default_icon']; ?>"></i>
                                <span class="menu-title text-truncate" data-i18n="<?php echo $save_menu['title']; ?>"><?php echo $save_menu['title']; ?></span>
                            </a>
                        </li>
                        <!-- END: Showing simple menu-->

                    <?php elseif ($save_menu['type'] == 'group') : ?>

                        <!-- BEGIN: Show grouped menus-->
                        <?php $items = $save_menu['items']; ?>
                        <?php include WUPP_TPL . 'panel/side-menu-groups.php'; ?>
                        <!-- END: Showing grouped menus-->

                    <?php else : ?>
                        <!-- BEGIN: Show Link menu-->
                        <li class="nav-item <?php echo $active_class . ' ' . $save_menu['custom_class']; ?>">
                            <a class="d-flex align-items-center" id="<?php echo $save_menu['slug']; ?>" href="<?php echo $save_menu['default_link']; ?>" <?php echo $save_menu['open_in_other_page'] ? 'target="_blank"' : ''; ?>>
                                <i class="<?php echo $save_menu['default_icon']; ?>"></i>
                                <span class="menu-title text-truncate" data-i18n="<?php echo $save_menu['title']; ?>"><?php echo $save_menu['title']; ?></span>
                            </a>
                        </li>
                        <!-- END: Showing Link menu-->

                    <?php endif; ?>
                <?php endif; ?>
                <?php $active_class = ''; ?>
            <?php endforeach; ?>
        </ul>
    </div>
</div>