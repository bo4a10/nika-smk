<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\handbook\models\MeasureUnit */

$this->title = 'Редактировать единицу измерения: ' . ' ' . $model->unit_name;
$this->params['breadcrumbs'][] = ['label' => 'Measure Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="measure-unit-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
