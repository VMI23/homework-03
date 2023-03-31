<?php

$board = [[]];

function addGameElements(string $name, int $price): stdClass
{
    $gameSymbols = new stdClass();
    $gameSymbols->name = $name;
    $gameSymbols->price = $price;
    return $gameSymbols;
}

$gameSymbols = [
    0 => addGameElements("A", 5),
    1 => addGameElements("K", 4),
    2 => addGameElements("Q", 3),
    3 => addGameElements("J", 2),
    4 => addGameElements("10", 1)
];

$winningLines = [
    [[0, 0], [1, 1], [2, 2]],
    [[0, 0], [0, 1], [0, 2]],
    [[1, 0], [1, 1], [1, 2]],
    [[2, 0], [2, 1], [2, 2]],
    [[2, 0], [1, 1], [0, 2]]
];

$deposit = readline("Add your cash! ");

$playAgain = true;

while ($playAgain) {
    if ($deposit <= 0) {
        echo "You're out of money.\n";
        break;
    }

    // create random elements on board
    for ($row = 0; $row < 3; $row++) {
        for ($i = 0; $i < 3; $i++) {
            $board[$row][$i] = $gameSymbols[rand(0, 4)];
        }
    }

    echo "Your deposit is " . $deposit . "\n";

    $spin = readline("Spin? (y/n) ");

    if ($spin === "y") {
        $playAgain = true;
    } else {
        $playAgain = false;
    }

    $deposit -= 1;

    // display board
    foreach ($board as $row) {
        foreach ($row as $element) {
            echo " - ";
            echo $element->name . " ";
            echo " - ";
        }
        echo "\n";
    }

    $lineOfVal = [];

    foreach ($winningLines as $line) {

        foreach ($line as $coord) {
            $row = $coord[0];
            $col = $coord[1];
            $lineOfVal[] = $board[$row][$col];
        }
    }

    $lines = array_chunk($lineOfVal, 3);

    for ($i = 0; $i < count($lines); $i++) {
        if (count(array_unique(array_column($lines[$i], 'name'))) === 1) {
            echo "We got a line! of symbol(s): " . $lines[$i][0]->name;
            echo PHP_EOL;
            $deposit += (int)$lines[$i][0]->price;
        }
    }
}
