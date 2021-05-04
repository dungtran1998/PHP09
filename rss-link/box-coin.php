<?php
$url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
$parameters = [
    'start' => '1',
    'limit' => '5',
    'convert' => 'USD'
];

$headers = [
    'Accepts: application/json',
    'X-CMC_PRO_API_KEY: 8a912f07-558e-4613-bd1c-e51014491de4'
];
$qs = http_build_query($parameters); // query string encode the parameters
$request = "{$url}?{$qs}"; // create the request URL


$curl = curl_init(); // Get cURL resource
// Set cURL options
curl_setopt_array($curl, array(
    CURLOPT_URL => $request,            // set the request URL
    CURLOPT_HTTPHEADER => $headers,     // set the headers 
    CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
));

$response = curl_exec($curl); // Send the request, save the response
$response = json_encode($response);
$response = json_decode($response, true);
$response = json_decode($response, true);

// echo '<pre>';
// print_r($response);    // print json decoded response
// echo '</pre>';

curl_close($curl); // Close request

$data = $response['data'];
$xhtml = '';
foreach ($data as $value) {
    $percent =round($value['quote']['USD']['percent_change_24h'],4) ;
    $class = $percent > 0 ? 'danger':'success';
    $xhtml .= '
    <tr>
        <td>'.$value['name'].'</td>
        <td>'.round($value['quote']['USD']['price'],1).'</td>
        <td><span class="text-'.$class.'">'.$percent.'%</span></td>
    </tr>
    ';
}

?>


<table class="table table-sm">
    <thead>
        <tr>
            <th><b>Name</b></th>
            <th><b>Price (USD)</b></th>
            <th><b>Change (24h)</b></th>
        </tr>
    </thead>
    <tbody>

        <!-- <tr>
            <td>Bitcoin</td>
            <td>$36,809.54</td>
            <td><span class="text-success">2.39%</span></td>
        </tr> -->
        <?php echo $xhtml;?>
    </tbody>
</table>