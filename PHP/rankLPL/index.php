<?php
$url = 'https://m.weibo.cn/api/container/getIndex?containerid=231230_-_vote_-_index_-_92_-_93';

$rng = 0;
$ig = 0;
$rngMore = 0;
$igMore = 0;
while (true) {
    $result = json_decode(file_get_contents($url));

    $first = $result->data->cards[1]->card_group[0];
    $second = $result->data->cards[1]->card_group[1];

    echo $first->title_sub . ' ' . $first->desc2 . "\n";
    echo $second->title_sub . ' ' . $second->desc2 . "\n";

    preg_match("/^已获得(\d+)个奖杯$/", $first->desc2, $firstScore);
    preg_match("/^已获得(\d+)个奖杯$/", $second->desc2, $secondScore);
    if ($first->title_sub == 'RNG') {
        $nowRNG = $firstScore[1];
        $nowIG = $secondScore[1];
    } else {
        $nowRNG = $secondScore[1];
        $nowIG = $firstScore[1];
    }
    echo 'RNG:' . ($nowRNG - $rng) . "\n";
    echo 'IG: ' . ($nowIG - $ig) . "\n";

    if (($nowRNG-$rng) > ($nowIG - $ig)) {
        $rngMore++;
    } elseif (($nowRNG-$rng) < ($nowIG - $ig)) {
        $igMore++;
    }
    echo 'RNG:' . $rngMore . ' IG:' . $igMore . "\n";
    echo "=================\n";
    $rng = $nowRNG;
    $ig = $nowIG;
    $second = rand(5, 10);
    sleep($second);
}
