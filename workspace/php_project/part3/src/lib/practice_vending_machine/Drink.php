<?php

require_once('Items.php');

class Drink extends Items
{
    private const DRINK_ITEM = [
      'cider' => 100,
      'cola' => 150
    ];

    public function __construct(public string $name)
    {
        parent::__construct($name);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return self::DRINK_ITEM[$this->name];
    }

    public function getCup(): int
    {
        return 0;
    }
}
