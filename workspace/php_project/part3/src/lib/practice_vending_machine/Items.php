<?php
// 名前を選択したら名前と金額を返す
abstract class Items
{
  public function __construct(public string $name)
  {
  }

    abstract public function getName();
    abstract public function getPrice();
    abstract public function getCup();
}