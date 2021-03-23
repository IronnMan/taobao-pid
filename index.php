<?php

$createPidUrl = 'https://pub.alimama.com/openapi/param2/1/gateway.unionpub/record.adzone.create.json';
$t = '';
$tb_token = '';
// 淘宝联盟登录状态 cookie
$cookie = "";


$num = 181;
do {
    echo PHP_EOL;
    echo '循环次数：' .$num;
    echo PHP_EOL;
    echo PHP_EOL;

    $data = array(
        "t" => $t,
        "_tb_token_" => $tb_token,
        "tag" => 29,
        "recordId" => '',
        "reqParams" => '{"adzoneName":"渠道'. $num .'"}',
        "sceneCode" => 'adzone_common'
    );

    $result = postUrl($createPidUrl, $data, $cookie);
    // 打印输出
    echo json_encode($result);

    $num ++;
    sleep(5);

} while ($num <= 195);


function postUrl($url, $data, $cookie) {
    $data = http_build_query($data);
    echo $data;
    echo PHP_EOL;

    $headerArray = array(
        "Content-type:application/x-www-form-urlencoded; charset=UTF-8",
        "Accept:*/*",
        "Accept-Encoding:gzip, deflate, br",
        "Cookie:$cookie"
    );
    
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headerArray);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo $output;
    }

    echo PHP_EOL;
    echo PHP_EOL;

    return json_decode($output, true);
}