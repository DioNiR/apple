<?php

namespace common\components\domain\service;

use common\components\domain\exceptions\AppleChangeStatusException;
use common\models\Apple;

class AppleChangeSizePercentStatus
{
    private Apple $apple;

    public function __construct(Apple $apple)
    {
        if ($apple->status != Apple::STATUS_DROP) {
            throw new AppleChangeStatusException(\Yii::t("app", "Apple not in drop"));
        }

        $this->apple = $apple;
    }

    /**
     * @param int $percent
     * @return bool
     * @throws AppleChangeStatusException
     */
    public function change(int $percent): bool
    {
        if (($percent/100) > $this->apple->size) {
            throw new AppleChangeStatusException(\Yii::t("app", "The apple is smaller"));
        }

        $this->apple->size = $this->apple->size-$percent/100;
        return $this->apple->save();
    }
}