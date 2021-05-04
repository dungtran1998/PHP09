<?php
$url = 'data/tygiavang.xml';
$xml = simplexml_load_file($url);
$jsonData = json_encode($xml->ratelist->city);
$result = json_decode($jsonData, true);
$result = array_column($result['item'], '@attributes');
$xhtml = '';

foreach ($result as $item) {
    $xhtml .= '
        <tr>
            <td>' . $item['type'] . '</td>
            <td>' . $item['buy'] . '</td>
            <td>' . $item['sell'] . '</td>
        </tr>
    ';
}

?>

<table class="table table-sm">
    <thead>
        <tr>
            <th><b>Loại vàng</b></th>
            <th><b>Mua vào</b></th>
            <th><b>Bán ra</b></th>
        </tr>
    </thead>
    <tbody>
        <?= $xhtml; ?>
    </tbody>
</table>