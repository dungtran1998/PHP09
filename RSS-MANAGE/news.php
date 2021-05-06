<?php
require_once "admin/lib/Database.class.php";
require_once "admin/lib/connect.php";
$query = "SELECT * FROM `rss` WHERE `status` = '1' ORDER BY `ordering` ASC";
$resultData = $database->listRecord($query);
$data = [];
foreach ($resultData as $value) {
    $url = $value['link'];
    $xmlCdata = simplexml_load_file($url, "SimpleXMLElement", LIBXML_NOCDATA);
    $jsonData = json_encode($xmlCdata);
    $result = json_decode($jsonData, true)['channel']['item'];
    $data = array_merge($data,$result);
};
$xhtml = '';
foreach ($data as $key => $value) {
    if (preg_match_all('#.*src="(.*)".*br>(.*)<end>#imsU', $value['description'] . '<end>', $matches)) {
        $image = $matches[1][0] ;
        $description = $matches[2][0];
    } 
    else {
        $image = 'images/default.jpg';
        $description = $value['description'];
    };
    $xhtml .= '
    <div class="col-md-6 col-lg-4 p-3">
        <div class="entry mb-1 clearfix">
            <div class="entry-image mb-3">
                <a href="' . $value['link'] . '" data-lightbox="image" style="background: url(\'' . $image . '\') no-repeat center center; background-size: cover; width:291.5px ;height: 278px;"></a>
            </div>
            <div class="entry-title" style="height: 100px">
                <h3><a href="' . $value['link'] . '" target="_blank">' . $value['title'] . '</a>
                </h3>
            </div>
            <div class="entry-content" style="height: 120px ">
            ' . $description . '
            </div>
            <div class="entry-meta no-separator nohover">
                <ul class="justify-content-between mx-0">
                    <li><i class="icon-calendar2"></i> ' . date("d/m/Y H:i:s", strtotime($value['pubDate'])) . '</li>
                    <li>vnexpress.net/thoi-su</li>
                </ul>
            </div>
            <div class="entry-meta no-separator hover">
                <ul class="mx-0">
                    <li><a href="' . $value['link'] . '" target="_blank">Xem &rarr;</a></li>
                </ul>
            </div>
        </div>
    </div>
    ';
};
?>

<div class="row grid-container infinity-wrapper clearfix align-align-items-start">
    <!-- <div class="col-md-6 col-lg-4 p-3">
        <div class="entry mb-1 clearfix">
            <div class="entry-image mb-3">
                <a href="https://i1-thethao.vnecdn.net/2021/01/19/ibra-1611012987-1611012996-7334-1611013230.png?w=1200&h=0&q=100&dpr=1&fit=crop&s=Yg-XociucOw7q5BRQLTzDA" data-lightbox="image" style="background: url(images/items/1.jpg) no-repeat center center; background-size: cover; height: 278px;"></a>
            </div>
            <div class="entry-title">
                <h3><a href="https://vnexpress.net/ibrahimovic-danh-got-chuyen-bong-kieu-taekwondo-4223019.html" target="_blank">Ibrahimovic đánh gót chuyền bóng kiểu taekwondo</a>
                </h3>
            </div>
            <div class="entry-content">
                Tiền đạo 39 tuổi Zlatan Ibrahimovic gây sốt với cú đá xoay móc chuyền bóng
                tầm cao cho đồng đội ở trận đấu của Milan tại Serie A.
            </div>
            <div class="entry-meta no-separator nohover">
                <ul class="justify-content-between mx-0">
                    <li><i class="icon-calendar2"></i> 19/01/2021 08:24:15</li>
                    <li>vnexpress.net</li>
                </ul>
            </div>
            <div class="entry-meta no-separator hover">
                <ul class="mx-0">
                    <li><a href="https://vnexpress.net/ibrahimovic-danh-got-chuyen-bong-kieu-taekwondo-4223019.html" target="_blank">Xem &rarr;</a></li>
                </ul>
            </div>
        </div>
    </div> -->
    <?php
    echo $xhtml;
    ?>
</div>