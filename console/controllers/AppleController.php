<?php

namespace console\controllers;

use common\components\domain\helpers\AppleHelper;
use common\models\Apple;
use yii\console\Controller;
use yii\helpers\BaseConsole;
use yii\helpers\Console;

class AppleController extends Controller
{
    /**
     * @param int $number
     * @return void
     */
    public function actionGenerate(int $number = 1): void
    {
        for ($i = 0; $i < $number; $i++) {
            AppleHelper::generateApple();
        }
    }

    public function actionTest()
    {
        $apple = new Apple('green');
        $this->stdout($apple->color . PHP_EOL, BaseConsole::BG_RED); // green

        //$apple->eat(50); // Бросить исключение - Съесть нельзя, яблоко на дереве
        $this->stdout($apple->size . PHP_EOL, BaseConsole::BG_RED);

        $apple->fallToGround(); // упасть на землю
        $apple->eat(25); // откусить четверть яблока
        $this->stdout($apple->size . PHP_EOL, BaseConsole::BG_GREEN);

    }
}