<?php

require_once('Deck.php');

class Player {
    public function __construct(private string $name)
    {
    }

    public function drawCards(Deck $deck, int $drawNum)
    {
        // デッキのゴチャゴチャした動作はデッキクラスで処理する
        return $deck->drawCards($drawNum);
    }
}
