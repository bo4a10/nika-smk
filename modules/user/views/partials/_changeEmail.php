<?php
use app\modules\user\forms\ChangeEmailForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var ChangeEmailForm $changeEmailForm */
?>

<div class="tabs_block" id="tab2">
	<div class="lk_form">
		<?php $form = ActiveForm::begin([
			'id'                     => 'changeEmail-form',
			'action'                 => Url::to('/' . \app\commons\Lang::getCurrent()->getUrl() . '/user/personal/change-email'),
			'options'                => [
				'class' => 'clearfix'
			],
			'enableClientValidation' => false,
			'enableAjaxValidation'   => false,
			'validateOnChange'       => false,
			'validateOnSubmit'       => false,
			'validateOnBlur'         => false,
			'validateOnType'         => false,
		]); ?>
		<div class="form_input_wrap">
			<div class="form_input_label">
				<?php echo Yii::t('main', 'Нынешний адрес'); ?>
			</div>
			<div class="input_wrap ">
				<?php echo Html::activeTextInput($changeEmailForm, 'oldEmail', [
					'class' => 'input',
				]) ?>
				<span id="error_oldEmail" class="input_error changeEmail-error"></span>
			</div>
		</div>
		<div class="form_input_wrap">
			<div class="form_input_label">
				<?php echo Yii::t('main', 'Новый адрес'); ?>
			</div>
			<div class="input_wrap ">
				<?php echo Html::activeTextInput($changeEmailForm, 'email', [
					'class' => 'input',
				]) ?>
				<span id="error_email" class="input_error changeEmail-error"></span>
			</div>
		</div>
		<div class="form_input_wrap">
			<div class="form_input_label">
				<?php echo Yii::t('main', 'Подтвердить адрес'); ?>
			</div>
			<div class="input_wrap ">
				<?php echo Html::activeTextInput($changeEmailForm, 'emailRepeat', [
					'class' => 'input',
				]) ?>
				<span id="error_emailRepeat" class="input_error changeEmail-error"></span>
			</div>
		</div>

		<?php echo Html::submitButton(Yii::t('main', 'Сохранить'), [
			'class' => 'submit changeEmail-event',
			'id'    => 'submitChangeEmail',
		]); ?>

		<img id="loadingChangeEmail" src="images/icons/loader.gif" style="float: right; display: none">

		<?php ActiveForm::end(); ?>
	</div>

</div>