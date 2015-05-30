<?php

return [
	'adminEmail'   => 'admin@argo.ua',
	'supportEmail' => 'support@argo.ua',
	'uploads'      => [
		'tmp'     => 'uploads/tmp/',
		'files'   => 'uploads/files/',
		'images'  => 'uploads/images/',
		'webPath' => dirname(__DIR__) . DIRECTORY_SEPARATOR . 'web',
	],
//	'homeUrl'      => 'http://argo.ua/',
	'homeUrl'      => 'http://overseerdev.andersenlab.com/',
//	'domainName'   => 'argo.ua',
	'domainName'   => 'overseerdev.andersenlab.com/',
	'mainTitle'    => 'Арго',
	'rememberMe'   => 3600 * 24 * 30,
	'files'        => [
		'maxFileSizes'   => 2000000,
		'maxFileSizesMb' => '2Мбайт',
		'maxFiles'       => 10,
		'extensions'     => 'jpeg, jpg, gif, png',
	],
	'image'        => [
		'width'  => 600,
		'height' => 450,
	],
	'pageSize'     => 30,
	'percent'     => 0.1,
	'wialon' => [
		'host'   => 'sdk.overseer.ua',
		'schema' => 'http',
		'port' => '',
		'isPro' => true,
	],
    'ssid' => [
        'id'   => '0',
    ],
    'uploadPhotoDriver' => 'uploads/images/driver/',

];
