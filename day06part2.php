<?php

/**
 * @link https://adventofcode.com/2021/day/6
 */

$inputs = file('input/d6.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$timers = explode(',', array_shift($inputs));
$timers = array_count_values($timers) + array_fill(0, 9, 0);
ksort($timers);

for ($i = 0; $i < 256; $i++)
{
    $new = array_shift($timers);
    $timers[] = $new;
    $timers[6] += $new;
}

echo array_sum($timers) . \PHP_EOL;
