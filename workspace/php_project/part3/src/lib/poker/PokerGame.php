<?php

require_once('PokerCard.php');
require_once('PokerHandEvaluator.php');
require_once('ThreeCardPoker.php');
require_once('TwoCardPoker.php');

class PokerGame
{
    public function __construct(private array $cards1, private array $cards2)
    {
    }

    public function start(): array
    {
        $hands = [];
        foreach ([$this->cards1, $this->cards2] as $cards) {
            $pokerCards = array_map(fn ($card) => new PokerCard($card), $cards);
            $rule = $this->getRule($cards);
            $handEvaluator = new PokerHandEvaluator($rule);
            $hands[] = $handEvaluator->getHand($pokerCards);
        }
        return $hands;
    }

    private function getRule(array $cards): Role
    {
        $rule = new PokerTwoCardRule();
        if (count($cards) === 3) {
            $rule = new PokerThreeCardRule();
        }
        return $rule;
    }
}

$game = new PokerGame(['C2', 'D2'], ['C10', 'H9']);
var_dump($game->start());