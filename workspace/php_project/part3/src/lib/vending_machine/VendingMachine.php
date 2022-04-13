<?php
// ◯お題

// 自動販売機プログラムで以下の仕様変更がありました。

// カップコーヒー（カップに注ぐコーヒー）のアイスとホットも選択できるようにします。値段はどちらも100円です

// カップの在庫管理も行ってください。カップコーヒーが一つ注文されるとカップも在庫から一つ減ります。自動販売機が保持できるカップ数は最大100個とします

// カップを追加できるようにしてください
// 継承を使って実装しましょう。

// 用件定後
// カップドリンクとドリンクをクラス分けする。親クラスはItemクラス。
// ドリンク名と値段の関数を持ってくる
// カップを補充するメソッドを作る
// カップコーヒーのみに、注文される度にカップを減らす

require_once(__DIR__ . '/Item.php');

class VendingMachine
{
    private const MAX_CUP = 100;
    private int $depositedCoin = 0;
    private $cupRemaining = 0;

    public function depositCoin(int $coinAmount): int
    {
        if ($coinAmount === 100) {
            $this->depositedCoin += $coinAmount;
        }

        return $this->depositedCoin;
    }

    // $item = new Item('cola')
    public function pressButton(Item $item): string
    {
        $price = $item->getPrice();
        if ($this->depositedCoin >= $price && $item->getCup() < $this->cupRemaining) {
            $this->depositedCoin -= $price;
            $this->cupRemaining -= $item->getCup();
            return $item->getName();
        } else {
            return '';
        }
    }

    public function addCup(int $cup): int {
        $cupNumber = $this->cupRemaining + $cup;

        if ($cupNumber > self::MAX_CUP) {
            $cupNumber = self::MAX_CUP;
        }

        $cupNumber = self::MAX_CUP;
        return $this->cupRemaining;
    }
}