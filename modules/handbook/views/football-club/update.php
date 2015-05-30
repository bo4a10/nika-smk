<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\handbook\models\FootballClub */

$this->title = 'Редактировать футбольный клуб: ' . ' ' . $model->fc_name;
$this->params['breadcrumbs'][] = ['label' => 'Футбольные клубы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="football-club-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
