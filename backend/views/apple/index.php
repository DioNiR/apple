<?php

/* @var $this yii\web\View */

/* @var $dataProvider yii\data\ActiveDataProvider */

/* @var $model \backend\models\AppleGenerateForm */

use common\models\Apple;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = Yii::t("app", "Apples");
?>
<div class="site-index">

    <div class="body-content">
        <?php echo $this->render("_form", ['model' => $model]); ?>

        <hr>

        <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'layout' => "{items}",
                'pager' => [
                    'options' => [],
                    'firstPageCssClass' => 'first',
                    'lastPageCssClass' => 'last',
                    'prevPageCssClass' => 'prev',
                    'nextPageCssClass' => 'next',
                    'activePageCssClass' => 'active'
                ],
                'rowOptions' => function (Apple $apple) {
                    return ['class' => 'table-' . \common\components\domain\helpers\GridViewHelper::AppleColorToBootstrapTableColor($apple->color)];
                },
                'columns' => [
                    [
                        'attribute' => 'id',
                        'content' => function (Apple $apple) {
                            return $apple->id;
                        },
                    ],
                    [
                        'attribute' => 'apple',
                        'content' => function (Apple $apple) {
                            return sprintf("%s: %s<br/>%s: %s",
                                Yii::t("app", "Color"),
                                Yii::t("app", "color_" . $apple->color),
                                Yii::t("app", "Integrity"),
                                round($apple->size, 2),
                            );
                        }
                    ],
                    [
                        'attribute' => 'status',
                        'content' => function (Apple $apple) {
                            return Yii::t("app", "status_" . $apple->status);
                        }
                    ],
                    [
                        "class" => ActionColumn::class,
                        "template" => Html::beginForm(['apple/update'], '', ['class' => 'row', 'form' => 'AppleUpdateIntegrityForm'])
                            . '<div class="input-group mb-3">{drop}{delete}{size}' . '</div>'
                            . Html::endForm(),
                        "headerOptions" => ['style' => "width: 40%"],
                        "buttons" => [
                            "drop" => function ($url, Apple $apple, $key) {
                                if ($apple->status != Apple::STATUS_TREE) {
                                    return "";
                                }

                                return Html::a(Yii::t('app', 'Drop'), ['drop', 'id' => $apple->id], [
                                    'class' => 'btn btn-success',
                                ]);
                            },
                            "delete" => function ($url, Apple $apple, $key) {
                                return Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $apple->id], [
                                    'class' => 'btn btn-danger',
                                ]);
                            },
                            "size" => function ($url, Apple $apple, $key) {
                                if ($apple->status != Apple::STATUS_DROP) {
                                    return "";
                                }

                                if ($apple->size == 0) {
                                    return "";
                                }

                                return Html::textInput("AppleUpdateSizeForm[percent]", "", [
                                        'class' => 'form-control text-primary',
                                    ])
                                    . Html::hiddenInput("AppleUpdateSizeForm[id]", $apple->id)
                                    . Html::button(Yii::t('app', 'Eat'), [
                                        'class' => 'btn btn-primary',
                                        'name' => 'AppleUpdateSizeForm[submit]',
                                        'type' => 'submit'
                                    ]);
                            },
                        ]
                    ],
                ]
            ]
        ); ?>
    </div>
</div>
