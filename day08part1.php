<?php

/**
 * @link https://adventofcode.com/2021/day/8
 */

$inputs = file('input/d8.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$count = 0;
foreach ($inputs as $line)
{
    foreach (explode(" ", explode(' | ', $line)[1]) as $output)
    {
        $len = strlen($output);
        switch ($len)
        {
            case 2:
            case 3:
            case 4:
            case 7:
                $count++;
                break;
        }
    }
}

echo $count . \PHP_EOL;
