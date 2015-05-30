<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\handbook\models\FootballClubSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Футбольные клубы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="football-club-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить футбольный клуб', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'fc_name',
            'city_name',
            'stadium_name',
            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
    ]); ?>

</div>
