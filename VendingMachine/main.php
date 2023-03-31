<?php

function addProducts(string $name, int $price): stdClass
{
    $products = new stdClass();
    $products->name = $name;
    $products->price = $price;
    return $products;
}

$coins = [
    200, 100, 50, 20, 10, 5, 2, 1
];

$products = [
    1 => addProducts("Coffee (XL)", 280),
    2 => addProducts("Coffee (L)", 190),
    3 => addProducts("Hot Chocolate", 175),
    4 => addProducts("Tea", 175)
];

foreach ($products as $key => $product) {
    echo $key . " " . $product->name . "|   Price: " . $product->price;
    echo PHP_EOL;
}


$selection = strtolower(readline("Please select your drink!(1-4) "));

$deposit = 0;

while ($deposit < $products[$selection]->price) {
    echo "Your selection is: " . $products[$selection]->name . " Price:" . $products[$selection]->price;
    echo PHP_EOL;

    echo "Your deposit is: " . $deposit;
    echo PHP_EOL;
    $insertedCoins = readline("Enter your coin: ");


    if (!in_array($insertedCoins, $coins)) {
        echo "invalid coin";
        echo PHP_EOL;
    } else {
        $deposit += (int) $insertedCoins;
    }

}

echo PHP_EOL;

echo "Your total deposit was $deposit and " . "Reminder is: " . $reminder = $deposit - ($products[$selection]->price);
echo PHP_EOL;
echo "Take your change: ";
foreach ($coins as $coin) {
    $times = floor($reminder / $coin);
    if ($times > 0) {
        echo "Coin:" . $coin . " Times " . $times;
        echo PHP_EOL;
    }

    $reminder -= $coin * $times;

}