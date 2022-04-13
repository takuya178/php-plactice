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



// ❶タスク分解
// データ構造を決める
// 入力値を取得する
// データを処理しやすい形に変換する
// 合計時間を算出する
// チャンネル毎の視聴分数と視聴回数を算出する
// 表示する


// 実行コマンドを受け取り、データを2つずつ配列に入れる
function getInput() {
  $getNumbers = array_slice($_SERVER['argv'], 1);
  return array_chunk($getNumbers, 2);
}


// データを処理しやすい形に変換する
// [1 => [30, 15], 2 => [30]]
function viewingData($commandDatum) {
  $viewDataPeriods = [];

  foreach ($commandDatum as $commandData) {
    $channel = $commandData[0]; // 1 5 2 1
    $min = $commandData[1]; // 30 25 30 15
    $mins = [$min]; // [30], [25], [30], [15]

    if (array_key_exists($channel, $viewDataPeriods)) {
      // var_dump($mins); [15], [100], [200]
      // $viewDataPeriodは一番最初に入っているチャンネルのバリューの値を返している。
      // $minsの配列を新しくしちゃえという感じで$minsの変数を上書きする
      $mins = array_merge($viewDataPeriods[$channel], $mins); // [30]($viewDataPeriod),[15]($mins) => 合体！ [30, 15]
    }
    $viewDataPeriods[$channel] = $mins;
  }
  return $viewDataPeriods;
}


// 合計視聴時間を算出する
function calculateSumTime($viewDataPeriods) {
  $calculateSumTimes = [];

  foreach ($viewDataPeriods as $viewDataPeriod) {
    // var_dump($viewDataPeriod); //[[30, 15, 100, 200], [25], [30], [40]]
    // var_dump($calculateSumTimes); //[30, 15, 100, 200, 25, 30, 40]

    // foreachで回ってくる毎に値を空配列に入れてあげる。
    // 1回目 [30, 15, 100, 200] + []みたいな形
    $calculateSumTimes = array_merge($calculateSumTimes, $viewDataPeriod);
    // var_dump($calculateSumTimes); [ [30, 15, 100, 200, 25, 30, 40] ]
  }
  array_sum($calculateSumTimes);
  return $calculateSumTimes;
}

$commandDatum = getInput();
$viewDataPeriods = viewingData($commandDatum);
calculateSumTime($viewDataPeriods);