<?php

require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../includes/functions.php";
require_once __DIR__ . "/includes/auth.php";

include "includes/header.php";
include "includes/sidebar.php";

$totalProducts = countProducts($conn);
$totalOrders = countOrders($conn);
$revenue = totalRevenue($conn);

?>

<div class="main-content">
    <div class="container-fluid py-4">
        <h2 class="mb-4">Dashboard</h2>
        <div class="row g-4">
            <div class="row g-4">

    <div class="col-lg-4">
        <div class="card dashboard-card border-0">
            <div class="card-body d-flex justify-content-between align-items-center">

                <div>
                    <small class="text-muted">Tổng sản phẩm</small>
                    <h2><?= $totalProducts ?></h2>
                </div>

                <div class="dashboard-icon bg-primary">
                    <i class="bi bi-laptop"></i>
                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card dashboard-card border-0">

            <div class="card-body d-flex justify-content-between align-items-center">

                <div>

                    <small class="text-muted">Đơn hàng</small>

                    <h2><?= $totalOrders ?></h2>

                </div>

                <div class="dashboard-icon bg-success">

                    <i class="bi bi-cart3"></i>

                </div>

            </div>

        </div>
    </div>

    <div class="col-lg-4">

        <div class="card dashboard-card border-0">

            <div class="card-body d-flex justify-content-between align-items-center">

                <div>

                    <small class="text-muted">

                        Doanh thu

                    </small>

                    <h2 class="text-success">

                        <?= formatPrice($revenue) ?>

                    </h2>

                </div>

                <div class="dashboard-icon bg-warning">

                    <i class="bi bi-cash-stack"></i>

                </div>

            </div>

        </div>

    </div>

</div>
        </div>

        <div class="card shadow-sm border-0 mt-4">
            <div class="card-body">
                <h5 class="mb-3">Chào mừng bạn đến với hệ thống quản trị Laptop Store</h5>
                <p class="mb-0">Bạn có thể quản lý danh mục, sản phẩm, đơn hàng và xem thống kê từ đây.</p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">

    <div class="col-lg-8">

        <div class="card chart-card">

            <div class="card-body">

                <h5>Doanh thu 7 ngày gần đây</h5>

                <canvas id="revenueChart"></canvas>

            </div>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="card chart-card">

            <div class="card-body">

                <h5>Đơn hàng</h5>

                <canvas id="orderChart"></canvas>

            </div>

        </div>

    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="../assets/js/dashboard.js"></script>
<?php include "includes/footer.php"; ?>