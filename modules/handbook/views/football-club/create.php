<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\handbook\models\FootballClub */

$this->title = 'Добавить футбольный клуб';
$this->params['breadcrumbs'][] = ['label' => 'Футбольный клуб', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="football-club-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
