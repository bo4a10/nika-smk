<?php
use app\assets\AppAsset;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
	<!DOCTYPE html>
	<html lang="<?= Yii::$app->language ?>">
	<head>
		<meta charset="<?= Yii::$app->charset ?>"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?= Html::csrfMetaTags() ?>
		<title>Nika SMK - <?php echo Html::encode($this->title); ?></title>
		<?php $this->head() ?>
		<link rel="icon" type="image/png" href="<?php echo Yii::$app->params['homeUrl']; ?>img/favicon.ico"/>
		<base href="<?php echo Yii::$app->params['homeUrl']; ?>">
	</head>
	<body class="skin-blue sidebar-mini">

	<?php $this->beginBody() ?>

	<div class="wrapper">
		<?php echo \Yii::$app->view->render('@app/views/partials/_header'); ?>

		<?php echo \Yii::$app->view->render('@app/views/partials/_mainSidebar'); ?>

		<div class="content-wrapper">
			<?php echo \Yii::$app->view->render('@app/views/partials/_breadcrumbs'); ?>

			<section class="content">
				<?php //echo \Yii::$app->view->render('@app/views/partials/_generalInformation'); ?>

				<?php echo \Yii::$app->view->render('@app/views/partials/_alerts'); ?>

				<?php echo \Yii::$app->view->render('@app/views/partials/_dialogDelete'); ?>

				<?php echo $content; ?>
			</section>
		</div>

		<?php echo \Yii::$app->view->render('@app/views/partials/_footer'); ?>
	</div>

	<?php $this->endBody() ?>
	</body>
</html>
<?php
$script = <<< JS
	$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
JS;

$this->registerJs($script, \yii\web\View::POS_END);

$this->endPage();
