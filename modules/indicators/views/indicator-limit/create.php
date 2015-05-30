<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\indicators\models\IndicatorLimit */

$this->title = 'Добавить ограничение показателей';
$this->params['breadcrumbs'][] = ['label' => 'Ограничение показателей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="indicator-limit-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
