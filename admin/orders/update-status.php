<?php

require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../includes/auth.php";

$id = (int)($_GET["id"] ?? 0);
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $status = trim($_POST["status"] ?? "Đang xử lý");
    $status = mysqli_real_escape_string($conn, $status);

    if ($id > 0) {
        mysqli_query($conn, "UPDATE orders SET order_status = '$status' WHERE id = $id");
    }

    header("Location: index.php?updated=1");
    exit;
}

$order = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM orders WHERE id = $id"));
if (!$order) {
    header("Location: index.php");
    exit;
}

include "../includes/header.php";
include "../includes/sidebar.php";

?>

<div class="main-content">
    <div class="container-fluid py-4">
        <h2 class="mb-4">Cập nhật trạng thái đơn hàng</h2>
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <form method="POST" action="<?= htmlspecialchars('update-status.php?id=' . $id) ?>">
                    <div class="mb-3">
                        <label class="form-label">Trạng thái</label>
                        <select name="status" class="form-select">
                            <option value="Đang xử lý" <?= $order["order_status"] === "Đang xử lý" ? "selected" : "" ?>>Đang xử lý</option>
                            <option value="Đã xác nhận" <?= $order["order_status"] === "Đã xác nhận" ? "selected" : "" ?>>Đã xác nhận</option>
                            <option value="Đang giao" <?= $order["order_status"] === "Đang giao" ? "selected" : "" ?>>Đang giao</option>
                            <option value="Hoàn thành" <?= $order["order_status"] === "Hoàn thành" ? "selected" : "" ?>>Hoàn thành</option>
                            <option value="Đã hủy" <?= $order["order_status"] === "Đã hủy" ? "selected" : "" ?>>Đã hủy</option>
                        </select>
                    </div>
                    <button class="btn btn-primary">Lưu</button>
                    <a href="index.php" class="btn btn-secondary">Quay lại</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "../includes/footer.php"; ?>