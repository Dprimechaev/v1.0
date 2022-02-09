<?php

namespace frontend\controllers;

use common\models\User;
use common\models\Post;
use Yii;


class UserController extends \yii\web\Controller
{
    //Отключаем Csrf защиту
    public $enableCsrfValidation = false;

    public function actionSignup()
    {

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $model = new User();

        $username = \Yii::$app->request->post('username');
        $password = \Yii::$app->request->post('password');
        $email = \Yii::$app->request->post('email');

        $model->username = $username;
        $model->email = $email;

        $model->accessToken = \Yii::$app->security->generateRandomString();
        $model->generateAuthKey();
        $model->setPassword($password);

        if (!$model->save()) {
            return [
                'success' => false,
            ];
        }

        return [
            'success' => true,
            'accessToken' => $model->accessToken,
        ];
    }

    public function actionSignin()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $email = \Yii::$app->request->post('email');
        $password = \Yii::$app->request->post('password');

        /**
         * @var User $user
         */
        $user = User::find()->andWhere([
            'email' => $email,
        ])->one();


        if (empty($user)) {
            return [
                'success' => false,
            ];
        }
        if(!$user->validatePassword($password)){
            return[
                'success' => false,
            ];
        };
        return [
            'accessToken' => $user->accessToken,
            'success' => true,
        ];
    }



}
