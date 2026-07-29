<?php

// =====================================
// Định dạng tiền VNĐ
// =====================================

function formatPrice($price)
{

    return number_format($price, 0, ",", ".") . " ₫";

}

function getImageUrl($path)
{
    $path = trim((string)$path);

    if ($path === '') {
        return rtrim(BASE_URL, '/') . '/assets/images/laptops/placeholder.png';
    }

    if (preg_match('#^(https?:)?//#i', $path) || strpos($path, 'data:') === 0) {
        return $path;
    }

    $trimmed = ltrim($path, '/');
    $baseUrl = rtrim(BASE_URL, '/');
    $assetsPrefix = 'assets/images/laptops/';

    $possiblePaths = [
        $trimmed,
        $assetsPrefix . $trimmed,
    ];

    foreach ($possiblePaths as $candidate) {
        $localFile = $_SERVER['DOCUMENT_ROOT'] . '/' . $candidate;
        if (file_exists($localFile)) {
            return $baseUrl . '/' . $candidate;
        }
    }

    return $baseUrl . '/' . $trimmed;
}

// =====================================
// Lấy tất cả danh mục
// =====================================

function getCategories($conn)
{

    $sql = "SELECT * FROM categories
            ORDER BY id DESC";

    $result = mysqli_query($conn, $sql);

    return $result;

}

// =====================================
// Lấy tất cả sản phẩm
// =====================================
function getProducts(
    $conn,
    $keyword = "",
    $category = 0,
    $price = "",
    $sort = "",
    $limit = 8,
    $offset = 0
){

    $sql = "
        SELECT
            products.*,
            categories.name AS category_name
        FROM products
        INNER JOIN categories
        ON products.category_id = categories.id
        WHERE 1
    ";

    $types = "";
    $params = [];

    // Search
    if($keyword != ""){

        $sql .= " AND products.name LIKE ? ";

        $types .= "s";

        $params[] = "%$keyword%";

    }

    // Category
    if($category > 0){

        $sql .= " AND products.category_id=? ";

        $types .= "i";

        $params[] = $category;

    }

    // Price
    switch($price){

        case "1":
            $sql .= " AND price < ? ";
            $types.="i";
            $params[]=15000000;
            break;

        case "2":
            $sql .= " AND price BETWEEN ? AND ? ";
            $types.="ii";
            $params[]=15000000;
            $params[]=25000000;
            break;

        case "3":
            $sql .= " AND price BETWEEN ? AND ? ";
            $types.="ii";
            $params[]=25000000;
            $params[]=35000000;
            break;

        case "4":
            $sql .= " AND price > ? ";
            $types.="i";
            $params[]=35000000;
            break;

    }

    if($sort=="asc"){

        $sql.=" ORDER BY price ASC ";

    }
    elseif($sort=="desc"){

        $sql.=" ORDER BY price DESC ";

    }
    else{

        $sql.=" ORDER BY id DESC ";

    }

    $sql .= " LIMIT ? OFFSET ? ";

    $types.="ii";

    $params[]=$limit;
    $params[]=$offset;

    $stmt=mysqli_prepare($conn,$sql);

    mysqli_stmt_bind_param($stmt,$types,...$params);

    mysqli_stmt_execute($stmt);

    return mysqli_stmt_get_result($stmt);

}
// =====================================
// Lấy 1 sản phẩm
// =====================================
function getProductById($conn, $id)
{

    $id = (int)$id;

    $sql = "
        SELECT
            products.*,
            categories.name AS category_name
        FROM products
        INNER JOIN categories
        ON products.category_id = categories.id
        WHERE products.id = $id
    ";

    $result = mysqli_query($conn, $sql);

    return mysqli_fetch_assoc($result);

}

// =====================================
// Lấy sản phẩm theo danh mục
// =====================================

function getProductsByCategory($conn, $categoryId)
{

    $categoryId = (int)$categoryId;

    $sql = "SELECT *

            FROM products

            WHERE category_id = $categoryId";

    return mysqli_query($conn, $sql);

}

function getRelatedProducts($conn, $categoryId, $currentId)
{

    $categoryId = (int)$categoryId;
    $currentId = (int)$currentId;

    $sql = "
        SELECT *
        FROM products
        WHERE category_id = $categoryId
        AND id <> $currentId
        LIMIT 4
    ";

    return mysqli_query($conn, $sql);

}
// =====================================
// Tìm kiếm
// =====================================

function searchProducts($conn, $keyword)
{

    $keyword = mysqli_real_escape_string(
        $conn,
        $keyword
    );

    $sql = "SELECT *

            FROM products

            WHERE name LIKE '%$keyword%'";

    return mysqli_query($conn, $sql);

}

// =====================================
// Đếm số sản phẩm
// =====================================

function countProducts($conn)
{

    $sql = "SELECT COUNT(*) AS total

            FROM products";

    $result = mysqli_query($conn, $sql);

    return mysqli_fetch_assoc($result)['total'];

}

// =====================================
// Đếm đơn hàng
// =====================================

function countOrders($conn)
{

    $sql = "SELECT COUNT(*) AS total

            FROM orders";

    $result = mysqli_query($conn, $sql);

    return mysqli_fetch_assoc($result)['total'];

}

// =====================================
// Tổng doanh thu
// =====================================

function totalRevenue($conn)
{

    $sql = "SELECT SUM(total_amount) AS revenue

            FROM orders

            WHERE order_status IN ('Hoàn thành', 'Completed')";

    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);

    return $row['revenue'] ?? 0;

}

function countFilteredProducts(
    $conn,
    $keyword="",
    $category=0,
    $price=""
){

    $sql="SELECT COUNT(*) total
          FROM products
          WHERE 1";

    $types="";
    $params=[];

    if($keyword!=""){

        $sql.=" AND name LIKE ?";

        $types.="s";

        $params[]="%$keyword%";

    }

    if($category>0){

        $sql.=" AND category_id=?";

        $types.="i";

        $params[]=$category;

    }

    switch($price){

        case "1":

            $sql.=" AND price<?";

            $types.="i";

            $params[]=15000000;

            break;

        case "2":

            $sql.=" AND price BETWEEN ? AND ?";

            $types.="ii";

            $params[]=15000000;
            $params[]=25000000;

            break;

        case "3":

            $sql.=" AND price BETWEEN ? AND ?";

            $types.="ii";

            $params[]=25000000;
            $params[]=35000000;

            break;

        case "4":

            $sql.=" AND price>?";

            $types.="i";

            $params[]=35000000;

            break;

    }

    $stmt=mysqli_prepare($conn,$sql);

    if($types!=""){

        mysqli_stmt_bind_param($stmt,$types,...$params);

    }

    mysqli_stmt_execute($stmt);

    $result=mysqli_stmt_get_result($stmt);

    return mysqli_fetch_assoc($result)["total"];

}

?>