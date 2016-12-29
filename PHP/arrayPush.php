<?php
$array = [
    ['0', 'dasffg'],
    ['1', 'cvvfaf'],
    ['2', 'vbgfsb'],
    ['3', 'csdfgtb'],
    ['4', 'btre'],
];

$num = 1;
foreach($array as &$value) {
// foreach($array as $value) {
    if ($num == 1 && $value[0] == 1) {
        array_push($array, $value);
        var_dump($array);

        $num++;
    }

    if ($num == 2 && $value[0] == 3) {
        array_push($array, $value);
        var_dump($array);
        $num++;
    }

    echo $value[0] . "\n";
    sleep(1);
}

var_dump($array);
exit;

//some thing intersting
$a = array(1=>'one', 2=>'two');

foreach ($a as $key => &$val) {} // do nothing
var_dump($a);

foreach ($a as $key => $val) {} // do nothing
var_dump($a);
