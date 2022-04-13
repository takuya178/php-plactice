<?php

require_once('Items.php');

class CupDrink extends Items
{
    private const CUP_DRINK_ITEM = [
      'hot cup coffee' => 100,
      'ice cup coffee' => 100
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
        return self::CUP_DRINK_ITEM[$this->name];
    }

    public function getCup(): int
    {
        return 1;
    }
}