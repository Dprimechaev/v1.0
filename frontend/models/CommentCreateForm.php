<?php

namespace frontend\models;

use common\models\Comment;
use common\models\Post;
use common\models\User;
use yii\base\Model;
use yii\db\ActiveQuery;

/**
 * Description of PostListForm
 *
 */
class CommentCreateForm extends Model
{
    /** @var $_posts ActiveQuery $query */
    public $text;
    public $postId;
    /**
     * @var Comment
     */
    public $comment;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['postId'], 'integer'],
        ];
    }
    /**
     * Выбрать посты.
     *
     * @return boolean
     */
    public function create()
    {
        $this->comment = new Comment();

        $this->comment->text = $this->text;
        $this->comment->postId = $this->postId;
        $this->comment->created_at = time();
        $this->comment->updated_at = time();

        if (!$this->comment->save()) {
            $this->addErrors($this->comment->getErrors());
            return false;
        }
        return true;
    }

    public function serializeResponseToArray()
    {
        return [
            'comment' => $this->comment->serializeToArray(),
        ];
    }
}
