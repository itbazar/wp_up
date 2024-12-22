<?php $info = WUPPTools::get_sign_up_custom_field_info($username_helper_key) ?>

<?php if ($info): ?>
    <div class="col-12 pr-5 pl-5">
        <div class="form-group">
            <input class="form-control w-100 wupp-lg-input mb-3"
                   type="text"
                   name="<?php echo $username_helper_key; ?>"
                   placeholder="<?php echo $info['placeholder']; ?>"
                   maxlength="<?php echo $info['max_length']; ?>">
        </div>

        <div class="form-group">
            <input class="form-control w-100 wupp-lg-input mt-3"
                   type="password"
                   name="password"
                   placeholder="<?php echo __("Password", "user-panel-pro") ?>"
                   maxlength="60">
        </div>
    </div>
    <div class="col-12 pr-4 pl-4">
        <div class="pr-2 pl-2">
            <?php
            $input_items = [
                [
                    'input_id'            => 'remember_me',
                    'input_save_key'      => 'remember_me',
                    'input_title'         => __('remember me', 'user-panel-pro'),
                    'input_default_value' => false,
                ]
            ];
            include WUPP_FEATURES . 'input-checkbox.php';
            ?>
        </div>
    </div>
<?php endif; ?>