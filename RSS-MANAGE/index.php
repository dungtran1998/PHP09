<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>
    <?php require_once 'html/head.php' ?>
</head>

<body class="stretched overlay-menu">

    <div id="wrapper" class="clearfix bg-light">
        <?php require_once 'html/header.php' ?>
        <div class="container-fluid">
            <div class="row">
                <!-- Content -->
                <section id="content" class="bg-light">
                    <div class="content-wrap pt-lg-0 pt-xl-0 pb-0">
                        <div class="container-fluid clearfix">
                            <div class="heading-block border-bottom-0 center pt-4 mb-3">
                                <h3 id="my-title">Tin tức</h3>
                            </div>
                            <!-- Posts -->
                            <?php require_once 'news.php' ?>
                        </div>

                    </div>
                </section> <!-- #content end -->

                <section class="right-side mb-4">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="box mt-4">
                                    <h3 class="mb-1">Giá vàng</h3>
                                    <div class="card card-body" id="box-gold">
                                        <?php require_once 'box-gold.php' ?>
                                        <div class="text-center">
                                            <div class="spinner-border" style="width: 3rem; height: 3rem;"
                                                role="status">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box mt-4">
                                    <h3 class="mb-1">Giá coin</h3>
                                    <div class="card card-body" id="box-coin">
                                        <?php require_once 'box-coin.php' ?>
                                        <div class="text-center">
                                            <div class="spinner-border" style="width: 3rem; height: 3rem;"
                                                role="status">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <?php require_once 'html/footer.php' ?>
    </div>

    <!-- Go To Top
	============================================= -->
    <div id="gotoTop" class="icon-angle-up rounded-circle"></div>

    <?php require_once 'html/script.php' ?>
</body>

</html>