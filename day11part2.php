<?php

/**
 * @link https://adventofcode.com/2021/day/11
 */

$inputs = file('input/d11.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$grid = array_merge(
    [array_fill(0, strlen($inputs[0]) + 2, null)],
    array_map(fn ($x) => [null, ...str_split($x), null], $inputs),
    [array_fill(0, strlen($inputs[0]) + 2, null)]
);

function flash(int $x, int $y, array &$grid, array &$flashes) : void
{
    if (in_array([$x, $y], $flashes))
    {
        return;
    }

    $flashes[] = [$x, $y];

    foreach (adjacent($x, $y) as [$x1, $y1])
    {
        if ($grid[$y1][$x1] !== null)
        {
            $grid[$y1][$x1]++;
            if ($grid[$y1][$x1] > 9)
            {
                flash($x1, $y1, $grid, $flashes);
            }
        }
    }
}

function adjacent(int $x, int $y) : array
{
    return [
        [$x - 1, $y - 1], [$x, $y - 1], [$x + 1, $y - 1], 
        [$x - 1, $y],                   [$x + 1, $y], 
        [$x - 1, $y + 1], [$x, $y + 1], [$x + 1, $y + 1], 
    ];
}

$flashCounter = 0;

for ($step = 0; $step < \PHP_INT_MAX; $step++)
{
    $flashes = [];

    for ($i = 1; $i < count($grid) - 1; $i++)
    {
        for ($j = 1; $j < count($grid[$i]) - 1; $j++)
        {
            $grid[$i][$j]++;
        }
    }

    for ($i = 1; $i < count($grid) - 1; $i++)
    {
        for ($j = 1; $j < count($grid[$i]) - 1; $j++)
        {
            if ($grid[$i][$j] > 9)
            {
                flash($j, $i, $grid, $flashes);
            }
        }
    }

    for ($i = 1; $i < count($grid) - 1; $i++)
    {
        for ($j = 1; $j < count($grid[$i]) - 1; $j++)
        {
            if ($grid[$i][$j] > 9)
            {
                $grid[$i][$j] = 0;
            }
        }
    }

    if (count($flashes) == 100)
    {
        echo $step + 1 . \PHP_EOL;
        break;
    }
}
