<?php
namespace app\commons;

use yii\helpers\Url as BaseUrl;

class Url extends BaseUrl
{
	public static function to($url = '', $scheme = false)
	{
		return parent::to('/' . Lang::getCurrent()->getUrl() . $url, $scheme);
	}
}