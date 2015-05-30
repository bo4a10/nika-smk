<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\user\models\UserGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('main', 'Группы пользователей');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row user-groups">
    <div class="user-group-index col-md-4">
        <p>
            <?php echo Html::button(
                Yii::t('main', 'Добавить'),
                [
                    'value' => Url::to(['create']),
                    'title' => Yii::t('main', 'Добавить'),
                    'class' => 'showModalUserGroups btn btn-success'
                ]); ?>
        </p>
<?php \yii\widgets\Pjax::begin([
    'id' => 'container-group'
]) ?>
        <?php echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'group_name',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}',
                    'buttons' => [
                        'update' => function ($url, $model) {
                            $url = Url::to(['update', 'id' => $model->id]);
                            $link = Html::a(
                                '<span class="glyphicon glyphicon-pencil"></span>',
                                Url::toRoute(['update', 'id' => $model->id]),
                                [
                                    'class' => 'update-user-group showModalUserGroups',
                                    'value' => Url::toRoute(['update', 'id' => $model->id]),
                                    'title' => Yii::t('main', 'Редактировать')
                                ]
                            );

                            return $link;
                        },
                        'delete' => function ($url, $model) {
                            $link = Html::a(
                                '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',
                                Url::toRoute(['delete', 'id' => $model->id]),
                                [
                                    'class' => 'btn btn-danger btn-xs grid-trash',
                                    'value' => Url::toRoute(['delete', 'id' => $model->id]),
                                ]
                            );

                            return $link;
                        },
                    ],
                ],
            ],
        ]); ?>
<?php \yii\widgets\Pjax::end() ?>
        <?php yii\bootstrap\Modal::begin([
            'headerOptions' => ['id' => 'modalHeader'],
            'id' => 'modal',
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static', 'keyboard' => true],
        ]);
        echo "<div id='modalContent'></div>";
        yii\bootstrap\Modal::end();
        ?>


    </div>
</div>
<?php $this->registerJsFile('js/user/user-groups.js', ['depends'=>'yii\web\JqueryAsset']); ?>