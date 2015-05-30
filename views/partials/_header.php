<?php
use app\commons\Url;
use app\modules\user\models\Profile;
use app\modules\user\models\User;

/** @var User $modelUser */
$modelUser = Yii::$app->getUser()->getIdentity();
?>

<header class="main-header">
	<!-- Logo -->
	<a href="<?php echo Url::to('/'); ?>" class="logo">
		<span class="logo-mini" style="font-size: 15px">Ника СМК</span>
		<!-- logo for regular state and mobile devices -->
		<span class="logo-lg"><?php echo Yii::t('main', 'Ника СМК'); ?></span>
	</a>
	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top" role="navigation">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only"><?php Yii::t('admin', 'Навигация'); ?></span>
		</a>
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<!-- User Account: style can be found in dropdown.less -->
				<li class="dropdown user user-menu">
					<?php if (!Yii::$app->getUser()->getIsGuest()): ?>
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="<?php echo $modelUser->getPhotoPath(); ?>" class="user-image" alt="<?php echo $modelUser->getFullName();  ?>"/>
						<span class="hidden-xs"><?php echo $modelUser->getFullName();  ?></span>
					</a>
					<ul class="dropdown-menu">
						<!-- User image -->
						<li class="user-header">
							<img src="<?php echo $modelUser->getPhotoPath(); ?>" class="img-circle" alt="<?php echo $modelUser->getFullName();  ?>" />
							<p>
								<?php echo $modelUser->getName();  ?> - <?php echo $modelUser->getPosition();  ?>
								<small><?php echo Yii::t('main', 'Добавлен') ?> <?php  ?></small>
							</p>
						</li>
						<!-- Menu Body -->
						<li class="user-body">
							<div class="col-xs-4 text-center">
								<a href="#">Followers</a>
							</div>
							<div class="col-xs-4 text-center">
								<a href="#">Sales</a>
							</div>
							<div class="col-xs-4 text-center">
								<a href="#">Friends</a>
							</div>
						</li>
						<!-- Menu Footer-->
						<li class="user-footer">
							<div class="pull-left">
								<a href="<?php echo Url::to('/user/user/view-profile'); ?>" class="btn btn-default btn-flat"><?php echo Yii::t('main', 'Профиль') ?></a>
							</div>
							<div class="pull-right">
								<a href="<?php echo Url::to('/logout'); ?>" class="btn btn-default btn-flat"><?php echo Yii::t('main', 'Выйти') ?></a>
							</div>
						</li>
					</ul>
					<?php endif; ?>
				</li>
			</ul>
		</div>
	</nav>
</header>

