<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\handbook\models\MeasureUnit */

$this->title = 'Добавить единицу измерения';
$this->params['breadcrumbs'][] = ['label' => 'Единицы измерения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="measure-unit-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
