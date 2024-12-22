<div class="container pt-5 pb-5">
    <?php if (isset($_GET['action']) && $_GET['action'] == 'edit-methods'): ?>
        <?php include_once WUPP_TPL . 'panel/woo/payment-methods/payment-content.php'?>
    <?php else: ?>
        <?php include_once WUPP_TPL . 'panel/woo/payment-methods/payment-lists.php'?>
    <?php endif; ?>
</div>