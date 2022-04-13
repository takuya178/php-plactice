<?php

// このレッスンのまとめです！

// やってみよう2の問題文と回答例を掲載しますね。

// ◯お題
// あなたは小さなパン屋を営んでいました。一日の終りに売上の集計作業を行います。
// 商品は10種類あり、それぞれ金額は以下の通りです（税抜）。

// ①100
// ②120
// ③150
// ④250
// ⑤80
// ⑥120
// ⑦100
// ⑧180
// ⑨50
// ⑩300

// 一日の売上の合計（税込み）と、販売個数の最も多い商品番号と販売個数の最も少ない商品番号を求めてください。

// ◯インプット
// 入力は以下の形式で与えられます。

// 販売した商品番号 販売個数 販売した商品番号 販売個数 ...

// ※ただし、販売した商品番号は1〜10の整数とする。

// ◯アウトプット

// 売上の合計
// 販売個数の最も多い商品番号
// 販売個数の最も少ない商品番号

// ※ただし、税率は10%とする。
// ※また、販売個数の最も多い商品と販売個数の最も少ない商品について、販売個数が同数の商品が存在する場合、それら全ての商品番号を記載すること。

// ◯インプット例
// 商品番号、販売個数
// 1 10 2 3 5 1 7 5 10 1

// ◯アウトプット例

// 2464
// 1
// 5 10

// ◯実行コマンド例
// php quiz.php 1 10 2 3 5 1 7 5 10 1


// 用件定義
// コマンドの値を配列で受け取る
// 配列を2つの組に分ける
// 商品毎の配列を作る
// [[1=>10], [2=>3]...]この配列を作る
// 売上の合計を求める
// 販売個数の最も多い商品番号を出力
// 販売個数の最も少ない商品番号を出力


const ITEM = [
    1 => 100,
    2 => 120,
    3 => 150,
    4 => 250,
    5 => 80,
    6 => 120,
    7 => 100,
    8 => 180,
    9 => 50,
    10 => 300,
];

function commandArray(): array {
    $command = array_slice($_SERVER['argv'], 1);
    return array_chunk($command,2);
}

// 配列を整える
function itemSoldArray($input): array {
    $itemSoldArrays = [];

    foreach ($input as $sold) {
        $number = $sold[0];
        $sold = $sold[1];
        $itemSoldArrays[$number] = $sold;
    }
    return $itemSoldArrays;
}

// 売上の合計金額
function totalItemPrice($itemSoldArrays) {
    $calculateTotalPrice = [];

    foreach ($itemSoldArrays as $number => $sold) {
        $calculateTotalPrice[] = ITEM[$number] * $sold;
    }
    return array_sum($calculateTotalPrice);
}

// 販売個数の最も多い商品
function maxSoldItem($itemSoldArrays) {
    $max = max(array_values($itemSoldArrays));
    return array_keys($itemSoldArrays, $max);
}

// 販売個数の最も少ない商品
function minSoldItem($itemSoldArrays): array {
    $min = min(array_values($itemSoldArrays));
    return array_keys($itemSoldArrays, $min);
}

// 画面表示
function display(array ...$results) {
    foreach ($results as $result) {
      echo implode(' ', $result). PHP_EOL;
    }
}

$input = commandArray();
$itemSoldArrays = itemSoldArray($input);
$price = totalItemPrice($itemSoldArrays);
$max = maxSoldItem($itemSoldArrays);
$min = minSoldItem($itemSoldArrays);
display([$price], $max, $min);