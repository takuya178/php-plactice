<?php

$a = [1, 1, 3, 4];

$b = array_chunk($a, 2);

foreach ($b as $c) {
  var_dump($c[0]);
}