<?php
error_reporting(E_ALL & ~E_NOTICE);
require_once "lib/connect.php";
require_once "lib/Helper.php";
session_start();
if ($_SESSION['flagPermission'] !== true) {
    session_unset();
    header("Location:../login.php");
} else {
    if ($_SESSION['timeout'] + 3600 < time()) {
        session_unset();
        header("Location:../login.php");
    };
};
$xhtml = '';

$filter_search =  $_GET['search'] ?? "";
$query = 'SELECT * FROM `rss` ';

if (!empty($filter_search)) {
    $query .= "WHERE `link` LIKE '%$filter_search%'";
};
$result = $database->listRecord($query);

foreach ($result as $key => $item) {
    $id = $item['id'];
    $result  = preg_replace("/" . preg_quote($filter_search, "/") . "/i", "<mark>$0</mark>", $item['link']);

    $link = (!empty($filter_search)) ? $result : $item['link'];
    $ordering = $item['ordering'];
    $showStatus = Helper::showStatus($item['status'], $id);
    $xhtml .= '
    <tr>
        <td>' . $id . '</td>
        <td>' . $link . '</td>
        <td id = "status-' . $id . '">
        ' . $showStatus . '
        </td>
        <td>' . $ordering . '</td>
        <td>
            <a href="form.php?id=' . $id . '" class="btn btn-sm btn-warning">Edit</a>
            <a href="delete.php?id=' . $id . '" class="btn btn-sm btn-danger btn-delete">Delete</a>
        </td>
    </tr>
    ';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/mdb.min.css">
    <link rel="stylesheet" href="css/my-style.css">
</head>

<body style="background-color: #eee;">
    <div class="container pt-5">
        <div class="card mb-4">
            <div class="card-body d-flex justify-content-between">
                <a href="../index.php" class="btn btn-primary m-0">Back to website</a>
                <a href="../logout.php" class="btn btn-info m-0">Logout</a>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <form action="" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="search" placeholder="Enter search keyword...." value="<?= $filter_search ?>">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-md btn-outline-primary m-0 px-3 py-2 z-depth-0 waves-effect" type="button">Search</button>
                            <a href="list.php" class="btn btn-md btn-outline-danger m-0 px-3 py-2 z-depth-0 waves-effect" type="button">Clear</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="m-0">RSS List</h4>
                <a href="add.php" class="btn btn-success m-0">Add</a>
            </div>
            <div class="card-body">
                <table class="table table-striped btn-table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Link</th>
                            <th scope="col">Status</th>
                            <th scope="col">Ordering</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $xhtml ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php require_once "html/script.php" ?>
</body>

</html>