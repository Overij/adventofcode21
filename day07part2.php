<?php

/**
 * @link https://adventofcode.com/2021/day/7
 */

$inputs = file('input/d7.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$crabs = explode(',', array_shift($inputs));

function fuel(int $from, int $to) : int
{
    if ($from - $to == 0)
    {
        return 0;
    }
    return array_sum(range(1, abs($from - $to)));
}

$fuels = [];
for ($i = min($crabs); $i < max($crabs) + 1; $i++)
{
    $fuels[$i] = array_sum(array_map(fn ($x) => fuel($x, $i), $crabs));
}

echo min($fuels) . \PHP_EOL;
