<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\indicators\models\IndicatorValue */

$this->title = 'Добавить значение показателя для футболного клуба';
$this->params['breadcrumbs'][] = ['label' => 'Показатели ФК', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="indicator-value-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
