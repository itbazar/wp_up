//on load page
function handel_panel_side_items() {
    jQuery('.nav-link-wupp').on('click', function () {
        var pnlId = jQuery(this).attr('href');

        jQuery('.nav-link-wupp').removeClass('active');
        jQuery('.tab-pane-wupp').removeClass('active').removeClass('show');
        jQuery(this).addClass('active');
        jQuery(pnlId).addClass('active show');
    })
}

//multi select tags
function remove_selected_tag(elm, id, input) {
    var inputId = jQuery('#' + input);
    var tag = jQuery(elm).attr('data-value');
    jQuery('#' + jQuery(elm).attr('data-id')).parent().removeClass('d-none');
    jQuery(elm).remove();
    jQuery('#' + id + ' :first-child').trigger('click');

    var value = jQuery(inputId).val();
    var items = value.split(',');

    var newVal = '';
    for (let i = 0; i < items.length; i++) {
        if (items[i] !== tag) {
            newVal += (newVal !== '' ? ',' : '') + items[i];
        }
    }

    jQuery(inputId).val(newVal);
}
// set cookie
function wuppSetCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}
function wuppGetCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}
function wupp_handle_select_tags_(elm) {
    var input_id = jQuery(elm).attr('data-input');
    var handler = jQuery('#wupp-' + input_id + '-select-tag-top-handler');
    var items = jQuery(elm).find('.wupp-select-item');
    var inputId = jQuery(handler).prev();

    jQuery(handler).on('click', function () {
        jQuery(this).next().next().toggle(200);
        jQuery(this).toggleClass('h-active');
    });

    jQuery(items).on('click', function () {
        var title = jQuery(this).children(":first").html();
        var id = jQuery(this).children(":first").attr('data-id');
        var value = jQuery(this).children(":first").attr('data-value');
        jQuery(this).addClass('d-none');

        var lastVal = jQuery(inputId).val();
        var fullValue = lastVal !== undefined && lastVal !== '' ? lastVal + ',' + value : value;
        jQuery(inputId).val(fullValue);
        jQuery(handler).next().next().toggle(200);
        jQuery(handler).toggleClass('h-active');

        var click_ = "remove_selected_tag(this, '" + id + "', '" + jQuery(inputId).attr('id') + "')";
        jQuery('#select_pnl' + input_id).append(
            '<button id="select-tag-pin-' + id + '" ' +
            'onclick="' + click_ + '" ' +
            'data-id="' + id + '" ' +
            'data-value="' + value + '" ' +
            'type="button" ' +
            'class="btn-tag-remove m-1 btn btn-primary">'
            + title +
            '      <span class="wupp-cursor-pointer badge badge-light">حذف</span>' +
            '      <span class="sr-only"></span>' +
            '</button>');
    });

    jQuery(items).hover(
        function () {
            if (!jQuery(this).hasClass('it-active')) {
                var color = jQuery(this).attr('data-color');
                jQuery(this)
                    .css('background-color', color)
                    .css('color', 'white');
            }
        },
        function () {
            if (!jQuery(this).hasClass('it-active')) {
                jQuery(this)
                    .css('background-color', 'white')
                    .css('color', '#adadc1');
            }
        }
    );
}

function wupp_read_select_tags_event_() {
    jQuery('.wupp-select-handler-tags').each(function () {
        wupp_handle_select_tags_(this);
    });
}

//single tags
function wupp_read_single_select(elm) {
    var input_id = jQuery(elm).attr('data-input');
    var handler = jQuery(elm);
    var items = jQuery('#wupp-select-items' + input_id).find('div');
    var inputId = jQuery('#wupp-' + input_id + '-select');

    jQuery(handler).on('click', function () {
        jQuery(this).next().next().toggle(200);
        jQuery(this).toggleClass('h-active');
    });


    jQuery(items).on('click', function () {
        var title = jQuery(this).children(":first").html();
        var id = jQuery(this).children(":first").attr('data-value');

        jQuery(inputId).val(id);
        jQuery(handler).children(":first").html(title);
        jQuery(handler).next().next().toggle(200);
        jQuery(handler).toggleClass('h-active');

        jQuery(items).each(function () {
            jQuery(this).attr('style', '')
                .removeClass('it-active');
        });
        jQuery(this).addClass('it-active');
    });

    jQuery(items).hover(
        function () {
            if (!jQuery(this).hasClass('it-active')) {
                var color = jQuery(this).attr('data-color');
                jQuery(this)
                    .css('background-color', color)
                    .css('color', 'white');
            }
        },
        function () {
            if (!jQuery(this).hasClass('it-active')) {
                jQuery(this)
                    .css('background-color', 'white')
                    .css('color', '#adadc1');
            }
        }
    );
}

function wupp_read_single_selectEvent() {
    jQuery('.wupp-select-handler').each(function () {
        wupp_read_single_select(this);
    });
}

//input train placeholder
function wupp_read_input_tran() {
    var elm = jQuery('.mtin-tran input');
    jQuery(elm).focusin(function () {
        jQuery(this)
            .next().addClass('wupp-input-ph-active')
            .parent().addClass('wupp-input-root-active');
    });
    jQuery(elm).focusout(function () {
        var val = jQuery(this).val();
        if (!val) {
            jQuery(this)
                .next().removeClass('wupp-input-ph-active')
                .parent().removeClass('wupp-input-root-active');
        }
    });
}

//fields bot
function add_new_field(elm, pnl_id, save_key) {
    var pnl = jQuery(pnl_id);
    var count = jQuery(pnl).find('li').length + 1;
    var dontCreate = true;
    do {
        try {
            if (jQuery('#wupp_fields_bot_li_' + count).attr('id')) {
                count++;
            } else {
                dontCreate = false;
            }
        } catch (e) {
            count++;
        }
    } while (dontCreate);

    var data = [
        { name: 'action', value: 'wupp_ajax_request_new_bot_field_item' },
        { name: 'id', value: count },
        { name: 'input_save_key', value: save_key }
    ];

    jQuery(elm)
        .addClass('disabled')
        .attr('disabled', 'disabled')
        .html('<?php echo __("Waiting ...", "user-panel-pro")?>');
    jQuery.ajax({
        data: data,
        type: 'POST',
        url: '<?php echo admin_url();?>admin-ajax.php',
        success: function (response) {
            jQuery(elm)
                .removeClass('disabled')
                .removeAttr('disabled', 'disabled')
                .html('<?php echo __("Add field", "user-panel-pro")?>');
            if (response.result === 2) {
                jQuery(pnl).append(response.item);
            }
        },
        error: function (e) {
            jQuery(elm)
                .removeClass('disabled')
                .removeAttr('disabled', 'disabled')
                .html('<?php echo __("Add field", "user-panel-pro")?>');
        }
    });

}

function check_field_bot_item(btn, id) {
    if (jQuery(btn).hasClass('dashicons-visibility')) {
        jQuery('#' + id).val('off');
        jQuery(btn).removeClass('dashicons-visibility')
            .addClass('dashicons-hidden');
    } else {
        jQuery('#' + id).val('on');
        jQuery(btn).removeClass('dashicons-hidden')
            .addClass('dashicons-visibility');
    }
}

function wupp_on_change_field_bot_type(input_save_key, id) {
    jQuery('#' + input_save_key + '_fields_bot_type_' + id).on('change', function () {
        var select = jQuery('#' + input_save_key + '_fields_bot_select_items_' + id);
        var max_len = jQuery('#' + input_save_key + '_fields_bot_max_len_' + id);

        jQuery(select).parent().addClass('d-none');
        switch (jQuery(this).val()) {
            case 'radio':
            case 'checkbox':
                jQuery(max_len).parent().addClass('d-none');
                break;
            case 'select':
                jQuery(select).parent().removeClass('d-none');
                jQuery(max_len).parent().addClass('d-none');
                break;
            default:
                jQuery(max_len).parent().removeClass('d-none');
                break;
        }
    });
    jQuery('#' + input_save_key + '_fields_bot_title_' + id).on('lick paste change keyup', function () {
        jQuery('#' + input_save_key + '_fields_bot_btn_' + id).html(jQuery(this).val());
    });
}

function read_fields_bot_scripts() {
    jQuery('.wupp-fields-bot-pnl').each(function () {
        jQuery(this).find('ul').each(function () {
            try {
                jQuery(this).sortable();
                jQuery(this).find('li').each(function () {
                    wupp_on_change_field_bot_type(jQuery(this).attr('data-savekey'), jQuery(this).attr('data-id'),);
                });
            } catch (e) {

            }
        });
    });
}

//check box button
function read_checkbox_button() {
    jQuery('.wupp-button-checkbox').children().on('click', function () {
        jQuery(this)
            .toggleClass('btn-success')
            .prev().val(jQuery(this).hasClass('btn-success') ? 'on' : 'off');
    });
}

function wupp_single_btn_group() {
    jQuery('.wupp-single-btn-group').each(function () {
        var inputId = jQuery(this).attr('data-id');
        jQuery('#single-btn-group-' + inputId).children().on('click', function () {
            jQuery('#single-btn-group-' + inputId).children().each(function () {
                jQuery(this).removeClass('btn-success');
            });
            jQuery(this).addClass('btn-success');
            jQuery('#input-grb-' + inputId).val(jQuery(this).attr('data-value'));
        });
    });
}

function wupp_single_btn_info() {
    jQuery('.wupp-single-btn-info').each(function () {
        var saveKey = jQuery(this).attr('data-savekey');
        var id = jQuery(this).attr('data-id');
        jQuery('#single-btn-group-' + saveKey).children().on('click', function () {
            jQuery('#single-btn-group-' + saveKey).children().each(function () {
                jQuery(this).removeClass('btn-success');
            });
            jQuery(this).addClass('btn-success');
            var val = jQuery(this).attr('data-value');
            jQuery('#input-btn-switch-' + id).val(val);
        });
    });
}

function wupp_read_date_picker() {
    jQuery('.wupp-datepicker').each(function () {
        jQuery(this).find('input').datepicker();
    });
}

function wupp_single_img_group() {
    jQuery('.wupp-single-img-group').each(function () {
        var inputId = jQuery(this).attr('data-id');
        jQuery(this).children().on('click', function () {
            jQuery('#single-btn-group-' + inputId).children().each(function () {
                jQuery(this).css('border', '2px solid #e4e4e4')
                    .removeClass('active');
            });
            jQuery(this).css('border', '2px solid #5D6DF3')
                .addClass('active');
            jQuery('#img-input-' + inputId).val(jQuery(this).attr('data-value'));
        });
    });
}

function wupp_read_rang_inputs_pnl() {
    jQuery('.rang-inputs-pnl').each(function () {
        var saveKey = jQuery(this).attr('name');
        jQuery(this).find('input').each(function () {
            jQuery(this).change(function () {
                jQuery('#rang-input-' + saveKey).html(jQuery(this).val());
            });
        });
    });
}

function wupp_read_switcher() {
    jQuery('.wupp-switcher-pnl').find('input').each(function () {
        jQuery(this).on('change', function () {
            var en = jQuery(this).is(':checked');
            if (en) {
                jQuery('#enable_message_' + jQuery(this).attr('id')).css('display', 'block');
                jQuery('#disable_message_' + jQuery(this).attr('id')).css('display', 'none');
            } else {
                jQuery('#disable_message_' + jQuery(this).attr('id')).css('display', 'block');
                jQuery('#enable_message_' + jQuery(this).attr('id')).css('display', 'none');
            }
        });
    });
}

function wupp_read_textarea_trin() {
    jQuery('.mtin-tran textarea').focusin(function () {
        jQuery(this)
            .next().addClass('wupp-input-ph-active');
    });
    jQuery('.mtin-tran textarea').focusout(function () {
        var val = jQuery(this).val();
        if (!val) {
            jQuery(this)
                .next().removeClass('wupp-input-ph-active');
        }
    });
}

function wupp_handel_eyes_in_menus(elm) {
    var inpu = jQuery(elm).next();
    if (inpu.val() !== '1') {
        inpu.val('1');
    } else {
        inpu.val('0');
    }
    jQuery(elm).toggleClass('dashicons-visibility');
    jQuery(elm).toggleClass('dashicons-hidden');
}

function handel_menus_sortables() {
    try {
        jQuery('#mother_sorter').find('ul').each(function () {
            jQuery(this).sortable({
                connectWith: ".connectedSortable"
            });
            jQuery(this).disableSelection();
        });
    } catch (e) {

    }
}

function load_wp_upload_dialog(elm, request) {
    if (typeof wp !== 'undefined' && wp.media && wp.media.editor) {
        var button = jQuery(elm);
        var id = button.prev();
        wp.media.editor.send.attachment = function (props, attachment) {
            if (request === 'url') {
                id.val(attachment.url);
            } else {
                id.val(attachment.ID);
            }
        };
        wp.media.editor.open(button);
        return false;
    }
}

jQuery(document).ready(function () {
    jQuery(function () {
        jQuery('.color-picker-input').each(function () {
            input_id = jQuery(this).attr('id');
            val = jQuery(this).val();
            var $input = jQuery(this);
            var current_color = $(this).val() || null;
            //
            const pickr = new Pickr({
                el: '#picker' + input_id,
                theme: "nano",
                swatches: null,
                defaultRepresentation: "HEXA",
                default: current_color,
                comparison: false,
                components: {
                    preview: true,
                    opacity: true,
                    hue: true,
                    interaction: {
                        hex: true,
                        rgba: true,
                        hsva: false,
                        input: true,
                        clear: true,
                        cancel: true,
                        save: true
                    }
                }
            });
            pickr
                .on("clear", function (instance) {
                    //console.log("clear");
                    $input.val("").trigger("change");
                })
                .on("cancel", function (instance) {
                    current_color = instance
                        .getSelectedColor()
                        .toHEXA()
                        .toString();
                    $input.val(current_color).trigger("change");
                })
                .on("change", function (color, instance) {
                    current_color = color
                        .toHEXA()
                        .toString();
                    $input.val(current_color).trigger("change");
                });
        });
    });
});

function load_select_multi_events() {

}

function handel_tab_pane_menus() {
    jQuery('.wupp_menu_item').find('button[data-toggle="collapse"]').attr('data-toggle', 'wupp-collapse');
    jQuery('.wupp_menu_content_item').find('button[data-toggle="collapse"]').attr('data-toggle', 'wupp-content-collapse');

    jQuery('.wupp_menu_item').find('button[data-toggle="wupp-collapse"]').on('click', function () {

        var target = jQuery(this).attr('data-target');

        if (jQuery(target).hasClass('show') || $(target).css('display') === 'block') {

            if (jQuery(target).hasClass('show')) {
                jQuery(target).css('display', 'block');
            }
            jQuery(target).slideUp();

        } else {

            jQuery('.wupp_menu_item').find('button[data-toggle="wupp-collapse"]').each(function () {
                var thisTarget = $(this).attr('data-target');
                if ($(thisTarget).hasClass('show')) {
                    $(thisTarget).css('display', 'block').removeClass('show');
                }
                $(thisTarget).slideUp()
            });

            jQuery(target).slideDown();

        }

    });
    jQuery('.wupp_menu_content_item').find('button[data-toggle="wupp-content-collapse"]').on('click', function () {

        var target = jQuery(this).attr('data-target');

        if (jQuery(target).hasClass('show') || $(target).css('display') === 'block') {

            if (jQuery(target).hasClass('show')) {
                jQuery(target).css('display', 'block');
            }
            jQuery(target).slideUp();

        } else {

            jQuery('.wupp_menu_content_item').find('button[data-toggle="wupp-content-collapse"]').each(function () {
                var thisTarget = $(this).attr('data-target');
                if ($(thisTarget).hasClass('show')) {
                    $(thisTarget).css('display', 'block').removeClass('show');
                }
                $(thisTarget).slideUp()
            });

            jQuery(target).slideDown();

        }

    });
}

jQuery(document).ready(function () {
    handel_tab_pane_menus();
    $('#pills-tabContent').find('.tab-pane').removeClass('fade');
    read_checkbox_button();
    load_select_multi_events();

    //single select
    handel_panel_side_items();

    //inputs placeholder
    wupp_read_input_tran();

    //fields bot
    read_fields_bot_scripts();

    //read checkbox button events

    wupp_single_btn_group();
    wupp_single_btn_info();
    wupp_read_date_picker();
    wupp_single_img_group();
    wupp_read_rang_inputs_pnl();
    wupp_read_switcher();
    wupp_read_textarea_trin();
    handel_menus_sortables();
});

read_checkbox_button();
load_select_multi_events();

//single select
handel_panel_side_items();
wupp_read_single_selectEvent();

//inputs placeholder
wupp_read_input_tran();

//multi select
wupp_read_select_tags_event_();

//fields bot
read_fields_bot_scripts();

//read checkbox button events

wupp_single_btn_group();
wupp_single_btn_info();
wupp_read_date_picker();
wupp_single_img_group();
wupp_read_rang_inputs_pnl();
wupp_read_switcher();
wupp_read_textarea_trin();
handel_menus_sortables();