<?php

include "config/database.php";
include "includes/functions.php";

$keyword=$_GET["keyword"]??"";
$category=$_GET["category"]??0;
$price=$_GET["price"]??"";
$sort=$_GET["sort"]??"";

$categories=getCategories($conn);

$products=getProducts(
    $conn,
    $keyword,
    $category,
    $price,
    $sort
);

include "includes/header.php";
include "includes/navbar.php";

?>

<section class="py-5 bg-warning">

<div class="container">

<h1 class="fw-bold">

Danh sách Laptop

</h1>

<p>

Tìm kiếm chiếc laptop phù hợp với bạn.

</p>

</div>

</section>
<section class="container mt-5">

<form class="filter-form" method="GET">

<div class="row g-3">

<div class="col-lg-3">

<input

type="text"

name="keyword"

class="form-control"

placeholder="Tên laptop..."

value="<?= $keyword ?>">

</div>

<div class="col-lg-3">

<select

name="category"

class="form-select">

<option value="0">

Tất cả danh mục

</option>

<?php

while($item=mysqli_fetch_assoc($categories)){

?>

<option

value="<?= $item["id"] ?>"

<?= $category==$item["id"]?"selected":"" ?>>

<?= $item["name"] ?>

</option>

<?php } ?>

</select>

</div>

<div class="col-lg-2">

<select

name="price"

class="form-select">

<option value="">Mức giá</option>

<option value="1">Dưới 15 triệu</option>

<option value="2">15-25 triệu</option>

<option value="3">25-35 triệu</option>

<option value="4">Trên 35 triệu</option>

</select>

</div>

<div class="col-lg-2">

<select

name="sort"

class="form-select">

<option value="">

Sắp xếp

</option>

<option value="asc">

Giá tăng

</option>

<option value="desc">

Giá giảm

</option>

</select>

</div>

<div class="col-lg-2 d-grid">

<button

class="btn btn-primary">

Tìm kiếm

</button>

</div>

</div>

</form>

</section>
<section class="container py-5">

<div class="row">

<?php

while($product=mysqli_fetch_assoc($products)){

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

<ul class="list-unstyled">

<li><?= $product["ram"] ?></li>

<li><?= $product["ssd"] ?></li>

<li><?= $product["gpu"] ?></li>

</ul>

<h4 class="text-danger">

<?= formatPrice($product["price"]) ?>

</h4>

</div>

<div class="card-footer bg-white">

<div class="d-grid gap-2">

<a

href="detail.php?id=<?= $product["id"] ?>"

class="btn btn-primary">

Chi tiết

</a>

<a

href="cart.php?action=add&id=<?= $product["id"] ?>"

class="btn btn-success">

<i class="bi bi-cart-plus"></i>

Thêm giỏ

</a>

</div>

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