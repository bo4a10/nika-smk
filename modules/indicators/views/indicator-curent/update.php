<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\indicators\models\IndicatorCurrent */

$this->title = 'Update Indicator Current: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Indicator Currents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="indicator-current-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
