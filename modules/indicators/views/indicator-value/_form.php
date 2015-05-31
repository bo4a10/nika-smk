<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\modules\indicators\models\IndicatorValue */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="indicator-value-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fc_id')->dropDownList(
        $model->getAllFootballClubs()
    ) ?>

    <?= $form->field($model, 'indicator_id')->dropDownList(
        $model->getAllIndicators()
    ) ?>

    <?= $form->field($model, 'date')->widget(DatePicker::className(), [
        'name' => 'date',
        'value' => $model->date,
        'language' => 'ru-RU',
        'options' => [
            'placeholder' => 'Выберите дату для показателя',
            'language' => 'ru-RU'
        ],
        'pluginOptions' => [
            'language' => 'ru',
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
         ]
    ]); ?>

    <?= $form->field($model, 'value')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
