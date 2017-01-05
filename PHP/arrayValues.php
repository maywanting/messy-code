<?php
$arr = ['name' => 'may', 'age' => 235, 'address' => 'suzhou'];

var_dump(array_values($arr));

$arr1 = ['name' => 'may', 'age' => 235, 'address' => 'suzhou', 'alise' => 'may'];
var_dump($arr1);
var_dump(array_values($arr));

$arr2 = [0 => 'may', 1 => 235, 2 => 'suzhou',3 => 'may'];
var_dump($arr2);
var_dump(array_values($arr2));

//array_values函数只会对有key的数组进行去重，对于没有key的数组则照常输出

$arr3 = [
    'aa' => [
        'name' => 'aaa',
        'age' => 32,
    ],
    'b' => [
        'name' => 'baa',
        'age' => 34,
    ],
];
var_dump($arr3);
var_dump(array_values($arr3));

//只对一维有效
//总结：鸡肋……
