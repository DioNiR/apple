<?php

namespace common\components\domain\helpers;

use common\models\Apple;

class AppleHelper
{
    public static function generateApple(?string $color = null): bool
    {
        $apple = new Apple();
        $apple->status = Apple::STATUS_TREE;
        $apple->color = $color ?? Apple::getColors()[array_rand(Apple::getColors())];

        return $apple->save();
    }

    public static function getTranslateColors(): array
    {
        $colors = [];
        foreach (Apple::getColors() as $color) {
            $colors[$color] = \Yii::t("app", "color_" . $color);
        }

        return $colors;
    }
}