<?php
require '../../vendor/autoload.php';
use QL\QueryList;

$config = [
];

$urls = [];

for ($i=0; $i<1000; $i++) {
    $urls[] = 'http://www.77kp.com/vod-detail-id-'.rand(1, 9999).'.html';
}
$rules = [
    'title' => ['div.dwon_xl a','title'],
    'href' => ['div.dwon_xl a','href']
];

$ql = QueryList::rules($rules);
foreach($urls as $url){
    // 每条链接都会应用上面设置好的采集规则
    echo md5($url). "\n";
    $data = $ql->get($url)->query()->getData();
    file_put_contents('./data/data.txt', var_export($data->all(),true), 8);
// 释放Document内存占用
    $ql->destruct();
}
