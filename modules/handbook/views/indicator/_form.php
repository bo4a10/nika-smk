<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\handbook\models\Indicator */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="indicator-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'indicator_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'measure_unit_id')->dropDownList(
        $model->getAllMeasureUnit()
    ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
