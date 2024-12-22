<?php $my_items = $items; ?>
<?php foreach ($my_items as $save_menu) : ?>
	<?php if (isset($save_menu['link']) && $save_menu['type'] == 'menu' && $save_menu['link'] == $page_tag) : ?>
		<div class="content-header row">
			<div class="content-header-left col-md-9 col-12 mb-2">
				<div class="row breadcrumbs-top">
					<div class="col-12">
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><?php echo __('panel', 'user-panel-pro') ?>
								</li>
								<li class="breadcrumb-item active"><?php echo $save_menu['title']; ?>
								</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="content-body">
			<div class="card">
				<?php $save_menu['type'] == 'menu' ? $menu_count++ : null; ?>
				<?php $hidden_v = isset($save_menu['hidden']) ? intval($save_menu['hidden']) : 1; ?>
				<?php if ($hidden_v && (WUPPTools::wupp_user_can($user_info, $save_menu['default_role']) || $save_menu['default_role'] == '')) : ?>
					<?php if ($save_menu['type'] == 'menu') : ?>
						<?php
						$default_content = $save_menu['default_content'];
						include WUPP_TPL . 'panel/self/custom.php';
						?>
					<?php elseif ($save_menu['type'] == 'group') : ?>
						<?php $items = $save_menu['items']; ?>
						<?php include WUPP_TPL . 'panel/content-group.php'; ?>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>
<?php endforeach; ?>