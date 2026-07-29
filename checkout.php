
<?php

session_start();

include "config/database.php";
include "includes/functions.php";

if (empty($_SESSION["cart"])) {
    header("Location: " . BASE_URL . "/products.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = mysqli_real_escape_string($conn, trim($_POST["fullname"] ?? ""));
    $phone = mysqli_real_escape_string($conn, trim($_POST["phone"] ?? ""));
    $address = mysqli_real_escape_string($conn, trim($_POST["address"] ?? ""));
    $note = mysqli_real_escape_string($conn, trim($_POST["note"] ?? ""));

    $total = 0;
    foreach ($_SESSION["cart"] as $id => $qty) {
        $product = getProductById($conn, $id);
        if ($product) {
            $total += $product["price"] * $qty;
        }
    }

    $sql = "INSERT INTO orders (customer_name, phone, address, note, total_amount, order_status, created_at)
            VALUES ('$fullname', '$phone', '$address', '$note', $total, 'Đang xử lý', NOW())";

    mysqli_query($conn, $sql);
    $orderId = mysqli_insert_id($conn);

    foreach ($_SESSION["cart"] as $id => $qty) {
        $product = getProductById($conn, $id);
        if (!$product) {
            continue;
        }

        $price = (int)$product["price"];
        $detailSql = "INSERT INTO order_details (order_id, product_id, price, quantity) VALUES ($orderId, $id, $price, $qty)";
        mysqli_query($conn, $detailSql);
        mysqli_query($conn, "UPDATE products SET stock = GREATEST(stock - $qty, 0) WHERE id = $id");
    }

    unset($_SESSION["cart"]);
    header("Location: " . BASE_URL . "/order-success.php?order_id=$orderId");
    exit;
}

include "includes/header.php";
include "includes/navbar.php";

?>
<section class="container py-5">
    <h2 class="mb-4">Thanh toán</h2>

    <form action="<?= BASE_URL ?>/checkout.php" method="POST">
        <div class="row">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header">Thông tin khách hàng</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label>Họ tên</label>
                            <input type="text" name="fullname" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Số điện thoại</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Địa chỉ</label>
                            <textarea name="address" class="form-control" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Ghi chú</label>
                            <textarea name="note" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header">Đơn hàng</div>
                    <div class="card-body">
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
                            <div class="d-flex justify-content-between mb-2">
                                <span><?= $product["name"] ?> x<?= $qty ?></span>
                                <span><?= formatPrice($sub) ?></span>
                            </div>
                        <?php } ?>
                        <hr>
                        <h4 class="text-danger"><?= formatPrice($total) ?></h4>
                        <button class="btn btn-success w-100" type="submit">Đặt hàng</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>

<?php include "includes/footer.php"; ?>
