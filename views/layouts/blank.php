<?php
use app\assets\BlankAsset;
use app\commons\Lang;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

BlankAsset::register($this);
?>
<?php $this->beginPage() ?>
	<!DOCTYPE html>
	<html lang="<?php echo Yii::$app->language ?>">
	<head>
		<meta charset="<?php echo Yii::$app->charset ?>"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php echo Html::csrfMetaTags() ?>
		<title>Nika</title>
		<?php $this->head() ?>
		<link rel="icon" type="image/png" href="<?php echo Yii::$app->params['homeUrl']; ?>img/favicon.ico"/>
		<base href="<?php echo Yii::$app->params['homeUrl']; ?>">
	</head>
	<body class="login-page">

	<?php $this->beginBody() ?>

	<div class="login-box">
		<div class="login-logo">
			<a href="/<?php echo Lang::getCurrent()->getUrl() ?>/"><?php echo Yii::t('main', 'Футбольная статистика'); ?></a>
		</div>
		<div class="login-box-body">
			<?php echo $content; ?>
		</div>
	</div>

	<?php $this->endBody() ?>
	</body>
	</html>
<?php
$script = <<< JS
	$.widget.bridge('uibutton', $.ui.button);
JS;

$this->registerJs($script, \yii\web\View::POS_END);

$this->endPage();

