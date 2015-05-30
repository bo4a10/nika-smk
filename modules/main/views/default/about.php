<?php
use app\modules\admin\models\Settings;

/**@var Settings $modelSettings */

$this->title = Yii::t('admin', 'Информация о сайте');
?>

<div class="content project_content">
	<div class="project">
		<div class="project_title title" style="text-align: center">
			<h1 class="uppercase">
				<?php echo Yii::t('admin', 'Информация о сайте'); ?>
			</h1>
		</div>
		<div class="project_desc top_block_text politic">
			<?php echo $modelSettings->getAboutText(); ?>
		</div>
	</div>
</div>