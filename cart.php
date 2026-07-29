<?php

session_start();

include "config/database.php";
include "includes/functions.php";
include "includes/cart-function.php";

if (isset($_GET["action"])) {
    $action = $_GET["action"];
    $id = (int)($_GET["id"] ?? 0);

    switch ($action) {
        case "add":
            addCart($id);
            break;
        case "plus":
            increaseCart($id);
            break;
        case "minus":
            decreaseCart($id);
            break;
        case "remove":
            removeCart($id);
            break;
        case "clear":
            clearCart();
            break;
    }

    header("Location: " . BASE_URL . "/cart.php");
    exit;
}

include "includes/header.php";
include "includes/navbar.php";

?>
<section class="container py-5">
    <h2 class="mb-4">Giỏ hàng</h2>

    <?php if (empty($_SESSION["cart"])): ?>
        <div class="alert alert-info">
            Giỏ hàng hiện đang trống. Hãy chọn một chiếc laptop phù hợp để tiếp tục mua hàng.
        </div>
        <a href="<?= BASE_URL ?>/products.php" class="btn btn-primary">Tiếp tục mua sắm</a>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Ảnh</th>
                        <th>Tên</th>
                        <th>Giá</th>
                        <th>SL</th>
                        <th>Tổng</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    foreach ($_SESSION["cart"] as $id => $qty) {
                        $product = getProductById($conn, $id);
                        if (!$product) {
                            continue;
                        }
                        $sub = $qty * $product["price"];
                        $total += $sub;
                    ?>
                        <tr>
                            <td width="120">
                                <img src="<?= getImageUrl($product["image"]) ?>" class="img-fluid" style="max-height:80px;object-fit:contain;">
                            </td>
                            <td><?= $product["name"] ?></td>
                            <td><?= formatPrice($product["price"]) ?></td>
                            <td>
                                <a href="?action=minus&id=<?= $id ?>" class="btn btn-sm btn-secondary">-</a>
                                <strong class="mx-2"><?= $qty ?></strong>
                                <a href="?action=plus&id=<?= $id ?>" class="btn btn-sm btn-secondary">+</a>
                            </td>
                            <td><?= formatPrice($sub) ?></td>
                            <td>
                                <a href="?action=remove&id=<?= $id ?>" class="btn btn-danger">Xóa</a>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="4" class="text-end"><strong>Tổng tiền</strong></td>
                        <td colspan="2"><strong class="text-danger"><?= formatPrice($total) ?></strong></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between">
            <a href="?action=clear" class="btn btn-warning">Xóa giỏ hàng</a>
            <a href="<?= BASE_URL ?>/checkout.php" class="btn btn-success">Thanh toán</a>
        </div>
    <?php endif; ?>
</section>

<?php include "includes/footer.php"; ?>