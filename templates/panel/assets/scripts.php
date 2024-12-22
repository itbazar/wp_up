<?php ob_start();?>
<script data-role="wupp">
    jQuery(function ($) {
        var styleIdGenerator = 1;
        $(document.body).find('style').each(function () {
            $(this).attr('data-tag', 'wupp-sty-' + styleIdGenerator);
            styleIdGenerator ++;
        });
        $(document.head).find('style').each(function () {
            $(this).attr('data-tag', 'wupp-sty-' + styleIdGenerator);
            styleIdGenerator ++;
        });
        <?php $wupp_panel_defult_removable_styles = 'wp-content/themes'?>;
        var style_exceptions = '<?php echo 'wp-content/plugins/user-panel-pro'?>';
        var style_hard_remove = '<?php echo $wupp_panel_defult_removable_styles.','. $panel_settings['panel_remove_styles_custom_list']?>';
        var doNotRemove = style_exceptions.split(',');
        var doRemove = style_hard_remove.split(',');

        jQuery('style').each(function () {
            if ($(this).attr('data-role') !== 'wupp') {
                var data = $(this).html();
                var attrTag = $(this).attr('data-tag');
                if(doRemove.length > 0){
                    for (let i = 0; i < doRemove.length; i++) {
                        try{
                            if(doRemove[i] !== undefined && doRemove[i] !== ''){
                                if(data.search(doRemove[i]) !== -1 || attrTag === doRemove[i]){
                                    $(this).remove();
                                }
                            }
                        }catch (e) {}
                    }
                }
            }
        });
        jQuery(document.head).find('style').each(function () {
            if ($(this).attr('data-role') !== 'wupp') {
                var data = $(this).html();
                var attrTag = $(this).attr('data-tag');
                if (doRemove.length > 0){
                    for (let i = 0; i < doRemove.length; i++) {
                        try{
                            if(doRemove[i] !== undefined && doRemove[i] !== '' && (data.search(doRemove[i]) !== -1 || attrTag === doRemove[i])){
                                $(this).remove();
                            }
                        }catch (e) {}
                    }
                }
            }
        });
        jQuery(document.head).find('link').each(function () {
            var href = $(this).attr('href');

            if (href === undefined || href === '' ) {
                $(this).remove();
            } else {
                //style hard remove
                if(doRemove.length > 0){
                    for (let i = 0; i < doRemove.length; i++) {
                        try{
                            if(doRemove[i] !== undefined && doRemove[i] !== '' && href.search(doRemove[i]) !== -1){
                                $(this).remove();
                            }
                        }catch (e) {}
                    }
                }

                //style exception remove

                // var bool_level_1 = href.search('plugins') !== -1 || href.search('uploads') !== 1 || href.search('themes') !== -1;
                // var bool_level_2 = bool_level_1 && href.search('user-panel-pro') === -1;
                //
                // if (bool_level_2 && $(this).attr('data-role') !== 'wupp') {
                //     var data = href;
                //     var allow_remove = true;
                //
                //     for (let i = 0; i < doNotRemove.length; i++) {
                //         try{
                //             if(data.search(doNotRemove[i]) !== -1){
                //                 allow_remove = false;
                //             }
                //         }catch (e) {}
                //     }
                //
                //     if (allow_remove) {
                //         //$(this).remove();
                //     }
                // }
            }
        });

        if(doRemove.length > 0){
            for (let i = 0; i < doRemove.length; i++) {
                try{
                    if(doRemove[i] !== undefined && doRemove[i] !== ''){
                        var elm = jQuery(doRemove[i]);
                        if(jQuery(elm).is('style') || jQuery(elm).is('link') || jQuery(elm).is('script')){
                            jQuery(elm).remove();
                        }
                    }
                }catch (e) {}
            }
        }

        //scripts exceptions
        <?php $wupp_panel_defult_removable_scripts = 'wp-content/themes'?>;
        var scripts_exceptions = 'wp-content/plugins/user-panel-pro';
        var scripts_hard_remove = '<?php echo $wupp_panel_defult_removable_scripts.','.  $panel_settings['panel_remove_scripts_custom_list']?>';
        doNotRemove = scripts_exceptions.split(',');
        doRemove = scripts_hard_remove.split(',');

        jQuery('script').each(function () {
            var bool1 = $(this).attr('data-role') !== 'wupp';
            if(bool1){
                var src = $(this).attr('src');
                var data = $(this).html();

                if(data === '' && (src === undefined || src === '')){
                    $(this).remove();
                }else {
                    if(data === '' && src !== undefined && src !== ''){
                        data = src;
                    }
                    //scripts hard remove
                    if(doRemove.length > 0){
                        for (let i = 0; i < doRemove.length; i++) {
                            try{
                                if(doRemove[i] !== undefined && doRemove[i] !== '' && data.search(doRemove[i]) !== -1){
                                    $(this).remove();
                                }
                            }catch (e) {}
                        }
                    }
                }
            }
        });
        jQuery(document.head).find('script').each(function () {
            var bool1 = $(this).attr('data-role') !== 'wupp';
            if(bool1){
                var src = $(this).attr('src');
                var data = $(this).html();

                if(data === '' && (src === undefined || src === '')){
                    $(this).remove();
                }else {
                    if(data === '' && src !== undefined && src !== ''){
                        data = src;
                    }
                    //scripts hard remove
                    if(doRemove.length > 0){
                        for (let i = 0; i < doRemove.length; i++) {
                            try{
                                if(doRemove[i] !== undefined && doRemove[i] !== '' && data.search(doRemove[i]) !== -1){
                                    $(this).remove();
                                }
                            }catch (e) {}
                        }
                    }

                }
            }
        });

    })
</script>
