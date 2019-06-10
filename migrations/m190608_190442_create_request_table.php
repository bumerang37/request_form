<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%request}}`.
 */
class m190608_190442_create_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function Up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%request}}', [
            'request_id' => $this->primaryKey(),
            'name' => $this->string(),
            'message' => $this->string(),
            'image' => $this->string(),
            'list' => $this->string(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),

        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function Down()
    {
        $this->dropTable('{{%request}}');
    }
}
