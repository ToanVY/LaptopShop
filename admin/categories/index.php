<?php

require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../includes/functions.php";
require_once __DIR__ . "/../includes/auth.php";

$categories = mysqli_query($conn, "SELECT * FROM categories ORDER BY id DESC");

include "../includes/header.php";
include "../includes/sidebar.php";

?>

<div class="main-content">
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Quản lý danh mục</h2>
            <a href="create.php" class="btn btn-primary">+ Thêm danh mục</a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên danh mục</th>
                            <th>Ngày tạo</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($category = mysqli_fetch_assoc($categories)): ?>
                            <tr>
                                <td><?= $category["id"] ?></td>
                                <td><?= htmlspecialchars($category["name"]) ?></td>
                                <td><?= $category["created_at"] ?></td>
                                <td>
                                    <a href="edit.php?id=<?= $category["id"] ?>" class="btn btn-sm btn-warning">Sửa</a>
                                    <a href="delete.php?id=<?= $category["id"] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Xóa danh mục này?')">Xóa</a>
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