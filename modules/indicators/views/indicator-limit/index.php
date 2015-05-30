<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\indicators\models\IndicatorLimitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ограничения показателей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="indicator-limit-index">

    <p>
        <?= Html::a('Добавить ограничения показателей', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'indicator_name',
            'date',
            'value',
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'type',
                'value' => function($model) {
                    return ($model->type == 0) ? 'Минимальное' : 'Максимальное';
                }
            ],
            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
    ]); ?>

</div>
