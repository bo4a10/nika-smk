<?php
$session = \Yii::$app->getSession();
$flashes = $session->getAllFlashes();
?>
<?php if (count($flashes) > 0): ?>
	<div class="col-md-12">

		<div class="box-body">
			<?php foreach ($flashes as $type => $message): ?>
				<?php if ($type == 'error'): ?>
					<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-ban"></i> <?php echo Yii::t('admin', 'Внимание') ?>!</h4>
						<?php echo $message; ?>
					</div>
				<?php elseif ($type == 'success'): ?>
					<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> <?php echo Yii::t('main', 'Спасибо') ?>!</h4>
						<?php echo $message; ?>
					</div>
				<?php else: ?>
					<div class="alert alert-info alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-info"></i> <?php echo Yii::t('main', 'Информация') ?>!</h4>
						<?php echo $message; ?>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>

	</div>
<?php endif; ?>