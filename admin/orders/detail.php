<?php

require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../includes/functions.php";
require_once __DIR__ . "/../includes/auth.php";

$id = (int)($_GET["id"] ?? 0);
$order = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM orders WHERE id = $id"));
if (!$order) {
    header("Location: index.php");
    exit;
}

$details = mysqli_query($conn, "SELECT order_details.*, products.name AS product_name FROM order_details LEFT JOIN products ON order_details.product_id = products.id WHERE order_details.order_id = $id");

include "../includes/header.php";
include "../includes/sidebar.php";

?>

<div class="main-content">
    <div class="container-fluid py-4">
        <h2 class="mb-4">Chi tiết đơn hàng #<?= $order["id"] ?></h2>
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <p><strong>Khách hàng:</strong> <?= htmlspecialchars($order["customer_name"]) ?></p>
                <p><strong>Điện thoại:</strong> <?= htmlspecialchars($order["phone"]) ?></p>
                <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($order["address"]) ?></p>
                <p><strong>Ghi chú:</strong> <?= htmlspecialchars($order["note"]) ?></p>
                <p><strong>Trạng thái:</strong> <?= htmlspecialchars($order["order_status"]) ?></p>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($item = mysqli_fetch_assoc($details)): ?>
                            <tr>
                                <td><?= htmlspecialchars($item["product_name"] ?? "") ?></td>
                                <td><?= formatPrice($item["price"]) ?></td>
                                <td><?= $item["quantity"] ?></td>
                                <td><?= formatPrice($item["price"] * $item["quantity"]) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <div class="text-end">
                    <strong>Tổng: <?= formatPrice($order["total_amount"]) ?></strong>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "../includes/footer.php"; ?>