<footer class="footer footer-static footer-light">
    <p class="clearfix mb-0">
        <span class="float-md-left d-block d-md-inline-block mt-25">
            <?php echo $panel_settings['footer_copyright_text']; ?>
        </span>
        <?php if(!isset($panel_settings['pro_remove_panel_copyright']) || $panel_settings['pro_remove_panel_copyright'] != 1): ?>
        <span class="float-md-right d-none d-md-block text-muted"><?php echo __('Powered by UP user panel', 'user-panel-pro'); ?>
            <!-- <i data-feather="heart"></i> -->
        </span>
        <?php endif; ?>
    </p>
</footer>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>