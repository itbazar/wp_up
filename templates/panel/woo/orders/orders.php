<div class="container pt-2 pb-2 woocommerce">
    <?php if (isset($_GET['order_details']) && intval($_GET['order_details'])): ?>
        <?php include WUPP_TPL . 'panel/woo/orders/order-visit.php'; ?>
    <?php else: ?>
        <?php include WUPP_TPL . 'panel/woo/orders/orders-content.php'; ?>
    <?php endif; ?>
</div>