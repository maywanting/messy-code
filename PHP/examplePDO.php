<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING);
ini_set('display_errors', 'off');
require_once 'myPDO.php';

$testSql = new myPDO('127.0.0.1', 'root', '10jqka', 'test');

$result = $testSql->prepare('select * from may')->getReslt();
var_dump($result);

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
