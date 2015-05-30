<?php
use app\commons\Lang;
use yii\helpers\Url;

?>

<div class="row">
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-yellow">
			<div class="inner">
				<h3><?php echo Yii::$app->controller->commonInformations['userCount'] ?></h3>
				<p><?php echo Yii::t('admin', 'Пользователи'); ?></p>
			</div>
			<div class="icon">
				<i class="ion ion-person-add"></i>
			</div>
			<a href="<?php echo Url::to(Lang::getCurrent()->getUrl() . '/admin/user'); ?>"
			   class="small-box-footer">
				<?php echo Yii::t('admin', 'Подробнее'); ?>
				<i class="fa fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-red">
			<div class="inner">
				<h3><?php echo Yii::$app->controller->commonInformations['projectCount'] ?></h3>
				<p><?php echo Yii::t('admin', 'Проекты'); ?></p>
			</div>
			<div class="icon">
				<i class="ion ion-pie-graph"></i>
			</div>
			<a href="<?php echo Url::to(Lang::getCurrent()->getUrl() . '/admin/project'); ?>"
			   class="small-box-footer">
				<?php echo Yii::t('admin', 'Подробнее'); ?>
				<i class="fa fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
</div>