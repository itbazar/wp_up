<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <!-- Page layout -->
        <?php
        // $show_gif = $panel_settings['show_loader_gif'];
        foreach ($save_menus as $save_menu) :
            if (isset($save_menu['link']) && $save_menu['type'] == 'menu' && $save_menu['link'] == $page_tag) : ?>
                <div class="content-header row">
                    <div class="content-header-left col-md-9 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <div class="breadcrumb-wrapper">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><?php echo __('panel', 'user-panel-pro') ?>
                                        </li>
                                        <li class="breadcrumb-item active"><?php echo $save_menu['title']; ?>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-body">
                    <div class="card">
                        <?php $menu_content_count = isset($menu_content_count) ? intval($menu_content_count) : 0; ?>
                        <?php
                        $bool1 = $save_menu['type'] == 'menu' && (!isset($_GET['page']) || $_GET['page'] == '') && $menu_content_count == 0;
                        $bool2 = $save_menu['type'] == 'menu' && isset($_GET['page']) && $_GET['page'] != '' && $_GET['page'] == $save_menu['link'];
                        ?>
                        <?php $save_menu['type'] == 'menu' ? $menu_content_count++ : null; ?>
                        <?php $hidden_v = isset($save_menu['hidden']) ? intval($save_menu['hidden']) : 1; ?>
                        <?php if ($hidden_v && (WUPPTools::wupp_user_can($user_info, $save_menu['default_role']) || $save_menu['default_role'] == '')) : ?>
                            <?php
                            $default_content = $save_menu['default_content'];
                            include WUPP_TPL . 'panel/self/custom.php';
                            ?>
                        <?php endif; ?>

                    </div>

                </div>

        <?Php
                break;
            elseif ($save_menu['type'] == 'group') :
                $items = $save_menu['items'];
                include WUPP_TPL . 'panel/content-group.php';
            endif;

        endforeach;
        ?>
        <!--/ Page layout -->
    </div>
</div>