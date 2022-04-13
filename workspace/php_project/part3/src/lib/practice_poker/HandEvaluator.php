<?php

require_once('PokerCard.php');

class HandEvaluator
{
    public function __construct(private Roles $role)
    {
    }

    public function judgeRole(array $poker)
    {
        return $this->role->judgeRole($poker);
    }
}