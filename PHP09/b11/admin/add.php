<?php
require_once "lib/connect.php";
require_once "lib/Validate.class.php";
if (isset($_POST['token'])) {
    $source = $_POST;
    $validate  = new Validate($source);
    $validate->addRule("link", "url")
        ->addRule("status", "status")
        ->addRule("ordering", "int", 0, 100);
    $validate->run();
    $error = $validate->showErrors();
    if (empty($validate->getError())) {
        $arrayInsert = ['link' => $source['link'], 'status' => $source['status'], 'ordering' => $source['ordering']];
        $queryID = $database->insert($arrayInsert, 'single');
        header("Location:/PHP09/b11/admin/list.php");
    };
};
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
        <?php echo $error ?? "" ?>
        <form action="" method="post">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="m-0">ADD RSS</h4>
                </div>
                <div class="card-body">

                    <div class="form-group">
                        <label class="font-weight-bold">Link</label>
                        <input class="form-control" type="text" name="link" value="<?php $source['link'] ?? "" ?>">
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Status</label>
                        <select class="custom-select" name="status">
                            <option value="default">Select status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Ordering</label>
                        <input class="form-control" type="number" min="0" name="ordering" value="<?php $source['ordering'] ?? "" ?>">
                    </div>
                </div>
                <div class="card-footer">
                    <input class="form-control" type="hidden" name="token" value="1611025715"> <button type="submit" class="btn btn-success">Save</button>
                    <a href="list.php" class="btn btn-danger">Cancel</a>
                </div>
            </div>
        </form>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/mdb.min.js"></script>
</body>

</html>