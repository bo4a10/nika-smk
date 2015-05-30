<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\handbook\models\StadiumSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Стадионы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stadium-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить стадион', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'stadium_name',
            'city_name',

            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}'
            ]
        ],
    ]); ?>

</div>
