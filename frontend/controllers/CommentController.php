<?php

namespace frontend\controllers;

use common\models\Comment;
use common\models\User;
use common\models\Post;
use frontend\models\CommentCreateForm;
use frontend\models\CommentListForm;
use frontend\models\PostCreateForm;
use frontend\models\PostListForm;
use Yii;

class CommentController extends \yii\web\Controller
{
    //Отключаем Csrf защиту
    public $enableCsrfValidation = false;

    public function actionCreateComment()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $postId = \Yii::$app->request->post('postId');

        $post = Post::find()
            ->andWhere([
            'postId' => $postId,
        ])->one();


        if (empty($post)) {
            return 'error';
        }

        $model = new CommentCreateForm();
        $model->postId = $post->postId;

        if ($model->load(Yii::$app->request->post(), '') && $model->validate() && $model->create()) {
            return $model->serializeResponseToArray();
        } else {
            return $model->getErrors();
        }
    }
    public function actionGetComment()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $postId = \Yii::$app->request->get('postId');

        $post = Post::find()->andWhere([
            'postId' => $postId,
        ])->one();
        if (empty($post)) {
            return 'error';
        }
        $model = new CommentListForm();
        $model->postId = $post->postId;

        if ($model->load(Yii::$app->request->get(), '') && $model->validate() && $model->find()) {
            return $model->serializeResponseToArray();
        } else {
            return 'error';
        }
    }
}
