<?php

require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../includes/functions.php";
require_once __DIR__ . "/../includes/auth.php";

$orders = mysqli_query($conn, "SELECT * FROM orders ORDER BY id DESC");

include "../includes/header.php";
include "../includes/sidebar.php";

?>

<div class="main-content">
    <div class="container-fluid py-4">
        <h2 class="mb-4">Quản lý đơn hàng</h2>
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Khách hàng</th>
                            <th>Điện thoại</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Ngày đặt</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($order = mysqli_fetch_assoc($orders)): ?>
                            <tr>
                                <td>#<?= $order["id"] ?></td>
                                <td><?= htmlspecialchars($order["customer_name"]) ?></td>
                                <td><?= htmlspecialchars($order["phone"]) ?></td>
                                <td><?= formatPrice($order["total_amount"]) ?></td>
                                <td><?= htmlspecialchars($order["order_status"]) ?></td>
                                <td><?= $order["created_at"] ?></td>
                                <td>
                                    <a href="detail.php?id=<?= $order["id"] ?>" class="btn btn-sm btn-info">Chi tiết</a>
                                    <a href="update-status.php?id=<?= $order["id"] ?>" class="btn btn-sm btn-warning">Cập nhật</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include "../includes/footer.php"; ?>