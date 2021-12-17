<?php

/**
 * @link https://adventofcode.com/2021/day/9
 */

$inputs = file('input/d9.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$grid = array_merge(
    [array_fill(0, strlen($inputs[0]) + 2, null)],
    array_map(fn ($x) => [null, ...str_split($x), null], $inputs),
    [array_fill(0, strlen($inputs[0]) + 2, null)]
);

$lowpoints = [];

for ($i = 1; $i < count($grid) - 1; $i++)
{
    for ($j = 1; $j < count($grid[$i]) - 1; $j++)
    {
        $heights = array_filter([
                                $grid[$i - 1][$j],
            $grid[$i][$j - 1],  $grid[$i][$j],      $grid[$i][$j + 1],
                                $grid[$i + 1][$j]
        ], fn($x) => $x !== null);

        if (array_count_values($heights)[$grid[$i][$j]] == 1 &&
            min($heights) == $grid[$i][$j])
        {
            $lowpoints[] = $grid[$i][$j];
        }
    }
}

echo array_sum(array_map(fn($x) => $x + 1, $lowpoints)) . \PHP_EOL;
