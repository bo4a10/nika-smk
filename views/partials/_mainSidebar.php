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
				AbstractPages::PAGES_HANDBOOK_CITY,
				AbstractPages::PAGES_HANDBOOK_STADIUM,
				AbstractPages::PAGES_HANDBOOK_MEASURE_UNIT,
				AbstractPages::PAGES_HANDBOOK_INDICATOR,
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
					<li class="<?php if (Yii::$app->controller->currentPages == AbstractPages::PAGES_HANDBOOK_STADIUM) echo 'active'; ?>">
						<a href="<?php echo Url::to('/handbook/stadium'); ?>">
							<i class="fa fa-circle-o"></i><?php echo Yii::t('main', 'Стадионы'); ?>
						</a>
					</li>
					<li class="<?php if (Yii::$app->controller->currentPages == AbstractPages::PAGES_HANDBOOK_MEASURE_UNIT) echo 'active'; ?>">
						<a href="<?php echo Url::to('/handbook/measure-unit'); ?>">
							<i class="fa fa-circle-o"></i><?php echo Yii::t('main', 'Единицы измерения'); ?>
						</a>
					</li>
					<li class="<?php if (Yii::$app->controller->currentPages == AbstractPages::PAGES_HANDBOOK_INDICATOR) echo 'active'; ?>">
						<a href="<?php echo Url::to('/handbook/indicator'); ?>">
							<i class="fa fa-circle-o"></i><?php echo Yii::t('main', 'Показатели эффективности'); ?>
						</a>
					</li>
				</ul>
			</li>

			<li class="<?php if (in_array(Yii::$app->controller->currentPages, [
				AbstractPages::PAGES_HANDBOOK_FC,
				AbstractPages::PAGES_HANDBOOK_FC_ADD
			])) { echo 'active';} ?> treeview">
				<a href="<?php echo Url::to('/handbook'); ?>">
					<i class="fa fa-soccer-ball-o"></i>
					<span><?php echo Yii::t('main', 'Футбольный клуб'); ?></span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class="<?php if (Yii::$app->controller->currentPages == AbstractPages::PAGES_HANDBOOK_FC) echo 'active'; ?>">
						<a href="<?php echo Url::to('/handbook/football-club'); ?>">
							<i class="fa fa-circle-o"></i><?php echo Yii::t('main', 'Все'); ?>
						</a>
					</li>
					<li class="<?php if (Yii::$app->controller->currentPages == AbstractPages::PAGES_HANDBOOK_FC_ADD) echo 'active'; ?>">
						<a href="<?php echo Url::to('/handbook/football-club/create'); ?>">
							<i class="fa fa-circle-o"></i><?php echo Yii::t('main', 'Добавить'); ?>
						</a>
					</li>
				</ul>
			</li>

			<li class="<?php if (in_array(Yii::$app->controller->currentPages, [
				AbstractPages::PAGES_INDICATORS_FC,
				AbstractPages::PAGES_INDICATORS_MIN_MAX
			])) { echo 'active';} ?> treeview">
				<a href="<?php echo Url::to('/handbook'); ?>">
					<i class="fa fa-tasks"></i>
					<span><?php echo Yii::t('main', 'Значения показателей'); ?></span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class="<?php if (Yii::$app->controller->currentPages == AbstractPages::PAGES_HANDBOOK_FC) echo 'active'; ?>">
						<a href="<?php echo Url::to('/handbook/football-club'); ?>">
							<i class="fa fa-circle-o"></i><?php echo Yii::t('main', 'Показатели ФК'); ?>
						</a>
					</li>
					<li class="<?php if (Yii::$app->controller->currentPages == AbstractPages::PAGES_HANDBOOK_FC_ADD) echo 'active'; ?>">
						<a href="<?php echo Url::to('/handbook/football-club/create'); ?>">
							<i class="fa fa-circle-o"></i><?php echo Yii::t('main', 'Ограничения'); ?>
						</a>
					</li>
				</ul>
			</li>
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>