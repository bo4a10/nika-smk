<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\handbook\models\Stadium */

$this->title = 'Добавить стадион';
$this->params['breadcrumbs'][] = ['label' => 'Стадионы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stadium-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
