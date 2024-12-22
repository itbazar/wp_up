function load_sign_up() {
    jQuery('#wupp_btn_signup').addClass('d-none');
    jQuery('#wupp_p_login').addClass('d-none');
    jQuery('#wupp_btn_login').removeClass('d-none');
    jQuery('#wupp_p_signup').removeClass('d-none');

    jQuery('#wupp_pnl_sign_in').addClass('fade_in_to_left').addClass('fade_out_to_right');
    jQuery('#wupp_pnl_forgot').addClass('fade_in_to_left').addClass('fade_out_to_right');
    jQuery('#wupp_pnl_sign_up').removeClass('fade_out_to_left').addClass('fade_in_to_right');
    jQuery('#wupp_des_pnl').removeClass('overlay-left-fo-right').addClass('overlay-left-fo-lef');
}

function load_sign_in() {
    jQuery('#wupp_btn_login').addClass('d-none');
    jQuery('#wupp_p_signup').addClass('d-none');
    jQuery('#wupp_btn_signup').removeClass('d-none');
    jQuery('#wupp_p_login').removeClass('d-none');


    jQuery('#wupp_pnl_sign_in').removeClass('fade_out_to_right d-none').addClass('fade_in_to_left');
    jQuery('#wupp_pnl_forgot').removeClass('fade_in_to_right').addClass('fade_out_to_left d-none');
    jQuery('#wupp_pnl_sign_up').removeClass('fade_in_to_right').addClass('fade_out_to_left');
    jQuery('#wupp_des_pnl').removeClass('overlay-left-fo-lef').addClass('overlay-left-fo-right');
}

jQuery(function ($) {
    jQuery("#animatebutton").click(function () {
        const element = document.querySelector('.animatebutton');
        element.classList.add('animated', 'tada');
        setTimeout(function () {
            element.classList.remove('tada');
        }, 1000);
    });
    jQuery('#wupp_user_img_avatar').hover(
        function () {
            jQuery('#wupp_avatar_camera_bg')
                .removeClass('bg-camera-in-load')
                .addClass('bg-camera-load');
        },
        function () {
            jQuery('#wupp_avatar_camera_bg')
                .removeClass('bg-camera-load')
                .addClass('bg-camera-in-load');
        }
    );

    //remove public styles and scripts
    jQuery('link[href*="wp-content/themes"]').remove();
    jQuery('link[href*="bs-booster-cache"]').remove();
    jQuery('link[href*="codevz"]').remove();
    jQuery('link[href*="woocommerce/"]').remove();
    jQuery('#codevz-plugin-inline-css').remove();
    jQuery('#taqyeem-styles-inline-css').remove();
    jQuery('#wupp_main_pnl').parent().children().each(function () {
        $bool1 = jQuery(this).hasClass('wupp') === false;
        $bool2 = jQuery(this).is('link') === false;
        $bool3 = jQuery(this).is('script') === false;
        $bool4 = jQuery(this).is('style') === false;
        if ($bool1 && $bool2 && $bool3 && $bool4) {
            jQuery(this).remove();
        }
    });


    //custom search for remove public styles and scripts
    jQuery('style').each(function () {
        if ($(this).attr('data-role') !== 'wupp') {
            if (jQuery(this).html().search('svg') === -1 && jQuery(this).html().search('woocommerce') === -1) {
                $(this).remove();
            }
        }
    });
    jQuery('script').each(function () {
        var bool1 = $(this).attr('data-role') !== 'wupp';
        var bool2 = ($(this).attr('src') === undefined || $(this).attr('src') === '');
        var bool3 = jQuery(this).html().search('woocommerce') === -1;
        if (bool1 && bool2 && bool3) {
            $(this).remove();
        }
    });
    jQuery(document.head).find('script').each(function () {
        var bool1 = $(this).attr('data-role') !== 'wupp';
        var bool2 = ($(this).attr('src') === undefined || $(this).attr('src') === '');
        var bool3 = jQuery(this).html().search('woocommerce') === -1;
        if (bool1 && bool2 && bool3) {
            $(this).remove();
        }
    });
    jQuery(document.head).find('style').each(function () {
        if ($(this).attr('data-role') !== 'wupp') {
            if (jQuery(this).html().search('svg') === -1 && jQuery(this).html().search('woocommerce') === -1) {
                $(this).remove();
            }
        }
    });
    jQuery(document.head).find('link').each(function () {
        var href = $(this).attr('href');

        if (href === undefined || href === '') {
            $(this).remove();
        }else {
            var bool2 = ((href.search('plugins') !== -1 || href.search('uploads') !== 1) && href.search('user-panel-pro') === -1) || href.search('themes') !== -1;
            if(bool2){
                $(this).remove();
            }
        }
    });
})