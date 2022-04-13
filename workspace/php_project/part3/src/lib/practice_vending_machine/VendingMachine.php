<?php

require_once('Items.php');
require_once('Drink.php');
require_once('CupDrink.php');

class VendingMachine
{
    private int $currentCoin = 0;
    private int $currentCup = 0;
    private const MAX_CUP = 100;

    public function depositCoin(int $coin): int
    {
        if ($coin === 100) {
            $this->currentCoin += $coin;
        }
        return $this->currentCoin;
    }

    public function pressButton(Items $item): string
    {
        // ボタンを押すとカップが減る
        $cupNumber = $item->getCup();
        if ($this->currentCoin >= $item->getPrice() && $this->currentCup >= $cupNumber) {
            $this->currentCoin -= $item->getPrice();
            $this->currentCup -= $item->getCup();
            return $item->getName();
        } else {
            return '';
        }
    }

    // カップを補充する関数
    public function addCup($cup): int
    {
        // $cupNumber = $this->currentCup + $cup;
        $this->currentCup += $cup;

        if ($this->currentCup > self::MAX_CUP) {
            $this->currentCup = self::MAX_CUP;
        }
        // $this->currentCup = $cupNumber;
        return $this->currentCup;
    }
}