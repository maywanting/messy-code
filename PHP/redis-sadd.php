<?php
/*
 * 批量添加
 */
$redis = new Redis();
$redis->connect('127.0.0.1', '6379');

$array = ['4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17'];
$redis->sadd('set_test', ...$array);
