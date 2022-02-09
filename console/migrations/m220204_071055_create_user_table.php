<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m220204_071055_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'role', $this->integer()->defaultValue(1));

        //TODO: check and remove
        // $this->createTable('{{%user}}', [
        //     'id' => $this->primaryKey(),
        //     'username' => $this->string(),
        //     'role' => $this->integer()->defaultValue(1),
        //     'accessToken' => $this->string(),
        //     'auth_key' => $this->string(32)->notNull(),
        //     'password_hash' => $this->string()->notNull(),
        //     'password_reset_token' => $this->string()->unique(),
        //     'email' => $this->string()->notNull()->unique(),

        //     'status' => $this->smallInteger()->notNull()->defaultValue(10),
        //     'created_at' => $this->integer()->notNull(),
        //     'updated_at' => $this->integer()->notNull(),
        // ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // $this->dropTable('{{%user}}');
        //TODO: check and remove
        $this->dropColumn('{{%user}}', 'verification_token');
    }
}
