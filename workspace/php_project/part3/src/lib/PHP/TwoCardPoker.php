<?php

/*
 * ◯お題
 *
 * 2枚の手札でポーカーを行います。ルールは次の通りです。
 *
 * ・プレイヤーは2人です
 * ・各プレイヤーはトランプ2枚を与えられます
 * ・ジョーカーはありません
 * ・与えられたカードから、役を判定します。役は番号が大きくなるほど強くなります
 *   1. ハイカード：以下の役が一つも成立していない
 *   2. ペア：2枚のカードが同じ数字
 *   3. ストレート：2枚のカードが連続している。A は 2 と K の両方と連続しているとみなし、A を含むストレート は、A-2 と K-A の2つです
 * ・2つの手札について、強さは以下に従います
 *   1. 2つの手札の役が異なる場合、より上位の役を持つ手札が強いものとする
 *   2. 2つの手札の役が同じ場合、各カードの数値によって強さを比較する
 * 　  ・（弱）2, 3, 4, 5, 6, 7, 8, 9, 10, J, Q, K, A (強)
 * 　  ・ハイカード：一番強い数字同士を比較する。左記が同じ数字の場合、もう一枚のカード同士を比較する
 * 　  ・ペア：ペアの数字を比較する
 * 　  ・ストレート：一番強い数字を比較する (ただし、A-2 の組み合わせの場合、2 を一番強い数字とする。K-A が最強、A-2 が最弱)
 * 　  ・数値が同じ場合：引き分け
 * 　
 * それぞれの役と勝敗を判定するプログラムを作成ください。
 *
 * ◯仕様
 *
 * それぞれの役と勝敗を判定するshowDownメソッドを定義してください。
 * showDownメソッドは引数として、プレイヤー1のカード、プレイヤー1のカード、プレイヤー2のカード、プレイヤー2のカードを取ります。
 * カードはH1〜H13（ハート）、S1〜S13（スペード）、D1〜D13（ダイヤ）、C1〜C13（クラブ）、となります。ただし、Jは11、Qは12、Kは13、Aは1とします。
 * showDownメソッドは返り値として、プレイヤー1の役、プレイヤー2の役、勝利したプレイヤーの番号、を返します。引き分けの場合、プレイヤーの番号は0とします。
 *
 * ◯実行例
 *
 * showDown('CK', 'DJ', 'C10', 'H10')  //=> ['high card', 'pair', 2]
 * showDown('CK', 'DJ', 'C3', 'H4')  //=> ['high card', 'straight', 2]
 * showDown('C3', 'H4', 'DK', 'SK')  //=> ['straight', 'pair', 1]
 * showDown('HJ', 'SK', 'DQ', 'D10')  //=> ['high card', 'high card', 1]
 * showDown('H9', 'SK', 'DK', 'D10')  //=> ['high card', 'high card', 2]
 * showDown('H3', 'S5', 'D5', 'D3')  //=> ['high card', 'high card', 0]
 * showDown('CA', 'DA', 'C2', 'D2')  //=> ['pair', 'pair', 1]
 * showDown('CK', 'DK', 'CA', 'DA')  //=> ['pair', 'pair', 2]
 * showDown('C4', 'D4', 'H4', 'S4')  //=> ['pair', 'pair', 0]
 * showDown('SA', 'DK', 'C2', 'CA')  //=> ['straight', 'straight', 1]
 * showDown('C2', 'CA', 'S2', 'D3')  //=> ['straight', 'straight', 2]
 * showDown('S2', 'D3', 'C2', 'H3')  //=> ['straight', 'straight', 0]
*/

// 用件定義
// 引数をプレイヤー毎に分ける
// カードの強さを決める
// ハイカード、ペア、ストレートの役判定

const CARD = [
    '2' => 1,
    '3' => 2,
    '4' => 3,
    '5' => 4,
    '6' => 5,
    '7' => 6,
    '8' => 7,
    '9' => 8,
    '10' => 9,
    'J' => 10,
    'Q' => 11,
    'K' => 12,
    'A' => 13,
];

const SUBSTR_FIRST_LENGTH = 1;
const SUBSTR_FINAL_LENGTH = 2;
const PAIR = 'pair';
const STRAIGHT = 'straight';
const HIGH_CARD = 'high card';

const ROLE_RANK = [
    HIGH_CARD => 1,
    PAIR => 2,
    STRAIGHT => 3
];

function showDown(string $card1, string $card2, string $card3, string $card4) {
    $cardArray = changeRank([$card1, $card2, $card3, $card4]);
    $playerCard = array_chunk($cardArray, 2);
    // 役の判定
    $hands = array_map(fn ($playerCard) => judgeHands($playerCard[0], $playerCard[1]), $playerCard);
    var_dump($hands);
}

// 文字列で受け取った数字をランクに変換
function changeRank(array $cards) {
    return array_map(fn ($card) => CARD[substr($card, SUBSTR_FIRST_LENGTH, SUBSTR_FINAL_LENGTH)], $cards);
}

// 役の判定
function judgeHands($card1, $card2) {
    $hands = HIGH_CARD;
    $max = max($card1, $card2);
    $min = min($card1, $card2);

    if (isPair($card1, $card2)) {
        $hands = PAIR;
    } elseif (isStraight($card1, $card2)) {
        $hands = STRAIGHT;
    }

    return [
        'name' => $hands,
        'rank' => ROLE_RANK[$hands],
        'max' => $max,
        'min' => $min,
    ];
}

function isPair($card1, $card2) {
    return $card1 === $card2;
}

function isStraight($card1, $card2) {
    return $card1 + 1 === $card2 || $card1 - 1 === $card2 || exceptionStraight($card1, $card2);
}

function exceptionStraight($card1, $card2) {
    return $card1 === max(CARD) && $card2 === min(CARD);
}

showDown('CK', 'DJ', 'C10', 'H10');
