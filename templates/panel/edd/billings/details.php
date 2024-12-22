<div class="modal fade" id="modal_<?php echo $payment_key; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><?php echo __("Bought details", "user-panel-pro");?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php include WUPP_TPL . 'panel/edd/billings/details-content.php' ?>
            </div>
        </div>
    </div>
</div>
