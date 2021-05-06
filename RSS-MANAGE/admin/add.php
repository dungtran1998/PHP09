<?php
require_once "lib/connect.php";
require_once "lib/Validate.class.php";
require_once "lib/Helper.php";
$source = $_POST ?? '';
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
        // header("Location:/PHP09/b11/admin/list.php");
    } else {
        $infoError = $source;
    };
};
// input hidden
$inputHidden = Helper::createInput('token', 'hidden', time(), 'form-hidden');

// Link Row Form
$linkLabel = Helper::createLabel('font-weight-bold', 'Link');
$inputLink = Helper::createInput('link', 'text', $infoError['link'] ?? "", 'form-control');
$rowLink = Helper::createRowForm('form-group', $linkLabel, $inputLink);

// Status Row Form
$statusLabel = Helper::createLabel('font-weight-bold', 'Status');

$statusSelected = 'default';
if (!empty($infoError['status'])) {
    $statusSelected = ($infoError['status'] == 1) ? "Active" : "Inactive";
};
$arrayStatus = ["Select status" => "default", "Active" => 1, "Inactive" => 0];
$statusSelectBox = Helper::cmsSelectBox("custom-select", "status", $arrayStatus, $statusSelected ?? 'default');

$rowStatus = Helper::createRowForm('form-group', $statusLabel, $statusSelectBox);

//SelectBox Ordering
$orderingLabel = Helper::createLabel('font-weight-bold', 'Ordering');
$inputOrdering = Helper::createInput('ordering', 'number', $infoError['ordering'] ?? "", 'form-control', 'min="0"');
$rowOrdering = Helper::createRowForm('form-group', $orderingLabel, $inputOrdering);

$rowForm = $rowLink . $rowStatus . $rowOrdering.$inputHidden ;


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
        <div style="background-color: yellow;">
            <?php
            echo $error ?? "";
            ?>
        </div>
        <form action="" method="post" id="form-table">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="m-0">ADD RSS</h4>
                </div>
                <div class="card-body">
                    <?php echo $rowForm ?>
                </div>
                <div class="card-footer">

                    <button type="submit" class="btn btn-success btn-save">Save</button>
                    <a href="list.php" class="btn btn-danger btn-cancel">Cancel</a>
                </div>
            </div>
        </form>
    </div>

    <?php require_once "html/script.php" ?>
</body>

</html>