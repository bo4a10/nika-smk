<?php
use app\commons\AbstractPages;
use app\commons\Lang;
use app\commons\Url;

?>

<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			<li class="header" style="text-transform: uppercase"><?php echo Yii::t('admin', 'Главное меню'); ?></li>
			<li class="<?php if (in_array(Yii::$app->controller->currentPages, [
				AbstractPages::PAGES_USERS,
				AbstractPages::PAGES_USERS_CREATE,
			])) echo 'active'; ?> treeview">
				<a href="<?php echo Url::to('/user/user'); ?>">
					<i class="fa fa-user"></i>
					<span><?php echo Yii::t('main', 'Пользователи'); ?></span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class="<?php if (Yii::$app->controller->currentPages == AbstractPages::PAGES_USERS) echo 'active'; ?>">
						<a href="<?php echo Url::to('/user/user'); ?>">
							<i class="fa fa-circle-o"></i><?php echo Yii::t('main', 'Все'); ?>
						</a>
					</li>
					<li class="<?php if (Yii::$app->controller->currentPages == AbstractPages::PAGES_USERS_CREATE) echo 'active'; ?>">
						<a href="<?php echo Url::to('/user/user/create'); ?>">
							<i class="fa fa-circle-o"></i><?php echo Yii::t('main', 'Добавить'); ?>
						</a>
					</li>
				</ul>
			</li>

			<li class="<?php if (in_array(Yii::$app->controller->currentPages, [
				AbstractPages::PAGES_HANDBOOK_CITY
			])) { echo 'active';} ?> treeview">
				<a href="<?php echo Url::to('/handbook'); ?>">
					<i class="fa fa-book"></i>
					<span><?php echo Yii::t('main', 'Справочники'); ?></span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class="<?php if (Yii::$app->controller->currentPages == AbstractPages::PAGES_HANDBOOK_CITY) echo 'active'; ?>">
						<a href="<?php echo Url::to('/handbook/city'); ?>">
							<i class="fa fa-circle-o"></i><?php echo Yii::t('main', 'Города'); ?>
						</a>
					</li>
				</ul>
			</li>

		</ul>
	</section>
	<!-- /.sidebar -->
</aside>