<?php

// 【クイズ】テレビの視聴時間

// ◯お題
// あなたはテレビが好きすぎて、プログラミングの学習が捗らないことに悩んでいました。
// テレビをやめれば学習時間が増えることは分かっているのですけど、テレビをすぐに辞めることができないでいます。
// そこで、一日のテレビの視聴分数を記録することから始めようと思い、プログラムを書くことにしました。
// テレビを見るたびにチャンネルごとの視聴分数をメモしておき、一日の終わりに記録します。テレビの合計視聴時間と、チャンネルごとの視聴分数と視聴回数を出力してください。

// ◯インプット
// 入力は以下の形式で与えられます。

// テレビのチャンネル 視聴分数 テレビのチャンネル 視聴分数 ...

// ただし、同じチャンネルを複数回見た時は、それぞれ分けて記録すること。

// チャンネル：数値を指定すること。1〜12の範囲とする（1ch〜12ch）
// 視聴分数：分数を指定すること。1〜1440の範囲とする

// ◯アウトプット
// テレビの合計視聴時間
// テレビのチャンネル 視聴分数 視聴回数
// テレビのチャンネル 視聴分数 視聴回数
// ...

// ただし、閲覧したチャンネルだけ出力するものとする。

// 視聴時間：時間数を出力すること。小数点一桁までで、端数は四捨五入すること

// ◯インプット例

// 1 30 5 25 2 30 1 15

// ◯アウトプット例

// 1.7
// 1 45 2
// 2 30 1
// 5 25 1

// ◯実行コマンド例
// php quiz.php 1 30 5 25 2 30 1 15


// 用件定義
// 入力コマンドを取得する
// 配列を2つずつに分割する
// [1=>[20,15], 2=>[30]...]のように配列を設定する
// 視聴時間の合計時間を算出
// チャンネル毎の視聴時間と視聴回数を取得
// アウトプット例のように表示する


function getDatum() {
    $input = array_slice($_SERVER['argv'], 1);
    return array_chunk($input, 2);
}

// 配列を整える
function viewingChannelData($inputDatum) {
    $viewingChannelTimes = [];

    foreach ($inputDatum as $inputData) {
        $channel = $inputData[0];
        $min = $inputData[1];
        // [30],[25],[30],[15]
        $mins = [$min];
        // var_dump($inputData);
        
        if (array_key_exists($channel, $viewingChannelTimes)) {
            $mins = array_merge($viewingChannelTimes[$channel], $mins);
            // var_dump($mins);
        }

        $viewingChannelTimes[$channel] = $mins;
    }
    return $viewingChannelTimes;
}

// 視聴時間の合計時間
function calculateTime($viewingChannelTimes) {
    $viewingWatchTimes = [];

    foreach($viewingChannelTimes as $channel) {
        // var_dump($channel);
        $viewingWatchTimes = array_merge($viewingWatchTimes, $channel);
    }
    array_sum($viewingWatchTimes) / 60;
    return $viewingWatchTimes;
}


// チャンネル毎の視聴時間と視聴回数を取得
// 1 45 2
// 2 30 1
// 5 25 1
function getNumberOfTime($viewingChannelTimes) {
    $value = [];

    foreach($viewingChannelTimes as $chan => $sumMin) {
        var_dump(array_sum($sumMin));
    }
    // var_dump($viewingChannelTimes);
    return $viewingChannelTimes;
}


$inputDatum = getDatum();
$viewingChannelTimes = viewingChannelData($inputDatum);
calculateTime($viewingChannelTimes);
getNumberOfTime($viewingChannelTimes);