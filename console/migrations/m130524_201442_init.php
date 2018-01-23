<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%article}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()->comment('标题'),
            'ftitle' => $this->string()->notNull()->comment('副标题'),
            'titlepic' => $this->string()->comment('标题图'),
            'profile' => $this->string()->comment('简介'),
            'content' => $this->string()->comment('内容'),
            'source' => $this->integer()->notNull()->comment('来源'),
            'created_time' => $this->integer()->unsigned()->notNull()->comment('创建时间'),
            'updated_time' => $this->integer()->unsigned()->notNull()->comment('修改时间'),
        ], $tableOptions);

        $this->createTable('{{%source}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('名称'),
            'created_time' => $this->integer()->unsigned()->notNull()->comment('创建时间'),
            'updated_time' => $this->integer()->unsigned()->notNull()->comment('修改时间'),
        ], $tableOptions);

        $this->addForeignKey('article_source', '{{%article}}', 'source', '{{%source}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
