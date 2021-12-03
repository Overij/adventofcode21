<?php

/**
 * @link https://adventofcode.com/2021/day/3
 */

$inputs = file('input/d3.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

function reduce(array $array, int $criteria) : int
{
    $pos = 0;
    while (count($array) > 1)
    {
        $bitsByPos = array_map(fn($row) => $row[$pos], $array);
        $count = array_count_values($bitsByPos);
        $toKeep = ($count[1] >= $count[0]) ? $criteria : (int) !$criteria;
        $array = array_filter($array, fn($val) => $val[$pos] == $toKeep);
        $pos++;
    }
    return bindec(array_shift($array));
}

echo reduce($inputs, 1) * reduce($inputs, 0) . \PHP_EOL;
