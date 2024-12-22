<div class="container wupp_menu_content_item" id="menu_mother_<?php echo $slug; ?>">
    <input type="text" hidden name="slugs[]" value="<?php echo $slug; ?>">
    <div class="col-12 bg-white shadow">
        <div class="row">
            <div class="col-12 card-header p-0 position-relative">
                <button id="slider_btn_<?php echo $slug; ?>" class="w-100 p-3 shadow-none border-0" type="button" data-toggle="collapse" style="background-color: rgba(255,255,255,0); outline: none;height: 50px" data-target="#multiCollapseExample_<?php echo $slug; ?>" aria-expanded="false" aria-controls="multiCollapseExample_<?php echo $slug; ?>"><?php echo $title; ?>
                </button>
                <span onclick="jQuery(this).prev().click();" class="dashicons dashicons-arrow-down-alt2 wupp-cursor-pointer position-absolute tt-version mt-1"></span>

                <?php $hidden_v = isset($hidden) ? intval($hidden) : 1; ?>
                <span class="dashicons dashicons-<?php echo $hidden_v ? 'visibility' : 'hidden'; ?> wupp-cursor-pointer position-absolute tt-version-re" onclick="wupp_handel_eyes_in_menus(this)" id="menu_item_hidden<?php echo $slug; ?>" style="right: 15px;"></span>
                <input type="number" maxlength="1" value="<?php echo $hidden_v; ?>" id="menu_item_hidden_status<?php echo $slug; ?>" hidden>
                <?php if (strpos($slug, 'new_menu_item_') !== false) : ?>
                    <span class="dashicons dashicons-trash wupp-cursor-pointer position-absolute tt-version-re" onclick="remove_an_account_menu_item('menu_mother_<?php echo $slug; ?>', '<?php echo $slug; ?>')" style="right: 45px;"></span>
                <?php endif; ?>
            </div>
            <div class="col-12 collapse multi-collapse" id="multiCollapseExample_<?php echo $slug; ?>">
                <div class="row">
                    <div class="col-12 wuppo-section">
                        <div class="wuppo-onload">
                            <?php
                            WUPPO::field(
                                array(
                                    'id'    => 'menu_item_link_' . $slug,
                                    'type'  => 'text',
                                    'title' => __('Menu link', 'user-panel-pro'),
                                    'desc'  => __('The slug must be in English, without spaces, only letters and numbers and dash', 'user-panel-pro'),
                                ),
                                $link
                            );
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <script>
                        jQuery(function() {
                            jQuery("input[name='menu_item_link_<?php echo $slug; ?>']").on('click paste change keyup', function() {
                                var base = '<?php echo WUPPTools::wupp_get_dashboard_url(); ?>';
                                var val = jQuery(this).val();
                                jQuery('.wuppo-notice').html(base + val);
                            });
                        });
                    </script>

                    <div class="col-12 wuppo-section">
                        <div class="wuppo-onload">
                            <?php
                            WUPPO::field(
                                array(
                                    'type'    => 'notice',
                                    'style'   => 'success',
                                    'title'   => __('Menu main link', 'user-panel-pro'),
                                    'content' => WUPPTools::wupp_get_dashboard_url() . $link,
                                ),
                                $title
                            );
                            ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 wuppo-section">
                        <div class="wuppo-onload">
                            <?php
                            WUPPO::field(
                                array(
                                    'id'    => 'menu_item_title_' . $slug,
                                    'type'  => 'text',
                                    'title' => __('Menu title', 'user-panel-pro'),
                                ),
                                $title
                            );
                            ?>
                        </div>
                    </div>
                    <script type="application/javascript">
                        jQuery(document).ready(function() {
                            jQuery("input[name='menu_item_title_<?php echo $slug; ?>']").on('click paste change keyup', function(e) {
                                jQuery('#slider_btn_<?php echo $slug; ?>').html(jQuery(this).val());
                                jQuery("#wupp_mm_item_btn_<?php echo $slug; ?>").html(jQuery(this).val());
                            });
                        });
                    </script>
                </div>

                <div class="row">
                    <div class="col-12 wuppo-section">
                        <div class="wuppo-onload">
                            <?php
                            WUPPO::field(
                                array(
                                    'id'      => 'menu_item_icon_' . $slug,
                                    'type'    => 'icon',
                                    'title'   => __('Menu icon', 'user-panel-pro'),
                                ),
                                $default_icon
                            );
                            ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 wuppo-section">
                        <div class="wuppo-onload">
                            <?php
                            WUPPO::field(
                                array(
                                    'id'    => 'menu_item_custom_class_' . $slug,
                                    'type'  => 'text',
                                    'title' => __('Menu custom class', 'user-panel-pro'),
                                ),
                                $custom_class
                            );
                            ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 wuppo-section">
                        <div class="wuppo-onload">
                            <?php
                            WUPPO::field(
                                array(
                                    'id'          => 'menu_item_role_' . $slug,
                                    'type'        => 'select',
                                    'title'       => __('Role', 'user-panel-pro'),
                                    'desc'        => __('User roles that can see this menu if empty all user can', 'user-panel-pro'),
                                    'placeholder' => __('Select user role', 'user-panel-pro'),
                                    'options'     => 'roles',
                                    'multiple'    => true,
                                    'chosen'      => true,
                                ),
                                isset($default_role) ? $default_role : ''
                            );
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 wuppo-section">
                        <div class="wuppo-onload">
                            <?php
                            WUPPO::field(
                                array(
                                    'id'       => 'menu_editor_' . $slug,
                                    'type'     => 'wp_editor',
                                    'title'    => __('Menu custom content', 'user-panel-pro'),
                                    'height' => '200px',
                                    'sanitize' => true,
                                ),
                                WUPPAdminMethods::get_menu_panel_content($menu)
                            );
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    jQuery(document).ready(function() {
        jQuery('#slider_btn_<?php echo $slug; ?>').on('click', function() {
            $(this).next().toggleClass('dashicons-arrow-down-alt2');
            $(this).next().toggleClass('dashicons-arrow-up-alt2');
        });
    });
</script>