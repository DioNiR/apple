<?php

namespace backend\models;

use common\components\domain\exceptions\AppleChangeStatusException;
use common\components\domain\service\AppleChangeSizePercentStatus;
use common\models\Apple;
use yii\base\Model;
use yii\web\NotFoundHttpException;

class AppleUpdateSizeForm extends Model
{
    public int $id;
    public int $percent;

    public function __construct()
    {

    }

    public function rules()
    {
        return [
            [['id', 'percent'], 'integer'],
        ];
    }

    /**
     * @throws NotFoundHttpException
     * @throws AppleChangeStatusException
     */
    public function do()
    {
        $apple = Apple::findOne($this->id);
        if (!$apple) {
            throw new NotFoundHttpException();
        }

        $service = new AppleChangeSizePercentStatus($apple);
        $service->change($this->percent);

        return true;
    }
}