<?php

const FIRST_ONION_DISCOUNT_NUMBER = 3;
const FIRST_ONION_DISCOUNT_PRICE = 50;
const SECOND_ONION_DISCOUNT_NUMBER = 5;
const SECOND_ONION_DISCOUNT_PRICE = 100;

const SET_DISCOUNT_PRICE = 20;

const BENTO_DISCOUNT_START_TIME = '20:00';

const TAX = 10;
const PRICES = [
    1 => ['price' => 100, 'type' => ''],
    2 => ['price' => 150, 'type' => ''],
    3 => ['price' => 200, 'type' => ''],
    4 => ['price' => 350, 'type' => ''],
    5 => ['price' => 180, 'type' => 'drink'],
    6 => ['price' => 220, 'type' => ''],
    7 => ['price' => 440, 'type' => 'bento'],
    8 => ['price' => 380, 'type' => 'bento'],
    9 => ['price' => 80, 'type' => 'drink'],
    10 => ['price' => 100, 'type' => 'drink'],
];

function calc(string $time, array $items): int
{
    $totalAmount = 0;
    $bentoAmount = 0;
    $drink = 0;
    $bento = 0;
    foreach ($items as $item) {
        $totalAmount += PRICES[$item]['price'];
        if (PRICES[$item]['type'] === 'drink') {
            $drink++;
        }

        if (PRICES[$item]['type'] === 'bento') {
            $bento++;
            $bentoAmount += PRICES[$item]['price'];
        }
    }

    $totalAmount -= discountOnion(array_count_values($items)[1]);
    $totalAmount -= discountSet($drink, $bento);
    $totalAmount -= discountBento($time, $bentoAmount);

    return (int) $totalAmount * (100 + TAX) / 100;
}

function discountOnion(int $number): int
{
    $discount = 0;
    if ($number >= SECOND_ONION_DISCOUNT_NUMBER) {
        $discount = SECOND_ONION_DISCOUNT_PRICE;
    } elseif ($number >= FIRST_ONION_DISCOUNT_NUMBER) {
        $discount = FIRST_ONION_DISCOUNT_PRICE;
    }

    return $discount;
}

function discountSet(int $drinkNumber, int $bentoNumber): int
{
    return SET_DISCOUNT_PRICE * min([$drinkNumber, $bentoNumber]);
}

function discountBento(string $time, int $bentoAmount): int
{
    if (strtotime(BENTO_DISCOUNT_START_TIME) > strtotime($time)) {
        return 0;
    }

    return (int) $bentoAmount / 2;
}