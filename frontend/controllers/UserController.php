<?php

namespace frontend\controllers;

use common\models\User;
use common\models\Post;
use frontend\models\UserSigninForm;
use frontend\models\UserSignupForm;
use Yii;


class UserController extends \yii\web\Controller
{
    //Отключаем Csrf защиту
    public $enableCsrfValidation = false;

    /**
     * @throws \yii\base\Exception
     */


    public function actionSignup()
    {

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $model = new UserSignupForm();

        if ($model->load(Yii::$app->request->post(), '') && $model->validate() && $model->create()) {
            return $model->serializeResponseToArray();
        } else {
            return $model->getErrors();
        }
    }

    public function actionSignin()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $model = new UserSigninForm();


        if ($model->load(Yii::$app->request->post(), '') && $model->validate() && $model->auth()) {
            return $model->serializeResponseToArray();
        } else {
            return $model->getErrors();
        }
    }



}
