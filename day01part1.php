<?php

/**
 * @link https://adventofcode.com/2021/day/1
 */

$inputs = file('input/d1.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$prev = 0;
$count = 0;

foreach ($inputs as $line)
{
    $count += ((int) $line > $prev) ? 1 : 0;
    $prev = (int) $line;
}

echo $count - 1 .\PHP_EOL;
