<?php

$inputs = file('input/d1.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$sums = [];

array_walk($inputs,
    function($val, $key) use ($inputs, &$sums)
    {
        if (array_key_exists($key + 2, $inputs))
        {
            $sums[] = $val + $inputs[$key + 1] + $inputs[$key + 2];
        }
    }
);

$prev = 0;
$count = 0;

foreach ($sums as $sum)
{
    $count += ($sum > $prev) ? 1 : 0;
    $prev = $sum;
}

echo $count - 1 .\PHP_EOL;
