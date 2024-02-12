<?php

use yii\bootstrap5\ActiveForm;
use common\components\domain\helpers\AppleHelper;
use yii\helpers\Html;

/* @var $model \backend\models\AppleGenerateForm */
?>
        <div class="row border-1">
            <?php
            $form = ActiveForm::begin([
                'layout' => 'horizontal',
                'action' => ['generate'],
                'id' => 'apple-generate',
                'options' => ['class' => 'form-horizontal'],
            ]) ?>
            <?= $form->field($model, 'color')->dropDownList(array_merge(['all' => 'all'], AppleHelper::getTranslateColors())); ?>
            <?= Html::submitButton(Yii::t("app", "Generate"), ['class' => 'btn btn-primary']) ?>
            <?php ActiveForm::end() ?>
        </div>