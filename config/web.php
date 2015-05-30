<?php

use yii\helpers\ArrayHelper;

$paramsMain  = require(__DIR__ . '/params.php');
$paramsLocal = file_exists(__DIR__ . '/params-local.php') ? require_once(__DIR__ . '/params-local.php') : [];

$params = ArrayHelper::merge(
	$paramsMain,
	$paramsLocal
);

$dbMain  = require(__DIR__ . '/db.php');
$dbLocal = file_exists(__DIR__ . '/db-local.php') ? require_once(__DIR__ . '/db-local.php') : [];

$config = [
	'id'             => 'tinna',
	'basePath'       => dirname(__DIR__),
	'defaultRoute'   => 'main/default/index',
	'bootstrap'      => ['log'],
	'language'       => 'ru-RU',
	'sourceLanguage' => 'ru',
	'modules'        => [
		'redactor' => [
			'class'     => 'yii\redactor\RedactorModule',
			'uploadDir' => '@webroot/uploads/project',
			'uploadUrl' => $params['homeUrl'] . 'uploads/project',
		],
		'main'     => [
			'class' => 'app\modules\main\Module',
		],
		'user'     => [
			'class' => 'app\modules\user\Module',
		],
		'objects'     => [
			'class' => 'app\modules\objects\Module',
		],
		'handbook'     => [
			'class' => 'app\modules\handbook\Module',
		],
		'wialon'   => [
			'class'  => 'app\modules\wialon\Module',
			'host'   => 'sdk.overseer.ua',
			'schema' => 'http',
		],
        'driver'     => [
            'class' => 'app\modules\driver\Module',
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ],
	],
	'components'     => [
		'formatter'    => [
			'decimalSeparator'  => '.',
			'thousandSeparator' => ' ',
		],
		'image'        => [
			'class'  => 'yii\image\ImageDriver',
			'driver' => 'Imagick',  //GD or Imagick
		],
		'request'      => [
			// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
			'cookieValidationKey' => '3dhc9rngkfmdrey954',
			'class'               => 'app\commons\LangRequest'
		],
		'i18n'         => [
			'translations' => [
				'*' => [
					'class'          => 'yii\i18n\PhpMessageSource',
					'basePath'       => '@app/messages',
					'sourceLanguage' => 'ru',
					'fileMap'        => [
						//'main' => 'main.php',
					],
				],
			],
		],
		'cache'        => [
			'class' => 'yii\caching\FileCache',
		],
		'authManager'  => [
			'class'        => 'yii\rbac\DbManager',
			'defaultRoles' => [
				'admin', 'user'
			],
		],
		'user'         => [
			'identityClass'   => 'app\modules\user\models\User',
			'enableAutoLogin' => true,
			'loginUrl'        => ['/login'],
		],
		'errorHandler' => [
			'errorAction' => 'main/default/error',
		],
		'mailer'       => [
			'class'            => 'yii\swiftmailer\Mailer',
			// send all mails to a file by default. You have to set
			// 'useFileTransport' to false and configure a transport
			// for the mailer to send real emails.
			'useFileTransport' => false,
		],
		'log'          => [
			'traceLevel' => YII_DEBUG ? 3 : 0,
			'targets'    => [
				[
					'class'   => 'yii\log\FileTarget',
					'levels'  => ['error'],
					'logFile' => '@app/runtime/logs/web-error.log'
				],
				[
					'class'   => 'yii\log\FileTarget',
					'levels'  => ['warning'],
					'logFile' => '@app/runtime/logs/web-warning.log'
				],
			],
		],
		'urlManager'   => [
			'enablePrettyUrl' => true,
			'showScriptName'  => false,
			'class'           => 'app\commons\LangUrlManager',
			'rules'           => [
				'/'                                               => 'user/user/index',
				'<_a:error>'                                      => 'main/default/<_a>',
				'<_a:(about)>'                                    => 'main/default/<_a>',
				'<_a:(login|logout|signup|forgot|feedback)>'      => 'user/default/<_a>',
				'<_m:[\w\-]+>/<_c:[\w\-]+>/<_a:[\w\-]+>/<id:\d+>' => '<_m>/<_c>/<_a>',
				'<_m:[\w\-]+>/<_c:[\w\-]+>/<_a:[\w\-]+>'          => '<_m>/<_c>/<_a>',
				'<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>'              => '<_m>/<_c>/view',
				'<_m:[\w\-]+>/<_c:[\w\-]+>'                       => '<_m>/<_c>/index',
				'<_m:[\w\-]+>'                                    => '<_m>/default/index',
			]
		],
		'db'           => ArrayHelper::merge(
			$dbMain,
			$dbLocal
		),
	],
	'params'         => $params,
];

if (YII_ENV_DEV) {
	// configuration adjustments for 'dev' environment
	$config['bootstrap'][]      = 'debug';
	$config['modules']['debug'] = 'yii\debug\Module';

	$config['bootstrap'][]    = 'gii';
	$config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
