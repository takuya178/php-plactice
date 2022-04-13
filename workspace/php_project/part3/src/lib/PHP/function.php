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

// ※ただし、販売した商品番号は1〜10の整数とする。

// ◯アウトプット

// 売上の合計
// 販売個数の最も多い商品番号
// 販売個数の最も少ない商品番号

// ※ただし、税率は10%とする。
// ※また、販売個数の最も多い商品と販売個数の最も少ない商品について、販売個数が同数の商品が存在する場合、それら全ての商品番号を記載すること。

// ◯インプット例

// 販売した商品番号 販売個数 販売した商品番号 販売個数 ...
// 1 10 2 3 5 1 7 5 10 1

// ◯アウトプット例

// 2464
// 1
// 5 10

// ◯実行コマンド例
// php quiz.php 1 10 2 3 5 1 7 5 10 1

// 要件定義
// 配列を作成する
// 配列を作り、2つずつペアにする
// 入力コマンドで該当するキーの値と、商品個数を掛け算する

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

const TAX = 1.10;

function commandArray()
{
    $command = array_slice($_SERVER['argv'], 1);
    return array_chunk($command, 2);
}

// 売上合計を算出
function calculatePrice($commands): float
{
    $totalPrice = 0;
    foreach ($commands as $command) {
        $totalPrice += ITEM[$command[0]] * $command[1] * TAX;
    }
    return $totalPrice;
}

// 配列を整える['商品番号' => '売れた個数']
function arrangeArray($commands): array
{
    $lists = [];

    foreach ($commands as $command) {
        $item = $command[0];
        $sold = $command[1];

        $lists[$item] = $sold;
    }
    return $lists;
}

// 販売個数の最も多い商品を表示
function maxSoldItem($itemLists): array
{
    return array_keys($itemLists ,max($itemLists));
}

// 販売個数の最も少ない商品を表示
function minSoldItem($itemLists): array
{
    return array_keys($itemLists , min($itemLists));
}

// 画面表示
function display(...$results)
{
    foreach ($results as $result) {
        echo implode(' ', $result). PHP_EOL;
    }
}

$commands = commandArray();
$price = calculatePrice($commands);
$itemLists = arrangeArray($commands);
$maxItem = maxSoldItem($itemLists);
$minItem = minSoldItem($itemLists);
display([$price], $maxItem, $minItem);