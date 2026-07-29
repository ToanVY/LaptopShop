<?php

include "config/database.php";
include "includes/functions.php";

$id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;

$product = getProductById($conn, $id);

if (!$product) {

    die("Sản phẩm không tồn tại.");

}

$relatedProducts = getRelatedProducts(
    $conn,
    $product["category_id"],
    $product["id"]
);

include "includes/header.php";
include "includes/navbar.php";

?>

<section class="bg-warning py-5">

    <div class="container">

        <h1>

            Chi tiết sản phẩm

        </h1>

    </div>

</section>
<section class="container my-5">

<div class="row">

<div class="col-lg-5">

<img

src="<?= getImageUrl($product["image"]) ?>"

class="img-fluid rounded shadow">

</div>

<div class="col-lg-7">

<?php if($product["badge"]!=""){ ?>

<span class="badge bg-<?= $product["badgeColor"] ?>">

<?= $product["badge"] ?>

</span>

<?php } ?>

<h2 class="mt-3">

<?= $product["name"] ?>

</h2>

<h3 class="text-danger">

<?= formatPrice($product["price"]) ?>

</h3>

<p class="text-muted">

Danh mục:

<strong>

<?= $product["category_name"] ?>

</strong>

</p>

<table class="table table-bordered mt-4">

<tr>

<th width="180">

CPU

</th>

<td>

<?= $product["cpu"] ?>

</td>

</tr>

<tr>

<th>

RAM

</th>

<td>

<?= $product["ram"] ?>

</td>

</tr>

<tr>

<th>

SSD

</th>

<td>

<?= $product["ssd"] ?>

</td>

</tr>

<tr>

<th>

GPU

</th>

<td>

<?= $product["gpu"] ?>

</td>

</tr>

<tr>

<th>

Màn hình

</th>

<td>

<?= $product["screen"] ?>

</td>

</tr>

</table>

<div class="mt-4">

<a

href="cart.php?action=add&id=<?= $product["id"] ?>"

class="btn btn-success btn-lg">

<i class="bi bi-cart-plus"></i>

Thêm vào giỏ

</a>

<a

href="cart.php?action=add&id=<?= $product["id"] ?>"

class="btn btn-danger btn-lg">

Mua ngay

</a>

</div>

</div>

</div>

</section>
<section class="container mb-5">

<div class="card">

<div class="card-header bg-primary text-white">

Mô tả sản phẩm

</div>

<div class="card-body">

<?= nl2br($product["description"]) ?>

</div>

</div>

</section>
<section class="container mb-5">

<h3 class="mb-4">

Sản phẩm liên quan

</h3>

<div class="row">

<?php

while($item = mysqli_fetch_assoc($relatedProducts)){

?>

<div class="col-lg-3 col-md-6 mb-4">

<div class="card h-100 shadow-sm">

<img

src="<?= getImageUrl($item["image"]) ?>"

class="card-img-top"

style="height:200px;object-fit:contain;padding:20px;">

<div class="card-body">

<h5>

<?= $item["name"] ?>

</h5>

<p>

<?= $item["cpu"] ?>

</p>

<h4 class="text-danger">

<?= formatPrice($item["price"]) ?>

</h4>

</div>

<div class="card-footer bg-white">

<a

href="detail.php?id=<?= $item["id"] ?>"

class="btn btn-primary w-100">

Xem chi tiết

</a>

</div>

</div>

</div>

<?php

}

?>

</div>

</section>
<?php

include "includes/footer.php";

?>