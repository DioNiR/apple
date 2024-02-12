<?php

namespace common\components\domain\helpers;

use common\models\Apple;

class GridViewHelper
{
    /**
     * @param string $color
     * @return string
     */
    public static function AppleColorToBootstrapTableColor(string $color): string
    {
        return match ($color) {
            Apple::COLOR_GREEN => 'success',
            Apple::COLOR_RED => 'danger',
            Apple::COLOR_YELLOW => 'warning',
            default => "",
        };
    }
}