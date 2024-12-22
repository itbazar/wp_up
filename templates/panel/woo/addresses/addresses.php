<div class="container pt-2 pb-2">
  <?php
  if (class_exists('WooCommerce')) {
    wc_print_notices();
  }
  if (isset($_GET['address-type']) && !empty($_GET['address-type'])) {
    if ($_GET['address-type'] == 'billing') {
      include WUPP_TPL . 'panel/woo/addresses/edit-billing.php';
    }
    if ($_GET['address-type'] == 'shipping') {
      include WUPP_TPL . 'panel/woo/addresses/edit-shipping.php';
    }
  } else {
    include_once WUPP_TPL . 'panel/woo/addresses/addresses-content.php';
  }
  ?>
</div>