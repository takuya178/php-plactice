<?php

// 【クイズ】スリーカードポーカーへの仕様変更

// スリーカードポーカーに仕様変更が入りました。ツーカードポーカーとスリーカードポーカー、両方のルールに対応できるようにする必要が発生しました。
// 各プレイヤーに配られたカードの枚数が2枚ずつのときはツーカードポーカーとして処理し、配られたカードの枚数が3枚ずつのときはスリーカードポーカーとして処理します。
// スリーカードポーカーのプログラム、もしくはツーカードポーカーのプログラムをコピーして新規ファイルを作成し、そのファイルをツーカードポーカーとスリーカードポーカーの両方に対応させてください。

// ◯お題

// プレイヤーは2人です
// 各プレイヤーはトランプ2枚もしくは3枚を与えられます
// ジョーカーはありません
// 与えられたカードから、役を判定します。役は番号が大きくなるほど強くなります
// -- トランプ2枚のとき --

// 1. ハイカード：以下の役が一つも成立していない
// 2. ペア：2枚のカードが同じ数字
// 3. ストレート：2枚のカードが連続している。A は 2 と K の両方と連続しているとみなし、A を含むストレート は、A-2 と K-A の2つです
// ・2つの手札について、強さは以下に従います
// 4. 2つの手札の役が異なる場合、より上位の役を持つ手札が強いものとする
// 5. 2つの手札の役が同じ場合、各カードの数値によって強さを比較する
// 　 ・（弱）2, 3, 4, 5, 6, 7, 8, 9, 10, J, Q, K, A (強)
// 　 ・ハイカード：一番強い数字同士を比較する。左記が同じ数字の場合、もう一枚のカード同士を比較する
// 　 ・ペア：ペアの数字を比較する
// 　 ・ストレート：一番強い数字を比較する (ただし、A-2 の組み合わせの場合、2 を一番強い数字とする。K-A が最強、A-2 が最弱)
// 　 ・数値が同じ場合：引き分け
// -- トランプ3枚のとき --

// 1. ハイカード：以下の役が一つも成立していない
// 2. ペア：2枚のカードが同じ数字
// 3. ストレート：3枚のカードが連続している。A は 2 と K の両方と連続しているとみなし、A を含むストレート は、A-2-3 と Q-K-A の2つ。ただし、K-A-2 のランクの組み合わせはストレートとはみなさない
// 4. スリーカード：3枚のカードが同じ数字
// ・2つの手札について、強さは以下に従います
// 5. 2つの手札の役が異なる場合、より上位の役を持つ手札が強いものとする
// 6. 2つの手札の役が同じ場合、各カードの数値によって強さを比較する
// 　 ・（弱）2, 3, 4, 5, 6, 7, 8, 9, 10, J, Q, K, A (強)
// 　 ・ハイカード：一番強い数字同士を比較する。左記が同じ数字の場合、二番目に強いカード同士を比較する。左記が同じ数字の場合、三番目に強いランクを持つカード同士を比較する。左記が同じランクの場合は引き分け
// 　 ・ペア：ペアの数字を比較する。左記が同じランクの場合、ペアではない3枚目同士のランクを比較する。左記が同じランクの場合は引き分け
// 　 ・ストレート：一番強い数字を比較する (ただし、A-2-3 の組み合わせの場合、3 を一番強い数字とする。Q-K-A が最強、A-2-3 が最弱)。一番強いランクが同じ場合は引き分け
// 　 ・スリーカード：スリーカードの数字を比較する。スリーカードのランクが同じ場合は引き分け
// それぞれの役と勝敗を判定するプログラムを作成ください。

// ◯仕様

// それぞれの役と勝敗を判定するshowResultメソッドを定義してください。
// showResultメソッドは引数として、プレイヤー1のカードの配列、プレイヤー2のカードの配列を取ります。
// カードはH1〜H13（ハート）、S1〜S13（スペード）、D1〜D13（ダイヤ）、C1〜C13（クラブ）、となります。ただし、Jは11、Qは12、Kは13、Aは1とします。
// showResultメソッドは返り値として、プレイヤー1の役、プレイヤー2の役、勝利したプレイヤーの番号、を返します。引き分けの場合、プレイヤーの番号は0とします。


const CARDS = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];
define('CARD_RANK', (function () {
    $cardRanks = [];

    foreach (CARDS as $key => $value) {
        $cardRanks[$value] = $key;
    }
    return $cardRanks;
})());

const ARGUMENT_FIRST_LENGTH = 1;
const ARGUMENT_LAST_LENGTH = 2;

const HIGH_CARD = 'high card';
const STRAIGHT = 'straight';
const PAIR = 'pair';
const THREE_CARD = 'three card';

const ROLE_RANK = [
    HIGH_CARD => 1,
    PAIR => 2,
    STRAIGHT => 3,
    THREE_CARD => 4
];

function showResult(array ...$card) {
    $cardStrongList = cardStrong($card[0], $card[1]);
    
    // カードの役を判定をする
    if (isThreeArray($cardStrongList)) {
        $threeHands = array_map(fn ($cardStrongList) => judgeThreeRole($cardStrongList[0], $cardStrongList[1], $cardStrongList[2]), $cardStrongList);
        $winner = winnerPlayer($threeHands[0], $threeHands[1]);
        return [$threeHands[0]['role'], $threeHands[1]['role'], $winner];
    } else {
        $twoHands = array_map(fn ($cardStrongList) => judgeTwoRole($cardStrongList[0], $cardStrongList[1]), $cardStrongList);
        $winner = winnerPlayer($twoHands[0], $twoHands[1]);
        return [$twoHands[0]['role'], $twoHands[1]['role'], $winner];
    }
}

// 引数の数を判定
function isThreeArray(array $cardStrongList): bool {
    return count($cardStrongList[0]) === 3 && count($cardStrongList[0]) === 3;
}

// カードの値を強さに変換
function cardStrong($card1, $card2) {
    $card1 = array_map(fn ($card1) => CARD_RANK[substr($card1, 1, 2)], $card1);
    $card2 = array_map(fn ($card2) => CARD_RANK[substr($card2, 1, 2)], $card2);
    return array($card1, $card2);
}

// 3カードの時の役の判定
function judgeThreeRole($card1, $card2, $card3) {
    $name = HIGH_CARD;
    $primary = max($card1, $card2, $card3);
    $secondary = getSecondNumber($card1, $card2, $card3);
    $tertiary = min($card1, $card2, $card3);

    if (isThreePair($card1, $card2, $card3)) {
      $name = PAIR;
    } elseif (isThreeStraight($card1, $card2, $card3)) {
      if (isThreeMinMax($card1, $card2, $card3)) {
          $primary = min($card1, $card2, $card3);
          $secondary = max($card1, $card2, $card3);
      }
      $name = STRAIGHT;
    }
    return [
      'name' => $name,
      'rank' => ROLE_RANK[$name],
      'primary' => $primary,
      'secondary' => $secondary,
    ];
}

// 2カードの時の役の判定
function judgeTwoRole($card1, $card2) {
    $name = HIGH_CARD;
    $primary = max($card1, $card2);
    $secondary = min($card1, $card2);

    if (isPair($card1, $card2)) {
      $name = PAIR;
    } elseif (isStraight($card1, $card2)) {
      if (isMinMax($card1, $card2)) {
          $primary = min($card1, $card2);
          $secondary = max($card1, $card2);
      }
      $name = STRAIGHT;
    }
    return [
      'name' => $name,
      'rank' => ROLE_RANK[$name],
      'primary' => $primary,
      'secondary' => $secondary,
    ];
}


// straightの判定
function isThreeStraight(int $card1, int $card2, int $card3): bool {
  return (abs($card1 - $card2) === 1 && abs($card2 - $card3) === 1) || (isThreeMinMax($card1, $card2, $card3) && abs($card2 - $card1) === abs(min(CARD_RANK) - max(CARD_RANK)));
}

// straightではない判定
function notStraight(int $card1, int $card2, int $card3): bool {
  return abs($card2 - $card3) === max(CARD_RANK) - min(CARD_RANK) || ($card1 === $card2 && $card1 === $card3 && $card2 === $card3);
}

// 
function isThreeMinMax(int $card1, int $card2, int $card3): bool {
  return abs($card1 - $card2) === max(CARD_RANK) - min(CARD_RANK);
}

// pairの判定
function isThreePAIR(int $card1, int $card2, int $card3): bool {
  return $card1 === $card2 || $card1 === $card3 || $card2 === $card3;
}

// three_cardの判定
function isThreeCard(int $card1, int $card2, int $card3): bool {
  return $card1 === $card2 && $card1 === $card3 && $card2 === $card3;
}

// 2番目に大きい数字を取得する
function getSecondNumber(int $card1, int $card2, int $card3) {
  $cardSort = [$card1, $card2, $card3];
  sort($cardSort);
  return $cardSort[1];
}

// pairの判定関数
function isPair($card1, $card2): bool {
  return $card1 === $card2;
}

// straightの判定関数
function isStraight($card1, $card2): bool {
  return abs($card1 - $card2) === 1 || isMinMax($card1, $card2);
}

// A-2が最弱とする関数
function isMinMax(int $card1, int $card2): bool {
  return abs($card2 - $card1 === max(CARD_RANK) - min(CARD_RANK));
}

// 勝利判定
function winnerPlayer(array $player1, array $player2): int {
  foreach (['rank', 'primary', 'secondary', 'tertiary'] as $key) {
      if ($player1[$key] > $player2[$key]) {
          return 1;
      } elseif ($player1[$key] < $player2[$key]) {
          return 2;
      }
  }
  return 0;
}
showResult(['CK', 'DJ', 'H9'], ['C10', 'H10', 'D3']);