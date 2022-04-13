<?php

require_once('Item.php');

class Drink extends Item {
    private const PRICES = [
        'cider' => 100,
        'cola' => 150,
    ];

    public function __construct(string $name)
    {
        parent::__construct($name);
    }

    public function getPrice(): int {
        return self::PRICES[$this->name];
    }

    public function getCup(): int {
        return 0;
    }
}