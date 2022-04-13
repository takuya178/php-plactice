<?php

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

// 1 10 2 3 5 1 7 5 10 1

// ◯アウトプット例

// 2464
// 1
// 5 10


// [[商品番号, 販売個数]]

// 用件定義
// コマンド入力の値を配列に入れる
// 2つずつに分割する
// 売上合計の算出。（消費税込みで）
// 販売個数が最も多い商品番号を選択
// 販売個数の最も少ない商品番号
// ※また、販売個数の最も多い商品と販売個数の最も少ない商品について、販売個数が同数の商品が存在する場合、それら全ての商品番号を記載すること。

const ARRAY_SLICE = 1;
const ARRAY_CHUNK = 2;
const TAX = 1.10;

const ITEM_PRICE = [
  1 => 100,
  2 => 120,
  3 => 150,
  4 => 250,
  5 => 80,
  6 => 120,
  7 => 100,
  8 => 180,
  9 => 50,
  10 => 300
];


function getInput() {
    $input = array_slice($_SERVER['argv'], ARRAY_SLICE);
    $args = array_chunk($input, ARRAY_CHUNK);
    return $args;
}

// 売上の合計の算出
function calculatePrice($inputArrays) {
    $sum = 0;

    foreach ($inputArrays as $inputArray) {
        $number = $inputArray[0];
        $sale = $inputArray[1];
        
        $sum = $sum += ITEM_PRICE[$number] * TAX;
    }
    return $sum;
}

// 販売個数が最も多い商品
function MaxSoldItem($inputArrays) {
    $arrayKey = [];

    foreach ($inputArrays as $inputArray) {
        $number = $inputArray[0];
        $sold = $inputArray[1];

        $arrayKey[$number] = $sold;
    }
    
    $max = max(array_values($arrayKey));
    array_keys($arrayKey, $max);
    return $arrayKey;

}

$inputArrays = getInput();
calculatePrice($inputArrays);
var_dump(MaxSoldItem($inputArrays));