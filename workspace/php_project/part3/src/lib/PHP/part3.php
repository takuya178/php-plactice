<?php

// 【クイズ】スーパーの支払金額

// ◯お題
// スーパーで買い物したときの支払金額を計算するプログラムを書きましょう。
// 以下の商品リストがあります。先頭の数字は商品番号です。金額は税抜です。

// 1.玉ねぎ 100円
// 2.人参 150円
// 3.りんご 200円
// 4.ぶどう 350円
// 5.牛乳 180円
// 6.卵 220円
// 7.唐揚げ弁当 440円
// 8.のり弁 380円
// 9.お茶 80円
// 10.コーヒー 100円
// 11.また、以下の条件を満たすと割引されます。

// a. 玉ねぎは3つ買うと50円引き
// b. 玉ねぎは5つ買うと100円引き
// c. 弁当と飲み物を一緒に買うと20円引き（ただし適用は一組ずつ）
// d. お弁当は20〜23時はタイムセールで半額

// 合計金額（税込み）を求めてください。

// ◯仕様
// 金額を計算するcalc関数を定義してください。
// calcメソッドは「購入時刻 商品番号 商品番号 商品番号 ...」を引数に取り、合計金額（税込み）を返します。
// 購入時刻はHH:MM形式（例. 20:00）とし、商品番号は1〜10の整数とします。
// 同時に買える商品は20個までです。また、購入時刻は9〜23時です。

// ◯実行例
// calcメソッドは「購入時刻 商品番号 商品番号 商品番号 ...」を引数
// calc('21:00', [1, 1, 1, 3, 5, 7, 8, 9, 10])  //=> 1298

// 用件定後
// 商品の配列定数を定義する
// 弁当と飲み物を区別するような配列
// 玉ねぎを何個買ったか区別する関数
// 弁当と飲み物を一緒に買うと20円引き（ただし適用は一組ずつ）
// お弁当は20〜23時はタイムセールで半額

const ITEM = [
    1 => ['name' => '玉ねぎ', 'price' => 100, 'type' => ''],
    2 => ['name' => '人参', 'price' => 150, 'type' => ''],
    3 => ['name' => 'りんご', 'price' => 200, 'type' => ''],
    4 => ['name' => 'ぶどう', 'price' => 350, 'type' => ''],
    5 => ['name' => '牛乳', 'price' => 180, 'type' => 'drink'],
    6 => ['name' => '卵', 'price' => 220, 'type' => ''],
    7 => ['name' => '唐揚げ弁当', 'price' => 440, 'type' => 'bento'],
    8 => ['name' => 'のり弁', 'price' => 380, 'type' => 'bento'],
    9 => ['name' => 'お茶', 'price' => 100, 'type' => 'drink'],
    10 => ['name' => 'コーヒー', 'price' => 100, 'type' => 'drink'],
];

const TAX = 1.1;
const MIN_SALE_ONION = 3;
const MAX_SALE_ONION = 5;
const MIN_ONION_DISCOUNT = 50;
const MAX_ONION_DISCOUNT = 100;

function calc($time, array $items): float
{
    $totalPrice = 0;
    foreach ($items as $item) {
        $totalPrice += ITEM[$item]['price'] * TAX;
      }
      // 玉ねぎの値引き
      $totalPrice -= soldOnion($items);

      // ドリンクと弁当の値引き
      $totalPrice -= drinkBentoSale($items);
      var_dump($totalPrice);
    return $totalPrice;
}

// 玉ねぎを何個買ったか確認するプログラム
function soldOnion($items): float
{
    $onionDiscount = 0;
    $arrayValue = array_count_values($items);

    if (minOnionSale($arrayValue)) {
        $onionDiscount = MIN_ONION_DISCOUNT;
    }

    if (bigOnionSale($arrayValue)) {
        $onionDiscount = MAX_ONION_DISCOUNT;
    }

    return $onionDiscount;
}

function minOnionSale($arrayValue): bool
{
    return $arrayValue['1'] === MIN_SALE_ONION;
}

function bigOnionSale($arrayValue): bool
{
    return $arrayValue['1'] === MAX_SALE_ONION;
}

// 弁当と飲み物を一緒に買うと20円引き（ただし適用は一組ずつ）
function drinkBentoSale($items)
{
    $drinkBentoDiscount = 20;
    $drinkBentoLists = [];

    foreach ($items as $item) {
        if (ITEM[$item]['type'] === 'drink' || ITEM[$item]['type'] === 'bento') {
            $drinkBentoLists[$item] = ITEM[$item]['type'];
          }
    }
    $disable = array_count_values($drinkBentoLists);
    $drinkBentoDiscount *= min($disable);
    return $drinkBentoDiscount;
}

// お弁当は20〜23時はタイムセールで半額

calc('21:00', [1, 1, 1, 3, 5, 7, 8, 9, 10]);