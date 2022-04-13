<?php
// カードが2枚と3枚の場合の処理をする。
// 継承を使って
// interfaceを使ってRoleを定義しているけど、どうやって呼ぼうか
// Rolesクラスを実行するクラスを作成する。
require_once('PokerCard.php');
require_once('PokerPlayer.php');
require_once('Roles.php');
require_once('TwoPokerCard.php');
require_once('HandEvaluator.php');
// require_once('ThreePokerCard.php');

class PokerGame {
    public function __construct(public array $card1, public array $card2)
    {
    }

    public function start(): array
    {
        $pokerRank = [];
        foreach ([$this->card1, $this->card2] as $card) {
            $poker = array_map(fn($card) => new PokerCard($card), $card);
            $role = $this->cardNumber($card);
            $handEvaluator = new HandEvaluator($role);
            $pokerRank[] = $handEvaluator->judgeRole($poker);
        }
        return $pokerRank;
    }

    public function cardNumber($card): Roles
    {
        $rule = new TwoPokerCard();
        if (count($card) === 3) {
            $rule = new ThreePokerCard();
        }
        return $rule;
    }
}