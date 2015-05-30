<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\handbook\models\Indicator */

$this->title = 'Добавить показатель эффективности';
$this->params['breadcrumbs'][] = ['label' => 'Показатели эффективности', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="indicator-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
