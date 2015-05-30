<?php
use app\commons\Url;
use app\modules\user\forms\SignupForm;
use app\modules\user\models\User;
use dosamigos\fileupload\FileUpload;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/** @var User[] $users */

$this->title                   = Yii::t('main', 'Список пользователей');
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-body">
				<table id="usersTable" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th><?php echo Yii::t('main', 'Логин'); ?></th>
							<th><?php echo Yii::t('main', 'ФИО'); ?></th>
							<th><?php echo Yii::t('main', 'E-Mail'); ?></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($users as $user): ?>
						<tr>
							<td><?php echo $user->getUsername(); ?></td>
							<td><?php echo $user->getFullName(); ?></td>
							<td><?php echo $user->getEmail(); ?></td>
							<td>
								<a href="<?php echo Url::toRoute(['update', 'id' => $user->getId()]); ?>">
									<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
								</a>
								<a href="<?php echo Url::toRoute(['delete', 'id' => $user->getId()]); ?>">
									<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
								</a>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
					<tfoot>
						<tr>
							<th><?php echo Yii::t('main', 'Логин'); ?></th>
							<th><?php echo Yii::t('main', 'ФИО'); ?></th>
							<th><?php echo Yii::t('main', 'E-Mail'); ?></th>
							<th></th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>

<?php echo \Yii::$app->view->render('@app/views/partials/_dataTable'); ?>