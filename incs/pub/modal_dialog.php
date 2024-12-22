<script data-role="wupp">
	function close_pnl_modal() {
        jQuery('#pnl_modal_item').css('display', 'none');
        jQuery('#pnl_modal').css('display', 'none');
    }
    jQuery(document).ready(function () {
        jQuery('#pnl_modal_item').on('click', function (e) {
			e.stopPropagation();
        });
        jQuery('#wupp_mod_cancel_btn').on('click', function (e) {
			e.preventDefault();
            close_pnl_modal();
        });
    });
</script>
<div id="pnl_modal"
	 onclick="close_pnl_modal()"
     class="wupp container-fluid position-fixed pt-5"
     style="z-index: 1200; top: 0; left: 0; display: none; right: 0;bottom: 0; background-color: rgba(0, 0, 0, 0.58);">

	<div class="row">
		<div id="pnl_modal_item" class="col-11 col-sm-6 col-md-4 m-auto bg-white shadow-sm p-4" style="border-radius: 5px">
			<p><?php echo __('Are you sure you want to do this?', 'user-panel-pro')?></p>
			<div class="clearfix"></div>
			<div class="row">
				<div class="col-12 col-md-6">
					<p class="text-danger d-none" id="wupp_mod_des"></p>
				</div>
				<div class="col-12 col-md-6">
					<button id="wupp_mod_don_btn" class="btn btn-sm btn-success float-end mr-1 ml-1"><?php echo __('Done', 'user-panel-pro');?></button>
					<button id="wupp_mod_cancel_btn" class="btn btn-sm btn-danger float-end mr-1 ml-1"><?php echo __('Cancel', 'user-panel-pro');?></button>
				</div>
			</div>
		</div>
	</div>

</div>