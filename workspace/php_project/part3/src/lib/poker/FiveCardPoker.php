<?php

require_once('PokerHandEvaluator.php');
require_once('Role.php');

class PokerFiveCardRule implements Role
{
    private const HIGH_CARD = 'high card';
    private const ONE_PAIR = 'one pair';
    private const TWO_PAIR = 'two pair';
    private const STRAIGHT = 'straight';
    private const THREE_CARD = 'three card';
    private const FULL_HOUSE = 'full house';
    private const FOUR_CARD = 'four card';

    public function getHand(array $pokerCards): string
    {
        $cardRanks = array_map(fn ($pokerCard) => $pokerCard->getRank(), $pokerCards);
        $name = self::HIGH_CARD;
        if ($this->isFullHouse($cardRanks)) {
            $name = self::FULL_HOUSE;
        } elseif ($this->isFourCard($cardRanks)) {
            $name = self::FOUR_CARD;
        } elseif ($this->isThreeCard($cardRanks)) {
            $name = self::THREE_CARD;
        } elseif ($this->isTwoPair($cardRanks)) {
            $name = self::TWO_PAIR;
        } elseif ($this->isOnePair($cardRanks)) {
            $name = self::ONE_PAIR;
        }
        return $name;
    }

    public function isFullHouse($cardRanks): bool {
        return count(array_unique($cardRanks)) === 1;
    }

    public function isFourCard($cardRanks): bool {
        return count(array_unique($cardRanks)) === 2;
    }

    public function isThreeCard($cardRanks): bool {
        return count(array_unique($cardRanks)) === 3;
    }

    public function isTwoPair($cardRanks): bool {
    }

    public function isOnePair($cardRanks): bool {
    }
}