<?php

require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../includes/auth.php";

$id = (int)($_GET["id"] ?? 0);
if ($id > 0) {
    mysqli_query($conn, "DELETE FROM products WHERE id = $id");
}

header("Location: index.php");
exit;
