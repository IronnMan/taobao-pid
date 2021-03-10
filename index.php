<?php

$createPidUrl = 'https://pub.alimama.com/openapi/param2/1/gateway.unionpub/record.adzone.create.json';
$t = '1615299613039';
$tb_token = 'f573b3ee70333';
// 淘宝联盟登录状态 cookie
$cookie = "t=b74b3de78374256fa62089b2e52fedc8; cna=phbmFuGwtAcCAd9J6+4UcdtS; account-path-guide-s1=true; 1538510119-payment-time=true; cookie2=1afd936607a3209e3418bc777708689e; v=0; _tb_token_=f573b3ee70333; xlly_s=1; cookie32=628ab5199f566062024a54542ac312d3; cookie31=MTUzODUxMDExOSx0XzE1MDUzOTcwMDI2MThfMDQ2NCx3ZW5saW40MkBpY2xvdWQuY29tLFRC; JSESSIONID=2E73D4D481D38340FCAAD9A962082598; alimamapwag=TW96aWxsYS81LjAgKExpbnV4OyBBbmRyb2lkIDYuMDsgTmV4dXMgNSBCdWlsZC9NUkE1OE4pIEFwcGxlV2ViS2l0LzUzNy4zNiAoS0hUTUwsIGxpa2UgR2Vja28pIENocm9tZS84OC4wLjQzMjQuMTkyIE1vYmlsZSBTYWZhcmkvNTM3LjM2; alimamapw=Qj0DBlYDUFtUVgNTU1cPaQBRAFY7A1NSV1QCUQRRB1MADwIGUFJRAFEFUABSUQIHUVdTU1I%3D; x5sec=7b2268616c6c65792d736f6c61723b32223a223037326131613433343736323266646130396438323834323039613463656234434a36596e6f4947454e4f316964697932726161626a436e6e647a7642513d3d227d; login=Vq8l%2BKCLz3%2F65A%3D%3D; tfstk=cLGcBQfPRusQLUyodINjlJMu3IZGazfgD43iafVJjv0tqFc0us2AU9RLhCZDrQX1.; l=eBjgK22POfAID7-XBO5wlurza77ONCAjlsPzaNbMiInca6icCnYMFNCQZCaBAdtjwt5YCH-r7HlrTRek5XaU5xizzowFQB_MUBp6zU5..; isg=BAgI8QqY_Gxw9S9pm_uQg7RB2XAasWy7CcG10sK9eQNvnbIHecMUSnXbEXPtrSST";


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
        "recordId" => '2178600493',
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