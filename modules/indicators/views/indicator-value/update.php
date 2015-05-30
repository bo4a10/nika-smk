<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\indicators\models\IndicatorValue */

$this->title = 'Редактировать значение: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Показатели ФК', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="indicator-value-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
