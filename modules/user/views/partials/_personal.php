<?php
use app\modules\user\models\Files;
use app\modules\user\models\Profile;
use dosamigos\fileupload\FileUpload;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/** @var Profile $modelProfile */

$errors = $modelProfile->getErrors();

/** @var Files[] $files */
$files = $modelProfile->getUser()->getFiles();

?>

<div class="tabs_block active" id="tab1">
	<div class="lk_form">
		<?php $form = ActiveForm::begin([
			'id'                     => 'profile-form',
//			'action'                 => Url::to('/' . \app\commons\Lang::getCurrent()->getUrl() . '/user/personal/change-email'),
			'options'                => [
				'class'   => 'clearfix',
				'enctype' => 'multipart/form-data'
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
				<?php echo Yii::t('main', 'Фамилия') ?> <span class="nes">*</span>
			</div>
			<div class="input_wrap ">
				<?php echo Html::activeTextInput($modelProfile, 'last_name', [
					'class' => 'input',
				]) ?>
				<span id="error_last_name" class="input_error profile-error">
						<?php echo array_key_exists('last_name', $errors) ? $errors['last_name'][0] : ''; ?>
					</span>
			</div>
		</div>
		<div class="form_input_wrap">
			<div class="form_input_label">
				<?php echo Yii::t('main', 'Имя') ?> <span class="nes">*</span>
			</div>
			<div class="input_wrap ">
				<?php echo Html::activeTextInput($modelProfile, 'first_name', [
					'class' => 'input',
				]) ?>
				<span id="error_first_name" class="input_error profile-error">
						<?php echo array_key_exists('first_name', $errors) ? $errors['first_name'][0] : ''; ?>
					</span>
			</div>
		</div>
		<div class="form_input_wrap">
			<div class="form_input_label">
				<?php echo Yii::t('main', 'Отчество') ?> <span class="nes">*</span>
			</div>
			<div class="input_wrap ">
				<?php echo Html::activeTextInput($modelProfile, 'second_name', [
					'class' => 'input',
				]) ?>
				<span id="error_second_name" class="input_error profile-error">
						<?php echo array_key_exists('second_name', $errors) ? $errors['second_name'][0] : ''; ?>
					</span>
			</div>
		</div>
		<div class="form_input_wrap">
			<div class="form_input_label">
				<?php echo Yii::t('main', 'Дата, месяц, год рождения') ?> <span class="nes">*</span>
			</div>
			<div class="input_wrap date">
				<?php
				echo MaskedInput::widget([
					'name'          => 'Profile[birthday_at]',
					'value'         => $modelProfile->getBirthdayAt(),
					'clientOptions' => [
						'alias'       => 'dd.mm.yyyy',
						'placeholder' => "дд.мм.гггг",
					],
					'options'       => [
						'class' => 'input',
					]
				]);
				?>
				<span id="error_birthday_at" class="input_error profile-error">
					<?php echo array_key_exists('birthday_at', $errors) ? $errors['birthday_at'][0] : ''; ?>
				</span>
			</div>
		</div>
		<div class="form_input_wrap">
			<div class="form_input_label">
				<?php echo Yii::t('main', 'Мобильный телефон') ?> <span class="nes">*</span>
			</div>
			<div class="input_wrap ">
				<?php
				echo MaskedInput::widget([
					'name'    => 'Profile[mobile_phone]',
					'mask'    => '999-999-9999',
					'value'   => $modelProfile->getMobilePhone(),
					'options' => [
						'class' => 'input',
					]
				]);
				?>
				<span id="error_mobile_phone" class="input_error profile-error">
					<?php echo array_key_exists('mobile_phone', $errors) ? $errors['mobile_phone'][0] : ''; ?>
				</span>
			</div>
		</div>
		<div class="form_input_wrap">
			<div class="form_input_label">
				<?php echo Yii::t('main', 'Мобильный телефон') ?>
			</div>
			<div class="input_wrap ">
				<?php
				echo MaskedInput::widget([
					'name'    => 'Profile[mobile_phone_add]',
					'mask'    => '999-999-9999',
					'value'   => $modelProfile->getMobilePhoneAdd(),
					'options' => [
						'class' => 'input',
					]
				]);
				?>
				<span id="error_mobile_phone_add" class="input_error profile-error">
					<?php echo array_key_exists('mobile_phone_add', $errors) ? $errors['mobile_phone_add'][0] : ''; ?>
				</span>
			</div>
		</div>
		<div class="form_input_wrap">
			<div class="form_input_label">
				<?php echo Yii::t('main', 'Скайп') ?>
			</div>
			<div class="input_wrap ">
				<?php echo Html::activeTextInput($modelProfile, 'skype', [
					'class' => 'input',
				]) ?>
				<span id="error_skype" class="input_error profile-error">
					<?php echo array_key_exists('skype', $errors) ? $errors['skype'][0] : ''; ?>
				</span>
			</div>
		</div>
		<div class="form_title"><?php echo Yii::t('main', 'Ваши страницы в социальных сетях') ?></div>
		<div class="form_input_wrap">
			<div class="form_input_label">
				<?php echo Yii::t('main', 'Facebook') ?>
			</div>
			<div class="input_wrap ">
				<?php echo Html::activeTextInput($modelProfile, 'facebook', [
					'class' => 'input',
				]) ?>
				<span id="error_facebook" class="input_error profile-error">
					<?php echo array_key_exists('facebook', $errors) ? $errors['facebook'][0] : ''; ?>
				</span>
			</div>
		</div>
		<div class="form_input_wrap">
			<div class="form_input_label">
				<?php echo Yii::t('main', 'Одноклассники') ?>
			</div>
			<div class="input_wrap ">
				<?php echo Html::activeTextInput($modelProfile, 'odnoklassniki', [
					'class' => 'input',
				]) ?>
				<span id="error_odnoklassniki" class="input_error profile-error">
					<?php echo array_key_exists('odnoklassniki', $errors) ? $errors['odnoklassniki'][0] : ''; ?>
				</span>
			</div>
		</div>
		<div class="form_input_wrap">
			<div class="form_input_label">
				<?php echo Yii::t('main', 'Вконтакте') ?>
			</div>
			<div class="input_wrap ">
				<?php echo Html::activeTextInput($modelProfile, 'vkontakte', [
					'class' => 'input',
				]) ?>
				<span id="error_vkontakte" class="input_error profile-error">
					<?php echo array_key_exists('vkontakte', $errors) ? $errors['vkontakte'][0] : ''; ?>
				</span>
			</div>
		</div>
		<div class="form_input_wrap">
			<div class="form_input_label">
				<?php echo Yii::t('main', 'Twitter') ?>
			</div>
			<div class="input_wrap ">
				<?php echo Html::activeTextInput($modelProfile, 'twitter', [
					'class' => 'input',
				]) ?>
				<span id="error_twitter" class="input_error profile-error">
					<?php echo array_key_exists('twitter', $errors) ? $errors['twitter'][0] : ''; ?>
				</span>
			</div>
		</div>

		<?php echo \Yii::$app->view->render('_scansText_' . \app\commons\Lang::getCurrent()->getUrl()); ?>

		<div class="form_input_wrap">
			<div class="input_wrap ">
				<span id="error_files" class="input_error profile-error">
					<?php echo array_key_exists('files', $errors) ? $errors['files'][0] : ''; ?>
				</span>
			</div>
		</div>

		<div class="add_photo_wrap">
			<span id="error_files" class="input_error profile-error">
				<?php echo array_key_exists('files', $errors) ? $errors['files'][0] : ''; ?>
			</span>
			<?php echo FileUpload::widget([
				'model'         => $modelProfile,
				'attribute'     => 'file',
				'url'           => ['/main/file/upload-files'],
				'options'       => [
//					'accept'   => 'files/*',
					'multiple' => true,
					'class'    => 'add_photo_input',
				],
				'clientOptions' => [
					'maxNumberOfFiles' => Yii::$app->params['files']['maxFiles'],
					'dataType'         => 'json',
					'success'          => new JsExpression('function(e, data) {
                var component = "";
                component += "<td>" + e.fileName;
                component += "<input type=\"hidden\" name=\"Profile[files][]\" value=\"" + e.fileName  + "\" /></td>";
                component += "<td><a href=\"javascript:void(0)\" class=\"remove-file\" data-id=\"" + e.fileName + "\">' . Yii::t('main', 'Удалить') . '</a></td>";

                $("#uploadsFiles").append("<tr>" + component + "</tr>");
            }'),
					'error'            => new JsExpression('function(e, data) {
						callNoty(data, e.responseText.replace("Error:",  "").trim());
					}'),
				]
			]); ?>
			<a href="#" class="add_photo_button button"><img src="images/icons/upload.png"
			                                                 alt="">
				<?php echo Yii::t('main', 'Завантажити') ?>
				<span class="nes">*</span>
			</a>
			<table id="uploadsFiles">
				<?php foreach ($files as $file): ?>
					<tr>
						<td>
							<?php echo $file->getName(); ?>
							<input type="hidden" name="Profile[files][]" value="<?php echo $file->getName(); ?>" />
						</td>
						<td>
							<a href="javascript:void(0)" class="remove-file" data-id="<?php echo $file->getName(); ?>">
								<?php echo Yii::t('main', 'Удалить'); ?>
							</a>
						</td>
					</tr>
				<?php endforeach ?>
			</table>
		</div>

		<?php echo Html::submitButton(Yii::t('main', 'Сохранить'), [
			'class' => 'submit changeEmail-event',
			'id'    => 'submitChangeEmail',
		]); ?>

		<?php ActiveForm::end(); ?>
	</div>
</div>