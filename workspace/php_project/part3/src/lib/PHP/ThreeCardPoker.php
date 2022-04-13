<?php
// 実装につまったところ
// 2番目に大きい数字を出すところ
// three_cardとpairの判定関数
// ペア、ストレート、スリーカードの判定
// 11, 10, 9みたいに数字が下がっていくstraightの実装
// [A, 2, 3]の時どうやってAを$tertiaryに入れるか


/*
◯お題

「ツーカードポーカー」に「カードの枚数を3枚に変更して」と仕様変更が発生しました。

・ツーカードポーカーのファイルをコピーして新規ファイルを作成しましょう
・カード枚数を3枚に変更しましょう
・役の仕様は下記に変更します。役は番号が大きくなるほど強くなります

1. ハイカード：以下の役が一つも成立していない
2. ペア：2枚のカードが同じ数字
3. ストレート：3枚のカードが連続している。A は 2 と K の両方と連続しているとみなし、A を含むストレート は、A-2-3 と Q-K-A の2つ。ただし、K-A-2 のランクの組み合わせはストレートとはみなさない
4. スリーカード：3枚のカードが同じ数字
・2つの手札について、強さは以下に従います
5. 2つの手札の役が異なる場合、より上位の役を持つ手札が強いものとする
6. 2つの手札の役が同じ場合、各カードの数値によって強さを比較する
　 ・（弱）2, 3, 4, 5, 6, 7, 8, 9, 10, J, Q, K, A (強)
　 ・ハイカード：一番強い数字同士を比較する。左記が同じ数字の場合、二番目に強いカード同士を比較する。左記が同じ数字の場合、三番目に強いランクを持つカード同士を比較する。左記が同じランクの場合は引き分け
　 ・ペア：ペアの数字を比較する。左記が同じランクの場合、ペアではない3枚目同士のランクを比較する。左記が同じランクの場合は引き分け
　 ・ストレート：一番強い数字を比較する (ただし、A-2-3 の組み合わせの場合、3 を一番強い数字とする。Q-K-A が最強、A-2-3 が最弱)。一番強いランクが同じ場合は引き分け
　 ・スリーカード：スリーカードの数字を比較する。スリーカードのランクが同じ場合は引き分け
それぞれの役と勝敗を判定するプログラムを作成ください。

◯仕様

それぞれの役と勝敗を判定するshowメソッドを定義してください。
showメソッドは引数として、プレイヤー1のカード、プレイヤー1のカード、プレイヤー1のカード、プレイヤー2のカード、プレイヤー2のカード、プレイヤー2のカードを取ります。
カードはH1〜H13（ハート）、S1〜S13（スペード）、D1〜D13（ダイヤ）、C1〜C13（クラブ）、となります。ただし、Jは11、Qは12、Kは13、Aは1とします。
showメソッドは返り値として、プレイヤー1の役、プレイヤー2の役、勝利したプレイヤーの番号、を返します。引き分けの場合、プレイヤーの番号は0とします。
*/


// 用件定義
// 引数の値を取得する
// カードの強さを設定する。[1=>0, 2=>1....A=>13]
// 役の判定
// ストレートの判定が難しそうなので個別で実装する

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

function show(string $card11, string $card12, string $card13, string $card21, string $card22, string $card23): array {
    // 引数の値をカードの強さ順で出力する
    $cardRankList = changeArgument([$card11, $card12, $card13, $card21, $card22, $card23]);
    // 役の判定
    $playerCard = array_chunk($cardRankList, 3);
    var_dump($playerCard);
    $hands = array_map(fn ($playerCard) => judgeRole($playerCard[0], $playerCard[1], $playerCard[2]), $playerCard);
    // 勝利判定
    $winner = winnerPlayer($hands[0], $hands[1]);
    return [$hands[0]['role'], $hands[1]['role'], $winner];
}

// 引数の値をカードの強さの数字に変換
function changeArgument(array $argument): array {
    return array_map(fn ($argument) => CARD_RANK[substr($argument, ARGUMENT_FIRST_LENGTH, ARGUMENT_LAST_LENGTH)], $argument);
}

// プレイヤー毎の役を判定する
function judgeRole(int $player1, int $player2, int $player3): array {
    $role = HIGH_CARD;
    $primary = max($player1, $player2, $player3);
    $secondary = getSecondNumber($player1, $player2, $player3);
    $tertiary = min($player1, $player2, $player3);

    if (isStraight($player1, $player2, $player3)) {
        if (notStraight($player1, $player2, $player3)) {
            $role = HIGH_CARD;
        } elseif(isMinMax($player1, $player2, $player3)) {
            $primary = min($player1, $player2, $player3);
            $tertiary = max($player1, $player2, $player3);
        }
        $role = STRAIGHT;
    } elseif (isThreeCard($player1, $player2, $player3)) {
        $role = THREE_CARD;
    } elseif (isPair($player1, $player2, $player3)) {
        $role = PAIR;
    }
    return [
        'role' => $role,
        'rank' => ROLE_RANK[$role],
        'primary' => $primary,
        'secondary' => $secondary,
        'tertiary' => $tertiary,
    ];
}

// straightの判定
function isStraight(int $player1, int $player2, int $player3): bool {
    return (abs($player1 - $player2) === 1 && abs($player2 - $player3) === 1) || (isMinMax($player1, $player2, $player3) && abs($player2 - $player1) === abs(min(CARD_RANK) - max(CARD_RANK)));
}

// straightではない判定
function notStraight(int $player1, int $player2, int $player3): bool {
    return abs($player2 - $player3) === max(CARD_RANK) - min(CARD_RANK) || ($player1 === $player2 && $player1 === $player3 && $player2 === $player3);
}

// 
function isMinMax(int $player1, int $player2, int $player3): bool {
    return abs($player1 - $player2) === max(CARD_RANK) - min(CARD_RANK);
}

// pairの判定
function isPAIR(int $player1, int $player2, int $player3): bool {
    return $player1 === $player2 || $player1 === $player3 || $player2 === $player3;
}

// three_cardの判定
function isThreeCard(int $player1, int $player2, int $player3): bool {
    return $player1 === $player2 && $player1 === $player3 && $player2 === $player3;
}

// 2番目に大きい数字を取得する
function getSecondNumber(int $player1, int $player2, int $player3) {
    $cardSort = [$player1, $player2, $player3];
    sort($cardSort);
    return $cardSort[1];
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

show('CK', 'DJ', 'H9', 'C10', 'H10', 'D3');
