<?php

require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../includes/functions.php";
require_once __DIR__ . "/../includes/auth.php";

$categoryCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM categories"));
$productCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM products"));
$orderCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM orders"));
$revenue = totalRevenue($conn);

include "../includes/header.php";
include "../includes/sidebar.php";

?>

<div class="main-content">
    <div class="container-fluid py-4">
        <h2 class="mb-4">Thống kê</h2>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Danh mục</h6>
                        <h3 class="fw-bold"><?= $categoryCount["total"] ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Sản phẩm</h6>
                        <h3 class="fw-bold"><?= $productCount["total"] ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Đơn hàng</h6>
                        <h3 class="fw-bold"><?= $orderCount["total"] ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Doanh thu</h6>
                        <h3 class="fw-bold text-success"><?= formatPrice($revenue) ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">

    <div class="col-lg-6">

        <div class="card chart-card">

            <div class="card-body">

                <h5>Doanh thu theo tháng</h5>

                <canvas id="monthChart"></canvas>

            </div>

        </div>

    </div>

    <div class="col-lg-6">

        <div class="card chart-card">

            <div class="card-body">

                <h5>Top sản phẩm</h5>

                <canvas id="productChart"></canvas>

            </div>

        </div>

    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="../../assets/js/dashboard.js"></script>
<?php include "../includes/footer.php"; ?>