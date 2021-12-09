<?php

/**
 * @link https://adventofcode.com/2021/day/5
 */

$inputs = file('input/d5.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$points = [];
foreach ($inputs as $line)
{
    $pair = explode(' -> ', $line);
    [$x1, $y1] = explode(',', $pair[0]);
    [$x2, $y2] = explode(',', $pair[1]);

    if ($x1 != $x2 && $y1 != $y2)
    {
        $xs = range($x1, $x2);
        $ys = range($y1, $y2);
        for ($i = 0; $i < count($xs); $i++)
        {
            $points[] = $xs[$i] . ',' . $ys[$i];
        }
    }
    else
    {
        foreach (range($x1, $x2) as $x)
        {
            foreach (range($y1, $y2) as $y)
            {
                $points[] = $x . ',' . $y;
            }
        }
    }
}

$counts = array_count_values($points);
echo count(array_filter($counts, fn($x) => $x > 1)) . \PHP_EOL;
