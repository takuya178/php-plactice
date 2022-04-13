<?php
// このレッスンのまとめです！

// やってみよう2の問題文と回答例を掲載しますね。
// ◯お題


// 次郎と春子はHIT&BLOWで遊んでいます。ルールは以下の通りです。

// 1.出題者は重複した数を含まない4桁の数を決める
// 2.回答者は4桁の数を予想する
// 3.出題者は解答者の予想を判定する。数と桁の療法が同じならヒット、数だけが同じで桁が異なればブローと呼ぶ。例えば正解が1234で回答が2135なら「1ヒット、2ブロー」とな
// 4.2-3を繰り返し、4桁の数が完全に同じになるまでの回数で勝負を決める
// 5.次郎と春子は遊ぶうちに計算を毎回行うのが面倒になったため、ヒット数とブロー数を算出するプログラムを作成することにしました。
// 6.正解と回答を入力し、ヒット数とブロー数を出力するプログラムを作成しましょう。

// ◯仕様

// ヒット数とブロー数を判定するjudgeメソッドを定義してください。
// judgeメソッドは正解と回答を引数に受け取り、ヒット数とブロー数の配列を返します。
// 正解と回答は4桁の整数、ヒット数とブロー数は0〜4の整数とします。

// ◯実行例

// judge(5678, 5678) //=> [4, 0]
// judge(5678, 7612) //=> [1, 1]
// judge(5678, 8756) //=> [0, 4]
// judge(5678, 1234) //=> [0, 0]

// 用件定義
// 同じ数字が含まれていたらブロー
// 同じ桁に同じ数字があればヒット


// $blowと$bitは最初0に設定していなくて大丈夫？ 無理矢理$blow変数を関数に入れてしまった。
// bitとblowの数字は重複してはならない

function judge(int $answer, int $guess): array
{
    $hit = 0;
    $blow = 0;
    $arrayGuess = str_split((string) $guess);
    foreach ($arrayGuess as $index => $guessElem) {
        if (isHit($guessElem, $answer, $index)) {
            $hit++;
        }

        if (isBlow($guessElem, $answer, $index)) {
            $blow++;
        }
    }

    return [$hit, $blow];
}

// Hitの判定
function isHit($letter, int $answer, $index)
{
    var_dump($letter);
    // var_dump($index);
    // var_dump(str_split((string) $answer)[$index]);
    return str_split((string) $answer)[$index] === $letter;
}

// Blowの判定
function isBlow($arrayAnswer, $arrayPlayer)
{

}

judge(5678, 7612);