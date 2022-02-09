<?php

use common\models\Post;
use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'postId',
            'text',
            [
                'attribute' => 'userId',
                'format' => 'raw',
                'value' => function ($model) {
                    $userId = $model->userId;
                    $user = User::findOne($userId);
                    if (empty($user)) {
                        return null;
                    }

                    return Html::a($user->username,
                        Url::toRoute(['user/view', 'userId' => $user->userId]));

                }
            ],
            'created_at',
            'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Post $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'postId' => $model->postId]);
                 }
            ],
        ],
    ]); ?>


</div>
