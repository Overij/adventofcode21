<?php

/**
 * @link https://adventofcode.com/2021/day/7
 */

$inputs = file('input/d7.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$crabs = explode(',', array_shift($inputs));

function median(array $array) : int|float
{
    sort($array);
    $mid = floor(count($array) / 2);
    return (count($array) & 1) ? $array[$mid] : ($array[$mid - 1] + $array[$mid]) / 2;
}

$median = median($crabs);
$dist = 0;
array_walk($crabs, function ($x) use (&$dist, $median) { $dist += abs($x - $median); });

echo $dist . \PHP_EOL;
