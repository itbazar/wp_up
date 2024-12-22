<?php $dashboard_setting = WUPPAdminViews::get_options(); ?>
<?php $user_info = wp_get_current_user(); ?>
<p>
    <b id="wupp_user_dashboard_name"><?php echo $user_info->display_name; ?></b> <?php echo __("Welcome", "user-panel-pro"); ?>
</p>
<?php if ($dashboard_setting['dashboard_show_woo_notice']) : ?>
    <?php do_action('woocommerce_before_my_account'); ?>
<?php endif; ?>
<div class="clearfix"></div>
<?php if ($dashboard_setting['dashboard_show_woo_notice']) : ?>
    <?php do_action('woocommerce_account_dashboard'); ?>
<?php endif; ?>


<!-- Dashboard Ecommerce Starts -->
<section id="dashboard-ecommerce">
    <!-- Statistics Card -->
    <div class="row">
        <?php
        $info_boxes = $dashboard_setting['dashboard_info_box'];
        $cls = 'col-12 col-sm-6 col-md-3';
        if (isset($info_boxes) && !empty($info_boxes)) :
            foreach ($info_boxes as $info_box) :
                if ($info_box['box_status'] == '1') : ?>
                    <?php
                    switch ($info_box['box_size']) {
                        case '4-4':
                            $cls = 'col-12';
                            break;
                        case '3-4':
                            $cls = 'col-12 col-sm-6 col-md-9';
                            break;
                        case '2-4':
                            $cls = 'col-12 col-sm-6 col-md-6';
                            break;
                        case '1-4':
                            $cls = 'col-12 col-sm-6 col-md-3';
                            break;
                    }
                    ?>
                    <div class="<?php echo $cls; ?>">
                        <div class="card">
                            <?php if (isset($info_box['box_link']['url']) && !empty($info_box['box_link']['url'])) : ?>
                            <a href="<?php echo $info_box['box_link']['url']; ?>">
                                <?php endif; ?>
                                <div class="card-header">
                                    <div>
                                        <h2 class="font-weight-bolder mb-0"><?php echo do_shortcode($info_box['box_shortcode']); ?></h2>
                                        <p class="card-text"
                                           style="color:<?= (isset($info_box['box_text_color'])) ? $info_box['box_text_color'] : '#6E6B7B'; ?>"><?php echo $info_box['box_title']; ?></p>
                                    </div>
                                    <div class="avatar p-50 m-0"
                                         style="background:linear-gradient(<?php echo (isset($info_box['box_background']['background-gradient-direction'])) ? $info_box['box_background']['background-gradient-direction'] : 'to right' . '' ?>,<?php echo $info_box['box_background']['background-color'] . ',' . $info_box['box_background']['background-gradient-color'] . ''; ?>); color:<?= (isset($info_box['box_icon_color'])) ? $info_box['box_icon_color'] : '#FF9F43'; ?>">
                                        <div class="avatar-content">
                                            <i class="<?php echo $info_box['box_icon']; ?> font-medium-4"></i>
                                        </div>
                                    </div>
                                </div>
                                <?php if (isset($info_box['box_link']['url']) && !empty($info_box['box_link']['url'])) : ?>
                            </a>
                        <?php endif; ?>
                        </div>
                    </div>
                <?php
                endif;
            endforeach;
        endif;
        ?>
    </div>
    <!--/ Statistics Card -->

    <!-- Extra boxes -->
    <div class="row match-height">
        <!-- Dashboard Gift code -->
        <?php if ($dashboard_setting['dashboard_show_gift_code']) : ?>
            <div class="col-xl-4 col-md-6 col-12">
                <div class="card card-congratulation-medal">
                    <div class="card-body">
                        <h5><?php echo $dashboard_setting['dashboard_gift_code_info']; ?></h5>
                        <p class="card-text font-small-3"><?php echo $dashboard_setting['dashboard_gift_code_sub_info']; ?></p>
                        <h3 class="mb-75 mt-2 pt-50">
                            <a href="javascript:void(0);"><?php echo $dashboard_setting['dashboard_gift_code_text']; ?></a>
                        </h3>
                        <img src="<?php echo $dashboard_setting['dashboard_gift_img']; ?>" class="congratulation-medal"
                             alt="Discount Pic">
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <!--/ Dashboard Gift code -->

        <!-- Dashboard Time -->
        <?php if (isset($dashboard_setting['dashboard_show_date_time']) && $dashboard_setting['dashboard_show_date_time']) : ?>
        <div class="col-xl-4 col-md-6 col-12">
            <div class="card text-center">
                <div class="card-body">
                    <h3 class="card-title font-weight-bolder"><?php echo date_i18n('l', current_datetime()); ?></h3>
                    <h5 class="card-text"><?php echo date_i18n('j F Y', current_datetime()); ?></h5>
                    <p class="card-text pt-1">
                        <small class="text-muted"><?php printf( __('member since %s','user-panel-pro'),  date_i18n( "M Y", strtotime( $user_info->user_registered ) ) ); ?></small>
                    </p>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <!-- /Dashboard Time -->
    </div>
    <div class="row match-height">
        <?php do_action('wupp_after_dashboard_extra_boxes'); ?>

    </div>
    <!--/ Extra boxes -->
</section>
<!-- Dashboard Ecommerce ends -->

<?php do_action('wupp_after_dashboard_content'); ?>

<?php if ($dashboard_setting['dashboard_show_woo_notice']) : ?>
    <?php do_action('woocommerce_after_my_account'); ?>
<?php endif; ?>

<style>
    .card .card {
        box-shadow: 0 4px 24px 0 rgb(34 41 47 / 10%) !important;
    }
</style>