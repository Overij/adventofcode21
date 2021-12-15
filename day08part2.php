<?php

/**
 * @link https://adventofcode.com/2021/day/8
 */

$inputs = file('input/d8.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

function digit2(array $patterns) : string
{
    $counts = ['a' => 0, 'b' => 0, 'c' => 0, 'd' => 0, 'e' => 0, 'f' => 0, 'g' => 0];
    foreach ($patterns as $pattern)
    {
        foreach (str_split($pattern) as $char)
        {
            $counts[$char]++;
        }
    }
    $segment = array_keys($counts, max($counts))[0];
    return getFirst($patterns, fn($x) => !str_contains($x, $segment));
}

function digit3(array $patterns, string $digit2) : string
{
    foreach ($patterns as $pattern)
    {
        if (strlen($pattern) == 5 && count(array_diff(str_split($digit2), str_split($pattern))) == 1)
        {
            return $pattern;
        }
    }
}

function digit5(array $patterns, string $digit2, string $digit3) : string
{
    foreach ($patterns as $pattern)
    {
        if (strlen($pattern) == 5 && $pattern !== $digit2 && $pattern !== $digit3)
        {
            return $pattern;
        }
    }
}

function digit9(array $patterns, string $digit4) : string
{
    foreach ($patterns as $pattern)
    {
        if (strlen($pattern) == 6 && count(array_diff(str_split($digit4), str_split($pattern))) == 0)
        {
            return $pattern;
        }
    }
}

function digit6(array $patterns, string $digit5, string $digit9) : string
{
    foreach ($patterns as $pattern)
    {
        if (strlen($pattern) == 6 && count(array_diff(str_split($digit5), str_split($pattern))) == 0 && $pattern !== $digit9)
        {
            return $pattern;
        }
    }
}

function getFirst(array $array, ?callable $callback = null) : mixed
{
    if ($callback !== null)
    {
        $array = array_filter($array, $callback);
    }
    return array_shift($array);
}

function sortMap(array $map): array
{
    $new = [];
    foreach ($map as $key => $mapping)
    {
        $parts = str_split($mapping);
        sort($parts);
        $new[$key] = implode('', $parts);
    }
    ksort($new);
    return $new;
}

$sum = 0;
foreach ($inputs as $line)
{
    $parts = explode(' | ', $line);
    $patterns = explode(' ', $parts[0]);
    $values = explode(' ', $parts[1]);
    
    $map = [];
    $map[1] = getFirst($patterns, fn($x) => strlen($x) == 2);   // 1, 4, 7 and 8 by length
    $map[4] = getFirst($patterns, fn($x) => strlen($x) == 4);
    $map[7] = getFirst($patterns, fn($x) => strlen($x) == 3);
    $map[8] = getFirst($patterns, fn($x) => strlen($x) == 7);
    $map[2] = digit2($patterns);                                // Has no 'f' segment
    $map[3] = digit3($patterns, $map[2]);                       // Has 1 different segment from 2
    $map[5] = digit5($patterns, $map[2], $map[3]);              // The remaining segment with length of 5
    $map[9] = digit9($patterns, $map[4]);                       // Shares digit 4's segments with len=6
    $map[6] = digit6($patterns, $map[5], $map[9]);              // Shares 5's segments with len=6 and is not 9
    $map[0] = getFirst(array_diff($patterns, $map));            // Only one remaining

    $map = sortMap($map);
    $values = sortMap($values);

    $display = '';
    foreach ($values as $value)
    {
        $display .= array_keys($map, $value)[0];
    }

    $sum += $display;
}

echo $sum . \PHP_EOL;
