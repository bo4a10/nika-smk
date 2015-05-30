<?php
use app\modules\user\forms\ResetPasswordForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var ResetPasswordForm $resetPasswordForm */
?>

<div class="tabs_block" id="tab3">
	<div class="lk_form">
		<?php $form = ActiveForm::begin([
			'id'                     => 'resetPassword-form',
			'action'                 => Url::to('/' . \app\commons\Lang::getCurrent()->getUrl() . '/user/personal/reset-password'),
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
					<?php echo Yii::t('main', 'Нынешний пароль'); ?>
				</div>
				<div class="input_wrap ">
					<?php echo Html::activePasswordInput($resetPasswordForm, 'oldPassword', [
						'class' => 'input',
					]) ?>
					<span id="error_oldPassword" class="input_error resetPassword-error"></span>
				</div>
			</div>
			<div class="form_input_wrap">
				<div class="form_input_label">
					<?php echo Yii::t('main', 'Новый пароль'); ?>
				</div>
				<div class="input_wrap ">
					<?php echo Html::activePasswordInput($resetPasswordForm, 'password', [
						'class' => 'input',
					]) ?>
					<span id="error_password" class="input_error resetPassword-error"></span>
				</div>
			</div>
			<div class="form_input_wrap">
				<div class="form_input_label">
					<?php echo Yii::t('main', 'Подтвердите пароль'); ?>
				</div>
				<div class="input_wrap ">
					<?php echo Html::activePasswordInput($resetPasswordForm, 'passwordRepeat', [
						'class' => 'input',
					]) ?>
					<span id="error_passwordRepeat" class="input_error resetPassword-error"></span>
				</div>
			</div>

			<?php echo Html::submitButton(Yii::t('main', 'Сохранить'), [
				'class' => 'submit resetPassword-event',
				'id'    => 'submitResetPassword',
			]); ?>

			<img id="loadingResetPassword" src="images/icons/loader.gif" style="float: right; display: none">
		<?php ActiveForm::end(); ?>
	</div>

</div>