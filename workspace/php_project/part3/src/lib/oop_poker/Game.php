<?php

require_once('Player.php');
require_once('Deck.php');
require_once('HandEvaluator.php');
require_once('RuleA');
require_once('RuleB');

class Game {
    public function __construct(private string $name, private int $drawNum, private string $ruleType)
    {
    }

    public function start() {
        $deck = new Deck();
        // プレイヤーを登録する
        $player = new Player($this->name);
        // プレイヤーがdrawCardsをするときにデッキと引く枚数を渡す。カードの処理は$deckが受け持つようになる
        $cards = $player->drawCards($deck, $this->drawNum);
        $rule = $this->getRule();
        // new HandEvaluator(new RuleA())とすることで、Rule.phpのgetHandメソッドにアクセスできる。
        $handEvaluator = new HandEvaluator($rule);
        $hand = $handEvaluator->getHand($cards);
        return $hand;
    }

    private function getRule() {
        if ($this->ruleType === 'A') {
            return new RuleA();
        }
 
        if ($this->ruleType === 'B') {
            return new RuleB();
        } 
    }
}