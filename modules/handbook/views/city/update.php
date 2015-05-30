<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\handbook\models\City */

$this->title = 'Редактировать город: ' . ' ' . $model->city_name;
$this->params['breadcrumbs'][] = ['label' => 'Города', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="city-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
