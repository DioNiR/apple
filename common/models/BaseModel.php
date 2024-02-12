<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * @property int $delete
 */
abstract class BaseModel extends ActiveRecord
{
    const BEHAVIOR_TIMESTAMP = 'default_timestamp';

    const NOT_DELETED = '0';
    const DELETED = '1';

    public function behaviors()
    {
        return [
            self::BEHAVIOR_TIMESTAMP => [
                'class'              => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value'              => (new \DateTime())->format('Y-m-d H:i:s')
            ],
        ];
    }
}