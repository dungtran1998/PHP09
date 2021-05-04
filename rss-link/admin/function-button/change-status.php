<?php
require_once '../lib/Database.class.php';
$params        = array(
    'server'     => 'localhost',
    'username'    => 'root',
    'password'    => '',
    'database'    => 'manage_rss',
    'table'        => 'rss',
);

$database = new Database($params);


$id = $_GET['id'] ?? "";
$status = $_GET['status'] ?? "";
if (!empty($_GET)) {
    $status = $status == 1 ? "0" : "1";
    $arrayUpdate = ["status" => $status];
    $arrayWhere = [
        ["id", $id, null]
    ];
    $result = $database->update($arrayUpdate, $arrayWhere);

    $query = "SELECT * FROM `rss` WHERE `id` = '$id'";
    $data = $database->singleRecord($query);

    $link = $data['link'];
    $class = ($data['status'] == 1) ? "btn-success" : "btn-danger";
    $icon = ($data['status'] == 1) ? "fa-check" : "fa-minus";

    $data['statusHTML'] = '
        <a  href="javascript:changeStatus(\'/PHP09/b11/admin/function-button/change-status.php?id=' . $data['id'] . '&status=' . $data['status'] . '\')" class="btn btn-sm ' . $class . '">
            <i class="fas ' . $icon . '"></i>
        </a>
    ';
    echo json_encode($data);
};
