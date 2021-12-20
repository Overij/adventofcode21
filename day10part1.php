<?php

/**
 * @link https://adventofcode.com/2021/day/10
 */

$inputs = file('input/d10.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$pairs = [ ')' => '(', ']' => '[', '}' => '{', '>' => '<' ];
$opening = array_values($pairs);
$stack = new SplStack();
$errors = array_fill_keys(array_keys($pairs), 0);

foreach ($inputs as $line)
{
    foreach (str_split($line) as $char)
    {
        if (in_array($char, $opening))
        {
            $stack->push($char);
        }
        elseif ($stack->pop() !== $pairs[$char])
        {
            $errors[$char]++;
            break;
        }
    }
}

echo $errors[')'] * 3 + $errors[']'] * 57 + $errors['}'] * 1197 + $errors['>'] * 25137 . \PHP_EOL;
