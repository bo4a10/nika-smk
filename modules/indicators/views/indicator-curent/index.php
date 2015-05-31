<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\indicators\models\IndicatorCurrentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Показатели вашего клуба';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="indicator-current-index">

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'indicator_name',
            'date',
            'value',
            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
    ]); ?>

</div>
