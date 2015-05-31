<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\indicators\models\IndicatorCurrent */

$this->title = 'Добавить значение показателя вашего ФК';
$this->params['breadcrumbs'][] = ['label' => 'Значения показателей ФК', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="indicator-current-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
