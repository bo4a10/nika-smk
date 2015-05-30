<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="group-users-form">
        <?php $form = ActiveForm::begin([
            'enableClientValidation' => false,
            'enableAjaxValidation' => true,
            'validationUrl' => Url::to(['user-group/ajax-validate']),
            'id' => 'user-groups-form',
        ]); ?>
        <div class="col-md-7">
            <?php echo $form
                       ->field($model, 'group_name')
                       ->textInput([
                           'maxlength' => 255,
                           'class'     => 'form-field',
                           'style'     => 'width: 100%'
                       ]); ?>
            <div class="form-group">
                <?php
                echo maksyutin\duallistbox\Widget::widget([
                    'model' => $model,
                    'attribute' => 'listUser',
                    'title' => 'Пользователи',
                    'data' => $users,
                    'data_id' => 'id',
                    'data_value' => 'username',
                    'lngOptions' => [
                        'warning_info' => Yii::t('main', 'Ошибка виджета'),
                        'search_placeholder' => Yii::t('main', 'Фильтр'),
                        'showing' => Yii::t('main', '- показано'),
                        'available' => Yii::t('main', 'Все пользователи'),
                        'selected' => Yii::t('main', 'Пользователи в группе')
                    ]
                ]);
                ?>
                <?php echo Html::hiddenInput('selectedUsers', null, ['id' => 'dev-selected-users']); ?>
                <?php echo Html::hiddenInput('unSelectedUsers', null, ['id' => 'dev-unselected-users']); ?>
            </div>
        </div>
        <div class="col-md-5 group-access-checkbox">
        <?php echo $form->field($model, 'access')->checkboxList(\app\modules\wialon\models\WialonAccess::getGroupAccess(), [
            'itemOptions' => ['class'=>'minimal'],
        ]); ?>
        </div>
        <div class="modal-footer block-center col-md-12">
            <?php echo Html::Button(Yii::t('main', 'Отмена'),
                ['class' => 'btn btn-danger btn-close-modal pull-right show', 'data-dismiss' => 'modal'])
            ?>
            <?php echo Html::submitButton($model->isNewRecord ? Yii::t('main', 'Добавить') : Yii::t('main',
                'Редактировать'),
                ['class' => $model->isNewRecord ? 'btn btn-success pull-left show' : 'btn btn-primary pull-left show'])
            ?>
            <div class="clearfix"></div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
<?php
$script = <<< JS
    $(document).ready(
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        }),

        $('#user-groups-form').on('beforeSubmit', function(event, jqXHR, settings) {
                var form = $(this);
                if(form.find('.has-error').length) {
                        return false;
                }
                // check selected and unselected users
                var selected = $('#user-groups-form select.selected').find('option');
                var unSelected = $('#user-groups-form select.unselected').find('option');
                $('#dev-selected-users').val(getUsers(selected));
                $('#dev-unselected-users').val(getUsers(unSelected));

                $.ajax({
                        url: form.attr('action'),
                        type: 'post',
                        data: form.serialize(),
                        success: function(data) {
                                $('#modal').modal('hide');
                                $.pjax.reload({container:'#container-group'});
                        }
                });

                return false;
        })
    )

        // return array with users id
        var getUsers = function (options) {
            var result = [];
            $.each(options, function(i,v) {
                result.push($(v).val());
            })

            return result;
        }

JS;
$this->registerJs($script, \yii\web\View::POS_END);
