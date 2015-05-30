<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\handbook\models\Indicator */

$this->title = 'Редактировать показатель эффективности: ' . ' ' . $model->indicator_name;
$this->params['breadcrumbs'][] = ['label' => 'Показатели эффективности', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="indicator-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
