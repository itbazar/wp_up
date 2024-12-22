<?php
defined('ABSPATH') || exit ("no access");
if( empty($this->b6457016f144d4a85b39810926cc) ): ?>
    <div class="notice notice-error">
        <?php if (version_compare(PHP_VERSION, '7.0.0') >= 0):?>
        <p>
            <?php printf(esc_html__( 'To activating %s, please insert your license key', 'guard-gn-f22585c665976c06cb0496b54cb9ec1e' ), esc_html__($this->a550dea508f947945eaf75b35913a, 'guard-gn-f22585c665976c06cb0496b54cb9ec1e')); ?>
            <a href="<?php echo admin_url( 'admin.php?page='.$this->c1c5982256bd008dc8dd187b23af8b ); ?>" class="button button-primary"><?php _e('Active License', 'guard-gn-f22585c665976c06cb0496b54cb9ec1e'); ?></a>
        </p>
        <?php else:?>
            <p>
                <?php printf(esc_html__( 'The PHP version of the website is lower than 7.0. Ask your host administrator to upgrade PHP version to activate %s. ', 'guard-gn-f22585c665976c06cb0496b54cb9ec1e' ), esc_html__($this->a550dea508f947945eaf75b35913a, 'guard-gn-f22585c665976c06cb0496b54cb9ec1e')); ?>
            </p>
    <?php endif; ?>
    </div>
<?php elseif( $this->a7fcaa8e017ce5d4fcf74ed===true ): ?>
    <div class="notice notice-error">
        <p>
            <?php printf(esc_html__( 'Something is wrong with your %s license. Please check it.', 'guard-gn-f22585c665976c06cb0496b54cb9ec1e' ), esc_html__($this->a550dea508f947945eaf75b35913a, 'guard-gn-f22585c665976c06cb0496b54cb9ec1e')); ?>
            <a href="<?php echo admin_url( 'admin.php?page='.$this->c1c5982256bd008dc8dd187b23af8b ); ?>" class="button button-primary"><?php _e('Check Now', 'guard-gn-f22585c665976c06cb0496b54cb9ec1e'); ?></a>
        </p>
    </div>
<?php endif; ?>