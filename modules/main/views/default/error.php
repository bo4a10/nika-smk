<?php

use yii\helpers\Html;
use app\commons\Url;
use Yii;


/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

//$this->title = $message;

if (Yii::$app->getUser()->getIsGuest()) {
    return Yii::$app->getResponse()->redirect(Url::to('/login'), NULL)->send();
}

if ($exception->statusCode == 404 && !Yii::$app->getUser()->getIsGuest() ){
    echo $this->render('error404', [
        'message' => $message,
        'statusCode' => $exception->statusCode,
    ]);
}
else if ($exception->statusCode == 500){
    echo $this->render('error500', [
        'message' => $message,
        'statusCode' => $exception->statusCode,
    ]);
}
else if ($exception->statusCode == 403){
    echo $this->render('error403', [
        'message' => $message,
        'statusCode' => $exception->statusCode,
    ]);
}







