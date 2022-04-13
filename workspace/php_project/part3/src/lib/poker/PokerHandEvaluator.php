<?php
// isStraightなどのメソッドをabstractで持っていくことができなかった。互換性がないというエラー

require_once('PokerCard.php');
require_once('Role.php');

class PokerHandEvaluator
{    
    public function __construct(private Role $rule)
    {
    }

    public function getHand(array $pokerCards)
    {
        return $this->rule->getHand($pokerCards);
    }
}