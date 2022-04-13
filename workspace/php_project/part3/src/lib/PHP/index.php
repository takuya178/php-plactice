<?php
// <!-- 【クイズ】テレビの視聴時間

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

// チャンネル、視聴時間
// 1 30 5 25 2 30 1 15

// ◯アウトプット例

// 1.7
// 1 45 2
// 2 30 1
// 5 25 1

// ◯実行コマンド例
// php quiz.php 1 30 5 25 2 30 1 15 -->

// <!-- 用件定後 -->
// <!-- 入力コマンドを受け取る -->
// <!-- 2つずつに分割する -->
// <!-- 共通のキーで配列を展開 -->
// 理想の形 [1 => [30, 15], 2 => [30], 5 => [25]]

function commandArray(): array
{
    $command = array_slice($_SERVER['argv'], 1);
    return array_chunk($command, 2);    
}

function viewingChannelList($index): array
{
    $list = [];

    foreach ($index as $view) {
        $channel = $view[0];
        $time = $view[1];
        $times = [$time];

        if (array_key_exists($channel, $list)) {
            $times = array_merge($list[$channel], $times);
        }

        $list[$channel] = $times;
    }
    return $list;
}

function display($channelTime)
{
    $viewingTime = 0;
    foreach ($channelTime as $key => $value) {
        $viewingTime += array_sum($value);
        // echo $viewingTime;
        echo $key . ' ' . array_sum($value). ' ' . count($value). PHP_EOL;
    }
}

$index = commandArray();
$channelTime = viewingChannelList($index);
display($channelTime);
