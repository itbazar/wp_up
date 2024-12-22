<?php $users_menus = WUPPAdminContentMenus::wupp_get_user_menus(); ?>
<?php $settings_menus = apply_filters('wupp_admin_users_menus', $users_menus); ?>
<?php $__disabled_menus = [] ?>
<?php foreach ($settings_menus as $settings_menu) : ?>
    <?php $sub_menus = $settings_menu['menu_sub_menus']; ?>
    <?php $sub_menus = apply_filters('wupp_smenu_' . $settings_menu['menu_slug'], $sub_menus); ?>


    <?php foreach ($sub_menus as $sub_menu) : ?>
        <?php $bool_active = isset($sub_menu['sub_menu_is_active']) && $sub_menu['sub_menu_is_active'] === false ?>
        <?php if ($bool_active) {
            $__disabled_menus[] = $sub_menu['sub_menu_slug'];
        } ?>
    <?php endforeach; ?>
<?php endforeach; ?>


<div class="container">
    <div class="col-12 bg-white shadow">
        <div class="row">
            <ul class="col-12 p-0 mb-0" id="mother_sorter">
                <?php if ($save_menus && is_array($save_menus) && count($save_menus)) : ?>
                    <?php foreach ($save_menus as $save_menu) : ?>
                        <?php include WUPP_INCLUDES . 'admin/users/account-sortable-content.php'; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>

<script>
    jQuery(function() {
        handel_menus_sortables();
    });

    function get_menu_item_info(slug, hidden, parent_slug) {
        parent_slug = jQuery('#wupp_mm_item_' + slug).attr('data-parent');
        var html = jQuery(`textarea[name='menu_editor_${slug}']`).val();
        // html = html.replaceAll(/"/g, "'");
        let role_selected_values = [];
        jQuery(`select[name='menu_item_role_${slug}[]']`).find('option').each(function() {
            if ($(this).is(':selected')) {
                role_selected_values.push($(this).val());
            } else {
                if ($(this).attr('value').length) {
                    $(this).remove();
                }
            }
        });
        return {
            title: jQuery(`input[name='menu_item_title_${slug}']`).val(),
            link: jQuery(`input[name='menu_item_link_${slug}']`).val(),
            type: 'menu',
            slug: slug,
            hidden: hidden,
            parent_slug: parent_slug,
            default_icon: jQuery(`input[name='menu_item_icon_${slug}']`).parent().find('i').attr('class'),
            custom_class: jQuery(`input[name='menu_item_custom_class_${slug}']`).val(),
            default_role: role_selected_values,
            default_content: html
        };
    }

    function get_link_item_info(slug, hidden, parent_slug) {
        parent_slug = jQuery('#wupp_mm_item_' + slug).attr('data-parent');
        let role_selected_values = [];
        jQuery(`select[name='menu_role_${slug}[]']`).find('option').each(function() {
            if ($(this).is(':selected')) {
                role_selected_values.push($(this).val());
            } else {
                if ($(this).attr('value').length) {
                    $(this).remove();
                }
            }
        });
        return {
            title: jQuery(`input[name='link_title_${slug}']`).val(),
            type: 'link',
            slug: slug,
            hidden: hidden,
            parent_slug: parent_slug,
            default_link: jQuery(`input[name='link_address_${slug}']`).val(),
            default_icon: jQuery(`input[name='menu_icon_${slug}']`).parent().find('i').attr('class'),
            custom_class: jQuery(`input[name='menu_custom_class_${slug}']`).val(),
            default_role: role_selected_values,
            open_in_other_page: jQuery(`input[name='open_link_new_tab_${slug}']`).val(),
        };
    }

    function get_group_item_info(slug, hidden, parent_slug, items) {
        parent_slug = jQuery('#wupp_mm_item_' + slug).attr('data-parent');
        let role_selected_values = [];
        jQuery(`select[name='menu_role_${slug}[]']`).find('option').each(function() {
            if ($(this).is(':selected')) {
                role_selected_values.push($(this).val());
            } else {
                if ($(this).attr('value').length) {
                    $(this).remove();
                }
            }
        });
        return {
            title: jQuery(`input[name='link_title_${slug}']`).val(),
            type: 'group',
            slug: slug,
            hidden: hidden,
            parent_slug: parent_slug,
            default_icon: jQuery(`input[name='menu_icon_${slug}']`).val(),
            custom_class: jQuery(`input[name='menu_custom_class_${slug}']`).val(),
            default_role: role_selected_values,
            show: jQuery(`input[name='default_visibility_${slug}']`).val(),
            items: items
        };
    }

    function get_group_items(group) {
        var find_items = [];
        jQuery(group).children().each(function() {
            var type = jQuery(this).attr('data-type');
            var slug = jQuery(this).attr('data-slug');
            var hidden = jQuery('#menu_item_hidden_status' + slug).val();
            var parent_slug = jQuery(this).attr('data-parent');

            switch (type) {
                case 'menu':
                    find_items.push(get_menu_item_info(slug, hidden, parent_slug));
                    break;
                case 'link':
                    find_items.push(get_link_item_info(slug, hidden, parent_slug));
                    break;
                case 'group':
                    var groupItems = [];
                    jQuery(this).children().each(function() {
                        if (jQuery(this).is("ul")) {
                            groupItems = get_group_items(this);
                        }
                    });

                    find_items.push(get_group_item_info(slug, hidden, parent_slug, groupItems));
                    break;
            }

        });
        return find_items;
    }

    function save_menus(elm) {
        //attrs
        var btnText = jQuery(elm).html();
        var sorts = jQuery('#mother_sorter');
        var sort_list = [];

        //get items
        sorts.children().each(function() {
            var group = jQuery(this).find(":first-child");
            if (jQuery(group).is('ul')) {
                var items = get_group_items(group);
                for (let i = 0; i < items.length; i++) {
                    sort_list.push(items[i]);
                }
            }
        });

        //change btn data
        jQuery(elm)
            .addClass('disabled')
            .attr('disabled', 'disabled')
            .html('<?php echo __("waiting ...", "user-panel-pro") ?>');


        //run save request
        var value = JSON.stringify(sort_list);
        $.ajax({
            data: [{
                    name: 'action',
                    value: 'wupp_ajax_save_menus'
                },
                {
                    name: 'data',
                    value: value
                }
            ],
            type: 'POST',
            url: '<?php echo admin_url(); ?>admin-ajax.php',
            beforeSend: function(x) {
                if (x && x.overrideMimeType) {
                    x.overrideMimeType("application/j-son;charset=UTF-8");
                }
            },
            success: function(response) {
                jQuery(elm)
                    .removeClass('disabled')
                    .removeAttr('disabled', 'disabled')
                    .html(btnText)
                    .next()
                    .addClass('text-success')
                    .html('<?php echo __("Information saved!", "user-panel-pro") ?>');
            },
            error: function() {
                jQuery(elm)
                    .removeClass('disabled')
                    .removeAttr('disabled', 'disabled')
                    .html(btnText)
                    .next()
                    .addClass('text-danger')
                    .html('<?php echo __("No internet connection", "user-panel-pro") ?>');
            }
        });
    }

    function new_menu_item(elm, type, mother_id) {
        var title = jQuery(elm).html();
        jQuery(elm)
            .addClass('disabled')
            .attr('disabled', 'disabled')
            .html('<?php echo __("waiting ...", "user-panel-pro") ?>');
        data = [];
        data.push({
            name: 'action',
            value: 'wupp_ajax_request_new_' + type
        });
        $.ajax({
            data: data,
            type: 'POST',
            url: '<?php echo admin_url(); ?>admin-ajax.php',
            complete: function() {
                jQuery(elm)
                    .removeClass('disabled')
                    .removeAttr('disabled', 'disabled')
                    .html(title);
            },
            success: function(response) {
                jQuery(elm)
                    .next()
                    .removeClass('text-danger')
                    .addClass('text-success')
                    .html(response.message);
                if (response.result === 2) {
                    // jQuery('#' + mother_id).find('.tab-content').append(response.menu_item);
                    let itemID = $(response.menu_item).attr('id');
                    jQuery('#' + mother_id).find('.tab-content')
                        .append(response.menu_item)
                        .ready(function() {
                            $(`#${itemID} .wuppo-onload`).wuppo_reload_script();
                        });
                    jQuery('#mother_sorter').append(response.menu_tag);

                    try {
                        ed_id = response.editor_id;
                        quicktags({
                            id: ed_id,
                            buttons: "strong,em,link,block,del,ins,img,ul,ol,li,code,more,close,dfw"
                        });
                        tinyMCE.execCommand('mceAddEditor', false, ed_id);
                    } catch (e) {}
                    handel_menus_sortables();
                }
            },
            error: function(e) {
                jQuery(elm)
                    .next()
                    .addClass('text-danger')
                    .html('<?php echo __("No internet connection", "user-panel-pro") ?>');
            }
        });
    }
    $(document).ready(function() {
        $('.wupp-add-menu-admin').removeAttr("disabled")
    });
</script>