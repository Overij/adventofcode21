<?php

$inputs = file('input/d2.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$pos = $depth = $aim = 0;

foreach ($inputs as $line)
{
    [$cmd, $value] = explode(' ', $line);

    if ($cmd === 'forward')
    {
        $pos += $value;
        $depth += ($value * $aim);
    }
    else
    {
        $aim += ($cmd === 'up') ? -$value : $value;
    }
}

echo $pos * $depth . \PHP_EOL;
