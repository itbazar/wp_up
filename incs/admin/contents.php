<?php 
WUPPO::$enqueue = true;
WUPPO::add_admin_enqueue_scripts();
?>
<!-- <link rel="stylesheet" href="<?php echo WUPP_ASSETS_CSS . 'setting.features.css' ?>"> -->
<div class="tab-content col-12 mt-0 mb-3 content-container bg-white" id="pills-tabContent">

	<?php if ( $settings_menus && count( $settings_menus ) > 0 ): ?>
		<?php $menu_count = 0; ?>
		<?php foreach ( $settings_menus as $settings_menu ): ?>
			<?php if ( $settings_menu['menu_sub_menus'] && count( $settings_menu['menu_sub_menus'] ) > 0 ): ?>
				<?php $sub_menus = $settings_menu['menu_sub_menus']; ?>
				<?php $sub_menus = apply_filters( 'wupp_sub_menus_' . $settings_menu['menu_slug'], $sub_menus ); ?>
				<?php if ( $sub_menus && is_array( $sub_menus ) && count( $sub_menus ) > 0 ) : ?>
					<?php $sub_menu_count = 0; ?>
					<?php foreach ( $sub_menus as $sub_menu ): ?>
						<?php if ($sub_menu['sub_menu_parent_slug'] == $settings_menu['menu_slug'] ): ?>
                            <div class="tab-pane position-relative w-100 fade show  <?php echo ( $sub_menu_count == 0 && $menu_count == 0 ) ? 'active' : ''; ?>"
                                 id="pills-<?php echo $sub_menu['sub_menu_slug']; ?>"
                                 role="tabpanel"
                                 aria-labelledby="pills-<?php echo $sub_menu['sub_menu_slug']; ?>-tab">
                                <div class="row text-dark">
                                    <div class="col-12">
                                        <div class="bg-white p-3">
                                            <div class="tab-content" id="pills-tabContent">
												<?php $result = call_user_func( $sub_menu['sub_menu_callable_function'] ); ?>
												<?php if ( $sub_menu['sub_menu_is_custom_view'] ): ?>
													<?php if ( $result && ! is_null( $result ) && ! empty( $result ) ): ?>
														<?php echo $result; ?>
													<?php endif; ?>
												<?php else: ?>
													<?php if ( $result && ! is_null( $result ) && ! empty( $result ) && is_array( $result ) && count( $result ) > 0 ): ?>
														<?php WUPPSettingsConfig::wupp_render_array_views( $result ); ?>
													<?php endif; ?>
												<?php endif; ?>
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


							<?php $sub_menu_count ++; ?>
						<?php endif; ?>
					<?php endforeach; ?>
				<?php endif; ?>
				<?php $menu_count ++; ?>

			<?php endif; ?>
		<?php endforeach; ?>
	<?php endif; ?>
</div>