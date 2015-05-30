<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\indicators\models\IndicatorLimit */

$this->title = 'Редактировать ограничение: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ограничение показателей', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="indicator-limit-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
