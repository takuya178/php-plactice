<?php

class PokerCard
{
    public const CARD_RANK = [
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

    public function __construct(public string $card)
    {
    }

    public function Rank()
    {
        return self::CARD_RANK[substr($this->card, 1, 2)];
    }
}
