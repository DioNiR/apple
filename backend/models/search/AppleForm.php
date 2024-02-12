<?php

namespace backend\models\search;

use common\models\Apple;
use common\models\BaseModel;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class AppleForm extends Model
{

    /**
     * @param array $data
     * @return ActiveDataProvider
     */
    public function search(array $data = []): ActiveDataProvider
    {
        $query = Apple::find()->where(['=', 'delete', BaseModel::NOT_DELETED]);

        $query->andWhere(
            [
                'OR',
                ['>', 'date_drop', (new \DateTime())->modify('-5 hours')->format('Y-m-d H:i:s')],
                ['IS', 'date_drop', null]
            ]);

        return new ActiveDataProvider(
            [
                "query" => $query,
                "key" => "id",
                'pagination' => [
                    'pageSize' => 50
                ],
                'sort' => [
                    'attributes' => [
                        'id',
                    ],
                    'defaultOrder' => [
                        'id' => SORT_DESC
                    ]
                ],
            ]
        );
    }
}