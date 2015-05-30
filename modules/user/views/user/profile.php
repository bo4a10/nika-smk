<?php
use app\commons\Url;
use app\modules\user\forms\SignupForm;
use dosamigos\fileupload\FileUpload;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/** @var SignupForm $modelForm */

$this->title = Yii::t('main', 'Страница профиля');
$errors = $modelForm->getErrors();
?>
<div class="row">
    <?php $form = ActiveForm::begin([
        'id' => 'signup-form',
        'options' => [
            'role' => 'form',
            'enctype' => 'multipart/form-data'
        ],
        'enableClientValidation' => false,
        'enableAjaxValidation' => false,
        'validateOnChange' => false,
        'validateOnSubmit' => false,
        'validateOnBlur' => false,
        'validateOnType' => false,
    ]); ?>

    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><?php echo Yii::t('main', 'Данные пользователя'); ?></h3>
            </div>
            <div class="box-body">
                <div class="form-group <?php if (array_key_exists('email', $errors)) {
                    echo 'has-error';
                } ?>">
                    <label class="control-label">
                        <?php if (array_key_exists('email', $errors)): ?>
                            <i class="fa fa-times-circle-o"></i>
                            <?php echo $errors['email'][0]; ?>
                        <?php else: ?>
                            <?php echo Yii::t('main', 'E-Mail'); ?>
                        <?php endif; ?>
                    </label>
                    <?php echo Html::activeTextInput($modelForm, 'email', [
                        'class' => 'form-control',
                        'placeholder' => Yii::t('main', 'E-Mail')
                    ]) ?>
                </div>
                <div class="form-group <?php if (array_key_exists('full_name', $errors)) {
                    echo 'has-error';
                } ?>">
                    <label class="control-label">
                        <?php if (array_key_exists('full_name', $errors)): ?>
                            <i class="fa fa-times-circle-o"></i>
                            <?php echo $errors['full_name'][0]; ?>
                        <?php else: ?>
                            <?php echo Yii::t('main', 'ФИО'); ?>
                        <?php endif; ?>
                    </label>
                    <?php echo Html::activeTextInput($modelForm, 'full_name', [
                        'class' => 'form-control',
                        'placeholder' => Yii::t('main', 'ФИО')
                    ]) ?>
                </div>
                <div class="form-group <?php if (array_key_exists('position', $errors)) {
                    echo 'has-error';
                } ?>">
                    <label class="control-label">
                        <?php if (array_key_exists('position', $errors)): ?>
                            <i class="fa fa-times-circle-o"></i>
                            <?php echo $errors['position'][0]; ?>
                        <?php else: ?>
                            <?php echo Yii::t('main', 'Должность'); ?>
                        <?php endif; ?>
                    </label>
                    <?php echo Html::activeTextInput($modelForm, 'position', [
                        'class' => 'form-control',
                        'placeholder' => Yii::t('main', 'Должность')
                    ]) ?>
                </div>
                <div class="form-group <?php if (array_key_exists('phone', $errors)) {
                    echo 'has-error';
                } ?>">
                    <label class="control-label">
                        <?php if (array_key_exists('phone', $errors)): ?>
                            <i class="fa fa-times-circle-o"></i>
                            <?php echo $errors['phone'][0]; ?>
                        <?php else: ?>
                            <?php echo Yii::t('main', 'Телефон'); ?>
                        <?php endif; ?>
                    </label>
                    <?php
                    echo MaskedInput::widget([
                        'name' => 'SignupForm[phone]',
                        'mask' => '999999999999',
                        'value' => $modelForm->getPhone(),
                        'options' => [
                            'class' => 'form-control',
                        ]
                    ]);
                    ?>
                </div>
                <div class="form-group <?php if (array_key_exists('skype', $errors)) {
                    echo 'has-error';
                } ?>">
                    <label class="control-label">
                        <?php if (array_key_exists('skype', $errors)): ?>
                            <i class="fa fa-times-circle-o"></i>
                            <?php echo $errors['skype'][0]; ?>
                        <?php else: ?>
                            <?php echo Yii::t('main', 'Скайп'); ?>
                        <?php endif; ?>
                    </label>
                    <?php echo Html::activeTextInput($modelForm, 'skype', [
                        'class' => 'form-control',
                        'placeholder' => Yii::t('main', 'Скайп')
                    ]) ?>
                </div>
                <div class="box-footer">
                    <?php echo Html::submitButton(Yii::t('main', 'Сохранить'), [
                        'class' => 'btn btn-primary',
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 signup-form-access">
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title"><?php echo Yii::t('main', 'Фото'); ?></h3>
            </div>
            <div class="box-body">
                <div class="form-group <?php if (array_key_exists('photo', $errors)) {
                    echo 'has-error';
                } ?>">
                    <label class="control-label">
                        <?php if (array_key_exists('photo', $errors)): ?>
                            <i class="fa fa-times-circle-o"></i>
                            <?php echo $errors['photo'][0]; ?>
                        <?php endif; ?>
                    </label>
                    <?php echo FileUpload::widget([
                        'model'         => $modelForm,
                        'id' => 'file-input',
                        'attribute'     => 'file',
                        'url'           => ['/main/file/upload-image'],
                        'options'       => [
                            'multiple' => false,
                            'class'    => 'add_photo_input',
                        ],
                        'clientOptions' => [
                            'maxNumberOfFiles' => Yii::$app->params['files']['maxFiles'],
                            'dataType'         => 'json',
                            'success'          => new JsExpression('function(e, data) {
                                $("#photo").attr("src", e.filePath);
                                $("#avatar").val(e.filePath);
                                $("#signupform-file").val(e.filePath);
                                $("#file-input").val(e.filePath);
                            }'),
                            'error'            => new JsExpression('function(e, data) {
                                    alert(e.responseText.replace("Error:",  "").trim());
                            }'),
                        ]
                    ]); ?>

                    <a href="javascript:void(0)" class="btn btn-block btn-info add_photo_button"><?php echo Yii::t('main', 'Загрузить фото'); ?></a>

                    <?php echo Html::img($modelForm->getPhoto(), [
                        'id' => 'photo',
                        'class' => 'avatar',
                    ]); ?>
                    <?php echo Html::activeHiddenInput($modelForm, 'photo', [
                        'id' => 'avatar'
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>