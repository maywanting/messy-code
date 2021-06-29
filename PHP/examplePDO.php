<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING);
ini_set('display_errors', 'on');
require_once 'myPDO.php';

$testSql = new myPDO('127.0.0.1', 'server', 'z', 'EDMAnalysis');

$result = $testSql->sql('select * from project')->getResult();
var_dump($result);

$params = [
    ':view1' => [0, 1],
    ':id' => [1, 1]
];

$testSql->sql('update project set `view1`=:view1 where `id`=:id')->params($params)->run();

$result = $testSql->sql('select * from project')->getResult();
var_dump($result);
exit();

echo "wait 5 second\n";
sleep(5);

//失联重联获取数据
$result = $testSql->getReslt();
var_dump($result);

echo "wait 5 second\n";
sleep(5);

//失联重联插入数据
$testSql->prepare('insert into may values("lalala")')->run();


$result = $testSql->prepare('select * from may')->getReslt();
var_dump($result);

$testSql->close();
