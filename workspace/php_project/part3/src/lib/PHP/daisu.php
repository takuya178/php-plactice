<?php

// 当選率1%のくじを100回引いて当選する確率表示しよう
// ただし、引いたくじは戻すこととする。
// ※小数第2位で四捨五入する
// 活動記録をTweetする
  
// 期待する画面
// 63.4%

function arrayList(): array
{
    return range(1, 100);
}

// くじの中に当たりを入れる
function selectArray(array $index): array
{
    $list = [];

    foreach ($index as $key => $value) {
        if ($value === 1) {
            $value = '当たり！';
        }

        $list[$key] = $value;
    }
    // var_dump($list);
    return $list;
}

// 配列の中からランダムで取得して%表示する
function randSelect($select)
{
    $sum = 0;
    foreach ($select as $key) {
        $rand = array_rand($select);

        if ($rand === 1) {
            $sum += 1;
        }
    }
    var_dump($sum);
    return $sum;
}

$index = arrayList();
$select = selectArray($index);
randSelect($select);
