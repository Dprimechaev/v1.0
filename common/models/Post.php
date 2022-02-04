<?php

namespace common\models;

use yii\base\Model;
use Yii;
use yii\db\ActiveRecord;


//TODO: move to common
/**
 * Password reset form
 */

//TODO: try base
// https://www.notion.so/whitetigersoft/Base-29ffa9f1b7ca4daf94f1cb29a3128b8e
// https://www.notion.so/whitetigersoft/Base-330f12ebc66941dfb588048307fc6c10
class Post extends ActiveRecord
{
    public static function tableName()
    {
        return '{{post}}';
    }

    public function rules()
    {
        return [
            [['text'], 'required'],
            [['userId'], 'required'],
        ];
    }

}
