<div class="row">
    <?php $addresses = WUPPWoo::get_shipping_and_billing_addresses(); ?>

    <?php foreach ($addresses as $address) : ?>
        <div class="col-12 col-md-6 position-relative" id="wupp_woo_address">
            <div class="card border-0 shadow p-1 p-md-3 border-primary">
                <div class="row">
                    <div class="col-6">
                        <h3><?php echo $address['title']; ?></h3>
                    </div>
                    <div class="col-6">
                        <a href="?address-type=<?php echo $address['address_type']; ?>" class="btn btn-outline-primary float-right btn-sm">
                            <i data-feather="edit" class="mr-25"></i>
                            <span><?php echo $address['addresses'] ? __('Update', 'user-panel-pro') : __('Add', 'user-panel-pro'); ?></span>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <P class="mt-3">
                            <?php if ($address['addresses']) : ?>
                                <?php echo $address['addresses']; ?>
                            <?php else : ?>
                                <?php echo __('You have not yet entered the address for this section!', 'user-panel-pro'); ?>
                            <?php endif; ?>
                        </P>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>