<?php

namespace common\models;

use common\components\domain\exceptions\AppleChangeStatusException;
use common\components\domain\service\AppleChangeSizePercentStatus;
use common\components\domain\service\AppleChangeStatusService;

/**
 * @property int $id
 * @property string|null $status
 * @property float|null $size
 * @property string|null $color
 * @property \DateTime $date_drop
 */
class Apple extends BaseModel
{
    const STATUS_TREE = "tree";
    const STATUS_DROP = "drop";
    const STATUS_ROTTEN = "rotten";

    const COLOR_GREEN = "green";
    const COLOR_RED = "red";
    const COLOR_YELLOW = "yellow";

    /**
     * @param string $color
     */
    public function __construct(string $color = "")
    {
        $this->color = $color;
        $this->size = 1.0;
        $this->status = self::STATUS_TREE;
    }

    /**
     * @throws AppleChangeStatusException
     */
    public function eat($percent)
    {
        $service = new AppleChangeSizePercentStatus($this);
        $service->change($percent);
    }

    public function fallToGround()
    {
        $service = new AppleChangeStatusService($this);
        $service->setDrop();
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'apple' => \Yii::t('app', 'Яблоко'),
            'status' => \Yii::t('app', 'Status'),
        ];
    }

    public static function getColors(): array
    {
        return[
            self::COLOR_GREEN, self::COLOR_RED, self::COLOR_YELLOW
        ];
    }
}