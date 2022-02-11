<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property int $commentId
 * @property string|null $text
 */
class Comment extends BaseComment
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['text'], 'string'],
            [['postId'], 'integer'],
        ]);
    }

    /**
     * {@inheritdoc}
     */

    public function attributeLabels()
    {
        return [
            'commentId' => 'Comment ID',
            'text' => 'Text',
        ];
    }
    public function serializeToArray()
    {
        $serializedData = [];

        $serializedData['text'] = $this->text;
        $serializedData['postId'] = $this->postId;

        return $serializedData;
    }
}
