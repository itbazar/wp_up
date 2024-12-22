<?php do_action('before_view_' . $save_menu['slug']); ?>
    <div class="card-body">
        <?php
        echo do_shortcode($wp_embed->autoembed(wpautop(WUPPAdminMethods::get_menu_panel_content($save_menu))));
        ?>
    </div>
<?php do_action('after_view_' . $save_menu['slug']); ?>