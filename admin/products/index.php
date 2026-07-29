<?php

require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../includes/functions.php";
require_once __DIR__ . "/../includes/auth.php";

$products = mysqli_query($conn, "SELECT products.*, categories.name AS category_name FROM products LEFT JOIN categories ON products.category_id = categories.id ORDER BY products.id DESC");

include "../includes/header.php";
include "../includes/sidebar.php";

?>

<div class="main-content">
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Quản lý sản phẩm</h2>
            <a href="create.php" class="btn btn-primary">+ Thêm sản phẩm</a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Danh mục</th>
                            <th>Giá</th>
                            <th>Tồn kho</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($product = mysqli_fetch_assoc($products)): ?>
                            <tr>
                                <td><?= $product["id"] ?></td>
                                <td><?= htmlspecialchars($product["name"]) ?></td>
                                <td><?= htmlspecialchars($product["category_name"] ?? "") ?></td>
                                <td><?= formatPrice($product["price"]) ?></td>
                                <td><?= $product["stock"] ?></td>
                                <td>
                                    <a href="edit.php?id=<?= $product["id"] ?>" class="btn btn-sm btn-warning">Sửa</a>
                                    <a href="delete.php?id=<?= $product["id"] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Xóa sản phẩm này?')">Xóa</a>
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