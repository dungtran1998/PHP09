<?php
error_reporting(E_ALL & ~E_NOTICE);
require_once "lib/functions.php";
require_once "lib/Database.class.php";
$formHTML = '
            <form id="login-form" name="login-form" class="mb-0" action="" method="post">
                <h3 class="text-center">Đăng nhập trang quản trị</h3>
                <div class="row">
                    <div class="col-12 form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" value="" class="form-control not-dark" required />
                    </div>

                    <div class="col-12 form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" value="" class="form-control not-dark" required />
                        <input type="hidden" name="token" value="' . time() . '" />
                    </div>

                    <div class="col-12 form-group">
                        <button type="submit" class="button button-3d button-black m-0">Đăng
                            nhập</button>
                        <a href="index.php" class="button button-3d m-0">Quay về</a>
                    </div>
                </div>
            </form>
            ';

session_start();
if ($_SESSION['flagPermission'] == true) {
    if ($_SESSION['timeout'] + 3600 > time()) {
        $formHTML = '<h3>Xin chào: ' . $_SESSION['userInfo']['username'] . '</h3>';
        $formHTML .= ' 
        <div class="row">
            <div class="col-12 form-group">
                <button type="submit" class="button button-3d button-black m-0">Đăng
                    nhập</button>
                <a href="index.php" class="button button-3d ">Trang chủ</a>
                <a href="admin/list.php" class="button button-3d ">Admin</a>
                <a href="logout.php" class="button button-3d ">Đăng xuất</a>
            </div>
        </div>
        ';
    } else {
        session_unset();
        header("Location:login.php");
    }
} else {
    if (!checkEmpty($_POST['username']) && !checkEmpty($_POST['password'])) {
        $username     = $_POST['username'];
        $password     = md5($_POST['password']);
        require_once "lib/connect.php";
        $query[]     = "SELECT *";
        $query[]     = "FROM `user`";
        $query[]     = "WHERE `username` = '" . $username . "'";
        $query[]     = "AND `password` = '" . $password . "'";

        $query        = implode(" ", $query);
        $userInfo = $database->singleRecord($query);
        if (!empty($userInfo)) {
            $_SESSION['userInfo']         = $userInfo;
            $_SESSION['flagPermission'] = true;
            $_SESSION['timeout']         = time();
            header('location: login.php');
        } else {
            $error = '<h4 style="background-color:red; color:white">Wrong Input Password or Username</h4>';
        };
    };
}

?>


<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700&display=swap" rel="stylesheet" type="text/css" />
    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <link rel="stylesheet" href="css/dark.css" type="text/css" />

    <link rel="stylesheet" href="css/font-icons.css" type="text/css" />
    <link rel="stylesheet" href="css/et-line.css" type="text/css" />
    <link rel="stylesheet" href="css/animate.css" type="text/css" />
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css" />

    <!-- Modern Blog Demo Specific Stylesheet -->
    <link rel="stylesheet" href="css/modern-blog.css" type="text/css" />
    <link rel="stylesheet" href="css/fonts.css" type="text/css" />

    <link rel="stylesheet" href="css/custom.css" type="text/css" />
    <!-- Document Title -->
    <title>News | ZendVN</title>
</head>

<body class="stretched">

    <!-- Document Wrapper
	============================================= -->
    <div id="wrapper" class="clearfix">

        <!-- Content
		============================================= -->
        <section id="content" class="w-100">
            <div class="content-wrap py-0">

                <div class="section p-0 m-0 h-100 position-absolute" style="background: url('images/login-bg.jpg') center center no-repeat; background-size: cover;">
                </div>

                <div class="section bg-transparent min-vh-100 p-0 m-0">
                    <div class="vertical-middle">
                        <div class="container-fluid py-5 mx-auto">
                            <div class="center">
                                <h2 class="text-white">ZendVN</h2>
                            </div>

                            <div class="card mx-auto rounded-0 border-0" style="max-width: 400px; background-color: rgba(255,255,255,0.93);">
                                <div class="card-body" style="padding: 40px;">

                                    <?= $error ?? '' ?>
                                    <?= $formHTML ?>
                                </div>
                            </div>

                            <div class="text-center dark mt-3"><small>Copyrights &copy; All Rights Reserved by ZendVN
                                    Inc.</small></div>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- #content end -->

    </div><!-- #wrapper end -->

    <script src="js/jquery.js"></script>
    <script src="js/plugins.min.js"></script>
    <script src="js/functions.js"></script>
</body>

</html>