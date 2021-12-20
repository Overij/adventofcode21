<?php

/**
 * @link https://adventofcode.com/2021/day/10
 */

$inputs = file('input/d10.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$pairs = [ ')' => '(', ']' => '[', '}' => '{', '>' => '<' ];
$opening = array_values($pairs);
$corrupted = [];

foreach ($inputs as $line)
{
    $stack = new SplStack();
    foreach (str_split($line) as $char)
    {
        if (in_array($char, $opening))
        {
            $stack->push($char);
        }
        elseif ($stack->pop() !== $pairs[$char])
        {
            $corrupted[] = $line;
            break;
        }
    }
}

$incomplete = array_diff($inputs, $corrupted);
$scores = [];

foreach ($incomplete as $line)
{
    $stack = new SplStack();
    foreach (str_split($line) as $char)
    {
        if (in_array($char, $opening))
        {
            $stack->push($char);
        }
        else 
        {
            $stack->pop();
        }
    }

    $score = 0;
    $stack->rewind();
    while ($stack->valid())
    {
        $score = $score * 5;
        switch ($stack->current())
        {
            case '(':
                $score += 1; break;
            case '[':
                $score += 2; break;
            case '{':
                $score += 3; break;
            case '<':
                $score += 4; break;
        }
        $stack->next();
    }
    $scores[] = $score;
}

sort($scores);

echo $scores[(int) (count($scores) / 2)] . \PHP_EOL;
