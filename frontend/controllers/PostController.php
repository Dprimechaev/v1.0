<?php

namespace frontend\controllers;

use common\models\User;
use common\models\Post;
use Yii;


//TODO: https://www.notion.so/whitetigersoft/JSON-d6d56c459683463fa80146aab25a8295
class PostController extends \yii\web\Controller
{
    //Отключаем Csrf защиту
    public $enableCsrfValidation = false;

    public function actionAllPostList()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $limit = \Yii::$app->request->get('limit', 10);
        $offset = \Yii::$app->request->get('offset', 0);
        $postQuery = Post::find()
            ->orderBy(['post.postId' => SORT_DESC])
            ->limit($limit)
            ->offset($offset);
        $result = [];

        foreach ($postQuery->each() as $post) {
            //TODO: https://www.notion.so/whitetigersoft/d6320d2e835b46ec87b47642b42dd816
            $result[] = [
                'postId' => $post->postId,
                'text' => $post->text,
            ];
        }

        return [
            'posts' => $result,
        ];
    }
    public function actionCreatePost(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $accessToken = \Yii::$app->request->post('accessToken');
        $text = \Yii::$app->request->post('text');


        $user = User::find()->where([
            'accessToken' => $accessToken,
        ])->one();


        if(empty($user))
        {
            return [
                'success' => false,
            ];
        }

        $model = Post::find()->where([
            'userId' => $user->id,
        ])->one();

        $userId = $model->userId;

        $post = new Post();

        $post->text = $text;
        $post->userId = $userId;

        $post->save();

        return [
            'success' => true,
        ];
    }
    public function actionMyPostList(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $limit = \Yii::$app->request->get('limit', 10);
        $offset = \Yii::$app->request->get('offset', 0);
        $accessToken = \Yii::$app->request->get('accessToken');

        $model = User::find()->where([
            'accessToken' => $accessToken,
        ])->one();


        $postQuery = Post::find()->where([
            'userId' => $model->id,
        ])
            ->orderBy(['post.postId' => SORT_DESC])
            ->limit($limit)
            ->offset($offset);

        $result = [];

        foreach ($postQuery->each() as $post) {
            //TODO: https://www.notion.so/whitetigersoft/d6320d2e835b46ec87b47642b42dd816
            $result[] = [
                'postId' => $post->postId,
                'text' => $post->text,
            ];
        }

        return [
            'posts' => $result,
        ];
    }

}
