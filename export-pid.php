<?php


header("Content-type:text/html;charset=utf-8");

$getPidUrl = 'https://pub.alimama.com/openapi/param2/1/gateway.unionpub/record.adzone.listQuery.json?';
$t = time();
$tb_token = '';
// 淘宝联盟登录状态 cookie
$cookie = "";

$pids = array();
$pageNo = 1;
$pageSize = 100;
$hasNext = false;

do {
    $data = array(
        "t" => $t,
        "_tb_token_" => $tb_token,
        "queryKey" => '',
        "pageNo" => $pageNo,
        "pageSize" => $pageSize,
        "siteSceneCode" => '',
        "siteId" => ''
    );

    $url = $getPidUrl . urlStrArray($data);

    echo $url;
    $result = geturl($url, $cookie);

    echo json_encode($result);
    

    if (!empty($result['resultCode']) && $result['resultCode'] == 200) {
        
        var_dump($result['data']['result']);


        foreach($result['data']['result'] as $item) {

            array_push($pids, array($item['adzoneName'], $item['pid']));
            
        }

    }

    $hasNext = $result['data']['hasNext'] ?? false;

    echo PHP_EOL;
    echo '是否有下一页' . var_dump($hasNext) . ', 页数：' . $pageNo;
    echo PHP_EOL;

    $pageNo++;

    sleep(5);
} while ($hasNext !== false);

var_dump($pids);

$config = [
    'path' => __DIR__
];


$excel = new \Vtiful\Kernel\Excel($config);


$filePath = $excel->fileName('TaobaoPid.xlsx')
    ->header(['广告位', 'pid'])
    ->data($pids)
    ->output();

function geturl($url, $cookie){
    echo PHP_EOL;

    $headerArray =array(
        "Content-type:application/x-www-form-urlencoded; charset=UTF-8",
        "Accept:*/*",
        "Accept-Encoding:gzip, deflate, br",
        "Cookie:$cookie"
    );
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_COOKIE, $cookie);
    // curl_setopt($ch, CURLOPT_HTTPHEADER,$headerArray);

    $output = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo $output;
    }

    echo PHP_EOL;

    $output = json_decode($output,true);
    return $output;
}

function urlStrArray($arr)
{
    $ret = "";
    $strArray = array();
    reset($arr);

    foreach ($arr as $k => $v) {
        $tmp = "$k=" . "$v";
        array_push($strArray, $tmp);
    }

    $ret = implode("&", $strArray);
    return $ret;
}