<?php

include "config/database.php";
include "includes/functions.php";

$categories = getCategories($conn);
$products = getProducts($conn);

include "includes/header.php";
include "includes/navbar.php";

?>

<!-- ================= HERO ================= -->

<section class="bg-warning py-5">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-6">

                <h1 class="display-4 fw-bold">

                    Laptop Store

                </h1>

                <p class="lead">

                    Chuyên cung cấp Laptop chính hãng,
                    giá tốt, bảo hành uy tín.

                </p>

                <a href="products.php"
                   class="btn btn-dark btn-lg">

                    Mua ngay

                </a>

            </div>

            <div class="col-lg-6 text-center">

                <img
                    src="<?= BASE_URL ?>/assets/images/banners/banner1.jpg"
                    class="img-fluid"
                    style="max-height:350px;">

            </div>

        </div>

    </div>

</section>

<!-- ================= DANH MỤC ================= -->

<section class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>

            Danh mục sản phẩm

        </h2>

    </div>

    <div class="row">

        <?php

        while($category = mysqli_fetch_assoc($categories)){

        ?>

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card shadow-sm h-100">

                <div class="card-body text-center">

                    <i class="bi bi-laptop display-3 text-primary"></i>

                    <h5 class="mt-3">

                        <?= $category["name"] ?>

                    </h5>

                </div>

            </div>

        </div>

        <?php } ?>

    </div>

</section>

<!-- ================= LAPTOP MỚI ================= -->

<section class="container pb-5">

    <div class="d-flex justify-content-between mb-4">

        <h2>

            Laptop mới nhất

        </h2>

        <a
            href="products.php"
            class="btn btn-outline-primary">

            Xem tất cả

        </a>

    </div>

    <div class="row">

<?php

$count = 0;

while($product = mysqli_fetch_assoc($products)){

if($count==8) break;

$count++;

?>

<div class="col-lg-3 col-md-6 mb-4">

<div class="card h-100 shadow-sm">

<img

src="<?= getImageUrl($product["image"]) ?>"

class="card-img-top"

style="height:220px;object-fit:contain;padding:20px;">

<div class="card-body">

<h5>

<?= $product["name"] ?>

</h5>

<p class="text-muted">

<?= $product["cpu"] ?>

</p>

<h4 class="text-danger">

<?= formatPrice($product["price"]) ?>

</h4>

</div>

<div class="card-footer bg-white">

<div class="d-grid gap-2">

<a

href="detail.php?id=<?= $product["id"] ?>"

class="btn btn-primary">

Xem chi tiết

</a>

<a

href="cart.php?action=add&id=<?= $product["id"] ?>"

class="btn btn-outline-success">

<i class="bi bi-cart-plus"></i>

Thêm giỏ

</a>

</div>

</div>

</div>

</div>

<?php } ?>

</div>

</section>

<!-- ================= ƯU ĐIỂM ================= -->

<section class="bg-light py-5">

<div class="container">

<div class="row text-center">

<div class="col-lg-3">

<i class="bi bi-truck display-4 text-primary"></i>

<h5 class="mt-3">

Miễn phí vận chuyển

</h5>

</div>

<div class="col-lg-3">

<i class="bi bi-patch-check display-4 text-success"></i>

<h5 class="mt-3">

Chính hãng 100%

</h5>

</div>

<div class="col-lg-3">

<i class="bi bi-arrow-repeat display-4 text-warning"></i>

<h5 class="mt-3">

Đổi trả 7 ngày

</h5>

</div>

<div class="col-lg-3">

<i class="bi bi-headset display-4 text-danger"></i>

<h5 class="mt-3">

Hỗ trợ 24/7

</h5>

</div>

</div>

</div>

</section>

<?php

include "includes/footer.php";

?>