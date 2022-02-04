<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%posts}}`.
 */
class m220202_083327_create_posts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        //TODO: https://www.notion.so/whitetigersoft/4e656c9abd3043f3bd683739f2863c7c
        $this->createTable('{{%posts}}', [
            //TODO: https://www.notion.so/whitetigersoft/Primary-Key-76e1862f6f5746d7808536b56eb8c39a
            'id' => $this->primaryKey(),
            'text' => $this->string(),
            'userId' => $this->integer(),
        ]);

        //TODO: add relation to user https://www.notion.so/whitetigersoft/Foreign-Keys-28bb98c23fad4e98b04e2945f87c1038
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%posts}}');
    }
}
