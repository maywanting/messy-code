<?php
// $array = ['4355' => 9.9, '0052' => 2.2, 3245 => 10.23, '342' => -8.46, '324' => 0, '2345' => 12.345, '34' => null, '79' => -30.123, '755' => -19.12, '4543' => 8.12];
// var_dump($array);

var_dump(1 > null);
var_dump(-1 > null);
var_dump(0 > null);
var_dump(1 < null);
var_dump(-1 < null);
var_dump(0 < null);
var_dump(1 == null);
var_dump(-1 == null);
var_dump(0 == null);


$array = json_decode(file_get_contents('temparray.json'), true);
$array = array(
        '601328' => 6.11,
        '600016' => 6.34,
        '603323' => 22.96,
        '002142' => 7.67,
        '601818' => 5.6,
        '002839' => null,
        '601939' => 5.26,
        '600908' => 21.7,
        '601398' => 5.29,
        '002807' => 28.11,
        '000001' => 6.26,
        '600000' => 6.46,
        '601009' => 7.75,
        '601288' => 4.9,
        '601229' => 9.61,
        '601997' => 10.08,
        '601998' => 6.81,
        '600036' => 6.38,
        '601169' => 7.44,
        '601988' => 5.63,
        '600926' => 12.25,
        '600015' => 5.95,
        '600919' => 10.07,
        '601166' => 5.24,
        '601128' => 22.3,
        '455543' => 0,
        '689555' => -432.2,
        '447892' => -9.5,
    );

print_r($array);
arsort($array);
var_dump($array);