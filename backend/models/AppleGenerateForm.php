<?php

namespace backend\models;

use common\components\domain\helpers\AppleHelper;
use yii\base\Model;

class AppleGenerateForm extends Model
{
    /** @var string  */
    public string $color = "";

    public function rules()
    {
        return [
            [['color',], 'required'],
            ['color', 'each', 'rule' => ['in', 'range' => array_merge(['all' => 'all'], AppleHelper::getTranslateColors())]]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'color' => \Yii::t('app', 'Color'),
        ];
    }

    public function do(): bool
    {
        for ($i = 0; $i < Rand(1, 10); $i++) {
            AppleHelper::generateApple($this->color == "all" ? null : $this->color);
        }

        return true;
    }
}