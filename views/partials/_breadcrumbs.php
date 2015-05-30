<?php
use app\commons\Url;
use yii\widgets\Breadcrumbs;

?>

<section class="content-header">
	<h1>
		<?php echo $this->title; ?>
	</h1>
	<?php
	echo Breadcrumbs::widget([
		'itemTemplate'       => "<li>{link}</li>",
		// template for all links
		'homeLink'           => [
			'label'  => Yii::t('main', 'Главная'),
			'url'    => Url::to('/'),
			'encode' => false,
			'template'       => "<li><i class=\"fa fa-dashboard\" style=\"margin-right: 5px;\"></i> {link}</li>",
		],
		'activeItemTemplate' => "<li class=\"active\">{link}</li>",
		'tag'                => 'ol',
		'options'            => [
			'class' => 'breadcrumb',
		],
		'links'              => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],

	]);
	?>
</section>