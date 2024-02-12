<?php
//** Так делать низя :) */
use common\models\Apple;

$apple = new Apple('green');
echo $apple->color; // green

echo PHP_EOL;

try {
    $apple->eat(50);  // Бросить исключение - Съесть нельзя, яблоко на дереве
} catch (\Exception $exception) {
    echo $exception->getMessage();
}
echo PHP_EOL;

echo $apple->size; // 1 - decimal

echo PHP_EOL;

$apple->fallToGround(); // упасть на землю
$apple->eat(25); // откусить четверть яблока
echo $apple->size; // 0,75
