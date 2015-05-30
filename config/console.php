<?php

use yii\helpers\ArrayHelper;

Yii::setAlias('@tests', dirname(__DIR__) . '/tests');

$paramsMain = require(__DIR__ . '/params.php');
$paramsLocal = file_exists(__DIR__ . '/params-local.php') ? require_once(__DIR__ . '/params-local.php') : [];

$params = ArrayHelper::merge(
    $paramsMain,
    $paramsLocal
);

$dbMain = require(__DIR__ . '/db.php');
$dbLocal = file_exists(__DIR__ . '/db-local.php') ? require_once(__DIR__ . '/db-local.php') : [];

$db = ArrayHelper::merge(
    $dbMain,
    $dbLocal
);

return [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'gii'],
    'controllerNamespace' => 'app\commands',
    'modules' => [
        'gii' => 'yii\gii\Module',
    ],
    'components' => [
	    'authManager'  => [
		    'class'        => 'yii\rbac\DbManager',
		    'defaultRoles' => [
			    'admin',
		    ],
	    ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error'],
                    'logFile' => '@app/runtime/logs/console-error.log'
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['warning'],
                    'logFile' => '@app/runtime/logs/console-warning.log'
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<_c:[\w\-]+>/<id:\d+>' => '<_c>/view',
                '<_c:[\w\-]+>' => '<_c>/index',
                '<_c:[\w\-]+>/<_a:[\w\-]+>/<id:\d+>' => '<_c>/<_a>',
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,
];
