<?php

$inputs = file('input/d3.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$oxygen = $co2 = $inputs;
$pos = 0;

while (count($oxygen) > 1)
{
    $bitsByPos = array_map(fn($row) => $row[$pos], $oxygen);
    $count = array_count_values($bitsByPos);
    $toKeep = ($count[1] >= $count[0]) ? 1 : 0;
    $oxygen = array_filter($oxygen, fn($val) => $val[$pos] == $toKeep);
    $pos++;
}

$pos = 0;

while (count($co2) > 1)
{
    $bitsByPos = array_map(fn($row) => $row[$pos], $co2);
    $count = array_count_values($bitsByPos);
    $toKeep = ($count[1] >= $count[0]) ? 0 : 1;
    $co2 = array_filter($co2, fn($val) => $val[$pos] == $toKeep);
    $pos++;
}

echo bindec(array_shift($oxygen)) * bindec(array_shift($co2)) . \PHP_EOL;
