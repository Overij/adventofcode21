<?php

/**
 * @link https://adventofcode.com/2021/day/6
 */

$inputs = file('input/d6.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$timers = explode(',', array_shift($inputs));

for ($i = 0; $i < 80; $i++)
{
    $count = count($timers);
    for ($j = 0; $j < $count; $j++)
    {
        if ($timers[$j] == 0)
        {
            $timers[$j] = 6;
            $timers[] = 8;
        }
        else
        {
            $timers[$j]--;
        }
    }
}

echo count($timers) . \PHP_EOL;
