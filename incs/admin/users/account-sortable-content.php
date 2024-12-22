<?php $class = isset( $__disabled_menus ) && WUPPAdminMethods::check_disable_menu( $__disabled_menus, $save_menu['parent_slug'] ) ? 'd-none' : ''; ?>
<?php if ( $save_menu['type'] == 'menu' || $save_menu['type'] == 'link' ): ?>
	<?php if ( ! isset( $is_loader ) || $is_loader == false ): ?>
        <li class="w-100">
        <ul class="w-100 connectedSortable mb-0">
	<?php endif; ?>

    <li class="w-100 <?php echo $class ?>"
        id="wupp_mm_item_<?php echo $save_menu['slug']; ?>"
        data-parent="<?php echo $save_menu['parent_slug']; ?>"
        data-type="<?php echo $save_menu['type']; ?>"
        data-slug="<?php echo $save_menu['slug']; ?>">
        <div class="w-100 card-header p-0 position-relative">
            <button type="button" class="w-100 p-3 shadow-none border-0"
                    id="wupp_mm_item_btn_<?php echo $save_menu['slug']; ?>"
                    style="background-color: rgba(255,255,255,0); outline: none;height: 50px;">
				<?php echo $save_menu['title']; ?>
            </button>
            <span class="dashicons dashicons-move position-absolute tt-version mt-1"
                  style="cursor: move !important;"></span>
        </div>
    </li>
	<?php if ( ! isset( $is_loader ) || $is_loader == false ): ?>
        </ul>
        </li>
	<?php endif; ?>
<?php elseif ( $save_menu['type'] == 'group' ): ?>
	<?php if ( ! isset( $is_loader ) || $is_loader == false ): ?>
        <li class="w-100">
        <ul class="w-100 connectedSortable mb-0">
	<?php endif; ?>

    <li class="col-12 pr-3 pl-3 shadow-sm" style="background-color: #f5f5f5;"
        id="wupp_mm_item_<?php echo $save_menu['slug']; ?>"
        data-parent="<?php echo $save_menu['parent_slug']; ?>"
        data-slug="<?php echo $save_menu['slug']; ?>"
        data-type="<?php echo $save_menu['type']; ?>">

        <div class="w-100" style="min-height: 50px">
                    <span class="position-absolute tt-version-re mt-1"
                          id="wupp_mm_item_btn_<?php echo $save_menu['slug']; ?>"><?php echo $save_menu['title']; ?></span>
            <span class="dashicons dashicons-move position-absolute tt-version mt-1"
                  style="cursor: move !important;"></span>
        </div>
        <ul class="w-100 connectedSortable p-3 mb-0 <?php echo $class ?>">
			<?php $my_menus = $save_menu['items']; ?>
			<?php $is_loader = false; ?>
			<?php foreach ( $my_menus as $save_menu ): ?>
				<?php $is_loader = true; ?>
				<?php include WUPP_INCLUDES . 'admin/users/account-sortable-content.php'; ?>
			<?php endforeach; ?>
			<?php $is_loader = false; ?>
        </ul>

    </li>

	<?php if ( ! isset( $is_loader ) || $is_loader == false ): ?>
        </ul>
        </li>
	<?php endif; ?>

<?php endif; ?>