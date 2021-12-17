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

function lowpoints(array $grid) : array
{
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
                $lowpoints[] = [$j, $i];
            }
        }
    }
    return $lowpoints;
}

function basin(array $grid, int $x, int $y, array &$visited = []) : array
{
    $visited[] = [$x, $y];
    $adjacent = [
        [$x, $y - 1], [$x, $y + 1],
        [$x - 1, $y], [$x + 1, $y],
    ];
    foreach ($adjacent as $xy)
    {
        [$x1, $y1] = $xy;
        if (in_array($xy, $visited))
        {
            continue;
        }
        if ($grid[$y1][$x1] !== null && $grid[$y1][$x1] != 9)
        {
            basin($grid, $x1, $y1, $visited);
        }
    }
    return $visited;
}

$lowpoints = lowpoints($grid);
$basins = array_map(fn($x) => basin($grid, $x[0], $x[1]), $lowpoints);
usort($basins, fn($a, $b) => count($b) <=> count($a));
$product = array_reduce(array_slice($basins, 0, 3), fn($c, $v) => $c * count($v), 1);

echo $product . \PHP_EOL;
