<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\handbook\models\FootballClub */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="football-club-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fc_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city_id')->dropDownList($model->getAllCity()) ?>

    <?= $form->field($model, 'stadium_id')->dropDownList($model->getAllStadium()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
