<?php
use app\modules\user\forms\LoginForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\commons\Url;

/**@var LoginForm $loginForm */
?>

<p class="login-box-msg"><?php echo 'Авторизуйтесь, чтобы начать работу' ?></p>
<?php $form = ActiveForm::begin([
	'id'                     => 'login-form',
	'enableClientValidation' => false,
	'enableAjaxValidation'   => false,
	'validateOnChange'       => false,
	'validateOnSubmit'       => false,
	'validateOnBlur'         => false,
	'validateOnType'         => false,
]); ?>
	<?php if (!empty($loginForm->getErrors())): ?>
	<div class="form-group has-feedback">
		<span class="input_error"><?php echo 'Неверное имя пользователя или пароль' ?></span>
	</div>
	<?php endif; ?>
	<div class="form-group has-feedback">
		<?php echo Html::activeTextInput($loginForm, 'username', [
			'placeholder' => 'Пользователь',
			'class'       => 'form-control',
		]) ?>
		<span class="glyphicon glyphicon-user form-control-feedback"></span>
	</div>
	<div class="form-group has-feedback">
		<?php echo Html::activePasswordInput($loginForm, 'password', [
			'placeholder' => 'Пароль',
			'class'       => 'form-control'
		]) ?>
		<span class="glyphicon glyphicon-lock form-control-feedback"></span>
	</div>
	<div class="row">
		<div class="col-xs-8">
			<div class="checkbox icheck">
				<label>
					<?php echo Html::checkbox('LoginForm[rememberMe]', $loginForm->rememberMe); ?> <?php echo 'Запомнить меня'; ?>
				</label>
			</div>
		</div>
		<!-- /.col -->
		<div class="col-xs-4">
			<?php echo Html::submitButton('Войти', [
				'class' => 'btn btn-primary btn-block btn-flat',
			]); ?>
		</div>
		<!-- /.col -->
	</div>
<?php ActiveForm::end(); ?>

<!--<a href="--><?php //echo Url::to('/user/default/reset-password'); ?><!--">--><?php //echo Yii::t('main', 'Забыли пароль'); ?><!--?</a>-->

<?php
$script = <<< JS
	$(document).ready(function(){
		$('input').iCheck({
			checkboxClass: 'icheckbox_square-blue',
			radioClass: 'iradio_square-blue',
			increaseArea: '20%' // optional
		});
	});
JS;

$this->registerJs($script, \yii\web\View::POS_END);
