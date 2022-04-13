<?php

require_once('Item.php');

class Snack extends Item {
    private const PRICES = [
        'potato' => 150
    ];

    public function getPrice(): int {
        return self::PRICES[$this->name];
    }

    public function getCup(): int {
      return 0;
  }
}