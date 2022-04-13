<?php

class PokerPlayer
{
    public function __construct(public array $poker)
    {
    }

    public function getRank()
    {
        return array_map(fn ($pokerCard) => $pokerCard->Rank(), $this->poker);
    }
}