<?php $type = WUPPTools::wupp_get_edit_profile_type(); ?>
<?php if (!empty($type) && $type == 'BASE') : ?>
    <form action="" method="POST" id="wupp_edit_profile_form">
        <?php wp_nonce_field('wupp_account_general_nonce', 'wupp_nonce'); ?>
        <div class="row">
            <div class="col-12 pr-5 pl-5">
                <?php $fields = WUPPAdminViews::get_option('base_register_form_fields', ''); ?>
                <?php foreach ($fields as $field) : ?>
                    <?php if ($field['field_active'] == 1) : ?>
                        <div class="form-group">
                            <?php $ttypes = [
                                'number',
                                'password',
                                'url',
                                'text',
                                'email'
                            ]; ?>
                            <?php $required = $field['field_status'] == 'required'; ?>
                            <?php if (in_array($field['field_type'], $ttypes)) : ?>
                                <?php if ($required) : ?>
                                    <span class="position-absolute text-danger" style="<?php echo is_rtl() ? 'right' : 'left' ?>: 20px;">*</span>
                                <?php endif; ?>
                                <input class="form-control w-100 wupp-lg-input mb-3" type="<?php echo $field['field_type']; ?>" <?php echo $required ? 'data-required="required"' : ''; ?> name="<?php echo $field['field_key']; ?>" value="<?php echo WUPPTools::get_current_user_info($field['field_key']) ?>" placeholder="<?php echo $field['field_name']; ?>" maxlength="<?php echo $field['field_max_length']; ?>">
                                <?php if ($field['field_type'] == 'password') : ?>
                                    <?php if ($required) : ?>
                                        <span class="position-absolute text-danger" style="<?php echo WUPPAsset::wupp_is_rtl_local() ? 'right' : 'left' ?>: 20px;">*</span>
                                    <?php endif; ?>
                                    <div class="form-group">
                                        <input class="form-control w-100 wupp-lg-input mb-3" type="password" value="<?php echo WUPPTools::get_current_user_info($field['field_key']) ?>" <?php echo $required ? 'data-required="required"' : ''; ?> name="password_repeat" placeholder="<?php echo __('repeat password', 'user-panel-pro'); ?>" maxlength="<?php echo $field['field_max_length']; ?>">
                                    </div>
                                <?php endif; ?>
                            <?php elseif ($field['field_type'] == 'select') : ?>
                                <select name="<?php echo $field['field_key']; ?>">
                                    <?php $items = explode(',', $field['select_items']); ?>
                                    <?php foreach ($items as $item) : ?>
                                        <?php $vll = WUPPTools::get_current_user_info($field['field_key']) ?>
                                        <option <?php selected($vll == $item) ?> value="<?php echo $item; ?>"><?php echo $item; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            <?php elseif ($field['field_type'] == 'radio') : ?>
                                <div class="custom-control custom-radio mb-2 mb-3">
                                    <input type="radio" id="radio_<?php echo $field['field_key']; ?>" <?php $vll = WUPPTools::get_current_user_info($field['field_key']) ?> <?php checked($vll == $field['field_key']) ?> name="<?php echo $field['field_key']; ?>" class="custom-control-input ">
                                    <label class="custom-control-label" for="radio_<?php echo $field['field_key']; ?>"></label>
                                    <span class="pr-4 pl-4 mr-1 ml-1" style="font-size: 1.4rem"><?php echo $field['field_name']; ?></span>
                                </div>
                            <?php elseif ($field['field_type'] == 'checkbox') : ?>
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="custom-control-input" <?php echo $field['required'] ? 'data-required="required"' : ''; ?> name="<?php echo $field['field_key']; ?>" <?php $vll = WUPPTools::get_current_user_info($field['field_key']) ?> <?php checked($vll); ?> id="check_box_<?php echo $field['field_key']; ?>">
                                    <label class="custom-control-label" style="margin-right: -1.4rem !important;" for="check_box_<?php echo $field['field_key']; ?>"></label>
                                    <span class="pr-4 pl-4 mr-1 ml-1"><?php echo $field['field_name']; ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="col-12 col-sm-6 pr-5 pl-5 float-end mb-4">
                <div class="row">
                    <div class="col-12 p-0">
                        <button type="submit" id="wupp_update_profile" data-url="<?php echo admin_url('admin-ajax.php'); ?>" class="btn btn-sm btn-outline-primary pr-5 pl-5">
                            <?php echo __('update', 'user-panel-pro'); ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php else : do_action('wupp_edit_profile_custom'); ?>
<?php endif; ?>