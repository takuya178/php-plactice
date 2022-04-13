<?php

require_once('Roles.php');

class TwoPokerCard implements Roles
{
    private const HIGH_CARD = 'high card';
    private const STRAIGHT = 'straight';
    private const PAIR = 'pair';

    // public function __construct(public array $poker)
    // {
    // }

    public function judgeRole(array $poker): string
    {
        $role = array_map(fn ($poker) => $poker->Rank(), $poker);

        $name = self::HIGH_CARD;

        if ($this->isStraight($role[0], $role[1])) {
            $name = self::STRAIGHT;
        } elseif ($this->isPair($role[0], $role[1])) {
            $name = self::PAIR;
        }
        return $name;
    }

    private function isPair(int $role1, int $role2): bool
    {
        return $role1 === $role2;
    }

    private function isStraight(int $role1, int $role2): bool
    {
        return abs($role1 - $role2) === 1 || $this->isMinMax($role1, $role2);
    }

    private function isMinMax(int $role1, int $role2): bool
    {
        return abs($role1 - $role2) === (max(PokerCard::CARD_RANK) - min(PokerCard::CARD_RANK));
    }
}