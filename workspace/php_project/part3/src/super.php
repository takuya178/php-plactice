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
// 10コーヒー 100円
// また、以下の条件を満たすと割引されます。

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

// 用件定義
// 第一引数に文字列の時間帯、第二引数に配列で商品番号
// 配列の値を受け取る
// 商品の配列を作る 弁当と飲み物の区別をする必要がある。 
// [1=>[100, '弁当or飲みもの'], 2=>[150, '弁当or飲み物']...]のような配列
// 玉ねぎを3つ購入した時、5つ購入した時の関数
// 弁当と飲み物を一緒に買うと20円引き（ただし適用は一組ずつ）
// お弁当は20〜23時はタイムセールで半額


// 詰まったところ
// 弁当とドリンクを1組ずつにするプログラム

const ITEM = [
    1 => [100, ''],
    2 => [150, ''],
    3 => [200, ''],
    4 => [350, ''],
    5 => [180, 'drink'],
    6 => [220, ''],
    7 => [440, 'bento'],
    8 => [380, 'bento'],
    9 => [80, 'drink'],
    10 => [100, 'drink'],
];

const ONION_MINI_SALE = 3;
const ONION_BIG_SALE = 5;
const DRINK = 'drink';
const BENTO = 'bento';
const ONION_MINI_DISCOUNT = 50;
const ONION_BIG_DISCOUNT = 100;
const SET_DISCOUNT = 20;
const TAX = 1.10;

function calc(string $time, array $items): int {    
    $drink = 0;
    $bento = 0;
    $sumPrice = 0;

    foreach ($items as $item) {
        // 弁当と飲み物を一緒に買うと20円引き（ただし適用は一組ずつ）

        if (ITEM[$item][1] === DRINK) {
            $drink++;
        }

        if (ITEM[$item][1] === BENTO) {
            $bento++;
        }
        $sumPrice += ITEM[$item][0];
    }

    $sumPrice -= onionSales($items);
    $sumPrice -= setDiscountMenu($drink, $bento);
    return $sumPrice * TAX;
}

// 玉ねぎの値引きシステム
function onionSales($items): int {
    $itemCount = array_count_values($items);

    $discount = 0;
    if ($itemCount[1] === ONION_MINI_SALE) {
        $discount = ONION_MINI_DISCOUNT;
    } elseif($itemCount[1] === ONION_BIG_SALE) {
        $discount = ONION_BIG_DISCOUNT;
    }
    return $discount;
}

// 弁当と飲み物を一緒に買った時のセール
function setDiscountMenu($drink, $bento): int {
    $min = min([$drink, $bento]);
    return $min * SET_DISCOUNT;
}

calc('21:00', [1, 1, 1, 3, 5, 7, 8, 9, 10]);
