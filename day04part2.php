<?php

/**
 * @link https://adventofcode.com/2021/day/4
 */

class BingoNum
{
    public function __construct(
        public int $value,
        public bool $isMarked = false
    ) {}
}

class Board
{
    private array $numbers = [];
    private bool $bingo = false;

    public function add(array $row) : void
    {
        $this->numbers[] = $row;
    }

    public function mark(int $drawn) : void
    {
        /** @var BingoNum $num */
        foreach (new RecursiveIteratorIterator(new RecursiveArrayIterator($this->numbers, RecursiveArrayIterator::CHILD_ARRAYS_ONLY)) as $num)
        {
            if ($num->value == $drawn)
            {
                $num->isMarked = true;
                break;
            }
        }
    }

    public function check() : bool
    {
        for ($i = 0; $i < count($this->numbers); $i++)
        {
            if (count(array_filter($this->numbers[$i], fn(BingoNum $num) => $num->isMarked)) == 5 ||
                count(array_filter(array_column($this->numbers, $i), fn(BingoNum $num) => $num->isMarked)) == 5)
            {
                $this->bingo = true;
                return true;
            }
        }
        return false;
    }

    public function sum() : int
    {
        $sum = 0;
        foreach (new RecursiveIteratorIterator(new RecursiveArrayIterator($this->numbers, RecursiveArrayIterator::CHILD_ARRAYS_ONLY)) as $num)
        {
            /** @var BingoNum $num */
            if (!$num->isMarked)
            {
                $sum += $num->value;
            }
        }
        return $sum;
    }

    public function hadBingo() : bool
    {
        return $this->bingo;
    }
}

$inputs = file('input/d4.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$drawnNumbers = explode(',', array_shift($inputs));
$boards = [];

foreach (array_chunk($inputs, 5) as $chunk)
{
    $board = new Board();
    foreach ($chunk as $line)
    {
        $board->add(array_map(fn($x) => new BingoNum((int) $x), preg_split('/\s+/', trim($line))));
    }
    $boards[] = $board;
}

$scores = [];
foreach ($drawnNumbers as $drawnNum)
{
    foreach ($boards as $board)
    {
        /** @var Board $board */
        $board->mark((int) $drawnNum);
        if (!$board->hadBingo() && $board->check())
        {
            $scores[] = $drawnNum * $board->sum();
        }
    }
}

echo $scores[count($scores) - 1] . \PHP_EOL;
