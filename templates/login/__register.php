<div id="wupp_pnl_sign_up" class="wupp-content col-12 col-md-6 position-absolute fade_out_to_left overflow-auto">
    <div class="row w-100 mx-auto">
        <div class="col-12 p-0 mb-4">
            <h1 class="text-center mt-4"><?php echo __('Register', 'user-panel-pro') ?></h1>
        </div>
        <div class="clearfix"></div>
        <?php do_action('wupp_before_register_form'); ?>
        <div class="clearfix"></div>
        <div class="col-12 pr-md-5 pl-md-5">
            <div id="signupFormState" class="alert d-none" role="alert">
            </div>
        </div>
        <div class="col-12 p-0">
            <form id="form_sign_up" class="w-100" action="<?php echo admin_url(); ?>admin-ajax.php" method="post">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 pr-5 pl-5">
                            <?php $type = WUPPTools::wupp_get_register_form_type_function(); ?>
                            <?php if (is_null($type) || empty($type)) : ?>
                                <?php $fields = WUPPAdminViews::get_option('base_register_form_fields', []);
                                ?>

                                <?php foreach ($fields as $field) : ?>
                                    <?php if ($field['field_active'] == '1') : ?>
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
                                                <input class="form-control w-100 wupp-lg-input mb-3" type="<?php echo $field['field_type']; ?>" <?php echo $required ? 'data-required="required"' : ''; ?> name="<?php echo $field['field_key']; ?>" placeholder="<?php echo $field['field_name']; ?>" maxlength="<?php echo $field['field_max_length']; ?>">
                                                <?php if ($field['field_key'] == 'password') : ?>
                                                    <?php if ($required) : ?>
                                                        <span class="position-absolute text-danger" style="<?php echo is_rtl() ? 'right' : 'left' ?>: 20px;">*</span>
                                                    <?php endif; ?>
                                                    <div class="form-group">
                                                        <input class="form-control w-100 wupp-lg-input mb-3" type="password" <?php echo $required ? 'data-required="required"' : ''; ?> name="password_repeat" placeholder="<?php echo __('repeat password', 'user-panel-pro'); ?>" maxlength="<?php echo $field['field_max_length']; ?>">
                                                    </div>
                                                <?php endif; ?>
                                            <?php elseif ($field['type'] == 'select') : ?>
                                                <select name="<?php echo $field['name']; ?>">
                                                    <?php $items = explode(',', $field['select_items']); ?>
                                                    <?php foreach ($items as $item) : ?>
                                                        <option value="<?php echo $item; ?>"><?php echo $item; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            <?php elseif ($field['type'] == 'radio') : ?>
                                                <div class="custom-control custom-radio mb-2 mb-3">
                                                    <input type="radio" id="radio_<?php echo $field['name']; ?>" value="<?php echo $field['name']; ?>" name="<?php echo $field['name']; ?>" class="custom-control-input ">
                                                    <label class="custom-control-label" for="radio_<?php echo $field['name']; ?>"></label>
                                                    <span class="pr-4 pl-4 mr-1 ml-1" style="font-size: 1.4rem"><?php echo $field['placeholder']; ?></span>
                                                </div>
                                            <?php elseif ($field['type'] == 'checkbox') : ?>
                                                <div class="custom-control custom-checkbox mb-3">
                                                    <input type="checkbox" class="custom-control-input" <?php echo $field['required'] ? 'data-required="required"' : ''; ?> name="<?php echo $field['name']; ?>" id="check_box_<?php echo $field['name']; ?>">
                                                    <label class="custom-control-label" style="margin-right: -1.4rem !important;" for="check_box_<?php echo $field['name']; ?>"></label>
                                                    <span class="pr-4 pl-4 mr-1 ml-1"><?php echo $field['placeholder']; ?></span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <?php echo call_user_func($type); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 pr-5 pl-5">
                    <?php $rol_class = isset($login_settings['accept_sign_up_rol']) && $login_settings['accept_sign_up_rol'] ? '' : 'd-none'; ?>
                    <div class="custom-control custom-checkbox mb-3 <?php echo $rol_class; ?>">
                        <input type="checkbox" class="custom-control-input" <?php checked(!$login_settings['accept_sign_up_rol']) ?> name="wupp_remember_me" id="check_box_wupp_remember_me">
                        <label class="custom-control-label" style="margin-right: -1.4rem !important;" for="check_box_wupp_remember_me"></label>
                        <?php
                        $tag     = __('rules', 'user-panel-pro');
                        $accept  = __('I agree with the rules', 'user-panel-pro');
                        $page_id = $login_settings['register_page_roles'];
                        $link    = $page_id > 0 ? get_page_link($page_id) : '#';
                        $link    = "<a href='" . $link . "' target='_blank'>$tag</a>";

                        $accept_so = str_replace($tag, $link, $accept);
                        ?>
                        <span class="pr-4 pl-4 mr-1 ml-1"><?php echo $accept_so; ?></span>
                    </div>
                </div>
                <?php do_action('wupp_end_register_form', 'register_captcha_element'); ?>
                <div class="col-12 col-sm-6 pr-5 pl-5 float-end mb-4">
                    <button type="submit" id="btn_sub_sign_up" class="btn btn-sm btn-outline-primary w-100 pr-5 pl-5 float-end ">
                        <?php echo __('register', 'user-panel-pro'); ?>
                    </button>
                </div>
            </form>
        </div>
        <div class="clearfix"></div>
        <div class="col-12 col-sm-6 col-md-3 pr-5 pl-5 mt-5 d-block d-md-none">
            <div class="w-100 align-content-center text-center">
                <button onclick="load_sign_in()" class="btn btn-link text-decoration-none text-dark bg-transparent"><?php echo __('Login', 'user-panel-pro') ?></button>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-12 d-none" id="sign_up_auth">
            <p><?php echo __('To complete the registration, you must enter the verification code sent to you!', 'user-panel-pro'); ?></p>
            <?php $pre_connect  = 'register_'; ?>
            <?php include WUPP_TPL . 'login/forms/auth_code.php'; ?>
        </div>
        <div class="clearfix"></div>
        <?php do_action('wupp_after_register_form'); ?>
    </div>
</div>