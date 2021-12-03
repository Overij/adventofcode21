<?php

$inputs = file('input/d3.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$bitsByPos = [];

for ($i = 0; $i < strlen($inputs[0]); $i++)
{
    $bitsByPos[] = array_map(fn($row) => $row[$i], $inputs);
}

$gamma = implode('', array_map(function ($bits)
{
    $count = array_count_values($bits);
    return ($count[0] > $count[1]) ? 0 : 1;
}, $bitsByPos));

echo bindec($gamma) * (bindec($gamma) ^ bindec(str_repeat('1', strlen($gamma)))) . \PHP_EOL;
