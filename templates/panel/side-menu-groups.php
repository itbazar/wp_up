<?php if (count($items)) : ?>
	<?php
	$active_class_group = '';
	foreach ($items as $check_class) {
		if (isset($check_class['link']) && $check_class['link'] == $page_tag) {
			$active_class_group = 'sidebar-group-active open';
		}
	}
	?>
	<?php $expanded = $save_menu['show'] === true; ?>
	<li class="nav-item <?php echo $active_class_group . ' ' . $save_menu['custom_class']; ?>">
		<a class="d-flex align-items-center" href="#">
			<i class="<?php echo $save_menu['default_icon']; ?>"></i>
			<span class="menu-title text-truncate" data-i18n="Page Layouts"><?php echo $save_menu['title']; ?></span>
		</a>
		<ul class="menu-content">
			<?php $row_items = $items; ?>
			<?php $panel_permalink = WUPPPages::get_dashboard_page_permalink(); ?>
			<?php foreach ($row_items as $item) : ?>
				<?php $active_class = isset($item['link']) && $item['link'] == $page_tag ? 'active' : ''; ?>
				<?php if ($item['type'] == 'menu') : ?>
					<?php if ($item['hidden'] == '1') : ?>
						<li class="<?php echo $active_class . ' ' . $item['custom_class']; ?>">
							<a class="d-flex align-items-center wupp-menu-link" id="<?php echo $item['link']; ?>" href="<?php echo $panel_permalink . $item['link']; ?>">
								<i data-feather="circle"></i>
								<span class="menu-item text-truncate" data-i18n="<?php echo $item['title']; ?>"><?php echo $item['title']; ?></span>
							</a>
						</li>
					<?php endif; ?>
				<?php elseif ($item['type'] == 'link') : ?>
					<?php if ($item['hidden'] == '1') : ?>
						<li class="<?php echo $active_class . ' ' . $item['custom_class']; ?>">
							<a class="d-flex align-items-center" id="<?php echo $item['slug']; ?>" href="<?php echo $item['default_link']; ?>"<?php echo $item['open_in_other_page'] ? 'target="_blank"' : ''; ?>>
								<i data-feather="circle"></i>
								<span class="menu-item text-truncate" data-i18n="<?php echo $item['title']; ?>"><?php echo $item['title']; ?></span>
							</a>
						</li>
					<?php endif; ?>
				<?php else : ?>
					<?php $save_menu = $item; ?>
					<?php $items = $save_menu['items']; ?>
					<?php include WUPP_TPL . 'panel/side-menu-groups.php'; ?>
				<?php endif; ?>
			<?php endforeach; ?>

		</ul>
	</li>
<?php endif; ?>