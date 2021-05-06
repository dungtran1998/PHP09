<?php
require_once 'lib/connect.php';
require_once 'lib/Database.class.php';


$id = $_GET['id'] ?? "";
if (!empty($_GET)) {
    $query = $database->delete([$id]);
    header("Location: /PHP09/b11/admin/list.php");
};
