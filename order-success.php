<?php

session_start();

include "config/database.php";
include "includes/functions.php";

$orderId = (int)($_GET["order_id"] ?? 0);
$order = null;
if ($orderId > 0) {
    $result = mysqli_query($conn, "SELECT * FROM orders WHERE id = $orderId");
    $order = mysqli_fetch_assoc($result);
}

include "includes/header.php";
include "includes/navbar.php";

?>

<section class="container py-5 text-center">
    <i class="bi bi-check-circle-fill" style="font-size:100px;color:green;"></i>
    <h2 class="mt-4">Đặt hàng thành công</h2>
    <p>Cảm ơn bạn đã mua hàng tại Laptop Store.</p>
    <?php if ($order): ?>
        <p><strong>Mã đơn hàng:</strong> #<?= $order["id"] ?></p>
        <p><strong>Tổng tiền:</strong> <?= formatPrice($order["total_amount"]) ?></p>
    <?php endif; ?>
    <a href="<?= BASE_URL ?>/products.php" class="btn btn-primary">Tiếp tục mua sắm</a>
</section>

<?php

include "includes/footer.php";

?>